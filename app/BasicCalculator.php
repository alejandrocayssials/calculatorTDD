<?php

namespace App;

class BasicCalculator
{

    public $operation;

    public function __construct()
    {

        $this->operation = new SingleBinaryOperation();
    }

    public function add(int $arg1, int $arg2)
    {

            $result = $this->operation->add($arg1, $arg2);

            return $result;

    }

    public function substract(int $arg1, int $arg2)
    {   

            $result = $this->operation->substract($arg1, $arg2);

            return $result;
   
    }
}
