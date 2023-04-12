<?php

namespace ccxt\async\abstract;

// PLEASE DO NOT EDIT THIS FILE, IT IS GENERATED AND WILL BE OVERWRITTEN:
// https://github.com/ccxt/ccxt/blob/master/CONTRIBUTING.md#how-to-contribute-code


use ccxt\async\Exchange;

abstract class zaif extends Exchange {
    public function public_get_depth_pair($params = array()) {
        return $this->request('depth/{pair}', 'public', 'GET', $params);
    }
    public function public_get_currencies_pair($params = array()) {
        return $this->request('currencies/{pair}', 'public', 'GET', $params);
    }
    public function public_get_currencies_all($params = array()) {
        return $this->request('currencies/all', 'public', 'GET', $params);
    }
    public function public_get_currency_pairs_pair($params = array()) {
        return $this->request('currency_pairs/{pair}', 'public', 'GET', $params);
    }
    public function public_get_currency_pairs_all($params = array()) {
        return $this->request('currency_pairs/all', 'public', 'GET', $params);
    }
    public function public_get_last_price_pair($params = array()) {
        return $this->request('last_price/{pair}', 'public', 'GET', $params);
    }
    public function public_get_ticker_pair($params = array()) {
        return $this->request('ticker/{pair}', 'public', 'GET', $params);
    }
    public function public_get_trades_pair($params = array()) {
        return $this->request('trades/{pair}', 'public', 'GET', $params);
    }
    public function private_post_active_orders($params = array()) {
        return $this->request('active_orders', 'private', 'POST', $params);
    }
    public function private_post_cancel_order($params = array()) {
        return $this->request('cancel_order', 'private', 'POST', $params);
    }
    public function private_post_deposit_history($params = array()) {
        return $this->request('deposit_history', 'private', 'POST', $params);
    }
    public function private_post_get_id_info($params = array()) {
        return $this->request('get_id_info', 'private', 'POST', $params);
    }
    public function private_post_get_info($params = array()) {
        return $this->request('get_info', 'private', 'POST', $params);
    }
    public function private_post_get_info2($params = array()) {
        return $this->request('get_info2', 'private', 'POST', $params);
    }
    public function private_post_get_personal_info($params = array()) {
        return $this->request('get_personal_info', 'private', 'POST', $params);
    }
    public function private_post_trade($params = array()) {
        return $this->request('trade', 'private', 'POST', $params);
    }
    public function private_post_trade_history($params = array()) {
        return $this->request('trade_history', 'private', 'POST', $params);
    }
    public function private_post_withdraw($params = array()) {
        return $this->request('withdraw', 'private', 'POST', $params);
    }
    public function private_post_withdraw_history($params = array()) {
        return $this->request('withdraw_history', 'private', 'POST', $params);
    }
    public function ecapi_post_createinvoice($params = array()) {
        return $this->request('createInvoice', 'ecapi', 'POST', $params);
    }
    public function ecapi_post_getinvoice($params = array()) {
        return $this->request('getInvoice', 'ecapi', 'POST', $params);
    }
    public function ecapi_post_getinvoiceidsbyordernumber($params = array()) {
        return $this->request('getInvoiceIdsByOrderNumber', 'ecapi', 'POST', $params);
    }
    public function ecapi_post_cancelinvoice($params = array()) {
        return $this->request('cancelInvoice', 'ecapi', 'POST', $params);
    }
    public function tlapi_post_get_positions($params = array()) {
        return $this->request('get_positions', 'tlapi', 'POST', $params);
    }
    public function tlapi_post_position_history($params = array()) {
        return $this->request('position_history', 'tlapi', 'POST', $params);
    }
    public function tlapi_post_active_positions($params = array()) {
        return $this->request('active_positions', 'tlapi', 'POST', $params);
    }
    public function tlapi_post_create_position($params = array()) {
        return $this->request('create_position', 'tlapi', 'POST', $params);
    }
    public function tlapi_post_change_position($params = array()) {
        return $this->request('change_position', 'tlapi', 'POST', $params);
    }
    public function tlapi_post_cancel_position($params = array()) {
        return $this->request('cancel_position', 'tlapi', 'POST', $params);
    }
    public function fapi_get_groups_group_id($params = array()) {
        return $this->request('groups/{group_id}', 'fapi', 'GET', $params);
    }
    public function fapi_get_last_price_group_id_pair($params = array()) {
        return $this->request('last_price/{group_id}/{pair}', 'fapi', 'GET', $params);
    }
    public function fapi_get_ticker_group_id_pair($params = array()) {
        return $this->request('ticker/{group_id}/{pair}', 'fapi', 'GET', $params);
    }
    public function fapi_get_trades_group_id_pair($params = array()) {
        return $this->request('trades/{group_id}/{pair}', 'fapi', 'GET', $params);
    }
    public function fapi_get_depth_group_id_pair($params = array()) {
        return $this->request('depth/{group_id}/{pair}', 'fapi', 'GET', $params);
    }
    public function publicGetDepthPair($params = array()) {
        return $this->request('depth/{pair}', 'public', 'GET', $params);
    }
    public function publicGetCurrenciesPair($params = array()) {
        return $this->request('currencies/{pair}', 'public', 'GET', $params);
    }
    public function publicGetCurrenciesAll($params = array()) {
        return $this->request('currencies/all', 'public', 'GET', $params);
    }
    public function publicGetCurrencyPairsPair($params = array()) {
        return $this->request('currency_pairs/{pair}', 'public', 'GET', $params);
    }
    public function publicGetCurrencyPairsAll($params = array()) {
        return $this->request('currency_pairs/all', 'public', 'GET', $params);
    }
    public function publicGetLastPricePair($params = array()) {
        return $this->request('last_price/{pair}', 'public', 'GET', $params);
    }
    public function publicGetTickerPair($params = array()) {
        return $this->request('ticker/{pair}', 'public', 'GET', $params);
    }
    public function publicGetTradesPair($params = array()) {
        return $this->request('trades/{pair}', 'public', 'GET', $params);
    }
    public function privatePostActiveOrders($params = array()) {
        return $this->request('active_orders', 'private', 'POST', $params);
    }
    public function privatePostCancelOrder($params = array()) {
        return $this->request('cancel_order', 'private', 'POST', $params);
    }
    public function privatePostDepositHistory($params = array()) {
        return $this->request('deposit_history', 'private', 'POST', $params);
    }
    public function privatePostGetIdInfo($params = array()) {
        return $this->request('get_id_info', 'private', 'POST', $params);
    }
    public function privatePostGetInfo($params = array()) {
        return $this->request('get_info', 'private', 'POST', $params);
    }
    public function privatePostGetInfo2($params = array()) {
        return $this->request('get_info2', 'private', 'POST', $params);
    }
    public function privatePostGetPersonalInfo($params = array()) {
        return $this->request('get_personal_info', 'private', 'POST', $params);
    }
    public function privatePostTrade($params = array()) {
        return $this->request('trade', 'private', 'POST', $params);
    }
    public function privatePostTradeHistory($params = array()) {
        return $this->request('trade_history', 'private', 'POST', $params);
    }
    public function privatePostWithdraw($params = array()) {
        return $this->request('withdraw', 'private', 'POST', $params);
    }
    public function privatePostWithdrawHistory($params = array()) {
        return $this->request('withdraw_history', 'private', 'POST', $params);
    }
    public function ecapiPostCreateInvoice($params = array()) {
        return $this->request('createInvoice', 'ecapi', 'POST', $params);
    }
    public function ecapiPostGetInvoice($params = array()) {
        return $this->request('getInvoice', 'ecapi', 'POST', $params);
    }
    public function ecapiPostGetInvoiceIdsByOrderNumber($params = array()) {
        return $this->request('getInvoiceIdsByOrderNumber', 'ecapi', 'POST', $params);
    }
    public function ecapiPostCancelInvoice($params = array()) {
        return $this->request('cancelInvoice', 'ecapi', 'POST', $params);
    }
    public function tlapiPostGetPositions($params = array()) {
        return $this->request('get_positions', 'tlapi', 'POST', $params);
    }
    public function tlapiPostPositionHistory($params = array()) {
        return $this->request('position_history', 'tlapi', 'POST', $params);
    }
    public function tlapiPostActivePositions($params = array()) {
        return $this->request('active_positions', 'tlapi', 'POST', $params);
    }
    public function tlapiPostCreatePosition($params = array()) {
        return $this->request('create_position', 'tlapi', 'POST', $params);
    }
    public function tlapiPostChangePosition($params = array()) {
        return $this->request('change_position', 'tlapi', 'POST', $params);
    }
    public function tlapiPostCancelPosition($params = array()) {
        return $this->request('cancel_position', 'tlapi', 'POST', $params);
    }
    public function fapiGetGroupsGroupId($params = array()) {
        return $this->request('groups/{group_id}', 'fapi', 'GET', $params);
    }
    public function fapiGetLastPriceGroupIdPair($params = array()) {
        return $this->request('last_price/{group_id}/{pair}', 'fapi', 'GET', $params);
    }
    public function fapiGetTickerGroupIdPair($params = array()) {
        return $this->request('ticker/{group_id}/{pair}', 'fapi', 'GET', $params);
    }
    public function fapiGetTradesGroupIdPair($params = array()) {
        return $this->request('trades/{group_id}/{pair}', 'fapi', 'GET', $params);
    }
    public function fapiGetDepthGroupIdPair($params = array()) {
        return $this->request('depth/{group_id}/{pair}', 'fapi', 'GET', $params);
    }
}