<?php


$serv = new swoole_server('0.0.0.0', 9505);
$serv->on('connect', function($serv, $fd) {
    var_dump($serv, $fd);
    echo "Client: Connect. \n";
});
$serv->on('receive', function($serv, $fd, $from_id, $data) {
    var_dump(func_num_args());
    $serv->send($fd, "Server: " . $data);
});
$serv->on('close', function($serv, $fd) {
    echo "Client: Close. \n";
});
$serv->start();
