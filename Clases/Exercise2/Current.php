<?php

namespace Exercise2;
include "Account.php";
class Current extends Account
{
    public function __construct($_anualInterestRate)
    {
        parent::__construct($_anualInterestRate);
    }

    function calculateInterest()
    {
        $this->deposit(parent::getBalance() * parent::getAnualInterestRate());
    }
}