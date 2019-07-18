<?php
namespace App\Interfaces;

interface Lexer
{
    public function GetTokens($expression);
}