<?php 
/**
 * PHP语言中STDOUT用于向控制台输出标准信息；向此常量、或者向fopen()函数打开的php://stdout写入的内容将直接输出到控制台的标准输出；
 * 标准输出的内容可以用过">"或者"1>"重定向到指定地方，比如文件。
 * 
 * 
 * php stdout.php > 1.txt
 * cat 1.txt
通过STDOUT写入；
通过php://stdout写入；
 */

fwrite(STDOUT, "通过STDOUT写入；\n");

$demo = fopen("php://stdout", "w");
fwrite($demo, "通过php://stdout写入；");
fclose($demo);

