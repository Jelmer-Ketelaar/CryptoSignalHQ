<?php

namespace ccxt\abstract;

// PLEASE DO NOT EDIT THIS FILE, IT IS GENERATED AND WILL BE OVERWRITTEN:
// https://github.com/ccxt/ccxt/blob/master/CONTRIBUTING.md#how-to-contribute-code


use ccxt\Exchange;

abstract class kraken extends Exchange {
    public function zendesk_get_360000292886($params = array()) {
        return $this->request('360000292886', 'zendesk', 'GET', $params);
    }
    public function zendesk_get_201893608($params = array()) {
        return $this->request('201893608', 'zendesk', 'GET', $params);
    }
    public function public_get_assets($params = array()) {
        return $this->request('Assets', 'public', 'GET', $params);
    }
    public function public_get_assetpairs($params = array()) {
        return $this->request('AssetPairs', 'public', 'GET', $params);
    }
    public function public_get_depth($params = array()) {
        return $this->request('Depth', 'public', 'GET', $params);
    }
    public function public_get_ohlc($params = array()) {
        return $this->request('OHLC', 'public', 'GET', $params);
    }
    public function public_get_spread($params = array()) {
        return $this->request('Spread', 'public', 'GET', $params);
    }
    public function public_get_ticker($params = array()) {
        return $this->request('Ticker', 'public', 'GET', $params);
    }
    public function public_get_time($params = array()) {
        return $this->request('Time', 'public', 'GET', $params);
    }
    public function public_get_trades($params = array()) {
        return $this->request('Trades', 'public', 'GET', $params);
    }
    public function private_post_addorder($params = array()) {
        return $this->request('AddOrder', 'private', 'POST', $params);
    }
    public function private_post_addorderbatch($params = array()) {
        return $this->request('AddOrderBatch', 'private', 'POST', $params);
    }
    public function private_post_addexport($params = array()) {
        return $this->request('AddExport', 'private', 'POST', $params);
    }
    public function private_post_balance($params = array()) {
        return $this->request('Balance', 'private', 'POST', $params);
    }
    public function private_post_cancelall($params = array()) {
        return $this->request('CancelAll', 'private', 'POST', $params);
    }
    public function private_post_cancelorder($params = array()) {
        return $this->request('CancelOrder', 'private', 'POST', $params);
    }
    public function private_post_cancelorderbatch($params = array()) {
        return $this->request('CancelOrderBatch', 'private', 'POST', $params);
    }
    public function private_post_closedorders($params = array()) {
        return $this->request('ClosedOrders', 'private', 'POST', $params);
    }
    public function private_post_depositaddresses($params = array()) {
        return $this->request('DepositAddresses', 'private', 'POST', $params);
    }
    public function private_post_depositmethods($params = array()) {
        return $this->request('DepositMethods', 'private', 'POST', $params);
    }
    public function private_post_depositstatus($params = array()) {
        return $this->request('DepositStatus', 'private', 'POST', $params);
    }
    public function private_post_editorder($params = array()) {
        return $this->request('EditOrder', 'private', 'POST', $params);
    }
    public function private_post_exportstatus($params = array()) {
        return $this->request('ExportStatus', 'private', 'POST', $params);
    }
    public function private_post_getwebsocketstoken($params = array()) {
        return $this->request('GetWebSocketsToken', 'private', 'POST', $params);
    }
    public function private_post_ledgers($params = array()) {
        return $this->request('Ledgers', 'private', 'POST', $params);
    }
    public function private_post_openorders($params = array()) {
        return $this->request('OpenOrders', 'private', 'POST', $params);
    }
    public function private_post_openpositions($params = array()) {
        return $this->request('OpenPositions', 'private', 'POST', $params);
    }
    public function private_post_queryledgers($params = array()) {
        return $this->request('QueryLedgers', 'private', 'POST', $params);
    }
    public function private_post_queryorders($params = array()) {
        return $this->request('QueryOrders', 'private', 'POST', $params);
    }
    public function private_post_querytrades($params = array()) {
        return $this->request('QueryTrades', 'private', 'POST', $params);
    }
    public function private_post_retrieveexport($params = array()) {
        return $this->request('RetrieveExport', 'private', 'POST', $params);
    }
    public function private_post_removeexport($params = array()) {
        return $this->request('RemoveExport', 'private', 'POST', $params);
    }
    public function private_post_tradebalance($params = array()) {
        return $this->request('TradeBalance', 'private', 'POST', $params);
    }
    public function private_post_tradeshistory($params = array()) {
        return $this->request('TradesHistory', 'private', 'POST', $params);
    }
    public function private_post_tradevolume($params = array()) {
        return $this->request('TradeVolume', 'private', 'POST', $params);
    }
    public function private_post_withdraw($params = array()) {
        return $this->request('Withdraw', 'private', 'POST', $params);
    }
    public function private_post_withdrawcancel($params = array()) {
        return $this->request('WithdrawCancel', 'private', 'POST', $params);
    }
    public function private_post_withdrawinfo($params = array()) {
        return $this->request('WithdrawInfo', 'private', 'POST', $params);
    }
    public function private_post_withdrawstatus($params = array()) {
        return $this->request('WithdrawStatus', 'private', 'POST', $params);
    }
    public function private_post_stake($params = array()) {
        return $this->request('Stake', 'private', 'POST', $params);
    }
    public function private_post_unstake($params = array()) {
        return $this->request('Unstake', 'private', 'POST', $params);
    }
    public function private_post_staking_assets($params = array()) {
        return $this->request('Staking/Assets', 'private', 'POST', $params);
    }
    public function private_post_staking_pending($params = array()) {
        return $this->request('Staking/Pending', 'private', 'POST', $params);
    }
    public function private_post_staking_transactions($params = array()) {
        return $this->request('Staking/Transactions', 'private', 'POST', $params);
    }
    public function private_post_createsubaccount($params = array()) {
        return $this->request('CreateSubaccount', 'private', 'POST', $params);
    }
    public function private_post_accounttransfer($params = array()) {
        return $this->request('AccountTransfer', 'private', 'POST', $params);
    }
    public function zendeskGet360000292886($params = array()) {
        return $this->request('360000292886', 'zendesk', 'GET', $params);
    }
    public function zendeskGet201893608($params = array()) {
        return $this->request('201893608', 'zendesk', 'GET', $params);
    }
    public function publicGetAssets($params = array()) {
        return $this->request('Assets', 'public', 'GET', $params);
    }
    public function publicGetAssetPairs($params = array()) {
        return $this->request('AssetPairs', 'public', 'GET', $params);
    }
    public function publicGetDepth($params = array()) {
        return $this->request('Depth', 'public', 'GET', $params);
    }
    public function publicGetOHLC($params = array()) {
        return $this->request('OHLC', 'public', 'GET', $params);
    }
    public function publicGetSpread($params = array()) {
        return $this->request('Spread', 'public', 'GET', $params);
    }
    public function publicGetTicker($params = array()) {
        return $this->request('Ticker', 'public', 'GET', $params);
    }
    public function publicGetTime($params = array()) {
        return $this->request('Time', 'public', 'GET', $params);
    }
    public function publicGetTrades($params = array()) {
        return $this->request('Trades', 'public', 'GET', $params);
    }
    public function privatePostAddOrder($params = array()) {
        return $this->request('AddOrder', 'private', 'POST', $params);
    }
    public function privatePostAddOrderBatch($params = array()) {
        return $this->request('AddOrderBatch', 'private', 'POST', $params);
    }
    public function privatePostAddExport($params = array()) {
        return $this->request('AddExport', 'private', 'POST', $params);
    }
    public function privatePostBalance($params = array()) {
        return $this->request('Balance', 'private', 'POST', $params);
    }
    public function privatePostCancelAll($params = array()) {
        return $this->request('CancelAll', 'private', 'POST', $params);
    }
    public function privatePostCancelOrder($params = array()) {
        return $this->request('CancelOrder', 'private', 'POST', $params);
    }
    public function privatePostCancelOrderBatch($params = array()) {
        return $this->request('CancelOrderBatch', 'private', 'POST', $params);
    }
    public function privatePostClosedOrders($params = array()) {
        return $this->request('ClosedOrders', 'private', 'POST', $params);
    }
    public function privatePostDepositAddresses($params = array()) {
        return $this->request('DepositAddresses', 'private', 'POST', $params);
    }
    public function privatePostDepositMethods($params = array()) {
        return $this->request('DepositMethods', 'private', 'POST', $params);
    }
    public function privatePostDepositStatus($params = array()) {
        return $this->request('DepositStatus', 'private', 'POST', $params);
    }
    public function privatePostEditOrder($params = array()) {
        return $this->request('EditOrder', 'private', 'POST', $params);
    }
    public function privatePostExportStatus($params = array()) {
        return $this->request('ExportStatus', 'private', 'POST', $params);
    }
    public function privatePostGetWebSocketsToken($params = array()) {
        return $this->request('GetWebSocketsToken', 'private', 'POST', $params);
    }
    public function privatePostLedgers($params = array()) {
        return $this->request('Ledgers', 'private', 'POST', $params);
    }
    public function privatePostOpenOrders($params = array()) {
        return $this->request('OpenOrders', 'private', 'POST', $params);
    }
    public function privatePostOpenPositions($params = array()) {
        return $this->request('OpenPositions', 'private', 'POST', $params);
    }
    public function privatePostQueryLedgers($params = array()) {
        return $this->request('QueryLedgers', 'private', 'POST', $params);
    }
    public function privatePostQueryOrders($params = array()) {
        return $this->request('QueryOrders', 'private', 'POST', $params);
    }
    public function privatePostQueryTrades($params = array()) {
        return $this->request('QueryTrades', 'private', 'POST', $params);
    }
    public function privatePostRetrieveExport($params = array()) {
        return $this->request('RetrieveExport', 'private', 'POST', $params);
    }
    public function privatePostRemoveExport($params = array()) {
        return $this->request('RemoveExport', 'private', 'POST', $params);
    }
    public function privatePostTradeBalance($params = array()) {
        return $this->request('TradeBalance', 'private', 'POST', $params);
    }
    public function privatePostTradesHistory($params = array()) {
        return $this->request('TradesHistory', 'private', 'POST', $params);
    }
    public function privatePostTradeVolume($params = array()) {
        return $this->request('TradeVolume', 'private', 'POST', $params);
    }
    public function privatePostWithdraw($params = array()) {
        return $this->request('Withdraw', 'private', 'POST', $params);
    }
    public function privatePostWithdrawCancel($params = array()) {
        return $this->request('WithdrawCancel', 'private', 'POST', $params);
    }
    public function privatePostWithdrawInfo($params = array()) {
        return $this->request('WithdrawInfo', 'private', 'POST', $params);
    }
    public function privatePostWithdrawStatus($params = array()) {
        return $this->request('WithdrawStatus', 'private', 'POST', $params);
    }
    public function privatePostStake($params = array()) {
        return $this->request('Stake', 'private', 'POST', $params);
    }
    public function privatePostUnstake($params = array()) {
        return $this->request('Unstake', 'private', 'POST', $params);
    }
    public function privatePostStakingAssets($params = array()) {
        return $this->request('Staking/Assets', 'private', 'POST', $params);
    }
    public function privatePostStakingPending($params = array()) {
        return $this->request('Staking/Pending', 'private', 'POST', $params);
    }
    public function privatePostStakingTransactions($params = array()) {
        return $this->request('Staking/Transactions', 'private', 'POST', $params);
    }
    public function privatePostCreateSubaccount($params = array()) {
        return $this->request('CreateSubaccount', 'private', 'POST', $params);
    }
    public function privatePostAccountTransfer($params = array()) {
        return $this->request('AccountTransfer', 'private', 'POST', $params);
    }
}