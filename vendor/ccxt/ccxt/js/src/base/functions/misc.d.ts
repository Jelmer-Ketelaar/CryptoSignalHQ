import { OHLCVC, Trade } from '../types.js';
declare const parseTimeframe: (timeframe: string) => number;
declare const roundTimeframe: (timeframe: any, timestamp: any, direction?: number) => number;
declare const buildOHLCVC: (trades: Trade[], timeframe?: string, since?: number, limit?: number) => OHLCVC[];
declare const extractParams: (string: any) => any[];
declare const implodeParams: (string: any, params: any) => any;
declare function vwap(baseVolume: any, quoteVolume: any): number;
declare function aggregate(bidasks: any): number[][];
export { aggregate, parseTimeframe, roundTimeframe, buildOHLCVC, implodeParams, extractParams, vwap, };
