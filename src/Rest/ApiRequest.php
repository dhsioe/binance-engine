<?php
/**
 * 请求实例
 * @author: hsioe1111@gmail.com
 * @date: 2024/8/8
 * @description:
 */

namespace Hsioe\QuantBinance\Rest;


class ApiRequest
{
    /**
     * APIKEY
     * @var string
     */
    protected string $apiKey = '';
    
    /**
     * APISECRET
     * @var string
     */
    protected string $apiSecret = '';
    
    /**
     * API秘钥
     * @var string
     */
    protected string $passphrase = '';
    
    /**
     * 测试环境
     * @var int
     */
    protected int $environment = 0;
    
    /**
     * 代理数据
     * @var string
     */
    protected string $proxy = '';
    
    public function __construct(array $data)
    {
        foreach ($data as $key => $val) {
            if (property_exists(self::class, $key)) {
                $this->{$key} = $val;
            }
        }
    }
    
    public function getApiKey(): string
    {
        return $this->apiKey;
    }
    
    public function setApiKey(string $apiKey): void
    {
        $this->apiKey = $apiKey;
    }
    
    public function getApiSecret(): string
    {
        return $this->apiSecret;
    }
    
    public function setApiSecret(string $apiSecret): void
    {
        $this->apiSecret = $apiSecret;
    }
    
    public function getPassphrase(): string
    {
        return $this->passphrase;
    }
    
    public function setPassphrase(string $passphrase): void
    {
        $this->passphrase = $passphrase;
    }
    
    public function getEnvironment(): int
    {
        return $this->environment;
    }
    
    public function setEnvironment(int $environment): void
    {
        $this->environment = $environment;
    }
    
    public function setProxy(string $proxy): void
    {
        $this->proxy = $proxy;
    }
    
    public function getProxy(): string
    {
        return $this->proxy;
    }
}