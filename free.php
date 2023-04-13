<?php

// Set up the bot
$botToken = '5914374647:AAGDU7ayUsVL3pAwp85S1boyn-BsXAnYeNE'; // Replace with your actual bot token
$chatId = '@CryptoSignalHQ';
$apiUrl = "https://api.telegram.org/bot$botToken/sendMessage";

$apiKey = "nHiBNHtobep1o3bQwo"; // Replace with your actual API key
$apiEndpoint = "https://api.bybit.com/v2/public/tickers?symbol=BTCUSD";
$response = getApiResponseWithExponentialBackoff($apiEndpoint, $apiKey);
// Retry the API request up to a maximum number of times
$maxAttempts = 5;
$attempts = 0;
$retryDelay = 60; // in seconds

while ($response === false && $attempts < $maxAttempts) {
    sleep($retryDelay);
    $response = getApiResponseWithExponentialBackoff($apiEndpoint, $apiKey);
    $attempts++;
}

// If the response is still false after retrying, exit the script
if ($response === false) {
    echo "Error: Unable to retrieve valid API response after {$maxAttempts} attempts.";
    exit;
}

function getApiResponseWithExponentialBackoff($url, $apiKey = null): false|string
{
    $attempts = 5;
    $delay = 1000000; // 1 second in microseconds

    for ($i = 0; $i < $attempts; $i++) {
        // Add API key to headers if provided
        $options = [
            'http' => [
                'method' => "GET"
            ]
        ];
        if ($apiKey !== null) {
            $options['http']['header'] = "api_key: $apiKey";
        }
        $context = stream_context_create($options);

        $response = @file_get_contents($url, false, $context);

        if ($response !== false) {
            return $response;
        }

        usleep($delay); // Wait before trying again
        $delay *= 2; // Double the delay for the next attempt
    }

    return false;
}


$data = json_decode($response, true);
$data = is_array($data) ? $data : [];

if (array_key_exists('result', $data)) {
    $ticker = $data['result'][0];
    if (isset($ticker['last_price'])) {
        $currentPrice = $ticker['last_price'];
    } else {
        echo "Error: Invalid API response";
        var_dump($response);
        return;
    }
} else {
    echo "Error: Invalid API response";
    var_dump($response);
    return;
}

// Set up the moving average parameters
$shortMA = 20;
$longMA = 50;
$ma = 0;
$lastSignal = null; // Initialize $lastSignal with null

// Set up the thresholds
$buyThreshold = 1.01;
$sellThreshold = 0.99;

// Set up the message limit
$messagesPerDay = rand(3, 10);
$messagesSentToday = 0;

/// Send a message function
function sendSignal($chatId, $message): false|string
{
    global $apiUrl, $botToken;
    $data = [
        'chat_id' => $chatId,
        'text' => $message,
    ];

    $options = [
        'http' => [
            'method' => 'POST',
            'header' => 'Content-type: application/x-www-form-urlencoded',
            'content' => http_build_query($data),
        ],
    ];
    $apiEndpoint = "https://api.coingecko.com/api/v3/simple/price?ids=bitcoin&vs_currencies=usd";
    return getApiResponseWithExponentialBackoff($apiEndpoint);
}


function movingAverage($array, $period): array
{
    $output = array();
    for ($i = $period; $i < count($array); $i++) {
        $sum = 0;
        for ($j = $i - $period; $j < $i; $j++) {
            if (isset($array[$j])) {
                $sum += $array[$j];
            }
        }
        if (isset($array[$i]) && isset($array[$i - $period]) && $i - $period - 1 >= 0 && isset($output[$i - $period - 1])) {
            $output[] = $output[$i - $period - 1] + ($array[$i] - $array[$i - $period]) / $period;
        } else {
            $output[] = null;
        }
    }
    return $output;
}

// Fetch historical price data function
function fetchHistoricalPriceData($symbol, $interval, $days): array
{
    $endTime = time();
    $startTime = strtotime("-$days days");
    $apiEndpoint = "https://api.bybit.com/v2/public/klines?symbol=$symbol&interval=$interval&from=$startTime&to=$endTime";
    $response = getApiResponseWithExponentialBackoff($apiEndpoint);
    $data = json_decode($response, true);

    if ($data === null || !isset($data['result'])) {
        return [];
    } else {
        return array_map(function ($priceData) {
            return isset($priceData['close']) ? (float)$priceData['close'] : null;
        }, $data['result']);
    }
}


