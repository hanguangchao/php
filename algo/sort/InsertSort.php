<?php

class InsertSort
{
    public static function sort(&$arr)
    {
        //将第一个元素标记为已排序
        //遍历每个没有排序过的元素
        for ($i=1; $i < count($arr); $i++) {
            $x = $arr[$i];
            $j = $i - 1;
            // i = 最后排序过元素的指数 到 0 的遍历
            // 如果现在排序过的元素 > 提取的元素
            // 将排序过的元素向右移一格
            // 否则：插入提取的元素
            for ($j; $j>=0; $j--) {
                echo $i . ':' . $j . PHP_EOL;
                if ($arr[$j] > $x ) {
                    $arr[$j+1] = $arr[$j];  // 数据移动
                } else {
                break;
                }
            }
            $arr[$j+1] = $x;    // 插入数据
        }

    }
}

$arr = [3,44,38,5,47,15,36,26,27,2,46,4,19,50,48,51];
InsertSort::sort($arr);
print_r($arr);