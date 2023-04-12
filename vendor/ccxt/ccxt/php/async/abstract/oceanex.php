<?php

namespace ccxt\async\abstract;

// PLEASE DO NOT EDIT THIS FILE, IT IS GENERATED AND WILL BE OVERWRITTEN:
// https://github.com/ccxt/ccxt/blob/master/CONTRIBUTING.md#how-to-contribute-code


use ccxt\async\Exchange;

abstract class oceanex extends Exchange {
    public function public_get_markets($params = array()) {
        return $this->request('markets', 'public', 'GET', $params);
    }
    public function public_get_tickers_pair($params = array()) {
        return $this->request('tickers/{pair}', 'public', 'GET', $params);
    }
    public function public_get_tickers_multi($params = array()) {
        return $this->request('tickers_multi', 'public', 'GET', $params);
    }
    public function public_get_order_book($params = array()) {
        return $this->request('order_book', 'public', 'GET', $params);
    }
    public function public_get_order_book_multi($params = array()) {
        return $this->request('order_book/multi', 'public', 'GET', $params);
    }
    public function public_get_fees_trading($params = array()) {
        return $this->request('fees/trading', 'public', 'GET', $params);
    }
    public function public_get_trades($params = array()) {
        return $this->request('trades', 'public', 'GET', $params);
    }
    public function public_get_timestamp($params = array()) {
        return $this->request('timestamp', 'public', 'GET', $params);
    }
    public function public_post_k($params = array()) {
        return $this->request('k', 'public', 'POST', $params);
    }
    public function private_get_key($params = array()) {
        return $this->request('key', 'private', 'GET', $params);
    }
    public function private_get_members_me($params = array()) {
        return $this->request('members/me', 'private', 'GET', $params);
    }
    public function private_get_orders($params = array()) {
        return $this->request('orders', 'private', 'GET', $params);
    }
    public function private_get_orders_filter($params = array()) {
        return $this->request('orders/filter', 'private', 'GET', $params);
    }
    public function private_post_orders($params = array()) {
        return $this->request('orders', 'private', 'POST', $params);
    }
    public function private_post_orders_multi($params = array()) {
        return $this->request('orders/multi', 'private', 'POST', $params);
    }
    public function private_post_order_delete($params = array()) {
        return $this->request('order/delete', 'private', 'POST', $params);
    }
    public function private_post_order_delete_multi($params = array()) {
        return $this->request('order/delete/multi', 'private', 'POST', $params);
    }
    public function private_post_orders_clear($params = array()) {
        return $this->request('orders/clear', 'private', 'POST', $params);
    }
    public function publicGetMarkets($params = array()) {
        return $this->request('markets', 'public', 'GET', $params);
    }
    public function publicGetTickersPair($params = array()) {
        return $this->request('tickers/{pair}', 'public', 'GET', $params);
    }
    public function publicGetTickersMulti($params = array()) {
        return $this->request('tickers_multi', 'public', 'GET', $params);
    }
    public function publicGetOrderBook($params = array()) {
        return $this->request('order_book', 'public', 'GET', $params);
    }
    public function publicGetOrderBookMulti($params = array()) {
        return $this->request('order_book/multi', 'public', 'GET', $params);
    }
    public function publicGetFeesTrading($params = array()) {
        return $this->request('fees/trading', 'public', 'GET', $params);
    }
    public function publicGetTrades($params = array()) {
        return $this->request('trades', 'public', 'GET', $params);
    }
    public function publicGetTimestamp($params = array()) {
        return $this->request('timestamp', 'public', 'GET', $params);
    }
    public function publicPostK($params = array()) {
        return $this->request('k', 'public', 'POST', $params);
    }
    public function privateGetKey($params = array()) {
        return $this->request('key', 'private', 'GET', $params);
    }
    public function privateGetMembersMe($params = array()) {
        return $this->request('members/me', 'private', 'GET', $params);
    }
    public function privateGetOrders($params = array()) {
        return $this->request('orders', 'private', 'GET', $params);
    }
    public function privateGetOrdersFilter($params = array()) {
        return $this->request('orders/filter', 'private', 'GET', $params);
    }
    public function privatePostOrders($params = array()) {
        return $this->request('orders', 'private', 'POST', $params);
    }
    public function privatePostOrdersMulti($params = array()) {
        return $this->request('orders/multi', 'private', 'POST', $params);
    }
    public function privatePostOrderDelete($params = array()) {
        return $this->request('order/delete', 'private', 'POST', $params);
    }
    public function privatePostOrderDeleteMulti($params = array()) {
        return $this->request('order/delete/multi', 'private', 'POST', $params);
    }
    public function privatePostOrdersClear($params = array()) {
        return $this->request('orders/clear', 'private', 'POST', $params);
    }
}