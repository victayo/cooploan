<?php

namespace App\Services;

use App\Models\Loan;
use App\Models\RepaymentSchedule;
use Carbon\Carbon;

class RepaymentScheduleService
{
    /**
     * @todo: Move these constants to Settings
     */
    private const REPAYMENT_DAY = 25;
    private const MAX_DAY_FOR_CURRENT_MONTH = 12; //If loan is approved for a day greater than this, repayment starts in the next month.

    public function calculateLoanPayment($principal, $annualInterestRate, $loanTermInMonths)
    {

        // Calculate monthly interest rate
        $monthlyInterestRate = $annualInterestRate / 100 / 12;

        $monthlyPayment = $principal * ($monthlyInterestRate * pow(1 + $monthlyInterestRate, $loanTermInMonths)) / (pow(1 + $monthlyInterestRate, $loanTermInMonths) - 1);
        return $monthlyPayment;
    }

    public function generateRepaymentSchedule($principal, $annualInterestRate, $tenure, $loanStartDate = null)
    {
        if(!$loanStartDate){
            $loanStartDate = now()->toDateString();
        }

        $parsedDate = Carbon::parse($loanStartDate);
        $day = $parsedDate->day;

        if($day > self::MAX_DAY_FOR_CURRENT_MONTH){//if loan effective date > Max_day_for_current_month, repayment starts on the 25th of the next month.
            $parsedDate = $parsedDate->addMonth();
        }
        $loanStartDate = "{$parsedDate->year}-{$parsedDate->month}-".self::REPAYMENT_DAY;

        $monthlyPayment = $this->calculateLoanPayment($principal, $annualInterestRate, $tenure);
        $remainingBalance = $principal;
        $beginningBalance = $principal;
        $schedule = [];
        $timestamp = now();
        $totalInterest = 0;

        for ($t = 0; $t < $tenure; $t++) {
            $repaymentDate = Carbon::parse($loanStartDate)->addMonths($t)->toDateString();
            $interest =  $remainingBalance * ($annualInterestRate / 100 / 12);
            $principalPayment = $monthlyPayment - $interest;
            $remainingBalance -= $principalPayment;
            $schedule[] = [
                'repayment_date' => $repaymentDate,
                'beginning_balance' => round($beginningBalance, 2),
                'interest' => round($interest, 2),
                'principal' => round($principalPayment, 2),
                'end_balance' => abs(round($remainingBalance, 2)),
                'monthly_repayment' => round($monthlyPayment, 2),
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ];
            $totalInterest += $interest;
            $beginningBalance = $remainingBalance;
        }

        $totalInterest = round($totalInterest, 2);
        return [
            'schedule' => $schedule,
            'total_interest' => $totalInterest,
            'monthly_payment' => round($monthlyPayment,2)
        ];
    }
}
