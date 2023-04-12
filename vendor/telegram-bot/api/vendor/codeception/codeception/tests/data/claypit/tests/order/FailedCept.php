<?php

use Codeception\Module\OrderHelper;

$scenario->group('simple');
OrderHelper::appendToFile('S');
$I = new OrderGuy($scenario);
$I->wantTo('write a marker and fail');
$I->appendToFile('T');
$I->failNow();
