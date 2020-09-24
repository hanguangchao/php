<?php


$queue = new SplQueue();

$queue->enqueue(1);
$queue->enqueue(2);
$queue->enqueue(3);

$d = $queue->dequeue();
var_dump($d);
var_dump($queue->valid()); // false
var_dump(!$queue->isEmpty()); // true
var_dump($queue->count());
print_r($queue);
    
