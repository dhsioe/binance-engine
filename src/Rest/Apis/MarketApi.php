<?php
/**
 * 公共行情数据API
 * @author: hsioe1111@gmail.com
 * @date: 2025/4/8
 * @description:
 */

namespace Hsioe\QuantBinance\Rest\Apis;


use GuzzleHttp\Exception\GuzzleException;
use Hsioe\QuantBinance\Exception\ApiException;

class MarketApi extends ApiBase
{
    /**
     * 获取交易规则和交易对
     *
     * @link https://developers.binance.com/docs/zh-CN/derivatives/usds-margined-futures/market-data/rest-api/Exchange-Information
     * @return array
     * @throws ApiException
     * @throws GuzzleException
     */
    public function getExchangeInfo(): array
    {
        return $this->_request('/fapi/v1/exchangeInfo', 'GET');
    }
}