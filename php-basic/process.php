<?php
/**
 * PHP 命令行输出进度条
 */

$total = 10;
$step = $total / 100;
$current = 0;

for($i=1; $i<=$total; $i++){
    if(intval($i / $step) > $current){
          $current = intval($i / $step);
          echo chr(13);
          echo 'Process: ';
          echo '[' . str_repeat('=', intval($current/2)) . str_repeat('-', 50 - intval($current/2)) . $current . '%]';
          sleep(1);
          flush();
    }
}

echo chr(10) . 'all Done' . chr(10);
