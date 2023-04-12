<?php

use Codeception\TestCase;
use Codeception\TestCase\Cest;
use Codeception\Util\Locator;
use Codeception\Util\Stub;

class CestTest extends Codeception\TestCase\Test
{

    /**
     * @group core
     */
    public function testFilename()
    {
        $cest = Stub::make('\Codeception\TestCase\Cest', array(
                'getTestClass' => new Locator(),
                'getTestMethod' => 'combine'
        ));
        $this->assertEquals('Codeception\Util\Locator::combine', $cest->getSignature());
    }

    /**
     * @group core
     */
    public function testCestNamings()
    {
        $cept = new Cest();
        $klass = new stdClass();
        $cept->config('testClassInstance',$klass)
            ->config('testMethod', 'user')
            ->config('testFile', 'tests/acceptance/LoginCest.php');

        $this->assertEquals(
            'tests/acceptance/LoginCest.php:user',
            TestCase::getTestFullName($cept)
        );
        $this->assertEquals(
            'tests/acceptance/LoginCest.php',
            TestCase::getTestFileName($cept)
        );
        $this->assertEquals(
            'stdClass::user',
            TestCase::getTestSignature($cept)
        );
    }

}
