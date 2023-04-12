<?php
namespace Ratchet\RFC6455\Messaging;

use Countable;
use Traversable;

interface MessageInterface extends DataInterface, Traversable, Countable {
    /**
     * @param FrameInterface $fragment
     * @return MessageInterface
     */
    function addFrame(FrameInterface $fragment);

    /**
     * @return int
     */
    function getOpcode();

    /**
     * @return bool
     */
    function isBinary();
}
