import { implicitReturnType } from '../base/types.js';
import { Exchange as _Exchange } from '../base/Exchange.js';
interface Exchange {
    publicGetTicker(params?: {}): Promise<implicitReturnType>;
    publicGetTickerHour(params?: {}): Promise<implicitReturnType>;
    publicGetOrderBook(params?: {}): Promise<implicitReturnType>;
    publicGetTransactions(params?: {}): Promise<implicitReturnType>;
    publicGetEurUsd(params?: {}): Promise<implicitReturnType>;
    privatePostBalance(params?: {}): Promise<implicitReturnType>;
    privatePostUserTransactions(params?: {}): Promise<implicitReturnType>;
    privatePostOpenOrders(params?: {}): Promise<implicitReturnType>;
    privatePostOrderStatus(params?: {}): Promise<implicitReturnType>;
    privatePostCancelOrder(params?: {}): Promise<implicitReturnType>;
    privatePostCancelAllOrders(params?: {}): Promise<implicitReturnType>;
    privatePostBuy(params?: {}): Promise<implicitReturnType>;
    privatePostSell(params?: {}): Promise<implicitReturnType>;
    privatePostBitcoinDepositAddress(params?: {}): Promise<implicitReturnType>;
    privatePostUnconfirmedBtc(params?: {}): Promise<implicitReturnType>;
    privatePostRippleWithdrawal(params?: {}): Promise<implicitReturnType>;
    privatePostRippleAddress(params?: {}): Promise<implicitReturnType>;
    privatePostWithdrawalRequests(params?: {}): Promise<implicitReturnType>;
    privatePostBitcoinWithdrawal(params?: {}): Promise<implicitReturnType>;
}
declare abstract class Exchange extends _Exchange {
}
export default Exchange;
