<?php

namespace Tests\Unit;

use App\CalcProxy;
use App\Validator;
use Tests\TestCase;
use App\Math\MathLexer;
use App\Math\MathToken;
use App\BasicCalculator;
use App\Math\MathParser;
use App\Interfaces\Lexer;
use App\Math\ExpressionValidator;
use App\Interfaces\CalculatorProxy;

class CalculatorFeatureTest extends TestCase
{
    /** @test */
    public function ProcessSimpleExpression()
    {
        $parser = new MathParser(new MathLexer(new ExpressionValidator()),new CalcProxy(new Validator(-100,100), new BasicCalculator()));
        $this->assertEquals(4, $parser->processExpression("2 + 2"));
    }

    /** @test */
    public function ProcessExpression2Operators()
    {
        $parser = new MathParser(new MathLexer(new ExpressionValidator()),new CalcProxy(new Validator(-100,100), new BasicCalculator()));
        $this->assertEquals(6, $parser->processExpression("3 + 1 + 2"));
    }

    /** @test */
    public function ParserWorksWithCalcProxy()
    {
        $calcProxyMock = $this->createMock(CalculatorProxy::class);

        $calcProxyMock->expects($this->once())
        ->method("binaryOperation")
        ->will($this->returnValue(4));

        $parser = new MathParser(new MathLexer(new ExpressionValidator()),$calcProxyMock);
        $this->assertEquals(4, $parser->processExpression("2 + 2"));
        
    }

    /** @test */
    public function ParserWorksWithLexer()
    {
        $tokens = array();
        $tokens[] = new MathToken("2");
        $tokens[] = new MathToken("+");
        $tokens[] = new MathToken("2");

        $lexerMock = $this->createMock(Lexer::class);

        $lexerMock->expects($this->once())
        ->method("GetTokens")
        ->will($this->returnValue($tokens));

        $parser = new MathParser($lexerMock, new CalcProxy(new Validator(-100,100), new BasicCalculator()));
        $this->assertEquals(4, $parser->processExpression("2 + 2"));
        
    }
    
    

}