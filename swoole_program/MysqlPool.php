<?php 

class MysqlPool
{
    protected $available = true;
    public $pool;
    protected $config; //mysql服务的配置文件
    protected $max_connection = 50;//连接池最大连接 
    protected $min_connection = 20;
    protected $current_connection = 0;//当前连接数

    public function __construct($config)
    {
        $this->config = $config;
        $this->pool   = new SplQueue;
        $this->initPool();
    }
    public function initPool(){
        go(function () {
            for($i=1;$i<=$this->min_connection;$i++){
                $this->pool->push($this->newMysqlClient());
            }
        });
    }
    public function put($mysql)
    {
        $this->pool->push($mysql);
    }

    /**
     * @return bool|mixed|\Swoole\Coroutine\Mysql
     */
    public function get()
    {
        var_dump($this->pool->count());
        //有空闲连接且连接池处于可用状态
        if ($this->available && $this->pool->count() > 0) {
            echo "####";
            return $this->pool->pop();
        }

        //无空闲连接，创建新连接
        $mysql = $this->newMysqlClient();
        if ($mysql == false) {
            return false;
        } else {
            return $mysql;
        }
    }

    protected function newMysqlClient()
    {

        if($this->current_connection >= $this->max_connection){
            throw new Exception("链接池已经满了"); 
        }
        $this->current_connection++;
        echo $this->current_connection . PHP_EOL;
        $mysql = new Swoole\Coroutine\Mysql();
        $mysql->connect($this->config); 
        return $mysql;
    }

    public function destruct()
    {
        // 连接池销毁, 置不可用状态, 防止新的客户端进入常驻连接池, 导致服务器无法平滑退出
        $this->available = false;
        while (!$this->pool->isEmpty()) {
            go(function(){
                $mysql = $this->pool->pop();
                $mysql->close();
            });
        }
    }

    public function __destruct(){
        $this->destruct();
    }
}

$config = array(
            'host' => '127.0.0.1',
            'user' => 'root',
            'password' => 'secret',
            'database' => 'test',
            'port' => '3306',
        );

// $pool = new MysqlPool($config);


go(function()use($config){ 
    $pool = new MysqlPool($config);
    defer(function () use ($pool) { //用于资源的释放, 会在协程关闭之前(即协程函数执行完毕时)进行调用, 就算抛出了异常, 已注册的defer也会被执行.
        echo "Closing connection pool\n";
        $pool->destruct();
    });
    for($i=0;$i<2;$i++){
        go(function ()use($pool) {
            $mysql = $pool->get();
            $result = $mysql->query('select * from user_info limit 1');
            var_dump($result);
            $pool->put($mysql);
        });
    }
    //var_dump($pool);
});





// //每个子进程创建一个mysql连接
// go(function()use($pool,$config){
//     $chan = new chan(10);
//     for($i=0;$i<2;$i++){
//         go(function()use($pool,$chan,$config){
//             $mysql = new \Swoole\Coroutine\Mysql();
//             $mysql->connect($config); 
//             $result = $mysql->query('select * from users limit 1');
//             $chan->push($result);
//             $mysql->close();
//         });
//     }

//     for($i=0;$i<2;$i++){
//         dump($chan->pop());//这个pop()如果遇到空会yield,直到子协程的push()数据之后才会重新唤醒
//     }

// });
// //使用连接池
// go(function()use($config){
//     $pool = new MysqlPool($config);
//     defer(function () use ($pool) { //用于资源的释放, 会在协程关闭之前(即协程函数执行完毕时)进行调用, 就算抛出了异常, 已注册的defer也会被执行.
//         echo "Closing connection pool\n";
//         $pool->destruct();
//     });
//     $chan = new chan(10);
//     for($i=0;$i<2;$i++){
//         go(function()use($pool,$chan,$config){
//             $mysql = $pool->get();
//             $result = $mysql->query('select * from users limit 1');
//             $chan->push($result);
//             $pool->put($mysql);
//         });
//     }
//     for($i=0;$i<2;$i++){
//         dump($chan->pop());//这个pop()如果遇到空会yield,直到子协程的push()数据之后才会重新唤醒
//     }
// });

// ————————————————
// 原文作者：yujiarong
// 转自链接：https://learnku.com/articles/28112
// 版权声明：著作权归作者所有。商业转载请联系作者获得授权，非商业转载请保留以上作者信息和原文链接。
