<?php

class InvalidCallException extends \Exception  {}
class UnknownPropertyException extends \Exception {}

/**
 * 定义一个对象类
 * 实现__get()
 * 实现__set()
 * 赋予一个对象属性读写的能力
 */
abstract class Object
{   
    public function __get($key)
    {   
        $method_name = 'get' . $key;
        if (method_exists($this, $method_name)) {
            return call_user_func([$this, $method_name]);
        } else if (method_exists($this, 'set' . $key)) {
            throw new \InvalidCallException("属性是只写的：" . __class__ . '::' . $key);
        } else {
            throw new \UnknownPropertyException("属性不存在：" . __class__ . '::' . $key);
        }
    }

    public function __set($key, $value)
    {   
        $method_name = 'set' . $key;
        if (method_exists($this, $method_name)) {
            return call_user_func([$this, $method_name], $value);
        } else if (method_exists($this, 'get' . $key)) {
            throw new \InvalidCallException("属性是只读的："  . __class__ . '::' . $key);
        } else {
            throw new \UnknownPropertyException("属性不存在：" . __class__ . '::' . $key);
        }
    }
}


/**
 * Article类
 * title属性，可读写
 * author属性，只读
 * 内部定义私有成员，对外不可见，实现封装
 * 定义getter,setter,设置属性读写，实现封装
 */
class Article extends Object
{

    private $_title;
    private $_author = 'codefine';
    private $_content;

    public function getTitle()
    {
        return $this->_title;
    }

    public function setTitle($title)
    {
        $this->_title = trim($title);
    }

    public function getAuthor()
    {
        return $this->_author;
    }

    public function setContent($value)
    {
        $this->_content = $value;
        var_dump($this->_content);
    }
}

$obj = new Article();

//title 支持读写
$obj->title = '__get __set的使用';
var_dump($obj->title);

//只读
// $obj->author = '修改作者'; //Fatal error: Uncaught InvalidCallException: 属性是只读的：Object::author
var_dump($obj->author);

//只写
$obj->content = '内容属性赋值';
// var_dump($obj->content); // Fatal error: Uncaught InvalidCallException: 属性是只写的：Object::content 

