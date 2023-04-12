<?php
namespace Codeception\Exception;

use Codeception\Util\Locator;
use PHPUnit_Framework_AssertionFailedError;

class ElementNotFound extends PHPUnit_Framework_AssertionFailedError
{
    public function __construct($selector, $message = null)
    {
        $selector = Locator::humanReadableString($selector);
        parent::__construct($message . " element with $selector was not found.");
    }
}
