<?php

$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
var_dump($socket);

#给套接字绑定名字
socket_bind($socket, '0.0.0.0', 8080);

socket_listen($socket, 5);

#


while (true) {
    socket_set_block($socket);
    $clnt_sock = socket_accept($socket); //阻塞

    $st = "hello world ^_^";
    socket_write($clnt_sock, $st,strlen($st));
    
    echo 1 . PHP_EOL;

    $ct = socket_read($clnt_sock, 1024);
    echo $ct . PHP_EOL;

    socket_close($clnt_sock);
}



socket_close($socket);
