<?php

use Codeception\Lib\Di;
use Codeception\Lib\ModuleContainer;
use Codeception\Module\EmulateModuleHelper;
use Codeception\Step\Action;
use Codeception\TestCase;
use Codeception\TestCase\Cept;
use Symfony\Component\EventDispatcher\EventDispatcher;

class TestCaseTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var TestCase
     */
    protected $testcase;

    /**
     * @var EventDispatcher
     */
    protected $dispatcher;

    /**
     * @var ModuleContainer
     */
    protected $moduleContainer;

    public function setUp() {
        $this->dispatcher = new Symfony\Component\EventDispatcher\EventDispatcher;
        $di = new Di();
        $this->moduleContainer = new ModuleContainer($di, []);
        EmulateModuleHelper::$onlyActions = [];
        EmulateModuleHelper::$excludeActions = [];
        $module = $this->moduleContainer->create('EmulateModuleHelper');
        $module->_initialize();


        $this->testcase = new Cept;
        $this->testcase->configDispatcher($this->dispatcher)
            ->configName('mocked test')
            ->configFile(codecept_data_dir().'SimpleCept.php')
            ->configDi($di)
            ->configModules($this->moduleContainer)
            ->initConfig();
    }

    /**
     * @group core
     */
    public function testRunStepEvents()
    {
        $events = array();
        codecept_debug($this->moduleContainer->getActions());
        $this->dispatcher->addListener('step.before', function () use (&$events) { $events[] = 'step.before'; });
        $this->dispatcher->addListener('step.after', function () use (&$events) { $events[] = 'step.after'; });
        $step = new Action('seeEquals', array(5,5));
        $this->testcase->runStep($step);
        $this->assertEquals($events, array('step.before', 'step.after'));
    }

    /**
     * @group core
     */
    public function testRunStep() {
        $assertions = &$this->moduleContainer->getModule('EmulateModuleHelper')->assertions;
        $step = new Action('seeEquals', array(5,5));
        $this->testcase->runStep($step);
        $this->assertEquals(1, $assertions);
        $step = new Action('seeEquals', array(5,6));
        try {
            $this->testcase->runStep($step);
        } catch (Exception $e) {
            $this->assertInstanceOf('PHPUnit_Framework_ExpectationFailedException', $e);
        }
        $this->assertEquals(1, $assertions);
    }

}
