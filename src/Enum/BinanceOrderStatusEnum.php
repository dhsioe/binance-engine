<?php
/**
 * 币安订单状态
 * @author: hsioe1111@gmail.com
 * @date: 2024/12/25
 * @description:
 */

namespace Hsioe\QuantBinance\Enum;


enum BinanceOrderStatusEnum: string
{
    /**
     * 已下单
     * @var string
     */
    case NEW = 'NEW';
    
    /**
     *  已成交
     * @var string
     */
    case FILLED = 'FILLED';
    
    /**
     *  已成交
     * @var string
     */
    case CANCELED = 'CANCELED';
    
    /**
     * 部分成交
     * @var string
     */
    case PARTIALLY_FILLED = 'PARTIALLY_FILLED';
    
    
    /**
     * @param BinanceOrderStatusEnum $typeEnum
     * @return string
     */
    public static function text(self $typeEnum): string
    {
        return match ($typeEnum) {
            self::NEW => '新订单',
            self::PARTIALLY_FILLED => '部分成交',
            self::FILLED => '完全成交',
            self::CANCELED => '已取消'
        };
    }
}