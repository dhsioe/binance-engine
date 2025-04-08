<?php
/**
 * 修改订单通知
 * @author: hsioe1111@gmail.com
 * @date: 2025/1/6
 * @description:
 */

namespace Hsioe\QuantBinance\Rest\Apis\Req;


class UpdateOrderReq
{
    use ReqBase;
    
    /**
     * 订单编号
     * @var string
     */
    protected string $symbol = '';
    
    /**
     * 订单ID
     * @var string
     */
    protected string $orderId = '';
    
    /**
     * 订单数量
     * @var string
     */
    protected string $quantity = '';
    
    /**
     * 订单价格
     * @var string
     */
    protected string $price = '';
    
    /**
     * 订单方向
     * @var string
     */
    protected string $side = '';
    
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
    
    public function setQuantity(string $quantity): void
    {
        $this->quantity = $quantity;
    }
    
    public function getQuantity(): string
    {
        return $this->quantity;
    }
    
    public function setPrice(string $price): void
    {
        $this->price = $price;
    }
    
    public function getPrice(): string
    {
        return $this->price;
    }
    
    public function setSide(string $side): void
    {
        $this->side = $side;
    }
    
    public function getSide(): string
    {
        return $this->side;
    }
}