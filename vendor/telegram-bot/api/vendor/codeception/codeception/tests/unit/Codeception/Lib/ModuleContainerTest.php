<?php
namespace Codeception\Lib;

use Codeception\Exception\ConfigurationException;
use Codeception\Lib\Interfaces\ConflictsWithModule;
use Codeception\Lib\Interfaces\DependsOnModule;
use Codeception\Module;
use Codeception\Module\UniversalFramework;
use Codeception\Specify;
use Codeception\Util\Stub;
use PHPUnit_Framework_TestCase;

class ModuleContainerTest extends PHPUnit_Framework_TestCase
{
    use Specify;
    /**
     * @var ModuleContainer
     */
    protected $moduleContainer;

    protected function setUp()
    {
        $this->moduleContainer = new ModuleContainer(Stub::make('Codeception\Lib\Di'), []);
    }

    protected function tearDown()
    {
        UniversalFramework::$includeInheritedActions = true;
        UniversalFramework::$onlyActions = [];
        UniversalFramework::$excludeActions = [];
        UniversalFramework::$aliases = [];
    }

    /**
     * @group core
     * @throws ConfigurationException
     */
    public function testCreateModule()
    {
        $module = $this->moduleContainer->create('EmulateModuleHelper');
        $this->assertInstanceOf('Codeception\Module\EmulateModuleHelper', $module);

        $module = $this->moduleContainer->create('Codeception\Module\EmulateModuleHelper');
        $this->assertInstanceOf('Codeception\Module\EmulateModuleHelper', $module);

        $this->assertTrue($this->moduleContainer->hasModule('EmulateModuleHelper'));
        $this->assertInstanceOf('Codeception\Module\EmulateModuleHelper', $this->moduleContainer->getModule('EmulateModuleHelper'));

    }

    /**
     * @group core
     */
    public function testActions()
    {
        $this->moduleContainer->create('EmulateModuleHelper');
        $actions = $this->moduleContainer->getActions();
        $this->assertArrayHasKey('seeEquals', $actions);
        $this->assertEquals('EmulateModuleHelper', $actions['seeEquals']);
    }

    /**
     * @group core
     */
    public function testActionsInExtendedModule()
    {
        $this->moduleContainer->create('\Codeception\Module\UniversalFramework');
        $actions = $this->moduleContainer->getActions();
        $this->assertArrayHasKey('amOnPage', $actions);
        $this->assertArrayHasKey('see', $actions);
        $this->assertArrayHasKey('click', $actions);
    }

    /**
     * @group core
     */
    public function testActionsInExtendedButNotInheritedModule()
    {
        UniversalFramework::$includeInheritedActions = false;
        $this->moduleContainer->create('\Codeception\Module\UniversalFramework');
        $actions = $this->moduleContainer->getActions();
        $this->assertArrayNotHasKey('amOnPage', $actions);
        $this->assertArrayNotHasKey('see', $actions);
        $this->assertArrayNotHasKey('click', $actions);
    }

    /**
     * @group core
     */
    public function testExplicitlySetActionsOnNotInherited()
    {
        UniversalFramework::$includeInheritedActions = false;
        UniversalFramework::$onlyActions = ['see'];
        $this->moduleContainer->create('\Codeception\Module\UniversalFramework');
        $actions = $this->moduleContainer->getActions();
        $this->assertArrayNotHasKey('amOnPage', $actions);
        $this->assertArrayHasKey('see', $actions);
        $this->assertArrayNotHasKey('click', $actions);
    }

    /**
     * @group core
     */
    public function testActionsExplicitlySetForNotInheritedModule()
    {
        UniversalFramework::$onlyActions = ['see'];
        $this->moduleContainer->create('\Codeception\Module\UniversalFramework');
        $actions = $this->moduleContainer->getActions();
        $this->assertArrayNotHasKey('amOnPage', $actions);
        $this->assertArrayHasKey('see', $actions);
    }

