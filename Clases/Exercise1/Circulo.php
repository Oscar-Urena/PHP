<?php

require_once  "Point.php";

class Circulo extends Point
{
    public $radio;

    function __construct($r = 10)
    {
        $this->radio = $r;
    }

    function area(): float
    {
        return $this->radio * $this->radio * M_PI;
    }
}