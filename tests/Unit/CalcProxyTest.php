<?php

namespace Tests\Unit;

use App\CalcProxy;
use App\Validator;
use Tests\TestCase;
use App\BasicCalculator;

class CalcProxyTest extends TestCase
{
    protected $_calculator;
    protected $_calcProxy;
    
    protected function setUp(): void
    {
        $this->_calculator = new BasicCalculator();
        $this->_calcProxy = new CalcProxy(new Validator(-1000, 1000), $this->_calculator);
    }
    
    /**  @test */
    public function add()
    {
        $result = $this->_calcProxy->binaryOperation('add', 2, 2);

        $this->assertEquals(4, $result);
            
    }

     /**  @test */
     public function add_with_diff_arguments()
     {
        $result = $this->_calcProxy->binaryOperation('add', 5, 3);
 
         $this->assertEquals(8, $result);
             
     }

     /**  @test */
    public function substract()
    {
        $result = $this->_calcProxy->binaryOperation('substract', 5, 2);

        $this->assertEquals(3, $result);
            
    }

     /**  @test */
     public function substract_result_negative()
     {

        $result = $this->_calcProxy->binaryOperation('substract', 2, 4);

        $this->assertEquals(-2, $result);
             
     }

     /**  @test */
     public function validate_result_exceding_lower_limit()
     {
            $this->expectException(\OverflowException::class);
            $this->expectExceptionMessage('Result exceed limits');
            
            $calculator = new BasicCalculator();
            $calcWithLimits = new CalcProxy(new Validator(-100, 200),$calculator);
            $calcWithLimits->binaryOperation('add', -10, -95);
    
     }

     /**  @test */
     public function validate_result_exceding_upper_limit()
     {
            $this->expectException(\OverflowException::class);
            $this->expectExceptionMessage('Result exceed limits');
            
            $calculator = new BasicCalculator();
            $calcWithLimits = new CalcProxy(new Validator(0, 100),$calculator);
            $calcWithLimits->binaryOperation('substract', 3, 4);
    
     }

     /**  @test */
     public function arguments_exceed_limits()
     {
            $this->expectException(\OverflowException::class);
            $this->expectExceptionMessage('argument exceed limits');
            
            $calculator = new BasicCalculator();
            $calcProxyWithValidator = new CalcProxy(new Validator(-100, 100), $calculator);
            
            $calcProxyWithValidator->binaryOperation('add',300,500);
    
     }

      /**  @test */
      public function arguments_exceed_limits_inverse()
      {
             $this->expectException(\OverflowException::class);
             $this->expectExceptionMessage('argument exceed limits');
             
             $calculator = new BasicCalculator();
             $calcProxyWithValidator = new CalcProxy(new Validator(-100, 100), $calculator);
             $calcProxyWithValidator->_validator->ValidateArgs($calcProxyWithValidator->_validator->getLowerLimit() - 1, $calcProxyWithValidator->_validator->getUpperLimit() + 1);
     
      }

     
}