<?php
namespace Shire\Codeception\Module;

// here you can define custom functions for CodeGuy

use Codeception\Module;
use Codeception\TestCase;
use PHPUnit_Framework_Assert;

class EmulateModuleHelper extends Module
{
    public $assertions = 0;

    public function seeEquals($expected, $actual) {
        PHPUnit_Framework_Assert::assertEquals($expected, $actual);
        $this->assertions++;
    }

    public function seeFeaturesEquals($expected) {
        PHPUnit_Framework_Assert::assertEquals($expected, $this->scenario->getFeature());
    }

    public function _before(TestCase $test) {
        $this->scenario = $test->getScenario();
    }

}
