<?php

namespace Tests\Unit;

use App\CalcProxy;
use App\Validator;
use Tests\TestCase;
use App\Math\MathLexer;
use App\BasicCalculator;
use App\Math\ExpressionValidator;

class ParserTest extends TestCase
{
    /**  @test */
    public function get_tokens()
    {    
        $parser = new MathLexer(new ExpressionValidator());
        $tokens = array();
        $tokens = $parser->GetTokens("2 + 2");

        $this->assertEquals(3, count($tokens));
        $this->assertEquals("2", $tokens[0]->Token);
        $this->assertEquals("+", $tokens[1]->Token);
        $this->assertEquals("2", $tokens[2]->Token);
        
    }

    /**  @test */
    public function get_tokens_with_spaces()
    {    
        $parser = new MathLexer(new ExpressionValidator());
        $tokens = array();
        $tokens = $parser->GetTokens("24 +    62");

        $this->assertEquals(3, count($tokens));
        $this->assertEquals("24", $tokens[0]->Token);
        $this->assertEquals("+", $tokens[1]->Token);
        $this->assertEquals("62", $tokens[2]->Token);
        
    }

    /**  @test */
    public function get_tokens_long_expression()
    {    
        $parser = new MathLexer(new ExpressionValidator());
        $tokens = array();
        $tokens = $parser->GetTokens("2 + 1 - 5");

        $this->assertEquals(5, count($tokens));
        $this->assertEquals("+", $tokens[1]->Token);
        $this->assertEquals("-", $tokens[3]->Token);
        $this->assertEquals("5", $tokens[4]->Token);
        
    }

    /**  @test */
    public function get_tokens_wrong_expression()
    {    
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("2 + 1++ 5");
            
        $parser = new MathLexer(new ExpressionValidator());
        $tokens = array();
        $tokens = $parser->GetTokens("2 + 1++ 5");
        
    }

    /**  @test */
    public function validate_more_than_one_digit_expression()
    {
        $parser = new ExpressionValidator();
        
        $expression = "25 + 28";
        $result = $parser->isExpressionValid($expression);

        $this->assertTrue($result);
    }

    /**  @test */
    public function validate_with_spaces()
    {
        $parser = new ExpressionValidator();
        
        $expression = "25    +       28";
        $result = $parser->isExpressionValid($expression);

        $this->assertTrue($result);
    }

    /**  @test */
    public function validate_fails_no_spaces()
    {
        $parser = new ExpressionValidator();
        
        $expression = "2+28";
        $result = $parser->isExpressionValid($expression);

        $this->assertFalse($result);
    }

    /**  @test */
    public function validate_complex_expression()
    {
        $parser = new ExpressionValidator();
        
        $expression = "2 + 6 - 2 * 4";
        $result = $parser->isExpressionValid($expression);

        $this->assertTrue($result);
    }

    /**  @test */
    public function validate_complex_wrong_expression()
    {
        $parser = new ExpressionValidator();
        
        $expression = "2 + 6 a 2 b 4";
        $result = $parser->isExpressionValid($expression);

        $this->assertFalse($result);
    }

    public function validate_simple_wrong_expression()
    {
        $parser = new ExpressionValidator();
        
        $expression = "2b4";
        $result = $parser->isExpressionValid($expression);

        $this->assertFalse($result);
    }

    public function validate_wrong_expression_with_valid_subexpression()
    {
        $parser = new ExpressionValidator();
        
        $expression = "2 + 5 - 3 a 8 b";
        $result = $parser->isExpressionValid($expression);

        $this->assertFalse($result);
    }

    public function validate_wrong_several_operators_together()
    {
        $parser = new ExpressionValidator();
        
        $expression = "+ + 9";
        $result = $parser->isExpressionValid($expression);

        $this->assertFalse($result);
    }

    public function validate_with_negative_numbers()
    {
        $parser = new ExpressionValidator();
        
        $expression = "-6 - -1 + 4 / -9";
        $result = $parser->isExpressionValid($expression);

        $this->assertTrue($result);
    }

    /**  @test */
    public function validate_simple_expression_with_all_operators()
    {
        $parser = new ExpressionValidator();

        $operators = ['+','-','/','*'];

        foreach ($operators as $operator){
            $expression = "25 ".$operator." 28";
            $result = $parser->isExpressionValid($expression);
            $this->assertTrue($result);
        }
    }
}