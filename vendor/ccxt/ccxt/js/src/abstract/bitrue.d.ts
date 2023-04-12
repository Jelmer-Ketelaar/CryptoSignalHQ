import { implicitReturnType } from '../base/types.js';
import { Exchange as _Exchange } from '../base/Exchange.js';
interface Exchange {
    klinePublicGetPublicJson(params?: {}): Promise<implicitReturnType>;
    klinePublicGetPublicCurrencyJson(params?: {}): Promise<implicitReturnType>;
    v1PublicGetPing(params?: {}): Promise<implicitReturnType>;
    v1PublicGetTime(params?: {}): Promise<implicitReturnType>;
    v1PublicGetExchangeInfo(params?: {}): Promise<implicitReturnType>;
    v1PublicGetDepth(params?: {}): Promise<implicitReturnType>;
    v1PublicGetTrades(params?: {}): Promise<implicitReturnType>;
    v1PublicGetHistoricalTrades(params?: {}): Promise<implicitReturnType>;
    v1PublicGetAggTrades(params?: {}): Promise<implicitReturnType>;
    v1PublicGetTicker24hr(params?: {}): Promise<implicitReturnType>;
    v1PublicGetTickerPrice(params?: {}): Promise<implicitReturnType>;
    v1PublicGetTickerBookTicker(params?: {}): Promise<implicitReturnType>;
    v1PublicGetMarketKline(params?: {}): Promise<implicitReturnType>;
    v1PrivateGetOrder(params?: {}): Promise<implicitReturnType>;
    v1PrivateGetOpenOrders(params?: {}): Promise<implicitReturnType>;
    v1PrivateGetAllOrders(params?: {}): Promise<implicitReturnType>;
    v1PrivateGetAccount(params?: {}): Promise<implicitReturnType>;
    v1PrivateGetMyTrades(params?: {}): Promise<implicitReturnType>;
    v1PrivateGetEtfNetValueSymbol(params?: {}): Promise<implicitReturnType>;
    v1PrivateGetWithdrawHistory(params?: {}): Promise<implicitReturnType>;
    v1PrivateGetDepositHistory(params?: {}): Promise<implicitReturnType>;
    v1PrivatePostOrder(params?: {}): Promise<implicitReturnType>;
    v1PrivatePostWithdrawCommit(params?: {}): Promise<implicitReturnType>;
    v1PrivateDeleteOrder(params?: {}): Promise<implicitReturnType>;
    v2PrivateGetMyTrades(params?: {}): Promise<implicitReturnType>;
    openPrivatePostPoseidonApiV1ListenKey(params?: {}): Promise<implicitReturnType>;
    openPrivatePutPoseidonApiV1ListenKeyListenKey(params?: {}): Promise<implicitReturnType>;
    openPrivateDeletePoseidonApiV1ListenKeyListenKey(params?: {}): Promise<implicitReturnType>;
}
declare abstract class Exchange extends _Exchange {
}
export default Exchange;
