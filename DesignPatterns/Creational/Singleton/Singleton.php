<?php

namespace DesignPatterns\Creational\Singleton;

final class Singleton
{
    private static $instance;

    public static function getInstance(): Singleton
    {
        if (null === self::$instance) {
            self::$instance = new Singleton();
        }
        return self::$instance;
    }

    public function __construct()
    {

    }
}
