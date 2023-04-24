<?php

error_reporting(E_ALL);
error_reporting(1);

// Set up the bot
error_log("Set up the bot");
$botToken = '5914374647:AAGDU7ayUsVL3pAwp85S1boyn-BsXAnYeNE';
$chatId = '@CryptoSignalHQ';
$apiKey = "nHiBNHtobep1o3bQwo"; // Replace with your actual API key
$apiEndpoint = "https://api.bybit.com/v2/public/tickers?symbol=BTCUSD";

// Set up the message limit
error_log("Set up the message limit");
$messagesPerDay = rand(3, 10);

// Send a message function
$signalsSent = 0;
$maxRetries = 5;

// Retry the API request up to a maximum number of times
$maxAttempts = 5;
$attempts = 0;
$retryDelay = 30; // in seconds

do {

    error_log("Do statement started");
    sleep($retryDelay);
    $response = getApiResponseWithExponentialBackoff($apiEndpoint, $apiKey);
    $attempts++;
} while ($response === false && $attempts < $maxAttempts);

// If the response is still false after retrying, exit the script
if ($response === false) {
    error_log("Error: Unable to retrieve valid API response after {$maxAttempts} attempts.");
    exit;
}

function getApiResponseWithExponentialBackoff($url, $apiKey = null)
{
    $attempts = 5;
    $delay = 5000000; // 1 second in microseconds

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

        $response = file_get_contents($url, false, $context);

        if ($response !== false) {
            return $response;
        }

        usleep($delay); // Wait before trying again
        $delay *= 2; // Double the delay for the next attempt
    }

    error_log("Error: Unable to retrieve valid API response after {$attempts} attempts.");
    return false;
}


error_log("Script started.");

$data = json_decode($response, true);
$data = is_array($data) ? $data : [];

if (array_key_exists('result', $data)) {
    $ticker = $data['result'][0];
    if (isset($ticker['last_price'])) {
        $currentPrice = $ticker['last_price'];
    } else {
        error_log("Error: Invalid API response");
        var_dump($response);
        return;
    }
} else {
    error_log("Error: Invalid API response");
    var_dump($response);
    return;
}

// Set up the moving average parameters
error_log("Setting up the moving average parameters");
$shortMA = 20;
$longMA = 50;
$ma = 0;

$lastSignal = null; // Initialize $lastSignal with null

// Set up the thresholds
$buyThreshold = 1.0001;
$sellThreshold = 0.9999;

error_log("Test message");
error_log("Buy threshold: " . $buyThreshold);
error_log("Sell threshold: " . $sellThreshold);

// Send a message function
function sendSignal($chatId, $message)
{
    error_log("message function");
    $botToken = '6210861627:AAEpc33rfScvwihZrhTnHhOcfqY3_ohATag';
    $url = "https://api.telegram.org/bot$botToken/sendMessage";
    $data = [
        'chat_id' => $chatId,
        'text' => $message,
    ];
    error_log("data: " . print_r($data, true));
    $options = [
        'http' => [
            'method' => 'POST',
            'header' => 'Content-type: application/x-www-form-urlencoded',
            'content' => http_build_query($data),
        ],
    ];
    $options = stream_context_create($options);
    $maxAttempts = 5;

    for ($attempts = 1; $attempts <= $maxAttempts; $attempts++) {
        $response = file_get_contents($url, false, $options);

        if ($response !== false) {
            return $response;
        }

        // Show the API response even if there is an error
        if ($http_response_header) {
            error_log("Error: Telegram API response on attempt {$attempts}: " . json_encode($http_response_header));
        }
        error_log("Error: Unable to send message on attempt {$attempts}. Retrying...\n");
    }
    return false;
}

/**
 * Calculates the moving average of an array over a period of time.
 *
 * @param array $array The input array.
 * @param int $period The period over which to calculate the moving average.
 * @return array The moving average array.
 */
function movingAverage(array $array, int $period)
{
    error_log("Started movingAverage");
    if ($period <= 0 || count($array) < $period) {
        return [];
    }

    $output = array();
    for ($i = 0; $i <= count($array) - $period; $i++) {
        $sum = 0;
        // Sum the values of the input array over the given period
        for ($j = $i; $j < $i + $period; $j++) {
            $sum += $array[$j];
        }
        // Calculate the moving average and add it to the output array
        $output[] = $sum / $period;
    }
    // Log the output of the function
    error_log("Moving average output: " . print_r($output, true));

    return $output;
}

