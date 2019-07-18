<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Calculator;

class CalculatorTest extends TestCase
{
    private $_calculator;

    protected function setUp(): void
    {
        $this->_calculator = new Calculator(-1000, 1000);
    }

    
    /**  @test */
    public function its_can_add()
    {

        $result = $this->_calculator->add(2, 2);

        $this->assertEquals(4, $result);
            
    }

     /**  @test */
     public function its_can_add_with_diff_arguments()
     {
             
         $result = $this->_calculator->add(5, 3);
 
         $this->assertEquals(8, $result);
             
     }

     /**  @test */
    public function its_can_substract()
    {

        $result = $this->_calculator->substract(5, 2);

        $this->assertEquals(3, $result);
            
    }

     /**  @test */
     public function its_can_substract_result_negative()
     {
 
         $result = $this->_calculator->substract(3, 5);
 
         $this->assertEquals(-2, $result);
             
     }

     /**  @test */
     public function set_and_get_upper_limit()
     {
 
         $calculator = new Calculator(-100, 100);

         $this->assertEquals(100, $calculator->getUpperLimit());
         $this->assertEquals(-100, $calculator->getLowerLimit());
             
     }

     /**  @test */
     public function substract_exceding_lower_limit()
     {
            $this->expectException(\OverflowException::class);
            $this->expectExceptionMessage('lower limit exceed');
            
            $calculator = new Calculator(-100, 200);
            $result = $calculator->substract(10, 150);
    
     }

     /**  @test */
     public function add_exceding_upper_limit()
     {
            $this->expectException(\OverflowException::class);
            $this->expectExceptionMessage('upper limit exceed');
            
            $calculator = new Calculator(-100, 100);
            $result = $calculator->add(10, 100);
    
     }

     /**  @test */
     public function arguments_exceed_limits()
     {
            $this->expectException(\OverflowException::class);
            $this->expectExceptionMessage('arguments exceed limits');
            
            $calculator = new Calculator(-100, 100);
            $calculator->ValidateArgs($calculator->getUpperLimit() + 1, $calculator->getLowerLimit() - 1);
    
     }

      /**  @test */
      public function arguments_exceed_limits_inverse()
      {
             $this->expectException(\OverflowException::class);
             $this->expectExceptionMessage('arguments exceed limits');
             
             $calculator = new Calculator(-100, 100);
             $calculator->ValidateArgs($calculator->getLowerLimit() - 1, $calculator->getUpperLimit() + 1);
     
      }
}