    /**
     * @group core
     */
    public function testCreateModuleWithoutRequiredFields()
    {
        $this->setExpectedException('\Codeception\Exception\ModuleConfigException');
        $this->moduleContainer->create('Codeception\Lib\StubModule');
    }

    /**
     * @group core
     */
    public function testCreateModuleWithCorrectConfig()
    {
        $config = ['modules' =>
            ['config' => [
                'Codeception\Lib\StubModule' => [
                    'firstField' => 'firstValue',
                    'secondField' => 'secondValue',
                ]
            ]
        ]];

        $this->moduleContainer = new ModuleContainer(Stub::make('Codeception\Lib\Di'), $config);
        $module = $this->moduleContainer->create('Codeception\Lib\StubModule');

        $this->assertEquals('firstValue', $module->_getFirstField());
        $this->assertEquals('secondValue', $module->_getSecondField());
    }

    /**
     * @group core
     */
    public function testReconfigureModule()
    {
        $config = ['modules' =>
            ['config' => [
                'Codeception\Lib\StubModule' => [
                    'firstField' => 'firstValue',
                    'secondField' => 'secondValue',
                ]
            ]
        ]];
        $this->moduleContainer = new ModuleContainer(Stub::make('Codeception\Lib\Di'), $config);
        $module = $this->moduleContainer->create('Codeception\Lib\StubModule');
        $module->_reconfigure(['firstField' => '1st', 'secondField' => '2nd']);
        $this->assertEquals('1st', $module->_getFirstField());
        $this->assertEquals('2nd', $module->_getSecondField());
        $module->_resetConfig();
        $this->assertEquals('firstValue', $module->_getFirstField());
        $this->assertEquals('secondValue', $module->_getSecondField());
    }

    public function testConflictsByModuleName()
    {
        $this->setExpectedException('Codeception\Exception\ModuleConflictException');
        $this->moduleContainer->create('Codeception\Lib\ConflictedModule');
        $this->moduleContainer->create('Cli');
        $this->moduleContainer->validateConflicts();
    }


    public function testConflictsByClass()
    {
        $this->setExpectedException('Codeception\Exception\ModuleConflictException');
        $this->moduleContainer->create('Codeception\Lib\ConflictedModule2');
        $this->moduleContainer->create('Cli');
        $this->moduleContainer->validateConflicts();
    }

    public function testConflictsByInterface()
    {
        $this->setExpectedException('Codeception\Exception\ModuleConflictException');
        $this->moduleContainer->create('Codeception\Lib\ConflictedModule3');
        $this->moduleContainer->create('Symfony2');
        $this->moduleContainer->validateConflicts();
    }

    public function testModuleDependenciesFail()
    {
        $this->setExpectedException('Codeception\Exception\ModuleRequireException');
        $this->moduleContainer->create('Codeception\Lib\DependencyModule');
    }

    public function testModuleDependencies()
    {
        $config = ['modules' => [
            'enabled' => ['Codeception\Lib\DependencyModule'],
            'config' => [
                'Codeception\Lib\DependencyModule' => [
                    'depends' => 'Codeception\Lib\ConflictedModule'
                ]
            ]
        ]];
        $this->moduleContainer = new ModuleContainer(Stub::make('Codeception\Lib\Di'), $config);
        $this->moduleContainer->create('Codeception\Lib\DependencyModule');
        $this->moduleContainer->hasModule('\Codeception\Lib\DependencyModule');
    }

    public function testModuleParts1()
    {
        $config = ['modules' => [
            'enabled' => ['\Codeception\Lib\PartedModule'],
            'config' => [
                '\Codeception\Lib\PartedModule' => [
                    'part' => 'one'
                ]
            ]
        ]];
        $this->moduleContainer = new ModuleContainer(Stub::make('Codeception\Lib\Di'), $config);
        $this->moduleContainer->create('\Codeception\Lib\PartedModule');
        $actions = $this->moduleContainer->getActions();
        $this->assertArrayHasKey('partOne', $actions);
        $this->assertArrayNotHasKey('partTwo', $actions);
    }

