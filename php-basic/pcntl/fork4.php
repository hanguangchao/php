<?php
//多进程+信号处理

declare(ticks=1);

pcntl_signal(SIGTERM, function($signal) { echo "SIGTERM信号处理";  exit("SIGTERM 退出\n");});
pcntl_signal(SIGINT,  function($signal) { echo 'SIGINT'; exit(2); });
pcntl_signal(SIGQUIT, function($signal) { echo 'SIGQUIT'; exit(3);});
pcntl_signal(SIGUSR1, function($signal) { echo 'SIGUSR1'; exit(4);});
pcntl_signal(SIGUSR2, function($signal) { echo 'SIGUSR2'; exit(5);});
pcntl_signal(SIGCONT, function($signal) { echo 'SIGCONT'; exit(6);});
pcntl_signal(SIGPIPE, function($signal) { echo 'SIGPIPE'; exit(7);});

// echo "测试posix_kill";
// posix_kill(posix_getpid(), SIGTERM);
// posix_kill(posix_getpid(), SIGINT);



define('FORK_NUMS', 3);
 
$pids = array();
 
for($i = 0; $i < FORK_NUMS; ++$i) {
    $pids[$i] = pcntl_fork();
    if($pids[$i] == -1) {
        die('fork error');
    } else if ($pids[$i]) {
        //pcntl_waitpid
        // WNOHANG	    如果没有子进程退出立刻返回。
        // WUNTRACED	子进程已经退出并且其状态未报告时返回。
        pcntl_waitpid($pids[$i], $status);
        echo "pernet \n";
    } else {
        sleep(5);
        echo "child id:" . getmypid() . " \n";
        exit;
    }
}

// output
// child id:29902 
// pernet 
// child id:29907 
// pernet 
// child id:29908 
// pernet 
pcntl_signal_dispatch(); // 接收到信号时，调用注册的signalHandler()
// while (true) {
//     sleep(1);
//     echo '11111';
//     // do something
//     // pcntl_signal_dispatch(); // 接收到信号时，调用注册的signalHandler()
// }
