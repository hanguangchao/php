<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
/**
 * 多进程
 * daemonize
 */
function daemonize()
{
    $pid = pcntl_fork();
    if (-1 == $pid) {
        throw new Exception("fork进程失败");
    } elseif ($pid != 0) {
        exit(0);
    }
    if (-1 == posix_setsid()) {
        throw new Exception("新建立session会话失败");
    }

    $pid = pcntl_fork();
    if (-1 == $pid) {
        throw new Exception("fork进程失败");
    } else if($pid != 0) {
        exit(0);
    }
    umask(0);
    chdir("/");

    while(true) {
        sleep(1);
    }
}

daemonize();