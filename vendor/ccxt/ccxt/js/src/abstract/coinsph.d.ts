import { implicitReturnType } from '../base/types.js';
import { Exchange as _Exchange } from '../base/Exchange.js';
interface Exchange {
    publicGetOpenapiV1Ping(params?: {}): Promise<implicitReturnType>;
    publicGetOpenapiV1Time(params?: {}): Promise<implicitReturnType>;
    publicGetOpenapiQuoteV1Ticker24hr(params?: {}): Promise<implicitReturnType>;
    publicGetOpenapiQuoteV1TickerPrice(params?: {}): Promise<implicitReturnType>;
    publicGetOpenapiQuoteV1TickerBookTicker(params?: {}): Promise<implicitReturnType>;
    publicGetOpenapiV1ExchangeInfo(params?: {}): Promise<implicitReturnType>;
    publicGetOpenapiQuoteV1Depth(params?: {}): Promise<implicitReturnType>;
    publicGetOpenapiQuoteV1Klines(params?: {}): Promise<implicitReturnType>;
    publicGetOpenapiQuoteV1Trades(params?: {}): Promise<implicitReturnType>;
    publicGetOpenapiV1Pairs(params?: {}): Promise<implicitReturnType>;
    publicGetOpenapiQuoteV1AvgPrice(params?: {}): Promise<implicitReturnType>;
    privateGetOpenapiV1Account(params?: {}): Promise<implicitReturnType>;
    privateGetOpenapiV1OpenOrders(params?: {}): Promise<implicitReturnType>;
    privateGetOpenapiV1AssetTradeFee(params?: {}): Promise<implicitReturnType>;
    privateGetOpenapiV1Order(params?: {}): Promise<implicitReturnType>;
    privateGetOpenapiV1HistoryOrders(params?: {}): Promise<implicitReturnType>;
    privateGetOpenapiV1MyTrades(params?: {}): Promise<implicitReturnType>;
    privateGetOpenapiV1CapitalDepositHistory(params?: {}): Promise<implicitReturnType>;
    privateGetOpenapiV1CapitalWithdrawHistory(params?: {}): Promise<implicitReturnType>;
    privatePostOpenapiV1OrderTest(params?: {}): Promise<implicitReturnType>;
    privatePostOpenapiV1Order(params?: {}): Promise<implicitReturnType>;
    privatePostOpenapiV1CapitalWithdrawApply(params?: {}): Promise<implicitReturnType>;
    privatePostOpenapiV1CapitalDepositApply(params?: {}): Promise<implicitReturnType>;
    privateDeleteOpenapiV1Order(params?: {}): Promise<implicitReturnType>;
    privateDeleteOpenapiV1OpenOrders(params?: {}): Promise<implicitReturnType>;
}
declare abstract class Exchange extends _Exchange {
}
export default Exchange;
