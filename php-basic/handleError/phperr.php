<?php

/**
 * PHP中错误处理
 *
 */

error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', true);
set_error_handler('myerror_handler');

function myerror_handler($errno, $errstr, $errfile, $errline)
{
    echo sprintf("errorno:%d\n", $errno);
    switch ($errno) {
        case E_ERROR:
        case E_USER_ERROR:
        echo "<b>My ERROR</b> [$errno] $errstr<br />\n";
        echo "  Fatal error on line $errline in file $errfile";
        echo ", PHP " . PHP_VERSION . " (" . PHP_OS . ")<br />\n";
        echo "Aborting...<br />\n";
        break;

    case E_WARNING:
    case E_USER_WARNING:
        echo "<b>My WARNING</b> [$errno] $errstr<br />\n";
        break;

    case E_NOTICE:
    case E_USER_NOTICE:
        echo "<b>My NOTICE</b> [$errno] $errstr<br />\n";
        break;

    default:
        echo "Unknown error type: [$errno] $errstr<br />\n";
        break; 
   
   } 
    // 记录错误日志
    error_log(var_export(func_get_args(), true) . PHP_EOL, 3, '/tmp/php_error.log');
}


//test 

echo 1 / 0;
/* output:
Unknown error type: [2] Division by zero<br />
*/

echo $i;
//  产生一个用户级别的 error/warning/notice 信息
trigger_error("Cannot divide by zero", E_USER_ERROR);
trigger_error("trigger a user warning", E_USER_WARNING);


