<?php 

/**
 * 原地排序
 * 稳定排序
 * O(n^2)
 */
class BubbleSort
{

	public static function sort(array &$arr)
	{
        $length = count($arr);
        // $ii = 0;
		for ($i=0; $i < $length; $i++) {
			$flag = false;
			for ($j=0; $j < $length-$i-1; $j++) {
				echo $i . ':' . $j . PHP_EOL;
				if ($arr[$j] > $arr[$j+1]) {
					$tmp = $arr[$j];
					$arr[$j] = $arr[$j+1];
                    $arr[$j+1] = $tmp;
                    $flag = true;
                }
                //$ii++;
			}
			if (!$flag) break;
        }
	}
}

$arr = [3,44,38,5,47,15,36,26,27,2,46,4,19,50,48,51];
BubbleSort::sort($arr);
print_r($arr);