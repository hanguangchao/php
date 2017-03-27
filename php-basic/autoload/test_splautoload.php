<?php
define("CLASS_LIB", dirname(__FILE__) . DIRECTORY_SEPARATOR . 'lib');

set_exception_handler('exception_report');
function __autoload($classname)
{
	$class = CLASS_LIB . DIRECTORY_SEPARATOR . strtolower($classname) . ".php";
	if (file_exists($class)) {
		require $class;
	} else {
		$msg = sprintf("class %s is not exists.", $classname);
		throw new Exception($msg);
	}

}

function exception_report($exception)
{
	$msg = sprintf("exception:%s:%s:%s\n", $exception->getFile(), $exception->getLine(), $exception->getMessage());
	echo $msg; 
}

$class1 = new Class1();
$class2 = new Class2();
$class3 = new Class3();
