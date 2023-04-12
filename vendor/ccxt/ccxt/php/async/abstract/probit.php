<?php

namespace ccxt\async\abstract;

// PLEASE DO NOT EDIT THIS FILE, IT IS GENERATED AND WILL BE OVERWRITTEN:
// https://github.com/ccxt/ccxt/blob/master/CONTRIBUTING.md#how-to-contribute-code


use ccxt\async\Exchange;

abstract class probit extends Exchange {
    public function public_get_market($params = array()) {
        return $this->request('market', 'public', 'GET', $params);
    }
    public function public_get_currency($params = array()) {
        return $this->request('currency', 'public', 'GET', $params);
    }
    public function public_get_currency_with_platform($params = array()) {
        return $this->request('currency_with_platform', 'public', 'GET', $params);
    }
    public function public_get_time($params = array()) {
        return $this->request('time', 'public', 'GET', $params);
    }
    public function public_get_ticker($params = array()) {
        return $this->request('ticker', 'public', 'GET', $params);
    }
    public function public_get_order_book($params = array()) {
        return $this->request('order_book', 'public', 'GET', $params);
    }
    public function public_get_trade($params = array()) {
        return $this->request('trade', 'public', 'GET', $params);
    }
    public function public_get_candle($params = array()) {
        return $this->request('candle', 'public', 'GET', $params);
    }
    public function private_post_new_order($params = array()) {
        return $this->request('new_order', 'private', 'POST', $params);
    }
    public function private_post_cancel_order($params = array()) {
        return $this->request('cancel_order', 'private', 'POST', $params);
    }
    public function private_post_withdrawal($params = array()) {
        return $this->request('withdrawal', 'private', 'POST', $params);
    }
    public function private_get_balance($params = array()) {
        return $this->request('balance', 'private', 'GET', $params);
    }
    public function private_get_order($params = array()) {
        return $this->request('order', 'private', 'GET', $params);
    }
    public function private_get_open_order($params = array()) {
        return $this->request('open_order', 'private', 'GET', $params);
    }
    public function private_get_order_history($params = array()) {
        return $this->request('order_history', 'private', 'GET', $params);
    }
    public function private_get_trade_history($params = array()) {
        return $this->request('trade_history', 'private', 'GET', $params);
    }
    public function private_get_deposit_address($params = array()) {
        return $this->request('deposit_address', 'private', 'GET', $params);
    }
    public function accounts_post_token($params = array()) {
        return $this->request('token', 'accounts', 'POST', $params);
    }
    public function publicGetMarket($params = array()) {
        return $this->request('market', 'public', 'GET', $params);
    }
    public function publicGetCurrency($params = array()) {
        return $this->request('currency', 'public', 'GET', $params);
    }
    public function publicGetCurrencyWithPlatform($params = array()) {
        return $this->request('currency_with_platform', 'public', 'GET', $params);
    }
    public function publicGetTime($params = array()) {
        return $this->request('time', 'public', 'GET', $params);
    }
    public function publicGetTicker($params = array()) {
        return $this->request('ticker', 'public', 'GET', $params);
    }
    public function publicGetOrderBook($params = array()) {
        return $this->request('order_book', 'public', 'GET', $params);
    }
    public function publicGetTrade($params = array()) {
        return $this->request('trade', 'public', 'GET', $params);
    }
    public function publicGetCandle($params = array()) {
        return $this->request('candle', 'public', 'GET', $params);
    }
    public function privatePostNewOrder($params = array()) {
        return $this->request('new_order', 'private', 'POST', $params);
    }
    public function privatePostCancelOrder($params = array()) {
        return $this->request('cancel_order', 'private', 'POST', $params);
    }
    public function privatePostWithdrawal($params = array()) {
        return $this->request('withdrawal', 'private', 'POST', $params);
    }
    public function privateGetBalance($params = array()) {
        return $this->request('balance', 'private', 'GET', $params);
    }
    public function privateGetOrder($params = array()) {
        return $this->request('order', 'private', 'GET', $params);
    }
    public function privateGetOpenOrder($params = array()) {
        return $this->request('open_order', 'private', 'GET', $params);
    }
    public function privateGetOrderHistory($params = array()) {
        return $this->request('order_history', 'private', 'GET', $params);
    }
    public function privateGetTradeHistory($params = array()) {
        return $this->request('trade_history', 'private', 'GET', $params);
    }
    public function privateGetDepositAddress($params = array()) {
        return $this->request('deposit_address', 'private', 'GET', $params);
    }
    public function accountsPostToken($params = array()) {
        return $this->request('token', 'accounts', 'POST', $params);
    }
}