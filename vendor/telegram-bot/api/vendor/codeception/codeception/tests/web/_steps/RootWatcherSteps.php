<?php
namespace WebGuy;

use WebGuy;

class RootWatcherSteps extends WebGuy
{
    public function seeInRootPage($selector)
    {
        $I = $this;
        $I->amOnPage('/');
        $I->see($selector);
    }
}
