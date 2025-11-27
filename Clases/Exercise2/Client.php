<?php

namespace Exercise2;

class Client
{
    private $nombre;
    private $dni;
    private $cuentas;

    public function __construct($nombre, $dni)
    {
        $this->cuentas = array();
        $this->nombre = $nombre;
        $this->dni = $dni;
    }

    public function getNombre(){
        return $this->nombre;
    }
    public function getDni(){
        return $this->dni;
    }
    public function getCuentas(){
        return $this->cuentas;
    }
    public function addCuenta($cuenta){
        $this->cuentas[] += $cuenta;
    }
}