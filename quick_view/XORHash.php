<?php

error_reporting(E_ALL);
ini_set('display_errors', true);

class XORHash
{

    public function encrypt($message)
    {
        $key = mt_rand(10000, 99999);
        $crytxt = '';
        $keylen = strlen($key);
    // 　　 for($i=0;$i<strlen($str);$i++) {
    //         $k = $i % $keylen;
    //  　　　　$crytxt .= $str[$i] ^ $key[$k];
    // 　　 }
        return $crytxt;
    }

    public function decrypt($cipherText)
    {
        return $this->StrToBin2($cipherText) ^ $this->StrToBin2($this->key);
    }

    public function StrToBin2($str)
    {
        //unpack字符
        $vv = [];
        for($i = 0; $i < strlen($str); $i++){
            $temp = unpack('H*', $str[$i]);
            $vv[] = base_convert($temp[1], 16, 2);
            unset($temp);
        }
        return implode('', $vv);
    }


}


// $hash = new XORHash();
// $hash_encrpted = $hash->encrypt("Hello World");
// echo 'hash_encrpted' . PHP_EOL;
// var_dump($hash_encrpted);

// $plainText = $hash->decrypt($hash_encrpted);
// var_dump($plainText);
// exit;
/*
说明 表达式 方向  表达式是否匹配到左侧／右侧结果
肯定顺序环视  (?=RegExp) 向右  True
否定顺序环视  (?!RegExp)      向右      False
肯定逆序环视  (?<=RegExp) 向左      True
否定逆序环视  (?<!RegExp) 向左      False
 */
$str = "hello world # ddd哈 哈 试试😡!!!~ ==--_ ";
//匹配一个字符
//环视表达式
//向左左侧不匹配^（行的开头位置）
//右侧不匹配行尾位置$
//最终会匹配到所有字符
$arr = preg_split('/(?<!^)(?!$)/u', $str);

var_dump($arr);
// 

// function strToHex($str){ 
//         $hex="";
//         for($i=0;$i<strlen($str);$i++)
//         $hex.=dechex(ord($str[$i]));
//         $hex=strtoupper($hex);
//         return $hex;
// }

// function strToBit($str){ 
//         $hex="";
//         for($i=0;$i<strlen($str);$i++)
//         $hex.=dechex(ord($str[$i]));
//         $hex=strtoupper($hex);
//         return $hex;
// }

// function StrToBin($str){
//     //1.列出每个字符
//     $arr = preg_split('/(?<!^)(?!$)/u', $str);
//     //2.unpack字符
    
//     foreach($arr as &$v){
//         $temp = unpack('H*', $v);
//         $v = base_convert($temp[1], 16, 2);
//         unset($temp);
//     }

//     return join(' ',$arr);
// }


// function StrToBin2($str){
//     //unpack字符
//     for($i=0; $i<strlen($str); $i++){
//         $temp = unpack('H*', $str[$i]);
//         $vv[] = base_convert($temp[1], 16, 2);
//         unset($temp);
//     }
//     return implode('', $vv);
// }

// $hash = new XORHash();
// $hash_encrpted = $hash->encrypt("Hello World");
// echo 'hash_encrpted' . PHP_EOL;
// var_dump($hash_encrpted);
// exit;


// echo PHP_EOL;

// $string = pack('a6', 'china');
// var_dump($string); //输出结果: string(6) "china",最后一个字节是不可见的NUL
// echo ord($string[5]); //输出结果: 0(ASCII码中0对应的就是nul)
// for($i=0 ; $i < strlen($string); $i++) {
//     echo ord($string[$i]) . PHP_EOL;
//     echo chr(ord($string[$i])) . PHP_EOL;
// }


// $arr = preg_split('/(?<!^)(?!$)/u', $string);

// print_r($arr);

// var_dump(strToHex("hello"));    //68656C6C6F

// echo PHP_EOL;
// var_dump(StrToBin("hello"));    //"1101000 1100101 1101100 1101100 1101111"

// echo PHP_EOL . 'StrToBin2' . PHP_EOL;
// var_dump(StrToBin2("hello"));    //"1101000 1100101 1101100 1101100 1101111"

// echo PHP_EOL;
// var_dump(StrToBin("哈喽"));    //"1101000 1100101 1101100 1101100 1101111"
// var_dump(StrToBin2("哈喽"));    //"1101000 1100101 1101100 1101100 1101111"
