<?php

namespace DesignPatterns\Creational\Prototype;

abstract class BookPrototype
{
    protected $title;

    protected $category;

    public function getTitle($title) : string
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }
}
