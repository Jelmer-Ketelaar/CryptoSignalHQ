<?php

namespace ccxt\abstract;

// PLEASE DO NOT EDIT THIS FILE, IT IS GENERATED AND WILL BE OVERWRITTEN:
// https://github.com/ccxt/ccxt/blob/master/CONTRIBUTING.md#how-to-contribute-code


use ccxt\Exchange;

abstract class lbank2 extends Exchange {
    public function public_get_currencypairs($params = array()) {
        return $this->request('currencyPairs', 'public', 'GET', $params);
    }
    public function public_get_accuracy($params = array()) {
        return $this->request('accuracy', 'public', 'GET', $params);
    }
    public function public_get_usdtocny($params = array()) {
        return $this->request('usdToCny', 'public', 'GET', $params);
    }
    public function public_get_withdrawconfigs($params = array()) {
        return $this->request('withdrawConfigs', 'public', 'GET', $params);
    }
    public function public_get_timestamp($params = array()) {
        return $this->request('timestamp', 'public', 'GET', $params);
    }
    public function public_get_ticker_24hr($params = array()) {
        return $this->request('ticker/24hr', 'public', 'GET', $params);
    }
    public function public_get_ticker($params = array()) {
        return $this->request('ticker', 'public', 'GET', $params);
    }
    public function public_get_depth($params = array()) {
        return $this->request('depth', 'public', 'GET', $params);
    }
    public function public_get_incrdepth($params = array()) {
        return $this->request('incrDepth', 'public', 'GET', $params);
    }
    public function public_get_trades($params = array()) {
        return $this->request('trades', 'public', 'GET', $params);
    }
    public function public_get_kline($params = array()) {
        return $this->request('kline', 'public', 'GET', $params);
    }
    public function public_get_supplement_system_ping($params = array()) {
        return $this->request('supplement/system_ping', 'public', 'GET', $params);
    }
    public function public_get_supplement_incrdepth($params = array()) {
        return $this->request('supplement/incrDepth', 'public', 'GET', $params);
    }
    public function public_get_supplement_trades($params = array()) {
        return $this->request('supplement/trades', 'public', 'GET', $params);
    }
    public function public_get_supplement_ticker_price($params = array()) {
        return $this->request('supplement/ticker/price', 'public', 'GET', $params);
    }
    public function public_get_supplement_ticker_bookticker($params = array()) {
        return $this->request('supplement/ticker/bookTicker', 'public', 'GET', $params);
    }
    public function public_post_supplement_system_status($params = array()) {
        return $this->request('supplement/system_status', 'public', 'POST', $params);
    }
    public function private_post_user_info($params = array()) {
        return $this->request('user_info', 'private', 'POST', $params);
    }
    public function private_post_subscribe_get_key($params = array()) {
        return $this->request('subscribe/get_key', 'private', 'POST', $params);
    }
    public function private_post_subscribe_refresh_key($params = array()) {
        return $this->request('subscribe/refresh_key', 'private', 'POST', $params);
    }
    public function private_post_subscribe_destroy_key($params = array()) {
        return $this->request('subscribe/destroy_key', 'private', 'POST', $params);
    }
    public function private_post_get_deposit_address($params = array()) {
        return $this->request('get_deposit_address', 'private', 'POST', $params);
    }
    public function private_post_deposit_history($params = array()) {
        return $this->request('deposit_history', 'private', 'POST', $params);
    }
    public function private_post_create_order($params = array()) {
        return $this->request('create_order', 'private', 'POST', $params);
    }
    public function private_post_batch_create_order($params = array()) {
        return $this->request('batch_create_order', 'private', 'POST', $params);
    }
    public function private_post_cancel_order($params = array()) {
        return $this->request('cancel_order', 'private', 'POST', $params);
    }
    public function private_post_cancel_clientorders($params = array()) {
        return $this->request('cancel_clientOrders', 'private', 'POST', $params);
    }
    public function private_post_orders_info($params = array()) {
        return $this->request('orders_info', 'private', 'POST', $params);
    }
    public function private_post_orders_info_history($params = array()) {
        return $this->request('orders_info_history', 'private', 'POST', $params);
    }
    public function private_post_order_transaction_detail($params = array()) {
        return $this->request('order_transaction_detail', 'private', 'POST', $params);
    }
    public function private_post_transaction_history($params = array()) {
        return $this->request('transaction_history', 'private', 'POST', $params);
    }
    public function private_post_orders_info_no_deal($params = array()) {
        return $this->request('orders_info_no_deal', 'private', 'POST', $params);
    }
    public function private_post_withdraw($params = array()) {
        return $this->request('withdraw', 'private', 'POST', $params);
    }
    public function private_post_withdrawcancel($params = array()) {
        return $this->request('withdrawCancel', 'private', 'POST', $params);
    }
    public function private_post_withdraws($params = array()) {
        return $this->request('withdraws', 'private', 'POST', $params);
    }
    public function private_post_supplement_user_info($params = array()) {
        return $this->request('supplement/user_info', 'private', 'POST', $params);
    }
    public function private_post_supplement_withdraw($params = array()) {
        return $this->request('supplement/withdraw', 'private', 'POST', $params);
    }
    public function private_post_supplement_deposit_history($params = array()) {
        return $this->request('supplement/deposit_history', 'private', 'POST', $params);
    }
    public function private_post_supplement_withdraws($params = array()) {
        return $this->request('supplement/withdraws', 'private', 'POST', $params);
    }
    public function private_post_supplement_get_deposit_address($params = array()) {
        return $this->request('supplement/get_deposit_address', 'private', 'POST', $params);
    }
    public function private_post_supplement_asset_detail($params = array()) {
        return $this->request('supplement/asset_detail', 'private', 'POST', $params);
    }
    public function private_post_supplement_customer_trade_fee($params = array()) {
        return $this->request('supplement/customer_trade_fee', 'private', 'POST', $params);
    }
    public function private_post_supplement_api_restrictions($params = array()) {
        return $this->request('supplement/api_Restrictions', 'private', 'POST', $params);
    }
    public function private_post_supplement_system_ping($params = array()) {
        return $this->request('supplement/system_ping', 'private', 'POST', $params);
    }
    public function private_post_supplement_create_order_test($params = array()) {
        return $this->request('supplement/create_order_test', 'private', 'POST', $params);
    }
    public function private_post_supplement_create_order($params = array()) {
        return $this->request('supplement/create_order', 'private', 'POST', $params);
    }
    public function private_post_supplement_cancel_order($params = array()) {
        return $this->request('supplement/cancel_order', 'private', 'POST', $params);
    }
    public function private_post_supplement_cancel_order_by_symbol($params = array()) {
        return $this->request('supplement/cancel_order_by_symbol', 'private', 'POST', $params);
    }
    public function private_post_supplement_orders_info($params = array()) {
        return $this->request('supplement/orders_info', 'private', 'POST', $params);
    }
    public function private_post_supplement_orders_info_no_deal($params = array()) {
        return $this->request('supplement/orders_info_no_deal', 'private', 'POST', $params);
    }
    public function private_post_supplement_orders_info_history($params = array()) {
        return $this->request('supplement/orders_info_history', 'private', 'POST', $params);
    }
    public function private_post_supplement_user_info_account($params = array()) {
        return $this->request('supplement/user_info_account', 'private', 'POST', $params);
    }
    public function private_post_supplement_transaction_history($params = array()) {
        return $this->request('supplement/transaction_history', 'private', 'POST', $params);
    }
    public function publicGetCurrencyPairs($params = array()) {
        return $this->request('currencyPairs', 'public', 'GET', $params);
    }
    public function publicGetAccuracy($params = array()) {
        return $this->request('accuracy', 'public', 'GET', $params);
    }
    public function publicGetUsdToCny($params = array()) {
        return $this->request('usdToCny', 'public', 'GET', $params);
    }
    public function publicGetWithdrawConfigs($params = array()) {
        return $this->request('withdrawConfigs', 'public', 'GET', $params);
    }
    public function publicGetTimestamp($params = array()) {
        return $this->request('timestamp', 'public', 'GET', $params);
    }
    public function publicGetTicker24hr($params = array()) {
        return $this->request('ticker/24hr', 'public', 'GET', $params);
    }
    public function publicGetTicker($params = array()) {
        return $this->request('ticker', 'public', 'GET', $params);
    }
    public function publicGetDepth($params = array()) {
        return $this->request('depth', 'public', 'GET', $params);
    }
    public function publicGetIncrDepth($params = array()) {
        return $this->request('incrDepth', 'public', 'GET', $params);
    }
    public function publicGetTrades($params = array()) {
        return $this->request('trades', 'public', 'GET', $params);
    }
    public function publicGetKline($params = array()) {
        return $this->request('kline', 'public', 'GET', $params);
    }
    public function publicGetSupplementSystemPing($params = array()) {
        return $this->request('supplement/system_ping', 'public', 'GET', $params);
    }
    public function publicGetSupplementIncrDepth($params = array()) {
        return $this->request('supplement/incrDepth', 'public', 'GET', $params);
    }
    public function publicGetSupplementTrades($params = array()) {
        return $this->request('supplement/trades', 'public', 'GET', $params);
    }
    public function publicGetSupplementTickerPrice($params = array()) {
        return $this->request('supplement/ticker/price', 'public', 'GET', $params);
    }
    public function publicGetSupplementTickerBookTicker($params = array()) {
        return $this->request('supplement/ticker/bookTicker', 'public', 'GET', $params);
    }
    public function publicPostSupplementSystemStatus($params = array()) {
        return $this->request('supplement/system_status', 'public', 'POST', $params);
    }
    public function privatePostUserInfo($params = array()) {
        return $this->request('user_info', 'private', 'POST', $params);
    }
    public function privatePostSubscribeGetKey($params = array()) {
        return $this->request('subscribe/get_key', 'private', 'POST', $params);
    }
    public function privatePostSubscribeRefreshKey($params = array()) {
        return $this->request('subscribe/refresh_key', 'private', 'POST', $params);
    }
    public function privatePostSubscribeDestroyKey($params = array()) {
        return $this->request('subscribe/destroy_key', 'private', 'POST', $params);
    }
    public function privatePostGetDepositAddress($params = array()) {
        return $this->request('get_deposit_address', 'private', 'POST', $params);
    }
    public function privatePostDepositHistory($params = array()) {
        return $this->request('deposit_history', 'private', 'POST', $params);
    }
    public function privatePostCreateOrder($params = array()) {
        return $this->request('create_order', 'private', 'POST', $params);
    }
    public function privatePostBatchCreateOrder($params = array()) {
        return $this->request('batch_create_order', 'private', 'POST', $params);
    }
    public function privatePostCancelOrder($params = array()) {
        return $this->request('cancel_order', 'private', 'POST', $params);
    }
    public function privatePostCancelClientOrders($params = array()) {
        return $this->request('cancel_clientOrders', 'private', 'POST', $params);
    }
    public function privatePostOrdersInfo($params = array()) {
        return $this->request('orders_info', 'private', 'POST', $params);
    }
    public function privatePostOrdersInfoHistory($params = array()) {
        return $this->request('orders_info_history', 'private', 'POST', $params);
    }
    public function privatePostOrderTransactionDetail($params = array()) {
        return $this->request('order_transaction_detail', 'private', 'POST', $params);
    }
    public function privatePostTransactionHistory($params = array()) {
        return $this->request('transaction_history', 'private', 'POST', $params);
    }
    public function privatePostOrdersInfoNoDeal($params = array()) {
        return $this->request('orders_info_no_deal', 'private', 'POST', $params);
    }
    public function privatePostWithdraw($params = array()) {
        return $this->request('withdraw', 'private', 'POST', $params);
    }
    public function privatePostWithdrawCancel($params = array()) {
        return $this->request('withdrawCancel', 'private', 'POST', $params);
    }
    public function privatePostWithdraws($params = array()) {
        return $this->request('withdraws', 'private', 'POST', $params);
    }
    public function privatePostSupplementUserInfo($params = array()) {
        return $this->request('supplement/user_info', 'private', 'POST', $params);
    }
    public function privatePostSupplementWithdraw($params = array()) {
        return $this->request('supplement/withdraw', 'private', 'POST', $params);
    }
    public function privatePostSupplementDepositHistory($params = array()) {
        return $this->request('supplement/deposit_history', 'private', 'POST', $params);
    }
    public function privatePostSupplementWithdraws($params = array()) {
        return $this->request('supplement/withdraws', 'private', 'POST', $params);
    }
    public function privatePostSupplementGetDepositAddress($params = array()) {
        return $this->request('supplement/get_deposit_address', 'private', 'POST', $params);
    }
    public function privatePostSupplementAssetDetail($params = array()) {
        return $this->request('supplement/asset_detail', 'private', 'POST', $params);
    }
    public function privatePostSupplementCustomerTradeFee($params = array()) {
        return $this->request('supplement/customer_trade_fee', 'private', 'POST', $params);
    }
    public function privatePostSupplementApiRestrictions($params = array()) {
        return $this->request('supplement/api_Restrictions', 'private', 'POST', $params);
    }
    public function privatePostSupplementSystemPing($params = array()) {
        return $this->request('supplement/system_ping', 'private', 'POST', $params);
    }
    public function privatePostSupplementCreateOrderTest($params = array()) {
        return $this->request('supplement/create_order_test', 'private', 'POST', $params);
    }
    public function privatePostSupplementCreateOrder($params = array()) {
        return $this->request('supplement/create_order', 'private', 'POST', $params);
    }
    public function privatePostSupplementCancelOrder($params = array()) {
        return $this->request('supplement/cancel_order', 'private', 'POST', $params);
    }
    public function privatePostSupplementCancelOrderBySymbol($params = array()) {
        return $this->request('supplement/cancel_order_by_symbol', 'private', 'POST', $params);
    }
    public function privatePostSupplementOrdersInfo($params = array()) {
        return $this->request('supplement/orders_info', 'private', 'POST', $params);
    }
    public function privatePostSupplementOrdersInfoNoDeal($params = array()) {
        return $this->request('supplement/orders_info_no_deal', 'private', 'POST', $params);
    }
    public function privatePostSupplementOrdersInfoHistory($params = array()) {
        return $this->request('supplement/orders_info_history', 'private', 'POST', $params);
    }
    public function privatePostSupplementUserInfoAccount($params = array()) {
        return $this->request('supplement/user_info_account', 'private', 'POST', $params);
    }
    public function privatePostSupplementTransactionHistory($params = array()) {
        return $this->request('supplement/transaction_history', 'private', 'POST', $params);
    }
}