<?php
namespace App\Interfaces;

interface CalculatorProxy
{
    public function binaryOperation($operation, $arg1, $arg2);

    public function calculator();
}