<?php


class Output
{
    public static function format($class = 'json', $value)
    {   
        $classname = "Output" . ucfirst($class);
        if (class_exists($classname)) {
           return call_user_func([$classname, 'format'], $value);
        }
        return false;
    }
}

class OutputJson
{
    public static function format($value)
    {
        return json_encode($value, JSON_FORCE_OBJECT);
    }
}

class OutputSerialize
{
    public static function format($value)
    {
        return serialize($value);
    }
}

class OutputExport
{
    public static function format($value)
    {
        return var_export($value);
    }
}



$array = [
    'a' => 1,
    'b' => 2,
    'c' => [1, 2, 3],
];

echo Output::format('json', $array);
echo PHP_EOL;
echo Output::format('serialize', $array);
echo PHP_EOL;
echo Output::format('export', $array);
echo PHP_EOL;
