<?php
$mem1 = memory_get_usage();
require '1.php';
require '2.php';

$mem2 = memory_get_usage();

echo sprintf("memory cost %s bytes." , $mem2 - $mem1);
