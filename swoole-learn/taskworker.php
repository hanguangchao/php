<?php
/**
 * 执行异步任务
 * @var swoole_server
 */
$serv = new swoole_server('0.0.0.0', 9505);
$serv->set([
    'task_worker_num' => 4,
]);

$serv->on('receive', function($serv, $fd, $from_id, $data) {
    $task_id = $serv->task($data);
    echo "Dispath AsyncTask: id=$task_id \n";
    var_dump($fd);
    $serv->send($fd, "Server: " . $data);
});

$serv->on('task', function($serv, $task_id, $from_id, $data) {
    echo "New AsyncTask[id=$task_id]" . PHP_EOL;
    $serv->finish("$data -> OK");
});

$serv->on('finish', function($serv, $task_id, $data) {
    echo "AsyncTask[$task_id] Finish: $data" . PHP_EOL;
});

$serv->start();
