'use strict';

var okcoin$1 = require('./abstract/okcoin.js');
var errors = require('./base/errors.js');
var Precise = require('./base/Precise.js');
var number = require('./base/functions/number.js');
var sha256 = require('./static_dependencies/noble-hashes/sha256.js');

//  ---------------------------------------------------------------------------
//  ---------------------------------------------------------------------------
class okcoin extends okcoin$1 {
    describe() {
        return this.deepExtend(super.describe(), {
            'id': 'okcoin',
            'name': 'OKCoin',
            'countries': ['CN', 'US'],
            'version': 'v3',
            // cheapest endpoint is 100 requests per 2 seconds
            // 50 requests per second => 1000 / 50 = 20ms
            'rateLimit': 20,
            'pro': true,
            'has': {
                'CORS': undefined,
                'spot': true,
                'margin': false,
                'swap': undefined,
                'future': true,
                'option': undefined,
                'cancelOrder': true,
                'createOrder': true,
                'fetchBalance': true,
                'fetchClosedOrders': true,
                'fetchCurrencies': true,
                'fetchDepositAddress': true,
                'fetchDeposits': true,
                'fetchLedger': true,
                'fetchMarkets': true,
                'fetchMyTrades': true,
                'fetchOHLCV': true,
                'fetchOpenOrders': true,
                'fetchOrder': true,
                'fetchOrderBook': true,
                'fetchOrders': undefined,
                'fetchOrderTrades': true,
                'fetchPosition': true,
                'fetchPositions': true,
                'fetchTicker': true,
                'fetchTickers': true,
                'fetchTime': true,
                'fetchTrades': true,
                'fetchTransactions': undefined,
                'fetchWithdrawals': true,
                'transfer': true,
                'withdraw': true,
            },
            'timeframes': {
                '1m': '60',
                '3m': '180',
                '5m': '300',
                '15m': '900',
                '30m': '1800',
                '1h': '3600',
                '2h': '7200',
                '4h': '14400',
                '6h': '21600',
                '12h': '43200',
                '1d': '86400',
                '1w': '604800',
                '1M': '2678400',
                '3M': '8035200',
                '6M': '16070400',
                '1y': '31536000',
            },
            'hostname': 'okcoin.com',
            'urls': {
                'logo': 'https://user-images.githubusercontent.com/51840849/87295551-102fbf00-c50e-11ea-90a9-462eebba5829.jpg',
                'api': {
                    'rest': 'https://www.{hostname}',
                },
                'www': 'https://www.okcoin.com',
                'doc': 'https://www.okcoin.com/docs/en/',
                'fees': 'https://www.okcoin.com/coin-fees',
                'referral': 'https://www.okcoin.com/account/register?flag=activity&channelId=600001513',
                'test': {
                    'rest': 'https://testnet.okex.com',
                },
            },
            'api': {
                'general': {
                    'get': {
                        'time': 8.3334,
                    },
                },
                'account': {
                    'get': {
                        'wallet': 8.3334,
                        'sub-account': 1000,
                        'asset-valuation': 1000,
                        'wallet/{currency}': 8.3334,
                        'withdrawal/history': 8.3334,
                        'withdrawal/history/{currency}': 8.3334,
                        'ledger': 5,
                        'deposit/address': 8.3334,
                        'deposit/history': 8.3334,
                        'deposit/history/{currency}': 8.3334,
                        'currencies': 8.3334,
                        'withdrawal/fee': 8.3334,
                        'deposit-lightning': 50,
                        'withdrawal-lightning': 50,
                        'fiat/deposit/detail': 5,
                        'fiat/deposit/details': 8.3334,
                        'fiat/withdraw/detail': 5,
                        'fiat/withdraw/details': 8.3334,
                        'fiat/channel': 8.3334,
                    },
                    'post': {
                        'transfer': 100,
                        'withdrawal': 8.3334,
                        'fiat/cancel_deposit': 1,
                        'fiat/deposit': 8.3334,
                        'fiat/withdraw': 8.3334,
                        'fiat/cancel_withdrawal': 1,
                    },
                },
                // TODO fix signing issue in sign ()
                // all other endpoints of the format
                // api/account/v3/wallet
                // otc endpoints actually of the format: (exchanged places)
                // api/v3/otc/rfq/instruments
                'otc': {
                    'get': {
                        'rfq/instruments': 50,
                        'rfq/trade': 50,
                        'rfq/history': 50,
                    },
                    'post': {
                        'rfq/quote': 50,
                        'rfq/trade': 50,
                    },
                },
                // TODO fix signing issue as above
                'users': {
                    'get': {
                        'subaccount-info': 20,
                        'account-info': 20,
                        'subaccount/apikey': 20,
                    },
                    'post': {
                        'create-subaccount': 5,
                        'delete-subaccount': 5,
                        'subaccount/apikey': 50,
                        'subacount/delete-apikey': 20,
                        'subacount/modify-apikey': 20,
                    },
                },
                'earning': {
                    'get': {
                        'offers': 5,
                        'orders': 5,
                        'positions': 8.3334,
                    },
                    'post': {
                        'purchase': 5,
                        'redeem': 5,
                        'cancel': 5,
                    },
                },
                'spot': {
                    'get': {
                        'accounts': 5,
                        'accounts/{currency}': 5,
                        'accounts/{currency}/ledger': 5,
                        'orders': 10,
                        'orders_pending': 5,
                        'orders/{order_id}': 5,
                        'orders/{client_oid}': 5,
                        'trade_fee': 5,
                        'fills': 10,
                        'algo': 5,
                        // public
                        'instruments': 5,
                        'instruments/{instrument_id}/book': 5,
                        'instruments/ticker': 5,
                        'instruments/{instrument_id}/ticker': 5,
                        'instruments/{instrument_id}/trades': 5,
                        'instruments/{instrument_id}/candles': 5,
                    },
                    'post': {
                        'order_algo': 2.5,
                        'orders': 1,
                        'batch_orders': 2,
                        'cancel_orders/{order_id}': 1,
                        'cancel_orders/{client_oid}': 1,
                        'cancel_batch_algos': 5,
                        'cancel_batch_orders': 5,
                        'amend_order/{instrument_id}': 2.5,
                        'amend_batch_orders': 5,
                    },
                },
                'margin': {
                    // Margin trading closed down on February 21, 2022
                    'get': {
                        'accounts': 5,
                        'accounts/{instrument_id}': 5,
                        'accounts/{instrument_id}/ledger': 5,
                        'accounts/availability': 5,
                        'accounts/{instrument_id}/availability': 5,
                        'accounts/borrowed': 5,
                        'accounts/{instrument_id}/borrowed': 5,
                        'orders': 10,
                        'accounts/{instrument_id}/leverage': 1,
                        'orders/{order_id}': 5,
                        'orders/{client_oid}': 5,
                        'orders_pending': 5,
                        'fills': 10,
                        // public
                        'instruments/{instrument_id}/mark_price': 5,
                    },
                    'post': {
                        'accounts/borrow': 1,
                        'accounts/repayment': 1,
                        'orders': 1,
                        'batch_orders': 2,
                        'cancel_orders': 1,
                        'cancel_orders/{order_id}': 1,
                        'cancel_orders/{client_oid}': 1,
                        'cancel_batch_orders': 2,
                        'amend_order/{instrument_id}': 2.5,
                        'amend_batch_orders': 5,
                        'accounts/{instrument_id}/leverage': 1,
                    },
                },
                'system': {
                    'get': {
                        'status': 250,
                    },
                },
                'market': {
                    'get': {
                        'oracle': 250,
                    },
                },
                'futures': {
                    'get': [
                        'position',
                        '{instrument_id}/position',
                        'accounts',
                        'accounts/{underlying}',
                        'accounts/{underlying}/leverage',
                        'accounts/{underlying}/ledger',
                        'order_algo/{instrument_id}',
                        'orders/{instrument_id}',
                        'orders/{instrument_id}/{order_id}',
                        'orders/{instrument_id}/{client_oid}',
                        'fills',
                        'trade_fee',
                        'accounts/{instrument_id}/holds',
                        // public
                        'instruments',
                        'instruments/{instrument_id}/book',
                        'instruments/ticker',
                        'instruments/{instrument_id}/ticker',
                        'instruments/{instrument_id}/trades',
                        'instruments/{instrument_id}/candles',
                        'instruments/{instrument_id}/history/candles',
                        'instruments/{instrument_id}/index',
                        'rate',
                        'instruments/{instrument_id}/estimated_price',
                        'instruments/{instrument_id}/open_interest',
                        'instruments/{instrument_id}/price_limit',
                        'instruments/{instrument_id}/mark_price',
                        'instruments/{instrument_id}/liquidation',
                    ],
                    'post': [
                        'accounts/{underlying}/leverage',
                        'order',
                        'amend_order/{instrument_id}',
                        'orders',
                        'cancel_order/{instrument_id}/{order_id}',
                        'cancel_order/{instrument_id}/{client_oid}',
                        'cancel_batch_orders/{instrument_id}',
                        'accounts/margin_mode',
                        'close_position',
                        'cancel_all',
                        'order_algo',
                        'cancel_algos',
                    ],
                },
                'swap': {
                    'get': [
                        'position',
                        '{instrument_id}/position',
                        'accounts',
                        '{instrument_id}/accounts',
                        'accounts/{instrument_id}/settings',
                        'accounts/{instrument_id}/ledger',
                        'orders/{instrument_id}',
                        'orders/{instrument_id}/{order_id}',
                        'orders/{instrument_id}/{client_oid}',
                        'fills',
                        'accounts/{instrument_id}/holds',
                        'trade_fee',
                        'order_algo/{instrument_id}',
                        // public
                        'instruments',
                        'instruments/{instrument_id}/depth',
                        'instruments/ticker',
                        'instruments/{instrument_id}/ticker',
                        'instruments/{instrument_id}/trades',
                        'instruments/{instrument_id}/candles',
                        'instruments/{instrument_id}/history/candles',
                        'instruments/{instrument_id}/index',
                        'rate',
                        'instruments/{instrument_id}/open_interest',
                        'instruments/{instrument_id}/price_limit',
                        'instruments/{instrument_id}/liquidation',
                        'instruments/{instrument_id}/funding_time',
                        'instruments/{instrument_id}/mark_price',
                        'instruments/{instrument_id}/historical_funding_rate',
                    ],
                    'post': [
                        'accounts/{instrument_id}/leverage',
                        'order',
                        'amend_order/{instrument_id}',
                        'orders',
                        'cancel_order/{instrument_id}/{order_id}',
                        'cancel_order/{instrument_id}/{client_oid}',
                        'cancel_batch_orders/{instrument_id}',
                        'order_algo',
                        'cancel_algos',
                        'close_position',
                        'cancel_all',
                    ],
                },
                'option': {
                    'get': [
                        'accounts',
                        'position',
                        '{underlying}/position',
                        'accounts/{underlying}',
                        'orders/{underlying}',
                        'fills/{underlying}',
                        'accounts/{underlying}/ledger',
                        'trade_fee',
                        'orders/{underlying}/{order_id}',
                        'orders/{underlying}/{client_oid}',
                        // public
                        'underlying',
                        'instruments/{underlying}',
                        'instruments/{underlying}/summary',
                        'instruments/{underlying}/summary/{instrument_id}',
                        'instruments/{instrument_id}/book',
                        'instruments/{instrument_id}/trades',
                        'instruments/{instrument_id}/ticker',
                        'instruments/{instrument_id}/candles',
                    ],
                    'post': [
                        'order',
                        'orders',
                        'cancel_order/{underlying}/{order_id}',
                        'cancel_order/{underlying}/{client_oid}',
                        'cancel_batch_orders/{underlying}',
                        'amend_order/{underlying}',
                        'amend_batch_orders/{underlying}',
                    ],
                },
                'information': {
                    'get': [
                        '{currency}/long_short_ratio',
                        '{currency}/volume',
                        '{currency}/taker',
                        '{currency}/sentiment',
                        '{currency}/margin',
                    ],
                },
                'index': {
                    'get': [
                        '{instrument_id}/constituents',
                    ],
                },
            },
            'fees': {
                'trading': {
                    'taker': 0.002,
                    'maker': 0.001,
                },
                'spot': {
                    'taker': 0.0015,
                    'maker': 0.0010,
                },
            },
            'requiredCredentials': {
                'apiKey': true,
                'secret': true,
                'password': true,
            },
            'exceptions': {
                // http error codes
                // 400 Bad Request — Invalid request format
                // 401 Unauthorized — Invalid API Key
                // 403 Forbidden — You do not have access to the requested resource
                // 404 Not Found
                // 429 Client Error: Too Many Requests for url
                // 500 Internal Server Error — We had a problem with our server
                'exact': {
                    '1': errors.ExchangeError,
                    // undocumented
                    'failure to get a peer from the ring-balancer': errors.ExchangeNotAvailable,
                    'Server is busy, please try again.': errors.ExchangeNotAvailable,
                    'An unexpected error occurred': errors.ExchangeError,
                    'System error': errors.ExchangeError,
                    '4010': errors.PermissionDenied,
                    // common
                    // '0': ExchangeError, // 200 successful,when the order placement / cancellation / operation is successful
                    '4001': errors.ExchangeError,
                    '4002': errors.ExchangeError,
                    // --------------------------------------------------------
                    '30001': errors.AuthenticationError,
                    '30002': errors.AuthenticationError,
                    '30003': errors.AuthenticationError,
                    '30004': errors.AuthenticationError,
                    '30005': errors.InvalidNonce,
                    '30006': errors.AuthenticationError,
                    '30007': errors.BadRequest,
                    '30008': errors.RequestTimeout,
                    '30009': errors.ExchangeError,
                    '30010': errors.AuthenticationError,
                    '30011': errors.PermissionDenied,
                    '30012': errors.AuthenticationError,
                    '30013': errors.AuthenticationError,
                    '30014': errors.DDoSProtection,
                    '30015': errors.AuthenticationError,
                    '30016': errors.ExchangeError,
                    '30017': errors.ExchangeError,
                    '30018': errors.ExchangeError,
                    '30019': errors.ExchangeNotAvailable,
                    '30020': errors.BadRequest,
                    '30021': errors.BadRequest,
                    '30022': errors.PermissionDenied,
                    '30023': errors.BadRequest,
                    '30024': errors.BadSymbol,
                    '30025': errors.BadRequest,
                    '30026': errors.DDoSProtection,
                    '30027': errors.AuthenticationError,
                    '30028': errors.PermissionDenied,
                    '30029': errors.AccountSuspended,
                    '30030': errors.ExchangeNotAvailable,
                    '30031': errors.BadRequest,
                    '30032': errors.BadSymbol,
                    '30033': errors.BadRequest,
                    '30034': errors.ExchangeError,
                    '30035': errors.ExchangeError,
                    '30036': errors.ExchangeError,
                    '30037': errors.ExchangeNotAvailable,
                    // '30038': AuthenticationError, // { "code": 30038, "message": "user does not exist" }
                    '30038': errors.OnMaintenance,
                    '30044': errors.RequestTimeout,
                    // futures
                    '32001': errors.AccountSuspended,
                    '32002': errors.PermissionDenied,
                    '32003': errors.CancelPending,
                    '32004': errors.ExchangeError,
                    '32005': errors.InvalidOrder,
                    '32006': errors.InvalidOrder,
                    '32007': errors.InvalidOrder,
                    '32008': errors.InvalidOrder,
                    '32009': errors.InvalidOrder,
                    '32010': errors.ExchangeError,
                    '32011': errors.ExchangeError,
                    '32012': errors.ExchangeError,
                    '32013': errors.ExchangeError,
                    '32014': errors.ExchangeError,
                    '32015': errors.ExchangeError,
                    '32016': errors.ExchangeError,
                    '32017': errors.ExchangeError,
                    '32018': errors.ExchangeError,
                    '32019': errors.ExchangeError,
                    '32020': errors.ExchangeError,
                    '32021': errors.ExchangeError,
                    '32022': errors.ExchangeError,
                    '32023': errors.ExchangeError,
                    '32024': errors.ExchangeError,
                    '32025': errors.ExchangeError,
                    '32026': errors.ExchangeError,
                    '32027': errors.ExchangeError,
                    '32028': errors.ExchangeError,
                    '32029': errors.ExchangeError,
                    '32030': errors.InvalidOrder,
                    '32031': errors.ArgumentsRequired,
                    '32038': errors.AuthenticationError,
                    '32040': errors.ExchangeError,
                    '32044': errors.ExchangeError,
                    '32045': errors.ExchangeError,
                    '32046': errors.ExchangeError,
                    '32047': errors.ExchangeError,
                    '32048': errors.InvalidOrder,
                    '32049': errors.ExchangeError,
                    '32050': errors.InvalidOrder,
                    '32051': errors.InvalidOrder,
                    '32052': errors.ExchangeError,
                    '32053': errors.ExchangeError,
                    '32057': errors.ExchangeError,
                    '32054': errors.ExchangeError,
                    '32055': errors.InvalidOrder,
                    '32056': errors.ExchangeError,
                    '32058': errors.ExchangeError,
                    '32059': errors.InvalidOrder,
                    '32060': errors.InvalidOrder,
                    '32061': errors.InvalidOrder,
                    '32062': errors.InvalidOrder,
                    '32063': errors.InvalidOrder,
                    '32064': errors.ExchangeError,
                    '32065': errors.ExchangeError,
                    '32066': errors.ExchangeError,
                    '32067': errors.ExchangeError,
                    '32068': errors.ExchangeError,
                    '32069': errors.ExchangeError,
                    '32070': errors.ExchangeError,
                    '32071': errors.ExchangeError,
                    '32072': errors.ExchangeError,
                    '32073': errors.ExchangeError,
                    '32074': errors.ExchangeError,
                    '32075': errors.ExchangeError,
                    '32076': errors.ExchangeError,
                    '32077': errors.ExchangeError,
                    '32078': errors.ExchangeError,
                    '32079': errors.ExchangeError,
                    '32080': errors.ExchangeError,
                    '32083': errors.ExchangeError,
                    // token and margin trading
                    '33001': errors.PermissionDenied,
                    '33002': errors.AccountSuspended,
                    '33003': errors.InsufficientFunds,
                    '33004': errors.ExchangeError,
                    '33005': errors.ExchangeError,
                    '33006': errors.ExchangeError,
                    '33007': errors.ExchangeError,
                    '33008': errors.InsufficientFunds,
                    '33009': errors.ExchangeError,
                    '33010': errors.ExchangeError,
                    '33011': errors.ExchangeError,
                    '33012': errors.ExchangeError,
                    '33013': errors.InvalidOrder,
                    '33014': errors.OrderNotFound,
                    '33015': errors.InvalidOrder,
                    '33016': errors.ExchangeError,
                    '33017': errors.InsufficientFunds,
                    '33018': errors.ExchangeError,
                    '33020': errors.ExchangeError,
                    '33021': errors.BadRequest,
                    '33022': errors.InvalidOrder,
                    '33023': errors.ExchangeError,
                    '33024': errors.InvalidOrder,
                    '33025': errors.InvalidOrder,
                    '33026': errors.ExchangeError,
                    '33027': errors.InvalidOrder,
                    '33028': errors.InvalidOrder,
                    '33029': errors.InvalidOrder,
                    '33034': errors.ExchangeError,
                    '33035': errors.ExchangeError,
                    '33036': errors.ExchangeError,
                    '33037': errors.ExchangeError,
                    '33038': errors.ExchangeError,
                    '33039': errors.ExchangeError,
                    '33040': errors.ExchangeError,
                    '33041': errors.ExchangeError,
                    '33042': errors.ExchangeError,
                    '33043': errors.ExchangeError,
                    '33044': errors.ExchangeError,
                    '33045': errors.ExchangeError,
                    '33046': errors.ExchangeError,
                    '33047': errors.ExchangeError,
                    '33048': errors.ExchangeError,
                    '33049': errors.ExchangeError,
                    '33050': errors.ExchangeError,
                    '33051': errors.ExchangeError,
                    '33059': errors.BadRequest,
                    '33060': errors.BadRequest,
                    '33061': errors.ExchangeError,
                    '33062': errors.ExchangeError,
                    '33063': errors.ExchangeError,
                    '33064': errors.ExchangeError,
                    '33065': errors.ExchangeError,
                    '33085': errors.InvalidOrder,
                    // account
                    '21009': errors.ExchangeError,
                    '34001': errors.PermissionDenied,
                    '34002': errors.InvalidAddress,
                    '34003': errors.ExchangeError,
                    '34004': errors.ExchangeError,
                    '34005': errors.ExchangeError,
                    '34006': errors.ExchangeError,
                    '34007': errors.ExchangeError,
                    '34008': errors.InsufficientFunds,
                    '34009': errors.ExchangeError,
                    '34010': errors.ExchangeError,
                    '34011': errors.ExchangeError,
                    '34012': errors.ExchangeError,
                    '34013': errors.ExchangeError,
                    '34014': errors.ExchangeError,
                    '34015': errors.ExchangeError,
                    '34016': errors.PermissionDenied,
                    '34017': errors.AccountSuspended,
                    '34018': errors.AuthenticationError,
                    '34019': errors.PermissionDenied,
                    '34020': errors.PermissionDenied,
                    '34021': errors.InvalidAddress,
                    '34022': errors.ExchangeError,
                    '34023': errors.PermissionDenied,
                    '34026': errors.RateLimitExceeded,
                    '34036': errors.ExchangeError,
                    '34037': errors.ExchangeError,
                    '34038': errors.ExchangeError,
                    '34039': errors.ExchangeError,
                    // swap
                    '35001': errors.ExchangeError,
                    '35002': errors.ExchangeError,
                    '35003': errors.ExchangeError,
                    '35004': errors.ExchangeError,
                    '35005': errors.AuthenticationError,
                    '35008': errors.InvalidOrder,
                    '35010': errors.InvalidOrder,
                    '35012': errors.InvalidOrder,
                    '35014': errors.InvalidOrder,
                    '35015': errors.InvalidOrder,
                    '35017': errors.ExchangeError,
                    '35019': errors.InvalidOrder,
                    '35020': errors.InvalidOrder,
                    '35021': errors.InvalidOrder,
                    '35022': errors.BadRequest,
                    '35024': errors.BadRequest,
                    '35025': errors.InsufficientFunds,
                    '35026': errors.BadRequest,
                    '35029': errors.OrderNotFound,
                    '35030': errors.InvalidOrder,
                    '35031': errors.InvalidOrder,
                    '35032': errors.ExchangeError,
                    '35037': errors.ExchangeError,
                    '35039': errors.InsufficientFunds,
                    '35040': errors.InvalidOrder,
                    '35044': errors.ExchangeError,
                    '35046': errors.InsufficientFunds,
                    '35047': errors.InsufficientFunds,
                    '35048': errors.ExchangeError,
                    '35049': errors.InvalidOrder,
                    '35050': errors.InvalidOrder,
                    '35052': errors.InsufficientFunds,
                    '35053': errors.ExchangeError,
                    '35055': errors.InsufficientFunds,
                    '35057': errors.ExchangeError,
                    '35058': errors.ExchangeError,
                    '35059': errors.BadRequest,
                    '35060': errors.BadRequest,
                    '35061': errors.BadRequest,
                    '35062': errors.InvalidOrder,
                    '35063': errors.InvalidOrder,
                    '35064': errors.InvalidOrder,
                    '35066': errors.InvalidOrder,
                    '35067': errors.InvalidOrder,
                    '35068': errors.InvalidOrder,
                    '35069': errors.InvalidOrder,
                    '35070': errors.InvalidOrder,
                    '35071': errors.InvalidOrder,
                    '35072': errors.InvalidOrder,
                    '35073': errors.InvalidOrder,
                    '35074': errors.InvalidOrder,
                    '35075': errors.InvalidOrder,
                    '35076': errors.InvalidOrder,
                    '35077': errors.InvalidOrder,
                    '35078': errors.InvalidOrder,
                    '35079': errors.InvalidOrder,
                    '35080': errors.InvalidOrder,
                    '35081': errors.InvalidOrder,
                    '35082': errors.InvalidOrder,
                    '35083': errors.InvalidOrder,
                    '35084': errors.InvalidOrder,
                    '35085': errors.InvalidOrder,
                    '35086': errors.InvalidOrder,
                    '35087': errors.InvalidOrder,
                    '35088': errors.InvalidOrder,
                    '35089': errors.InvalidOrder,
                    '35090': errors.ExchangeError,
                    '35091': errors.ExchangeError,
                    '35092': errors.ExchangeError,
                    '35093': errors.ExchangeError,
                    '35094': errors.ExchangeError,
                    '35095': errors.BadRequest,
                    '35096': errors.ExchangeError,
                    '35097': errors.ExchangeError,
                    '35098': errors.ExchangeError,
                    '35099': errors.ExchangeError,
                    '35102': errors.RateLimitExceeded,
                    // option
                    '36001': errors.BadRequest,
                    '36002': errors.BadRequest,
                    '36005': errors.ExchangeError,
                    '36101': errors.AuthenticationError,
                    '36102': errors.PermissionDenied,
                    '36103': errors.PermissionDenied,
                    '36104': errors.PermissionDenied,
                    '36105': errors.PermissionDenied,
                    '36106': errors.PermissionDenied,
                    '36107': errors.PermissionDenied,
                    '36108': errors.InsufficientFunds,
                    '36109': errors.PermissionDenied,
                    '36201': errors.PermissionDenied,
                    '36202': errors.PermissionDenied,
                    '36203': errors.InvalidOrder,
                    '36204': errors.ExchangeError,
                    '36205': errors.BadRequest,
                    '36206': errors.BadRequest,
                    '36207': errors.InvalidOrder,
                    '36208': errors.InvalidOrder,
                    '36209': errors.InvalidOrder,
                    '36210': errors.InvalidOrder,
                    '36211': errors.InvalidOrder,
                    '36212': errors.InvalidOrder,
                    '36213': errors.InvalidOrder,
                    '36214': errors.ExchangeError,
                    '36216': errors.OrderNotFound,
                    '36217': errors.InvalidOrder,
                    '36218': errors.InvalidOrder,
                    '36219': errors.InvalidOrder,
                    '36220': errors.InvalidOrder,
                    '36221': errors.InvalidOrder,
                    '36222': errors.InvalidOrder,
                    '36223': errors.InvalidOrder,
                    '36224': errors.InvalidOrder,
                    '36225': errors.InvalidOrder,
                    '36226': errors.InvalidOrder,
                    '36227': errors.InvalidOrder,
                    '36228': errors.InvalidOrder,
                    '36229': errors.InvalidOrder,
                    '36230': errors.InvalidOrder, // Exceeding max position limit for underlying.
                },
                'broad': {},
            },
            'precisionMode': number.TICK_SIZE,
            'options': {
                'fetchOHLCV': {
                    'type': 'Candles', // Candles or HistoryCandles
                },
                'createMarketBuyOrderRequiresPrice': true,
                'fetchMarkets': ['spot'],
                'defaultType': 'spot',
                'accountsByType': {
                    'spot': '1',
                    'funding': '6',
                    'main': '6',
                },
                'accountsById': {
                    '1': 'spot',
                    '6': 'funding',
                },
                'auth': {
                    'time': 'public',
                    'currencies': 'private',
                    'instruments': 'public',
                    'rate': 'public',
                    '{instrument_id}/constituents': 'public',
                },
                'warnOnFetchCurrenciesWithoutAuthorization': false,
            },
            'commonCurrencies': {
                // OKEX refers to ERC20 version of Aeternity (AEToken)
                'AE': 'AET',
                'BOX': 'DefiBox',
                'HOT': 'Hydro Protocol',
                'HSR': 'HC',
                'MAG': 'Maggie',
                'SBTC': 'Super Bitcoin',
                'TRADE': 'Unitrade',
                'YOYO': 'YOYOW',
                'WIN': 'WinToken', // https://github.com/ccxt/ccxt/issues/5701
            },
        });
    }
    async fetchTime(params = {}) {
        /**
         * @method
         * @name okcoin#fetchTime
         * @description fetches the current integer timestamp in milliseconds from the exchange server
         * @param {object} params extra parameters specific to the okcoin api endpoint
         * @returns {int} the current integer timestamp in milliseconds from the exchange server
         */
        const response = await this.generalGetTime(params);
        //
        //     {
        //         "iso": "2015-01-07T23:47:25.201Z",
        //         "epoch": 1420674445.201
        //     }
        //
        return this.parse8601(this.safeString(response, 'iso'));
    }
    async fetchMarkets(params = {}) {
        /**
         * @method
         * @name okcoin#fetchMarkets
         * @description retrieves data on all markets for okcoin
         * @param {object} params extra parameters specific to the exchange api endpoint
         * @returns {[object]} an array of objects representing market data
         */
        const types = this.safeValue(this.options, 'fetchMarkets');
        let result = [];
        for (let i = 0; i < types.length; i++) {
            const markets = await this.fetchMarketsByType(types[i], params);
            result = this.arrayConcat(result, markets);
        }
        return result;
    }
    parseMarkets(markets) {
        const result = [];
        for (let i = 0; i < markets.length; i++) {
            result.push(this.parseMarket(markets[i]));
        }
        return result;
    }
    parseMarket(market) {
        //
        // spot markets
        //
        //     {
        //         base_currency: "EOS",
        //         instrument_id: "EOS-OKB",
        //         min_size: "0.01",
        //         quote_currency: "OKB",
        //         size_increment: "0.000001",
        //         tick_size: "0.0001"
        //     }
        //
        // futures markets
        //
        //     {
        //         instrument_id: "XRP-USD-200320",
        //         underlying_index: "XRP",
        //         quote_currency: "USD",
        //         tick_size: "0.0001",
        //         contract_val: "10",
        //         listing: "2020-03-06",
        //         delivery: "2020-03-20",
        //         trade_increment: "1",
        //         alias: "this_week",
        //         underlying: "XRP-USD",
        //         base_currency: "XRP",
        //         settlement_currency: "XRP",
        //         is_inverse: "true",
        //         contract_val_currency: "USD",
        //     }
        //
        // swap markets
        //
        //     {
        //         instrument_id: "BSV-USD-SWAP",
        //         underlying_index: "BSV",
        //         quote_currency: "USD",
        //         coin: "BSV",
        //         contract_val: "10",
        //         listing: "2018-12-21T07:53:47.000Z",
        //         delivery: "2020-03-14T08:00:00.000Z",
        //         size_increment: "1",
        //         tick_size: "0.01",
        //         base_currency: "BSV",
        //         underlying: "BSV-USD",
        //         settlement_currency: "BSV",
        //         is_inverse: "true",
        //         contract_val_currency: "USD"
        //     }
        //
        // options markets
        //
        //     {
        //         instrument_id: 'BTC-USD-200327-4000-C',
        //         underlying: 'BTC-USD',
        //         settlement_currency: 'BTC',
        //         contract_val: '0.1000',
        //         option_type: 'C',
        //         strike: '4000',
        //         tick_size: '0.0005',
        //         lot_size: '1.0000',
        //         listing: '2019-12-25T08:30:36.302Z',
        //         delivery: '2020-03-27T08:00:00.000Z',
        //         state: '2',
        //         trading_start_time: '2019-12-25T08:30:36.302Z',
        //         timestamp: '2020-03-13T08:05:09.456Z',
        //     }
        //
        const id = this.safeString(market, 'instrument_id');
        let optionType = this.safeValue(market, 'option_type');
        const contractVal = this.safeNumber(market, 'contract_val');
        const contract = contractVal !== undefined;
        const futuresAlias = this.safeString(market, 'alias');
        let marketType = 'spot';
        const spot = !contract;
        const option = (optionType !== undefined);
        const future = !option && (futuresAlias !== undefined);
        const swap = contract && !future && !option;
        let baseId = this.safeString(market, 'base_currency');
        let quoteId = this.safeString(market, 'quote_currency');
        const settleId = this.safeString(market, 'settlement_currency');
        if (option) {
            const underlying = this.safeString(market, 'underlying');
            const parts = underlying.split('-');
            baseId = this.safeString(parts, 0);
            quoteId = this.safeString(parts, 1);
            marketType = 'option';
        }
        else if (future) {
            baseId = this.safeString(market, 'underlying_index');
            marketType = 'futures';
        }
        else if (swap) {
            marketType = 'swap';
        }
        const base = this.safeCurrencyCode(baseId);
        const quote = this.safeCurrencyCode(quoteId);
        const settle = this.safeCurrencyCode(settleId);
        let symbol = base + '/' + quote;
        let expiryDatetime = this.safeString(market, 'delivery');
        let expiry = undefined;
        const strike = this.safeValue(market, 'strike');
        if (contract) {
            symbol = symbol + ':' + settle;
            if (future || option) {
                if (future) {
                    expiryDatetime += 'T00:00:00Z';
                }
                expiry = this.parse8601(expiryDatetime);
                symbol = symbol + '-' + this.yymmdd(expiry);
                if (option) {
                    symbol = symbol + ':' + strike + ':' + optionType;
                    optionType = (optionType === 'C') ? 'call' : 'put';
                }
            }
        }
        const lotSize = this.safeNumber2(market, 'lot_size', 'trade_increment');
        const minPrice = this.safeString(market, 'tick_size');
        const minAmountString = this.safeString2(market, 'min_size', 'base_min_size');
        const minAmount = this.parseNumber(minAmountString);
        let minCost = undefined;
        if ((minAmount !== undefined) && (minPrice !== undefined)) {
            minCost = this.parseNumber(Precise["default"].stringMul(minPrice, minAmountString));
        }
        const fees = this.safeValue2(this.fees, marketType, 'trading', {});
        const maxLeverageString = this.safeString(market, 'max_leverage', '1');
        const maxLeverage = this.parseNumber(Precise["default"].stringMax(maxLeverageString, '1'));
        const precisionPrice = this.parseNumber(minPrice);
        return this.extend(fees, {
            'id': id,
            'symbol': symbol,
            'base': base,
            'quote': quote,
            'settle': settle,
            'baseId': baseId,
            'quoteId': quoteId,
            'settleId': settleId,
            'type': marketType,
            'spot': spot,
            'margin': false,
            'swap': swap,
            'future': future,
            'futures': future,
            'option': option,
            'active': true,
            'contract': contract,
            'linear': contract ? (quote === settle) : undefined,
            'inverse': contract ? (base === settle) : undefined,
            'contractSize': contractVal,
            'expiry': expiry,
            'expiryDatetime': this.iso8601(expiry),
            'strike': strike,
            'optionType': optionType,
            'precision': {
                'amount': this.safeNumber(market, 'size_increment', lotSize),
                'price': precisionPrice,
            },
            'limits': {
                'leverage': {
                    'min': this.parseNumber('1'),
                    'max': this.parseNumber(maxLeverage),
                },
                'amount': {
                    'min': minAmount,
                    'max': undefined,
                },
                'price': {
                    'min': precisionPrice,
                    'max': undefined,
                },
                'cost': {
                    'min': minCost,
                    'max': undefined,
                },
            },
            'info': market,
        });
    }
    async fetchMarketsByType(type, params = {}) {
        if (type === 'option') {
            const underlying = await this.optionGetUnderlying(params);
            let result = [];
            for (let i = 0; i < underlying.length; i++) {
                const response = await this.optionGetInstrumentsUnderlying({
                    'underlying': underlying[i],
                });
                //
                // options markets
                //
                //     [
                //         {
                //             instrument_id: 'BTC-USD-200327-4000-C',
                //             underlying: 'BTC-USD',
                //             settlement_currency: 'BTC',
                //             contract_val: '0.1000',
                //             option_type: 'C',
                //             strike: '4000',
                //             tick_size: '0.0005',
                //             lot_size: '1.0000',
                //             listing: '2019-12-25T08:30:36.302Z',
                //             delivery: '2020-03-27T08:00:00.000Z',
                //             state: '2',
                //             trading_start_time: '2019-12-25T08:30:36.302Z',
                //             timestamp: '2020-03-13T08:05:09.456Z',
                //         },
                //     ]
                //
                result = this.arrayConcat(result, response);
            }
            return this.parseMarkets(result);
        }
        else if ((type === 'spot') || (type === 'futures') || (type === 'swap')) {
            const method = type + 'GetInstruments';
            const response = await this[method](params);
            //
            // spot markets
            //
            //     [
            //         {
            //             base_currency: "EOS",
            //             instrument_id: "EOS-OKB",
            //             min_size: "0.01",
            //             quote_currency: "OKB",
            //             size_increment: "0.000001",
            //             tick_size: "0.0001"
            //         }
            //     ]
            //
            // futures markets
            //
            //     [
            //         {
            //             instrument_id: "XRP-USD-200320",
            //             underlying_index: "XRP",
            //             quote_currency: "USD",
            //             tick_size: "0.0001",
            //             contract_val: "10",
            //             listing: "2020-03-06",
            //             delivery: "2020-03-20",
            //             trade_increment: "1",
            //             alias: "this_week",
            //             underlying: "XRP-USD",
            //             base_currency: "XRP",
            //             settlement_currency: "XRP",
            //             is_inverse: "true",
            //             contract_val_currency: "USD",
            //         }
            //     ]
            //
            // swap markets
            //
            //     [
            //         {
            //             instrument_id: "BSV-USD-SWAP",
            //             underlying_index: "BSV",
            //             quote_currency: "USD",
            //             coin: "BSV",
            //             contract_val: "10",
            //             listing: "2018-12-21T07:53:47.000Z",
            //             delivery: "2020-03-14T08:00:00.000Z",
            //             size_increment: "1",
            //             tick_size: "0.01",
            //             base_currency: "BSV",
            //             underlying: "BSV-USD",
            //             settlement_currency: "BSV",
            //             is_inverse: "true",
            //             contract_val_currency: "USD"
            //         }
            //     ]
            //
            return this.parseMarkets(response);
        }
        else {
            throw new errors.NotSupported(this.id + ' fetchMarketsByType() does not support market type ' + type);
        }
    }
    async fetchCurrencies(params = {}) {
        /**
         * @method
         * @name okcoin#fetchCurrencies
         * @description fetches all available currencies on an exchange
         * @param {object} params extra parameters specific to the okcoin api endpoint
         * @returns {object} an associative dictionary of currencies
         */
        // despite that their docs say these endpoints are public:
        //     https://www.okex.com/api/account/v3/withdrawal/fee
        //     https://www.okex.com/api/account/v3/currencies
        // it will still reply with { "code":30001, "message": "OK-ACCESS-KEY header is required" }
        // if you attempt to access it without authentication
        if (!this.checkRequiredCredentials(false)) {
            if (this.options['warnOnFetchCurrenciesWithoutAuthorization']) {
                throw new errors.ExchangeError(this.id + ' fetchCurrencies() is a private API endpoint that requires authentication with API keys. Set the API keys on the exchange instance or exchange.options["warnOnFetchCurrenciesWithoutAuthorization"] = false to suppress this warning message.');
            }
            return undefined;
        }
        else {
            const response = await this.accountGetCurrencies(params);
            //
            //     [
            //         {
            //             name: '',
            //             currency: 'BTC',
            //             can_withdraw: '1',
            //             can_deposit: '1',
            //             min_withdrawal: '0.0100000000000000'
            //         },
            //     ]
            //
            const result = {};
            for (let i = 0; i < response.length; i++) {
                const currency = response[i];
                const id = this.safeString(currency, 'currency');
                const code = this.safeCurrencyCode(id);
                const name = this.safeString(currency, 'name');
                const canDeposit = this.safeInteger(currency, 'can_deposit');
                const canWithdraw = this.safeInteger(currency, 'can_withdraw');
                const depositEnabled = (canDeposit === 1);
                const withdrawEnabled = (canWithdraw === 1);
                const active = (canDeposit && canWithdraw) ? true : false;
                result[code] = {
                    'id': id,
                    'code': code,
                    'info': currency,
                    'type': undefined,
                    'name': name,
                    'active': active,
                    'deposit': depositEnabled,
                    'withdraw': withdrawEnabled,
                    'fee': undefined,
                    'precision': this.parseNumber('1e-8'),
                    'limits': {
                        'amount': { 'min': undefined, 'max': undefined },
                        'withdraw': {
                            'min': this.safeNumber(currency, 'min_withdrawal'),
                            'max': undefined,
                        },
                    },
                };
            }
            return result;
        }
    }
    async fetchOrderBook(symbol, limit = undefined, params = {}) {
        /**
         * @method
         * @name okcoin#fetchOrderBook
         * @description fetches information on open orders with bid (buy) and ask (sell) prices, volumes and other data
         * @param {string} symbol unified symbol of the market to fetch the order book for
         * @param {int|undefined} limit the maximum amount of order book entries to return
         * @param {object} params extra parameters specific to the okcoin api endpoint
         * @returns {object} A dictionary of [order book structures]{@link https://docs.ccxt.com/#/?id=order-book-structure} indexed by market symbols
         */
        await this.loadMarkets();
        const market = this.market(symbol);
        let method = market['type'] + 'GetInstrumentsInstrumentId';
        method += (market['type'] === 'swap') ? 'Depth' : 'Book';
        const request = {
            'instrument_id': market['id'],
        };
        if (limit !== undefined) {
            request['size'] = limit; // max 200
        }
        const response = await this[method](this.extend(request, params));
        //
        // spot
        //
        //     {      asks: [ ["0.02685268", "0.242571", "1"],
        //                    ["0.02685493", "0.164085", "1"],
        //                    ...
        //                    ["0.02779", "1.039", "1"],
        //                    ["0.027813", "0.0876", "1"]        ],
        //            bids: [ ["0.02684052", "10.371849", "1"],
        //                    ["0.02684051", "3.707", "4"],
        //                    ...
        //                    ["0.02634963", "0.132934", "1"],
        //                    ["0.02634962", "0.264838", "2"]    ],
        //       timestamp:   "2018-12-17T20:24:16.159Z"            }
        //
        // swap
        //
        //     {
        //         "asks":[
        //             ["916.21","94","0","1"]
        //         ],
        //         "bids":[
        //             ["916.1","15","0","1"]
        //         ],
        //         "time":"2021-04-16T02:04:48.282Z"
        //     }
        //
        const timestamp = this.parse8601(this.safeString2(response, 'timestamp', 'time'));
        return this.parseOrderBook(response, symbol, timestamp);
    }
    parseTicker(ticker, market = undefined) {
        //
        //     {         best_ask: "0.02665472",
        //               best_bid: "0.02665221",
        //          instrument_id: "ETH-BTC",
        //             product_id: "ETH-BTC",
        //                   last: "0.02665472",
        //                    ask: "0.02665472", // missing in the docs
        //                    bid: "0.02665221", // not mentioned in the docs
        //               open_24h: "0.02645482",
        //               high_24h: "0.02714633",
        //                low_24h: "0.02614109",
        //        base_volume_24h: "572298.901923",
        //              timestamp: "2018-12-17T21:20:07.856Z",
        //       quote_volume_24h: "15094.86831261"            }
        //
        const timestamp = this.parse8601(this.safeString(ticker, 'timestamp'));
        const marketId = this.safeString(ticker, 'instrument_id');
        market = this.safeMarket(marketId, market, '-');
        const symbol = market['symbol'];
        const last = this.safeString(ticker, 'last');
        const open = this.safeString(ticker, 'open_24h');
        return this.safeTicker({
            'symbol': symbol,
            'timestamp': timestamp,
            'datetime': this.iso8601(timestamp),
            'high': this.safeString(ticker, 'high_24h'),
            'low': this.safeString(ticker, 'low_24h'),
            'bid': this.safeString(ticker, 'best_bid'),
            'bidVolume': this.safeString(ticker, 'best_bid_size'),
            'ask': this.safeString(ticker, 'best_ask'),
            'askVolume': this.safeString(ticker, 'best_ask_size'),
            'vwap': undefined,
            'open': open,
            'close': last,
            'last': last,
            'previousClose': undefined,
            'change': undefined,
            'percentage': undefined,
            'average': undefined,
            'baseVolume': this.safeString(ticker, 'base_volume_24h'),
            'quoteVolume': this.safeString(ticker, 'quote_volume_24h'),
            'info': ticker,
        }, market);
    }
    async fetchTicker(symbol, params = {}) {
        /**
         * @method
         * @name okcoin#fetchTicker
         * @description fetches a price ticker, a statistical calculation with the information calculated over the past 24 hours for a specific market
         * @param {string} symbol unified symbol of the market to fetch the ticker for
         * @param {object} params extra parameters specific to the okcoin api endpoint
         * @returns {object} a [ticker structure]{@link https://docs.ccxt.com/#/?id=ticker-structure}
         */
        await this.loadMarkets();
        const market = this.market(symbol);
        const method = market['type'] + 'GetInstrumentsInstrumentIdTicker';
        const request = {
            'instrument_id': market['id'],
        };
        const response = await this[method](this.extend(request, params));
        //
        //     {         best_ask: "0.02665472",
        //               best_bid: "0.02665221",
        //          instrument_id: "ETH-BTC",
        //             product_id: "ETH-BTC",
        //                   last: "0.02665472",
        //                    ask: "0.02665472",
        //                    bid: "0.02665221",
        //               open_24h: "0.02645482",
        //               high_24h: "0.02714633",
        //                low_24h: "0.02614109",
        //        base_volume_24h: "572298.901923",
        //              timestamp: "2018-12-17T21:20:07.856Z",
        //       quote_volume_24h: "15094.86831261"            }
        //
        return this.parseTicker(response);
    }
    async fetchTickersByType(type, symbols = undefined, params = {}) {
        await this.loadMarkets();
        symbols = this.marketSymbols(symbols);
        const method = type + 'GetInstrumentsTicker';
        const response = await this[method](params);
        const result = {};
        for (let i = 0; i < response.length; i++) {
            const ticker = this.parseTicker(response[i]);
            const symbol = ticker['symbol'];
            result[symbol] = ticker;
        }
        return this.filterByArray(result, 'symbol', symbols);
    }
    async fetchTickers(symbols = undefined, params = {}) {
        /**
         * @method
         * @name okcoin#fetchTickers
         * @description fetches price tickers for multiple markets, statistical calculations with the information calculated over the past 24 hours each market
         * @param {[string]|undefined} symbols unified symbols of the markets to fetch the ticker for, all market tickers are returned if not assigned
         * @param {object} params extra parameters specific to the okcoin api endpoint
         * @returns {object} a dictionary of [ticker structures]{@link https://docs.ccxt.com/#/?id=ticker-structure}
         */
        symbols = this.marketSymbols(symbols);
        const first = this.safeString(symbols, 0);
        let market = undefined;
        if (first !== undefined) {
            market = this.market(first);
        }
        let type = undefined;
        [type, params] = this.handleMarketTypeAndParams('fetchTickers', market, params);
        return await this.fetchTickersByType(type, symbols, this.omit(params, 'type'));
    }
    parseTrade(trade, market = undefined) {
        //
        // fetchTrades (public)
        //
        //     spot trades
        //
        //         {
        //             time: "2018-12-17T23:31:08.268Z",
        //             timestamp: "2018-12-17T23:31:08.268Z",
        //             trade_id: "409687906",
        //             price: "0.02677805",
        //             size: "0.923467",
        //             side: "sell"
        //         }
        //
        //     futures trades, swap trades
        //
        //         {
        //             trade_id: "1989230840021013",
        //             side: "buy",
        //             price: "92.42",
        //             qty: "184", // missing in swap markets
        //             size: "5", // missing in futures markets
        //             timestamp: "2018-12-17T23:26:04.613Z"
        //         }
        //
        // fetchOrderTrades (private)
        //
        //     spot trades
        //
        //         {
        //             "created_at":"2019-03-15T02:52:56.000Z",
        //             "exec_type":"T", // whether the order is taker or maker
        //             "fee":"0.00000082",
        //             "instrument_id":"BTC-USDT",
        //             "ledger_id":"3963052721",
        //             "liquidity":"T", // whether the order is taker or maker
        //             "order_id":"2482659399697408",
        //             "price":"3888.6",
        //             "product_id":"BTC-USDT",
        //             "side":"buy",
        //             "size":"0.00055306",
        //             "timestamp":"2019-03-15T02:52:56.000Z"
        //         },
        //
        //     futures trades, swap trades
        //
        //         {
        //             "trade_id":"197429674631450625",
        //             "instrument_id":"EOS-USD-SWAP",
        //             "order_id":"6a-7-54d663a28-0",
        //             "price":"3.633",
        //             "order_qty":"1.0000",
        //             "fee":"-0.000551",
        //             "created_at":"2019-03-21T04:41:58.0Z", // missing in swap trades
        //             "timestamp":"2019-03-25T05:56:31.287Z", // missing in futures trades
        //             "exec_type":"M", // whether the order is taker or maker
        //             "side":"short", // "buy" in futures trades
        //         }
        //
        const marketId = this.safeString(trade, 'instrument_id');
        market = this.safeMarket(marketId, market, '-');
        const symbol = market['symbol'];
        const timestamp = this.parse8601(this.safeString2(trade, 'timestamp', 'created_at'));
        const priceString = this.safeString(trade, 'price');
        let amountString = this.safeString2(trade, 'size', 'qty');
        amountString = this.safeString(trade, 'order_qty', amountString);
        let takerOrMaker = this.safeString2(trade, 'exec_type', 'liquidity');
        if (takerOrMaker === 'M') {
            takerOrMaker = 'maker';
        }
        else if (takerOrMaker === 'T') {
            takerOrMaker = 'taker';
        }
        const side = this.safeString(trade, 'side');
        const feeCostString = this.safeString(trade, 'fee');
        let fee = undefined;
        if (feeCostString !== undefined) {
            const feeCurrency = (side === 'buy') ? market['base'] : market['quote'];
            fee = {
                // fee is either a positive number (invitation rebate)
                // or a negative number (transaction fee deduction)
                // therefore we need to invert the fee
                // more about it https://github.com/ccxt/ccxt/issues/5909
                'cost': Precise["default"].stringNeg(feeCostString),
                'currency': feeCurrency,
            };
        }
        const orderId = this.safeString(trade, 'order_id');
        return this.safeTrade({
            'info': trade,
            'timestamp': timestamp,
            'datetime': this.iso8601(timestamp),
            'symbol': symbol,
            'id': this.safeString2(trade, 'trade_id', 'ledger_id'),
            'order': orderId,
            'type': undefined,
            'takerOrMaker': takerOrMaker,
            'side': side,
            'price': priceString,
            'amount': amountString,
            'cost': undefined,
            'fee': fee,
        }, market);
    }
    async fetchTrades(symbol, since = undefined, limit = undefined, params = {}) {
        /**
         * @method
         * @name okcoin#fetchTrades
         * @description get the list of most recent trades for a particular symbol
         * @param {string} symbol unified symbol of the market to fetch trades for
         * @param {int|undefined} since timestamp in ms of the earliest trade to fetch
         * @param {int|undefined} limit the maximum amount of trades to fetch
         * @param {object} params extra parameters specific to the okcoin api endpoint
         * @returns {[object]} a list of [trade structures]{@link https://docs.ccxt.com/en/latest/manual.html?#public-trades}
         */
        await this.loadMarkets();
        const market = this.market(symbol);
        const method = market['type'] + 'GetInstrumentsInstrumentIdTrades';
        if ((limit === undefined) || (limit > 100)) {
            limit = 100; // maximum = default = 100
        }
        const request = {
            'instrument_id': market['id'],
            'limit': limit,
            // from: 'id',
            // to: 'id',
        };
        const response = await this[method](this.extend(request, params));
        //
        // spot markets
        //
        //     [
        //         {
        //             time: "2018-12-17T23:31:08.268Z",
        //             timestamp: "2018-12-17T23:31:08.268Z",
        //             trade_id: "409687906",
        //             price: "0.02677805",
        //             size: "0.923467",
        //             side: "sell"
        //         }
        //     ]
        //
        // futures markets, swap markets
        //
        //     [
        //         {
        //             trade_id: "1989230840021013",
        //             side: "buy",
        //             price: "92.42",
        //             qty: "184", // missing in swap markets
        //             size: "5", // missing in futures markets
        //             timestamp: "2018-12-17T23:26:04.613Z"
        //         }
        //     ]
        //
        return this.parseTrades(response, market, since, limit);
    }
    parseOHLCV(ohlcv, market = undefined) {
        //
        // spot markets
        //
        //     {
        //         close: "0.02684545",
        //         high: "0.02685084",
        //         low: "0.02683312",
        //         open: "0.02683894",
        //         time: "2018-12-17T20:28:00.000Z",
        //         volume: "101.457222"
        //     }
        //
        // futures markets
        //
        //     [
        //         1545072720000,
        //         0.3159,
        //         0.3161,
        //         0.3144,
        //         0.3149,
        //         22886,
        //         725179.26172331,
        //     ]
        //
        if (Array.isArray(ohlcv)) {
            const numElements = ohlcv.length;
            const volumeIndex = (numElements > 6) ? 6 : 5;
            let timestamp = this.safeValue(ohlcv, 0);
            if (typeof timestamp === 'string') {
                timestamp = this.parse8601(timestamp);
            }
            return [
                timestamp,
                this.safeNumber(ohlcv, 1),
                this.safeNumber(ohlcv, 2),
                this.safeNumber(ohlcv, 3),
                this.safeNumber(ohlcv, 4),
                // this.safeNumber (ohlcv, 5),         // Quote Volume
                // this.safeNumber (ohlcv, 6),         // Base Volume
                this.safeNumber(ohlcv, volumeIndex), // Volume, okex will return base volume in the 7th element for future markets
            ];
        }
        else {
            return [
                this.parse8601(this.safeString(ohlcv, 'time')),
                this.safeNumber(ohlcv, 'open'),
                this.safeNumber(ohlcv, 'high'),
                this.safeNumber(ohlcv, 'low'),
                this.safeNumber(ohlcv, 'close'),
                this.safeNumber(ohlcv, 'volume'), // Base Volume
            ];
        }
    }
    async fetchOHLCV(symbol, timeframe = '1m', since = undefined, limit = undefined, params = {}) {
        /**
         * @method
         * @name okcoin#fetchOHLCV
         * @description fetches historical candlestick data containing the open, high, low, and close price, and the volume of a market
         * @param {string} symbol unified symbol of the market to fetch OHLCV data for
         * @param {string} timeframe the length of time each candle represents
         * @param {int|undefined} since timestamp in ms of the earliest candle to fetch
         * @param {int|undefined} limit the maximum amount of candles to fetch
         * @param {object} params extra parameters specific to the okcoin api endpoint
         * @returns {[[int]]} A list of candles ordered as timestamp, open, high, low, close, volume
         */
        await this.loadMarkets();
        const market = this.market(symbol);
        const duration = this.parseTimeframe(timeframe);
        const request = {
            'instrument_id': market['id'],
            'granularity': this.safeString(this.timeframes, timeframe, timeframe),
        };
        const options = this.safeValue(this.options, 'fetchOHLCV', {});
        const defaultType = this.safeString(options, 'type', 'Candles'); // Candles or HistoryCandles
        const type = this.safeString(params, 'type', defaultType);
        params = this.omit(params, 'type');
        const method = market['type'] + 'GetInstrumentsInstrumentId' + type;
        if (type === 'Candles') {
            if (since !== undefined) {
                if (limit !== undefined) {
                    request['end'] = this.iso8601(this.sum(since, limit * duration * 1000));
                }
                request['start'] = this.iso8601(since);
            }
            else {
                if (limit !== undefined) {
                    const now = this.milliseconds();
                    request['start'] = this.iso8601(now - limit * duration * 1000);
                    request['end'] = this.iso8601(now);
                }
            }
        }
        else if (type === 'HistoryCandles') {
            if (market['option']) {
                throw new errors.NotSupported(this.id + ' fetchOHLCV() does not have ' + type + ' for ' + market['type'] + ' markets');
            }
            if (since !== undefined) {
                if (limit === undefined) {
                    limit = 300; // default
                }
                request['start'] = this.iso8601(this.sum(since, limit * duration * 1000));
                request['end'] = this.iso8601(since);
            }
            else {
                if (limit !== undefined) {
                    const now = this.milliseconds();
                    request['end'] = this.iso8601(now - limit * duration * 1000);
                    request['start'] = this.iso8601(now);
                }
            }
        }
        const response = await this[method](this.extend(request, params));
        //
        // spot markets
        //
        //     [
        //         {
        //             close: "0.02683401",
        //             high: "0.02683401",
        //             low: "0.02683401",
        //             open: "0.02683401",
        //             time: "2018-12-17T23:47:00.000Z",
        //             volume: "0"
        //         },
        //         {
        //             close: "0.02684545",
        //             high: "0.02685084",
        //             low: "0.02683312",
        //             open: "0.02683894",
        //             time: "2018-12-17T20:28:00.000Z",
        //             volume: "101.457222"
        //         }
        //     ]
        //
        // futures
        //
        //     [
        //         [
        //             1545090660000,
        //             0.3171,
        //             0.3174,
        //             0.3171,
        //             0.3173,
        //             1648,
        //             51930.38579450868
        //         ],
        //         [
        //             1545072720000,
        //             0.3159,
        //             0.3161,
        //             0.3144,
        //             0.3149,
        //             22886,
        //             725179.26172331
        //         ]
        //     ]
        //
        return this.parseOHLCVs(response, market, timeframe, since, limit);
    }
    parseAccountBalance(response) {
        //
        // account
        //
        //     [
        //         {
        //             balance:  0,
        //             available:  0,
        //             currency: "BTC",
        //             hold:  0
        //         },
        //         {
        //             balance:  0,
        //             available:  0,
        //             currency: "ETH",
        //             hold:  0
        //         }
        //     ]
        //
        // spot
        //
        //     [
        //         {
        //             frozen: "0",
        //             hold: "0",
        //             id: "2149632",
        //             currency: "BTC",
        //             balance: "0.0000000497717339",
        //             available: "0.0000000497717339",
        //             holds: "0"
        //         },
        //         {
        //             frozen: "0",
        //             hold: "0",
        //             id: "2149632",
        //             currency: "ICN",
        //             balance: "0.00000000925",
        //             available: "0.00000000925",
        //             holds: "0"
        //         }
        //     ]
        //
        const result = {
            'info': response,
            'timestamp': undefined,
            'datetime': undefined,
        };
        for (let i = 0; i < response.length; i++) {
            const balance = response[i];
            const currencyId = this.safeString(balance, 'currency');
            const code = this.safeCurrencyCode(currencyId);
            const account = this.account();
            account['total'] = this.safeString(balance, 'balance');
            account['used'] = this.safeString(balance, 'hold');
            account['free'] = this.safeString(balance, 'available');
            result[code] = account;
        }
        return this.safeBalance(result);
    }
    parseFuturesBalance(response) {
        //
        //     {
        //         "info":{
        //             "eos":{
        //                 "auto_margin":"0",
        //                 "contracts": [
        //                     {
        //                         "available_qty":"40.37069445",
        //                         "fixed_balance":"0",
        //                         "instrument_id":"EOS-USD-190329",
        //                         "margin_for_unfilled":"0",
        //                         "margin_frozen":"0",
        //                         "realized_pnl":"0",
        //                         "unrealized_pnl":"0"
        //                     },
        //                     {
        //                         "available_qty":"40.37069445",
        //                         "fixed_balance":"14.54895721",
        //                         "instrument_id":"EOS-USD-190628",
        //                         "margin_for_unfilled":"0",
        //                         "margin_frozen":"10.64042157",
        //                         "realized_pnl":"-3.90853564",
        //                         "unrealized_pnl":"-0.259"
        //                     },
        //                 ],
        //                 "equity":"50.75220665",
        //                 "margin_mode":"fixed",
        //                 "total_avail_balance":"40.37069445"
        //             },
        //         }
        //     }
        //
        // their root field name is "info", so our info will contain their info
        const result = {
            'info': response,
            'timestamp': undefined,
            'datetime': undefined,
        };
        const info = this.safeValue(response, 'info', {});
        const ids = Object.keys(info);
        for (let i = 0; i < ids.length; i++) {
            const id = ids[i];
            const code = this.safeCurrencyCode(id);
            const balance = this.safeValue(info, id, {});
            const account = this.account();
            const totalAvailBalance = this.safeString(balance, 'total_avail_balance');
            if (this.safeString(balance, 'margin_mode') === 'fixed') {
                const contracts = this.safeValue(balance, 'contracts', []);
                let free = totalAvailBalance;
                for (let i = 0; i < contracts.length; i++) {
                    const contract = contracts[i];
                    const fixedBalance = this.safeString(contract, 'fixed_balance');
                    const realizedPnl = this.safeString(contract, 'realized_pnl');
                    const marginFrozen = this.safeString(contract, 'margin_frozen');
                    const marginForUnfilled = this.safeString(contract, 'margin_for_unfilled');
                    const margin = Precise["default"].stringSub(Precise["default"].stringSub(Precise["default"].stringAdd(fixedBalance, realizedPnl), marginFrozen), marginForUnfilled);
                    free = Precise["default"].stringAdd(free, margin);
                }
                account['free'] = free;
            }
            else {
                const realizedPnl = this.safeString(balance, 'realized_pnl');
                const unrealizedPnl = this.safeString(balance, 'unrealized_pnl');
                const marginFrozen = this.safeString(balance, 'margin_frozen');
                const marginForUnfilled = this.safeString(balance, 'margin_for_unfilled');
                const positive = Precise["default"].stringAdd(Precise["default"].stringAdd(totalAvailBalance, realizedPnl), unrealizedPnl);
                account['free'] = Precise["default"].stringSub(Precise["default"].stringSub(positive, marginFrozen), marginForUnfilled);
            }
            // it may be incorrect to use total, free and used for swap accounts
            account['total'] = this.safeString(balance, 'equity');
            result[code] = account;
        }
        return this.safeBalance(result);
    }
    parseSwapBalance(response) {
        //
        //     {
        //         "info": [
        //             {
        //                 "equity":"3.0139",
        //                 "fixed_balance":"0.0000",
        //                 "instrument_id":"EOS-USD-SWAP",
        //                 "margin":"0.5523",
        //                 "margin_frozen":"0.0000",
        //                 "margin_mode":"crossed",
        //                 "margin_ratio":"1.0913",
        //                 "realized_pnl":"-0.0006",
        //                 "timestamp":"2019-03-25T03:46:10.336Z",
        //                 "total_avail_balance":"3.0000",
        //                 "unrealized_pnl":"0.0145"
        //             }
        //         ]
        //     }
        //
        // their root field name is "info", so our info will contain their info
        const result = { 'info': response };
        let timestamp = undefined;
        const info = this.safeValue(response, 'info', []);
        for (let i = 0; i < info.length; i++) {
            const balance = info[i];
            const marketId = this.safeString(balance, 'instrument_id');
            const symbol = this.safeSymbol(marketId);
            const balanceTimestamp = this.parse8601(this.safeString(balance, 'timestamp'));
            timestamp = (timestamp === undefined) ? balanceTimestamp : Math.max(timestamp, balanceTimestamp);
            const account = this.account();
            // it may be incorrect to use total, free and used for swap accounts
            account['total'] = this.safeString(balance, 'equity');
            account['free'] = this.safeString(balance, 'total_avail_balance');
            result[symbol] = account;
        }
        result['timestamp'] = timestamp;
        result['datetime'] = this.iso8601(timestamp);
        return this.safeBalance(result);
    }
    async fetchBalance(params = {}) {
        /**
         * @method
         * @name okcoin#fetchBalance
         * @description query for balance and get the amount of funds available for trading or funds locked in orders
         * @param {object} params extra parameters specific to the okcoin api endpoint
         * @returns {object} a [balance structure]{@link https://docs.ccxt.com/en/latest/manual.html?#balance-structure}
         */
        const defaultType = this.safeString2(this.options, 'fetchBalance', 'defaultType');
        const type = this.safeString(params, 'type', defaultType);
        if (type === undefined) {
            throw new errors.ArgumentsRequired(this.id + " fetchBalance() requires a type parameter (one of 'account', 'spot', 'futures', 'swap')");
        }
        await this.loadMarkets();
        const suffix = (type === 'account') ? 'Wallet' : 'Accounts';
        const method = type + 'Get' + suffix;
        const query = this.omit(params, 'type');
        const response = await this[method](query);
        //
        // account
        //
        //     [
        //         {
        //             balance:  0,
        //             available:  0,
        //             currency: "BTC",
        //             hold:  0
        //         },
        //         {
        //             balance:  0,
        //             available:  0,
        //             currency: "ETH",
        //             hold:  0
        //         }
        //     ]
        //
        // spot
        //
        //     [
        //         {
        //             frozen: "0",
        //             hold: "0",
        //             id: "2149632",
        //             currency: "BTC",
        //             balance: "0.0000000497717339",
        //             available: "0.0000000497717339",
        //             holds: "0"
        //         },
        //         {
        //             frozen: "0",
        //             hold: "0",
        //             id: "2149632",
        //             currency: "ICN",
        //             balance: "0.00000000925",
        //             available: "0.00000000925",
        //             holds: "0"
        //         }
        //     ]
        //
        //
        // futures
        //
        //     {
        //         "info":{
        //             "eos":{
        //                 "auto_margin":"0",
        //                 "contracts": [
        //                     {
        //                         "available_qty":"40.37069445",
        //                         "fixed_balance":"0",
        //                         "instrument_id":"EOS-USD-190329",
        //                         "margin_for_unfilled":"0",
        //                         "margin_frozen":"0",
        //                         "realized_pnl":"0",
        //                         "unrealized_pnl":"0"
        //                     },
        //                     {
        //                         "available_qty":"40.37069445",
        //                         "fixed_balance":"14.54895721",
        //                         "instrument_id":"EOS-USD-190628",
        //                         "margin_for_unfilled":"0",
        //                         "margin_frozen":"10.64042157",
        //                         "realized_pnl":"-3.90853564",
        //                         "unrealized_pnl":"-0.259"
        //                     },
        //                 ],
        //                 "equity":"50.75220665",
        //                 "margin_mode":"fixed",
        //                 "total_avail_balance":"40.37069445"
        //             },
        //         }
        //     }
        //
        // swap
        //
        //     {
        //         "info": [
        //             {
        //                 "equity":"3.0139",
        //                 "fixed_balance":"0.0000",
        //                 "instrument_id":"EOS-USD-SWAP",
        //                 "margin":"0.5523",
        //                 "margin_frozen":"0.0000",
        //                 "margin_mode":"crossed",
        //                 "margin_ratio":"1.0913",
        //                 "realized_pnl":"-0.0006",
        //                 "timestamp":"2019-03-25T03:46:10.336Z",
        //                 "total_avail_balance":"3.0000",
        //                 "unrealized_pnl":"0.0145"
        //             }
        //         ]
        //     }
        //
        return this.parseBalanceByType(type, response);
    }
    parseBalanceByType(type, response) {
        if ((type === 'account') || (type === 'spot')) {
            return this.parseAccountBalance(response);
        }
        else if (type === 'futures') {
            return this.parseFuturesBalance(response);
        }
        else if (type === 'swap') {
            return this.parseSwapBalance(response);
        }
        throw new errors.NotSupported(this.id + " fetchBalance does not support the '" + type + "' type (the type must be one of 'account', 'spot', 'futures', 'swap')");
    }
    async createOrder(symbol, type, side, amount, price = undefined, params = {}) {
        /**
         * @method
         * @name okcoin#createOrder
         * @description create a trade order
         * @param {string} symbol unified symbol of the market to create an order in
         * @param {string} type 'market' or 'limit'
         * @param {string} side 'buy' or 'sell'
         * @param {float} amount how much of currency you want to trade in units of base currency
         * @param {float|undefined} price the price at which the order is to be fullfilled, in units of the quote currency, ignored in market orders
         * @param {object} params extra parameters specific to the okcoin api endpoint
         * @returns {object} an [order structure]{@link https://docs.ccxt.com/#/?id=order-structure}
         */
        await this.loadMarkets();
        const market = this.market(symbol);
        let request = {
            'instrument_id': market['id'],
            // 'client_oid': 'abcdef1234567890', // [a-z0-9]{1,32}
            // 'order_type': '0', // 0 = Normal limit order, 1 = Post only, 2 = Fill Or Kill, 3 = Immediatel Or Cancel, 4 = Market for futures only
        };
        const clientOrderId = this.safeString2(params, 'client_oid', 'clientOrderId');
        if (clientOrderId !== undefined) {
            request['client_oid'] = clientOrderId;
            params = this.omit(params, ['client_oid', 'clientOrderId']);
        }
        let method = undefined;
        if (market['futures'] || market['swap']) {
            const size = market['futures'] ? this.numberToString(amount) : this.amountToPrecision(symbol, amount);
            request = this.extend(request, {
                'type': type,
                'size': size,
                // 'match_price': '0', // Order at best counter party price? (0:no 1:yes). The default is 0. If it is set as 1, the price parameter will be ignored. When posting orders at best bid price, order_type can only be 0 (regular order).
            });
            const orderType = this.safeString(params, 'order_type');
            // order_type === '4' means a market order
            const isMarketOrder = (type === 'market') || (orderType === '4');
            if (isMarketOrder) {
                request['order_type'] = '4';
            }
            else {
                request['price'] = this.priceToPrecision(symbol, price);
            }
            if (market['futures']) {
                request['leverage'] = '10'; // or '20'
            }
            method = market['type'] + 'PostOrder';
        }
        else {
            request = this.extend(request, {
                'side': side,
                'type': type, // limit/market
            });
            if (type === 'limit') {
                request['price'] = this.priceToPrecision(symbol, price);
                request['size'] = this.amountToPrecision(symbol, amount);
            }
            else if (type === 'market') {
                // for market buy it requires the amount of quote currency to spend
                if (side === 'buy') {
                    let notional = this.safeNumber(params, 'notional');
                    const createMarketBuyOrderRequiresPrice = this.safeValue(this.options, 'createMarketBuyOrderRequiresPrice', true);
                    if (createMarketBuyOrderRequiresPrice) {
                        if (price !== undefined) {
                            if (notional === undefined) {
                                notional = amount * price;
                            }
                        }
                        else if (notional === undefined) {
                            throw new errors.InvalidOrder(this.id + " createOrder() requires the price argument with market buy orders to calculate total order cost (amount to spend), where cost = amount * price. Supply a price argument to createOrder() call if you want the cost to be calculated for you from price and amount, or, alternatively, add .options['createMarketBuyOrderRequiresPrice'] = false and supply the total cost value in the 'amount' argument or in the 'notional' extra parameter (the exchange-specific behaviour)");
                        }
                    }
                    else {
                        notional = (notional === undefined) ? amount : notional;
                    }
                    request['notional'] = this.costToPrecision(symbol, notional);
                }
                else {
                    request['size'] = this.amountToPrecision(symbol, amount);
                }
            }
            method = 'spotPostOrders';
        }
        const response = await this[method](this.extend(request, params));
        //
        //     {
        //         "client_oid":"oktspot79",
        //         "error_code":"",
        //         "error_message":"",
        //         "order_id":"2510789768709120",
        //         "result":true
        //     }
        //
        const order = this.parseOrder(response, market);
        return this.extend(order, {
            'type': type,
            'side': side,
        });
    }
    async cancelOrder(id, symbol = undefined, params = {}) {
        /**
         * @method
         * @name okcoin#cancelOrder
         * @description cancels an open order
         * @param {string} id order id
         * @param {string} symbol unified symbol of the market the order was made in
         * @param {object} params extra parameters specific to the okcoin api endpoint
         * @returns {object} An [order structure]{@link https://docs.ccxt.com/#/?id=order-structure}
         */
        if (symbol === undefined) {
            throw new errors.ArgumentsRequired(this.id + ' cancelOrder() requires a symbol argument');
        }
        await this.loadMarkets();
        const market = this.market(symbol);
        let type = undefined;
        if (market['futures'] || market['swap']) {
            type = market['type'];
        }
        else {
            const defaultType = this.safeString2(this.options, 'cancelOrder', 'defaultType', market['type']);
            type = this.safeString(params, 'type', defaultType);
        }
        if (type === undefined) {
            throw new errors.ArgumentsRequired(this.id + " cancelOrder() requires a type parameter (one of 'spot', 'futures', 'swap').");
        }
        let method = type + 'PostCancelOrder';
        const request = {
            'instrument_id': market['id'],
        };
        if (market['futures'] || market['swap']) {
            method += 'InstrumentId';
        }
        else {
            method += 's';
        }
        const clientOrderId = this.safeString2(params, 'client_oid', 'clientOrderId');
        if (clientOrderId !== undefined) {
            method += 'ClientOid';
            request['client_oid'] = clientOrderId;
        }
        else {
            method += 'OrderId';
            request['order_id'] = id;
        }
        const query = this.omit(params, ['type', 'client_oid', 'clientOrderId']);
        const response = await this[method](this.extend(request, query));
        const result = ('result' in response) ? response : this.safeValue(response, market['id'], {});
        //
        // spot
        //
        //     {
        //         "btc-usdt": [
        //             {
        //                 "result":true,
        //                 "client_oid":"a123",
        //                 "order_id": "2510832677225473"
        //             }
        //         ]
        //     }
        //
        // futures, swap
        //
        //     {
        //         "result": true,
        //         "client_oid": "oktfuture10", // missing if requested by order_id
        //         "order_id": "2517535534836736",
        //         "instrument_id": "EOS-USD-190628"
        //     }
        //
        return this.parseOrder(result, market);
    }
    parseOrderStatus(status) {
        const statuses = {
            '-2': 'failed',
            '-1': 'canceled',
            '0': 'open',
            '1': 'open',
            '2': 'closed',
            '3': 'open',
            '4': 'canceled',
        };
        return this.safeString(statuses, status, status);
    }
    parseOrderSide(side) {
        const sides = {
            '1': 'buy',
            '2': 'sell',
            '3': 'sell',
            '4': 'buy', // close short
        };
        return this.safeString(sides, side, side);
    }
    parseOrder(order, market = undefined) {
        //
        // createOrder
        //
        //     {
        //         "client_oid":"oktspot79",
        //         "error_code":"",
        //         "error_message":"",
        //         "order_id":"2510789768709120",
        //         "result":true
        //     }
        //
        // cancelOrder
        //
        //     {
        //         "result": true,
        //         "client_oid": "oktfuture10", // missing if requested by order_id
        //         "order_id": "2517535534836736",
        //         // instrument_id is missing for spot/margin orders
        //         // available in futures and swap orders only
        //         "instrument_id": "EOS-USD-190628",
        //     }
        //
        // fetchOrder, fetchOrdersByState, fetchOpenOrders, fetchClosedOrders
        //
        //     // spot orders
        //
        //     {
        //         "client_oid":"oktspot76",
        //         "created_at":"2019-03-18T07:26:49.000Z",
        //         "filled_notional":"3.9734",
        //         "filled_size":"0.001", // filled_qty in futures and swap orders
        //         "funds":"", // this is most likely the same as notional
        //         "instrument_id":"BTC-USDT",
        //         "notional":"",
        //         "order_id":"2500723297813504",
        //         "order_type":"0",
        //         "price":"4013",
        //         "product_id":"BTC-USDT", // missing in futures and swap orders
        //         "side":"buy",
        //         "size":"0.001",
        //         "status":"filled",
        //         "state": "2",
        //         "timestamp":"2019-03-18T07:26:49.000Z",
        //         "type":"limit"
        //     }
        //
        //     // futures and swap orders
        //
        //     {
        //         "instrument_id":"EOS-USD-190628",
        //         "size":"10",
        //         "timestamp":"2019-03-20T10:04:55.000Z",
        //         "filled_qty":"10", // filled_size in spot orders
        //         "fee":"-0.00841043",
        //         "order_id":"2512669605501952",
        //         "price":"3.668",
        //         "price_avg":"3.567", // missing in spot orders
        //         "status":"2",
        //         "state": "2",
        //         "type":"4",
        //         "contract_val":"10",
        //         "leverage":"10", // missing in swap, spot orders
        //         "client_oid":"",
        //         "pnl":"1.09510794", // missing in swap, spot orders
        //         "order_type":"0"
        //     }
        //
        const id = this.safeString(order, 'order_id');
        const timestamp = this.parse8601(this.safeString(order, 'timestamp'));
        let side = this.safeString(order, 'side');
        const type = this.safeString(order, 'type');
        if ((side !== 'buy') && (side !== 'sell')) {
            side = this.parseOrderSide(type);
        }
        const marketId = this.safeString(order, 'instrument_id');
        market = this.safeMarket(marketId, market);
        let amount = this.safeString(order, 'size');
        const filled = this.safeString2(order, 'filled_size', 'filled_qty');
        let remaining = undefined;
        if (amount !== undefined) {
            if (filled !== undefined) {
                amount = Precise["default"].stringMax(amount, filled);
                remaining = Precise["default"].stringMax('0', Precise["default"].stringSub(amount, filled));
            }
        }
        if (type === 'market') {
            remaining = '0';
        }
        let cost = this.safeString2(order, 'filled_notional', 'funds');
        const price = this.safeString(order, 'price');
        let average = this.safeString(order, 'price_avg');
        if (cost === undefined) {
            if (filled !== undefined && average !== undefined) {
                cost = Precise["default"].stringMul(average, filled);
            }
        }
        else {
            if ((average === undefined) && (filled !== undefined) && Precise["default"].stringGt(filled, '0')) {
                average = Precise["default"].stringDiv(cost, filled);
            }
        }
        const status = this.parseOrderStatus(this.safeString(order, 'state'));
        const feeCost = this.safeNumber(order, 'fee');
        let fee = undefined;
        if (feeCost !== undefined) {
            const feeCurrency = undefined;
            fee = {
                'cost': feeCost,
                'currency': feeCurrency,
            };
        }
        let clientOrderId = this.safeString(order, 'client_oid');
        if ((clientOrderId !== undefined) && (clientOrderId.length < 1)) {
            clientOrderId = undefined; // fix empty clientOrderId string
        }
        const stopPrice = this.safeNumber(order, 'trigger_price');
        return this.safeOrder({
            'info': order,
            'id': id,
            'clientOrderId': clientOrderId,
            'timestamp': timestamp,
            'datetime': this.iso8601(timestamp),
            'lastTradeTimestamp': undefined,
            'symbol': market['symbol'],
            'type': type,
            'timeInForce': undefined,
            'postOnly': undefined,
            'side': side,
            'price': price,
            'stopPrice': stopPrice,
            'triggerPrice': stopPrice,
            'average': average,
            'cost': cost,
            'amount': amount,
            'filled': filled,
            'remaining': remaining,
            'status': status,
            'fee': fee,
            'trades': undefined,
        }, market);
    }
    async fetchOrder(id, symbol = undefined, params = {}) {
        /**
         * @method
         * @name okcoin#fetchOrder
         * @description fetches information on an order made by the user
         * @param {string} symbol unified symbol of the market the order was made in
         * @param {object} params extra parameters specific to the okcoin api endpoint
         * @returns {object} An [order structure]{@link https://docs.ccxt.com/#/?id=order-structure}
         */
        if (symbol === undefined) {
            throw new errors.ArgumentsRequired(this.id + ' fetchOrder() requires a symbol argument');
        }
        await this.loadMarkets();
        const market = this.market(symbol);
        const defaultType = this.safeString2(this.options, 'fetchOrder', 'defaultType', market['type']);
        const type = this.safeString(params, 'type', defaultType);
        if (type === undefined) {
            throw new errors.ArgumentsRequired(this.id + " fetchOrder() requires a type parameter (one of 'spot', 'futures', 'swap').");
        }
        const instrumentId = (market['futures'] || market['swap']) ? 'InstrumentId' : '';
        let method = type + 'GetOrders' + instrumentId;
        const request = {
            'instrument_id': market['id'],
            // 'client_oid': 'abcdef12345', // optional, [a-z0-9]{1,32}
            // 'order_id': id,
        };
        const clientOid = this.safeString(params, 'client_oid');
        if (clientOid !== undefined) {
            method += 'ClientOid';
            request['client_oid'] = clientOid;
        }
        else {
            method += 'OrderId';
            request['order_id'] = id;
        }
        const query = this.omit(params, 'type');
        const response = await this[method](this.extend(request, query));
        //
        // spot
        //
        //     {
        //         "client_oid":"oktspot70",
        //         "created_at":"2019-03-15T02:52:56.000Z",
        //         "filled_notional":"3.8886",
        //         "filled_size":"0.001",
        //         "funds":"",
        //         "instrument_id":"BTC-USDT",
        //         "notional":"",
        //         "order_id":"2482659399697408",
        //         "order_type":"0",
        //         "price":"3927.3",
        //         "product_id":"BTC-USDT",
        //         "side":"buy",
        //         "size":"0.001",
        //         "status":"filled",
        //         "state": "2",
        //         "timestamp":"2019-03-15T02:52:56.000Z",
        //         "type":"limit"
        //     }
        //
        // futures, swap
        //
        //     {
        //         "instrument_id":"EOS-USD-190628",
        //         "size":"10",
        //         "timestamp":"2019-03-20T02:46:38.000Z",
        //         "filled_qty":"10",
        //         "fee":"-0.0080819",
        //         "order_id":"2510946213248000",
        //         "price":"3.712",
        //         "price_avg":"3.712",
        //         "status":"2",
        //         "state": "2",
        //         "type":"2",
        //         "contract_val":"10",
        //         "leverage":"10",
        //         "client_oid":"", // missing in swap orders
        //         "pnl":"0", // missing in swap orders
        //         "order_type":"0"
        //     }
        //
        return this.parseOrder(response);
    }
    async fetchOrdersByState(state, symbol = undefined, since = undefined, limit = undefined, params = {}) {
        if (symbol === undefined) {
            throw new errors.ArgumentsRequired(this.id + ' fetchOrdersByState() requires a symbol argument');
        }
        await this.loadMarkets();
        const market = this.market(symbol);
        let type = undefined;
        if (market['futures'] || market['swap']) {
            type = market['type'];
        }
        else {
            const defaultType = this.safeString2(this.options, 'fetchOrder', 'defaultType', market['type']);
            type = this.safeString(params, 'type', defaultType);
        }
        if (type === undefined) {
            throw new errors.ArgumentsRequired(this.id + " fetchOrdersByState() requires a type parameter (one of 'spot', 'futures', 'swap').");
        }
        const request = {
            'instrument_id': market['id'],
            // '-2': failed,
            // '-1': cancelled,
            //  '0': open ,
            //  '1': partially filled,
            //  '2': fully filled,
            //  '3': submitting,
            //  '4': cancelling,
            //  '6': incomplete（open+partially filled),
            //  '7': complete（cancelled+fully filled),
            'state': state,
        };
        let method = type + 'GetOrders';
        if (market['futures'] || market['swap']) {
            method += 'InstrumentId';
        }
        const query = this.omit(params, 'type');
        const response = await this[method](this.extend(request, query));
        //
        // spot
        //
        //     [
        //         // in fact, this documented API response does not correspond
        //         // to their actual API response for spot markets
        //         // OKEX v3 API returns a plain array of orders (see below)
        //         [
        //             {
        //                 "client_oid":"oktspot76",
        //                 "created_at":"2019-03-18T07:26:49.000Z",
        //                 "filled_notional":"3.9734",
        //                 "filled_size":"0.001",
        //                 "funds":"",
        //                 "instrument_id":"BTC-USDT",
        //                 "notional":"",
        //                 "order_id":"2500723297813504",
        //                 "order_type":"0",
        //                 "price":"4013",
        //                 "product_id":"BTC-USDT",
        //                 "side":"buy",
        //                 "size":"0.001",
        //                 "status":"filled",
        //                 "state": "2",
        //                 "timestamp":"2019-03-18T07:26:49.000Z",
        //                 "type":"limit"
        //             },
        //         ],
        //         {
        //             "before":"2500723297813504",
        //             "after":"2500650881647616"
        //         }
        //     ]
        //
        // futures, swap
        //
        //     {
        //         "result":true,  // missing in swap orders
        //         "order_info": [
        //             {
        //                 "instrument_id":"EOS-USD-190628",
        //                 "size":"10",
        //                 "timestamp":"2019-03-20T10:04:55.000Z",
        //                 "filled_qty":"10",
        //                 "fee":"-0.00841043",
        //                 "order_id":"2512669605501952",
        //                 "price":"3.668",
        //                 "price_avg":"3.567",
        //                 "status":"2",
        //                 "state": "2",
        //                 "type":"4",
        //                 "contract_val":"10",
        //                 "leverage":"10", // missing in swap orders
        //                 "client_oid":"",
        //                 "pnl":"1.09510794", // missing in swap orders
        //                 "order_type":"0"
        //             },
        //         ]
        //     }
        //
        let orders = undefined;
        if (market['swap'] || market['futures']) {
            orders = this.safeValue(response, 'order_info', []);
        }
        else {
            orders = response;
            const responseLength = response.length;
            if (responseLength < 1) {
                return [];
            }
            // in fact, this documented API response does not correspond
            // to their actual API response for spot markets
            // OKEX v3 API returns a plain array of orders
            if (responseLength > 1) {
                const before = this.safeValue(response[1], 'before');
                if (before !== undefined) {
                    orders = response[0];
                }
            }
        }
        return this.parseOrders(orders, market, since, limit);
    }
    async fetchOpenOrders(symbol = undefined, since = undefined, limit = undefined, params = {}) {
        /**
         * @method
         * @name okcoin#fetchOpenOrders
         * @description fetch all unfilled currently open orders
         * @param {string} symbol unified market symbol
         * @param {int|undefined} since the earliest time in ms to fetch open orders for
         * @param {int|undefined} limit the maximum number of  open orders structures to retrieve
         * @param {object} params extra parameters specific to the okcoin api endpoint
         * @returns {[object]} a list of [order structures]{@link https://docs.ccxt.com/#/?id=order-structure}
         */
        // '-2': failed,
        // '-1': cancelled,
        //  '0': open ,
        //  '1': partially filled,
        //  '2': fully filled,
        //  '3': submitting,
        //  '4': cancelling,
        //  '6': incomplete（open+partially filled),
        //  '7': complete（cancelled+fully filled),
        return await this.fetchOrdersByState('6', symbol, since, limit, params);
    }
    async fetchClosedOrders(symbol = undefined, since = undefined, limit = undefined, params = {}) {
        /**
         * @method
         * @name okcoin#fetchClosedOrders
         * @description fetches information on multiple closed orders made by the user
         * @param {string} symbol unified market symbol of the market orders were made in
         * @param {int|undefined} since the earliest time in ms to fetch orders for
         * @param {int|undefined} limit the maximum number of  orde structures to retrieve
         * @param {object} params extra parameters specific to the okcoin api endpoint
         * @returns {[object]} a list of [order structures]{@link https://docs.ccxt.com/#/?id=order-structure}
         */
        // '-2': failed,
        // '-1': cancelled,
        //  '0': open ,
        //  '1': partially filled,
        //  '2': fully filled,
        //  '3': submitting,
        //  '4': cancelling,
        //  '6': incomplete（open+partially filled),
        //  '7': complete（cancelled+fully filled),
        return await this.fetchOrdersByState('7', symbol, since, limit, params);
    }
    parseDepositAddress(depositAddress, currency = undefined) {
        //
        //     {
        //         address: '0x696abb81974a8793352cbd33aadcf78eda3cfdfa',
        //         currency: 'eth'
        //         tag: 'abcde12345', // will be missing if the token does not require a deposit tag
        //         payment_id: 'abcde12345', // will not be returned if the token does not require a payment_id
        //         // can_deposit: 1, // 0 or 1, documented but missing
        //         // can_withdraw: 1, // 0 or 1, documented but missing
        //     }
        //
        const address = this.safeString(depositAddress, 'address');
        let tag = this.safeString2(depositAddress, 'tag', 'payment_id');
        tag = this.safeString2(depositAddress, 'memo', 'Memo', tag);
        const currencyId = this.safeString(depositAddress, 'currency');
        const code = this.safeCurrencyCode(currencyId);
        this.checkAddress(address);
        return {
            'currency': code,
            'address': address,
            'tag': tag,
            'info': depositAddress,
        };
    }
    async fetchDepositAddress(code, params = {}) {
        /**
         * @method
         * @name okcoin#fetchDepositAddress
         * @description fetch the deposit address for a currency associated with this account
         * @param {string} code unified currency code
         * @param {object} params extra parameters specific to the okcoin api endpoint
         * @returns {object} an [address structure]{@link https://docs.ccxt.com/#/?id=address-structure}
         */
        await this.loadMarkets();
        const parts = code.split('-');
        const currency = this.currency(parts[0]);
        const request = {
            'currency': currency['id'],
        };
        const response = await this.accountGetDepositAddress(this.extend(request, params));
        //
        //     [
        //         {
        //             address: '0x696abb81974a8793352cbd33aadcf78eda3cfdfa',
        //             currency: 'eth'
        //         }
        //     ]
        //
        const addressesByCode = this.parseDepositAddresses(response, [currency['code']]);
        const address = this.safeValue(addressesByCode, code);
        if (address === undefined) {
            throw new errors.InvalidAddress(this.id + ' fetchDepositAddress() cannot return nonexistent addresses, you should create withdrawal addresses with the exchange website first');
        }
        return address;
    }
    async transfer(code, amount, fromAccount, toAccount, params = {}) {
        /**
         * @method
         * @name okcoin#transfer
         * @description transfer currency internally between wallets on the same account
         * @param {string} code unified currency code
         * @param {float} amount amount to transfer
         * @param {string} fromAccount account to transfer from
         * @param {string} toAccount account to transfer to
         * @param {object} params extra parameters specific to the okcoin api endpoint
         * @returns {object} a [transfer structure]{@link https://docs.ccxt.com/#/?id=transfer-structure}
         */
        await this.loadMarkets();
        const currency = this.currency(code);
        const accountsByType = this.safeValue(this.options, 'accountsByType', {});
        const fromId = this.safeString(accountsByType, fromAccount, fromAccount);
        const toId = this.safeString(accountsByType, toAccount, toAccount);
        const request = {
            'amount': this.currencyToPrecision(code, amount),
            'currency': currency['id'],
            'from': fromId,
            'to': toId,
            'type': '0', // 0 Transfer between accounts in the main account/sub_account, 1 main account to sub_account, 2 sub_account to main account
        };
        if (fromId === 'main') {
            request['type'] = '1';
            request['sub_account'] = toId;
            request['to'] = '0';
        }
        else if (toId === 'main') {
            request['type'] = '2';
            request['sub_account'] = fromId;
            request['from'] = '0';
            request['to'] = '6';
        }
        const response = await this.accountPostTransfer(this.extend(request, params));
        //
        //      {
        //          "transfer_id": "754147",
        //          "currency": "ETC",
        //          "from": "6",
        //          "amount": "0.1",
        //          "to": "1",
        //          "result": true
        //      }
        //
        return this.parseTransfer(response, currency);
    }
    parseTransfer(transfer, currency = undefined) {
        //
        //      {
        //          "transfer_id": "754147",
        //          "currency": "ETC",
        //          "from": "6",
        //          "amount": "0.1",
        //          "to": "1",
        //          "result": true
        //      }
        //
        const accountsById = this.safeValue(this.options, 'accountsById', {});
        return {
            'info': transfer,
            'id': this.safeString(transfer, 'transfer_id'),
            'timestamp': undefined,
            'datetime': undefined,
            'currency': this.safeCurrencyCode(this.safeString(transfer, 'currency'), currency),
            'amount': this.safeNumber(transfer, 'amount'),
            'fromAccount': this.safeString(accountsById, this.safeString(transfer, 'from')),
            'toAccount': this.safeString(accountsById, this.safeString(transfer, 'to')),
            'status': this.parseTransferStatus(this.safeString(transfer, 'result')),
        };
    }
    parseTransferStatus(status) {
        const statuses = {
            'true': 'ok',
        };
        return this.safeString(statuses, status, 'failed');
    }
    async withdraw(code, amount, address, tag = undefined, params = {}) {
        /**
         * @method
         * @name okcoin#withdraw
         * @description make a withdrawal
         * @param {string} code unified currency code
         * @param {float} amount the amount to withdraw
         * @param {string} address the address to withdraw to
         * @param {string|undefined} tag
         * @param {object} params extra parameters specific to the okcoin api endpoint
         * @returns {object} a [transaction structure]{@link https://docs.ccxt.com/#/?id=transaction-structure}
         */
        [tag, params] = this.handleWithdrawTagAndParams(tag, params);
        this.checkAddress(address);
        await this.loadMarkets();
        const currency = this.currency(code);
        if (tag) {
            address = address + ':' + tag;
        }
        const fee = this.safeString(params, 'fee');
        if (fee === undefined) {
            throw new errors.ArgumentsRequired(this.id + " withdraw() requires a 'fee' string parameter, network transaction fee must be ≥ 0. Withdrawals to OKCoin or OKEx are fee-free, please set '0'. Withdrawing to external digital asset address requires network transaction fee.");
        }
        const request = {
            'currency': currency['id'],
            'to_address': address,
            'destination': '4',
            'amount': this.numberToString(amount),
            'fee': fee, // String. Network transaction fee ≥ 0. Withdrawals to OKCoin or OKEx are fee-free, please set as 0. Withdrawal to external digital asset address requires network transaction fee.
        };
        if ('password' in params) {
            request['trade_pwd'] = params['password'];
        }
        else if ('trade_pwd' in params) {
            request['trade_pwd'] = params['trade_pwd'];
        }
        else if (this.password) {
            request['trade_pwd'] = this.password;
        }
        const query = this.omit(params, ['fee', 'password', 'trade_pwd']);
        if (!('trade_pwd' in request)) {
            throw new errors.ExchangeError(this.id + ' withdraw() requires this.password set on the exchange instance or a password / trade_pwd parameter');
        }
        const response = await this.accountPostWithdrawal(this.extend(request, query));
        //
        //     {
        //         "amount":"0.1",
        //         "withdrawal_id":"67485",
        //         "currency":"btc",
        //         "result":true
        //     }
        //
        return this.parseTransaction(response, currency);
    }
    async fetchDeposits(code = undefined, since = undefined, limit = undefined, params = {}) {
        /**
         * @method
         * @name okcoin#fetchDeposits
         * @description fetch all deposits made to an account
         * @param {string|undefined} code unified currency code
         * @param {int|undefined} since the earliest time in ms to fetch deposits for
         * @param {int|undefined} limit the maximum number of deposits structures to retrieve
         * @param {object} params extra parameters specific to the okcoin api endpoint
         * @returns {[object]} a list of [transaction structures]{@link https://docs.ccxt.com/#/?id=transaction-structure}
         */
        await this.loadMarkets();
        const request = {};
        let method = 'accountGetDepositHistory';
        let currency = undefined;
        if (code !== undefined) {
            currency = this.currency(code);
            request['currency'] = currency['id'];
            method += 'Currency';
        }
        const response = await this[method](this.extend(request, params));
        return this.parseTransactions(response, currency, since, limit, params);
    }
    async fetchWithdrawals(code = undefined, since = undefined, limit = undefined, params = {}) {
        /**
         * @method
         * @name okcoin#fetchWithdrawals
         * @description fetch all withdrawals made from an account
         * @param {string|undefined} code unified currency code
         * @param {int|undefined} since the earliest time in ms to fetch withdrawals for
         * @param {int|undefined} limit the maximum number of withdrawals structures to retrieve
         * @param {object} params extra parameters specific to the okcoin api endpoint
         * @returns {[object]} a list of [transaction structures]{@link https://docs.ccxt.com/#/?id=transaction-structure}
         */
        await this.loadMarkets();
        const request = {};
        let method = 'accountGetWithdrawalHistory';
        let currency = undefined;
        if (code !== undefined) {
            currency = this.currency(code);
            request['currency'] = currency['id'];
            method += 'Currency';
        }
        const response = await this[method](this.extend(request, params));
        return this.parseTransactions(response, currency, since, limit, params);
    }
    parseTransactionStatus(status) {
        //
        // deposit statuses
        //
        //     {
        //         '0': 'waiting for confirmation',
        //         '1': 'confirmation account',
        //         '2': 'recharge success'
        //     }
        //
        // withdrawal statues
        //
        //     {
        //        '-3': 'pending cancel',
        //        '-2': 'cancelled',
        //        '-1': 'failed',
        //         '0': 'pending',
        //         '1': 'sending',
        //         '2': 'sent',
        //         '3': 'email confirmation',
        //         '4': 'manual confirmation',
        //         '5': 'awaiting identity confirmation'
        //     }
        //
        const statuses = {
            '-3': 'pending',
            '-2': 'canceled',
            '-1': 'failed',
            '0': 'pending',
            '1': 'pending',
            '2': 'ok',
            '3': 'pending',
            '4': 'pending',
            '5': 'pending',
        };
        return this.safeString(statuses, status, status);
    }
    parseTransaction(transaction, currency = undefined) {
        //
        // withdraw
        //
        //     {
        //         "amount":"0.1",
        //         "withdrawal_id":"67485",
        //         "currency":"btc",
        //         "result":true
        //     }
        //
        // fetchWithdrawals
        //
        //     {
        //         amount: "4.72100000",
        //         withdrawal_id: "1729116",
        //         fee: "0.01000000eth",
        //         txid: "0xf653125bbf090bcfe4b5e8e7b8f586a9d87aa7de94598702758c0802b…",
        //         currency: "ETH",
        //         from: "7147338839",
        //         to: "0x26a3CB49578F07000575405a57888681249c35Fd",
        //         timestamp: "2018-08-17T07:03:42.000Z",
        //         status: "2"
        //     }
        //
        // fetchDeposits
        //
        //     {
        //         "amount": "4.19511659",
        //         "txid": "14c9a8c925647cdb7e5b2937ea9aefe2b29b2c273150ad3f44b3b8a4635ed437",
        //         "currency": "XMR",
        //         "from": "",
        //         "to": "48PjH3ksv1fiXniKvKvyH5UtFs5WhfS2Vf7U3TwzdRJtCc7HJWvCQe56dRahyhQyTAViXZ8Nzk4gQg6o4BJBMUoxNy8y8g7",
        //         "tag": "1234567",
        //         "deposit_id": 11571659, <-- we can use this
        //         "timestamp": "2019-10-01T14:54:19.000Z",
        //         "status": "2"
        //     }
        //
        let type = undefined;
        let id = undefined;
        let address = undefined;
        const withdrawalId = this.safeString(transaction, 'withdrawal_id');
        const addressFrom = this.safeString(transaction, 'from');
        const addressTo = this.safeString(transaction, 'to');
        const tagTo = this.safeString(transaction, 'tag');
        if (withdrawalId !== undefined) {
            type = 'withdrawal';
            id = withdrawalId;
            address = addressTo;
        }
        else {
            // the payment_id will appear on new deposits but appears to be removed from the response after 2 months
            id = this.safeString2(transaction, 'payment_id', 'deposit_id');
            type = 'deposit';
            address = addressTo;
        }
        const currencyId = this.safeString(transaction, 'currency');
        const code = this.safeCurrencyCode(currencyId);
        const amount = this.safeNumber(transaction, 'amount');
        const status = this.parseTransactionStatus(this.safeString(transaction, 'status'));
        const txid = this.safeString(transaction, 'txid');
        const timestamp = this.parse8601(this.safeString(transaction, 'timestamp'));
        let feeCost = undefined;
        if (type === 'deposit') {
            feeCost = 0;
        }
        else {
            if (currencyId !== undefined) {
                const feeWithCurrencyId = this.safeString(transaction, 'fee');
                if (feeWithCurrencyId !== undefined) {
                    // https://github.com/ccxt/ccxt/pull/5748
                    const lowercaseCurrencyId = currencyId.toLowerCase();
                    const feeWithoutCurrencyId = feeWithCurrencyId.replace(lowercaseCurrencyId, '');
                    feeCost = parseFloat(feeWithoutCurrencyId);
                }
            }
        }
        // todo parse tags
        return {
            'info': transaction,
            'id': id,
            'currency': code,
            'amount': amount,
            'network': undefined,
            'addressFrom': addressFrom,
            'addressTo': addressTo,
            'address': address,
            'tagFrom': undefined,
            'tagTo': tagTo,
            'tag': tagTo,
            'status': status,
            'type': type,
            'updated': undefined,
            'txid': txid,
            'timestamp': timestamp,
            'datetime': this.iso8601(timestamp),
            'fee': {
                'currency': code,
                'cost': feeCost,
            },
        };
    }
    parseMyTrade(pair, market = undefined) {
        // check that trading symbols match in both entries
        const userTrade = this.safeValue(pair, 1);
        const otherTrade = this.safeValue(pair, 0);
        const firstMarketId = this.safeString(otherTrade, 'instrument_id');
        const secondMarketId = this.safeString(userTrade, 'instrument_id');
        if (firstMarketId !== secondMarketId) {
            throw new errors.NotSupported(this.id + ' parseMyTrade() received unrecognized response format, differing instrument_ids in one fill, the exchange API might have changed, paste your verbose output: https://github.com/ccxt/ccxt/wiki/FAQ#what-is-required-to-get-help');
        }
        const marketId = firstMarketId;
        market = this.safeMarket(marketId, market);
        const symbol = market['symbol'];
        const quoteId = market['quoteId'];
        let side = undefined;
        let amountString = undefined;
        let costString = undefined;
        const receivedCurrencyId = this.safeString(userTrade, 'currency');
        let feeCurrencyId = undefined;
        if (receivedCurrencyId === quoteId) {
            side = this.safeString(otherTrade, 'side');
            amountString = this.safeString(otherTrade, 'size');
            costString = this.safeString(userTrade, 'size');
            feeCurrencyId = this.safeString(otherTrade, 'currency');
        }
        else {
            side = this.safeString(userTrade, 'side');
            amountString = this.safeString(userTrade, 'size');
            costString = this.safeString(otherTrade, 'size');
            feeCurrencyId = this.safeString(userTrade, 'currency');
        }
        const id = this.safeString(userTrade, 'trade_id');
        const priceString = this.safeString(userTrade, 'price');
        const feeCostFirstString = this.safeString(otherTrade, 'fee');
        const feeCostSecondString = this.safeString(userTrade, 'fee');
        const feeCurrencyCodeFirst = this.safeCurrencyCode(this.safeString(otherTrade, 'currency'));
        const feeCurrencyCodeSecond = this.safeCurrencyCode(this.safeString(userTrade, 'currency'));
        let fee = undefined;
        let fees = undefined;
        // fee is either a positive number (invitation rebate)
        // or a negative number (transaction fee deduction)
        // therefore we need to invert the fee
        // more about it https://github.com/ccxt/ccxt/issues/5909
        if ((feeCostFirstString !== undefined) && !Precise["default"].stringEquals(feeCostFirstString, '0')) {
            if ((feeCostSecondString !== undefined) && !Precise["default"].stringEquals(feeCostSecondString, '0')) {
                fees = [
                    {
                        'cost': Precise["default"].stringNeg(feeCostFirstString),
                        'currency': feeCurrencyCodeFirst,
                    },
                    {
                        'cost': Precise["default"].stringNeg(feeCostSecondString),
                        'currency': feeCurrencyCodeSecond,
                    },
                ];
            }
            else {
                fee = {
                    'cost': Precise["default"].stringNeg(feeCostFirstString),
                    'currency': feeCurrencyCodeFirst,
                };
            }
        }
        else if ((feeCostSecondString !== undefined) && !Precise["default"].stringEquals(feeCostSecondString, '0')) {
            fee = {
                'cost': Precise["default"].stringNeg(feeCostSecondString),
                'currency': feeCurrencyCodeSecond,
            };
        }
        else {
            fee = {
                'cost': '0',
                'currency': this.safeCurrencyCode(feeCurrencyId),
            };
        }
        //
        // simplified structures to show the underlying semantics
        //
        //     // market/limit sell
        //
        //     {
        //         "currency":"USDT",
        //         "fee":"-0.04647925", // ←--- fee in received quote currency
        //         "price":"129.13", // ←------ price
        //         "size":"30.98616393", // ←-- cost
        //     },
        //     {
        //         "currency":"ETH",
        //         "fee":"0",
        //         "price":"129.13",
        //         "size":"0.23996099", // ←--- amount
        //     },
        //
        //     // market/limit buy
        //
        //     {
        //         "currency":"ETH",
        //         "fee":"-0.00036049", // ←--- fee in received base currency
        //         "price":"129.16", // ←------ price
        //         "size":"0.240322", // ←----- amount
        //     },
        //     {
        //         "currency":"USDT",
        //         "fee":"0",
        //         "price":"129.16",
        //         "size":"31.03998952", // ←-- cost
        //     }
        //
        const timestamp = this.parse8601(this.safeString2(userTrade, 'timestamp', 'created_at'));
        let takerOrMaker = this.safeString2(userTrade, 'exec_type', 'liquidity');
        if (takerOrMaker === 'M') {
            takerOrMaker = 'maker';
        }
        else if (takerOrMaker === 'T') {
            takerOrMaker = 'taker';
        }
        const orderId = this.safeString(userTrade, 'order_id');
        return this.safeTrade({
            'info': pair,
            'timestamp': timestamp,
            'datetime': this.iso8601(timestamp),
            'symbol': symbol,
            'id': id,
            'order': orderId,
            'type': undefined,
            'takerOrMaker': takerOrMaker,
            'side': side,
            'price': priceString,
            'amount': amountString,
            'cost': costString,
            'fee': fee,
            'fees': fees,
        }, market);
    }
    parseMyTrades(trades, market = undefined, since = undefined, limit = undefined, params = {}) {
        const grouped = this.groupBy(trades, 'trade_id');
        const tradeIds = Object.keys(grouped);
        const result = [];
        for (let i = 0; i < tradeIds.length; i++) {
            const tradeId = tradeIds[i];
            const pair = grouped[tradeId];
            // make sure it has exactly 2 trades, no more, no less
            const numTradesInPair = pair.length;
            if (numTradesInPair === 2) {
                const trade = this.parseMyTrade(pair);
                result.push(trade);
            }
        }
        market = this.safeMarket(undefined, market);
        return this.filterBySymbolSinceLimit(result, market['symbol'], since, limit);
    }
    async fetchMyTrades(symbol = undefined, since = undefined, limit = undefined, params = {}) {
        /**
         * @method
         * @name okcoin#fetchMyTrades
         * @description fetch all trades made by the user
         * @param {string} symbol unified market symbol
         * @param {int|undefined} since the earliest time in ms to fetch trades for
         * @param {int|undefined} limit the maximum number of trades structures to retrieve
         * @param {object} params extra parameters specific to the okcoin api endpoint
         * @returns {[object]} a list of [trade structures]{@link https://docs.ccxt.com/#/?id=trade-structure}
         */
        // okex actually returns ledger entries instead of fills here, so each fill in the order
        // is represented by two trades with opposite buy/sell sides, not one :\
        // this aspect renders the 'fills' endpoint unusable for fetchOrderTrades
        // until either OKEX fixes the API or we workaround this on our side somehow
        if (symbol === undefined) {
            throw new errors.ArgumentsRequired(this.id + ' fetchMyTrades() requires a symbol argument');
        }
        await this.loadMarkets();
        const market = this.market(symbol);
        if ((limit !== undefined) && (limit > 100)) {
            limit = 100;
        }
        const request = {
            'instrument_id': market['id'],
            // 'order_id': id, // string
            // 'after': '1', // pagination of data to return records earlier than the requested ledger_id
            // 'before': '1', // P=pagination of data to return records newer than the requested ledger_id
            // 'limit': limit, // optional, number of results per request, default = maximum = 100
        };
        const defaultType = this.safeString2(this.options, 'fetchMyTrades', 'defaultType');
        const type = this.safeString(params, 'type', defaultType);
        const query = this.omit(params, 'type');
        const method = type + 'GetFills';
        const response = await this[method](this.extend(request, query));
        //
        //     [
        //         // sell
        //         {
        //             "created_at":"2020-03-29T11:55:25.000Z",
        //             "currency":"USDT",
        //             "exec_type":"T",
        //             "fee":"-0.04647925",
        //             "instrument_id":"ETH-USDT",
        //             "ledger_id":"10562924353",
        //             "liquidity":"T",
        //             "order_id":"4636470489136128",
        //             "price":"129.13",
        //             "product_id":"ETH-USDT",
        //             "side":"buy",
        //             "size":"30.98616393",
        //             "timestamp":"2020-03-29T11:55:25.000Z",
        //             "trade_id":"18551601"
        //         },
        //         {
        //             "created_at":"2020-03-29T11:55:25.000Z",
        //             "currency":"ETH",
        //             "exec_type":"T",
        //             "fee":"0",
        //             "instrument_id":"ETH-USDT",
        //             "ledger_id":"10562924352",
        //             "liquidity":"T",
        //             "order_id":"4636470489136128",
        //             "price":"129.13",
        //             "product_id":"ETH-USDT",
        //             "side":"sell",
        //             "size":"0.23996099",
        //             "timestamp":"2020-03-29T11:55:25.000Z",
        //             "trade_id":"18551601"
        //         },
        //         // buy
        //         {
        //             "created_at":"2020-03-29T11:55:16.000Z",
        //             "currency":"ETH",
        //             "exec_type":"T",
        //             "fee":"-0.00036049",
        //             "instrument_id":"ETH-USDT",
        //             "ledger_id":"10562922669",
        //             "liquidity":"T",
        //             "order_id": "4636469894136832",
        //             "price":"129.16",
        //             "product_id":"ETH-USDT",
        //             "side":"buy",
        //             "size":"0.240322",
        //             "timestamp":"2020-03-29T11:55:16.000Z",
        //             "trade_id":"18551600"
        //         },
        //         {
        //             "created_at":"2020-03-29T11:55:16.000Z",
        //             "currency":"USDT",
        //             "exec_type":"T",
        //             "fee":"0",
        //             "instrument_id":"ETH-USDT",
        //             "ledger_id":"10562922668",
        //             "liquidity":"T",
        //             "order_id":"4636469894136832",
        //             "price":"129.16",
        //             "product_id":"ETH-USDT",
        //             "side":"sell",
        //             "size":"31.03998952",
        //             "timestamp":"2020-03-29T11:55:16.000Z",
        //             "trade_id":"18551600"
        //         }
        //     ]
        //
        return this.parseMyTrades(response, market, since, limit, params);
    }
    async fetchOrderTrades(id, symbol = undefined, since = undefined, limit = undefined, params = {}) {
        /**
         * @method
         * @name okcoin#fetchOrderTrades
         * @description fetch all the trades made from a single order
         * @param {string} id order id
         * @param {string|undefined} symbol unified market symbol
         * @param {int|undefined} since the earliest time in ms to fetch trades for
         * @param {int|undefined} limit the maximum number of trades to retrieve
         * @param {object} params extra parameters specific to the okcoin api endpoint
         * @returns {[object]} a list of [trade structures]{@link https://docs.ccxt.com/#/?id=trade-structure}
         */
        const request = {
            // 'instrument_id': market['id'],
            'order_id': id,
            // 'after': '1', // return the page after the specified page number
            // 'before': '1', // return the page before the specified page number
            // 'limit': limit, // optional, number of results per request, default = maximum = 100
        };
        return await this.fetchMyTrades(symbol, since, limit, this.extend(request, params));
    }
    async fetchPosition(symbol, params = {}) {
        /**
         * @method
         * @name okcoin#fetchPosition
         * @description fetch data on a single open contract trade position
         * @param {string} symbol unified market symbol of the market the position is held in, default is undefined
         * @param {object} params extra parameters specific to the okcoin api endpoint
         * @returns {object} a [position structure]{@link https://docs.ccxt.com/#/?id=position-structure}
         */
        await this.loadMarkets();
        const market = this.market(symbol);
        let method = undefined;
        const request = {
            'instrument_id': market['id'],
            // 'order_id': id, // string
            // 'after': '1', // pagination of data to return records earlier than the requested ledger_id
            // 'before': '1', // P=pagination of data to return records newer than the requested ledger_id
            // 'limit': limit, // optional, number of results per request, default = maximum = 100
        };
        const type = market['type'];
        if ((type === 'futures') || (type === 'swap')) {
            method = type + 'GetInstrumentIdPosition';
        }
        else if (type === 'option') {
            const underlying = this.safeString(params, 'underlying');
            if (underlying === undefined) {
                throw new errors.ArgumentsRequired(this.id + ' fetchPosition() requires an underlying parameter for ' + type + ' market ' + symbol);
            }
            method = type + 'GetUnderlyingPosition';
        }
        else {
            throw new errors.NotSupported(this.id + ' fetchPosition() does not support ' + type + ' market ' + symbol + ', supported market types are futures, swap or option');
        }
        const response = await this[method](this.extend(request, params));
        //
        // futures
        //
        //     crossed margin mode
        //
        //     {
        //         "result": true,
        //         "holding": [
        //             {
        //                 "long_qty": "2",
        //                 "long_avail_qty": "2",
        //                 "long_avg_cost": "8260",
        //                 "long_settlement_price": "8260",
        //                 "realised_pnl": "0.00020928",
        //                 "short_qty": "2",
        //                 "short_avail_qty": "2",
        //                 "short_avg_cost": "8259.99",
        //                 "short_settlement_price": "8259.99",
        //                 "liquidation_price": "113.81",
        //                 "instrument_id": "BTC-USD-191227",
        //                 "leverage": "10",
        //                 "created_at": "2019-09-25T07:58:42.129Z",
        //                 "updated_at": "2019-10-08T14:02:51.029Z",
        //                 "margin_mode": "crossed",
        //                 "short_margin": "0.00242197",
        //                 "short_pnl": "6.63E-6",
        //                 "short_pnl_ratio": "0.002477997",
        //                 "short_unrealised_pnl": "6.63E-6",
        //                 "long_margin": "0.00242197",
        //                 "long_pnl": "-6.65E-6",
        //                 "long_pnl_ratio": "-0.002478",
        //                 "long_unrealised_pnl": "-6.65E-6",
        //                 "long_settled_pnl": "0",
        //                 "short_settled_pnl": "0",
        //                 "last": "8257.57"
        //             }
        //         ],
        //         "margin_mode": "crossed"
        //     }
        //
        //     fixed margin mode
        //
        //     {
        //         "result": true,
        //         "holding": [
        //             {
        //                 "long_qty": "4",
        //                 "long_avail_qty": "4",
        //                 "long_margin": "0.00323844",
        //                 "long_liqui_price": "7762.09",
        //                 "long_pnl_ratio": "0.06052306",
        //                 "long_avg_cost": "8234.43",
        //                 "long_settlement_price": "8234.43",
        //                 "realised_pnl": "-0.00000296",
        //                 "short_qty": "2",
        //                 "short_avail_qty": "2",
        //                 "short_margin": "0.00241105",
        //                 "short_liqui_price": "9166.74",
        //                 "short_pnl_ratio": "0.03318052",
        //                 "short_avg_cost": "8295.13",
        //                 "short_settlement_price": "8295.13",
        //                 "instrument_id": "BTC-USD-191227",
        //                 "long_leverage": "15",
        //                 "short_leverage": "10",
        //                 "created_at": "2019-09-25T07:58:42.129Z",
        //                 "updated_at": "2019-10-08T13:12:09.438Z",
        //                 "margin_mode": "fixed",
        //                 "short_margin_ratio": "0.10292507",
        //                 "short_maint_margin_ratio": "0.005",
        //                 "short_pnl": "7.853E-5",
        //                 "short_unrealised_pnl": "7.853E-5",
        //                 "long_margin_ratio": "0.07103743",
        //                 "long_maint_margin_ratio": "0.005",
        //                 "long_pnl": "1.9841E-4",
        //                 "long_unrealised_pnl": "1.9841E-4",
        //                 "long_settled_pnl": "0",
        //                 "short_settled_pnl": "0",
        //                 "last": "8266.99"
        //             }
        //         ],
        //         "margin_mode": "fixed"
        //     }
        //
        // swap
        //
        //     crossed margin mode
        //
        //     {
        //         "margin_mode": "crossed",
        //         "timestamp": "2019-09-27T03:49:02.018Z",
        //         "holding": [
        //             {
        //                 "avail_position": "3",
        //                 "avg_cost": "59.49",
        //                 "instrument_id": "LTC-USD-SWAP",
        //                 "last": "55.98",
        //                 "leverage": "10.00",
        //                 "liquidation_price": "4.37",
        //                 "maint_margin_ratio": "0.0100",
        //                 "margin": "0.0536",
        //                 "position": "3",
        //                 "realized_pnl": "0.0000",
        //                 "unrealized_pnl": "0",
        //                 "settled_pnl": "-0.0330",
        //                 "settlement_price": "55.84",
        //                 "side": "long",
        //                 "timestamp": "2019-09-27T03:49:02.018Z"
        //             },
        //         ]
        //     }
        //
        //     fixed margin mode
        //
        //     {
        //         "margin_mode": "fixed",
        //         "timestamp": "2019-09-27T03:47:37.230Z",
        //         "holding": [
        //             {
        //                 "avail_position": "20",
        //                 "avg_cost": "8025.0",
        //                 "instrument_id": "BTC-USD-SWAP",
        //                 "last": "8113.1",
        //                 "leverage": "15.00",
        //                 "liquidation_price": "7002.6",
        //                 "maint_margin_ratio": "0.0050",
        //                 "margin": "0.0454",
        //                 "position": "20",
        //                 "realized_pnl": "-0.0001",
        //                 "unrealized_pnl": "0",
        //                 "settled_pnl": "0.0076",
        //                 "settlement_price": "8279.2",
        //                 "side": "long",
        //                 "timestamp": "2019-09-27T03:47:37.230Z"
        //             }
        //         ]
        //     }
        //
        // option
        //
        //     {
        //         "holding":[
        //             {
        //                 "instrument_id":"BTC-USD-190927-12500-C",
        //                 "position":"20",
        //                 "avg_cost":"3.26",
        //                 "avail_position":"20",
        //                 "settlement_price":"0.017",
        //                 "total_pnl":"50",
        //                 "pnl_ratio":"0.3",
        //                 "realized_pnl":"40",
        //                 "unrealized_pnl":"10",
        //                 "pos_margin":"100",
        //                 "option_value":"70",
        //                 "created_at":"2019-08-30T03:09:20.315Z",
        //                 "updated_at":"2019-08-30T03:40:18.318Z"
        //             },
        //             {
        //                 "instrument_id":"BTC-USD-190927-12500-P",
        //                 "position":"20",
        //                 "avg_cost":"3.26",
        //                 "avail_position":"20",
        //                 "settlement_price":"0.019",
        //                 "total_pnl":"50",
        //                 "pnl_ratio":"0.3",
        //                 "realized_pnl":"40",
        //                 "unrealized_pnl":"10",
        //                 "pos_margin":"100",
        //                 "option_value":"70",
        //                 "created_at":"2019-08-30T03:09:20.315Z",
        //                 "updated_at":"2019-08-30T03:40:18.318Z"
        //             }
        //         ]
        //     }
        //
        // todo unify parsePosition/parsePositions
        return response;
    }
    async fetchPositions(symbols = undefined, params = {}) {
        /**
         * @method
         * @name okcoin#fetchPositions
         * @description fetch all open positions
         * @param {[string]|undefined} symbols not used by okcoin fetchPositions
         * @param {object} params extra parameters specific to the okcoin api endpoint
         * @returns {[object]} a list of [position structure]{@link https://docs.ccxt.com/#/?id=position-structure}
         */
        await this.loadMarkets();
        let method = undefined;
        const defaultType = this.safeString2(this.options, 'fetchPositions', 'defaultType');
        const type = this.safeString(params, 'type', defaultType);
        if ((type === 'futures') || (type === 'swap')) {
            method = type + 'GetPosition';
        }
        else if (type === 'option') {
            const underlying = this.safeString(params, 'underlying');
            if (underlying === undefined) {
                throw new errors.ArgumentsRequired(this.id + ' fetchPositions() requires an underlying parameter for ' + type + ' markets');
            }
            method = type + 'GetUnderlyingPosition';
        }
        else {
            throw new errors.NotSupported(this.id + ' fetchPositions() does not support ' + type + ' markets, supported market types are futures, swap or option');
        }
        params = this.omit(params, 'type');
        const response = await this[method](params);
        //
        // futures
        //
        //     ...
        //
        //
        // swap
        //
        //     ...
        //
        // option
        //
        //     {
        //         "holding":[
        //             {
        //                 "instrument_id":"BTC-USD-190927-12500-C",
        //                 "position":"20",
        //                 "avg_cost":"3.26",
        //                 "avail_position":"20",
        //                 "settlement_price":"0.017",
        //                 "total_pnl":"50",
        //                 "pnl_ratio":"0.3",
        //                 "realized_pnl":"40",
        //                 "unrealized_pnl":"10",
        //                 "pos_margin":"100",
        //                 "option_value":"70",
        //                 "created_at":"2019-08-30T03:09:20.315Z",
        //                 "updated_at":"2019-08-30T03:40:18.318Z"
        //             },
        //             {
        //                 "instrument_id":"BTC-USD-190927-12500-P",
        //                 "position":"20",
        //                 "avg_cost":"3.26",
        //                 "avail_position":"20",
        //                 "settlement_price":"0.019",
        //                 "total_pnl":"50",
        //                 "pnl_ratio":"0.3",
        //                 "realized_pnl":"40",
        //                 "unrealized_pnl":"10",
        //                 "pos_margin":"100",
        //                 "option_value":"70",
        //                 "created_at":"2019-08-30T03:09:20.315Z",
        //                 "updated_at":"2019-08-30T03:40:18.318Z"
        //             }
        //         ]
        //     }
        //
        // todo unify parsePosition/parsePositions
        return response;
    }
    async fetchLedger(code = undefined, since = undefined, limit = undefined, params = {}) {
        /**
         * @method
         * @name okcoin#fetchLedger
         * @description fetch the history of changes, actions done by the user or operations that altered balance of the user
         * @param {string|undefined} code unified currency code, default is undefined
         * @param {int|undefined} since timestamp in ms of the earliest ledger entry, default is undefined
         * @param {int|undefined} limit max number of ledger entrys to return, default is undefined
         * @param {object} params extra parameters specific to the okcoin api endpoint
         * @returns {object} a [ledger structure]{@link https://docs.ccxt.com/#/?id=ledger-structure}
         */
        await this.loadMarkets();
        const defaultType = this.safeString2(this.options, 'fetchLedger', 'defaultType');
        const type = this.safeString(params, 'type', defaultType);
        const query = this.omit(params, 'type');
        const suffix = (type === 'account') ? '' : 'Accounts';
        let argument = '';
        const request = {
        // 'from': 'id',
        // 'to': 'id',
        };
        if (limit !== undefined) {
            request['limit'] = limit;
        }
        let currency = undefined;
        if (type === 'spot') {
            if (code === undefined) {
                throw new errors.ArgumentsRequired(this.id + " fetchLedger() requires a currency code argument for '" + type + "' markets");
            }
            argument = 'Currency';
            currency = this.currency(code);
            request['currency'] = currency['id'];
        }
        else if (type === 'futures') {
            if (code === undefined) {
                throw new errors.ArgumentsRequired(this.id + " fetchLedger() requires an underlying symbol for '" + type + "' markets");
            }
            argument = 'Underlying';
            const market = this.market(code); // we intentionally put a market inside here for the swap ledgers
            const marketInfo = this.safeValue(market, 'info', {});
            const settlementCurrencyId = this.safeString(marketInfo, 'settlement_currency');
            const settlementCurrencyCode = this.safeCurrencyCode(settlementCurrencyId);
            currency = this.currency(settlementCurrencyCode);
            const underlyingId = this.safeString(marketInfo, 'underlying');
            request['underlying'] = underlyingId;
        }
        else if (type === 'swap') {
            if (code === undefined) {
                throw new errors.ArgumentsRequired(this.id + " fetchLedger() requires a code argument (a market symbol) for '" + type + "' markets");
            }
            argument = 'InstrumentId';
            const market = this.market(code); // we intentionally put a market inside here for the swap ledgers
            currency = this.currency(market['base']);
            request['instrument_id'] = market['id'];
            //
            //     if (type === 'margin') {
            //         //
            //         //      3. Borrow
            //         //      4. Repayment
            //         //      5. Interest
            //         //      7. Buy
            //         //      8. Sell
            //         //      9. From capital account
            //         //     10. From C2C
            //         //     11. From Futures
            //         //     12. From Spot
            //         //     13. From ETT
            //         //     14. To capital account
            //         //     15. To C2C
            //         //     16. To Spot
            //         //     17. To Futures
            //         //     18. To ETT
            //         //     19. Mandatory Repayment
            //         //     20. From Piggybank
            //         //     21. To Piggybank
            //         //     22. From Perpetual
            //         //     23. To Perpetual
            //         //     24. Liquidation Fee
            //         //     54. Clawback
            //         //     59. Airdrop Return.
            //         //
            //         request['type'] = 'number'; // All types will be returned if this filed is left blank
            //     }
            //
        }
        else if (type === 'account') {
            if (code !== undefined) {
                currency = this.currency(code);
                request['currency'] = currency['id'];
            }
            //
            //     //
            //     //      1. deposit
            //     //      2. withdrawal
            //     //     13. cancel withdrawal
            //     //     18. into futures account
            //     //     19. out of futures account
            //     //     20. into sub account
            //     //     21. out of sub account
            //     //     28. claim
            //     //     29. into ETT account
            //     //     30. out of ETT account
            //     //     31. into C2C account
            //     //     32. out of C2C account
            //     //     33. into margin account
            //     //     34. out of margin account
            //     //     37. into spot account
            //     //     38. out of spot account
            //     //
            //     request['type'] = 'number';
            //
        }
        else {
            throw new errors.NotSupported(this.id + " fetchLedger does not support the '" + type + "' type (the type must be one of 'account', 'spot', 'margin', 'futures', 'swap')");
        }
        const method = type + 'Get' + suffix + argument + 'Ledger';
        const response = await this[method](this.extend(request, query));
        //
        // transfer     funds transfer in/out
        // trade        funds moved as a result of a trade, spot accounts only
        // rebate       fee rebate as per fee schedule, spot accounts only
        // match        open long/open short/close long/close short (futures) or a change in the amount because of trades (swap)
        // fee          fee, futures only
        // settlement   settlement/clawback/settle long/settle short
        // liquidation  force close long/force close short/deliver close long/deliver close short
        // funding      funding fee, swap only
        // margin       a change in the amount after adjusting margin, swap only
        //
        // account
        //
        //     [
        //         {
        //             "amount":0.00051843,
        //             "balance":0.00100941,
        //             "currency":"BTC",
        //             "fee":0,
        //             "ledger_id":8987285,
        //             "timestamp":"2018-10-12T11:01:14.000Z",
        //             "typename":"Get from activity"
        //         }
        //     ]
        //
        // spot
        //
        //     [
        //         {
        //             "timestamp":"2019-03-18T07:08:25.000Z",
        //             "ledger_id":"3995334780",
        //             "created_at":"2019-03-18T07:08:25.000Z",
        //             "currency":"BTC",
        //             "amount":"0.0009985",
        //             "balance":"0.0029955",
        //             "type":"trade",
        //             "details":{
        //                 "instrument_id":"BTC-USDT",
        //                 "order_id":"2500650881647616",
        //                 "product_id":"BTC-USDT"
        //             }
        //         }
        //     ]
        //
        // futures
        //
        //     [
        //         {
        //             "ledger_id":"2508090544914461",
        //             "timestamp":"2019-03-19T14:40:24.000Z",
        //             "amount":"-0.00529521",
        //             "balance":"0",
        //             "currency":"EOS",
        //             "type":"fee",
        //             "details":{
        //                 "order_id":"2506982456445952",
        //                 "instrument_id":"EOS-USD-190628"
        //             }
        //         }
        //     ]
        //
        // swap
        //
        //     [
        //         {
        //             "amount":"0.004742",
        //             "fee":"-0.000551",
        //             "type":"match",
        //             "instrument_id":"EOS-USD-SWAP",
        //             "ledger_id":"197429674941902848",
        //             "timestamp":"2019-03-25T05:56:31.286Z"
        //         },
        //     ]
        //
        const responseLength = response.length;
        if (responseLength < 1) {
            return [];
        }
        if (type === 'swap') {
            const ledgerEntries = this.parseLedger(response);
            return this.filterBySymbolSinceLimit(ledgerEntries, code, since, limit);
        }
        return this.parseLedger(response, currency, since, limit);
    }
    parseLedgerEntryType(type) {
        const types = {
            'transfer': 'transfer',
            'trade': 'trade',
            'rebate': 'rebate',
            'match': 'trade',
            'fee': 'fee',
            'settlement': 'trade',
            'liquidation': 'trade',
            'funding': 'fee',
            'margin': 'margin', // a change in the amount after adjusting margin, swap only
        };
        return this.safeString(types, type, type);
    }
    parseLedgerEntry(item, currency = undefined) {
        //
        //
        // account
        //
        //     {
        //         "amount":0.00051843,
        //         "balance":0.00100941,
        //         "currency":"BTC",
        //         "fee":0,
        //         "ledger_id":8987285,
        //         "timestamp":"2018-10-12T11:01:14.000Z",
        //         "typename":"Get from activity"
        //     }
        //
        // spot
        //
        //     {
        //         "timestamp":"2019-03-18T07:08:25.000Z",
        //         "ledger_id":"3995334780",
        //         "created_at":"2019-03-18T07:08:25.000Z",
        //         "currency":"BTC",
        //         "amount":"0.0009985",
        //         "balance":"0.0029955",
        //         "type":"trade",
        //         "details":{
        //             "instrument_id":"BTC-USDT",
        //             "order_id":"2500650881647616",
        //             "product_id":"BTC-USDT"
        //         }
        //     }
        //
        // futures
        //
        //     {
        //         "ledger_id":"2508090544914461",
        //         "timestamp":"2019-03-19T14:40:24.000Z",
        //         "amount":"-0.00529521",
        //         "balance":"0",
        //         "currency":"EOS",
        //         "type":"fee",
        //         "details":{
        //             "order_id":"2506982456445952",
        //             "instrument_id":"EOS-USD-190628"
        //         }
        //     }
        //
        // swap
        //
        //     {
        //         "amount":"0.004742",
        //         "fee":"-0.000551",
        //         "type":"match",
        //         "instrument_id":"EOS-USD-SWAP",
        //         "ledger_id":"197429674941902848",
        //         "timestamp":"2019-03-25T05:56:31.286Z"
        //     },
        //
        const id = this.safeString(item, 'ledger_id');
        const account = undefined;
        const details = this.safeValue(item, 'details', {});
        const referenceId = this.safeString(details, 'order_id');
        const referenceAccount = undefined;
        const type = this.parseLedgerEntryType(this.safeString(item, 'type'));
        const code = this.safeCurrencyCode(this.safeString(item, 'currency'), currency);
        const amount = this.safeNumber(item, 'amount');
        const timestamp = this.parse8601(this.safeString(item, 'timestamp'));
        const fee = {
            'cost': this.safeNumber(item, 'fee'),
            'currency': code,
        };
        const before = undefined;
        const after = this.safeNumber(item, 'balance');
        const status = 'ok';
        const marketId = this.safeString(item, 'instrument_id');
        const symbol = this.safeSymbol(marketId);
        return {
            'info': item,
            'id': id,
            'account': account,
            'referenceId': referenceId,
            'referenceAccount': referenceAccount,
            'type': type,
            'currency': code,
            'symbol': symbol,
            'amount': amount,
            'before': before,
            'after': after,
            'status': status,
            'timestamp': timestamp,
            'datetime': this.iso8601(timestamp),
            'fee': fee,
        };
    }
    sign(path, api = 'public', method = 'GET', params = {}, headers = undefined, body = undefined) {
        const isArray = Array.isArray(params);
        let request = '/api/' + api + '/' + this.version + '/';
        request += isArray ? path : this.implodeParams(path, params);
        const query = isArray ? params : this.omit(params, this.extractParams(path));
        let url = this.implodeHostname(this.urls['api']['rest']) + request;
        const type = this.getPathAuthenticationType(path);
        if ((type === 'public') || (type === 'information')) {
            if (Object.keys(query).length) {
                url += '?' + this.urlencode(query);
            }
        }
        else if (type === 'private') {
            this.checkRequiredCredentials();
            const timestamp = this.iso8601(this.milliseconds());
            headers = {
                'OK-ACCESS-KEY': this.apiKey,
                'OK-ACCESS-PASSPHRASE': this.password,
                'OK-ACCESS-TIMESTAMP': timestamp,
                // 'OK-FROM': '',
                // 'OK-TO': '',
                // 'OK-LIMIT': '',
            };
            let auth = timestamp + method + request;
            if (method === 'GET') {
                if (Object.keys(query).length) {
                    const urlencodedQuery = '?' + this.urlencode(query);
                    url += urlencodedQuery;
                    auth += urlencodedQuery;
                }
            }
            else {
                if (isArray || Object.keys(query).length) {
                    body = this.json(query);
                    auth += body;
                }
                headers['Content-Type'] = 'application/json';
            }
            const signature = this.hmac(this.encode(auth), this.encode(this.secret), sha256.sha256, 'base64');
            headers['OK-ACCESS-SIGN'] = signature;
        }
        return { 'url': url, 'method': method, 'body': body, 'headers': headers };
    }
    getPathAuthenticationType(path) {
        // https://github.com/ccxt/ccxt/issues/6651
        // a special case to handle the optionGetUnderlying interefering with
        // other endpoints containing this keyword
        if (path === 'underlying') {
            return 'public';
        }
        const auth = this.safeValue(this.options, 'auth', {});
        const key = this.findBroadlyMatchedKey(auth, path);
        return this.safeString(auth, key, 'private');
    }
    handleErrors(code, reason, url, method, headers, body, response, requestHeaders, requestBody) {
        if (!response) {
            return; // fallback to default error handler
        }
        const feedback = this.id + ' ' + body;
        if (code === 503) {
            // {"message":"name resolution failed"}
            throw new errors.ExchangeNotAvailable(feedback);
        }
        //
        //     {"error_message":"Order does not exist","result":"true","error_code":"35029","order_id":"-1"}
        //
        const message = this.safeString(response, 'message');
        const errorCode = this.safeString2(response, 'code', 'error_code');
        const nonEmptyMessage = ((message !== undefined) && (message !== ''));
        const nonZeroErrorCode = (errorCode !== undefined) && (errorCode !== '0');
        if (nonEmptyMessage) {
            this.throwExactlyMatchedException(this.exceptions['exact'], message, feedback);
            this.throwBroadlyMatchedException(this.exceptions['broad'], message, feedback);
        }
        if (nonZeroErrorCode) {
            this.throwExactlyMatchedException(this.exceptions['exact'], errorCode, feedback);
        }
        if (nonZeroErrorCode || nonEmptyMessage) {
            throw new errors.ExchangeError(feedback); // unknown message
        }
    }
}

module.exports = okcoin;
