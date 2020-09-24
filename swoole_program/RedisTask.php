<?php

$server = new swoole_websocket_server("0.0.0.0", 9502); 
$pool = new RedisPool();

$server->set([
    // 如开启异步安全重启, 需要在workerExit释放连接池资源

    'reload_async' => true
]);

$server->on('start', function (swoole_http_server $server) {
    var_dump($server->master_pid);
});

// 退出事件

$server->on('workerExit', function (swoole_http_server $server) use ($pool) {
    $pool->destruct();
});

$server->on('open', function ($server, $request) use ($pool) {
    $userId = $request->get['user_id'];
    // redis 连接池
    
    $redis = $pool->get();
    
    if ($redis === false) {
        $server->push($request->fd, "redis error;\n");
        return;
    }

    $list = 'user_' . $userId . '_messages';
    echo $list;
    while (true) {
        // brpop 第二个参数 50 表示超时（阻塞等待）时间, blpop 同理，详情建议读文档,对应的 redis 操作是 rpush/lpush key content
        
        if (($message = $redis->brpop($list, 50)) === null) {
            continue;
        }
        // var_dump($message); // 结果为数组
        
        $server->push($request->fd, 'redis 的 ' . $message[0] . ' 队列发送消息:' . $message[1]);
    }

    $server->push($request->fd, "hello;\n");
});


$server->on('message', function (swoole_websocket_server $server, $request) {
    $server->push($request->fd, "hello");
});

$server->on('close', function ($server, $fd) {
    echo "client-{$fd} is closed\n";
    $server->close($fd);
});

$server->start();

// 连接池代码

class RedisPool
{
    protected $available = true;
    protected $pool;

    public function __construct()
    {
        $this->pool = new SplQueue;
    }

    public function put($redis)
    {
        $this->pool->push($redis);
    }

    /** * @return bool|mixed|\Swoole\Coroutine\Redis */
    public function get()
    {
        //有空闲连接且连接池处于可用状态
        
        if ($this->available && count($this->pool) > 0) {
            return $this->pool->pop();
        }

        //无空闲连接，创建新连接
        
        $redis = new Swoole\Coroutine\Redis();
        $res = $redis->connect('127.0.0.1', 6379);
        if ($res == false) {
            return false;
        } else {
            return $redis;
        }
    }

    public function destruct()
    {
        // 连接池销毁, 置不可用状态, 防止新的客户端进入常驻连接池, 导致服务器无法平滑退出
        
        $this->available = false;
        while (!$this->pool->isEmpty()) {
            $this->pool->pop();
        }
    }
}
