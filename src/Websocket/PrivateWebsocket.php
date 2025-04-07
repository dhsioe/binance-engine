<?php
/**
 * 公共链接
 * @author: hsioe1111@gmail.com
 * @date: 2024/8/12
 * @description:
 */

namespace Hsioe\QuantBinance\Websocket;


class PrivateWebsocket extends BaseSocket
{
    /**
     * 公共频道
     * @var string
     */
    protected string $channel = 'private';
    
    
    /**
     * 链接成功回调
     *
     * @param WebsocketConnection $con
     * @return void
     */
    public function onConnect(WebsocketConnection $con): void
    {
        echo $con->getTitle() . "| 链接成功!" . PHP_EOL;
    }
    
    /**
     * 收到消息事件
     * @param array $message
     * @return void
     */
    public function onHandleMessage(array $message): void
    {
        echo "{$this->factory->getWebsocket()->getTitle()}-收到消息:" . json_encode($message) . PHP_EOL;
    }
}