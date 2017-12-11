<?php


$client = new swoole_client(SWOOLE_SOCK_TCP);
if (!$client->connect('192.168.10.10', 8099, 0.5)) {
    throw new Exception('connect failed.');
}

if (!$client->send('hello world')) {
    throw new Exception('send failed.');
}

$data = $client->recv();
$client->close();
echo "client:";
var_dump($data);
