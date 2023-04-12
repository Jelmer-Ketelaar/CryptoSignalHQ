<?php

namespace ccxt\async\abstract;

// PLEASE DO NOT EDIT THIS FILE, IT IS GENERATED AND WILL BE OVERWRITTEN:
// https://github.com/ccxt/ccxt/blob/master/CONTRIBUTING.md#how-to-contribute-code


use ccxt\async\Exchange;

abstract class independentreserve extends Exchange {
    public function public_get_getvalidprimarycurrencycodes($params = array()) {
        return $this->request('GetValidPrimaryCurrencyCodes', 'public', 'GET', $params);
    }
    public function public_get_getvalidsecondarycurrencycodes($params = array()) {
        return $this->request('GetValidSecondaryCurrencyCodes', 'public', 'GET', $params);
    }
    public function public_get_getvalidlimitordertypes($params = array()) {
        return $this->request('GetValidLimitOrderTypes', 'public', 'GET', $params);
    }
    public function public_get_getvalidmarketordertypes($params = array()) {
        return $this->request('GetValidMarketOrderTypes', 'public', 'GET', $params);
    }
    public function public_get_getvalidordertypes($params = array()) {
        return $this->request('GetValidOrderTypes', 'public', 'GET', $params);
    }
    public function public_get_getvalidtransactiontypes($params = array()) {
        return $this->request('GetValidTransactionTypes', 'public', 'GET', $params);
    }
    public function public_get_getmarketsummary($params = array()) {
        return $this->request('GetMarketSummary', 'public', 'GET', $params);
    }
    public function public_get_getorderbook($params = array()) {
        return $this->request('GetOrderBook', 'public', 'GET', $params);
    }
    public function public_get_getallorders($params = array()) {
        return $this->request('GetAllOrders', 'public', 'GET', $params);
    }
    public function public_get_gettradehistorysummary($params = array()) {
        return $this->request('GetTradeHistorySummary', 'public', 'GET', $params);
    }
    public function public_get_getrecenttrades($params = array()) {
        return $this->request('GetRecentTrades', 'public', 'GET', $params);
    }
    public function public_get_getfxrates($params = array()) {
        return $this->request('GetFxRates', 'public', 'GET', $params);
    }
    public function public_get_getorderminimumvolumes($params = array()) {
        return $this->request('GetOrderMinimumVolumes', 'public', 'GET', $params);
    }
    public function public_get_getcryptowithdrawalfees($params = array()) {
        return $this->request('GetCryptoWithdrawalFees', 'public', 'GET', $params);
    }
    public function private_post_getopenorders($params = array()) {
        return $this->request('GetOpenOrders', 'private', 'POST', $params);
    }
    public function private_post_getclosedorders($params = array()) {
        return $this->request('GetClosedOrders', 'private', 'POST', $params);
    }
    public function private_post_getclosedfilledorders($params = array()) {
        return $this->request('GetClosedFilledOrders', 'private', 'POST', $params);
    }
    public function private_post_getorderdetails($params = array()) {
        return $this->request('GetOrderDetails', 'private', 'POST', $params);
    }
    public function private_post_getaccounts($params = array()) {
        return $this->request('GetAccounts', 'private', 'POST', $params);
    }
    public function private_post_gettransactions($params = array()) {
        return $this->request('GetTransactions', 'private', 'POST', $params);
    }
    public function private_post_getfiatbankaccounts($params = array()) {
        return $this->request('GetFiatBankAccounts', 'private', 'POST', $params);
    }
    public function private_post_getdigitalcurrencydepositaddress($params = array()) {
        return $this->request('GetDigitalCurrencyDepositAddress', 'private', 'POST', $params);
    }
    public function private_post_getdigitalcurrencydepositaddresses($params = array()) {
        return $this->request('GetDigitalCurrencyDepositAddresses', 'private', 'POST', $params);
    }
    public function private_post_gettrades($params = array()) {
        return $this->request('GetTrades', 'private', 'POST', $params);
    }
    public function private_post_getbrokeragefees($params = array()) {
        return $this->request('GetBrokerageFees', 'private', 'POST', $params);
    }
    public function private_post_getdigitalcurrencywithdrawal($params = array()) {
        return $this->request('GetDigitalCurrencyWithdrawal', 'private', 'POST', $params);
    }
    public function private_post_placelimitorder($params = array()) {
        return $this->request('PlaceLimitOrder', 'private', 'POST', $params);
    }
    public function private_post_placemarketorder($params = array()) {
        return $this->request('PlaceMarketOrder', 'private', 'POST', $params);
    }
    public function private_post_cancelorder($params = array()) {
        return $this->request('CancelOrder', 'private', 'POST', $params);
    }
    public function private_post_synchdigitalcurrencydepositaddresswithblockchain($params = array()) {
        return $this->request('SynchDigitalCurrencyDepositAddressWithBlockchain', 'private', 'POST', $params);
    }
    public function private_post_requestfiatwithdrawal($params = array()) {
        return $this->request('RequestFiatWithdrawal', 'private', 'POST', $params);
    }
    public function private_post_withdrawfiatcurrency($params = array()) {
        return $this->request('WithdrawFiatCurrency', 'private', 'POST', $params);
    }
    public function private_post_withdrawdigitalcurrency($params = array()) {
        return $this->request('WithdrawDigitalCurrency', 'private', 'POST', $params);
    }
    public function publicGetGetValidPrimaryCurrencyCodes($params = array()) {
        return $this->request('GetValidPrimaryCurrencyCodes', 'public', 'GET', $params);
    }
    public function publicGetGetValidSecondaryCurrencyCodes($params = array()) {
        return $this->request('GetValidSecondaryCurrencyCodes', 'public', 'GET', $params);
    }
    public function publicGetGetValidLimitOrderTypes($params = array()) {
        return $this->request('GetValidLimitOrderTypes', 'public', 'GET', $params);
    }
    public function publicGetGetValidMarketOrderTypes($params = array()) {
        return $this->request('GetValidMarketOrderTypes', 'public', 'GET', $params);
    }
    public function publicGetGetValidOrderTypes($params = array()) {
        return $this->request('GetValidOrderTypes', 'public', 'GET', $params);
    }
    public function publicGetGetValidTransactionTypes($params = array()) {
        return $this->request('GetValidTransactionTypes', 'public', 'GET', $params);
    }
    public function publicGetGetMarketSummary($params = array()) {
        return $this->request('GetMarketSummary', 'public', 'GET', $params);
    }
    public function publicGetGetOrderBook($params = array()) {
        return $this->request('GetOrderBook', 'public', 'GET', $params);
    }
    public function publicGetGetAllOrders($params = array()) {
        return $this->request('GetAllOrders', 'public', 'GET', $params);
    }
    public function publicGetGetTradeHistorySummary($params = array()) {
        return $this->request('GetTradeHistorySummary', 'public', 'GET', $params);
    }
    public function publicGetGetRecentTrades($params = array()) {
        return $this->request('GetRecentTrades', 'public', 'GET', $params);
    }
    public function publicGetGetFxRates($params = array()) {
        return $this->request('GetFxRates', 'public', 'GET', $params);
    }
    public function publicGetGetOrderMinimumVolumes($params = array()) {
        return $this->request('GetOrderMinimumVolumes', 'public', 'GET', $params);
    }
    public function publicGetGetCryptoWithdrawalFees($params = array()) {
        return $this->request('GetCryptoWithdrawalFees', 'public', 'GET', $params);
    }
    public function privatePostGetOpenOrders($params = array()) {
        return $this->request('GetOpenOrders', 'private', 'POST', $params);
    }
    public function privatePostGetClosedOrders($params = array()) {
        return $this->request('GetClosedOrders', 'private', 'POST', $params);
    }
    public function privatePostGetClosedFilledOrders($params = array()) {
        return $this->request('GetClosedFilledOrders', 'private', 'POST', $params);
    }
    public function privatePostGetOrderDetails($params = array()) {
        return $this->request('GetOrderDetails', 'private', 'POST', $params);
    }
    public function privatePostGetAccounts($params = array()) {
        return $this->request('GetAccounts', 'private', 'POST', $params);
    }
    public function privatePostGetTransactions($params = array()) {
        return $this->request('GetTransactions', 'private', 'POST', $params);
    }
    public function privatePostGetFiatBankAccounts($params = array()) {
        return $this->request('GetFiatBankAccounts', 'private', 'POST', $params);
    }
    public function privatePostGetDigitalCurrencyDepositAddress($params = array()) {
        return $this->request('GetDigitalCurrencyDepositAddress', 'private', 'POST', $params);
    }
    public function privatePostGetDigitalCurrencyDepositAddresses($params = array()) {
        return $this->request('GetDigitalCurrencyDepositAddresses', 'private', 'POST', $params);
    }
    public function privatePostGetTrades($params = array()) {
        return $this->request('GetTrades', 'private', 'POST', $params);
    }
    public function privatePostGetBrokerageFees($params = array()) {
        return $this->request('GetBrokerageFees', 'private', 'POST', $params);
    }
    public function privatePostGetDigitalCurrencyWithdrawal($params = array()) {
        return $this->request('GetDigitalCurrencyWithdrawal', 'private', 'POST', $params);
    }
    public function privatePostPlaceLimitOrder($params = array()) {
        return $this->request('PlaceLimitOrder', 'private', 'POST', $params);
    }
    public function privatePostPlaceMarketOrder($params = array()) {
        return $this->request('PlaceMarketOrder', 'private', 'POST', $params);
    }
    public function privatePostCancelOrder($params = array()) {
        return $this->request('CancelOrder', 'private', 'POST', $params);
    }
    public function privatePostSynchDigitalCurrencyDepositAddressWithBlockchain($params = array()) {
        return $this->request('SynchDigitalCurrencyDepositAddressWithBlockchain', 'private', 'POST', $params);
    }
    public function privatePostRequestFiatWithdrawal($params = array()) {
        return $this->request('RequestFiatWithdrawal', 'private', 'POST', $params);
    }
    public function privatePostWithdrawFiatCurrency($params = array()) {
        return $this->request('WithdrawFiatCurrency', 'private', 'POST', $params);
    }
    public function privatePostWithdrawDigitalCurrency($params = array()) {
        return $this->request('WithdrawDigitalCurrency', 'private', 'POST', $params);
    }
}