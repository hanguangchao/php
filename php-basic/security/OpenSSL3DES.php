<?php
 
class OpenSSL3DES
{
    
    /*密钥,22个字符*/
    const KEY='i3YqBtKKc74a22zkPf8CFELW';
    /*向量，8个或10个字符*/
    const IV='24092111';
 
    /**
     * 加密
     * @param boolean $status 是否加密
     * @return string 处理过的数据
     */
    public static function encrypt($data,$status=false){
        if ($status){
            return base64_encode(openssl_encrypt($data, 'des-ede3-cbc', self::KEY, OPENSSL_RAW_DATA, self::IV));
        }
       return $data;
    }
 
    /**
     * 解密
     * @return string 加密的字符串不是完整的会返回空字符串值
     */
    public static function decrypt($data,$status=false){
        if ($status){
            return openssl_decrypt(base64_decode($data), 'des-ede3-cbc', self::KEY, OPENSSL_RAW_DATA, self::IV);
        }
        return $data;
    }
}



$en=OpenSSL3DES::encrypt('csdn中文s——ss©️📈😊',true);
$de=OpenSSL3DES::decrypt($en,true);
return var_dump($en.' >> '.$de);