    public function testModuleParts2()
    {
        $config = ['modules' => [
            'enabled' => ['\Codeception\Lib\PartedModule'],
            'config' => ['\Codeception\Lib\PartedModule' => [
                    'part' => ['Two']
                ]
            ]
        ]];
        $this->moduleContainer = new ModuleContainer(Stub::make('Codeception\Lib\Di'), $config);
        $this->moduleContainer->create('\Codeception\Lib\PartedModule');
        $actions = $this->moduleContainer->getActions();
        $this->assertArrayHasKey('partTwo', $actions);
        $this->assertArrayNotHasKey('partOne', $actions);
    }

    public function testShortConfigParts()
    {
        $config = ['modules' => [
            'enabled' => [['\Codeception\Lib\PartedModule' => [
                'part' => 'one'
            ]]],
        ]];
        $this->moduleContainer = new ModuleContainer(Stub::make('Codeception\Lib\Di'), $config);
        $this->moduleContainer->create('\Codeception\Lib\PartedModule');
        $actions = $this->moduleContainer->getActions();
        $this->assertArrayHasKey('partOne', $actions);
        $this->assertArrayNotHasKey('partTwo', $actions);


    }

    public function testShortConfigFormat()
    {
        $config = ['modules' =>
            ['enabled' => [
                ['Codeception\Lib\StubModule' => [
                    'firstField' => 'firstValue',
                    'secondField' => 'secondValue',
                ]]
            ]
        ]];

        $this->moduleContainer = new ModuleContainer(Stub::make('Codeception\Lib\Di'), $config);
        $module = $this->moduleContainer->create('Codeception\Lib\StubModule');

        $this->assertEquals('firstValue', $module->_getFirstField());
        $this->assertEquals('secondValue', $module->_getSecondField());

    }

    public function testShortConfigDependencies()
    {
        $config = ['modules' => [
            'enabled' => [['Codeception\Lib\DependencyModule' => [
                'depends' => 'Codeception\Lib\ConflictedModule'
            ]]],
        ]];
        $this->moduleContainer = new ModuleContainer(Stub::make('Codeception\Lib\Di'), $config);
        $this->moduleContainer->create('Codeception\Lib\DependencyModule');
        $this->moduleContainer->hasModule('\Codeception\Lib\DependencyModule');
    }

    public function testInjectModuleIntoHelper()
    {
        $config = ['modules' => [
            'enabled' => ['Codeception\Lib\HelperModule'],
        ]];
        $this->moduleContainer = new ModuleContainer(Stub::make('Codeception\Lib\Di'), $config);
        $this->moduleContainer->create('Codeception\Lib\HelperModule');
        $this->moduleContainer->hasModule('Codeception\Lib\HelperModule');
    }

}

class StubModule extends Module
{
    protected $requiredFields = [
        'firstField',
        'secondField',
    ];

    public function _getFirstField()
    {
        return $this->config['firstField'];
    }

    public function _getSecondField()
    {
        return $this->config['secondField'];
    }

}




class HelperModule extends Module
{
    function _inject(ConflictedModule $module)
    {
        $this->module = $module;
    }
}

class ConflictedModule extends Module implements ConflictsWithModule
{
    public function _conflicts()
    {
        return 'Cli';
    }
}

class ConflictedModule2 extends Module implements ConflictsWithModule
{
    public function _conflicts()
    {
        return '\Codeception\Module\Cli';
    }
}

class ConflictedModule3 extends Module implements ConflictsWithModule
{
    public function _conflicts()
    {
        return 'Codeception\Lib\Interfaces\Web';
    }
}

class DependencyModule extends Module implements DependsOnModule
{
    public function _depends()
    {
        return ['Codeception\Lib\ConflictedModule' => 'Error message'];
    }

    public function _inject()
    {
    }
}

class PartedModule extends Module implements Interfaces\PartedModule
{
    public function _parts()
    {
        return ['one'];
    }

    /**
     * @part one
     */
    public function partOne()
    {

    }

    /**
     * @part two
     */
    public function partTwo()
    {

    }
}
