<?php

namespace Tests;
use DesignPatterns\Creational\Singleton\Singleton;

class SingletonTest extends \PHPUnit\Framework\TestCase
{
    public function testUniqueness()
    {
        $firstCall = Singleton::getInstance();
        $secondCall = Singleton::getInstance();
        
        $this->assertInstanceOf(Singleton::class, $firstCall);
        $this->assertSame($firstCall, $secondCall);
    }
    
}
