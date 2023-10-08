<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Controller;

use PragmaGoTech\Interview\FeeCalculator;
use PragmaGoTech\Interview\Model\LoanProposal;

class LoanFeeController implements FeeCalculator
{
    public function calculate(LoanProposal $application): float{
        $amount =$application->amount();

        $breakpoints = [
            1000 => 50,
            2000 => 90,
            3000 => 90,
            4000 => 115,
            5000 => 100,
            6000 => 120,
            7000 => 140,
            8000 => 160,
            9000 => 180,
            10000 => 200,
            11000 => 220,
            12000 => 240,
            13000 => 260,
            14000 => 280,
            15000 => 300,
            16000 => 320,
            17000 => 340,
            18000 => 360,
            19000 => 380,
            20000 => 400,
        ];

        $lower_bound = null;
        $upper_bound = null;

        if(array_key_exists($amount, $breakpoints)) return $breakpoints[$amount];
        
        foreach ($breakpoints as $breakpoint => $value) {
            if ($amount <= $breakpoint) {
                $upper_bound = $breakpoint;
                break;
            }
            $lower_bound = $breakpoint;
        }
        
        $proportionBetweenBreakpoints = (($amount - $lower_bound) /($upper_bound - $lower_bound));
        $fee =  round($breakpoints[$lower_bound] + (($breakpoints[$upper_bound] - $breakpoints[$lower_bound]) * $proportionBetweenBreakpoints)); 
        // Return the fee rounded up to closest 5.
        return ceil($fee / 5) * 5;
    }
    
}

