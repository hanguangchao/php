<?php

ProcessOpera("runCode", array(), 8);
 
/**
 * run Code
 */
function runCode($opt = array()) {
   //需要在守护进程中运行的代码
}

/**
 * $func为子进程执行具体事物的函数名称
 * $opt为$func的参数 数组形式
 * $pNum 为fork的子进程数量
 */
function ProcessOpera($func, $opts = array(), $pNum = 1) {
    while(true) {
        $pid = pcntl_fork();
        if($pid == -1) {
            exit("pid fork error");
        }
        if($pid) {
            static $execute = 0;
            $execute++;
            if($execute >= $pNum) {
                pcntl_wait($status);
                $execute--;
            }   
        } else {
            while(true) {
                //somecode
                $func($opts);
                sleep(1);
            }   
            exit(0);
        }   
    }   
}