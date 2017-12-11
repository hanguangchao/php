<?php
/*
nginx+swoole配置

server {
    root /data/wwwroot/;
    server_name local.swoole.com;

    location / {
        proxy_http_version 1.1;
        proxy_set_header Connection "keep-alive";
        proxy_set_header X-Real-IP $remote_addr;
        if (!-e $request_filename) {
             proxy_pass http://127.0.0.1:9501;
        }
    }
}
在swoole中通过读取$request->header['x-real-ip']来获取客户端的真实IP

 */
$http = new swoole_http_server('0.0.0.0', 9501);
$http->on('request', function (swoole_http_request $request, swoole_http_response $response) {
    // var_dump($request->get);
    // var_dump($request->post);
    // var_dump($request->cookie);
    // var_dump($request->files);
    // var_dump($request->header);
    // var_dump($request->server);
    $response->end("<h1>Hello Swoole. #".rand(1000, 9999)."</h1>");
});
$http->start();
