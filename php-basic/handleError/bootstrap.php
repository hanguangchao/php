<?php


register_shutdown_function('myphp_shutdown');

require dirname(__FILE__)  . '/phperr.php';

function myphp_shutdown()
{
    error_log('php script shutdown.....', 3, '/tmp/myphp.log');
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


