<?php 

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
while ($a < 10000) {
    $a++;
    # code...
    $client->send("hello world $a\r\n");
   
    echo $a. PHP_EOL;
}

$client->close();