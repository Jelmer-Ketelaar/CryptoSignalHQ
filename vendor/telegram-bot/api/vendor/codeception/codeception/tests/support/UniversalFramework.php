<?php
namespace Codeception\Module;

use Codeception\Configuration;
use Codeception\Lib\Connector\Universal;
use Codeception\Lib\Framework;

class UniversalFramework extends Framework
{
    public function __construct()
    {
        $index = '/app/index.php';
        $this->client = new Universal();
        $this->client->setIndex(Configuration::dataDir().$index);
    }
}
