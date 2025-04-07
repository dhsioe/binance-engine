<?php
/**
 * 币安常量
 * @author: hsioe1111@gmail.com
 * @date: 2024/12/18
 * @description:
 */

namespace Hsioe\QuantBinance;


class BinanceConst
{
    // 成功code
    const SUCCESS_CODE = 200;
    // 生产环境
    const REAL_BASE_REST_API_URL = 'https://fapi.binance.com';
    // 测试环境
    const DEV_BASE_REST_API_URL = 'https://testnet.binancefuture.com';
    
    // 请求APIKEY头
    const RES_API_HEADERS = 'X-MBX-APIKEY';
    
    // WEBSOCKET
    const WEBSOCKET = [
        // 现货行情数据订阅
        'STREAM' => 'ws://stream.binance.com/stream',
        // 合约行情数据连接
        'FSTREAM' => 'ws://fstream.binance.com/ws',
        // 测试合约数据
        'FSTREAM_TEST' => 'ws://stream.binancefuture.com/ws'
    ];
}