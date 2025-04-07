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

class AccountApi extends ApiBase
{
    /**
     * 获取账户信息
     *
     * @link https://developers.binance.com/docs/zh-CN/derivatives/usds-margined-futures/account/rest-api/Account-Information-V2
     * @return array
     * @throws GuzzleException
     * @throws ApiException
     */
    public function getAccountInfo(): array
    {
        return $this->_request('/fapi/v2/account', 'GET');
    }
    
    /**
     * 获取账户余额
     *
     * https://developers.binance.com/docs/zh-CN/derivatives/usds-margined-futures/account/rest-api/Futures-Account-Balance-V3
     * @return array
     * @throws ApiException
     * @throws GuzzleException
     */
    public function getAccountBalance(): array
    {
        return $this->_request('/fapi/v3/balance', 'GET');
    }
    
    /**
     * 查询账户配置
     * @return array
     * @throws ApiException
     * @throws GuzzleException
     */
    public function getAccountConfig(): array
    {
        return $this->_request('/fapi/v1/accountConfig', 'GET');
    }
    
    /**
     * 获取交易对配置
     * @return array
     * @throws ApiException
     * @throws GuzzleException
     */
    public function getSymbolConfig(): array
    {
        return $this->_request('/fapi/v1/symbolConfig', 'GET');
    }
    
    /**
     * 获取账户持仓模式
     *
     * @link https://developers.binance.com/docs/zh-CN/derivatives/usds-margined-futures/account/rest-api/Get-Current-Position-Mode
     * @return array
     * @throws ApiException
     * @throws GuzzleException
     */
    public function getPositionDual(): array
    {
        return $this->_request('/fapi/v1/positionSide/dual', 'GET');
    }
    
    /**
     * 设置持仓模式
     * @param bool $dualSidePosition true-双向 false-单向
     * @return array
     * @throws GuzzleException
     * @throws ApiException
     */
    public function setPositionDual(bool $dualSidePosition): array
    {
        $positionSideDual = match ($dualSidePosition) {
            true => 'true',
            default => 'false'
        };
        return $this->_request('/fapi/v1/positionSide/dual', 'POST', ['dualSidePosition' => $positionSideDual]);
    }
    
    /**
     * 获取监听数据
     * @param bool $isUpdate
     * @return array
     * @throws ApiException
     * @throws GuzzleException
     */
    public function doRefreshListenKey(bool $isUpdate = false): array
    {
        $method = match ($isUpdate) {
            true => 'PUT',
            default => 'POST'
        };
        return $this->_request('/fapi/v1/listenKey', $method);
    }
    
}