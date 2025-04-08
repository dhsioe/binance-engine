<?php
/**
 * @author: hsioe1111@gmail.com
 * @date: 2024/12/25
 * @description:
 */

namespace Hsioe\QuantBinance\Enum;


enum BinanceOrderTypeEnum: string
{
    /**
     * 市价单
     * @var string
     */
    case MARKET = 'MARKET';
    
    /**
     * 限价单
     *
     * @var string
     */
    case LIMIT = 'LIMIT';
    
    
    /**
     * @param BinanceOrderTypeEnum $typeEnum
     * @return string
     */
    public static function text(self $typeEnum): string
    {
        return match ($typeEnum) {
            self::MARKET => '市价单',
            self::LIMIT => '限价单',
        };
    }
}