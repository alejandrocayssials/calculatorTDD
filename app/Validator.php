<?php
namespace App;

class Validator
{
    protected $UpperLimit;
    protected $LowerLimit;

    public function __construct(int $minValue, int $maxValue)
    {
        $this->LowerLimit = $minValue;
        $this->UpperLimit = $maxValue;
        
    }

    public function setLimits(int $minValue, int $maxValue)
    {
        $this->LowerLimit = $minValue;
        $this->UpperLimit = $maxValue;
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

    public function ValidateArgs(int $arg1, int $arg2)
    {
        $this->breakIfOverflow($arg1, 'First argument exceed limits');
        $this->breakIfOverflow($arg2, 'Second argument exceed limits');   
        
        return true;
    }

    public function ValidateResult(int $result)
    {
        $this->breakIfOverflow($result, 'Result exceed limits');
    }

    public function breakIfOverflow(int $arg, string $error)
    {
        if($this->valueExceedLimitArg($arg))
            throw new \OverflowException($error);
    }

    public function valueExceedLimitArg(int $arg)
    {
        if($arg > $this->UpperLimit)
            return true;
        if($arg < $this->LowerLimit)
            return true;
    
        return false;
    }

}