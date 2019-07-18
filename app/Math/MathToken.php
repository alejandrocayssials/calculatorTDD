<?php
namespace App\Math;

class MathToken
{
    public $Token;

    public function __construct($token)
    {
        $this->Token = $token;
    }

    public function isOperator()
    {
        if(is_numeric($this->Token))
            return false;
        
        
        return true;
    }
}