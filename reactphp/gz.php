<?php 


require __DIR__ . './../vendor/autoload.php';


use GuzzleHttp\Client;
use GuzzleHttp\Promise;


$client = new Client();
$response = $client->request('GET', 'http://httpbin.org?foo=bar');

var_dump($response);
