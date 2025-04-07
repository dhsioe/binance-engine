<?php
/**
 * 基本API
 * @author: hsioe1111@gmail.com
 * @date: 2024/8/8
 * @description:
 */

namespace Hsioe\QuantBinance\Rest\Apis;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Hsioe\QuantBinance\BinanceConst;
use Hsioe\QuantBinance\Exception\ApiException;
use Hsioe\QuantBinance\Rest\ApiRequest;

class ApiBase
{
    /**
     * 请求客户端
     * @var Client
     */
    protected Client $httpClient;
    
    /**
     * 请求实例
     * @var ApiRequest
     */
    protected ApiRequest $apiRequest;
    
    /**
     * 构造函数
     * @param ApiRequest $apiRequest
     */
    public function __construct(ApiRequest $apiRequest)
    {
        $this->apiRequest = $apiRequest;
        $this->httpClient = new Client(['timeout' => 5, 'proxy' => $apiRequest->getProxy() ?? '', 'http_errors' => false]);
    }
    
    /**
     * 格式化GET请求参数
     * @param string $requestPath
     * @param array $params
     * @return string
     */
    public static function toGetUrl(string $requestPath, array $params): string
    {
        $url = "?";
        $hasParamsValue = false;
        foreach ($params as $key => $value) {
            if ($value != '') {
                $url .= (string)$key . '=' . (string)$value . '&';
                $hasParamsValue = true;
            }
        }
        
        if (empty($params) || !$hasParamsValue) {
            return $requestPath;
        }
        
        return $requestPath . rtrim($url, '&');
    }
    
    /**
     * 获取IOS格式时间戳
     * @return bool|string
     */
    public function getRequestTime(): bool|string
    {
        return round(microtime(true) * 1000);
    }
    
    /**
     * 获取完整的请求数据接口
     * @param string $uri
     * @return string
     */
    public function getRequestUrl(string $uri): string
    {
        $baseUrl = match ($this->apiRequest->getEnvironment()) {
            2 => BinanceConst::REAL_BASE_REST_API_URL,
            default => BinanceConst::DEV_BASE_REST_API_URL
        };
        
        return sprintf("%s%s", $baseUrl, $uri);
    }
    
    /**
     * 生成签名
     * @param string $url 请求地址
     * @param string $method 请求方法
     * @param string $body 请求内容Json
     * @return string
     */
    public function getSign(string $url, string $method, string $body): string
    {
        return strtoupper(hash_hmac('sha256', $body, $this->apiRequest->getApiSecret()));
    }
    
    /**
     * 生成请求头
     * @return array
     */
    public function getHeader(): array
    {
        $header = [];
        $header['Content-Type'] = 'application/json';
        $header[BinanceConst::RES_API_HEADERS] = $this->apiRequest->getApiKey();
        
        return $header;
    }
    
    /**
     * 构建请求
     * @param string $method
     * @param array $payload
     * @return array|array[]
     */
    public function buildQuery(string $method, array $payload): array
    {
        return match (strtoupper($method)) {
            'POST' => ['json' => $payload],
            'GET' => ['query' => $payload],
            default => []
        };
    }
    
    /**
     * 公共请求
     * @param string $uri
     * @param string $method
     * @param array $payload
     * @return array
     * @throws GuzzleException|ApiException
     */
    public function _request(string $uri, string $method, array $payload = []): array
    {
        
        $payload['timestamp'] = $this->getRequestTime();
        $payload['recvWindow'] = 5000;
        $payload['signature'] = $this->getSign($uri, $method, http_build_query($payload));
        
        $uri = sprintf("%s?%s", $uri, http_build_query($payload));
        $options = [];
        $options['headers'] = $this->getHeader();
        //$options = array_merge($options, $this->buildQuery($method, $payload));
        $response = $this->httpClient->request($method, $this->getRequestUrl($uri), $options);
        $response = json_decode($response->getBody(), true);
        return $this->_checkResults($response);
        
    }
    
    /**
     * 检查结果
     * @param array $response
     * @return array
     * @throws ApiException
     */
    public function _checkResults(array $response): array
    {
        if (isset($response['code']) && $response['code'] != BinanceConst::SUCCESS_CODE) {
            throw new ApiException($response['msg'] ?? "请求失败!");
        }
        
        return $response;
    }
}