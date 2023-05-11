# CryptoSignalHQ

This is an automated cryptocurrency trading bot that uses different trading strategies and indicators for buying and
selling crypto assets. It fetches historical price data, calculates volatility, moving averages, and trading signals.
It sends signals via Telegram when it decides to buy or sell.

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing
purposes.

### Prerequisites

This project is built in PHP. You need to have PHP installed on your machine. You can download PHP
from [here](https://www.php.net/).

### Installation

1. Clone the repo
   ```bash
   git clone https://github.com/Jelmer-Ketelaar/CryptoSignalHQ/tree/develop
   ```
2. Install the required packages (if any)

### Usage

1. Update the API endpoints, keys, and tokens in the code.
2. Run the bot by executing the PHP file from the command line: ```**php index.php**```


## Features

- Fetches historical price data for a specified cryptocurrency
- Calculates simple moving averages (SMA)
- Calculates volatility
- Uses a moving average crossover strategy to decide when to buy and sell
- Sends trading signals via Telegram

## Code Snippet

Here's a basic snippet of the bot's functionality:

```php
<?php
// Fetch historical price data
$priceData = fetchHistoricalData($crypto);

// Calculate SMA
$sma = calculateSMA($priceData);

// Calculate volatility
$volatility = calculateVolatility($priceData);

// Generate signals based on SMA and volatility
$signals = generateSignals($sma, $volatility);

// Send signals via Telegram
sendSignalsViaTelegram($signals);
?>
```

## License

Distributed under the MIT License. See `LICENSE` for more information.

## Contact

Your Name - [jelmerketelaar487@gmail.com](mailto:jelmerketelaar487@gmail.com)

Project Link: [https://github.com/Jelmer-Ketelaar/CryptoSignalHQ/tree/develop](https://github.com/Jelmer-Ketelaar/CryptoSignalHQ/tree/develop)
