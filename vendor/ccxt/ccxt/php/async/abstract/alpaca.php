<?php

namespace ccxt\async\abstract;

// PLEASE DO NOT EDIT THIS FILE, IT IS GENERATED AND WILL BE OVERWRITTEN:
// https://github.com/ccxt/ccxt/blob/master/CONTRIBUTING.md#how-to-contribute-code


use ccxt\async\Exchange;

abstract class alpaca extends Exchange {
    public function markets_get_assets_public_beta($params = array()) {
        return $this->request('assets/public/beta', 'markets', 'GET', $params);
    }
    public function private_get_account($params = array()) {
        return $this->request('account', 'private', 'GET', $params);
    }
    public function private_get_orders($params = array()) {
        return $this->request('orders', 'private', 'GET', $params);
    }
    public function private_get_orders_order_id($params = array()) {
        return $this->request('orders/{order_id}', 'private', 'GET', $params);
    }
    public function private_get_positions($params = array()) {
        return $this->request('positions', 'private', 'GET', $params);
    }
    public function private_get_positions_symbol($params = array()) {
        return $this->request('positions/{symbol}', 'private', 'GET', $params);
    }
    public function private_get_account_activities_activity_type($params = array()) {
        return $this->request('account/activities/{activity_type}', 'private', 'GET', $params);
    }
    public function private_post_orders($params = array()) {
        return $this->request('orders', 'private', 'POST', $params);
    }
    public function private_delete_orders($params = array()) {
        return $this->request('orders', 'private', 'DELETE', $params);
    }
    public function private_delete_orders_order_id($params = array()) {
        return $this->request('orders/{order_id}', 'private', 'DELETE', $params);
    }
    public function cryptopublic_get_crypto_latest_orderbooks($params = array()) {
        return $this->request('crypto/latest/orderbooks', 'cryptoPublic', 'GET', $params);
    }
    public function cryptopublic_get_crypto_trades($params = array()) {
        return $this->request('crypto/trades', 'cryptoPublic', 'GET', $params);
    }
    public function cryptopublic_get_crypto_quotes($params = array()) {
        return $this->request('crypto/quotes', 'cryptoPublic', 'GET', $params);
    }
    public function cryptopublic_get_crypto_latest_quotes($params = array()) {
        return $this->request('crypto/latest/quotes', 'cryptoPublic', 'GET', $params);
    }
    public function cryptopublic_get_crypto_bars($params = array()) {
        return $this->request('crypto/bars', 'cryptoPublic', 'GET', $params);
    }
    public function cryptopublic_get_crypto_snapshots($params = array()) {
        return $this->request('crypto/snapshots', 'cryptoPublic', 'GET', $params);
    }
    public function marketsGetAssetsPublicBeta($params = array()) {
        return $this->request('assets/public/beta', 'markets', 'GET', $params);
    }
    public function privateGetAccount($params = array()) {
        return $this->request('account', 'private', 'GET', $params);
    }
    public function privateGetOrders($params = array()) {
        return $this->request('orders', 'private', 'GET', $params);
    }
    public function privateGetOrdersOrderId($params = array()) {
        return $this->request('orders/{order_id}', 'private', 'GET', $params);
    }
    public function privateGetPositions($params = array()) {
        return $this->request('positions', 'private', 'GET', $params);
    }
    public function privateGetPositionsSymbol($params = array()) {
        return $this->request('positions/{symbol}', 'private', 'GET', $params);
    }
    public function privateGetAccountActivitiesActivityType($params = array()) {
        return $this->request('account/activities/{activity_type}', 'private', 'GET', $params);
    }
    public function privatePostOrders($params = array()) {
        return $this->request('orders', 'private', 'POST', $params);
    }
    public function privateDeleteOrders($params = array()) {
        return $this->request('orders', 'private', 'DELETE', $params);
    }
    public function privateDeleteOrdersOrderId($params = array()) {
        return $this->request('orders/{order_id}', 'private', 'DELETE', $params);
    }
    public function cryptoPublicGetCryptoLatestOrderbooks($params = array()) {
        return $this->request('crypto/latest/orderbooks', 'cryptoPublic', 'GET', $params);
    }
    public function cryptoPublicGetCryptoTrades($params = array()) {
        return $this->request('crypto/trades', 'cryptoPublic', 'GET', $params);
    }
    public function cryptoPublicGetCryptoQuotes($params = array()) {
        return $this->request('crypto/quotes', 'cryptoPublic', 'GET', $params);
    }
    public function cryptoPublicGetCryptoLatestQuotes($params = array()) {
        return $this->request('crypto/latest/quotes', 'cryptoPublic', 'GET', $params);
    }
    public function cryptoPublicGetCryptoBars($params = array()) {
        return $this->request('crypto/bars', 'cryptoPublic', 'GET', $params);
    }
    public function cryptoPublicGetCryptoSnapshots($params = array()) {
        return $this->request('crypto/snapshots', 'cryptoPublic', 'GET', $params);
    }
}