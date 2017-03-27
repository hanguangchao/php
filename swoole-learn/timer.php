<?php

/**
 * 设置定时器
 * 只能在CLI模式中使用， 否则会有报错：
 * Fatal error: swoole_timer_tick(): async-io must use in cli environment. in ***.php line **
 */

//每隔2000ms触发一次
swoole_timer_tick(2000, function($timer_id) {
    echo 'swoole_timer_tick';
    var_dump($timer_id);
    error_log($timer_id, 3, '/tmp/tcp.log');
});

//3000ms后执行此函数
swoole_timer_after(3000, function () {
    echo "after 3000ms.\n"
});


$str = "Say ";
$timer_id1 = swoole_timer_tick( 1000 , function($timer_id , $params) use ($str) {
    echo $str . $params;  // 输出“Say Hello”
} , "Hello\n" );

var_dump($timer_id1);
