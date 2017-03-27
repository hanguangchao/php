<?php

$http = new swoole_http_server('0.0.0.0', 9501);
$http->on('request', function (swoole_http_request $request, swoole_http_response $response) {
    var_dump($request->get);
    var_dump($request->post);
    var_dump($request->cookie);
    var_dump($request->files);
    var_dump($request->header);
    var_dump($request->server);
    $response->end("<h1>Hello Swoole. #".rand(1000, 9999)."</h1>");
});
$http->start();
