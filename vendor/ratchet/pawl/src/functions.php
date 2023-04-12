<?php
namespace Ratchet\Client;
use React\EventLoop\LoopInterface;
use React\Promise\PromiseInterface;

/**
 * @param string             $url
 * @param array              $subProtocols
 * @param array              $headers
 * @param LoopInterface|null $loop
 * @return PromiseInterface<WebSocket>
 */
function connect($url, array $subProtocols = [], $headers = [], LoopInterface $loop = null) {
    $connector = new Connector($loop);
    $connection = $connector($url, $subProtocols, $headers);

    return $connection;
}
