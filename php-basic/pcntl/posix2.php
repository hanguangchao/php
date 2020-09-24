<?php

pcntl_signal(SIGINT,  function($signal) { echo 'SIGINT'; exit();});


while (true) {
    pcntl_signal_dispatch();
}


echo 'before kill.' . PHP_EOL;
$ret = posix_kill(posix_getpid(), SIGINT);
var_dump($ret);
echo '不会执行到这里.' . PHP_EOL ;
