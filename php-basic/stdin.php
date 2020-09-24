<?php

/**
 * PHP语言中"STDIN"用于从控制台读取内容，遇到此常量或者通过fopen()函数打开php://stdin脚本将会等待用户输入内容，直到用户按下回车键提交。
 */
echo "请输入内容:";
$jimmy = fgets(STDIN);
echo sprintf("输入的内容为: %s\n", $jimmy);


$demo = fopen('php://stdin', 'r');
echo "请输入: ";
$test = fread($demo, 12); //最多读取12个字符
echo sprintf("输入为: %s\n", $test);
fclose($demo);



