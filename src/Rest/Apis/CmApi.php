<?php
/**
 * U本位合约API
 * @author: hsioe1111@gmail.com
 * @date: 2024/12/19
 * @description:
 */

namespace Hsioe\QuantBinance\Rest\Apis;


use GuzzleHttp\Exception\GuzzleException;
use Hsioe\QuantBinance\Exception\ApiException;

class CmApi extends ApiBase
{
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
        return $this->_request('/papi/v1/um/positionSide/dual', 'POST', ['dualSidePosition' => $positionSideDual]);
    }
}