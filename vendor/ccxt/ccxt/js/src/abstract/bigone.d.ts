import { implicitReturnType } from '../base/types.js';
import { Exchange as _Exchange } from '../base/Exchange.js';
interface Exchange {
    publicGetPing(params?: {}): Promise<implicitReturnType>;
    publicGetAssetPairs(params?: {}): Promise<implicitReturnType>;
    publicGetAssetPairsAssetPairNameDepth(params?: {}): Promise<implicitReturnType>;
    publicGetAssetPairsAssetPairNameTrades(params?: {}): Promise<implicitReturnType>;
    publicGetAssetPairsAssetPairNameTicker(params?: {}): Promise<implicitReturnType>;
    publicGetAssetPairsAssetPairNameCandles(params?: {}): Promise<implicitReturnType>;
    publicGetAssetPairsTickers(params?: {}): Promise<implicitReturnType>;
    privateGetAccounts(params?: {}): Promise<implicitReturnType>;
    privateGetFundAccounts(params?: {}): Promise<implicitReturnType>;
    privateGetAssetsAssetSymbolAddress(params?: {}): Promise<implicitReturnType>;
    privateGetOrders(params?: {}): Promise<implicitReturnType>;
    privateGetOrdersId(params?: {}): Promise<implicitReturnType>;
    privateGetOrdersMulti(params?: {}): Promise<implicitReturnType>;
    privateGetTrades(params?: {}): Promise<implicitReturnType>;
    privateGetWithdrawals(params?: {}): Promise<implicitReturnType>;
    privateGetDeposits(params?: {}): Promise<implicitReturnType>;
    privatePostOrders(params?: {}): Promise<implicitReturnType>;
    privatePostOrdersIdCancel(params?: {}): Promise<implicitReturnType>;
    privatePostOrdersCancel(params?: {}): Promise<implicitReturnType>;
    privatePostWithdrawals(params?: {}): Promise<implicitReturnType>;
    privatePostTransfer(params?: {}): Promise<implicitReturnType>;
}
declare abstract class Exchange extends _Exchange {
}
export default Exchange;
