<?php
/**
 * 杠杆配置请求
 * @author: hsioe1111@gmail.com
 * @date: 2024/12/19
 * @description:
 */

namespace Hsioe\QuantBinance\Rest\Apis\Req;


class LeverageReq
{
    use ReqBase;
    
    /**
     * 交易对
     * @var string
     */
    protected string $symbol = '';
    
    /**
     * 杠杆数,默认20,最大125
     * @var int
     */
    protected int $leverage = 20;
    
    public function setSymbol(string $symbol): void
    {
        $this->symbol = $symbol;
    }
    
    public function getSymbol(): string
    {
        return $this->symbol;
    }
    
    public function setLeverage(int $leverage): void
    {
        $this->leverage = $leverage;
    }
    
    public function getLeverage(): int
    {
        return $this->leverage;
    }
}