<?php
namespace Codeception\Module;

// here you can define custom functions for CoverGuy

use Codeception\Module;
use Codeception\TestCase;

class CoverHelper extends Module
{

    public function _before(TestCase $test) {
        if (floatval(phpversion()) == '5.3') $test->markTestSkipped();
    }
}
