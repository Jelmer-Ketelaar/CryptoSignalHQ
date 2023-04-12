<?php

use Codeception\TestCase;
use Codeception\TestCase\Cept;

class CeptTest extends Codeception\TestCase\Test
{

    /**
     * @group core
     */
    public function testCeptNamings()
    {
        $cept = new Cept();
        $cept->configName('LoginCept.php')
            ->config('testFile', 'tests/acceptance/LoginCept.php');

        $this->assertEquals(
            'tests/acceptance/LoginCept.php',
            TestCase::getTestFileName($cept)
        );
        $this->assertEquals(
            'tests/acceptance/LoginCept.php',
            TestCase::getTestFullName($cept)
        );
        $this->assertEquals(
            'LoginCept',
            TestCase::getTestSignature($cept)
        );
    }


}
