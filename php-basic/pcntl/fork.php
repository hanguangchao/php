<?php

if (! function_exists('pcntl_fork')) die('PCNTL functions not available on this PHP installation');

// $pid = pcntl_fork();
// //父进程和子进程都会执行下面代码
// if ($pid == -1) {
//     //错误处理：创建子进程失败时返回-1.
//      die('could not fork');
// } else if ($pid) {
//      //父进程会得到子进程号，所以这里是父进程执行的逻辑
//      pcntl_wait($status); //等待子进程中断，防止子进程成为僵尸进程。
// } else {
//      //子进程得到的$pid为0, 所以这里是子进程执行的逻辑。
// }

// $pid = pcntl_fork();
// if( $pid == -1 ){
//     exit("fork error");
// }
// if( $pid == 0 ){
//     //子进程执行pcntl_fork的时候，pid总是0，并且不会再fork出新的进程
//     echo "child process{$pid}\n";
// }else{
//     //父进程fork之后，返回的就是子进程的pid号，pid不为0
//     echo "parent process{$pid}\n";
// }


for ($x = 0; $x < 2; $x++) {
    $pid = pcntl_fork();
    if( $pid == -1 ){
        exit("fork error");
    }
    if( $pid == 0 ){
        $p = "child process";
        fwrite(STDOUT, "child process:$pid\n");
    } else {
        pcntl_wait($status);
        $pid=pcntl_fork();
        fwrite(STDOUT, "pcntl_wait:$status\n");
        $p = "parent process";
        fwrite(STDOUT, "parent process:$pid\n");
    }
    work($pid, $p);
    
    
}

function work($pid, $p)
{
    while(true) {
        fwrite(STDOUT,  "\n\n" . $p . "\tpid:" . $pid . "\tgetmypid:" . getmypid() . "\t\tworking \n\n");
        sleep(3);
    }
}

// for ($x = 1; $x < 5; $x++) {
//    switch ($pid = pcntl_fork()) {
        
    //   case -1:
    //      // @fail
    //      die('Fork failed');
    //      break;

    //   case 0:
    //      // @child: Include() misbehaving code here
    //      print "FORK: Child #{$x} preparing to nuke...\n";
    //      ///generate_fatal_error(); // Undefined function
    //      break;

    //   default:
    //      // @parent
    //      print "FORK: Parent, letting the child run amok...\n";
    //      pcntl_waitpid($pid, $status);
    //      break;
//    }
// }

// print "Done! :^)\n\n";