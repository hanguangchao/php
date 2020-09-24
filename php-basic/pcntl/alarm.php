<?php

/**
 * 
pcntl_alarm
(PHP 4 >= 4.3.0, PHP 5, PHP 7)

pcntl_alarm — 为进程设置一个alarm闹钟信号

说明 ¶
pcntl_alarm ( int $seconds ) : int
创建一个计时器，在指定的秒数后向进程发送一个SIGALRM信号。每次对 pcntl_alarm()的调用都会取消之前设置的alarm信号。

参数 ¶
seconds
等待的秒数。如果seconds设置为0,将不会创建alarm信号。

返回值 ¶
返回上次alarm调度（离alarm信号发送）剩余的秒数，或者之前没有alarm调度（译注：或者之前调度已完成） 时返回0。

 */
pcntl_signal(SIGALRM, function () {
    echo 'Received an alarm signal !' . PHP_EOL;
}, false);

pcntl_alarm(5);

while (true) {
    pcntl_signal_dispatch();
    sleep(1);
}

/*
Received an alarm signal !


~ kill -SIGALRM
Received an alarm signal !
