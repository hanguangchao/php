<?php


/**
 * umask ([ int $mask ] ) : int
 * umask() 将 PHP 的 umask 设定为 mask & 0777 并返回原来的 umask。
 * 当 PHP 被作为服务器模块使用时，在每个请求结束后 umask 会被恢复。
 * 无参数调用 umask() 会返回当前的 umask，有参数则返回原来的 umask。
 */
$ret1 = umask();
$ret2 = umask(0);   
var_dump($ret1, $ret2);