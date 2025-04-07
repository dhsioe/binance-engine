<?php
/**
 * 历史交易查询
 * @author: hsioe1111@gmail.com
 * @date: 2024/12/19
 * @description:
 */

namespace Hsioe\QuantBinance\Rest\Apis\Req;


class TradeHistoryReq
{
    use ReqBase,
        ListTrait;
    
    /**
     * 交易对
     * @var string
     */
    protected string $symbol = '';
    
    /**
     * 订单ID需和symbol一起使用
     * @var string
     */
    protected string $orderId = '';
    
    /**
     * 返回该fromId及之后的成交，缺省返回最近的成交
     * @var string
     */
    protected string $fromId = '';
    
    public function setSymbol(string $symbol): void
    {
        $this->symbol = $symbol;
    }
    
    public function getSymbol(): string
    {
        return $this->symbol;
    }
    
    public function setOrderId(string $orderId): void
    {
        $this->orderId = $orderId;
    }
    
    public function getOrderId(): string
    {
        return $this->orderId;
    }
    
    public function setFromId(string $fromId): void
    {
        $this->fromId = $fromId;
    }
    
    public function getFromId(): string
    {
        return $this->fromId;
    }
}