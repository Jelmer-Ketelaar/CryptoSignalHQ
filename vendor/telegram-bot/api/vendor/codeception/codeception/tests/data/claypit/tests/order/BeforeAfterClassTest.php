<?php

use Codeception\Module\OrderHelper;

/**
 * @group App
 * @group New
 */
class BeforeAfterClassTest extends \Codeception\TestCase\Test
{
    /**
     * @beforeClass
     */
    public static function setUpSomeSharedFixtures()
    {
        OrderHelper::appendToFile('{');
    }

    public function testOne()
    {
        OrderHelper::appendToFile('1');
    }

    public function testTwo()
    {
        OrderHelper::appendToFile('2');
    }

    /**
     * @afterClass
     */
    public static function tearDownSomeSharedFixtures()
    {
        OrderHelper::appendToFile('}');
    }

}
