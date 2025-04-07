<?php
/**
 * 公共链接
 * @author: hsioe1111@gmail.com
 * @date: 2024/8/12
 * @description:
 */

namespace Hsioe\QuantBinance\Websocket;


class PublicWebsocket extends BaseSocket
{
    /**
     * 公共频道
     * @var string
     */
    protected string $channel = 'public';
    
    /**
     * 链接成功回调
     *
     * @param WebsocketConnection $con
     * @return void
     */
    public function onConnect(WebsocketConnection $con): void
    {
        // 订阅频道
        echo "{$con->getTitle()}-{$con->getChannel()}-{$con->id} -> 链接建立!" . PHP_EOL;
        foreach ($this->option['subscribes'] as $subscribe) {
            $this->subscribe(['channel' => $subscribe['channel'], 'params' => $subscribe['params']]);
        }
        
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