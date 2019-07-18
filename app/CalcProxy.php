<?php

namespace App;

class CalcProxy
{
    protected $_calculator;

    public $_validator;

    public function __construct(Validator $validator, BasicCalculator $calculator)
    {
        $this->_validator = $validator;
        $this->_calculator = $calculator;
    }

    public function binaryOperation($operation, $arg1, $arg2)
    {
        $this->_validator->ValidateArgs($arg1, $arg2);

        $result = $this->_calculator->$operation($arg1, $arg2);

        $this->_validator->ValidateResult($result);

        return $result;
    }
}