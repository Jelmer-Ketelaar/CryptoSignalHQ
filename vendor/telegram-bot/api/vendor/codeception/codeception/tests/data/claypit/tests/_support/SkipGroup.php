<?php

use Codeception\Event\TestEvent;
use Codeception\GroupObject;

class SkipGroup extends GroupObject
{
    public static $group = 'abc';

    public function _before(TestEvent $e)
    {
        $e->getTest()->markTestSkipped('WE SKIP TEST');
    }
}
