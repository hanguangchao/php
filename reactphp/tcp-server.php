<?php


require __DIR__ . './../vendor/autoload.php';

use React\EventLoop\Factory;

$loop = Factory::create();

$server = new \React\Socket\TcpServer(8080, $loop);


$server->on('connection', function (\React\Socket\ConnectionInterface $connection) {
    echo 'Plaintext connection from ' . $connection->getRemoteAddress() . PHP_EOL;

    var_dump($connection);
    $connection->write('hello there!' . PHP_EOL);

    $connection->on('data', function($data) use ($connection) {

        $connection->write($data. PHP_EOL);
    });

});

echo 'Listening on ' . $server->getAddress() . PHP_EOL;

$loop->run();
