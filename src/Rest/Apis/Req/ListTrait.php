<?php
/**
 * 列表特性
 * @author: hsioe1111@gmail.com
 * @date: 2024/12/19
 * @description:
 */

namespace Hsioe\QuantBinance\Rest\Apis\Req;


trait ListTrait
{
    /**
     * 开始时间
     * @var string
     */
    protected string $startTime = '';
    
    /**
     * 结束时间
     * @var string
     */
    protected string $endTime = '';
    
    /**
     * 默认数量
     * @var int
     */
    protected int $limit = 500;
    
    public function setStartTime(string $startTime): void
    {
        $this->startTime = $startTime;
    }
    
    public function getStartTime(): string
    {
        return $this->startTime;
    }
    
    public function setEndTime(string $endTime): void
    {
        $this->endTime = $endTime;
    }
    
    public function getEndTime(): string
    {
        return $this->endTime;
    }
    
    public function setLimit(int $limit): void
    {
        $this->limit = $limit;
    }
    
    public function getLimit(): int
    {
        return $this->limit;
    }
    
}