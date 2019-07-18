<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Math\MathToken;

class MathTokenTest extends TestCase
{

    protected function setUp(): void
    {
    }

    /**  @test */
    public function isOperator()
    {
        $numberToken = new MathToken("22");
        $this->assertFalse($numberToken->isOperator());
    }

}
