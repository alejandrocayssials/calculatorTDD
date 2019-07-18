<?php

namespace App\Math;

class ExpressionValidator
{
    public function isExpressionValid($expression)
    {
        $regex = preg_match("@^\d+((\s+)[+|\-|/|*](\s+)\d+)+$@", $expression);
        
        if($regex === 1)
            return true;
        else
            return false;

    }
}