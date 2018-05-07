<?php

namespace DesignPatterns\Behavioral\Observer;

class User implements \SplSubject
{
    private $email;
    private $observers;
    
    public function __construct()
    {
        $this->observers = new \SplObjectStorage();
    }

    public function attach(\SplObserver $observer)
    {
        $this->observers->attach($observer); 
    }

    public function detach(\SplObserver $observer) 
    {
        $this->observers->detach($observer);
    }

    public function notify()
    {
        foreach ($this->observers as $observer) {
            $observer->update($this);
        }
    }

    public function changeEmail($email)
    {
        $this->email = $email;
        $this->notify();
    }
}
