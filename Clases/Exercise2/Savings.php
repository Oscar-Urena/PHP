<?php

namespace Exercise2;
require_once './Account.php';
class Savings extends Account
{
    private $minimo;
    function __construct($_anualInterestRate, $minimo){
        parent::__construct($_anualInterestRate);
        $this->minimo = $minimo;
    }

    function calculateInterest()
    {
        if($this->minimo > parent::getBalance()){
            $this->deposit(parent::getBalance() * parent::getAnualInterestRate() * 2);
        }
        else{
            $this->deposit(parent::getBalance() * (parent::getAnualInterestRate() / 2));
        }
    }
}