<?php

//定义进程数量
define('FORK_NUMS', 5);
 
//用于保存进程pid
$pids = array();
 
//我们创建5个子进程
for ($i = 0; $i < FORK_NUMS; ++$i) {
    $pids[$i] = pcntl_fork();
    if ($pids[$i] == -1) {
        die('fork error');
    } else if ($pids[$i]) {
        //
        echo "\nparent\n";
    } else {
        //这里是子进程空间
        echo "父进程ID: ", posix_getppid(), " 进程ID : ", posix_getpid(), " {$i} \r\n";
        //我们让子进程等待3秒，再退出
        sleep(3);
        exit;
    }
}
 
//我们把pcntl_waitpid放到for循环外面，那样在for循环里创建子进程就不会阻塞了
//但是在这里仍会阻塞，主进程要等待5个子进程都退出后，才退出。
foreach ($pids as $pid) {
    pcntl_waitpid($pid, $status);
}

echo "===========\n";