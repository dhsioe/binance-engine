<?php
/**
 * 账户相关
 * @author: hsioe1111@gmail.com
 * @date: 2024/12/18
 * @description:
 */

namespace Hsioe\QuantBinance\Rest\Apis;


use GuzzleHttp\Exception\GuzzleException;
use Hsioe\QuantBinance\Exception\ApiException;
use Hsioe\QuantBinance\Rest\Apis\Req\LeverageReq;
use Hsioe\QuantBinance\Rest\Apis\Req\OrderItem;
use Hsioe\QuantBinance\Rest\Apis\Req\TradeHistoryReq;
use Hsioe\QuantBinance\Rest\Apis\Req\UpdateOrderReq;

class TradeApi extends ApiBase
{
    /**
     * 下单请求
     *
     * @link https://developers.binance.com/docs/zh-CN/derivatives/usds-margined-futures/trade/rest-api
     * @param OrderItem $orderItem
     * @param bool $isTest 是否测试订单 true-是 false-否
     * @return array
     * @throws ApiException
     * @throws GuzzleException
     */
    public function createOrder(OrderItem $orderItem, bool $isTest = False): array
    {
        $requestPath = match ($isTest) {
            true => '/fapi/v1/order/test',
            default => '/fapi/v1/order'
        };
        
        return $this->_request($requestPath, 'POST', $orderItem->toArray());
    }
    
    /**
     * 修改订单
     *
     * @link https://developers.binance.com/docs/zh-CN/derivatives/usds-margined-futures/trade/rest-api/Modify-Order
     * @param UpdateOrderReq $req
     * @return array
     * @throws ApiException
     * @throws GuzzleException
     */
    public function updateOrder(UpdateOrderReq $req): array
    {
        return $this->_request('/fapi/v1/order', 'PUT', $req->toArray());
    }
    
    /**
     * 撤销委托单
     *
     * @link https://developers.binance.com/docs/zh-CN/derivatives/usds-margined-futures/trade/rest-api/Cancel-Order
     * @param string $symbol
     * @param string $orderId
     * @return array
     * @throws ApiException
     * @throws GuzzleException
     */
    public function cancelOrder(string $symbol, string $orderId): array
    {
        $params = ['symbol' => $symbol, 'orderId' => $orderId];
        return $this->_request('/fapi/v1/order', 'DELETE', $params);
    }
    
    /**
     * 下单接口
     * @param array<OrderItem> $orders
     * @return array
     * @throws ApiException
     * @throws GuzzleException
     */
    public function batchOrders(array $orders): array
    {
        $batchOrders = array_map(function (OrderItem $item) {
            return $item->toArray();
        }, $orders);
        
        return $this->_request('/fapi/v1/batchOrders', 'post', ['batchOrders' => json_encode($batchOrders)]);
    }
    
    /**
     * 配置币种杠杆
     *
     * @param LeverageReq $req 杠杆请求
     * @return array
     * @throws ApiException
     * @throws GuzzleException
     */
    public function setLeverage(LeverageReq $req): array
    {
        return $this->_request('/fapi/v1/leverage', 'POST', $req->toArray());
    }
    
    /**
     * 返回开单数据
     *
     * @link https://developers.binance.com/docs/zh-CN/derivatives/usds-margined-futures/trade/rest-api/Current-All-Open-Orders
     * @param string $symbol
     * @return array
     * @throws ApiException
     * @throws GuzzleException
     */
    public function getOpenOrders(string $symbol = ''): array
    {
        return $this->_request('/fapi/v1/openOrders', 'GET', ['symbol' => $symbol]);
    }
    
    /**
     * 获取账户成交历史
     *
     * @link https://developers.binance.com/docs/zh-CN/derivatives/usds-margined-futures/trade/rest-api/Account-Trade-List
     * @param TradeHistoryReq $req
     * @return array
     * @throws ApiException
     * @throws GuzzleException
     */
    public function getTradeHistory(TradeHistoryReq $req): array
    {
        return $this->_request('/fapi/v1/userTrades', 'GET', $req->toArray());
    }
}