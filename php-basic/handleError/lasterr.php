<?php 

register_shutdown_function('cleanupObjects');
register_shutdown_function('handleFatalPhpError');

function cleanupObjects() {
     trigger_error('An insignificant problem', E_USER_WARNING);
}

function handleFatalPhpError() {
     $last_error = error_get_last();
     if($last_error['type'] === E_ERROR || $last_error['type'] === E_USER_ERROR || $last_error['type'] === E_USER_WARNING) {
         echo "Can do custom output and/or logging for fatal error here...";
     }
}
echo $aa;
trigger_error('Something serious', E_USER_ERROR);


/*
PHP Fatal error:  Something serious in /home/vagrant/Code/GitPro/php/php-basic/handleError/lasterr.php on line 17

Fatal error: Something serious in /home/vagrant/Code/GitPro/php/php-basic/handleError/lasterr.php on line 17
PHP Warning:  An insignificant problem in /home/vagrant/Code/GitPro/php/php-basic/handleError/lasterr.php on line 7

Warning: An insignificant problem in /home/vagrant/Code/GitPro/php/php-basic/handleError/lasterr.php on line 7
Can do custom output and/or logging for fatal error here...%
 */
