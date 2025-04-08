<?php
/**
 * 长链接事件
 * @author: hsioe1111@gmail.com
 * @date: 2025/4/8
 * @description:
 */

namespace Hsioe\QuantBinance\Enum;


enum BinanceSocketEventEnum: string
{
    // 订单更新事件
    case TRADE_UPDATED = 'ORDER_TRADE_UPDATE';
    
    // 账户更新事件
    case ACCOUNT_UPDATED = 'ACCOUNT_UPDATE';
    
    // 持仓风险过高提示
    case MARGIN_WARNING = 'MARGIN_CALL';
}