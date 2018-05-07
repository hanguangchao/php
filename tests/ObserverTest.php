<?php

namespace Tests;

use DesignPatterns\Behavioral\Observer\UserObserver;
use DesignPatterns\Behavioral\Observer\User;

use PHPUnit\Framework\TestCase;


//./vendor/bin/phpunit   --bootstrap tests/_bootstrap.php tests/ObserverTest.php

class ObserverTest extends TestCase
{
    public function testChangeInUserLeadsToUserObserverBeingNotified()
    {
        $observer = new UserObserver;

        $user = new User();
        $user->attach($observer);
        $user->changeEmail('foo@bar.com');
        $this->assertCount(1, $observer->getChangedUsers());
        

    }
}

