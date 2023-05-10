<?php
/** @noinspection ALL */
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

// Initialize variables
$shortSMAValues = array();
$longSMAValues = array();

$lastSignal = null; // Initialize $lastSignal with null

// Set up the moving average parameters
$shortSMA = 20;
$longSMA = 50;
$ma = 0;

// Set up the bot
error_log("Set up the bot");
$botToken = '6210861627:AAEpc33rfScvwihZrhTnHhOcfqY3_ohATag';
$apiUrl = "https://api.telegram.org/bot$botToken/sendMessage";
$chatId = '@CryptoSignalHQ_VIP';

$apiKey = "nHiBNHtobep1o3bQwo"; // Replace with your actual API key
$apiEndpoint = "https://api.bybit.com/v2/public/tickers?symbol=BTCUSDT";

// Set up the maxRetries
$maxRetries = 5;

// Retry the API request up to a maximum number of times
$maxAttempts = 5;
$attempts = 0;
$retryDelay = 60; // in seconds

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

    error_log("Error: Unable to retrieve valid API response after $attempts attempts.");
    return false;
}

do {
    error_log("Do statement started");
    sleep($retryDelay);
    $response = getApiResponseWithExponentialBackoff($apiEndpoint, $apiKey);
    $attempts++;
} while ($response === false && $attempts < $maxAttempts);

// If the response is still false after retrying, exit the script
if ($response === false) {
    error_log("Error: Unable to retrieve valid API response after $maxAttempts attempts.");
}

error_log("Script started.");

// Decode the JSON response into an associative array
$data = json_decode($response, true);

// Check if the API returned an error
if (isset($data['error'])) {
    error_log("API Error: {$data['error']}");
    exit;
}

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

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $maxAttempts = 5;

    for ($attempts = 1; $attempts <= $maxAttempts; $attempts++) {
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if ($httpCode == 200) {
            return $response;
        } elseif ($httpCode == 400) {
            error_log("Error: Telegram API response on attempt $attempts: HTTP code $httpCode");
            error_log("Error: Bad request. Please check the chat_id, message, and bot token.");
            break;
        } else {
            // Show the API response even if there is an error
            error_log("Error: Telegram API response on attempt $attempts: HTTP code $httpCode");
            error_log("Error: Unable to send message on attempt $attempts. Retrying...\n");
        }
    }

    curl_close($ch);
    return false;
}

function simpleMovingAverage($array, $period)
{
    error_log("SMA input: " . print_r($array, true));

    // Check input array
    if (!is_array($array) || count($array) == 0) {
        error_log("Error: Input array is empty or not an array.");
        return array();
    }

    // Check period value
    if ($period <= 0) {
        error_log("Error: Invalid period for calculating simple moving average.");
        return array();
    }

    // Check data points
    if (count($array) < $period) {
        error_log("Error: Insufficient data for calculating simple moving average. Please provide a larger dataset.");
        return array();
    }

    $output = array();
    for ($i = 0; $i <= count($array) - $period; $i++) {
        $sum = 0;
        for ($j = $i; $j < $i + $period; $j++) {
            $sum += $array[$j];
        }
        $output[] = $sum / $period;
    }

    // Log the output of the function
    error_log("SMA output: " . print_r($output, true));

    return $output;
}

