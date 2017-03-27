<?php

class Class1
{
    public static $ins = null;
    public function __construct()
    {
        $str = str_repeat('.', 1024);
    }


    public static function getInstance()
    {
        if (is_null(self::$ins)) {
            self::$ins = new Class1();
        }
        return self::$ins;
    }
    
}
