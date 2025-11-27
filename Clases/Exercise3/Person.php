<?php


class Person
{
    private $name;
    private $dni;

    public function __construct($name,$dni){
        $this->name = $name;
        $this->dni = $dni;
    }

    public function getName(){
        return $this->name;
    }
    public function setName($name){
        $this->name = $name;
    }
    public function getDni(){
        return $this->dni;
    }
    public function setDni($dni){
        $this->dni = $dni;
    }
    public function toString(){
        $msg = "Nombre: ".$this->name." DNI: ".$this->dni."\n";
        return $msg;
    }
}