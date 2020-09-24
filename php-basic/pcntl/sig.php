<?php


pcntl_signal(SIGTERM, function($signal) { echo "SIGTERM信号处理";  exit("SIGTERM 退出\n");});
pcntl_signal(SIGINT,  function($signal) { echo 'SIGINT'; exit(2); });
pcntl_signal(SIGQUIT, function($signal) { echo 'SIGQUIT'; exit(3);});
pcntl_signal(SIGUSR1, function($signal) { echo 'SIGUSR1'; exit(4);});
pcntl_signal(SIGUSR2, function($signal) { echo 'SIGUSR2'; exit(5);});
pcntl_signal(SIGCONT, function($signal) { echo 'SIGCONT'; exit(6);});
pcntl_signal(SIGPIPE, function($signal) { echo 'SIGPIPE'; exit(7);});

echo "测试posix_kill";
posix_kill(posix_getpid(), SIGTERM);
// posix_kill(posix_getpid(), SIGINT);

while (true) {
    sleep(1);
    // do something
    pcntl_signal_dispatch(); // 接收到信号时，调用注册的signalHandler()
}