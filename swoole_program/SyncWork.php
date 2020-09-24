<?php


//创建Server对象，监听 127.0.0.1:9501 端口
$server = new Swoole\Server('127.0.0.1', 9501);
$server->set([
    'task_worker_num' => 4,
    'task_enable_coroutine' => true,
    ]);

//监听连接进入事件
$server->on('Connect', function ($server, $fd) {
    echo "Client: Connect.\n";
});

//监听连接关闭事件
$server->on('Close', function ($server, $fd) {
    echo "Client: Close.\n";
});


//此回调函数在worker进程中执行
$server->on('receive', function($server, $fd, $from_id, $data) {
    //投递异步任务
    $task_id = $server->task($data);
    echo "Dispatch AsyncTask: id=$task_id\n";

});

//处理异步任务(此回调函数在task进程中执行)
$server->on('task', function ($server, $task) {
    echo "New AsyncTask[id=]".PHP_EOL;
    

    Co::create(function() {
        $swoole_mysql = new Swoole\Coroutine\MySQL();
        $swoole_mysql->connect([
            'host' => 'mysql',
            'port' => 3306,
            'user' => 'root',
            'password' => 'secret',
            'database' => 'open_data',
        ]);
        $sql = "show tables";
        $res = $swoole_mysql->query($sql);
        #var_dump($res);
        $swoole_mysql->close();
     });

   
    //返回任务执行的结果
    $task->finish(" -> OK");
});

//处理异步任务的结果(此回调函数在worker进程中执行)
$server->on('finish', function ($server, $task_id, $data) {
    echo "AsyncTask[$task_id] Finish: $data".PHP_EOL;
});


//启动服务器
$server->start(); 

