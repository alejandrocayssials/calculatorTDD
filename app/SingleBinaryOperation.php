<?php

namespace App;

class SingleBinaryOperation
{
    public function add(int $arg1, int $arg2)
    {
        return (int)($arg1 + $arg2);
    }

    public function substract(int $arg1, int $arg2)
    {
        return (int)($arg1 - $arg2);
    }
}