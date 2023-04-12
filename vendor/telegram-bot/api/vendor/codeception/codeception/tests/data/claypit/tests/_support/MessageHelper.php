<?php

namespace Codeception\Module;

use Codeception\Module;

class MessageHelper extends Module
{
    protected $config = [
        'message1' => 'DEFAULT MESSAGE1.',
        'message2' => 'DEFAULT MESSAGE2.',
        'message3' => 'DEFAULT MESSAGE3.',
        'message4' => 'DEFAULT MESSAGE4.',
    ];

    public function getMessage($name)
    {
        return $this->config[$name];
    }
}