function fetchHistoricalPriceData($symbol, $intervalInSeconds, $dataPoints)
{
    $shortSMA = 10; // Define your short period value
    $longSMA = 30; // Define your long period value

    error_log("Started fetchHistoricalPriceData");
    $now = time(); // Get the current timestamp
    $from = $now - ($intervalInSeconds * $dataPoints); // Calculate the 'from' timestamp dynamically

    $intervalInMinutes = max(1, $intervalInSeconds / 60);
    $apiEndpoint = "https://api.bybit.com/v2/public/kline/list?symbol=$symbol&interval=$intervalInMinutes&from=$from&limit=$dataPoints";
    $response = getApiResponseWithExponentialBackoff($apiEndpoint);

    if (empty($response)) {
        error_log("Error: Empty API response received. Response: " . print_r($response, true));
        return ['prices' => [], 'shortMAValues' => [], 'longMAValues' => []];
    }

    $data = json_decode($response, true);

    if (isset($data['result']) && is_array($data['result']) && count($data['result']) > 0) {
        $prices = array_map(function ($priceData) {
            return isset($priceData['close']) ? (float)$priceData['close'] : 0;
        }, $data['result']);
    } else {
        error_log("Error: Unable to retrieve valid API response. API response content: " . $response);
        return ['prices' => [], 'shortMAValues' => [], 'longMAValues' => []];
    }

    error_log("Price data: " . print_r($prices, true)); // Debug output

    $shortPeriod = $shortSMA;
    $longPeriod = $longSMA;
    $shortSMAValues = simpleMovingAverage($prices, $shortPeriod);
    $longSMAValues = simpleMovingAverage($prices, $longPeriod);

    if (count($shortSMAValues) < 1 || count($longSMAValues) < 1) {
        error_log("Error: Moving average arrays are empty or have length less than 1.");
        return ['prices' => [], 'shortMAValues' => [], 'longMAValues' => []];
    }

    // Debug output
    error_log("Short MA values: " . print_r($shortSMAValues, true));
    error_log("Long MA values: " . print_r($longSMAValues, true));
    error_log("Short MA count: " . count($shortSMAValues));
    error_log("Long MA count: " . count($longSMAValues));

    return array('prices' => $prices, 'shortMAValues' => $shortSMAValues, 'longMAValues' => $longSMAValues);
}

$shortPeriod = 10;
$longPeriod = 30;
$historicalData = fetchHistoricalPriceData("BTCUSD", 60, $shortPeriod + $longPeriod + 500);

// No need to call simpleMovingAverage() again, since it's already called inside fetchHistoricalPriceData()
$shortSMAValues = $historicalData['shortMAValues'];
$longSMAValues = $historicalData['longMAValues'];

error_log("Last short MA value: " . end($shortSMAValues));
error_log("Last long MA value: " . end($longSMAValues));

if (!is_array($shortSMAValues) || !is_array($longSMAValues)) {
    echo "Error: shortSMAValues and longSMAValues must be arrays.\n";
} elseif (count($shortSMAValues) < $shortPeriod || count($longSMAValues) < $longPeriod) {
    echo "Error: Insufficient data for calculating moving averages. Please provide a larger dataset.\n";
}
function calculateVolatility($symbol, $interval, $dataPoints)
{
    if ($interval <= 0 || $dataPoints <= 0) {
        return 0.01; // Set a default value for $volatility
    }
    $historicalData = fetchHistoricalPriceData($symbol, $interval, $dataPoints);
    $prices = $historicalData['prices'];

    if (empty($prices)) {
        return 0.01; // Set a default value for $volatility if prices array is empty
    }

    // Calculate standard deviation of price changes
    $changes = array();
    for ($i = 1; $i < count($prices); $i++) {
        $change = log($prices[$i] / $prices[$i - 1]);
        $changes[] = $change;
    }
    $stddev = calculateStandardDeviation($changes);

    // Debug output
    error_log("Prices: " . print_r($prices, true));
    error_log("Changes: " . print_r($changes, true));
    error_log("Standard deviation: " . $stddev);

    // Calculate volatility based on standard deviation
    return $stddev * sqrt(365 / $interval);
}

function calculateFixedPercentage($volatility)
{
    // Define the minimum and maximum percentage values you want to use
    $minPercentage = 0.01;
    $maxPercentage = 0.02;

    // Define the volatility range in which you want to vary the percentage
    $minVolatility = 0.001;
    $maxVolatility = 0.005;

    // Calculate the percentage based on the volatility
    if ($volatility <= $minVolatility) {
        return $maxPercentage;
    } elseif ($volatility >= $maxVolatility) {
        return $minPercentage;
    } else {
        $percentageRange = $maxPercentage - $minPercentage;
        $volatilityRange = $maxVolatility - $minVolatility;
        $percentagePerVolatility = $percentageRange / $volatilityRange;
        return $maxPercentage - ($volatility - $minVolatility) * $percentagePerVolatility;
    }
}

// Calculate the volatility based on historical prices
$volatility = calculateVolatility("BTCUSD", 60, 500);
error_log("Calculated Volatility: " . $volatility);

error_log("Last short MA value: " . $shortSMAValues[count($shortSMAValues) - 1]);
error_log("Last long MA value: " . $longSMAValues[count($longSMAValues) - 1]);

if ($volatility === null) {
    $volatility = 0.01; // Set a default value for $volatility
}

if (count($shortSMAValues) < 1 || count($longSMAValues) < 1) {
    error_log("Error: Moving average arrays are empty or have length less than 1.");
    return ['prices' => [], 'shortMAValues' => [], 'longMAValues' => []];
}

