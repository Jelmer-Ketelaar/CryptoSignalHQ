<?php
// Here you can initialize variables that will for your tests
use Codeception\Configuration;
use Codeception\Util\Stub;

Configuration::$lock = true;

function make_container()
{
    return Stub::make('Codeception\Lib\ModuleContainer');
}

require_once Configuration::dataDir().'DummyOverloadableClass.php';
