<?php

// Set up the bot
error_log("Set up the bot");
$botToken = '6210861627:AAEpc33rfScvwihZrhTnHhOcfqY3_ohATag';
$chatId = '@CryptoSignalHQ_VIP';

// Set up the message limit
error_log("Set up the message limit");
$messagesPerDay = rand(3, 10);
include "include/mainCode.php";