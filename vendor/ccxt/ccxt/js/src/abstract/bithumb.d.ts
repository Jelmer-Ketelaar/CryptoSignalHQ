import { implicitReturnType } from '../base/types.js';
import { Exchange as _Exchange } from '../base/Exchange.js';
interface Exchange {
    publicGetTickerCurrency(params?: {}): Promise<implicitReturnType>;
    publicGetTickerAll(params?: {}): Promise<implicitReturnType>;
    publicGetTickerALLBTC(params?: {}): Promise<implicitReturnType>;
    publicGetTickerALLKRW(params?: {}): Promise<implicitReturnType>;
    publicGetOrderbookCurrency(params?: {}): Promise<implicitReturnType>;
    publicGetOrderbookAll(params?: {}): Promise<implicitReturnType>;
    publicGetTransactionHistoryCurrency(params?: {}): Promise<implicitReturnType>;
    publicGetTransactionHistoryAll(params?: {}): Promise<implicitReturnType>;
    publicGetCandlestickCurrencyInterval(params?: {}): Promise<implicitReturnType>;
    privatePostInfoAccount(params?: {}): Promise<implicitReturnType>;
    privatePostInfoBalance(params?: {}): Promise<implicitReturnType>;
    privatePostInfoWalletAddress(params?: {}): Promise<implicitReturnType>;
    privatePostInfoTicker(params?: {}): Promise<implicitReturnType>;
    privatePostInfoOrders(params?: {}): Promise<implicitReturnType>;
    privatePostInfoUserTransactions(params?: {}): Promise<implicitReturnType>;
    privatePostInfoOrderDetail(params?: {}): Promise<implicitReturnType>;
    privatePostTradePlace(params?: {}): Promise<implicitReturnType>;
    privatePostTradeCancel(params?: {}): Promise<implicitReturnType>;
    privatePostTradeBtcWithdrawal(params?: {}): Promise<implicitReturnType>;
    privatePostTradeKrwDeposit(params?: {}): Promise<implicitReturnType>;
    privatePostTradeKrwWithdrawal(params?: {}): Promise<implicitReturnType>;
    privatePostTradeMarketBuy(params?: {}): Promise<implicitReturnType>;
    privatePostTradeMarketSell(params?: {}): Promise<implicitReturnType>;
}
declare abstract class Exchange extends _Exchange {
}
export default Exchange;
