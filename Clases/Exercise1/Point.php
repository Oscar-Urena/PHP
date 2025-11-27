<?php

class Point
{
    public $x;
    public $y;

    function __construct($x, $y){
        $this->x = $x;
        $this->y = $y;
    }

    function movePoint($mx, $my){
        $testigo = true;
        if($mx + $this->x >= 0){
            $this->x = $mx + $this->x;
        }
        else
            $testigo = false;
        if($my - $this->y >= 0){
            $this->y = $my - $this->y;
        }
        else
            $testigo = false;

        return $testigo;
    }
}