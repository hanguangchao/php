<?php


class SearchQuery

{
    public $args_list = [
        'keywords',
        'pubdate',
        'istop',
        'rank',
        'brand',
        'location',
        'Delivery',
        'price',
        'promotion',
    ];
    
    public $query = [];

    public function parser()
    {
        foreach ($_GET as $key => $val) {
            if (in_array($key, $this->args_list)) {
                $method = "set" . upper($key);
                call_user_func([$this, "$method"], $val) 
            }
        }
    }

    public function setKeywords($keywords)
    {
        $this->query['keywords'] = htmlspecialchars(trim($keywords));
    }

    public function setPrice($price)
    {
        $range = implode(':', $price);
        $tihs->query['price'] = ['min' => min($range), 'max' => max($range)];
    }

    public function setIstop($value)
    {
        $this->query['istop'] = intval($value) == 1 ? true : false;
    }



}
