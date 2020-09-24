<?php 

// 写一个多进程处理示例

//启动多进程
//注册信号处理

class Worker 
{

    public function __construct()
    {
        $pid = getmypid();
        self::log($pid . "\t" .__METHOD__);
        return getmypid();
    }

    public static function log($log_msg = '')
    {
        echo sprintf("%s:%s\n", date('Y-m-d H:i:s'), $log_msg);
    }

    public function work()
    {
        self::log(__METHOD__);
        $client = new Swoole\Client(SWOOLE_SOCK_TCP);
        if (!$client->connect('127.0.0.1', 9501, -1)) {
            exit("connect failed. Error: {$client->errCode}\n");
        }
        $client->set(array(
            'open_eof_check' => true,
            'open_eof_split' => true,
            'package_eof' => "\r\n",
        ));

        $a = 0;
        while ($a < 100) {
            $a++;
            # code...
            $client->send("hello world $a\r\n");
            usleep(100000);
            echo $a. PHP_EOL;
        }

        $client->close();
    }
}


$count = getenv('COUNT');
if ($count >= 1) {
    for($i = 0; $i < $count; ++$i) {
        $pid = pcntl_fork();
        if($pid == -1) {
            die("Could not fork worker ".$i."\n");
        }
        // Child, start the worker
        else if(!$pid) {
            $worker = new Worker();
            #fwrite(STDOUT, '*** Starting worker '.$worker."\n");
            $worker->work();
            break;
        }
    }
}