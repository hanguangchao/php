<?php

require __DIR__ . '/1.php';

if (! function_exists('pcntl_fork')) {
    exit('pcntl_fork undefined.');
}

$ppid = posix_getpid();
$pids = [];
for ($n = 0; $n < 10; $n++) {
    $pid = pcntl_fork();
    if ($pid) {
        // cli_set_process_title("我是父进程,我的进程id是{$ppid}.");
        $pids[] = $pid;
        // pcntl_wait($status);
    } else if (0 == $pid) {
        $cpid = posix_getpid();
        // cli_set_process_title("我是{$ppid}的子进程,我的进程id是{$cpid}.");
        incrByFileLock(1, 20);
    } else {
        exit('fork error');
    }
}

foreach ($pids as $pid1) {
    pcntl_waitpid($pid1, $status);
}