// Function to fetch historical price data for a symbol and interval
function fetchHistoricalPriceData($symbol, $interval, $dataPoints)
{
    error_log("Started fetchHistoricalPriceData");
    $apiEndpoint = "https://api.bybit.com/v2/public/kline/list?symbol=$symbol&interval=$interval&from=0&limit=$dataPoints";
    $response = getApiResponseWithExponentialBackoff($apiEndpoint);

    if (empty($response)) {
        error_log("Error: Empty API response received. Response: $response");
        return [];
    }

    $data = json_decode($response, true);

    if (!isset($data['result'])) {
        error_log("Error: Unable to retrieve valid API response. API response content: " . $response);
        return [];
    }

    return array_map(function ($priceData) {
        return isset($priceData['close']) ? (float)$priceData['close'] : 0;
    }, $data['result']);
}



$loopCounter = 0;
while (true) {
    error_log("Main loop iteration: " . ++$loopCounter); // Log the current iteration
// Get the current price from the API
    error_log("Get the current price from the API");
    $response = null; // Initialize $response with null
    for ($i = 0; $i < $maxRetries; $i++) {
        $response = getApiResponseWithExponentialBackoff($apiEndpoint);
        if ($response !== false) {
            error_log("Response is not false");
            break;
        }
        sleep($retryDelay); // Add a delay between API requests
    }
    // Decode the API response
    $data = json_decode($response);

    // Check if the API response is valid
    if ($response !== false) {
        error_log("");
        $data = json_decode($response, true);
        if (isset($data['result'][0]['last_price'])) {
            $currentPrice = $data['result'][0]['last_price'];
        } else {
            error_log("Error: Invalid trading symbol in API response \n");
            var_dump($response);
        }
    } else {
        error_log("Error: Failed to fetch data from the Bybit API \n");
    }

// Calculate the potential profit and loss for different target levels
    error_log("Calculating the potential profit and loss for different target levels");
    $targets = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
    $potentialProfits = [];
    $potentialLosses = [];

// Update the value of $ma based on the moving averages
    if (!empty($shortMAValues) && !empty($longMAValues) && $shortMAValues[count($shortMAValues) - 1] > $longMAValues[count($longMAValues) - 1]) {
        error_log("Update the value of ma based on the moving averages");
        $ma = 1; // Buy signal
    } else {
        $ma = -1; // Sell signal
    }

    foreach ($targets as $target) {
        $buyPrice = 0;
        if ($ma == 1) {
            // Buy signal
            error_log("Buy signal");
            $sellPrice = round($currentPrice * (1 + $target / 100), 2);
            $stopPrice = round($currentPrice * (1 - $target / 100), 2);
            $buyPrice = $currentPrice;
            $potentialProfit = round(($sellPrice - $buyPrice) / $buyPrice * 100, 2);
            $potentialLoss = round(($stopPrice - $buyPrice) / $buyPrice * 100, 2);
        } else {
            // Sell signal
            error_log("Sell signal");
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
    error_log("Choose the target levels that maximize the potential profit and minimize the potential loss");
    $maxProfitTarget = array_keys($potentialProfits, max($potentialProfits))[0];
    $minLossTarget = array_keys($potentialLosses, min($potentialLosses))[0];


    // Use the chosen target levels in the signal message
    error_log("Use the chosen target levels in the signal message");
    $maxProfitTarget = 0.1; // 10%
    $minLossTarget = 0.1; // 10%

    $takeProfitTargets = round($currentPrice * (1 + $maxProfitTarget), 2);
    $stopTargets = round($currentPrice * (1 - $minLossTarget), 2);

    // Check if a signal should be sent
    error_log("Check if a signal should be sent");
    if (count($shortMAValues) > 0 && count($longMAValues) > 0 && isset($shortMAValues[count($shortMAValues) - 1]) && isset($longMAValues[count($longMAValues) - 1])) {
        if ($shortMAValues[count($shortMAValues) - 1] != $ma && ($ma == 1 && $currentPrice >= $buyThreshold * $longMAValues[count($longMAValues) - 1] ||
                $ma == -1 && $currentPrice <= $sellThreshold * $longMAValues[count($longMAValues) - 1]) && ($maxProfitTarget > 0 || $minLossTarget < 0)) {
            // Calculate moving averages
            error_log("Setting variables\n");
            $shortPeriod = 50;
            $longPeriod = 100;

            error_log("Calculating moving averages\n");
            $shortMA = movingAverage($prices, $shortPeriod);
            $longMA = movingAverage($prices, $longPeriod);

            // Get the last value of the calculated moving averages
            error_log("Get the last value of the calculated moving averages\n");
            $lastShortMA = end($shortMA);
            $lastLongMA = end($longMA);

            // Define entry and exit zones based on the current price
            error_log(" Define entry and exit zones based on the current price\n");
            $entryZoneStart = round($currentPrice * 0.995, 2);
            $entryZoneEnd = round($currentPrice * 1.005, 2);

            $startTime = time(); // current time
            $periodDays = 1;
            $periodHours = 18;
            $periodMinutes = 1;
            $periodSeconds = ($periodDays * 24 * 60 * 60) + ($periodHours * 60 * 60) + ($periodMinutes * 60);

            $endTime = $startTime + $periodSeconds;
            $endTimeFormatted = date('Y-m-d H:i:s', $endTime); // format end time as a string
            echo "Period ends at: " . $endTimeFormatted;

            // Create the new signal message using the variables
            error_log("Create the new signal message using the variables\n");
            $newSignalMessage = "💲| Pair: #BTCUSDT\n";
            $newSignalMessage .= "🚀| Entry Zone: $entryZoneStart - $entryZoneEnd\n";
            $newSignalMessage .= "———————————————\n";
            $newSignalMessage .= "📍| Take-Profit Targets: $takeProfitTargets\n";
            $newSignalMessage .= "💢| Stop Targets: $stopTargets\n";
            $newSignalMessage .= "———————————————\n";
            $newSignalMessage .= "Period ends at: " . $endTimeFormatted . "⏰";

            // Send the signal message
            echo("Sending the newSignalMessage \n");

            // Call the sendSignal function with the appropriate arguments
            sendSignal($chatId, $newSignalMessage);

            if ($response === false) {
                error_log("Failed to send message.");
            } else {
                error_log("Message sent successfully.");
            }

            $buyPrice = round($currentPrice * $buyThreshold, 2);
            $sellPrice = round($currentPrice * $sellThreshold, 2);

            // Wait for the price to hit the entry zone
            while ($currentPrice < $entryZoneStart || $currentPrice > $entryZoneEnd) {
                error_log("Wait for the price to hit the entry zone\n");
                $response = getApiResponseWithExponentialBackoff($apiEndpoint, $apiKey);
                $data = json_decode($response, true);
                $currentPrice = $data['result'][0]['last_price'] ?? null;
            }

            // Check if the buy price or sell price has been reached
            if ($currentPrice >= $buyPrice || $currentPrice <= $sellPrice) {
                // Determine the type of signal
                error_log("Determine the type of signal\n");
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
                error_log("Calculate the profit/loss and add it to the message\n");
                $entryPrice = $ma == 1 ? $buyPrice : $sellPrice;
                $exitPrice = $ma == 1 ? $sellPrice : $buyPrice;
                $profit = round((($exitPrice - $entryPrice) / $entryPrice) * 100, 2);

                if ($profit > 0) {
                    $message .= "✅| Profit: $profit%\n";
                } else {
                    $message .= "❌| Loss: " . abs($profit) . "%\n";
                }

                // Send the signal message
                error_log("Sending the signal message \n");
                sendSignal($chatId, $message);
                $lastSignal = $shortMAValues[count($shortMAValues) - 1];
                $signalsSent++;
            }
        } else {
            error_log("Signal condition not met because:");

            $lastShortMAValue = end($shortMAValues);
            $lastLongMAValue = end($longMAValues);
            $maRatio = $lastShortMAValue / $lastLongMAValue;

            if (!($ma == 1 && $maRatio >= $buyThreshold ||
                $ma == -1 && $maRatio <= $sellThreshold)) {
                error_log("  - Buy or sell condition not met:");
                if ($ma == 1) {
                    error_log("    - Short MA (" . $lastShortMAValue . ") / Long MA (" . $lastLongMAValue . ") is " . $maRatio . " and should be >= " . $buyThreshold . " and <= " . $sellThreshold);
                } else {
                    error_log("    - Short MA (" . $lastShortMAValue . ") / Long MA (" . $lastLongMAValue . ") is " . $maRatio . " and should be <= " . $sellThreshold . " and >= " . $buyThreshold);
                }
            }
            sleep(30);
        }
    }
}