// Calculate the moving averages
$shortSMAValues = simpleMovingAverage($historicalData['prices'], $shortPeriod);
$longSMAValues = simpleMovingAverage($historicalData['prices'], $longPeriod);

if (!is_array($shortSMAValues) || !is_array($longSMAValues)) {
    echo "Error: shortSMAValues and longSMAValues must be arrays.\n";
} elseif (count($shortSMAValues) < $shortPeriod || count($longSMAValues) < $longPeriod) {
    echo "Error: Insufficient data for calculating moving averages. Please provide a larger dataset.\n";
}

// Calculate the fixed percentage based on the current market conditions
$fixedPercentage = calculateFixedPercentage($volatility);

// Set the buy threshold based on the current market conditions
$shortMA = $shortSMAValues[count($shortSMAValues) - 1];
$longMA = $longSMAValues[count($longSMAValues) - 1];

if ($shortMA > $longMA) {
    // If short-term moving average crosses above long-term moving average, set the buy threshold
    $buyThreshold = $longMA + ($shortMA - $longMA) * ($fixedPercentage * 0.95);
} else {
    // If short-term moving average crosses below long-term moving average, set the buy threshold to be a fixed percentage above the short MA
    $buyThreshold = $shortMA + $shortMA * $fixedPercentage;
}

$sellThreshold = $longMA * (1 - $fixedPercentage * 0.1);

error_log("Buy Threshold: " . $buyThreshold);
error_log("Sell Threshold: " . $sellThreshold);

function calculateStandardDeviation($arr)
{
    $num_of_elements = count($arr);

    if ($num_of_elements === 0) {
        return null; // or whatever value you want to return in this case
    }

    $variance = 0.0;
    $average = array_sum($arr) / $num_of_elements;

    foreach ($arr as $i) {
        $variance += pow(($i - $average), 2);
    }

    return sqrt($variance / $num_of_elements);
}

function calculateTradingSignal($prices, $support, $resistance)
{
    $maLength = 10;
    $macdFastLength = 12;
    $macdSlowLength = 26;
    $bbLength = 20;
    $bbMultiplier = 2;
    $rsiPeriod = 14;
    $tenkanLength = 9;
    $kijunLength = 26;
    $senkouLength = 52;

    $combinedIndicator = null;
    if (count($prices) >= max($maLength, $macdFastLength, $macdSlowLength, $bbLength, $rsiPeriod, $tenkanLength, $kijunLength, $senkouLength)) {
        // Calculate the moving averages
        $ma = array_sum(array_slice($prices, -$maLength)) / $maLength;

        // Calculate the RSI
        $avgGain = 0;
        $avgLoss = 0;
        for ($i = 1; $i < count($prices); $i++) {
            $diff = $prices[$i] - $prices[$i - 1];
            if ($diff > 0) {
                $avgGain = ($avgGain * ($rsiPeriod - 1) + $diff) / $rsiPeriod;
            } else if ($diff < 0) {
                $avgLoss = ($avgLoss * ($rsiPeriod - 1) - $diff) / $rsiPeriod;
            }
        }
        $rs = ($avgLoss == 0) ? 1 : ($avgGain / $avgLoss);
        $rsi = 100 - (100 / (1 + $rs));

        // Calculate the MACD
        $ema1 = array_sum(array_slice($prices, -$macdFastLength)) / $macdFastLength;
        $ema2 = array_sum(array_slice($prices, -$macdSlowLength)) / $macdSlowLength;
        $macd = $ema1 - $ema2;

        // Calculate the Bollinger Bands
        $sma = array_sum(array_slice($prices, -$bbLength)) / $bbLength;
        $sd = 0;

        foreach (array_slice($prices, -$bbLength) as $price) {
            $sd += pow($price - $sma, 2);
        }

        $sd = sqrt($sd / $bbLength);
        $bbUpper = $sma + $bbMultiplier * $sd;
        $bbLower = $sma - $bbMultiplier * $sd;

        // Calculate the Ichimoku Kinko Hyo
        $tenkan = (max(array_slice($prices, -$tenkanLength)) + min(array_slice($prices, -$tenkanLength))) / 2;
        $kijun = (max(array_slice($prices, -$kijunLength)) + min(array_slice($prices, -$kijunLength))) / 2;
        $senkouA = ($tenkan + $kijun) / 2;
        $senkouB = (max(array_slice($prices, -$senkouLength)) + min(array_slice($prices, -$senkouLength))) / 2;

        // Combine the technical indicators
        $combinedIndicator = (float)($ma + $rsi + $macd + $bbUpper + $bbLower + $senkouA + $senkouB);
    }

    // Check if the price is near the support or resistance level
    $price = end($prices);
    if ($price <= $support * 1.01) {
        $combinedIndicator += 1; // Buy signal
    } elseif ($price >= $resistance * 0.99) {
        $combinedIndicator -= 1; // Sell signal
    }

    return $combinedIndicator;
}

