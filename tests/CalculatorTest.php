<?php


use PHPUnit\Framework\TestCase;
use PragmaGoTech\Interview\Model\LoanProposal;
use PragmaGoTech\Interview\Controller\LoanFeeController;

final class CalculatorTest extends TestCase
{
    public function testClassConstructor()
    {
 
        $calculator = new LoanFeeController();
        $application = new LoanProposal(19250);
        $application2 = new LoanProposal(6500);
        $application3 = new LoanProposal(1000);

        $this->assertInstanceOf(LoanFeeController::class, $calculator);
        $this->assertInstanceOf(LoanProposal::class, $application);

        $this->assertEquals(385,  $calculator->calculate($application));
        $this->assertEquals(130,  $calculator->calculate($application2));
        $this->assertEquals(50,  $calculator->calculate($application3));

        $this->assertEquals(0, $calculator->calculate($application) % 5);

        $this->assertIsFloat($calculator->calculate($application));
    }
}