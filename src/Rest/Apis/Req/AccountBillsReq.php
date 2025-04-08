<?php
/**
 * 历史交易查询
 * @author: hsioe1111@gmail.com
 * @date: 2024/12/19
 * @description:
 */

namespace Hsioe\QuantBinance\Rest\Apis\Req;


class AccountBillsReq
{
    use ReqBase,
        ListTrait;
    
    /**
     * 交易对
     * @var string
     */
    protected string $symbol = '';
    
    /**
     * 账单类型
     *   TRANSFER 转账
     *   WELCOME_BONUS 欢迎奖金
     *   REALIZED_PNL 已实现盈亏
     *   FUNDING_FEE 资金费用
     * @var string
     */
    protected string $incomeType = '';
    
    public function setSymbol(string $symbol): void
    {
        $this->symbol = $symbol;
    }
    
    public function getSymbol(): string
    {
        return $this->symbol;
    }
    
    public function setIncomeType(string $incomeType): void
    {
        $this->incomeType = $incomeType;
    }
    
    public function getIncomeType(): string
    {
        return $this->incomeType;
    }
}