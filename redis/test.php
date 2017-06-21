<?php

try {
    $redis = new Redis(); 
    $t = $redis->connect('127.0.0.1', 63799); 
    var_dump($t);
    //echo "Connection to server sucessfully"; 
    //check whether server is running or not 
    echo "Server is running: ". $redis->ping(); 

} catch (\RedisException $e) { 
 
    echo $e->getMessage();
} catch (Exception $e) { 
    echo $e->getMessage();
}

$val = ['a', 'b', 'c']; 
$val = serialize($val);
$redis->set('hello', $val);
var_dump($redis->get('hello'));


$val = 'abc';
$redis->set('hello', $val);
var_dump($redis->get('hello'));
