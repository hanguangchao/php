<?php
$http = new swoole_http_server('0.0.0.0', 9501);

$http->set(array(
    // 'reactor_num' => 2, //reactor thread num
    'worker_num' => 8,    //worker process num
    'dispatch_mode' => 1,
));

//必须在onWorkerStart回调中创建redis/mysql连接
$http->on('workerstart', function($http, $id) {
    try {
        // $redis = new redis;
        // $redis->connect('127.0.0.1', 6379);
        // $http->redis = $redis;

        $dsn = 'mysql:dbname=homestead;host=127.0.0.1';
        $user = 'homestead';
        $password = 'secret';
        $http->db = new \PDO($dsn, $user, $password);
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }
});

$http->on('request', function(swoole_http_request $req, swoole_http_response $res) use($http) {
    $id = 1;
    $stmt = $http->db->prepare('SELECT * FROM  `user` WHERE id = :id');
    $stmt ->bindValue(':id', $id);
    $stmt->execute();
    $user = $stmt->fetch();
    $res->end(var_export($user, true));
    unset($stmt);
});
$http->start();
