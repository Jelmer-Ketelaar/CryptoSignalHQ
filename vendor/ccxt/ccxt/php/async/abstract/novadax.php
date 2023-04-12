<?php

namespace ccxt\async\abstract;

// PLEASE DO NOT EDIT THIS FILE, IT IS GENERATED AND WILL BE OVERWRITTEN:
// https://github.com/ccxt/ccxt/blob/master/CONTRIBUTING.md#how-to-contribute-code


use ccxt\async\Exchange;

abstract class novadax extends Exchange {
    public function public_get_common_symbol($params = array()) {
        return $this->request('common/symbol', 'public', 'GET', $params);
    }
    public function public_get_common_symbols($params = array()) {
        return $this->request('common/symbols', 'public', 'GET', $params);
    }
    public function public_get_common_timestamp($params = array()) {
        return $this->request('common/timestamp', 'public', 'GET', $params);
    }
    public function public_get_market_tickers($params = array()) {
        return $this->request('market/tickers', 'public', 'GET', $params);
    }
    public function public_get_market_ticker($params = array()) {
        return $this->request('market/ticker', 'public', 'GET', $params);
    }
    public function public_get_market_depth($params = array()) {
        return $this->request('market/depth', 'public', 'GET', $params);
    }
    public function public_get_market_trades($params = array()) {
        return $this->request('market/trades', 'public', 'GET', $params);
    }
    public function public_get_market_kline_history($params = array()) {
        return $this->request('market/kline/history', 'public', 'GET', $params);
    }
    public function private_get_orders_get($params = array()) {
        return $this->request('orders/get', 'private', 'GET', $params);
    }
    public function private_get_orders_list($params = array()) {
        return $this->request('orders/list', 'private', 'GET', $params);
    }
    public function private_get_orders_fill($params = array()) {
        return $this->request('orders/fill', 'private', 'GET', $params);
    }
    public function private_get_orders_fills($params = array()) {
        return $this->request('orders/fills', 'private', 'GET', $params);
    }
    public function private_get_account_getbalance($params = array()) {
        return $this->request('account/getBalance', 'private', 'GET', $params);
    }
    public function private_get_account_subs($params = array()) {
        return $this->request('account/subs', 'private', 'GET', $params);
    }
    public function private_get_account_subs_balance($params = array()) {
        return $this->request('account/subs/balance', 'private', 'GET', $params);
    }
    public function private_get_account_subs_transfer_record($params = array()) {
        return $this->request('account/subs/transfer/record', 'private', 'GET', $params);
    }
    public function private_get_wallet_query_deposit_withdraw($params = array()) {
        return $this->request('wallet/query/deposit-withdraw', 'private', 'GET', $params);
    }
    public function private_post_orders_create($params = array()) {
        return $this->request('orders/create', 'private', 'POST', $params);
    }
    public function private_post_orders_cancel($params = array()) {
        return $this->request('orders/cancel', 'private', 'POST', $params);
    }
    public function private_post_account_withdraw_coin($params = array()) {
        return $this->request('account/withdraw/coin', 'private', 'POST', $params);
    }
    public function private_post_account_subs_transfer($params = array()) {
        return $this->request('account/subs/transfer', 'private', 'POST', $params);
    }
    public function publicGetCommonSymbol($params = array()) {
        return $this->request('common/symbol', 'public', 'GET', $params);
    }
    public function publicGetCommonSymbols($params = array()) {
        return $this->request('common/symbols', 'public', 'GET', $params);
    }
    public function publicGetCommonTimestamp($params = array()) {
        return $this->request('common/timestamp', 'public', 'GET', $params);
    }
    public function publicGetMarketTickers($params = array()) {
        return $this->request('market/tickers', 'public', 'GET', $params);
    }
    public function publicGetMarketTicker($params = array()) {
        return $this->request('market/ticker', 'public', 'GET', $params);
    }
    public function publicGetMarketDepth($params = array()) {
        return $this->request('market/depth', 'public', 'GET', $params);
    }
    public function publicGetMarketTrades($params = array()) {
        return $this->request('market/trades', 'public', 'GET', $params);
    }
    public function publicGetMarketKlineHistory($params = array()) {
        return $this->request('market/kline/history', 'public', 'GET', $params);
    }
    public function privateGetOrdersGet($params = array()) {
        return $this->request('orders/get', 'private', 'GET', $params);
    }
    public function privateGetOrdersList($params = array()) {
        return $this->request('orders/list', 'private', 'GET', $params);
    }
    public function privateGetOrdersFill($params = array()) {
        return $this->request('orders/fill', 'private', 'GET', $params);
    }
    public function privateGetOrdersFills($params = array()) {
        return $this->request('orders/fills', 'private', 'GET', $params);
    }
    public function privateGetAccountGetBalance($params = array()) {
        return $this->request('account/getBalance', 'private', 'GET', $params);
    }
    public function privateGetAccountSubs($params = array()) {
        return $this->request('account/subs', 'private', 'GET', $params);
    }
    public function privateGetAccountSubsBalance($params = array()) {
        return $this->request('account/subs/balance', 'private', 'GET', $params);
    }
    public function privateGetAccountSubsTransferRecord($params = array()) {
        return $this->request('account/subs/transfer/record', 'private', 'GET', $params);
    }
    public function privateGetWalletQueryDepositWithdraw($params = array()) {
        return $this->request('wallet/query/deposit-withdraw', 'private', 'GET', $params);
    }
    public function privatePostOrdersCreate($params = array()) {
        return $this->request('orders/create', 'private', 'POST', $params);
    }
    public function privatePostOrdersCancel($params = array()) {
        return $this->request('orders/cancel', 'private', 'POST', $params);
    }
    public function privatePostAccountWithdrawCoin($params = array()) {
        return $this->request('account/withdraw/coin', 'private', 'POST', $params);
    }
    public function privatePostAccountSubsTransfer($params = array()) {
        return $this->request('account/subs/transfer', 'private', 'POST', $params);
    }
}