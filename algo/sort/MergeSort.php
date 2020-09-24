<?php

class MergeSort
{
    public static function sort()
    {

    }

    public static function mergeSort(&$arr, $low, $high)
    {
        if ($low < $high) {
            $mid = ($low + $high) / 2;  // base case: low >= high (0 or 1 item)
            self::mergeSort($arr, $low, $mid);
            self::mergeSort($arr, $mid+1, $high);
            self::merge($arr, $low, $mid, $high);
        }
    }

    public static function merge(&$arr, $low, $mid, $high)
    {
        
    }
}