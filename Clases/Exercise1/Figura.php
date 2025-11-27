<?php

require_once "Point.php";
abstract class Figura extends Point
{
    abstract function area();
}