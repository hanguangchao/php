<?php

use Swoole\Coroutine;
use Swoole\Database\PDOConfig;
use Swoole\Database\PDOPool;
use Swoole\Runtime;


$server = new Swoole\Server('127.0.0.1', 9501);
$server->set(
    [
        'task_worker_num' => 1000,
        'task_enable_coroutine' => true,
        'open_eof_check' => true,
        'open_eof_split' => true,
        'package_eof' => "\r\n",
    ]
);



$config = [
    'host'     => '127.0.0.1',
    'port'     => 3306,
    'user'     => 'root',
    'password' => 'secret',
    'database' => 'test',
];
$pool = new MysqlPool($config);


$server->set([
    // 如开启异步安全重启, 需要在workerExit释放连接池资源

    'reload_async' => true
]);

$server->on('start', function (Swoole\Server $server) {
    var_dump($server->master_pid);
});

// 退出事件

$server->on('workerExit', function (Swoole\Server $server) use ($pool) {
    $pool->destruct();
});

//此回调函数在worker进程中执行
$server->on('receive', function($server, $fd, $from_id, $data) {
    //投递异步任务
    $task_id = $server->task($data);
    #echo "Dispatch AsyncTask: id=$task_id\n";

});


$server->on('task', function ($server, $task) use ($pool) {
    $swoole_mysql = $pool->get();
    
    
    if ($swoole_mysql === false) {
        return;
        $swoole_mysql = $pool->get();
    }
    
    $sql = "select * from user_info limit 1";
    $res = $swoole_mysql->query($sql);
    $pool->put($swoole_mysql);

    #echo "New AsyncTask DONE:[id=]". $task->id . PHP_EOL;
});

$server->on('close', function ($server, $fd) {
    echo "client-{$fd} is closed\n";
    $server->close($fd);
});

$server->start();

// 连接池代码
class MysqlPool
{
    protected $available = true;
    protected $pool;
    protected $config; //mysql服务的配置文件
    protected $min_connection = 5;
    protected $max_connection = 100;
    protected $current_connection = 0;//当前连接数

    public function __construct($config)
    {
        $this->config = $config;
        $this->pool = new SplQueue;
        $this->initPool();

    }

    //https://learnku.com/articles/28112
    public function initPool(){

        go(function ()  {
            for($i=1; $i<=$this->min_connection; $i++){
                $this->pool->push($this->newMysqlClient());
            }
        });
    }

    protected function newMysqlClient()
    {

        if($this->current_connection >= $this->max_connection){
            throw new Exception("链接池已经满了"); 
        }
        $this->current_connection++;
        echo "current_connection:::" . $this->current_connection . PHP_EOL;
        $mysql = new Swoole\Coroutine\Mysql();
        #p($this->config);
        $mysql->connect($this->config); 
        return $mysql;
    }

    public function put($swoole_mysql)
    {
        $this->pool->push($swoole_mysql);
    }

    /** * @return bool|mixed|\Swoole\Coroutine\MySQL */
    public function get()
    {
        //有空闲连接且连接池处于可用状态
        if ($this->available && count($this->pool) > 0) {
            echo ">>>get connection from pool \n";
            return $this->pool->pop();
        }
        echo ">>>create new connection \n";
        //无空闲连接，创建新连接

        $swoole_mysql = new Swoole\Coroutine\MySQL();
        $res = $swoole_mysql->connect($this->config);
        
        if ($res == false) {
            return false;
        } else {
            return $swoole_mysql;
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
