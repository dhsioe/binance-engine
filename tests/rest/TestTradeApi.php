<?php
/**
 * 测试数据
 * @author: hsioe1111@gmail.com
 * @date: 2024/8/8
 * @description:
 */

namespace Hsioe\QuantBinance\Tests\rest;


use GuzzleHttp\Exception\GuzzleException;
use Hsioe\QuantBinance\BinanceApi;
use Hsioe\QuantBinance\Exception\ApiException;
use Hsioe\QuantBinance\Rest\Apis\Req\LeverageReq;
use Hsioe\QuantBinance\Rest\Apis\Req\OrderItem;
use Hsioe\QuantBinance\Rest\Apis\Req\TradeHistoryReq;

class TestTradeApi extends ApiTestCase
{
    /**
     * 账户接口
     * @return void
     * @throws GuzzleException
     * @throws ApiException
     */
    public function testBatchOrder(): void
    {
        $orders = [];
        $order = new OrderItem([]);
        $order->setSymbol('1inchusdt');
        $order->setSide('BUY');
        $order->setPositionSide('LONG');
        $order->setQuantity('100');
        $order->setType('MARKET');
        $orders[] = $order;
        $res = BinanceApi::trade($this->apiRequest)->batchOrders($orders);
        print_r($res);
        $this->assertIsArray($res);
    }
    
    /**
     * 下单接口
     * @return void
     * @throws GuzzleException
     * @throws ApiException
     */
    public function testCreateOrder(): void
    {
        $order = new OrderItem([]);
        $order->setSymbol('ethusdt');
        $order->setSide('BUY');
        $order->setPositionSide('LONG');
        $order->setQuantity('0.006');
        $order->setType('MARKET');
        $res = BinanceApi::trade($this->apiRequest)->createOrder($order);
        print_r($res);
        $this->assertIsArray($res);
    }
    
    /**
     * 平仓测试
     * @return void
     * @throws ApiException
     * @throws GuzzleException
     */
    public function testCloseOrder(): void
    {
        $order = new OrderItem([]);
        $order->setSymbol('ethusdt');
        $order->setSide('SELL');
        $order->setPositionSide('LONG');
        $order->setQuantity('0.01');
        $order->setType('MARKET');
        $res = BinanceApi::trade($this->apiRequest)->createOrder($order);
        print_r($res);
        $this->assertIsArray($res);
    }
    
    /**
     * 配置杠杆数
     * @return void
     * @throws ApiException
     * @throws GuzzleException
     */
    public function testSetLeverage(): void
    {
        $leverReq = new LeverageReq([]);
        $leverReq->setSymbol('btcusdt');
        $leverReq->setLeverage(30);
        
        $res = BinanceApi::trade($this->apiRequest)->setLeverage($leverReq);
        print_r($res);
        $this->assertIsArray($res);
    }
    
    /**
     * 调整数据
     * @return void
     * @throws ApiException
     * @throws GuzzleException
     */
    public function testGetOpenOrders(): void
    {
        $res = BinanceApi::trade($this->apiRequest)->getOpenOrders();
        print_r($res);
        $this->assertIsArray($res);
    }
    
    /**
     * 获取历史成交
     * @return void
     * @throws ApiException
     * @throws GuzzleException
     */
    public function testGetTradeHistory(): void
    {
        $req = new TradeHistoryReq([]);
        $res = BinanceApi::trade($this->apiRequest)->getTradeHistory($req);
        print_r($res);
        $this->assertIsArray($res);
    }
}