<?php
/**
 * 币安错误码
 * @author: hsioe1111@gmail.com
 * @date: 2025/4/8
 * @description:
 */


namespace Hsioe\QuantBinance\Enum;
enum BinanceErrorCodeEnum: int
{
    case UNKNOW = -1000;
    
    case DICONNECTED = -1001;
    
    // You are not authorized to execute this request
    // 无权执行请求
    case UNAUTHORIZED = -1002;
    
    case TOO_MANY_REQUESTS = -1003;
    
    case DUPLICATE_IP = -1004;
    
    case NOT_SUCH_IP = -1005;
    
    case UNEXPECTED_RESP = -1006;
    // 超时
    case TIMEOUT = -1007;
    // 新订单太多
    case TOO_MANY_ORDERS = -1015;
    // 服务不可用
    case SERVICE_SHUTTING_DOWN = -1016;
    // 不支持操作
    case UNSUPPORTED_OPERATION = -1020;
    // 此请求签名无效
    case INVALID_SIGNATURE = -1022;
}