<?php
/**
 * 测试数据
 * @author: hsioe1111@gmail.com
 * @date: 2024/8/8
 * @description:
 */

namespace Hsioe\QuantBinance\Tests\rest;


use Hsioe\QuantBinance\BinanceApi;
use Hsioe\QuantBinance\Rest\ApiRequest;

class TestMarketApi extends ApiTestCase
{
    
    public function testGetExchangeInfo(): void
    {
        $res = BinanceApi::market(new ApiRequest([]))->getExchangeInfo();
        $this->assertTrue(true);
    }
}