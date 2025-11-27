<?php

require_once "Point.php";
class Rectangulo extends Point
{
    public $origen;
    public $base;
    public $altura;

    function __construct($b = 10, $h = 10)
    {
        $this->base = $b;
        $this->altura = $h;
    }

    function area()
    {
        return $this->base * $this->altura;
    }
}