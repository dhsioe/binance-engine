<?php
/**
 * 账单类型
 * @author: hsioe1111@gmail.com
 * @date: 2025/4/8
 * @description:
 */

namespace Hsioe\QuantBinance\Enum;


enum BinanceIncomeTypeEnum: string
{
    case TRANSFER = 'TRANSFER';
    
    case WELCOME_BONUS = 'WELCOME_BONUS';
    // 已实现盈亏(合约)
    case REALIZED_PNL = 'REALIZED_PNL';
    // 资金费用
    case FUNDING_FEE = 'FUNDING_FEE';
    
    case COMMISSION = 'COMMISSION';
    // 强平
    case INSURANCE_CLEAR = 'INSURANCE_CLEAR';
    // 推荐人返佣
    case REFERRAL_KICKBACK = 'REFERRAL_KICKBACK';
    
    
    /**
     * @param BinanceIncomeTypeEnum $typeEnum
     * @return string
     */
    public static function text(self $typeEnum): string
    {
        return match ($typeEnum) {
            self::TRANSFER => '转账',
            self::WELCOME_BONUS => '欢迎奖金',
            self::REALIZED_PNL => '已实现盈亏',
            self::FUNDING_FEE => '资金费用',
            self::COMMISSION => '佣金',
            self::INSURANCE_CLEAR => '强平',
            self::REFERRAL_KICKBACK => '推荐人返佣',
        };
    }
    
    /**
     * 转换为数值
     * @param BinanceIncomeTypeEnum $typeEnum
     * @return int
     */
    public static function toIndex(self $typeEnum): int
    {
        return match ($typeEnum) {
            self::TRANSFER => 1,
            self::WELCOME_BONUS => 2,
            self::REALIZED_PNL => 3,
            self::FUNDING_FEE => 4,
            self::COMMISSION => 5,
            self::INSURANCE_CLEAR => 6,
            self::REFERRAL_KICKBACK => 7,
        };
    }
}