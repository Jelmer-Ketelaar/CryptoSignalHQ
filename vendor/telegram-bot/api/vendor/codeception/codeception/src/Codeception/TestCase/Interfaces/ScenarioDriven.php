<?php
namespace Codeception\TestCase\Interfaces;

use Codeception\Scenario;

interface ScenarioDriven
{
    public function getFeature();

    /**
     * @return Scenario
     */
    public function getScenario();

    public function getScenarioText($format = 'text');

    public function preload();

    public function getRawBody();
}
