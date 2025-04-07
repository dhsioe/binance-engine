<?php
/**
 * OkxSocket基类
 * @author: hsioe1111@gmail.com
 * @date: 2024/8/13
 * @description:
 */

namespace Hsioe\QuantBinance\Websocket;

use Hsioe\QuantBinance\Websocket\Constract\WebsocketAbstract;
use Workerman\Timer;

class BaseSocket implements WebsocketAbstract
{
    /**
     * 链接标题
     * @var string
     */
    protected string $title;
    
    /**
     * 链接平道
     * @var string
     */
    protected string $channel = 'public';
    
    /**
     * 链接选项(除了这两项还可以自定义)
     *    - ping_interval ping的时间间隔
     *    - wss_url 链接地址
     * @var array
     */
    protected array $option = [];
    
    
    protected bool $isConnected = false;
    
    /**
     * 链接工厂
     * @var WebsocketFactory
     */
    protected WebsocketFactory $factory;
    
    /**
     * 构造函数
     * @throws \Exception
     */
    public function __construct(string $title, array $option = [])
    {
        $this->title = $title;
        $this->option = $option;
        $this->initSocketFactory();
        $this->startPing();
    }
    
    /**
     * 获取SocketFactory
     * @return WebsocketFactory
     */
    public function getFactory(): WebsocketFactory
    {
        return $this->factory;
    }
    
    /**
     * 初始化socket
     * @throws \Exception
     */
    public function initSocketFactory(): void
    {
        $this->factory = new WebsocketFactory($this->option['wss_url'], $this->option['ping_interval'], $this->option['proxy'] ?? null);
        $this->factory->getWebsocket()->setLastPongTime(0);
        $this->factory->getWebsocket()->setAlreadyRunTs(0);
        $this->factory->getWebsocket()->setTitle($this->title);
        $this->factory->getWebsocket()->setChannel($this->channel);
    }
    
    /**
     * 启动链接进程
     * @return void
     */
    public function start(): void
    {
        $websocket = $this->factory->getWebsocket();
        
        // 链接成功
        $websocket->onConnect = function (WebsocketConnection $con) {
            $con->setConnectStatus(true);
            $this->onConnect($con);
        };
        
        // 链接关闭
        $websocket->onClose = function (WebsocketConnection $con) {
            $con->setConnectStatus(false);
            $this->onClose($con);
        };
        
        // 链接错误
        $websocket->onError = function (WebsocketConnection $connection, $code, $msg) {
            echo "error $code $msg\n";
        };
        
        // 收到消息
        $websocket->onMessage = function (WebsocketConnection $con, $message) {
            $this->onMessage($con, $message);
        };
        
        $this->factory->connect();
    }
    
    /**
     * 订阅频道消息
     *
     * @param array $params
     * @return void
     */
    public function subscribe(array $params): void
    {
        $this->factory->getWebsocket()->send(json_encode([
            'id' => $this->factory->getWebsocket()->id,
            'method' => $params['channel'],
            'params' => $params['params']
        ]));
    }
    
    /**
     * 取消订阅频道消息
     *
     * @param array $params
     * @return void
     */
    public function unSubscribe(array $params): void
    {
        $this->factory->getWebsocket()->send(json_encode([
            'op' => 'unsubscribe',
            'args' => $params
        ]));
    }
    
    /**
     * 重连
     * @throws \Exception
     */
    public function reconnect(): void
    {
        $this->initSocketFactory();
        $this->start();
    }
    
    /**
     * 长链接消息回调
     * @param WebsocketConnection $con
     * @param string $message
     * @return void
     * @throws \Exception
     */
    public function onMessage(WebsocketConnection $con, string $message): void
    {
        switch ($message) {
            case 'pong':
                $this->factory->getWebsocket()->setLastPongTime(time());
                break;
            default:
                try {
                    $this->factory->getWebsocket()->setLastMsgTime(time());
                    $respMsg = json_decode($message, true);
                    $this->onHandleMessage($respMsg);
                    break;
                } catch (\Throwable $e) {
                    echo "{$con->getTitle()}-{$con->getChannel()} onMessage Error:" . $e->getMessage() . "|Err:" . $message . PHP_EOL;
                    $this->factory->close();
                }
        }
    }
    
    /**
     * 下层需要重写的方法处理消息
     * @param array $message
     * @return void
     */
    public function onHandleMessage(array $message): void
    {
        // TODO: Implement onHandleMessage method.
    }
    
    /**
     * 链接成功回调
     * @param WebsocketConnection $con
     * @return void
     */
    public function onConnect(WebsocketConnection $con): void
    {
        // TODO: Implement onConnect method.
    }
    
    
    /**
     * 链接断开回调
     * @throws \Exception
     */
    public function onClose(WebsocketConnection $con): void
    {
        echo "{$con->getTitle()}-{$con->getChannel()}-{$con->id}-> 连接断开正在重连,最后pong时间:{$con->getLastPongTime()}" . PHP_EOL;
        sleep(2);
        $this->reconnect();
    }
    
    /**
     * 发送Ping
     * @return void
     */
    public function startPing(): void
    {
        Timer::add($this->option['ping_interval'], function () {
            try {
                if ($this->getFactory()->getWebsocket()->isConnectStatus()) {
                    echo "{$this->factory->getWebsocket()->getTitle()}-{$this->factory->getWebsocket()->id}-发送ping:" . date("Y-m-d H:i:s", time()) . PHP_EOL;
                    $this->factory->getWebsocket()->incrAlreadyRunTs($this->option['ping_interval']);
                }
            } catch (\Throwable $e) {
                echo $e->getMessage();
            } finally {
                $this->checkStatus();
            }
        });
    }
    
    public function checkPongTimeOut(): bool
    {
        return time() - $this->factory->getWebsocket()->getLastMsgTime() > 2 * $this->option['ping_interval'];
    }
    
    /**
     * 是否启动超过2个ping的间隔
     *
     * @return bool
     */
    public function startOver2PingTimes(): bool
    {
        return $this->factory->getWebsocket()->getAlreadyRunTs() > 2 * $this->option['ping_interval'];
    }
    
    /**
     * 检查链接状态
     * @return void
     * @throws \Exception
     */
    public function checkStatus(): void
    {
        if (!$this->getFactory()->getWebsocket()->isConnectStatus()) {
            $this->getFactory()->close();
            return;
        }
        
        if (!$this->startOver2PingTimes()) {
            // 两个ping后开始检查
            return;
        }
    }
}