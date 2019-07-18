<?php

namespace App;

class Calculator
{

    private $UpperLimit;
    private $LowerLimit;

    public function __construct(int $minValue, int $maxValue){
        $this->UpperLimit = $maxValue;    
        $this->LowerLimit = $minValue;    
    }

    public function getLowerLimit()
    {
        return $this->LowerLimit;
    }

    public function setLowerLimit(int $minValue)
    {
        $this->LowerLimit = $minValue;
    }

    public function getUpperLimit()
    {
        return $this->UpperLimit;
    }

    public function setUpperLimit(int $maxValue)
    {
        $this->UpperLimit = $maxValue;
    }

    public function add(int $arg1, int $arg2)
    {
        $this->ValidateArgs($arg1, $arg2);
        
        $result = (int)($arg1 + $arg2);
        if($result > $this->UpperLimit)
            throw new \OverflowException('upper limit exceed');

        return $result;
    }

    public function substract(int $arg1, int $arg2)
    {
        $this->ValidateArgs($arg1, $arg2);
        
        $result = (int)($arg1 - $arg2);
        if($result < $this->LowerLimit)
            throw new \OverflowException('lower limit exceed');

        return $result;
    }

    public function ValidateArgs(int $arg1, int $arg2){
        if($arg1 > $this->UpperLimit)
            throw new \OverflowException('arguments exceed limits');
        if($arg2 < $this->LowerLimit)
            throw new \OverflowException('arguments exceed limits');
        if($arg1 < $this->LowerLimit)
            throw new \OverflowException('arguments exceed limits');
        if($arg2 > $this->UpperLimit)
            throw new \OverflowException('arguments exceed limits');
    
        return true;
    }
}