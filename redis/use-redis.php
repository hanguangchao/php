<?php

error_reporting(0);
function getRedis($conf = [])
{
    try {
        $conf = [
           ['host' => '127.0.0.1', 'port' => 63790, 'db' => 1]
        ];
        $redis = new \Redis();
        if ($redis->connect($conf[0]['host'], $conf[0]['port'])) {
            $redis->select($conf[0]['db']);
        } else {
            throw new \Exception("Failed to open redis DB connection: " . $conf[0]['host'] . ":" . $conf[0]['port'] );
        }
    } catch (\Exception $e) {
    } 
    
    return $redis;
}

function ping()
{
    try {
        $redis = getRedis();
        if ($redis->ping() == '+PONG') {
            return true;
        } 
    } catch (\Exception $e) {
//        echo $e->getMessage();
       return false; 
    }
    return false; 

}


$re = getRedis();
var_dump($re);
echo '================';
var_dump(ping()); 
echo '================';
$rt = $re->set('a', 'b');
var_dump($rt);
echo 'aaaaa';
