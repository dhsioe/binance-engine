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

class TestAccountApi extends ApiTestCase
{
    /**
     * 账户接口
     * @return void
     * @throws GuzzleException
     * @throws ApiException
     */
    public function testGetAccountInfo(): void
    {
        $res = BinanceApi::account($this->apiRequest)->getAccountInfo();
        foreach($res['positions'] as $position) {
            if($position['maintMargin'] > 0) {
                print_r($position);
            }
        }
        $this->assertIsArray($res['positions']);
    }
    
    /**
     * 测试持仓模式
     * @return void
     * @throws ApiException
     * @throws GuzzleException
     */
    public function testSetPositionModel(): void
    {
        $res = BinanceApi::account($this->apiRequest)->setPositionDual(true);
        $this->assertIsArray($res);
    }
    
    /**
     * 测试获取持仓模式
     * @return void
     * @throws ApiException
     * @throws GuzzleException
     */
    public function testGetPositionModel(): void
    {
        $res = BinanceApi::account($this->apiRequest)->getPositionDual();
        print_r($res);
        $this->assertIsArray($res);
    }
    
    /**
     * 测试获取账户配置
     * @return void
     * @throws ApiException
     * @throws GuzzleException
     */
    public function testGetAccountConfig(): void
    {
        $res = BinanceApi::account($this->apiRequest)->getAccountConfig();
        print_r($res);
        $this->assertIsArray($res);
    }
    
    /**
     * 测试获取交易对配置
     * @return void
     * @throws ApiException
     * @throws GuzzleException
     */
    public function testGetSymbolConfig(): void
    {
        $res = BinanceApi::account($this->apiRequest)->getSymbolConfig();
        print_r($res);
        $this->assertIsArray($res);
    }
}