<?php

/**
* Numeric
*/
class Numeric
{
    protected $inches;

    public function __construct()
    {
    }

    public function feets()
    {
        return $this->inches * 12; 
    }
}
