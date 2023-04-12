<?php

use Codeception\Exception\ModuleConfigException;
use Codeception\Module\CodeHelper;

class ModuleConfigTest extends PHPUnit_Framework_TestCase
{
    // tests
    public function testCanBeCreatedForModuleName()
    {
        $exception = new ModuleConfigException('Codeception\Module\WebDriver', "Hello world");
        $this->assertEquals("WebDriver module is not configured!\n \nHello world", $exception->getMessage());
    }

    public function testCanBeCreatedForModuleObject()
    {
        $exception = new ModuleConfigException(new CodeHelper(make_container()), "Hello world");
        $this->assertEquals("CodeHelper module is not configured!\n \nHello world", $exception->getMessage());
    }

}
