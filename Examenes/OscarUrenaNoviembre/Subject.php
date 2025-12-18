<?php

namespace OscarUrenaNoviembre;

class Subject
{
    private $name;
    private $year;
    private $hours;

    public function __construct($name, $year, $hours){
        $this->setName($name);
        $this->setYear($year);
        $this->setHours($hours);
    }
    public function getName(){
        return $this->name;
    }
    public function getYear(){
        return $this->year;
    }
    public function getHours(){
        return $this->hours;
    }
    public function setName($name){
        $this->name = $name;
    }
    public function setYear($year){
        $this->year = $year;
    }
    public function setHours($hours){
        $this->hours = $hours;
    }
    public function __toString(){
        return "{$this->getName()} {$this->getYear()} {$this->getHours()}";
    }
}