<?php

namespace App\Math;

use App\Interfaces\Lexer;
use App\Interfaces\CalculatorProxy;

class MathParser
{
    public $_calcProxy;
    public $_lexer;

    public function __construct(Lexer $lexer, CalculatorProxy $calcProxy)
    {
        $this->_calcProxy = $calcProxy;
        $this->_lexer = $lexer;
    }

    public function processExpression($expression)
    {
        $tokens = $this->_lexer->GetTokens($expression);
        $total = $tokens[0];

        for($i = 0; $i < count($tokens); $i++)
        {
            if($tokens[$i]->isOperator()){
                $totalForNow = $total;
                $nextNumber = $tokens[$i+1];
                $partialResult = $this->_calcProxy->binaryOperation(
                    'add',
                    (int)$totalForNow->Token,
                    (int)$nextNumber->Token
                );
                $total = new MathToken((string)$partialResult);
                $i++;
            }
        }
        
        return $total->Token;

    }
    
}