<?php
namespace Codeception\Module;


use Codeception\Module;
use Codeception\TestCase;

class OtherHelper extends Module
{
    public function _before(TestCase $test)
    {
        if (strpos(PHP_VERSION, '5.3')===0) $test->markTestSkipped();
    }

}
