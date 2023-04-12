import { implicitReturnType } from '../base/types.js';
import { Exchange as _Exchange } from '../base/Exchange.js';
interface Exchange {
    publicGetV2PublicOrderBookL2(params?: {}): Promise<implicitReturnType>;
    publicGetV2PublicKlineList(params?: {}): Promise<implicitReturnType>;
    publicGetV2PublicTickers(params?: {}): Promise<implicitReturnType>;
    publicGetV2PublicTradingRecords(params?: {}): Promise<implicitReturnType>;
    publicGetV2PublicSymbols(params?: {}): Promise<implicitReturnType>;
    publicGetV2PublicMarkPriceKline(params?: {}): Promise<implicitReturnType>;
    publicGetV2PublicIndexPriceKline(params?: {}): Promise<implicitReturnType>;
    publicGetV2PublicPremiumIndexKline(params?: {}): Promise<implicitReturnType>;
    publicGetV2PublicOpenInterest(params?: {}): Promise<implicitReturnType>;
    publicGetV2PublicBigDeal(params?: {}): Promise<implicitReturnType>;
    publicGetV2PublicAccountRatio(params?: {}): Promise<implicitReturnType>;
    publicGetV2PublicFundingRate(params?: {}): Promise<implicitReturnType>;
    publicGetV2PublicEliteRatio(params?: {}): Promise<implicitReturnType>;
    publicGetV2PublicFundingPrevFundingRate(params?: {}): Promise<implicitReturnType>;
    publicGetV2PublicRiskLimitList(params?: {}): Promise<implicitReturnType>;
    publicGetPublicLinearKline(params?: {}): Promise<implicitReturnType>;
    publicGetPublicLinearRecentTradingRecords(params?: {}): Promise<implicitReturnType>;
    publicGetPublicLinearRiskLimit(params?: {}): Promise<implicitReturnType>;
    publicGetPublicLinearFundingPrevFundingRate(params?: {}): Promise<implicitReturnType>;
    publicGetPublicLinearMarkPriceKline(params?: {}): Promise<implicitReturnType>;
    publicGetPublicLinearIndexPriceKline(params?: {}): Promise<implicitReturnType>;
    publicGetPublicLinearPremiumIndexKline(params?: {}): Promise<implicitReturnType>;
    publicGetSpotV1Time(params?: {}): Promise<implicitReturnType>;
    publicGetSpotV1Symbols(params?: {}): Promise<implicitReturnType>;
    publicGetSpotQuoteV1Depth(params?: {}): Promise<implicitReturnType>;
    publicGetSpotQuoteV1DepthMerged(params?: {}): Promise<implicitReturnType>;
    publicGetSpotQuoteV1Trades(params?: {}): Promise<implicitReturnType>;
    publicGetSpotQuoteV1Kline(params?: {}): Promise<implicitReturnType>;
    publicGetSpotQuoteV1Ticker24hr(params?: {}): Promise<implicitReturnType>;
    publicGetSpotQuoteV1TickerPrice(params?: {}): Promise<implicitReturnType>;
    publicGetSpotQuoteV1TickerBookTicker(params?: {}): Promise<implicitReturnType>;
    publicGetSpotV3PublicSymbols(params?: {}): Promise<implicitReturnType>;
    publicGetSpotV3PublicQuoteDepth(params?: {}): Promise<implicitReturnType>;
    publicGetSpotV3PublicQuoteDepthMerged(params?: {}): Promise<implicitReturnType>;
    publicGetSpotV3PublicQuoteTrades(params?: {}): Promise<implicitReturnType>;
    publicGetSpotV3PublicQuoteKline(params?: {}): Promise<implicitReturnType>;
    publicGetSpotV3PublicQuoteTicker24hr(params?: {}): Promise<implicitReturnType>;
    publicGetSpotV3PublicQuoteTickerPrice(params?: {}): Promise<implicitReturnType>;
    publicGetSpotV3PublicQuoteTickerBookTicker(params?: {}): Promise<implicitReturnType>;
    publicGetSpotV3PublicServerTime(params?: {}): Promise<implicitReturnType>;
    publicGetSpotV3PublicInfos(params?: {}): Promise<implicitReturnType>;
    publicGetSpotV3PublicMarginProductInfos(params?: {}): Promise<implicitReturnType>;
    publicGetSpotV3PublicMarginEnsureTokens(params?: {}): Promise<implicitReturnType>;
    publicGetV2PublicTime(params?: {}): Promise<implicitReturnType>;
    publicGetV3PublicTime(params?: {}): Promise<implicitReturnType>;
    publicGetV2PublicAnnouncement(params?: {}): Promise<implicitReturnType>;
    publicGetOptionUsdcOpenapiPublicV1OrderBook(params?: {}): Promise<implicitReturnType>;
    publicGetOptionUsdcOpenapiPublicV1Symbols(params?: {}): Promise<implicitReturnType>;
    publicGetOptionUsdcOpenapiPublicV1Tick(params?: {}): Promise<implicitReturnType>;
    publicGetOptionUsdcOpenapiPublicV1DeliveryPrice(params?: {}): Promise<implicitReturnType>;
    publicGetOptionUsdcOpenapiPublicV1QueryTradeLatest(params?: {}): Promise<implicitReturnType>;
    publicGetOptionUsdcOpenapiPublicV1QueryHistoricalVolatility(params?: {}): Promise<implicitReturnType>;
    publicGetOptionUsdcOpenapiPublicV1AllTickers(params?: {}): Promise<implicitReturnType>;
    publicGetPerpetualUsdcOpenapiPublicV1OrderBook(params?: {}): Promise<implicitReturnType>;
    publicGetPerpetualUsdcOpenapiPublicV1Symbols(params?: {}): Promise<implicitReturnType>;
    publicGetPerpetualUsdcOpenapiPublicV1Tick(params?: {}): Promise<implicitReturnType>;
    publicGetPerpetualUsdcOpenapiPublicV1KlineList(params?: {}): Promise<implicitReturnType>;
    publicGetPerpetualUsdcOpenapiPublicV1MarkPriceKline(params?: {}): Promise<implicitReturnType>;
    publicGetPerpetualUsdcOpenapiPublicV1IndexPriceKline(params?: {}): Promise<implicitReturnType>;
    publicGetPerpetualUsdcOpenapiPublicV1PremiumIndexKline(params?: {}): Promise<implicitReturnType>;
    publicGetPerpetualUsdcOpenapiPublicV1OpenInterest(params?: {}): Promise<implicitReturnType>;
    publicGetPerpetualUsdcOpenapiPublicV1BigDeal(params?: {}): Promise<implicitReturnType>;
    publicGetPerpetualUsdcOpenapiPublicV1AccountRatio(params?: {}): Promise<implicitReturnType>;
    publicGetPerpetualUsdcOpenapiPublicV1PrevFundingRate(params?: {}): Promise<implicitReturnType>;
    publicGetPerpetualUsdcOpenapiPublicV1RiskLimitList(params?: {}): Promise<implicitReturnType>;
    publicGetAssetV1PublicDepositAllowedDepositList(params?: {}): Promise<implicitReturnType>;
    publicGetContractV3PublicCopytradingSymbolList(params?: {}): Promise<implicitReturnType>;
    publicGetDerivativesV3PublicOrderBookL2(params?: {}): Promise<implicitReturnType>;
    publicGetDerivativesV3PublicKline(params?: {}): Promise<implicitReturnType>;
    publicGetDerivativesV3PublicTickers(params?: {}): Promise<implicitReturnType>;
    publicGetDerivativesV3PublicInstrumentsInfo(params?: {}): Promise<implicitReturnType>;
    publicGetDerivativesV3PublicMarkPriceKline(params?: {}): Promise<implicitReturnType>;
    publicGetDerivativesV3PublicIndexPriceKline(params?: {}): Promise<implicitReturnType>;
    publicGetDerivativesV3PublicFundingHistoryFundingRate(params?: {}): Promise<implicitReturnType>;
    publicGetDerivativesV3PublicRiskLimitList(params?: {}): Promise<implicitReturnType>;
    publicGetDerivativesV3PublicDeliveryPrice(params?: {}): Promise<implicitReturnType>;
    publicGetDerivativesV3PublicRecentTrade(params?: {}): Promise<implicitReturnType>;
    publicGetDerivativesV3PublicOpenInterest(params?: {}): Promise<implicitReturnType>;
    publicGetDerivativesV3PublicInsurance(params?: {}): Promise<implicitReturnType>;
    publicGetV5MarketKline(params?: {}): Promise<implicitReturnType>;
    publicGetV5MarketMarkPriceKline(params?: {}): Promise<implicitReturnType>;
    publicGetV5MarketIndexPriceKline(params?: {}): Promise<implicitReturnType>;
    publicGetV5MarketPremiumIndexPriceKline(params?: {}): Promise<implicitReturnType>;
    publicGetV5MarketInstrumentsInfo(params?: {}): Promise<implicitReturnType>;
    publicGetV5MarketOrderbook(params?: {}): Promise<implicitReturnType>;
    publicGetV5MarketTickers(params?: {}): Promise<implicitReturnType>;
    publicGetV5MarketFundingHistory(params?: {}): Promise<implicitReturnType>;
    publicGetV5MarketRecentTrade(params?: {}): Promise<implicitReturnType>;
    publicGetV5MarketOpenInterest(params?: {}): Promise<implicitReturnType>;
    publicGetV5MarketHistoricalVolatility(params?: {}): Promise<implicitReturnType>;
    publicGetV5MarketInsurance(params?: {}): Promise<implicitReturnType>;
    publicGetV5MarketRiskLimit(params?: {}): Promise<implicitReturnType>;
    publicGetV5MarketDeliveryPrice(params?: {}): Promise<implicitReturnType>;
    publicGetV5SpotLeverTokenInfo(params?: {}): Promise<implicitReturnType>;
    publicGetV5SpotLeverTokenReference(params?: {}): Promise<implicitReturnType>;
    publicGetV5AnnouncementsIndex(params?: {}): Promise<implicitReturnType>;
    privateGetV2PrivateOrderList(params?: {}): Promise<implicitReturnType>;
    privateGetV2PrivateOrder(params?: {}): Promise<implicitReturnType>;
    privateGetV2PrivateStopOrderList(params?: {}): Promise<implicitReturnType>;
    privateGetV2PrivateStopOrder(params?: {}): Promise<implicitReturnType>;
    privateGetV2PrivatePositionList(params?: {}): Promise<implicitReturnType>;
    privateGetV2PrivatePositionFeeRate(params?: {}): Promise<implicitReturnType>;
    privateGetV2PrivateExecutionList(params?: {}): Promise<implicitReturnType>;
    privateGetV2PrivateTradeClosedPnlList(params?: {}): Promise<implicitReturnType>;
    privateGetV2PublicRiskLimitList(params?: {}): Promise<implicitReturnType>;
    privateGetV2PublicFundingPrevFundingRate(params?: {}): Promise<implicitReturnType>;
    privateGetV2PrivateFundingPrevFunding(params?: {}): Promise<implicitReturnType>;
    privateGetV2PrivateFundingPredictedFunding(params?: {}): Promise<implicitReturnType>;
    privateGetV2PrivateAccountApiKey(params?: {}): Promise<implicitReturnType>;
    privateGetV2PrivateAccountLcp(params?: {}): Promise<implicitReturnType>;
    privateGetV2PrivateWalletBalance(params?: {}): Promise<implicitReturnType>;
    privateGetV2PrivateWalletFundRecords(params?: {}): Promise<implicitReturnType>;
    privateGetV2PrivateWalletWithdrawList(params?: {}): Promise<implicitReturnType>;
    privateGetV2PrivateExchangeOrderList(params?: {}): Promise<implicitReturnType>;
    privateGetPrivateLinearOrderList(params?: {}): Promise<implicitReturnType>;
    privateGetPrivateLinearOrderSearch(params?: {}): Promise<implicitReturnType>;
    privateGetPrivateLinearStopOrderList(params?: {}): Promise<implicitReturnType>;
    privateGetPrivateLinearStopOrderSearch(params?: {}): Promise<implicitReturnType>;
    privateGetPrivateLinearPositionList(params?: {}): Promise<implicitReturnType>;
    privateGetPrivateLinearTradeExecutionList(params?: {}): Promise<implicitReturnType>;
    privateGetPrivateLinearTradeClosedPnlList(params?: {}): Promise<implicitReturnType>;
    privateGetPublicLinearRiskLimit(params?: {}): Promise<implicitReturnType>;
    privateGetPrivateLinearFundingPredictedFunding(params?: {}): Promise<implicitReturnType>;
    privateGetPrivateLinearFundingPrevFunding(params?: {}): Promise<implicitReturnType>;
    privateGetFuturesPrivateOrderList(params?: {}): Promise<implicitReturnType>;
    privateGetFuturesPrivateOrder(params?: {}): Promise<implicitReturnType>;
    privateGetFuturesPrivateStopOrderList(params?: {}): Promise<implicitReturnType>;
    privateGetFuturesPrivateStopOrder(params?: {}): Promise<implicitReturnType>;
    privateGetFuturesPrivatePositionList(params?: {}): Promise<implicitReturnType>;
    privateGetFuturesPrivateExecutionList(params?: {}): Promise<implicitReturnType>;
    privateGetFuturesPrivateTradeClosedPnlList(params?: {}): Promise<implicitReturnType>;
    privateGetSpotV1Account(params?: {}): Promise<implicitReturnType>;
    privateGetSpotV1Order(params?: {}): Promise<implicitReturnType>;
    privateGetSpotV1OpenOrders(params?: {}): Promise<implicitReturnType>;
    privateGetSpotV1HistoryOrders(params?: {}): Promise<implicitReturnType>;
    privateGetSpotV1MyTrades(params?: {}): Promise<implicitReturnType>;
    privateGetSpotV1CrossMarginOrder(params?: {}): Promise<implicitReturnType>;
    privateGetSpotV1CrossMarginAccountsBalance(params?: {}): Promise<implicitReturnType>;
    privateGetSpotV1CrossMarginLoanInfo(params?: {}): Promise<implicitReturnType>;
    privateGetSpotV1CrossMarginRepayHistory(params?: {}): Promise<implicitReturnType>;
    privateGetSpotV3PrivateOrder(params?: {}): Promise<implicitReturnType>;
    privateGetSpotV3PrivateOpenOrders(params?: {}): Promise<implicitReturnType>;
    privateGetSpotV3PrivateHistoryOrders(params?: {}): Promise<implicitReturnType>;
    privateGetSpotV3PrivateMyTrades(params?: {}): Promise<implicitReturnType>;
    privateGetSpotV3PrivateAccount(params?: {}): Promise<implicitReturnType>;
    privateGetSpotV3PrivateReference(params?: {}): Promise<implicitReturnType>;
    privateGetSpotV3PrivateRecord(params?: {}): Promise<implicitReturnType>;
    privateGetSpotV3PrivateCrossMarginOrders(params?: {}): Promise<implicitReturnType>;
    privateGetSpotV3PrivateCrossMarginAccount(params?: {}): Promise<implicitReturnType>;
    privateGetSpotV3PrivateCrossMarginLoanInfo(params?: {}): Promise<implicitReturnType>;
    privateGetSpotV3PrivateCrossMarginRepayHistory(params?: {}): Promise<implicitReturnType>;
    privateGetSpotV3PrivateMarginLoanInfos(params?: {}): Promise<implicitReturnType>;
    privateGetSpotV3PrivateMarginRepaidInfos(params?: {}): Promise<implicitReturnType>;
    privateGetSpotV3PrivateMarginLtv(params?: {}): Promise<implicitReturnType>;
    privateGetAssetV1PrivateTransferList(params?: {}): Promise<implicitReturnType>;
    privateGetAssetV3PrivateTransferInterTransferListQuery(params?: {}): Promise<implicitReturnType>;
    privateGetAssetV1PrivateSubMemberTransferList(params?: {}): Promise<implicitReturnType>;
    privateGetAssetV3PrivateTransferSubMemberListQuery(params?: {}): Promise<implicitReturnType>;
    privateGetAssetV3PrivateTransferSubMemberTransferListQuery(params?: {}): Promise<implicitReturnType>;
    privateGetAssetV3PrivateTransferUniversalTransferListQuery(params?: {}): Promise<implicitReturnType>;
    privateGetAssetV1PrivateSubMemberMemberIds(params?: {}): Promise<implicitReturnType>;
    privateGetAssetV1PrivateDepositRecordQuery(params?: {}): Promise<implicitReturnType>;
    privateGetAssetV1PrivateWithdrawRecordQuery(params?: {}): Promise<implicitReturnType>;
    privateGetAssetV1PrivateCoinInfoQuery(params?: {}): Promise<implicitReturnType>;
    privateGetAssetV3PrivateCoinInfoQuery(params?: {}): Promise<implicitReturnType>;
    privateGetAssetV1PrivateAssetInfoQuery(params?: {}): Promise<implicitReturnType>;
    privateGetAssetV1PrivateDepositAddress(params?: {}): Promise<implicitReturnType>;
    privateGetAssetV3PrivateDepositAddressQuery(params?: {}): Promise<implicitReturnType>;
    privateGetAssetV1PrivateUniversalTransferList(params?: {}): Promise<implicitReturnType>;
    privateGetContractV3PrivateCopytradingOrderList(params?: {}): Promise<implicitReturnType>;
    privateGetContractV3PrivateCopytradingPositionList(params?: {}): Promise<implicitReturnType>;
    privateGetContractV3PrivateCopytradingWalletBalance(params?: {}): Promise<implicitReturnType>;
    privateGetContractV3PrivatePositionLimitInfo(params?: {}): Promise<implicitReturnType>;
    privateGetContractV3PrivateOrderUnfilledOrders(params?: {}): Promise<implicitReturnType>;
    privateGetContractV3PrivateOrderList(params?: {}): Promise<implicitReturnType>;
    privateGetContractV3PrivatePositionList(params?: {}): Promise<implicitReturnType>;
    privateGetContractV3PrivateExecutionList(params?: {}): Promise<implicitReturnType>;
    privateGetContractV3PrivatePositionClosedPnl(params?: {}): Promise<implicitReturnType>;
    privateGetContractV3PrivateAccountWalletBalance(params?: {}): Promise<implicitReturnType>;
    privateGetContractV3PrivateAccountFeeRate(params?: {}): Promise<implicitReturnType>;
    privateGetContractV3PrivateAccountWalletFundRecords(params?: {}): Promise<implicitReturnType>;
    privateGetUnifiedV3PrivateOrderUnfilledOrders(params?: {}): Promise<implicitReturnType>;
    privateGetUnifiedV3PrivateOrderList(params?: {}): Promise<implicitReturnType>;
    privateGetUnifiedV3PrivatePositionList(params?: {}): Promise<implicitReturnType>;
    privateGetUnifiedV3PrivateExecutionList(params?: {}): Promise<implicitReturnType>;
    privateGetUnifiedV3PrivateDeliveryRecord(params?: {}): Promise<implicitReturnType>;
    privateGetUnifiedV3PrivateSettlementRecord(params?: {}): Promise<implicitReturnType>;
    privateGetUnifiedV3PrivateAccountWalletBalance(params?: {}): Promise<implicitReturnType>;
    privateGetUnifiedV3PrivateAccountTransactionLog(params?: {}): Promise<implicitReturnType>;
    privateGetAssetV2PrivateExchangeExchangeOrderAll(params?: {}): Promise<implicitReturnType>;
    privateGetUnifiedV3PrivateAccountBorrowHistory(params?: {}): Promise<implicitReturnType>;
    privateGetUnifiedV3PrivateAccountBorrowRate(params?: {}): Promise<implicitReturnType>;
    privateGetUnifiedV3PrivateAccountInfo(params?: {}): Promise<implicitReturnType>;
    privateGetUserV3PrivateFrozenSubMember(params?: {}): Promise<implicitReturnType>;
    privateGetUserV3PrivateQuerySubMembers(params?: {}): Promise<implicitReturnType>;
    privateGetUserV3PrivateQueryApi(params?: {}): Promise<implicitReturnType>;
    privateGetAssetV3PrivateTransferTransferCoinListQuery(params?: {}): Promise<implicitReturnType>;
    privateGetAssetV3PrivateTransferAccountCoinBalanceQuery(params?: {}): Promise<implicitReturnType>;
    privateGetAssetV3PrivateTransferAccountCoinsBalanceQuery(params?: {}): Promise<implicitReturnType>;
    privateGetAssetV3PrivateTransferAssetInfoQuery(params?: {}): Promise<implicitReturnType>;
    privateGetAssetV3PublicDepositAllowedDepositListQuery(params?: {}): Promise<implicitReturnType>;
    privateGetAssetV3PrivateDepositRecordQuery(params?: {}): Promise<implicitReturnType>;
    privateGetAssetV3PrivateWithdrawRecordQuery(params?: {}): Promise<implicitReturnType>;
    privateGetV5OrderHistory(params?: {}): Promise<implicitReturnType>;
    privateGetV5OrderSpotBorrowCheck(params?: {}): Promise<implicitReturnType>;
    privateGetV5OrderRealtime(params?: {}): Promise<implicitReturnType>;
    privateGetV5PositionList(params?: {}): Promise<implicitReturnType>;
    privateGetV5ExecutionList(params?: {}): Promise<implicitReturnType>;
    privateGetV5PositionClosedPnl(params?: {}): Promise<implicitReturnType>;
    privateGetV5AccountWalletBalance(params?: {}): Promise<implicitReturnType>;
    privateGetV5AccountBorrowHistory(params?: {}): Promise<implicitReturnType>;
    privateGetV5AccountCollateralInfo(params?: {}): Promise<implicitReturnType>;
    privateGetV5AccountMmpState(params?: {}): Promise<implicitReturnType>;
    privateGetV5AssetCoinGreeks(params?: {}): Promise<implicitReturnType>;
    privateGetV5AccountInfo(params?: {}): Promise<implicitReturnType>;
    privateGetV5AccountTransactionLog(params?: {}): Promise<implicitReturnType>;
    privateGetV5AccountFeeRate(params?: {}): Promise<implicitReturnType>;
    privateGetV5AssetExchangeOrderRecord(params?: {}): Promise<implicitReturnType>;
    privateGetV5AssetDeliveryRecord(params?: {}): Promise<implicitReturnType>;
    privateGetV5AssetSettlementRecord(params?: {}): Promise<implicitReturnType>;
    privateGetV5AssetTransferQueryAssetInfo(params?: {}): Promise<implicitReturnType>;
    privateGetV5AssetTransferQueryAccountCoinBalance(params?: {}): Promise<implicitReturnType>;
    privateGetV5AssetTransferQueryTransferCoinList(params?: {}): Promise<implicitReturnType>;
    privateGetV5AssetTransferQueryInterTransferList(params?: {}): Promise<implicitReturnType>;
    privateGetV5AssetTransferQuerySubMemberList(params?: {}): Promise<implicitReturnType>;
    privateGetV5AssetTransferQueryUniversalTransferList(params?: {}): Promise<implicitReturnType>;
    privateGetV5AssetDepositQueryAllowedList(params?: {}): Promise<implicitReturnType>;
    privateGetV5AssetDepositQueryRecord(params?: {}): Promise<implicitReturnType>;
    privateGetV5AssetDepositQuerySubMemberRecord(params?: {}): Promise<implicitReturnType>;
    privateGetV5AssetDepositQueryAddress(params?: {}): Promise<implicitReturnType>;
    privateGetV5AssetDepositQuerySubMemberAddress(params?: {}): Promise<implicitReturnType>;
    privateGetV5AssetDepositQueryInternalRecord(params?: {}): Promise<implicitReturnType>;
    privateGetV5AssetCoinQueryInfo(params?: {}): Promise<implicitReturnType>;
    privateGetV5AssetWithdrawQueryRecord(params?: {}): Promise<implicitReturnType>;
    privateGetV5AssetWithdrawWithdrawableAmount(params?: {}): Promise<implicitReturnType>;
    privateGetV5AssetTransferQueryAccountCoinsBalance(params?: {}): Promise<implicitReturnType>;
    privateGetV5UserQuerySubMembers(params?: {}): Promise<implicitReturnType>;
    privateGetV5UserQueryApi(params?: {}): Promise<implicitReturnType>;
    privatePostV2PrivateOrderCreate(params?: {}): Promise<implicitReturnType>;
    privatePostV2PrivateOrderCancel(params?: {}): Promise<implicitReturnType>;
    privatePostV2PrivateOrderCancelAll(params?: {}): Promise<implicitReturnType>;
    privatePostV2PrivateOrderReplace(params?: {}): Promise<implicitReturnType>;
    privatePostV2PrivateStopOrderCreate(params?: {}): Promise<implicitReturnType>;
    privatePostV2PrivateStopOrderCancel(params?: {}): Promise<implicitReturnType>;
    privatePostV2PrivateStopOrderCancelAll(params?: {}): Promise<implicitReturnType>;
    privatePostV2PrivateStopOrderReplace(params?: {}): Promise<implicitReturnType>;
    privatePostV2PrivatePositionChangePositionMargin(params?: {}): Promise<implicitReturnType>;
    privatePostV2PrivatePositionTradingStop(params?: {}): Promise<implicitReturnType>;
    privatePostV2PrivatePositionLeverageSave(params?: {}): Promise<implicitReturnType>;
    privatePostV2PrivateTpslSwitchMode(params?: {}): Promise<implicitReturnType>;
    privatePostV2PrivatePositionSwitchIsolated(params?: {}): Promise<implicitReturnType>;
    privatePostV2PrivatePositionRiskLimit(params?: {}): Promise<implicitReturnType>;
    privatePostV2PrivatePositionSwitchMode(params?: {}): Promise<implicitReturnType>;
    privatePostPrivateLinearOrderCreate(params?: {}): Promise<implicitReturnType>;
    privatePostPrivateLinearOrderCancel(params?: {}): Promise<implicitReturnType>;
    privatePostPrivateLinearOrderCancelAll(params?: {}): Promise<implicitReturnType>;
    privatePostPrivateLinearOrderReplace(params?: {}): Promise<implicitReturnType>;
    privatePostPrivateLinearStopOrderCreate(params?: {}): Promise<implicitReturnType>;
    privatePostPrivateLinearStopOrderCancel(params?: {}): Promise<implicitReturnType>;
    privatePostPrivateLinearStopOrderCancelAll(params?: {}): Promise<implicitReturnType>;
    privatePostPrivateLinearStopOrderReplace(params?: {}): Promise<implicitReturnType>;
    privatePostPrivateLinearPositionSetAutoAddMargin(params?: {}): Promise<implicitReturnType>;
    privatePostPrivateLinearPositionSwitchIsolated(params?: {}): Promise<implicitReturnType>;
    privatePostPrivateLinearPositionSwitchMode(params?: {}): Promise<implicitReturnType>;
    privatePostPrivateLinearTpslSwitchMode(params?: {}): Promise<implicitReturnType>;
    privatePostPrivateLinearPositionAddMargin(params?: {}): Promise<implicitReturnType>;
    privatePostPrivateLinearPositionSetLeverage(params?: {}): Promise<implicitReturnType>;
    privatePostPrivateLinearPositionTradingStop(params?: {}): Promise<implicitReturnType>;
    privatePostPrivateLinearPositionSetRisk(params?: {}): Promise<implicitReturnType>;
    privatePostFuturesPrivateOrderCreate(params?: {}): Promise<implicitReturnType>;
    privatePostFuturesPrivateOrderCancel(params?: {}): Promise<implicitReturnType>;
    privatePostFuturesPrivateOrderCancelAll(params?: {}): Promise<implicitReturnType>;
    privatePostFuturesPrivateOrderReplace(params?: {}): Promise<implicitReturnType>;
    privatePostFuturesPrivateStopOrderCreate(params?: {}): Promise<implicitReturnType>;
    privatePostFuturesPrivateStopOrderCancel(params?: {}): Promise<implicitReturnType>;
    privatePostFuturesPrivateStopOrderCancelAll(params?: {}): Promise<implicitReturnType>;
    privatePostFuturesPrivateStopOrderReplace(params?: {}): Promise<implicitReturnType>;
    privatePostFuturesPrivatePositionChangePositionMargin(params?: {}): Promise<implicitReturnType>;
    privatePostFuturesPrivatePositionTradingStop(params?: {}): Promise<implicitReturnType>;
    privatePostFuturesPrivatePositionLeverageSave(params?: {}): Promise<implicitReturnType>;
    privatePostFuturesPrivatePositionSwitchMode(params?: {}): Promise<implicitReturnType>;
    privatePostFuturesPrivateTpslSwitchMode(params?: {}): Promise<implicitReturnType>;
    privatePostFuturesPrivatePositionSwitchIsolated(params?: {}): Promise<implicitReturnType>;
    privatePostFuturesPrivatePositionRiskLimit(params?: {}): Promise<implicitReturnType>;
    privatePostSpotV1Order(params?: {}): Promise<implicitReturnType>;
    privatePostSpotV1CrossMarginLoan(params?: {}): Promise<implicitReturnType>;
    privatePostSpotV1CrossMarginRepay(params?: {}): Promise<implicitReturnType>;
    privatePostSpotV3PrivateOrder(params?: {}): Promise<implicitReturnType>;
    privatePostSpotV3PrivateCancelOrder(params?: {}): Promise<implicitReturnType>;
    privatePostSpotV3PrivateCancelOrders(params?: {}): Promise<implicitReturnType>;
    privatePostSpotV3PrivateCancelOrdersByIds(params?: {}): Promise<implicitReturnType>;
    privatePostSpotV3PrivatePurchase(params?: {}): Promise<implicitReturnType>;
    privatePostSpotV3PrivateRedeem(params?: {}): Promise<implicitReturnType>;
    privatePostSpotV3PrivateCrossMarginLoan(params?: {}): Promise<implicitReturnType>;
    privatePostSpotV3PrivateCrossMarginRepay(params?: {}): Promise<implicitReturnType>;
    privatePostAssetV1PrivateTransfer(params?: {}): Promise<implicitReturnType>;
    privatePostAssetV3PrivateTransferInterTransfer(params?: {}): Promise<implicitReturnType>;
    privatePostAssetV1PrivateSubMemberTransfer(params?: {}): Promise<implicitReturnType>;
    privatePostAssetV1PrivateWithdraw(params?: {}): Promise<implicitReturnType>;
    privatePostAssetV3PrivateWithdrawCreate(params?: {}): Promise<implicitReturnType>;
    privatePostAssetV1PrivateWithdrawCancel(params?: {}): Promise<implicitReturnType>;
    privatePostAssetV3PrivateWithdrawCancel(params?: {}): Promise<implicitReturnType>;
    privatePostAssetV1PrivateTransferableSubsSave(params?: {}): Promise<implicitReturnType>;
    privatePostAssetV1PrivateUniversalTransfer(params?: {}): Promise<implicitReturnType>;
    privatePostAssetV3PrivateTransferSubMemberTransfer(params?: {}): Promise<implicitReturnType>;
    privatePostAssetV3PrivateTransferTransferSubMemberSave(params?: {}): Promise<implicitReturnType>;
    privatePostAssetV3PrivateTransferUniversalTransfer(params?: {}): Promise<implicitReturnType>;
    privatePostUserV3PrivateCreateSubMember(params?: {}): Promise<implicitReturnType>;
    privatePostUserV3PrivateCreateSubApi(params?: {}): Promise<implicitReturnType>;
    privatePostUserV3PrivateUpdateApi(params?: {}): Promise<implicitReturnType>;
    privatePostUserV3PrivateDeleteApi(params?: {}): Promise<implicitReturnType>;
    privatePostUserV3PrivateUpdateSubApi(params?: {}): Promise<implicitReturnType>;
    privatePostUserV3PrivateDeleteSubApi(params?: {}): Promise<implicitReturnType>;
    privatePostOptionUsdcOpenapiPrivateV1PlaceOrder(params?: {}): Promise<implicitReturnType>;
    privatePostOptionUsdcOpenapiPrivateV1BatchPlaceOrder(params?: {}): Promise<implicitReturnType>;
    privatePostOptionUsdcOpenapiPrivateV1ReplaceOrder(params?: {}): Promise<implicitReturnType>;
    privatePostOptionUsdcOpenapiPrivateV1BatchReplaceOrders(params?: {}): Promise<implicitReturnType>;
    privatePostOptionUsdcOpenapiPrivateV1CancelOrder(params?: {}): Promise<implicitReturnType>;
    privatePostOptionUsdcOpenapiPrivateV1BatchCancelOrders(params?: {}): Promise<implicitReturnType>;
    privatePostOptionUsdcOpenapiPrivateV1CancelAll(params?: {}): Promise<implicitReturnType>;
    privatePostOptionUsdcOpenapiPrivateV1QueryActiveOrders(params?: {}): Promise<implicitReturnType>;
    privatePostOptionUsdcOpenapiPrivateV1QueryOrderHistory(params?: {}): Promise<implicitReturnType>;
    privatePostOptionUsdcOpenapiPrivateV1ExecutionList(params?: {}): Promise<implicitReturnType>;
    privatePostOptionUsdcOpenapiPrivateV1QueryTransactionLog(params?: {}): Promise<implicitReturnType>;
    privatePostOptionUsdcOpenapiPrivateV1QueryWalletBalance(params?: {}): Promise<implicitReturnType>;
    privatePostOptionUsdcOpenapiPrivateV1QueryAssetInfo(params?: {}): Promise<implicitReturnType>;
    privatePostOptionUsdcOpenapiPrivateV1QueryMarginInfo(params?: {}): Promise<implicitReturnType>;
    privatePostOptionUsdcOpenapiPrivateV1QueryPosition(params?: {}): Promise<implicitReturnType>;
    privatePostOptionUsdcOpenapiPrivateV1QueryDeliveryList(params?: {}): Promise<implicitReturnType>;
    privatePostOptionUsdcOpenapiPrivateV1QueryPositionExpDate(params?: {}): Promise<implicitReturnType>;
    privatePostOptionUsdcOpenapiPrivateV1MmpModify(params?: {}): Promise<implicitReturnType>;
    privatePostOptionUsdcOpenapiPrivateV1MmpReset(params?: {}): Promise<implicitReturnType>;
    privatePostPerpetualUsdcOpenapiPrivateV1PlaceOrder(params?: {}): Promise<implicitReturnType>;
    privatePostPerpetualUsdcOpenapiPrivateV1ReplaceOrder(params?: {}): Promise<implicitReturnType>;
    privatePostPerpetualUsdcOpenapiPrivateV1CancelOrder(params?: {}): Promise<implicitReturnType>;
    privatePostPerpetualUsdcOpenapiPrivateV1CancelAll(params?: {}): Promise<implicitReturnType>;
    privatePostPerpetualUsdcOpenapiPrivateV1PositionLeverageSave(params?: {}): Promise<implicitReturnType>;
    privatePostOptionUsdcOpenapiPrivateV1SessionSettlement(params?: {}): Promise<implicitReturnType>;
    privatePostOptionUsdcPrivateAssetAccountSetMarginMode(params?: {}): Promise<implicitReturnType>;
    privatePostPerpetualUsdcOpenapiPublicV1RiskLimitList(params?: {}): Promise<implicitReturnType>;
    privatePostPerpetualUsdcOpenapiPrivateV1PositionSetRiskLimit(params?: {}): Promise<implicitReturnType>;
    privatePostPerpetualUsdcOpenapiPrivateV1PredictedFunding(params?: {}): Promise<implicitReturnType>;
    privatePostContractV3PrivateCopytradingOrderCreate(params?: {}): Promise<implicitReturnType>;
    privatePostContractV3PrivateCopytradingOrderCancel(params?: {}): Promise<implicitReturnType>;
    privatePostContractV3PrivateCopytradingOrderClose(params?: {}): Promise<implicitReturnType>;
    privatePostContractV3PrivateCopytradingPositionClose(params?: {}): Promise<implicitReturnType>;
    privatePostContractV3PrivateCopytradingPositionSetLeverage(params?: {}): Promise<implicitReturnType>;
    privatePostContractV3PrivateCopytradingWalletTransfer(params?: {}): Promise<implicitReturnType>;
    privatePostContractV3PrivateCopytradingOrderTradingStop(params?: {}): Promise<implicitReturnType>;
    privatePostContractV3PrivateOrderCreate(params?: {}): Promise<implicitReturnType>;
    privatePostContractV3PrivateOrderCancel(params?: {}): Promise<implicitReturnType>;
    privatePostContractV3PrivateOrderCancelAll(params?: {}): Promise<implicitReturnType>;
    privatePostContractV3PrivateOrderReplace(params?: {}): Promise<implicitReturnType>;
    privatePostContractV3PrivatePositionSetAutoAddMargin(params?: {}): Promise<implicitReturnType>;
    privatePostContractV3PrivatePositionSwitchIsolated(params?: {}): Promise<implicitReturnType>;
    privatePostContractV3PrivatePositionSwitchMode(params?: {}): Promise<implicitReturnType>;
    privatePostContractV3PrivatePositionSwitchTpslMode(params?: {}): Promise<implicitReturnType>;
    privatePostContractV3PrivatePositionSetLeverage(params?: {}): Promise<implicitReturnType>;
    privatePostContractV3PrivatePositionTradingStop(params?: {}): Promise<implicitReturnType>;
    privatePostContractV3PrivatePositionSetRiskLimit(params?: {}): Promise<implicitReturnType>;
    privatePostContractV3PrivateAccountSetMarginMode(params?: {}): Promise<implicitReturnType>;
    privatePostUnifiedV3PrivateOrderCreate(params?: {}): Promise<implicitReturnType>;
    privatePostUnifiedV3PrivateOrderReplace(params?: {}): Promise<implicitReturnType>;
    privatePostUnifiedV3PrivateOrderCancel(params?: {}): Promise<implicitReturnType>;
    privatePostUnifiedV3PrivateOrderCreateBatch(params?: {}): Promise<implicitReturnType>;
    privatePostUnifiedV3PrivateOrderReplaceBatch(params?: {}): Promise<implicitReturnType>;
    privatePostUnifiedV3PrivateOrderCancelBatch(params?: {}): Promise<implicitReturnType>;
    privatePostUnifiedV3PrivateOrderCancelAll(params?: {}): Promise<implicitReturnType>;
    privatePostUnifiedV3PrivatePositionSetLeverage(params?: {}): Promise<implicitReturnType>;
    privatePostUnifiedV3PrivatePositionTpslSwitchMode(params?: {}): Promise<implicitReturnType>;
    privatePostUnifiedV3PrivatePositionSetRiskLimit(params?: {}): Promise<implicitReturnType>;
    privatePostUnifiedV3PrivatePositionTradingStop(params?: {}): Promise<implicitReturnType>;
    privatePostUnifiedV3PrivateAccountUpgradeUnifiedAccount(params?: {}): Promise<implicitReturnType>;
    privatePostUnifiedV3PrivateAccountSetMarginMode(params?: {}): Promise<implicitReturnType>;
    privatePostFhtComplianceTaxV3PrivateRegistertime(params?: {}): Promise<implicitReturnType>;
    privatePostFhtComplianceTaxV3PrivateCreate(params?: {}): Promise<implicitReturnType>;
    privatePostFhtComplianceTaxV3PrivateStatus(params?: {}): Promise<implicitReturnType>;
    privatePostFhtComplianceTaxV3PrivateUrl(params?: {}): Promise<implicitReturnType>;
    privatePostV5OrderCreate(params?: {}): Promise<implicitReturnType>;
    privatePostV5OrderAmend(params?: {}): Promise<implicitReturnType>;
    privatePostV5OrderCancel(params?: {}): Promise<implicitReturnType>;
    privatePostV5OrderCancelAll(params?: {}): Promise<implicitReturnType>;
    privatePostV5OrderCreateBatch(params?: {}): Promise<implicitReturnType>;
    privatePostV5OrderAmendBatch(params?: {}): Promise<implicitReturnType>;
    privatePostV5OrderCancelBatch(params?: {}): Promise<implicitReturnType>;
    privatePostV5OrderDisconnectedCancelAll(params?: {}): Promise<implicitReturnType>;
    privatePostV5PositionSetLeverage(params?: {}): Promise<implicitReturnType>;
    privatePostV5PositionSetTpslMode(params?: {}): Promise<implicitReturnType>;
    privatePostV5PositionSetRiskLimit(params?: {}): Promise<implicitReturnType>;
    privatePostV5PositionTradingStop(params?: {}): Promise<implicitReturnType>;
    privatePostV5AccountUpgradeToUta(params?: {}): Promise<implicitReturnType>;
    privatePostV5AccountSetMarginMode(params?: {}): Promise<implicitReturnType>;
    privatePostV5AssetTransferInterTransfer(params?: {}): Promise<implicitReturnType>;
    privatePostV5AssetTransferSaveTransferSubMember(params?: {}): Promise<implicitReturnType>;
    privatePostV5AssetTransferUniversalTransfer(params?: {}): Promise<implicitReturnType>;
    privatePostV5AssetDepositDepositToAccount(params?: {}): Promise<implicitReturnType>;
    privatePostV5AssetWithdrawCreate(params?: {}): Promise<implicitReturnType>;
    privatePostV5AssetWithdrawCancel(params?: {}): Promise<implicitReturnType>;
    privatePostV5SpotLeverTokenPurchase(params?: {}): Promise<implicitReturnType>;
    privatePostV5SpotLeverTokenRedeem(params?: {}): Promise<implicitReturnType>;
    privatePostV5SpotLeverTokenOrderRecord(params?: {}): Promise<implicitReturnType>;
    privatePostV5SpotMarginTradeSwitchMode(params?: {}): Promise<implicitReturnType>;
    privatePostV5SpotMarginTradeSetLeverage(params?: {}): Promise<implicitReturnType>;
    privatePostV5UserCreateSubMember(params?: {}): Promise<implicitReturnType>;
    privatePostV5UserCreateSubApi(params?: {}): Promise<implicitReturnType>;
    privatePostV5UserFrozenSubMember(params?: {}): Promise<implicitReturnType>;
    privatePostV5UserUpdateApi(params?: {}): Promise<implicitReturnType>;
    privatePostV5UserUpdateSubApi(params?: {}): Promise<implicitReturnType>;
    privatePostV5UserDeleteApi(params?: {}): Promise<implicitReturnType>;
    privatePostV5UserDeleteSubApi(params?: {}): Promise<implicitReturnType>;
    privateDeleteSpotV1Order(params?: {}): Promise<implicitReturnType>;
    privateDeleteSpotV1OrderFast(params?: {}): Promise<implicitReturnType>;
    privateDeleteSpotOrderBatchCancel(params?: {}): Promise<implicitReturnType>;
    privateDeleteSpotOrderBatchFastCancel(params?: {}): Promise<implicitReturnType>;
    privateDeleteSpotOrderBatchCancelByIds(params?: {}): Promise<implicitReturnType>;
}
declare abstract class Exchange extends _Exchange {
}
export default Exchange;