// Set up the message limit
$messagesPerDay = 1;
$signalsSent = 0;
$maxRetries = 5;
while (true) {
// Get the current price from the API
    $response = null; // Initialize $response with null
    for ($i = 0; $i < $maxRetries; $i++) {
        $response = getApiResponseWithExponentialBackoff($apiEndpoint);
        if ($response !== false) {
            break;
        }
        sleep($retryDelay); // Add a delay between API requests
    }
    // Decode the API response
    $data = json_decode($response);

// Check if the API response is valid
    if ($response !== false) {
        $data = json_decode($response, true);
        if (isset($data['result']) && isset($data['result'][0]['last_price'])) {
            $currentPrice = $data['result'][0]['last_price'];
        } else {
            echo "Error: Invalid trading symbol in API response";
            var_dump($response);
        }
    } else {
        echo "Error: Failed to fetch data from the Bybit API";
    }


// Calculate the moving averages
    $priceData = fetchHistoricalPriceData('BTCUSD', '1D', $longMA + 1);

    if (!empty($priceData)) {
        $prices = array_merge($priceData, [$currentPrice]);
    } else {
        $prices = [$currentPrice];
    }

    $shortPrices = array_slice($prices, -$shortMA);
    $longPrices = array_slice($prices, -$longMA);
    $shortMAValues = movingAverage($shortPrices, $shortMA);
    $longMAValues = movingAverage($longPrices, $longMA);


// Calculate the potential profit and loss for different target levels
    $targets = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
    $potentialProfits = [];
    $potentialLosses = [];

    foreach ($targets as $target) {
        $buyPrice = 0;
        if ($ma == 1) {
            // Buy signal
            $sellPrice = round($currentPrice * (1 + $target / 100), 2);
            $stopPrice = round($currentPrice * (1 - $target / 100), 2);
            $buyPrice = $currentPrice;
            $potentialProfit = round(($sellPrice - $buyPrice) / $buyPrice * 100, 2);
            $potentialLoss = round(($stopPrice - $buyPrice) / $buyPrice * 100, 2);
        } else {
            // Sell signal
            $sellPrice = round($currentPrice * (1 - $target / 100), 2);
            $stopPrice = round($currentPrice * (1 + $target / 100), 2);
            $buyPrice = $currentPrice;
            $potentialProfit = round(($buyPrice - $sellPrice) / $sellPrice * 100, 2);
            $potentialLoss = round(($buyPrice - $stopPrice) / $buyPrice * 100, 2);
        }
        $potentialProfits[$target] = $potentialProfit;
        $potentialLosses[$target] = $potentialLoss;
    }

// Choose the target levels that maximize the potential profit and minimize the potential loss
    $maxProfitTarget = array_keys($potentialProfits, max($potentialProfits))[0];
    $minLossTarget = array_keys($potentialLosses, min($potentialLosses))[0];


// Use the chosen target levels in the signal message
    $takeProfitTargets = "$maxProfitTarget%, " . ($maxProfitTarget + 1) . "%, " . ($maxProfitTarget + 2) . "%";
    $stopTargets = "$minLossTarget%, " . ($minLossTarget + 1) . "%, " . ($minLossTarget + 2) . "%";

// Check if a signal should be sent
    if ($ma != $lastSignal && ($ma == 1 && $currentPrice >= $buyThreshold * $longMAValues[count($longMAValues) - 1] ||
            $ma == -1 && $currentPrice <= $sellThreshold * $longMAValues[count($longMAValues) - 1])) {
        // Calculate moving averages
        $shortPeriod = 20;
        $longPeriod = 50;

        $shortMA = movingAverage($prices, $shortPeriod);
        $longMA = movingAverage($prices, $longPeriod);

// Get the last value of the calculated moving averages
        $lastShortMA = end($shortMA);
        $lastLongMA = end($longMA);

// Define entry and exit zones based on the current price
        $entryZoneStart = round($currentPrice * 0.995, 2);
        $entryZoneEnd = round($currentPrice * 1.005, 2);
        $signalType = $shortMAValues[count($shortMAValues) - 1] > $longMAValues[count($longMAValues) - 1] ? "Bullish" : "Bearish";

// Create the new signal message using the variables
        $newSignalMessage = "💲| Pair: #BTCUSDT\n";
        $newSignalMessage .= "🚀| Entry Zone: $entryZoneStart - $entryZoneEnd\n";
        $newSignalMessage .= "———————————————\n";
        $newSignalMessage .= "📍| Take-Profit Targets: $takeProfitTargets\n";
        $newSignalMessage .= "💢| Stop Targets: $stopTargets\n";
        $newSignalMessage .= "——————————————\n";
        $newSignalMessage .= "⬆️| Signal Type: $signalType\n";

// Send the signal message
        sendSignal($chatId, $newSignalMessage);

        $buyPrice = round($currentPrice * $buyThreshold, 2);
        $sellPrice = round($currentPrice * $sellThreshold, 2);

// Wait for the price to hit the entry zone
        while ($currentPrice < $entryZoneStart || $currentPrice > $entryZoneEnd) {
            usleep(60000000);
            $response = getApiResponseWithExponentialBackoff($apiEndpoint, $apiKey);
            $data = json_decode($response, true);
            $currentPrice = $data['result'][0]['last_price'] ?? null;
        }

// Check if the buy price or sell price has been reached
        if ($currentPrice >= $buyPrice || $currentPrice <= $sellPrice) {
            // Determine the type of signal
            if ($ma == 1) {
                $signal = '🔥| Take Profit!';
            } else {
                $signal = '⚠️| Stop Loss Hit!';
            }
// Create the signal message
            $message = "Signal: $signal\n";
            $message .= "———————————————\n";
            $message .= "🟢| Buy bitcoin at: $buyPrice\n";
            $message .= "———————————————\n";
            $message .= "🔴| Sell bitcoin at: $sellPrice\n";
            $message .= "———————————————\n";
// Calculate the profit/loss and add it to the message
            $entryPrice = $ma == 1 ? $buyPrice : $sellPrice;
            $exitPrice = $ma == 1 ? $sellPrice : $buyPrice;
            $profit = round((($exitPrice - $entryPrice) / $entryPrice) * 100, 2);
            if ($profit > 0) {
                $message .= "✅| Profit: $profit%\n";
            } else {
                $message .= "❌| Loss: " . abs($profit) . "%\n";
            }
// Send the signal message
            sendSignal($chatId, $message);
            // Update the last signal and increment the number of signals sent
            $lastSignal = $ma;
            $signalsSent++;
        }
    }
}