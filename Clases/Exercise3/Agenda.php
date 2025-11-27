<?php

require_once "./Person.php";

class Agenda
{
    private $people;

    public function __construct(){
        $this->people = [];
    }
    public function getPeople(){
        return $this->people;
    }
    public function addPerson($p){
        array_push($this->people, $p);
    }
    public function deletePerson($p){
        $indice = array_search($p, $this->people);
        if($indice !== false){
            array_splice($this->people, $indice, 1);
            return true;
        }
        else{
            return false;
        }
    }
    public function _toString(){
        $msg ="";
        foreach($this->people as $p){
            $msg .= $p->toString()."\n";
        }
    }
    public function searchPerson($dni){
        $indice = array_search($dni, $this->people);
        if($indice !== false){
            return $this->people[$indice];
        }
        else return null;
    }
    public function isPerson($dni){
        $indice = array_search($dni, $this->people);
        if($indice !== false){
            return true;
        }
        else{
            return false;
        }
    }
}