<?php

namespace React\Http\Io;

use React\EventLoop\TimerInterface;
use React\Promise\PromiseInterface;

/** @internal */
class ClientRequestState
{
    /** @var int */
    public $numRequests = 0;

    /** @var ?PromiseInterface */
    public $pending = null;

    /** @var ?TimerInterface */
    public $timeout = null;
}
