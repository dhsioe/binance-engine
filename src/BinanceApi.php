<?php
/**
 * 欧易RestAPI客户端
 * @author: hsioe1111@gmail.com
 * @date: 2024/8/8
 * @description:
 */

namespace Hsioe\QuantBinance;


use Exception;
use Hsioe\QuantBinance\Rest\ApiRequest;
use Hsioe\QuantBinance\Rest\Apis\AccountApi;
use Hsioe\QuantBinance\Rest\Apis\CmApi;
use Hsioe\QuantBinance\Rest\Apis\TradeApi;


/**
 *  币安接口V1.0
 *
 * @class BinanceApi
 * @method static AccountApi account(ApiRequest $request)
 * @method static TradeApi trade(ApiRequest $request)
 * @method static CmApi cm(ApiRequest $request)
 * */
class BinanceApi
{
    /**
     * @param $name
     * @param $arguments
     * @return void
     * @throws Exception
     */
    public static function __callStatic($name, $arguments)
    {
        $class = "Hsioe\\QuantBinance\\Rest\Apis\\" . ucfirst($name) . 'Api';
        if (!class_exists($class)) {
            throw new Exception("{$class}类不存在!");
        }
        
        return new $class($arguments[0]);
    }
}