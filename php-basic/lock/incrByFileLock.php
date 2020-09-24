<?php 
/**
 * 文件实现计数器
 */

function incrByFileLock($min = 0, $max)
{
    $file = __DIR__ . '/incr.lock';
    $fp = fopen($file, 'rb+');

    /*
    flock ( resource $handle , int $operation [, int &$wouldblock ] ) : bool

    handle
    文件系统指针，是典型地由 fopen() 创建的 resource(资源)。

    operation
    operation 可以是以下值之一：

    LOCK_SH 取得共享锁定（读取的程序）。
    LOCK_EX 取得独占锁定（写入的程序）。
    LOCK_UN 释放锁定（无论共享或独占）。
    如果不希望 flock() 在锁定时堵塞，则是 LOCK_NB（Windows 上还不支持）。

    wouldblock
    如果锁定会堵塞的话（EWOULDBLOCK 错误码情况下），可选的第三个参数会被设置为 TRUE。（Windows 上不支持）
    */
    /* 
    flock($fp, LOCK_EX) 独占锁,阻塞 
    阻塞(等待)模式：并发时，当有第二个用户请求时，会等待第一个用户请求完成、释放锁，获得文件锁之后，程序才会继续运行下去

    flock($fp, LOCK_EX|LOCK_NB) 独占锁,非阻塞
    非阻塞模式：并发时，第一个用户请求，拿得文件锁之后。后面请求的用户直接返回系统繁忙，请稍后再试
    */
    if (! flock($fp, LOCK_EX)) {
        exit("Couldn't get the lock!");
    }
    $num = trim(fread($fp, 8));
    $num++;
    if ($num > $max) {
        $num = $min;
    }
    rewind($fp);
    fwrite($fp, $num, 8);
    fwrite($fp, str_repeat(' ', 5));
    file_put_contents(__DIR__ . '/incr.lock.log', posix_getpid() . "\t" . $num . PHP_EOL, FILE_APPEND | LOCK_EX);
    flock($fp, LOCK_UN);    // release the lock
    fclose($fp);
}

// $i = 100;
// while ($i > 0 ) {
//     incrByFileLock(1, 20);

//     $i--;
// }