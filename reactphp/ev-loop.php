<?php


require __DIR__ . './../vendor/autoload.php';

echo "EventLoop Factory  create\n";
$loop = React\EventLoop\Factory::create();


$loop->run();


echo "done\n";
