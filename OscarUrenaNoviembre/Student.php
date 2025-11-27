<?php

namespace OscarUrenaNoviembre;

class Student
{
    private $firstName;
    private $lastName;
    private $year;
    private $registered_hours;
    private $subjects;
    public function __construct($lastName, $firstName, $year){
        $this->setFirstName($firstName);
        $this->setLastName($lastName);
        $this->setYear($year);
        $this->setRegisteredHours(0);
        $this->subjects = array();
    }

    public function getFirstName(){
        return $this->firstName;
    }
    public function getLastName(){
        return $this->lastName;
    }
    public function getYear(){
        return $this->year;
    }
    public function getRegisteredHours(){
        return $this->registered_hours;
    }
    public function getSubjects()
    {
        return $this->subjects;
    }
    public function setFirstName($firstName){
        $this->firstName = $firstName;
    }
    public function setLastName($lastName){
        $this->lastName = $lastName;
    }
    public function setYear($year){
        $this->year = $year;
    }
    public function setRegisteredHours($registered_hours){
        if($registered_hours>=1000){
            return -1;
        }
        else{
            $this->registered_hours = $registered_hours;
            return 1;
        }
    }
    public function addSubject($subject){
        array_push($this->subjects, $subject);
    }
    public function __toString(){
        return "{$this->getFirstName()} {$this->getLastName()} {$this->getYear()} year";
    }
}