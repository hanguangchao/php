<?php


$filename = __DIR__ . "/1.txt";
$handle = fopen($filename, "r");
$contents = fread($handle, filesize($filename));
echo $contents . PHP_EOL;
fclose($handle);



$filename = __DIR__ . "/1.txt"; 
$handle = fopen($filename, "r");
stream_set_blocking($handle, 0);
$contents = fread($handle, filesize($filename));
echo $contents . PHP_EOL;
fclose($handle);


$a = 3;
$b = 5;
if ($a = 5 || $b = 7) {
$a++;
$b++;
}
echo $a . " " . $b;