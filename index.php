<?php

use function DI\create;
use function DI\get;

define('ROOT_PATH', dirname(__FILE__));

require ROOT_PATH . '/vendor/autoload.php';

class Mailer
{
    public function mail($recipient, $content)
    {
        // send an email to the recipient
    }
}
class UserManager
{
    private $mailer;

    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function register($email, $password)
    {
        // The user just registered, we create his account
        // ...

        // We send him an email to say hello!
        $this->mailer->mail($email, 'Hello and welcome!');
    }
}


interface LoggerInterface 
{
    public function log();
}

class Logger implements LoggerInterface
{
    private $mailer;

    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function log() 
    {
        echo __FILE__;
    }
}

$containerBuilder = new DI\ContainerBuilder();
$containerBuilder->addDefinitions([
    LoggerInterface::class => DI\create(Logger::class),
    
]);
$container = $containerBuilder->build();

$logger = $container->get('Logger');
$logger->log();

