<?php

namespace ccxt\async\abstract;

// PLEASE DO NOT EDIT THIS FILE, IT IS GENERATED AND WILL BE OVERWRITTEN:
// https://github.com/ccxt/ccxt/blob/master/CONTRIBUTING.md#how-to-contribute-code


use ccxt\async\Exchange;

abstract class coinex extends Exchange {
    public function public_get_amm_market($params = array()) {
        return $this->request('amm/market', 'public', 'GET', $params);
    }
    public function public_get_common_currency_rate($params = array()) {
        return $this->request('common/currency/rate', 'public', 'GET', $params);
    }
    public function public_get_common_asset_config($params = array()) {
        return $this->request('common/asset/config', 'public', 'GET', $params);
    }
    public function public_get_common_maintain_info($params = array()) {
        return $this->request('common/maintain/info', 'public', 'GET', $params);
    }
    public function public_get_common_temp_maintain_info($params = array()) {
        return $this->request('common/temp-maintain/info', 'public', 'GET', $params);
    }
    public function public_get_margin_market($params = array()) {
        return $this->request('margin/market', 'public', 'GET', $params);
    }
    public function public_get_market_info($params = array()) {
        return $this->request('market/info', 'public', 'GET', $params);
    }
    public function public_get_market_list($params = array()) {
        return $this->request('market/list', 'public', 'GET', $params);
    }
    public function public_get_market_ticker($params = array()) {
        return $this->request('market/ticker', 'public', 'GET', $params);
    }
    public function public_get_market_ticker_all($params = array()) {
        return $this->request('market/ticker/all', 'public', 'GET', $params);
    }
    public function public_get_market_depth($params = array()) {
        return $this->request('market/depth', 'public', 'GET', $params);
    }
    public function public_get_market_deals($params = array()) {
        return $this->request('market/deals', 'public', 'GET', $params);
    }
    public function public_get_market_kline($params = array()) {
        return $this->request('market/kline', 'public', 'GET', $params);
    }
    public function public_get_market_detail($params = array()) {
        return $this->request('market/detail', 'public', 'GET', $params);
    }
    public function private_get_account_amm_balance($params = array()) {
        return $this->request('account/amm/balance', 'private', 'GET', $params);
    }
    public function private_get_account_investment_balance($params = array()) {
        return $this->request('account/investment/balance', 'private', 'GET', $params);
    }
    public function private_get_account_balance_history($params = array()) {
        return $this->request('account/balance/history', 'private', 'GET', $params);
    }
    public function private_get_account_market_fee($params = array()) {
        return $this->request('account/market/fee', 'private', 'GET', $params);
    }
    public function private_get_balance_coin_deposit($params = array()) {
        return $this->request('balance/coin/deposit', 'private', 'GET', $params);
    }
    public function private_get_balance_coin_withdraw($params = array()) {
        return $this->request('balance/coin/withdraw', 'private', 'GET', $params);
    }
    public function private_get_balance_info($params = array()) {
        return $this->request('balance/info', 'private', 'GET', $params);
    }
    public function private_get_balance_deposit_address_coin_type($params = array()) {
        return $this->request('balance/deposit/address/{coin_type}', 'private', 'GET', $params);
    }
    public function private_get_contract_transfer_history($params = array()) {
        return $this->request('contract/transfer/history', 'private', 'GET', $params);
    }
    public function private_get_credit_info($params = array()) {
        return $this->request('credit/info', 'private', 'GET', $params);
    }
    public function private_get_credit_balance($params = array()) {
        return $this->request('credit/balance', 'private', 'GET', $params);
    }
    public function private_get_investment_transfer_history($params = array()) {
        return $this->request('investment/transfer/history', 'private', 'GET', $params);
    }
    public function private_get_margin_account($params = array()) {
        return $this->request('margin/account', 'private', 'GET', $params);
    }
    public function private_get_margin_config($params = array()) {
        return $this->request('margin/config', 'private', 'GET', $params);
    }
    public function private_get_margin_loan_history($params = array()) {
        return $this->request('margin/loan/history', 'private', 'GET', $params);
    }
    public function private_get_margin_transfer_history($params = array()) {
        return $this->request('margin/transfer/history', 'private', 'GET', $params);
    }
    public function private_get_order_deals($params = array()) {
        return $this->request('order/deals', 'private', 'GET', $params);
    }
    public function private_get_order_finished($params = array()) {
        return $this->request('order/finished', 'private', 'GET', $params);
    }
    public function private_get_order_pending($params = array()) {
        return $this->request('order/pending', 'private', 'GET', $params);
    }
    public function private_get_order_status($params = array()) {
        return $this->request('order/status', 'private', 'GET', $params);
    }
    public function private_get_order_status_batch($params = array()) {
        return $this->request('order/status/batch', 'private', 'GET', $params);
    }
    public function private_get_order_user_deals($params = array()) {
        return $this->request('order/user/deals', 'private', 'GET', $params);
    }
    public function private_get_order_stop_finished($params = array()) {
        return $this->request('order/stop/finished', 'private', 'GET', $params);
    }
    public function private_get_order_stop_pending($params = array()) {
        return $this->request('order/stop/pending', 'private', 'GET', $params);
    }
    public function private_get_order_user_trade_fee($params = array()) {
        return $this->request('order/user/trade/fee', 'private', 'GET', $params);
    }
    public function private_get_order_market_trade_info($params = array()) {
        return $this->request('order/market/trade/info', 'private', 'GET', $params);
    }
    public function private_get_sub_account_balance($params = array()) {
        return $this->request('sub_account/balance', 'private', 'GET', $params);
    }
    public function private_get_sub_account_transfer_history($params = array()) {
        return $this->request('sub_account/transfer/history', 'private', 'GET', $params);
    }
    public function private_get_sub_account_auth_api_user_auth_id($params = array()) {
        return $this->request('sub_account/auth/api/{user_auth_id}', 'private', 'GET', $params);
    }
    public function private_post_balance_coin_withdraw($params = array()) {
        return $this->request('balance/coin/withdraw', 'private', 'POST', $params);
    }
    public function private_post_contract_balance_transfer($params = array()) {
        return $this->request('contract/balance/transfer', 'private', 'POST', $params);
    }
    public function private_post_margin_flat($params = array()) {
        return $this->request('margin/flat', 'private', 'POST', $params);
    }
    public function private_post_margin_loan($params = array()) {
        return $this->request('margin/loan', 'private', 'POST', $params);
    }
    public function private_post_margin_transfer($params = array()) {
        return $this->request('margin/transfer', 'private', 'POST', $params);
    }
    public function private_post_order_limit_batch($params = array()) {
        return $this->request('order/limit/batch', 'private', 'POST', $params);
    }
    public function private_post_order_ioc($params = array()) {
        return $this->request('order/ioc', 'private', 'POST', $params);
    }
    public function private_post_order_limit($params = array()) {
        return $this->request('order/limit', 'private', 'POST', $params);
    }
    public function private_post_order_market($params = array()) {
        return $this->request('order/market', 'private', 'POST', $params);
    }
    public function private_post_order_modify($params = array()) {
        return $this->request('order/modify', 'private', 'POST', $params);
    }
    public function private_post_order_stop_limit($params = array()) {
        return $this->request('order/stop/limit', 'private', 'POST', $params);
    }
    public function private_post_order_stop_market($params = array()) {
        return $this->request('order/stop/market', 'private', 'POST', $params);
    }
    public function private_post_order_stop_modify($params = array()) {
        return $this->request('order/stop/modify', 'private', 'POST', $params);
    }
    public function private_post_sub_account_transfer($params = array()) {
        return $this->request('sub_account/transfer', 'private', 'POST', $params);
    }
    public function private_post_sub_account_register($params = array()) {
        return $this->request('sub_account/register', 'private', 'POST', $params);
    }
    public function private_post_sub_account_unfrozen($params = array()) {
        return $this->request('sub_account/unfrozen', 'private', 'POST', $params);
    }
    public function private_post_sub_account_frozen($params = array()) {
        return $this->request('sub_account/frozen', 'private', 'POST', $params);
    }
    public function private_post_sub_account_auth_api($params = array()) {
        return $this->request('sub_account/auth/api', 'private', 'POST', $params);
    }
    public function private_put_balance_deposit_address_coin_type($params = array()) {
        return $this->request('balance/deposit/address/{coin_type}', 'private', 'PUT', $params);
    }
    public function private_put_sub_account_auth_api_user_auth_id($params = array()) {
        return $this->request('sub_account/auth/api/{user_auth_id}', 'private', 'PUT', $params);
    }
    public function private_put_v1_account_settings($params = array()) {
        return $this->request('v1/account/settings', 'private', 'PUT', $params);
    }
    public function private_delete_balance_coin_withdraw($params = array()) {
        return $this->request('balance/coin/withdraw', 'private', 'DELETE', $params);
    }
    public function private_delete_order_pending_batch($params = array()) {
        return $this->request('order/pending/batch', 'private', 'DELETE', $params);
    }
    public function private_delete_order_pending($params = array()) {
        return $this->request('order/pending', 'private', 'DELETE', $params);
    }
    public function private_delete_order_stop_pending($params = array()) {
        return $this->request('order/stop/pending', 'private', 'DELETE', $params);
    }
    public function private_delete_order_stop_pending_id($params = array()) {
        return $this->request('order/stop/pending/{id}', 'private', 'DELETE', $params);
    }
    public function private_delete_sub_account_auth_api_user_auth_id($params = array()) {
        return $this->request('sub_account/auth/api/{user_auth_id}', 'private', 'DELETE', $params);
    }
    public function perpetualpublic_get_ping($params = array()) {
        return $this->request('ping', 'perpetualPublic', 'GET', $params);
    }
    public function perpetualpublic_get_time($params = array()) {
        return $this->request('time', 'perpetualPublic', 'GET', $params);
    }
    public function perpetualpublic_get_market_list($params = array()) {
        return $this->request('market/list', 'perpetualPublic', 'GET', $params);
    }
    public function perpetualpublic_get_market_limit_config($params = array()) {
        return $this->request('market/limit_config', 'perpetualPublic', 'GET', $params);
    }
    public function perpetualpublic_get_market_ticker($params = array()) {
        return $this->request('market/ticker', 'perpetualPublic', 'GET', $params);
    }
    public function perpetualpublic_get_market_ticker_all($params = array()) {
        return $this->request('market/ticker/all', 'perpetualPublic', 'GET', $params);
    }
    public function perpetualpublic_get_market_depth($params = array()) {
        return $this->request('market/depth', 'perpetualPublic', 'GET', $params);
    }
    public function perpetualpublic_get_market_deals($params = array()) {
        return $this->request('market/deals', 'perpetualPublic', 'GET', $params);
    }
    public function perpetualpublic_get_market_funding_history($params = array()) {
        return $this->request('market/funding_history', 'perpetualPublic', 'GET', $params);
    }
    public function perpetualpublic_get_market_user_deals($params = array()) {
        return $this->request('market/user_deals', 'perpetualPublic', 'GET', $params);
    }
    public function perpetualpublic_get_market_kline($params = array()) {
        return $this->request('market/kline', 'perpetualPublic', 'GET', $params);
    }
    public function perpetualprivate_get_asset_query($params = array()) {
        return $this->request('asset/query', 'perpetualPrivate', 'GET', $params);
    }
    public function perpetualprivate_get_order_pending($params = array()) {
        return $this->request('order/pending', 'perpetualPrivate', 'GET', $params);
    }
    public function perpetualprivate_get_order_finished($params = array()) {
        return $this->request('order/finished', 'perpetualPrivate', 'GET', $params);
    }
    public function perpetualprivate_get_order_stop_finished($params = array()) {
        return $this->request('order/stop_finished', 'perpetualPrivate', 'GET', $params);
    }
    public function perpetualprivate_get_order_stop_pending($params = array()) {
        return $this->request('order/stop_pending', 'perpetualPrivate', 'GET', $params);
    }
    public function perpetualprivate_get_order_status($params = array()) {
        return $this->request('order/status', 'perpetualPrivate', 'GET', $params);
    }
    public function perpetualprivate_get_order_stop_status($params = array()) {
        return $this->request('order/stop_status', 'perpetualPrivate', 'GET', $params);
    }
    public function perpetualprivate_get_position_pending($params = array()) {
        return $this->request('position/pending', 'perpetualPrivate', 'GET', $params);
    }
    public function perpetualprivate_get_position_funding($params = array()) {
        return $this->request('position/funding', 'perpetualPrivate', 'GET', $params);
    }
    public function perpetualprivate_post_market_adjust_leverage($params = array()) {
        return $this->request('market/adjust_leverage', 'perpetualPrivate', 'POST', $params);
    }
    public function perpetualprivate_post_market_position_expect($params = array()) {
        return $this->request('market/position_expect', 'perpetualPrivate', 'POST', $params);
    }
    public function perpetualprivate_post_order_put_limit($params = array()) {
        return $this->request('order/put_limit', 'perpetualPrivate', 'POST', $params);
    }
    public function perpetualprivate_post_order_put_market($params = array()) {
        return $this->request('order/put_market', 'perpetualPrivate', 'POST', $params);
    }
    public function perpetualprivate_post_order_put_stop_limit($params = array()) {
        return $this->request('order/put_stop_limit', 'perpetualPrivate', 'POST', $params);
    }
    public function perpetualprivate_post_order_put_stop_market($params = array()) {
        return $this->request('order/put_stop_market', 'perpetualPrivate', 'POST', $params);
    }
    public function perpetualprivate_post_order_modify($params = array()) {
        return $this->request('order/modify', 'perpetualPrivate', 'POST', $params);
    }
    public function perpetualprivate_post_order_modify_stop($params = array()) {
        return $this->request('order/modify_stop', 'perpetualPrivate', 'POST', $params);
    }
    public function perpetualprivate_post_order_cancel($params = array()) {
        return $this->request('order/cancel', 'perpetualPrivate', 'POST', $params);
    }
    public function perpetualprivate_post_order_cancel_all($params = array()) {
        return $this->request('order/cancel_all', 'perpetualPrivate', 'POST', $params);
    }
    public function perpetualprivate_post_order_cancel_batch($params = array()) {
        return $this->request('order/cancel_batch', 'perpetualPrivate', 'POST', $params);
    }
    public function perpetualprivate_post_order_cancel_stop($params = array()) {
        return $this->request('order/cancel_stop', 'perpetualPrivate', 'POST', $params);
    }
    public function perpetualprivate_post_order_cancel_stop_all($params = array()) {
        return $this->request('order/cancel_stop_all', 'perpetualPrivate', 'POST', $params);
    }
    public function perpetualprivate_post_order_close_limit($params = array()) {
        return $this->request('order/close_limit', 'perpetualPrivate', 'POST', $params);
    }
    public function perpetualprivate_post_order_close_market($params = array()) {
        return $this->request('order/close_market', 'perpetualPrivate', 'POST', $params);
    }
    public function perpetualprivate_post_position_adjust_margin($params = array()) {
        return $this->request('position/adjust_margin', 'perpetualPrivate', 'POST', $params);
    }
    public function perpetualprivate_post_position_stop_loss($params = array()) {
        return $this->request('position/stop_loss', 'perpetualPrivate', 'POST', $params);
    }
    public function perpetualprivate_post_position_take_profit($params = array()) {
        return $this->request('position/take_profit', 'perpetualPrivate', 'POST', $params);
    }
    public function perpetualprivate_post_position_market_close($params = array()) {
        return $this->request('position/market_close', 'perpetualPrivate', 'POST', $params);
    }
    public function publicGetAmmMarket($params = array()) {
        return $this->request('amm/market', 'public', 'GET', $params);
    }
    public function publicGetCommonCurrencyRate($params = array()) {
        return $this->request('common/currency/rate', 'public', 'GET', $params);
    }
    public function publicGetCommonAssetConfig($params = array()) {
        return $this->request('common/asset/config', 'public', 'GET', $params);
    }
    public function publicGetCommonMaintainInfo($params = array()) {
        return $this->request('common/maintain/info', 'public', 'GET', $params);
    }
    public function publicGetCommonTempMaintainInfo($params = array()) {
        return $this->request('common/temp-maintain/info', 'public', 'GET', $params);
    }
    public function publicGetMarginMarket($params = array()) {
        return $this->request('margin/market', 'public', 'GET', $params);
    }
    public function publicGetMarketInfo($params = array()) {
        return $this->request('market/info', 'public', 'GET', $params);
    }
    public function publicGetMarketList($params = array()) {
        return $this->request('market/list', 'public', 'GET', $params);
    }
    public function publicGetMarketTicker($params = array()) {
        return $this->request('market/ticker', 'public', 'GET', $params);
    }
    public function publicGetMarketTickerAll($params = array()) {
        return $this->request('market/ticker/all', 'public', 'GET', $params);
    }
    public function publicGetMarketDepth($params = array()) {
        return $this->request('market/depth', 'public', 'GET', $params);
    }
    public function publicGetMarketDeals($params = array()) {
        return $this->request('market/deals', 'public', 'GET', $params);
    }
    public function publicGetMarketKline($params = array()) {
        return $this->request('market/kline', 'public', 'GET', $params);
    }
    public function publicGetMarketDetail($params = array()) {
        return $this->request('market/detail', 'public', 'GET', $params);
    }
    public function privateGetAccountAmmBalance($params = array()) {
        return $this->request('account/amm/balance', 'private', 'GET', $params);
    }
    public function privateGetAccountInvestmentBalance($params = array()) {
        return $this->request('account/investment/balance', 'private', 'GET', $params);
    }
    public function privateGetAccountBalanceHistory($params = array()) {
        return $this->request('account/balance/history', 'private', 'GET', $params);
    }
    public function privateGetAccountMarketFee($params = array()) {
        return $this->request('account/market/fee', 'private', 'GET', $params);
    }
    public function privateGetBalanceCoinDeposit($params = array()) {
        return $this->request('balance/coin/deposit', 'private', 'GET', $params);
    }
    public function privateGetBalanceCoinWithdraw($params = array()) {
        return $this->request('balance/coin/withdraw', 'private', 'GET', $params);
    }
    public function privateGetBalanceInfo($params = array()) {
        return $this->request('balance/info', 'private', 'GET', $params);
    }
    public function privateGetBalanceDepositAddressCoinType($params = array()) {
        return $this->request('balance/deposit/address/{coin_type}', 'private', 'GET', $params);
    }
    public function privateGetContractTransferHistory($params = array()) {
        return $this->request('contract/transfer/history', 'private', 'GET', $params);
    }
    public function privateGetCreditInfo($params = array()) {
        return $this->request('credit/info', 'private', 'GET', $params);
    }
    public function privateGetCreditBalance($params = array()) {
        return $this->request('credit/balance', 'private', 'GET', $params);
    }
    public function privateGetInvestmentTransferHistory($params = array()) {
        return $this->request('investment/transfer/history', 'private', 'GET', $params);
    }
    public function privateGetMarginAccount($params = array()) {
        return $this->request('margin/account', 'private', 'GET', $params);
    }
    public function privateGetMarginConfig($params = array()) {
        return $this->request('margin/config', 'private', 'GET', $params);
    }
    public function privateGetMarginLoanHistory($params = array()) {
        return $this->request('margin/loan/history', 'private', 'GET', $params);
    }
    public function privateGetMarginTransferHistory($params = array()) {
        return $this->request('margin/transfer/history', 'private', 'GET', $params);
    }
    public function privateGetOrderDeals($params = array()) {
        return $this->request('order/deals', 'private', 'GET', $params);
    }
    public function privateGetOrderFinished($params = array()) {
        return $this->request('order/finished', 'private', 'GET', $params);
    }
    public function privateGetOrderPending($params = array()) {
        return $this->request('order/pending', 'private', 'GET', $params);
    }
    public function privateGetOrderStatus($params = array()) {
        return $this->request('order/status', 'private', 'GET', $params);
    }
    public function privateGetOrderStatusBatch($params = array()) {
        return $this->request('order/status/batch', 'private', 'GET', $params);
    }
    public function privateGetOrderUserDeals($params = array()) {
        return $this->request('order/user/deals', 'private', 'GET', $params);
    }
    public function privateGetOrderStopFinished($params = array()) {
        return $this->request('order/stop/finished', 'private', 'GET', $params);
    }
    public function privateGetOrderStopPending($params = array()) {
        return $this->request('order/stop/pending', 'private', 'GET', $params);
    }
    public function privateGetOrderUserTradeFee($params = array()) {
        return $this->request('order/user/trade/fee', 'private', 'GET', $params);
    }
    public function privateGetOrderMarketTradeInfo($params = array()) {
        return $this->request('order/market/trade/info', 'private', 'GET', $params);
    }
    public function privateGetSubAccountBalance($params = array()) {
        return $this->request('sub_account/balance', 'private', 'GET', $params);
    }
    public function privateGetSubAccountTransferHistory($params = array()) {
        return $this->request('sub_account/transfer/history', 'private', 'GET', $params);
    }
    public function privateGetSubAccountAuthApiUserAuthId($params = array()) {
        return $this->request('sub_account/auth/api/{user_auth_id}', 'private', 'GET', $params);
    }
    public function privatePostBalanceCoinWithdraw($params = array()) {
        return $this->request('balance/coin/withdraw', 'private', 'POST', $params);
    }
    public function privatePostContractBalanceTransfer($params = array()) {
        return $this->request('contract/balance/transfer', 'private', 'POST', $params);
    }
    public function privatePostMarginFlat($params = array()) {
        return $this->request('margin/flat', 'private', 'POST', $params);
    }
    public function privatePostMarginLoan($params = array()) {
        return $this->request('margin/loan', 'private', 'POST', $params);
    }
    public function privatePostMarginTransfer($params = array()) {
        return $this->request('margin/transfer', 'private', 'POST', $params);
    }
    public function privatePostOrderLimitBatch($params = array()) {
        return $this->request('order/limit/batch', 'private', 'POST', $params);
    }
    public function privatePostOrderIoc($params = array()) {
        return $this->request('order/ioc', 'private', 'POST', $params);
    }
    public function privatePostOrderLimit($params = array()) {
        return $this->request('order/limit', 'private', 'POST', $params);
    }
    public function privatePostOrderMarket($params = array()) {
        return $this->request('order/market', 'private', 'POST', $params);
    }
    public function privatePostOrderModify($params = array()) {
        return $this->request('order/modify', 'private', 'POST', $params);
    }
    public function privatePostOrderStopLimit($params = array()) {
        return $this->request('order/stop/limit', 'private', 'POST', $params);
    }
    public function privatePostOrderStopMarket($params = array()) {
        return $this->request('order/stop/market', 'private', 'POST', $params);
    }
    public function privatePostOrderStopModify($params = array()) {
        return $this->request('order/stop/modify', 'private', 'POST', $params);
    }
    public function privatePostSubAccountTransfer($params = array()) {
        return $this->request('sub_account/transfer', 'private', 'POST', $params);
    }
    public function privatePostSubAccountRegister($params = array()) {
        return $this->request('sub_account/register', 'private', 'POST', $params);
    }
    public function privatePostSubAccountUnfrozen($params = array()) {
        return $this->request('sub_account/unfrozen', 'private', 'POST', $params);
    }
    public function privatePostSubAccountFrozen($params = array()) {
        return $this->request('sub_account/frozen', 'private', 'POST', $params);
    }
    public function privatePostSubAccountAuthApi($params = array()) {
        return $this->request('sub_account/auth/api', 'private', 'POST', $params);
    }
    public function privatePutBalanceDepositAddressCoinType($params = array()) {
        return $this->request('balance/deposit/address/{coin_type}', 'private', 'PUT', $params);
    }
    public function privatePutSubAccountAuthApiUserAuthId($params = array()) {
        return $this->request('sub_account/auth/api/{user_auth_id}', 'private', 'PUT', $params);
    }
    public function privatePutV1AccountSettings($params = array()) {
        return $this->request('v1/account/settings', 'private', 'PUT', $params);
    }
    public function privateDeleteBalanceCoinWithdraw($params = array()) {
        return $this->request('balance/coin/withdraw', 'private', 'DELETE', $params);
    }
    public function privateDeleteOrderPendingBatch($params = array()) {
        return $this->request('order/pending/batch', 'private', 'DELETE', $params);
    }
    public function privateDeleteOrderPending($params = array()) {
        return $this->request('order/pending', 'private', 'DELETE', $params);
    }
    public function privateDeleteOrderStopPending($params = array()) {
        return $this->request('order/stop/pending', 'private', 'DELETE', $params);
    }
    public function privateDeleteOrderStopPendingId($params = array()) {
        return $this->request('order/stop/pending/{id}', 'private', 'DELETE', $params);
    }
    public function privateDeleteSubAccountAuthApiUserAuthId($params = array()) {
        return $this->request('sub_account/auth/api/{user_auth_id}', 'private', 'DELETE', $params);
    }
    public function perpetualPublicGetPing($params = array()) {
        return $this->request('ping', 'perpetualPublic', 'GET', $params);
    }
    public function perpetualPublicGetTime($params = array()) {
        return $this->request('time', 'perpetualPublic', 'GET', $params);
    }
    public function perpetualPublicGetMarketList($params = array()) {
        return $this->request('market/list', 'perpetualPublic', 'GET', $params);
    }
    public function perpetualPublicGetMarketLimitConfig($params = array()) {
        return $this->request('market/limit_config', 'perpetualPublic', 'GET', $params);
    }
    public function perpetualPublicGetMarketTicker($params = array()) {
        return $this->request('market/ticker', 'perpetualPublic', 'GET', $params);
    }
    public function perpetualPublicGetMarketTickerAll($params = array()) {
        return $this->request('market/ticker/all', 'perpetualPublic', 'GET', $params);
    }
    public function perpetualPublicGetMarketDepth($params = array()) {
        return $this->request('market/depth', 'perpetualPublic', 'GET', $params);
    }
    public function perpetualPublicGetMarketDeals($params = array()) {
        return $this->request('market/deals', 'perpetualPublic', 'GET', $params);
    }
    public function perpetualPublicGetMarketFundingHistory($params = array()) {
        return $this->request('market/funding_history', 'perpetualPublic', 'GET', $params);
    }
    public function perpetualPublicGetMarketUserDeals($params = array()) {
        return $this->request('market/user_deals', 'perpetualPublic', 'GET', $params);
    }
    public function perpetualPublicGetMarketKline($params = array()) {
        return $this->request('market/kline', 'perpetualPublic', 'GET', $params);
    }
    public function perpetualPrivateGetAssetQuery($params = array()) {
        return $this->request('asset/query', 'perpetualPrivate', 'GET', $params);
    }
    public function perpetualPrivateGetOrderPending($params = array()) {
        return $this->request('order/pending', 'perpetualPrivate', 'GET', $params);
    }
    public function perpetualPrivateGetOrderFinished($params = array()) {
        return $this->request('order/finished', 'perpetualPrivate', 'GET', $params);
    }
    public function perpetualPrivateGetOrderStopFinished($params = array()) {
        return $this->request('order/stop_finished', 'perpetualPrivate', 'GET', $params);
    }
    public function perpetualPrivateGetOrderStopPending($params = array()) {
        return $this->request('order/stop_pending', 'perpetualPrivate', 'GET', $params);
    }
    public function perpetualPrivateGetOrderStatus($params = array()) {
        return $this->request('order/status', 'perpetualPrivate', 'GET', $params);
    }
    public function perpetualPrivateGetOrderStopStatus($params = array()) {
        return $this->request('order/stop_status', 'perpetualPrivate', 'GET', $params);
    }
    public function perpetualPrivateGetPositionPending($params = array()) {
        return $this->request('position/pending', 'perpetualPrivate', 'GET', $params);
    }
    public function perpetualPrivateGetPositionFunding($params = array()) {
        return $this->request('position/funding', 'perpetualPrivate', 'GET', $params);
    }
    public function perpetualPrivatePostMarketAdjustLeverage($params = array()) {
        return $this->request('market/adjust_leverage', 'perpetualPrivate', 'POST', $params);
    }
    public function perpetualPrivatePostMarketPositionExpect($params = array()) {
        return $this->request('market/position_expect', 'perpetualPrivate', 'POST', $params);
    }
    public function perpetualPrivatePostOrderPutLimit($params = array()) {
        return $this->request('order/put_limit', 'perpetualPrivate', 'POST', $params);
    }
    public function perpetualPrivatePostOrderPutMarket($params = array()) {
        return $this->request('order/put_market', 'perpetualPrivate', 'POST', $params);
    }
    public function perpetualPrivatePostOrderPutStopLimit($params = array()) {
        return $this->request('order/put_stop_limit', 'perpetualPrivate', 'POST', $params);
    }
    public function perpetualPrivatePostOrderPutStopMarket($params = array()) {
        return $this->request('order/put_stop_market', 'perpetualPrivate', 'POST', $params);
    }
    public function perpetualPrivatePostOrderModify($params = array()) {
        return $this->request('order/modify', 'perpetualPrivate', 'POST', $params);
    }
    public function perpetualPrivatePostOrderModifyStop($params = array()) {
        return $this->request('order/modify_stop', 'perpetualPrivate', 'POST', $params);
    }
    public function perpetualPrivatePostOrderCancel($params = array()) {
        return $this->request('order/cancel', 'perpetualPrivate', 'POST', $params);
    }
    public function perpetualPrivatePostOrderCancelAll($params = array()) {
        return $this->request('order/cancel_all', 'perpetualPrivate', 'POST', $params);
    }
    public function perpetualPrivatePostOrderCancelBatch($params = array()) {
        return $this->request('order/cancel_batch', 'perpetualPrivate', 'POST', $params);
    }
    public function perpetualPrivatePostOrderCancelStop($params = array()) {
        return $this->request('order/cancel_stop', 'perpetualPrivate', 'POST', $params);
    }
    public function perpetualPrivatePostOrderCancelStopAll($params = array()) {
        return $this->request('order/cancel_stop_all', 'perpetualPrivate', 'POST', $params);
    }
    public function perpetualPrivatePostOrderCloseLimit($params = array()) {
        return $this->request('order/close_limit', 'perpetualPrivate', 'POST', $params);
    }
    public function perpetualPrivatePostOrderCloseMarket($params = array()) {
        return $this->request('order/close_market', 'perpetualPrivate', 'POST', $params);
    }
    public function perpetualPrivatePostPositionAdjustMargin($params = array()) {
        return $this->request('position/adjust_margin', 'perpetualPrivate', 'POST', $params);
    }
    public function perpetualPrivatePostPositionStopLoss($params = array()) {
        return $this->request('position/stop_loss', 'perpetualPrivate', 'POST', $params);
    }
    public function perpetualPrivatePostPositionTakeProfit($params = array()) {
        return $this->request('position/take_profit', 'perpetualPrivate', 'POST', $params);
    }
    public function perpetualPrivatePostPositionMarketClose($params = array()) {
        return $this->request('position/market_close', 'perpetualPrivate', 'POST', $params);
    }
}