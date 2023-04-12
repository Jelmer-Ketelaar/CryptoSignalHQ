'use strict';

var kucoin$1 = require('../kucoin.js');
var errors = require('../base/errors.js');
var Cache = require('../base/ws/Cache.js');

//  ---------------------------------------------------------------------------
//  ---------------------------------------------------------------------------
class kucoin extends kucoin$1 {
    describe() {
        return this.deepExtend(super.describe(), {
            'has': {
                'ws': true,
                'watchOrderBook': true,
                'watchOrders': true,
                'watchMyTrades': true,
                'watchTickers': false,
                'watchTicker': true,
                'watchTrades': true,
                'watchBalance': true,
                'watchOHLCV': true,
            },
            'options': {
                'tradesLimit': 1000,
                'watchTicker': {
                    'name': 'market/snapshot', // market/ticker
                },
                'watchOrderBook': {
                    'snapshotDelay': 5,
                    'maxRetries': 3,
                },
            },
            'streaming': {
                // kucoin does not support built-in ws protocol-level ping-pong
                // instead it requires a custom json-based text ping-pong
                // https://docs.kucoin.com/#ping
                'ping': this.ping,
            },
        });
    }
    negotiate(privateChannel, params = {}) {
        const connectId = privateChannel ? 'private' : 'public';
        const urls = this.safeValue(this.options, 'urls', {});
        if (connectId in urls) {
            return urls[connectId];
        }
        // we store an awaitable to the url
        // so that multiple calls don't asynchronously
        // fetch different urls and overwrite each other
        urls[connectId] = this.spawn(this.negotiateHelper, privateChannel, params);
        this.options['urls'] = urls;
        return urls[connectId];
    }
    async negotiateHelper(privateChannel, params = {}) {
        let response = undefined;
        const connectId = privateChannel ? 'private' : 'public';
        if (privateChannel) {
            response = await this.privatePostBulletPrivate(params);
            //
            //     {
            //         code: "200000",
            //         data: {
            //             instanceServers: [
            //                 {
            //                     pingInterval:  50000,
            //                     endpoint: "wss://push-private.kucoin.com/endpoint",
            //                     protocol: "websocket",
            //                     encrypt: true,
            //                     pingTimeout: 10000
            //                 }
            //             ],
            //             token: "2neAiuYvAU61ZDXANAGAsiL4-iAExhsBXZxftpOeh_55i3Ysy2q2LEsEWU64mdzUOPusi34M_wGoSf7iNyEWJ1UQy47YbpY4zVdzilNP-Bj3iXzrjjGlWtiYB9J6i9GjsxUuhPw3BlrzazF6ghq4Lzf7scStOz3KkxjwpsOBCH4=.WNQmhZQeUKIkh97KYgU0Lg=="
            //         }
            //     }
            //
        }
        else {
            response = await this.publicPostBulletPublic(params);
        }
        const data = this.safeValue(response, 'data', {});
        const instanceServers = this.safeValue(data, 'instanceServers', []);
        const firstInstanceServer = this.safeValue(instanceServers, 0);
        const pingInterval = this.safeInteger(firstInstanceServer, 'pingInterval');
        const endpoint = this.safeString(firstInstanceServer, 'endpoint');
        const token = this.safeString(data, 'token');
        const result = endpoint + '?' + this.urlencode({
            'token': token,
            'privateChannel': privateChannel,
            'connectId': connectId,
        });
        const client = this.client(result);
        client.keepAlive = pingInterval;
        return result;
    }
    requestId() {
        const requestId = this.sum(this.safeInteger(this.options, 'requestId', 0), 1);
        this.options['requestId'] = requestId;
        return requestId;
    }
    async subscribe(url, messageHash, subscriptionHash, params = {}, subscription = undefined) {
        const requestId = this.requestId().toString();
        const request = {
            'id': requestId,
            'type': 'subscribe',
            'topic': subscriptionHash,
            'response': true,
        };
        const message = this.extend(request, params);
        const client = this.client(url);
        if (!(subscriptionHash in client.subscriptions)) {
            client.subscriptions[requestId] = subscriptionHash;
        }
        return await this.watch(url, messageHash, message, subscriptionHash, subscription);
    }
    async watchTicker(symbol, params = {}) {
        /**
         * @method
         * @name kucoin#watchTicker
         * @description watches a price ticker, a statistical calculation with the information calculated over the past 24 hours for a specific market
         * @param {string} symbol unified symbol of the market to fetch the ticker for
         * @param {object} params extra parameters specific to the kucoin api endpoint
         * @returns {object} a [ticker structure]{@link https://docs.ccxt.com/#/?id=ticker-structure}
         */
        await this.loadMarkets();
        const market = this.market(symbol);
        symbol = market['symbol'];
        const url = await this.negotiate(false);
        const [method, query] = this.handleOptionAndParams(params, 'watchTicker', 'method', '/market/snapshot');
        const topic = method + ':' + market['id'];
        const messageHash = 'ticker:' + symbol;
        return await this.subscribe(url, messageHash, topic, query);
    }
    handleTicker(client, message) {
        //
        // market/snapshot
        //
        // updates come in every 2 sec unless there
        // were no changes since the previous update
        //
        //     {
        //         "data": {
        //             "sequence": "1545896669291",
        //             "data": {
        //                 "trading": true,
        //                 "symbol": "KCS-BTC",
        //                 "buy": 0.00011,
        //                 "sell": 0.00012,
        //                 "sort": 100,
        //                 "volValue": 3.13851792584, // total
        //                 "baseCurrency": "KCS",
        //                 "market": "BTC",
        //                 "quoteCurrency": "BTC",
        //                 "symbolCode": "KCS-BTC",
        //                 "datetime": 1548388122031,
        //                 "high": 0.00013,
        //                 "vol": 27514.34842,
        //                 "low": 0.0001,
        //                 "changePrice": -1.0e-5,
        //                 "changeRate": -0.0769,
        //                 "lastTradedPrice": 0.00012,
        //                 "board": 0,
        //                 "mark": 0
        //             }
        //         },
        //         "subject": "trade.snapshot",
        //         "topic": "/market/snapshot:KCS-BTC",
        //         "type": "message"
        //     }
        //
        // market/ticker
        //
        //     {
        //         type: 'message',
        //         topic: '/market/ticker:BTC-USDT',
        //         subject: 'trade.ticker',
        //         data: {
        //             bestAsk: '62163',
        //             bestAskSize: '0.99011388',
        //             bestBid: '62162.9',
        //             bestBidSize: '0.04794181',
        //             price: '62162.9',
        //             sequence: '1621383371852',
        //             size: '0.00832274',
        //             time: 1634641987564
        //         }
        //     }
        //
        const topic = this.safeString(message, 'topic');
        let market = undefined;
        if (topic !== undefined) {
            const parts = topic.split(':');
            const marketId = this.safeString(parts, 1);
            market = this.safeMarket(marketId, market, '-');
        }
        const data = this.safeValue(message, 'data', {});
        const rawTicker = this.safeValue(data, 'data', data);
        const ticker = this.parseTicker(rawTicker, market);
        const symbol = ticker['symbol'];
        this.tickers[symbol] = ticker;
        const messageHash = 'ticker:' + symbol;
        client.resolve(ticker, messageHash);
    }
    async watchOHLCV(symbol, timeframe = '1m', since = undefined, limit = undefined, params = {}) {
        /**
         * @method
         * @name kucoin#watchOHLCV
         * @description watches historical candlestick data containing the open, high, low, and close price, and the volume of a market
         * @param {string} symbol unified symbol of the market to fetch OHLCV data for
         * @param {string} timeframe the length of time each candle represents
         * @param {int|undefined} since timestamp in ms of the earliest candle to fetch
         * @param {int|undefined} limit the maximum amount of candles to fetch
         * @param {object} params extra parameters specific to the kucoin api endpoint
         * @returns {[[int]]} A list of candles ordered as timestamp, open, high, low, close, volume
         */
        await this.loadMarkets();
        const url = await this.negotiate(false);
        const market = this.market(symbol);
        symbol = market['symbol'];
        const period = this.safeString(this.timeframes, timeframe, timeframe);
        const topic = '/market/candles:' + market['id'] + '_' + period;
        const messageHash = 'candles:' + symbol + ':' + timeframe;
        const ohlcv = await this.subscribe(url, messageHash, topic, params);
        if (this.newUpdates) {
            limit = ohlcv.getLimit(symbol, limit);
        }
        return this.filterBySinceLimit(ohlcv, since, limit, 0, true);
    }
    handleOHLCV(client, message) {
        //
        //     {
        //         data: {
        //             symbol: 'BTC-USDT',
        //             candles: [
        //                 '1624881240',
        //                 '34138.8',
        //                 '34121.6',
        //                 '34138.8',
        //                 '34097.9',
        //                 '3.06097133',
        //                 '104430.955068564'
        //             ],
        //             time: 1624881284466023700
        //         },
        //         subject: 'trade.candles.update',
        //         topic: '/market/candles:BTC-USDT_1min',
        //         type: 'message'
        //     }
        //
        const data = this.safeValue(message, 'data', {});
        const marketId = this.safeString(data, 'symbol');
        const candles = this.safeValue(data, 'candles', []);
        const topic = this.safeString(message, 'topic');
        const parts = topic.split('_');
        const interval = this.safeString(parts, 1);
        // use a reverse lookup in a static map instead
        const timeframe = this.findTimeframe(interval);
        const market = this.safeMarket(marketId);
        const symbol = market['symbol'];
        const messageHash = 'candles:' + symbol + ':' + timeframe;
        this.ohlcvs[symbol] = this.safeValue(this.ohlcvs, symbol, {});
        let stored = this.safeValue(this.ohlcvs[symbol], timeframe);
        if (stored === undefined) {
            const limit = this.safeInteger(this.options, 'OHLCVLimit', 1000);
            stored = new Cache.ArrayCacheByTimestamp(limit);
            this.ohlcvs[symbol][timeframe] = stored;
        }
        const ohlcv = this.parseOHLCV(candles, market);
        stored.append(ohlcv);
        client.resolve(stored, messageHash);
    }
    async watchTrades(symbol, since = undefined, limit = undefined, params = {}) {
        /**
         * @method
         * @name kucoin#watchTrades
         * @description get the list of most recent trades for a particular symbol
         * @param {string} symbol unified symbol of the market to fetch trades for
         * @param {int|undefined} since timestamp in ms of the earliest trade to fetch
         * @param {int|undefined} limit the maximum amount of trades to fetch
         * @param {object} params extra parameters specific to the kucoin api endpoint
         * @returns {[object]} a list of [trade structures]{@link https://docs.ccxt.com/en/latest/manual.html?#public-trades}
         */
        await this.loadMarkets();
        const url = await this.negotiate(false);
        const market = this.market(symbol);
        symbol = market['symbol'];
        const topic = '/market/match:' + market['id'];
        const messageHash = 'trades:' + symbol;
        const trades = await this.subscribe(url, messageHash, topic, params);
        if (this.newUpdates) {
            limit = trades.getLimit(symbol, limit);
        }
        return this.filterBySinceLimit(trades, since, limit, 'timestamp', true);
    }
    handleTrade(client, message) {
        //
        //     {
        //         data: {
        //             sequence: '1568787654360',
        //             symbol: 'BTC-USDT',
        //             side: 'buy',
        //             size: '0.00536577',
        //             price: '9345',
        //             takerOrderId: '5e356c4a9f1a790008f8d921',
        //             time: '1580559434436443257',
        //             type: 'match',
        //             makerOrderId: '5e356bffedf0010008fa5d7f',
        //             tradeId: '5e356c4aeefabd62c62a1ece'
        //         },
        //         subject: 'trade.l3match',
        //         topic: '/market/match:BTC-USDT',
        //         type: 'message'
        //     }
        //
        const data = this.safeValue(message, 'data', {});
        const trade = this.parseTrade(data);
        const symbol = trade['symbol'];
        const messageHash = 'trades:' + symbol;
        let trades = this.safeValue(this.trades, symbol);
        if (trades === undefined) {
            const limit = this.safeInteger(this.options, 'tradesLimit', 1000);
            trades = new Cache.ArrayCache(limit);
            this.trades[symbol] = trades;
        }
        trades.append(trade);
        client.resolve(trades, messageHash);
    }
    async watchOrderBook(symbol, limit = undefined, params = {}) {
        /**
         * @method
         * @name kucoin#watchOrderBook
         * @description watches information on open orders with bid (buy) and ask (sell) prices, volumes and other data
         * @param {string} symbol unified symbol of the market to fetch the order book for
         * @param {int|undefined} limit the maximum amount of order book entries to return
         * @param {object} params extra parameters specific to the kucoin api endpoint
         * @returns {object} A dictionary of [order book structures]{@link https://docs.ccxt.com/#/?id=order-book-structure} indexed by market symbols
         */
        //
        // https://docs.kucoin.com/#level-2-market-data
        //
        // 1. After receiving the websocket Level 2 data flow, cache the data.
        // 2. Initiate a REST request to get the snapshot data of Level 2 order book.
        // 3. Playback the cached Level 2 data flow.
        // 4. Apply the new Level 2 data flow to the local snapshot to ensure that
        // the sequence of the new Level 2 update lines up with the sequence of
        // the previous Level 2 data. Discard all the message prior to that
        // sequence, and then playback the change to snapshot.
        // 5. Update the level2 full data based on sequence according to the
        // size. If the price is 0, ignore the messages and update the sequence.
        // If the size=0, update the sequence and remove the price of which the
        // size is 0 out of level 2. Fr other cases, please update the price.
        //
        if (limit !== undefined) {
            if ((limit !== 20) && (limit !== 100)) {
                throw new errors.ExchangeError(this.id + " watchOrderBook 'limit' argument must be undefined, 20 or 100");
            }
        }
        await this.loadMarkets();
        const url = await this.negotiate(false);
        const market = this.market(symbol);
        symbol = market['symbol'];
        const topic = '/market/level2:' + market['id'];
        const messageHash = 'orderbook:' + symbol;
        const subscription = {
            'method': this.handleOrderBookSubscription,
            'symbol': symbol,
            'limit': limit,
        };
        const orderbook = await this.subscribe(url, messageHash, topic, params, subscription);
        return orderbook.limit();
    }
    handleOrderBook(client, message) {
        //
        // initial snapshot is fetched with ccxt's fetchOrderBook
        // the feed does not include a snapshot, just the deltas
        //
        //     {
        //         "type":"message",
        //         "topic":"/market/level2:BTC-USDT",
        //         "subject":"trade.l2update",
        //         "data":{
        //             "sequenceStart":1545896669105,
        //             "sequenceEnd":1545896669106,
        //             "symbol":"BTC-USDT",
        //             "changes": {
        //                 "asks": [["6","1","1545896669105"]], // price, size, sequence
        //                 "bids": [["4","1","1545896669106"]]
        //             }
        //         }
        //     }
        //
        const data = this.safeValue(message, 'data');
        const marketId = this.safeString(data, 'symbol');
        const symbol = this.safeSymbol(marketId, undefined, '-');
        const messageHash = 'orderbook:' + symbol;
        const storedOrderBook = this.orderbooks[symbol];
        const nonce = this.safeInteger(storedOrderBook, 'nonce');
        const deltaEnd = this.safeInteger(data, 'sequenceEnd');
        if (nonce === undefined) {
            const cacheLength = storedOrderBook.cache.length;
            const topic = this.safeString(message, 'topic');
            const subscription = client.subscriptions[topic];
            const limit = this.safeInteger(subscription, 'limit');
            const snapshotDelay = this.handleOption('watchOrderBook', 'snapshotDelay', 5);
            if (cacheLength === snapshotDelay) {
                this.spawn(this.loadOrderBook, client, messageHash, symbol, limit);
            }
            storedOrderBook.cache.push(data);
            return;
        }
        else if (nonce >= deltaEnd) {
            return;
        }
        this.handleDelta(storedOrderBook, data);
        client.resolve(storedOrderBook, messageHash);
    }
    getCacheIndex(orderbook, cache) {
        const firstDelta = this.safeValue(cache, 0);
        const nonce = this.safeInteger(orderbook, 'nonce');
        const firstDeltaStart = this.safeInteger(firstDelta, 'sequenceStart');
        if (nonce < firstDeltaStart - 1) {
            return -1;
        }
        for (let i = 0; i < cache.length; i++) {
            const delta = cache[i];
            const deltaStart = this.safeInteger(delta, 'sequenceStart');
            const deltaEnd = this.safeInteger(delta, 'sequenceEnd');
            if ((nonce >= deltaStart - 1) && (nonce < deltaEnd)) {
                return i;
            }
        }
        return cache.length;
    }
    handleDelta(orderbook, delta) {
        orderbook['nonce'] = this.safeInteger(delta, 'sequenceEnd');
        const timestamp = this.safeInteger(delta, 'time');
        orderbook['timestamp'] = timestamp;
        orderbook['datetime'] = this.iso8601(timestamp);
        const changes = this.safeValue(delta, 'changes');
        const bids = this.safeValue(changes, 'bids', []);
        const asks = this.safeValue(changes, 'asks', []);
        const storedBids = orderbook['bids'];
        const storedAsks = orderbook['asks'];
        this.handleBidAsks(storedBids, bids);
        this.handleBidAsks(storedAsks, asks);
    }
    handleBidAsks(bookSide, bidAsks) {
        for (let i = 0; i < bidAsks.length; i++) {
            const bidAsk = this.parseBidAsk(bidAsks[i]);
            bookSide.storeArray(bidAsk);
        }
    }
    handleOrderBookSubscription(client, message, subscription) {
        const symbol = this.safeString(subscription, 'symbol');
        const limit = this.safeInteger(subscription, 'limit');
        this.orderbooks[symbol] = this.orderBook({}, limit);
        // moved snapshot initialization to handleOrderBook to fix
        // https://github.com/ccxt/ccxt/issues/6820
        // the general idea is to fetch the snapshot after the first delta
        // but not before, because otherwise we cannot synchronize the feed
    }
    handleSubscriptionStatus(client, message) {
        //
        //     {
        //         id: '1578090438322',
        //         type: 'ack'
        //     }
        //
        const id = this.safeString(message, 'id');
        const subscriptionHash = this.safeString(client.subscriptions, id);
        const subscription = this.safeValue(client.subscriptions, subscriptionHash);
        delete client.subscriptions[id];
        const method = this.safeValue(subscription, 'method');
        if (method !== undefined) {
            method.call(this, client, message, subscription);
        }
    }
    handleSystemStatus(client, message) {
        //
        // todo: answer the question whether handleSystemStatus should be renamed
        // and unified as handleStatus for any usage pattern that
        // involves system status and maintenance updates
        //
        //     {
        //         id: '1578090234088', // connectId
        //         type: 'welcome',
        //     }
        //
        return message;
    }
    async watchOrders(symbol = undefined, since = undefined, limit = undefined, params = {}) {
        /**
         * @method
         * @name kucoin#watchOrders
         * @description watches information on multiple orders made by the user
         * @param {string|undefined} symbol unified market symbol of the market orders were made in
         * @param {int|undefined} since the earliest time in ms to fetch orders for
         * @param {int|undefined} limit the maximum number of  orde structures to retrieve
         * @param {object} params extra parameters specific to the kucoin api endpoint
         * @returns {[object]} a list of [order structures]{@link https://docs.ccxt.com/#/?id=order-structure}
         */
        await this.loadMarkets();
        const url = await this.negotiate(true);
        const topic = '/spotMarket/tradeOrders';
        const request = {
            'privateChannel': true,
        };
        let messageHash = 'orders';
        if (symbol !== undefined) {
            const market = this.market(symbol);
            symbol = market['symbol'];
            messageHash = messageHash + ':' + symbol;
        }
        const orders = await this.subscribe(url, messageHash, topic, this.extend(request, params));
        if (this.newUpdates) {
            limit = orders.getLimit(symbol, limit);
        }
        return this.filterBySymbolSinceLimit(orders, symbol, since, limit, true);
    }
    parseWsOrderStatus(status) {
        const statuses = {
            'open': 'open',
            'filled': 'closed',
            'match': 'open',
            'update': 'open',
            'canceled': 'canceled',
        };
        return this.safeString(statuses, status, status);
    }
    parseWsOrder(order, market = undefined) {
        //
        //     {
        //         'symbol': 'XCAD-USDT',
        //         'orderType': 'limit',
        //         'side': 'buy',
        //         'orderId': '6249167327218b000135e749',
        //         'type': 'canceled',
        //         'orderTime': 1648957043065280224,
        //         'size': '100.452',
        //         'filledSize': '0',
        //         'price': '2.9635',
        //         'clientOid': 'buy-XCAD-USDT-1648957043010159',
        //         'remainSize': '0',
        //         'status': 'done',
        //         'ts': 1648957054031001037
        //     }
        //
        const id = this.safeString(order, 'orderId');
        const clientOrderId = this.safeString(order, 'clientOid');
        const orderType = this.safeStringLower(order, 'orderType');
        const price = this.safeString(order, 'price');
        const filled = this.safeString(order, 'filledSize');
        const amount = this.safeString(order, 'size');
        const rawType = this.safeString(order, 'type');
        const status = this.parseWsOrderStatus(rawType);
        const timestamp = this.safeInteger(order, 'orderTime');
        const marketId = this.safeString(order, 'symbol');
        market = this.safeMarket(marketId, market);
        const symbol = market['symbol'];
        const side = this.safeStringLower(order, 'side');
        return this.safeOrder({
            'info': order,
            'symbol': symbol,
            'id': id,
            'clientOrderId': clientOrderId,
            'timestamp': timestamp,
            'datetime': this.iso8601(timestamp),
            'lastTradeTimestamp': undefined,
            'type': orderType,
            'timeInForce': undefined,
            'postOnly': undefined,
            'side': side,
            'price': price,
            'stopPrice': undefined,
            'triggerPrice': undefined,
            'amount': amount,
            'cost': undefined,
            'average': undefined,
            'filled': filled,
            'remaining': undefined,
            'status': status,
            'fee': undefined,
            'trades': undefined,
        }, market);
    }
    handleOrder(client, message) {
        const messageHash = 'orders';
        const data = this.safeValue(message, 'data');
        const parsed = this.parseWsOrder(data);
        const symbol = this.safeString(parsed, 'symbol');
        const orderId = this.safeString(parsed, 'id');
        if (this.orders === undefined) {
            const limit = this.safeInteger(this.options, 'ordersLimit', 1000);
            this.orders = new Cache.ArrayCacheBySymbolById(limit);
        }
        const cachedOrders = this.orders;
        const orders = this.safeValue(cachedOrders.hashmap, symbol, {});
        const order = this.safeValue(orders, orderId);
        if (order !== undefined) {
            // todo add others to calculate average etc
            const stopPrice = this.safeValue(order, 'stopPrice');
            if (stopPrice !== undefined) {
                parsed['stopPrice'] = stopPrice;
            }
            if (order['status'] === 'closed') {
                parsed['status'] = 'closed';
            }
        }
        cachedOrders.append(parsed);
        client.resolve(this.orders, messageHash);
        const symbolSpecificMessageHash = messageHash + ':' + symbol;
        client.resolve(this.orders, symbolSpecificMessageHash);
    }
    async watchMyTrades(symbol = undefined, since = undefined, limit = undefined, params = {}) {
        /**
         * @method
         * @name kucoin#watchMyTrades
         * @description watches information on multiple trades made by the user
         * @param {string} symbol unified market symbol of the market orders were made in
         * @param {int|undefined} since the earliest time in ms to fetch orders for
         * @param {int|undefined} limit the maximum number of  orde structures to retrieve
         * @param {object} params extra parameters specific to the kucoin api endpoint
         * @returns {[object]} a list of [order structures]{@link https://docs.ccxt.com/#/?id=order-structure
         */
        await this.loadMarkets();
        const url = await this.negotiate(true);
        const topic = '/spot/tradeFills';
        const request = {
            'privateChannel': true,
        };
        let messageHash = 'myTrades';
        if (symbol !== undefined) {
            const market = this.market(symbol);
            symbol = market['symbol'];
            messageHash = messageHash + ':' + market['symbol'];
        }
        const trades = await this.subscribe(url, messageHash, topic, this.extend(request, params));
        if (this.newUpdates) {
            limit = trades.getLimit(symbol, limit);
        }
        return this.filterBySymbolSinceLimit(trades, symbol, since, limit);
    }
    handleMyTrade(client, message) {
        let trades = this.myTrades;
        if (trades === undefined) {
            const limit = this.safeInteger(this.options, 'tradesLimit', 1000);
            trades = new Cache.ArrayCacheBySymbolById(limit);
        }
        const data = this.safeValue(message, 'data');
        const parsed = this.parseWsTrade(data);
        trades.append(parsed);
        const messageHash = 'myTrades';
        client.resolve(trades, messageHash);
        const symbolSpecificMessageHash = messageHash + ':' + parsed['symbol'];
        client.resolve(trades, symbolSpecificMessageHash);
    }
    parseWsTrade(trade, market = undefined) {
        //
        // {
        //     fee: 0.00262148,
        //     feeCurrency: 'USDT',
        //     feeRate: 0.001,
        //     orderId: '62417436b29df8000183df2f',
        //     orderType: 'market',
        //     price: 131.074,
        //     side: 'sell',
        //     size: 0.02,
        //     symbol: 'LTC-USDT',
        //     time: '1648456758734571745',
        //     tradeId: '624174362e113d2f467b3043'
        //   }
        //
        const marketId = this.safeString(trade, 'symbol');
        market = this.safeMarket(marketId, market, '-');
        const symbol = market['symbol'];
        const type = this.safeString(trade, 'orderType');
        const side = this.safeString(trade, 'side');
        const tradeId = this.safeString(trade, 'tradeId');
        const price = this.safeString(trade, 'price');
        const amount = this.safeString(trade, 'size');
        const order = this.safeString(trade, 'orderId');
        const timestamp = this.safeIntegerProduct(trade, 'time', 0.000001);
        const feeCurrency = market['quote'];
        const feeRate = this.safeString(trade, 'feeRate');
        const feeCost = this.safeString(trade, 'fee');
        const fee = {
            'cost': feeCost,
            'rate': feeRate,
            'currency': feeCurrency,
        };
        return this.safeTrade({
            'info': trade,
            'timestamp': timestamp,
            'datetime': this.iso8601(timestamp),
            'symbol': symbol,
            'id': tradeId,
            'order': order,
            'type': type,
            'takerOrMaker': undefined,
            'side': side,
            'price': price,
            'amount': amount,
            'cost': undefined,
            'fee': fee,
        }, market);
    }
    async watchBalance(params = {}) {
        /**
         * @method
         * @name kucoin#watchBalance
         * @description query for balance and get the amount of funds available for trading or funds locked in orders
         * @param {object} params extra parameters specific to the kucoin api endpoint
         * @returns {object} a [balance structure]{@link https://docs.ccxt.com/en/latest/manual.html?#balance-structure}
         */
        await this.loadMarkets();
        const url = await this.negotiate(true);
        const topic = '/account/balance';
        const request = {
            'privateChannel': true,
        };
        const messageHash = 'balance';
        return await this.subscribe(url, messageHash, topic, this.extend(request, params));
    }
    handleBalance(client, message) {
        //
        // {
        //     "id":"6217a451294b030001e3a26a",
        //     "type":"message",
        //     "topic":"/account/balance",
        //     "userId":"6217707c52f97f00012a67db",
        //     "channelType":"private",
        //     "subject":"account.balance",
        //     "data":{
        //        "accountId":"62177fe67810720001db2f18",
        //        "available":"89",
        //        "availableChange":"-30",
        //        "currency":"USDT",
        //        "hold":"0",
        //        "holdChange":"0",
        //        "relationContext":{
        //        },
        //        "relationEvent":"main.transfer",
        //        "relationEventId":"6217a451294b030001e3a26a",
        //        "time":"1645716561816",
        //        "total":"89"
        //     }
        //
        const data = this.safeValue(message, 'data', {});
        const messageHash = 'balance';
        const currencyId = this.safeString(data, 'currency');
        const relationEvent = this.safeString(data, 'relationEvent');
        let requestAccountType = undefined;
        if (relationEvent !== undefined) {
            const relationEventParts = relationEvent.split('.');
            requestAccountType = this.safeString(relationEventParts, 0);
        }
        const selectedType = this.safeString2(this.options, 'watchBalance', 'defaultType', 'trade'); // trade, main, margin or other
        const accountsByType = this.safeValue(this.options, 'accountsByType');
        const uniformType = this.safeString(accountsByType, requestAccountType, 'trade');
        if (!(uniformType in this.balance)) {
            this.balance[uniformType] = {};
        }
        this.balance[uniformType]['info'] = data;
        const timestamp = this.safeInteger(data, 'time');
        this.balance[uniformType]['timestamp'] = timestamp;
        this.balance[uniformType]['datetime'] = this.iso8601(timestamp);
        const code = this.safeCurrencyCode(currencyId);
        const account = this.account();
        account['free'] = this.safeString(data, 'available');
        account['used'] = this.safeString(data, 'hold');
        account['total'] = this.safeString(data, 'total');
        this.balance[uniformType][code] = account;
        this.balance[uniformType] = this.safeBalance(this.balance[uniformType]);
        if (uniformType === selectedType) {
            client.resolve(this.balance[uniformType], messageHash);
        }
    }
    handleSubject(client, message) {
        //
        //     {
        //         "type":"message",
        //         "topic":"/market/level2:BTC-USDT",
        //         "subject":"trade.l2update",
        //         "data":{
        //             "sequenceStart":1545896669105,
        //             "sequenceEnd":1545896669106,
        //             "symbol":"BTC-USDT",
        //             "changes": {
        //                 "asks": [["6","1","1545896669105"]], // price, size, sequence
        //                 "bids": [["4","1","1545896669106"]]
        //             }
        //         }
        //     }
        //
        const subject = this.safeString(message, 'subject');
        const methods = {
            'trade.l2update': this.handleOrderBook,
            'trade.ticker': this.handleTicker,
            'trade.snapshot': this.handleTicker,
            'trade.l3match': this.handleTrade,
            'trade.candles.update': this.handleOHLCV,
            'account.balance': this.handleBalance,
            '/spot/tradeFills': this.handleMyTrade,
            'orderChange': this.handleOrder,
        };
        const method = this.safeValue(methods, subject);
        if (method === undefined) {
            return message;
        }
        else {
            return method.call(this, client, message);
        }
    }
    ping(client) {
        // kucoin does not support built-in ws protocol-level ping-pong
        // instead it requires a custom json-based text ping-pong
        // https://docs.kucoin.com/#ping
        const id = this.requestId().toString();
        return {
            'id': id,
            'type': 'ping',
        };
    }
    handlePong(client, message) {
        client.lastPong = this.milliseconds();
        // https://docs.kucoin.com/#ping
    }
    handleErrorMessage(client, message) {
        return message;
    }
    handleMessage(client, message) {
        const type = this.safeString(message, 'type');
        const methods = {
            // 'heartbeat': this.handleHeartbeat,
            'welcome': this.handleSystemStatus,
            'ack': this.handleSubscriptionStatus,
            'message': this.handleSubject,
            'pong': this.handlePong,
        };
        const method = this.safeValue(methods, type);
        if (method !== undefined) {
            return method.call(this, client, message);
        }
    }
}

module.exports = kucoin;
