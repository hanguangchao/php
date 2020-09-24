<?php


$pid = pcntl_fork();
//父进程和子进程都会执行下面代码
if ($pid == -1) {
    //错误处理：创建子进程失败时返回-1.
     die('could not fork');
} else if ($pid) {
     //父进程会得到子进程号，所以这里是父进程执行的逻辑
     
     echo "parent\n";
} else {
     //子进程得到的$pid为0, 所以这里是子进程执行的逻辑。
     sleep(1);
     echo "child\n";
     exit;
}