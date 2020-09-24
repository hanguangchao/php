<?php 


/**
 * 调用posix_kill，使用SIGKILL信号，进程会退出
 * 其他信号，如果使用pcntl_signal注册了信号处理程序，依赖处理程序如何进程。在处理逻辑执行完，调用exit();会使进程退出。
 */

echo 'before kill.' . PHP_EOL;
posix_kill(posix_getpid(), SIGKILL);
echo '不会执行到这里.' . PHP_EOL ;
