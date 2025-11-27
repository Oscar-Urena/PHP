<?php

namespace Exercise2;

abstract class Account
{
    public static $cuentas;
    private $nCuenta;
    private $anualInterestRate;
    private $balance;

    function __construct($_anualInterestRate){
        $this->nCuenta = ++self::$cuentas;
        $this->anualInterestRate = $_anualInterestRate;
    }

    function getNCuenta(){
        return $this->nCuenta;
    }
    function getAnualInterestRate(){
        return $this->anualInterestRate;
    }
    function getBalance(){
        return $this->balance;
    }

    function withdraw($amount){
        if($amount>getBalance()){
            return "Error, you have only ". getBalance() ."€ left.";
        }else{
            $this->balance -= $amount;
        }
    }
    function deposit($amount){
        $this->balance += $amount;
    }
    abstract function calculateInterest();
}