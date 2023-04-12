<?php

use Codeception\Configuration;
use Codeception\PHPUnit\Listener;
use Codeception\PHPUnit\Runner;
use Codeception\SuiteManager;
use Codeception\Util\Stub;
use Symfony\Component\EventDispatcher\EventDispatcher;

if (!defined('PHPUNIT_TESTSUITE')) define('PHPUNIT_TESTSUITE', true);

/**
 * @group core
 * Class SuiteManagerTest
 */
class SuiteManagerTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var SuiteManager
     */
    protected $suiteman;

    /**
     * @var EventDispatcher
     */
    protected $dispatcher;

    /**
     * @var Runner
     */
    protected $runner;

    public function setUp()
    {
        $this->dispatcher = new Symfony\Component\EventDispatcher\EventDispatcher;
        $settings = Configuration::$defaultSuiteSettings;
        $settings['class_name'] = 'CodeGuy';
        $this->suiteman = new SuiteManager($this->dispatcher, 'suite', $settings);

        $printer = Stub::makeEmpty('PHPUnit_TextUI_ResultPrinter');
        $this->runner = new Runner;
        $this->runner->setPrinter($printer);
    }

    /**
     * @group core
     */
    public function testRun() {
        $events = [];
        $eventListener = function ($event, $eventName) use (&$events) { $events[] = $eventName; };
        $this->dispatcher->addListener('suite.before', $eventListener);
        $this->dispatcher->addListener('suite.after', $eventListener);
        $this->suiteman->run($this->runner, new PHPUnit_Framework_TestResult, ['colors' => false, 'steps' => true, 'debug' => false]);
        $this->assertEquals($events, ['suite.before', 'suite.after']);
    }

    /**
     * @group core
     */
    public function testFewTests() {
        $file = Configuration::dataDir().'SimpleCest.php';

        $this->suiteman->loadTests($file);
        $this->assertEquals(2, $this->suiteman->getSuite()->count());

        $file = Configuration::dataDir().'SimpleWithNoClassCest.php';
        $this->suiteman->loadTests($file);
        $this->assertEquals(3, $this->suiteman->getSuite()->count());
    }

    /**
     * When running multiple environments, getClassesFromFile() method in SuiteManager is called once for each env.
     * See \Codeception\Codecept::runSuite() - for each env new SuiteManager is created and tests loaded.
     * Make sure that calling getClassesFromFile() multiple times will always return the same classes.
     *
     * @group core
     */
    public function testAddCestWithEnv() {
        $file = Configuration::dataDir().'SimpleNamespacedTest.php';
        $this->suiteman->loadTests($file);
        $this->assertEquals(3, $this->suiteman->getSuite()->count());
        $newSuiteMan = new SuiteManager($this->dispatcher, 'suite', Configuration::$defaultSuiteSettings);
        $newSuiteMan->loadTests($file);
        $this->assertEquals(3, $newSuiteMan->getSuite()->count());
    }

    public function testDependencyResolution()
    {
        $this->suiteman->loadTests(codecept_data_dir().'SimpleWithDependencyInjectionCest.php');
        $this->assertEquals(3, $this->suiteman->getSuite()->count());
    }

    public function testGroupEventsAreFired()
    {
        $events = [];
        $eventListener = function ($event, $eventName) use (&$events) { $events[] = $eventName; };
        $this->dispatcher->addListener('test.before', $eventListener);
        $this->dispatcher->addListener('test.before.admin', $eventListener);
        $this->dispatcher->addListener('test.after', $eventListener);
        $this->dispatcher->addListener('test.after.admin', $eventListener);

        $this->suiteman->loadTests(codecept_data_dir().'SimpleAdminGroupCest.php');
        $result = new PHPUnit_Framework_TestResult;
        $listener = new Listener($this->dispatcher);
        $result->addListener($listener);
        $this->suiteman->run($this->runner, $result, ['silent' => true, 'colors' => false, 'steps' => true, 'debug' => false]);
        $this->assertContains('test.before', $events);
        $this->assertContains('test.before.admin', $events);
        $this->assertContains('test.after', $events);
        $this->assertContains('test.after.admin', $events);
    }



}