function calculateMovingAverages($prices, $shortPeriod, $longPeriod)
{
    $shortSMAValues = array();
    $longSMAValues = array();
    $ma = array();

    // Calculate short moving averages
    for ($i = 0; $i < count($prices) - $shortPeriod + 1; $i++) {
        $shortSMAValues[] = array_sum(array_slice($prices, $i, $shortPeriod)) / $shortPeriod;
    }

    // Calculate long moving averages
    if ($longPeriod > count($prices)) {
        error_log("Error: Long period is greater than the number of prices.");
        return [$shortSMAValues, $longSMAValues, $ma];
    }

    for ($i = $longPeriod - 1; $i < count($prices); $i++) {
        $longSMAValues[] = array_sum(array_slice($prices, $i - $longPeriod + 1, $longPeriod)) / $longPeriod;
    }

    $ma['short'] = $shortSMAValues;
    $ma['long'] = $longSMAValues;

    return [$shortSMAValues, $longSMAValues, $ma];
}

$shortSMAValues = simpleMovingAverage($historicalData['prices'], $shortPeriod);
$longSMAValues = simpleMovingAverage($historicalData['prices'], $longPeriod);

if (!is_array($shortSMAValues) || !is_array($longSMAValues)) {
    echo "Error: shortSMAValues and longSMAValues must be arrays.\n";
} elseif (count($shortSMAValues) < $shortPeriod || count($longSMAValues) < $longPeriod) {
    echo "Error: Insufficient data for calculating moving averages. Please provide a larger dataset.\n";
}

function calculateSupportAndResistance($prices)
{
    $support = null;
    $resistance = null;
    $priceMax = max($prices);
    $priceMin = min($prices);

    $difference = $priceMax - $priceMin;
    $support = $priceMin + 0.25 * $difference;
    $resistance = $priceMax - 0.25 * $difference;

    return array($support, $resistance);
}

$historicalData = fetchHistoricalPriceData("BTCUSD", 30, $shortPeriod + $longPeriod + 300);
$prices = $historicalData['prices'];

list($support, $resistance) = calculateSupportAndResistance($prices);

// Call the calculateTradingSignal function
$tradingSignal = calculateTradingSignal($prices, $support, $resistance);

// Prepare the JSON response
$response = array(
    "timestamp" => time(),
    "calculateTradingSignal" => rand(0, 100) // Replace with your actual trading signal calculation
);

echo json_encode($response);

if (!empty($shortSMAValues)) {
    $lastShortMA = end($shortSMAValues);
}

if (!empty($longSMAValues)) {
    $lastLongMA = end($longSMAValues);
}

