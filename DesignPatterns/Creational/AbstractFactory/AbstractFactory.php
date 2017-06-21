<?php

abstract class AbstractFactory
{
    abstract public function createText(string $content) : Text;
}
