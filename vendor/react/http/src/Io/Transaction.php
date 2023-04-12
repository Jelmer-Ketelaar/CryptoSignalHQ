<?php

namespace React\Http\Io;

use OverflowException;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\UriInterface;
use RingCentral\Psr7\Request;
use RingCentral\Psr7\Uri;
use React\EventLoop\LoopInterface;
use React\Http\Message\ResponseException;
use React\Promise\Deferred;
use React\Promise\PromiseInterface;
use React\Stream\ReadableStreamInterface;
use RuntimeException;
use function defined;
use function React\Promise\reject;
use function React\Promise\resolve;
use function React\Promise\Stream\buffer;
use const SOCKET_EMSGSIZE;

/**
 * @internal
 */
class Transaction
{
    private $sender;
    private $loop;

    // context: http.timeout (ini_get('default_socket_timeout'): 60)
    private $timeout;

    // context: http.follow_location (true)
    private $followRedirects = true;

    // context: http.max_redirects (10)
    private $maxRedirects = 10;

    // context: http.ignore_errors (false)
    private $obeySuccessCode = true;

    private $streaming = false;

    private $maximumSize = 16777216; // 16 MiB = 2^24 bytes

    public function __construct(Sender $sender, LoopInterface $loop)
    {
        $this->sender = $sender;
        $this->loop = $loop;
    }

    /**
     * @param array $options
     * @return self returns new instance, without modifying existing instance
     */
    public function withOptions(array $options)
    {
        $transaction = clone $this;
        foreach ($options as $name => $value) {
            if (property_exists($transaction, $name)) {
                // restore default value if null is given
                if ($value === null) {
                    $default = new self($this->sender, $this->loop);
                    $value = $default->$name;
                }

                $transaction->$name = $value;
            }
        }

        return $transaction;
    }

    public function send(RequestInterface $request)
    {
        $state = new ClientRequestState();
        $deferred = new Deferred(function () use ($state) {
            if ($state->pending !== null) {
                $state->pending->cancel();
                $state->pending = null;
            }
        });

        // use timeout from options or default to PHP's default_socket_timeout (60)
        $timeout = (float)($this->timeout !== null ? $this->timeout : ini_get("default_socket_timeout"));

        $loop = $this->loop;
        $this->next($request, $deferred, $state)->then(
            function (ResponseInterface $response) use ($state, $deferred, $loop, &$timeout) {
                if ($state->timeout !== null) {
                    $loop->cancelTimer($state->timeout);
                    $state->timeout = null;
                }
                $timeout = -1;
                $deferred->resolve($response);
            },
            function ($e) use ($state, $deferred, $loop, &$timeout) {
                if ($state->timeout !== null) {
                    $loop->cancelTimer($state->timeout);
                    $state->timeout = null;
                }
                $timeout = -1;
                $deferred->reject($e);
            }
        );

        if ($timeout < 0) {
            return $deferred->promise();
        }

        $body = $request->getBody();
        if ($body instanceof ReadableStreamInterface && $body->isReadable()) {
            $that = $this;
            $body->on('close', function () use ($that, $deferred, $state, &$timeout) {
                if ($timeout >= 0) {
                    $that->applyTimeout($deferred, $state, $timeout);
                }
            });
        } else {
            $this->applyTimeout($deferred, $state, $timeout);
        }

        return $deferred->promise();
    }

    /**
     * @internal
     * @param number $timeout
     * @return void
     */
    public function applyTimeout(Deferred $deferred, ClientRequestState $state, $timeout)
    {
        $state->timeout = $this->loop->addTimer($timeout, function () use ($timeout, $deferred, $state) {
            $deferred->reject(new RuntimeException(
                'Request timed out after ' . $timeout . ' seconds'
            ));
            if ($state->pending !== null) {
                $state->pending->cancel();
                $state->pending = null;
            }
        });
    }

    private function next(RequestInterface $request, Deferred $deferred, ClientRequestState $state)
    {
        $this->progress('request', array($request));

        $that = $this;
        ++$state->numRequests;

        $promise = $this->sender->send($request);

        if (!$this->streaming) {
            $promise = $promise->then(function ($response) use ($deferred, $state, $that) {
                return $that->bufferResponse($response, $deferred, $state);
            });
        }

        $state->pending = $promise;

        return $promise->then(
            function (ResponseInterface $response) use ($request, $that, $deferred, $state) {
                return $that->onResponse($response, $request, $deferred, $state);
            }
        );
    }