// Initialize the messages sent today counter
$messagesSentToday = 0;
$loopCounter = 0;
$lastSignalTime = time();
$today = date('Y-m-d'); // Keep track of the current day
while (true) {
    error_log("Main loop iteration: " . ++$loopCounter); // Log the current iteration
    // Get the current price from the API
    $response = getApiResponseWithExponentialBackoff($apiEndpoint, $apiKey);
    $data = json_decode($response, true);
    $currentPrice = $data['result'][0]['last_price'] ?? null;

    if ($currentPrice !== null) {
        error_log("Current price: $currentPrice");

        // Store the current price in the prices array
        $prices[] = $currentPrice;

        // Calculate the trading signal
        $combinedIndicator = calculateTradingSignal($prices, $support, $resistance);

        // Calculate the potential profit and loss for different target levels
        error_log("Calculating the potential profit and loss for different target levels");
        $targets = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
        $potentialProfits = [];
        $potentialLosses = [];

        // Update the value of $ma based on the moving averages
        if (!empty($shortSMAValues) && !empty($longSMAValues) && end($shortSMAValues) > end($longSMAValues)) {
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
        $minProfitThreshold = 1; // 1% minimum profit threshold
        $maxProfitTarget = array_keys($potentialProfits, max($potentialProfits))[0];
        $minLossTarget = array_keys($potentialLosses, min($potentialLosses))[0];


// Use the chosen target levels in the signal message
        error_log("Use the chosen target levels in the signal message");
        $maxProfitTarget = 0.05; // 5%
        $minLossTarget = 0.03; // 3%

        $takeProfitTargets = round($currentPrice * (1 + $maxProfitTarget), 2);
        $stopTargets = round($currentPrice * (1 - $minLossTarget), 2);

// Check if a signal should be sent
        error_log("Check if a signal should be sent");
        $details = '';
        if (count($shortSMAValues) > 0 && count($longSMAValues) > 0 &&
            $shortSMAValues[count($shortSMAValues) - 1] != $ma &&
            (($ma == 1 && $currentPrice >= $buyThreshold * $longSMAValues[count($longSMAValues) - 1]) ||
                ($shortSMAValues[count($shortSMAValues) - 1] > $longSMAValues[count($longSMAValues) - 1] && $currentPrice >= $buyThreshold * $longSMAValues[count($longSMAValues) - 1]) ||
                ($ma == -1 && $currentPrice <= $sellThreshold * $longSMAValues[count($longSMAValues) - 1])) &&
            ($maxProfitTarget > 0 || $minLossTarget < 0) && $maxProfitTarget >= $minProfitThreshold) {

            // Calculate moving averages
            error_log("Setting variables\n");
            $shortPeriod = 50;
            $longPeriod = 100;

            error_log("Calculating moving averages\n");
            // Calculate moving averages
            $shortSMAValues[] = calculateMovingAverages($prices, $shortPeriod, $longPeriod)[0];
            $longSMAValues[] = calculateMovingAverages($prices, $longPeriod, $shortPeriod)[1];


            // Get the last value of the calculated moving averages
            error_log("Get the last value of the calculated moving averages\n");
            $lastShortMA = end($shortSMAValues);
            $lastLongMA = end($longSMAValues);

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
            $newSignalMessage = "💰| Pair: #BTCUSDT\n";
            $newSignalMessage .= "🎫️️️| Entry Zone: $entryZoneStart - $entryZoneEnd\n";
            $newSignalMessage .= "———————————————\n";
            $newSignalMessage .= "📈️️️| Take-Profit Targets: $takeProfitTargets\n";
            $newSignalMessage .= "📉️️️| Stop Targets: $stopTargets\n";
            $newSignalMessage .= "———————————————\n";
            $newSignalMessage .= "Period ends at: " . $endTimeFormatted . "⏰";

            // Send the signal message
            echo("Sending the newSignalMessage \n");

            // Call the sendSignal function with the appropriate arguments
            sendSignal($chatId, $newSignalMessage);
            $messagesSentToday++; // Increment the messages sent today counter

            $currentDay = date('Y-m-d'); // Get the current day
            if ($currentDay != $today) {
                $today = $currentDay; // Update the day
                $messagesSentToday = 0; // Reset the messages sent today counter
            }

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
                    $signal = '📈️️️| Take Profit!';
                } else {
                    $signal = '📉️| Stop Loss!';
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

                // Check if the maximum number of messages have been sent for the day
                $maxMessagesPerDay = 10; // Maximum number of messages to be sent per day
                if ($messagesSentToday >= $maxMessagesPerDay) {
                    error_log("Maximum number of messages for the day has been reached.");
                    continue;
                }

                // Send the signal message
                error_log("Sending the signal message \n");
                sendSignal($chatId, $message);
                $messagesSentToday++; // Increment the messages sent today counter

                // Check if the current day is different from the last signal's day
                $currentDay = date('Y-m-d'); // Get the current day
                $lastSignalDay = date('Y-m-d', $lastSignalTime);

                if ($currentDay != $lastSignalDay) {
                    // A new day has begun, reset the messages sent today counter
                    $messagesSentToday = 0;
                    $lastSignalTime = time(); // update last signal time
                }

                // Ensure at least 3 messages are sent everyday
                if ($messagesSentToday < 3 && date('H') >= 21) { // if it's past 9 PM, and we haven't sent 3 messages
                    $signalsToSend = 3 - $messagesSentToday;
                    for ($i = 0; $i < $signalsToSend; $i++) {
                        // Create artificial signal message
                        $newSignalArtificalMessage = "💰| Pair: #BTCUSDT\n";
                        $newSignalArtificalMessage .= "🎫️️️| Entry Zone: Artificial Signal\n";
                        $newSignalArtificalMessage .= "———————————————\n";
                        $newSignalArtificalMessage .= "📈️️️| Take-Profit Targets: Artificial Signal\n";
                        $newSignalArtificalMessage .= "📉️️️| Stop Targets: Artificial Signal\n";
                        $newSignalArtificalMessage .= "———————————————\n";
                        $newSignalArtificalMessage .= "Period ends at: Artificial Signal ⏰";

                        // Send the signal message
                        echo("Sending the newSignalMessage \n");
                        // Call the sendSignal function with the appropriate arguments
                        sendSignal($chatId, $newSignalArtificalMessage);
                        $messagesSentToday++; // Increment the messages sent today counter
                        $lastSignalTime = time(); // update last signal time
                    }
                }

                // Check if the current day is different from the last signal's day
                $currentDay = date('Y-m-d'); // Get the current day
                $lastSignalDay = date('Y-m-d', $lastSignalTime);

                if ($currentDay != $lastSignalDay) {
                    // A new day has begun, reset the messages sent today counter
                    $messagesSentToday = 0;
                    $lastSignalTime = time(); // update last signal time
                }

                // Ensure at least 3 messages are sent everyday
                if ($messagesSentToday < 3 && date('H') >= 21) { // if it's past 9 PM and we haven't sent 3 messages
                    $signalsToSend = 3 - $messagesSentToday;
                    for ($i = 0; $i < $signalsToSend; $i++) {
                        // Create additional signal message based on last known trading data
                        $entryZoneStart = round($currentPrice * 0.995, 2);
                        $entryZoneEnd = round($currentPrice * 1.005, 2);

                        $takeProfitTargets = round($currentPrice * (1 + $maxProfitTarget), 2);
                        $stopTargets = round($currentPrice * (1 - $minLossTarget), 2);

                        $endTime = time() + $periodSeconds;
                        $endTimeFormatted = date('Y-m-d H:i:s', $endTime); // format end time as a string

                        $newSignalMessage = "💰| Pair: #BTCUSDT\n";
                        $newSignalMessage .= "🎫️️️| Entry Zone: $entryZoneStart - $entryZoneEnd\n";
                        $newSignalMessage .= "———————————————\n";
                        $newSignalMessage .= "📈️️️| Take-Profit Targets: $takeProfitTargets\n";
                        $newSignalMessage .= "📉️️️| Stop Targets: $stopTargets\n";
                        $newSignalMessage .= "———————————————\n";
                        $newSignalMessage .= "Period ends at: " . $endTimeFormatted . "⏰";

                        // Send the signal message
                        echo("Sending the newSignalMessage \n");
                        sendSignal($chatId, $newSignalMessage);
                        $messagesSentToday++; // Increment the messages sent today counter
                        $lastSignalTime = time(); // update last signal time
                    }
                }
            }
        } else {
            $details .= "Short MA count: " . count($shortSMAValues) . ", Long MA count: " . count($longSMAValues) . ". ";

            if (isset($shortSMAValues[count($shortSMAValues) - 1])) {
                $details .= "Last short MA value: " . $shortSMAValues[count($shortSMAValues) - 1] . ". ";
            }

            if (isset($longSMAValues[count($longSMAValues) - 1])) {
                $details .= "Last long MA value: " . $longSMAValues[count($longSMAValues) - 1] . ". ";
            }

            if ($ma == 1 && $currentPrice < $buyThreshold) {
                $details .= "The current price (" . $currentPrice . ") is below the buy threshold (" . $buyThreshold . "). ";
            }

            if (!empty($longSMAValues)) {
                if ($ma == -1 && $currentPrice > $sellThreshold) {
                    $details .= "The current price (" . $currentPrice . ") is above the sell threshold (" . $sellThreshold . "). ";
                }
            }

            if ($maxProfitTarget <= 0 && $minLossTarget >= 0) {
                $details .= "The target levels do not maximize potential profit or minimize potential loss. ";
                $details .= "Max profit target: " . $maxProfitTarget . ", Min loss target: " . $minLossTarget . ". ";
            }

            error_log("Signal not met. Details: " . $details);
        }
    }
    sleep(60);
}


