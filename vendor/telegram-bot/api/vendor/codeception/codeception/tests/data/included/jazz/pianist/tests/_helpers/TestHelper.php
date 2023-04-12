<?php
namespace Jazz\Pianist\Codeception\Module;

// here you can define custom functions for TestGuy

use Codeception\Module;
use PHPUnit_Framework_Assert;

class TestHelper extends Module
{
    public function seeEquals($expected, $actual) {
        PHPUnit_Framework_Assert::assertEquals($expected, $actual);
    }
}