    /**
     * @internal
     * @return PromiseInterface Promise<ResponseInterface, Exception>
     */
    public function bufferResponse(ResponseInterface $response, Deferred $deferred, ClientRequestState $state)
    {
        $stream = $response->getBody();

        $size = $stream->getSize();
        if ($size !== null && $size > $this->maximumSize) {
            $stream->close();
            return reject(new OverflowException(
                'Response body size of ' . $size . ' bytes exceeds maximum of ' . $this->maximumSize . ' bytes',
                defined('SOCKET_EMSGSIZE') ? SOCKET_EMSGSIZE : 0
            ));
        }

        // body is not streaming => already buffered
        if (!$stream instanceof ReadableStreamInterface) {
            return resolve($response);
        }

        // buffer stream and resolve with buffered body
        $maximumSize = $this->maximumSize;
        $promise = buffer($stream, $maximumSize)->then(
            function ($body) use ($response) {
                return $response->withBody(new BufferedBody($body));
            },
            function ($e) use ($stream, $maximumSize) {
                // try to close stream if buffering fails (or is cancelled)
                $stream->close();

                if ($e instanceof OverflowException) {
                    $e = new OverflowException(
                        'Response body size exceeds maximum of ' . $maximumSize . ' bytes',
                        defined('SOCKET_EMSGSIZE') ? SOCKET_EMSGSIZE : 0
                    );
                }

                throw $e;
            }
        );

        $state->pending = $promise;

        return $promise;
    }

    /**
     * @internal
     * @throws ResponseException
     * @return ResponseInterface|PromiseInterface
     */
    public function onResponse(ResponseInterface $response, RequestInterface $request, Deferred $deferred, ClientRequestState $state)
    {
        $this->progress('response', array($response, $request));

        // follow 3xx (Redirection) response status codes if Location header is present and not explicitly disabled
        // @link https://tools.ietf.org/html/rfc7231#section-6.4
        if ($this->followRedirects && ($response->getStatusCode() >= 300 && $response->getStatusCode() < 400) && $response->hasHeader('Location')) {
            return $this->onResponseRedirect($response, $request, $deferred, $state);
        }

        // only status codes 200-399 are considered to be valid, reject otherwise
        if ($this->obeySuccessCode && ($response->getStatusCode() < 200 || $response->getStatusCode() >= 400)) {
            throw new ResponseException($response);
        }

        // resolve our initial promise
        return $response;
    }

    /**
     * @param ResponseInterface $response
     * @param RequestInterface $request
     * @return PromiseInterface
     * @throws RuntimeException
     */
    private function onResponseRedirect(ResponseInterface $response, RequestInterface $request, Deferred $deferred, ClientRequestState $state)
    {
        // resolve location relative to last request URI
        $location = Uri::resolve($request->getUri(), $response->getHeaderLine('Location'));

        $request = $this->makeRedirectRequest($request, $location);
        $this->progress('redirect', array($request));

        if ($state->numRequests >= $this->maxRedirects) {
            throw new RuntimeException('Maximum number of redirects (' . $this->maxRedirects . ') exceeded');
        }

        return $this->next($request, $deferred, $state);
    }

    /**
     * @param RequestInterface $request
     * @param UriInterface $location
     * @return RequestInterface
     */
    private function makeRedirectRequest(RequestInterface $request, UriInterface $location)
    {
        $originalHost = $request->getUri()->getHost();
        $request = $request
            ->withoutHeader('Host')
            ->withoutHeader('Content-Type')
            ->withoutHeader('Content-Length');

        // Remove authorization if changing hostnames (but not if just changing ports or protocols).
        if ($location->getHost() !== $originalHost) {
            $request = $request->withoutHeader('Authorization');
        }

        // naïve approach..
        $method = ($request->getMethod() === 'HEAD') ? 'HEAD' : 'GET';

        return new Request($method, $location, $request->getHeaders());
    }

    private function progress($name, array $args = array())
    {
        return;

        echo $name;

        foreach ($args as $arg) {
            echo ' ';
            if ($arg instanceof ResponseInterface) {
                echo 'HTTP/' . $arg->getProtocolVersion() . ' ' . $arg->getStatusCode() . ' ' . $arg->getReasonPhrase();
            } elseif ($arg instanceof RequestInterface) {
                echo $arg->getMethod() . ' ' . $arg->getRequestTarget() . ' HTTP/' . $arg->getProtocolVersion();
            } else {
                echo $arg;
            }
        }

        echo PHP_EOL;
    }
}
