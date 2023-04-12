<?php

namespace ccxt\async\abstract;

// PLEASE DO NOT EDIT THIS FILE, IT IS GENERATED AND WILL BE OVERWRITTEN:
// https://github.com/ccxt/ccxt/blob/master/CONTRIBUTING.md#how-to-contribute-code


use ccxt\async\Exchange;

abstract class bitopro extends Exchange {
    public function public_get_order_book_pair($params = array()) {
        return $this->request('order-book/{pair}', 'public', 'GET', $params);
    }
    public function public_get_tickers($params = array()) {
        return $this->request('tickers', 'public', 'GET', $params);
    }
    public function public_get_tickers_pair($params = array()) {
        return $this->request('tickers/{pair}', 'public', 'GET', $params);
    }
    public function public_get_trades_pair($params = array()) {
        return $this->request('trades/{pair}', 'public', 'GET', $params);
    }
    public function public_get_provisioning_currencies($params = array()) {
        return $this->request('provisioning/currencies', 'public', 'GET', $params);
    }
    public function public_get_provisioning_trading_pairs($params = array()) {
        return $this->request('provisioning/trading-pairs', 'public', 'GET', $params);
    }
    public function public_get_provisioning_limitations_and_fees($params = array()) {
        return $this->request('provisioning/limitations-and-fees', 'public', 'GET', $params);
    }
    public function public_get_trading_history_pair($params = array()) {
        return $this->request('trading-history/{pair}', 'public', 'GET', $params);
    }
    public function private_get_accounts_balance($params = array()) {
        return $this->request('accounts/balance', 'private', 'GET', $params);
    }
    public function private_get_orders_history($params = array()) {
        return $this->request('orders/history', 'private', 'GET', $params);
    }
    public function private_get_orders_all_pair($params = array()) {
        return $this->request('orders/all/{pair}', 'private', 'GET', $params);
    }
    public function private_get_orders_trades_pair($params = array()) {
        return $this->request('orders/trades/{pair}', 'private', 'GET', $params);
    }
    public function private_get_orders_pair_orderid($params = array()) {
        return $this->request('orders/{pair}/{orderId}', 'private', 'GET', $params);
    }
    public function private_get_wallet_withdraw_currency_serial($params = array()) {
        return $this->request('wallet/withdraw/{currency}/{serial}', 'private', 'GET', $params);
    }
    public function private_get_wallet_withdraw_currency_id_id($params = array()) {
        return $this->request('wallet/withdraw/{currency}/id/{id}', 'private', 'GET', $params);
    }
    public function private_get_wallet_deposithistory_currency($params = array()) {
        return $this->request('wallet/depositHistory/{currency}', 'private', 'GET', $params);
    }
    public function private_get_wallet_withdrawhistory_currency($params = array()) {
        return $this->request('wallet/withdrawHistory/{currency}', 'private', 'GET', $params);
    }
    public function private_post_orders_pair($params = array()) {
        return $this->request('orders/{pair}', 'private', 'POST', $params);
    }
    public function private_post_orders_batch($params = array()) {
        return $this->request('orders/batch', 'private', 'POST', $params);
    }
    public function private_post_wallet_withdraw_currency($params = array()) {
        return $this->request('wallet/withdraw/{currency}', 'private', 'POST', $params);
    }
    public function private_put_orders($params = array()) {
        return $this->request('orders', 'private', 'PUT', $params);
    }
    public function private_delete_orders_pair_id($params = array()) {
        return $this->request('orders/{pair}/{id}', 'private', 'DELETE', $params);
    }
    public function private_delete_orders_all($params = array()) {
        return $this->request('orders/all', 'private', 'DELETE', $params);
    }
    public function private_delete_orders_pair($params = array()) {
        return $this->request('orders/{pair}', 'private', 'DELETE', $params);
    }
    public function publicGetOrderBookPair($params = array()) {
        return $this->request('order-book/{pair}', 'public', 'GET', $params);
    }
    public function publicGetTickers($params = array()) {
        return $this->request('tickers', 'public', 'GET', $params);
    }
    public function publicGetTickersPair($params = array()) {
        return $this->request('tickers/{pair}', 'public', 'GET', $params);
    }
    public function publicGetTradesPair($params = array()) {
        return $this->request('trades/{pair}', 'public', 'GET', $params);
    }
    public function publicGetProvisioningCurrencies($params = array()) {
        return $this->request('provisioning/currencies', 'public', 'GET', $params);
    }
    public function publicGetProvisioningTradingPairs($params = array()) {
        return $this->request('provisioning/trading-pairs', 'public', 'GET', $params);
    }
    public function publicGetProvisioningLimitationsAndFees($params = array()) {
        return $this->request('provisioning/limitations-and-fees', 'public', 'GET', $params);
    }
    public function publicGetTradingHistoryPair($params = array()) {
        return $this->request('trading-history/{pair}', 'public', 'GET', $params);
    }
    public function privateGetAccountsBalance($params = array()) {
        return $this->request('accounts/balance', 'private', 'GET', $params);
    }
    public function privateGetOrdersHistory($params = array()) {
        return $this->request('orders/history', 'private', 'GET', $params);
    }
    public function privateGetOrdersAllPair($params = array()) {
        return $this->request('orders/all/{pair}', 'private', 'GET', $params);
    }
    public function privateGetOrdersTradesPair($params = array()) {
        return $this->request('orders/trades/{pair}', 'private', 'GET', $params);
    }
    public function privateGetOrdersPairOrderId($params = array()) {
        return $this->request('orders/{pair}/{orderId}', 'private', 'GET', $params);
    }
    public function privateGetWalletWithdrawCurrencySerial($params = array()) {
        return $this->request('wallet/withdraw/{currency}/{serial}', 'private', 'GET', $params);
    }
    public function privateGetWalletWithdrawCurrencyIdId($params = array()) {
        return $this->request('wallet/withdraw/{currency}/id/{id}', 'private', 'GET', $params);
    }
    public function privateGetWalletDepositHistoryCurrency($params = array()) {
        return $this->request('wallet/depositHistory/{currency}', 'private', 'GET', $params);
    }
    public function privateGetWalletWithdrawHistoryCurrency($params = array()) {
        return $this->request('wallet/withdrawHistory/{currency}', 'private', 'GET', $params);
    }
    public function privatePostOrdersPair($params = array()) {
        return $this->request('orders/{pair}', 'private', 'POST', $params);
    }
    public function privatePostOrdersBatch($params = array()) {
        return $this->request('orders/batch', 'private', 'POST', $params);
    }
    public function privatePostWalletWithdrawCurrency($params = array()) {
        return $this->request('wallet/withdraw/{currency}', 'private', 'POST', $params);
    }
    public function privatePutOrders($params = array()) {
        return $this->request('orders', 'private', 'PUT', $params);
    }
    public function privateDeleteOrdersPairId($params = array()) {
        return $this->request('orders/{pair}/{id}', 'private', 'DELETE', $params);
    }
    public function privateDeleteOrdersAll($params = array()) {
        return $this->request('orders/all', 'private', 'DELETE', $params);
    }
    public function privateDeleteOrdersPair($params = array()) {
        return $this->request('orders/{pair}', 'private', 'DELETE', $params);
    }
}