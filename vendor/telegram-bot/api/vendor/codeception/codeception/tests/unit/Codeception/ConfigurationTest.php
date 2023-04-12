<?php

use Codeception\Configuration;
use Codeception\Module\UniversalFramework;
use Codeception\Util\Stub;

class ConfigurationTest extends PHPUnit_Framework_TestCase
{

    public function setUp()
    {
        $this->config = Configuration::config();
    }

    protected function tearDown()
    {
        UniversalFramework::$includeInheritedActions = true;
        UniversalFramework::$onlyActions = [];
        UniversalFramework::$excludeActions = [];
    }

    /**
     * @group core
     */
    public function testSuites()
    {
        $suites = Configuration::suites();
        $this->assertContains('unit', $suites);
        $this->assertContains('cli', $suites);
    }

    /**
     * @group core
     */
    public function testFunctionForStrippingClassNames()
    {
        $matches = array();
        $this->assertEquals(1, preg_match('~\\\\?(\\w*?Helper)$~', '\\Codeception\\Module\\UserHelper', $matches));
        $this->assertEquals('UserHelper', $matches[1]);
        $this->assertEquals(1, preg_match('~\\\\?(\\w*?Helper)$~', 'UserHelper', $matches));
        $this->assertEquals('UserHelper', $matches[1]);
    }

    /**
     * @group core
     */
    public function testModules()
    {
        $settings = array('modules' => array('enabled' => array('EmulateModuleHelper')));
        $modules = Configuration::modules($settings);
        $this->assertContains('EmulateModuleHelper', $modules);
    }

}
