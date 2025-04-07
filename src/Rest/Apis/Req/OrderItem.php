<?php
/**
 * @author: hsioe1111@gmail.com
 * @date: 2024/12/18
 * @description:
 */

namespace Hsioe\QuantBinance\Rest\Apis\Req;


class OrderItem
{
    use ReqBase;
    
    /**
     * 交易对
     * @var string
     */
    protected string $symbol = '';
    
    protected string $side = '';
    
    
    protected string $positionSide = '';
    
    /**
     * 下单类型
     *   - LIMIT 限价单
     *   - MARKET 市价单
     *   - STOP
     * @var string
     */
    protected string $type = '';
    
    
    protected string $reduceOnly = '';
    
    /**
     * 下单数量
     * @var string
     */
    protected string $quantity = '1';
    
    /**
     * 委托价格
     * @var string
     */
    protected string $price = '';
    
    public function setSymbol(string $symbol): void
    {
        $this->symbol = $symbol;
    }
    
    public function getSymbol(): string
    {
        return $this->symbol;
    }
    
    public function setSide(string $side): void
    {
        $this->side = $side;
    }
    
    public function getSide(): string
    {
        return $this->side;
    }
    
    public function setPositionSide(string $positionSide): void
    {
        $this->positionSide = $positionSide;
    }
    
    public function getPositionSide(): string
    {
        return $this->positionSide;
    }
    
    public function setType(string $type): void
    {
        $this->type = $type;
    }
    
    public function getType(): string
    {
        return $this->type;
    }
    
    public function setReduceOnly(string $reduceOnly): void
    {
        $this->reduceOnly = $reduceOnly;
    }
    
    public function getReduceOnly(): string
    {
        return $this->reduceOnly;
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
}