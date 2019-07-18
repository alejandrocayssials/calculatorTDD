<?php 
namespace App\Math;

use App\Interfaces\Lexer;

class MathLexer implements Lexer
{
    public $_validator;

    public function __construct(ExpressionValidator $validator)
    {
        $this->_validator = $validator;
    }

    public function GetTokens($expression)
    {
        if(!$this->_validator->isExpressionValid($expression))
            throw new \InvalidArgumentException($expression);
        
        $items = $this->splitExpression($expression);
        
        return $this->createTokensFromStrings($items);

    }

    private function splitExpression($expression)
    {
        $matches = explode(' ',$expression);
        $matches = array_filter($matches);
        //$matches = preg_split("/[\s,]+/", $expression);
        return $matches;
    }

    private function createTokensFromStrings($items)
    {
        $tokens = array();
        foreach($items as $item)
        {
            $tokens[] = new MathToken($item);
        }
        return $tokens;
    }
}