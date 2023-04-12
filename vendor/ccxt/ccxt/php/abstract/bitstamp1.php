<?php

namespace ccxt\abstract;

// PLEASE DO NOT EDIT THIS FILE, IT IS GENERATED AND WILL BE OVERWRITTEN:
// https://github.com/ccxt/ccxt/blob/master/CONTRIBUTING.md#how-to-contribute-code


use ccxt\Exchange;

abstract class bitstamp1 extends Exchange {
    public function public_get_ticker($params = array()) {
        return $this->request('ticker', 'public', 'GET', $params);
    }
    public function public_get_ticker_hour($params = array()) {
        return $this->request('ticker_hour', 'public', 'GET', $params);
    }
    public function public_get_order_book($params = array()) {
        return $this->request('order_book', 'public', 'GET', $params);
    }
    public function public_get_transactions($params = array()) {
        return $this->request('transactions', 'public', 'GET', $params);
    }
    public function public_get_eur_usd($params = array()) {
        return $this->request('eur_usd', 'public', 'GET', $params);
    }
    public function private_post_balance($params = array()) {
        return $this->request('balance', 'private', 'POST', $params);
    }
    public function private_post_user_transactions($params = array()) {
        return $this->request('user_transactions', 'private', 'POST', $params);
    }
    public function private_post_open_orders($params = array()) {
        return $this->request('open_orders', 'private', 'POST', $params);
    }
    public function private_post_order_status($params = array()) {
        return $this->request('order_status', 'private', 'POST', $params);
    }
    public function private_post_cancel_order($params = array()) {
        return $this->request('cancel_order', 'private', 'POST', $params);
    }
    public function private_post_cancel_all_orders($params = array()) {
        return $this->request('cancel_all_orders', 'private', 'POST', $params);
    }
    public function private_post_buy($params = array()) {
        return $this->request('buy', 'private', 'POST', $params);
    }
    public function private_post_sell($params = array()) {
        return $this->request('sell', 'private', 'POST', $params);
    }
    public function private_post_bitcoin_deposit_address($params = array()) {
        return $this->request('bitcoin_deposit_address', 'private', 'POST', $params);
    }
    public function private_post_unconfirmed_btc($params = array()) {
        return $this->request('unconfirmed_btc', 'private', 'POST', $params);
    }
    public function private_post_ripple_withdrawal($params = array()) {
        return $this->request('ripple_withdrawal', 'private', 'POST', $params);
    }
    public function private_post_ripple_address($params = array()) {
        return $this->request('ripple_address', 'private', 'POST', $params);
    }
    public function private_post_withdrawal_requests($params = array()) {
        return $this->request('withdrawal_requests', 'private', 'POST', $params);
    }
    public function private_post_bitcoin_withdrawal($params = array()) {
        return $this->request('bitcoin_withdrawal', 'private', 'POST', $params);
    }
    public function publicGetTicker($params = array()) {
        return $this->request('ticker', 'public', 'GET', $params);
    }
    public function publicGetTickerHour($params = array()) {
        return $this->request('ticker_hour', 'public', 'GET', $params);
    }
    public function publicGetOrderBook($params = array()) {
        return $this->request('order_book', 'public', 'GET', $params);
    }
    public function publicGetTransactions($params = array()) {
        return $this->request('transactions', 'public', 'GET', $params);
    }
    public function publicGetEurUsd($params = array()) {
        return $this->request('eur_usd', 'public', 'GET', $params);
    }
    public function privatePostBalance($params = array()) {
        return $this->request('balance', 'private', 'POST', $params);
    }
    public function privatePostUserTransactions($params = array()) {
        return $this->request('user_transactions', 'private', 'POST', $params);
    }
    public function privatePostOpenOrders($params = array()) {
        return $this->request('open_orders', 'private', 'POST', $params);
    }
    public function privatePostOrderStatus($params = array()) {
        return $this->request('order_status', 'private', 'POST', $params);
    }
    public function privatePostCancelOrder($params = array()) {
        return $this->request('cancel_order', 'private', 'POST', $params);
    }
    public function privatePostCancelAllOrders($params = array()) {
        return $this->request('cancel_all_orders', 'private', 'POST', $params);
    }
    public function privatePostBuy($params = array()) {
        return $this->request('buy', 'private', 'POST', $params);
    }
    public function privatePostSell($params = array()) {
        return $this->request('sell', 'private', 'POST', $params);
    }
    public function privatePostBitcoinDepositAddress($params = array()) {
        return $this->request('bitcoin_deposit_address', 'private', 'POST', $params);
    }
    public function privatePostUnconfirmedBtc($params = array()) {
        return $this->request('unconfirmed_btc', 'private', 'POST', $params);
    }
    public function privatePostRippleWithdrawal($params = array()) {
        return $this->request('ripple_withdrawal', 'private', 'POST', $params);
    }
    public function privatePostRippleAddress($params = array()) {
        return $this->request('ripple_address', 'private', 'POST', $params);
    }
    public function privatePostWithdrawalRequests($params = array()) {
        return $this->request('withdrawal_requests', 'private', 'POST', $params);
    }
    public function privatePostBitcoinWithdrawal($params = array()) {
        return $this->request('bitcoin_withdrawal', 'private', 'POST', $params);
    }
}