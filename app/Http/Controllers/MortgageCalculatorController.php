<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MortgageCalculatorController extends Controller
{
    public function showCalculator(Request $request)
    {
        $request->validate([
            'loan_amount' => 'required|numeric|min:1',
            'interest_rate' => 'required|numeric|min:0',
            'loan_term' => 'required|integer|min:1',
            'monthly_extra_payment' => 'nullable|numeric|min:0',
        ], [
            'loan_amount.required' => 'Loan amount is required.',
            'interest_rate.required' => 'Annual interest rate is required.',
            'loan_term.required' => 'Loan term is required.',
        ]);

        // Retrieve validated data
        $loanAmount = $request->input('loan_amount');
        $interestRate = $request->input('interest_rate') / 100; // Convert percentage to decimal
        $loanTerm = $request->input('loan_term');
        $monthlyExtraPayment = $request->input('monthly_extra_payment', 0);

        // Calculate monthly payment
        $monthlyInterestRate = $interestRate / 12;
        $numberOfMonths = $loanTerm * 12;

        $monthlyPayment = ($loanAmount * $monthlyInterestRate) / (1 - pow(1 + $monthlyInterestRate, -$numberOfMonths));

        // Generate amortization schedule
        $amortizationSchedule = [];
        $extraRepaymentSchedule = [];

        $remainingBalance = $loanAmount;
        $monthlyInterest = 0;
        $monthlyPrincipal = 0;

        for ($month = 1; $month <= $numberOfMonths; $month++) {
            $monthlyInterest = $remainingBalance * $monthlyInterestRate;
            $monthlyPrincipal = $monthlyPayment - $monthlyInterest;

            // Deduct extra repayment from the remaining balance
            $remainingBalance -= $monthlyExtraPayment;

            // Store schedule data in the "loan_amortization_schedule" table
            DB::table('loan_amortization_schedule')->insert([
                'month_number' => $month,
                'starting_balance' => $remainingBalance + $monthlyPrincipal,
                'monthly_payment' => $monthlyPayment,
                'principal_component' => $monthlyPrincipal,
                'interest_component' => $monthlyInterest,
                'ending_balance' => $remainingBalance,
            ]);

            // Store schedule data in the array for further use
            $amortizationSchedule[] = [
                'month_number' => $month,
                'starting_balance' => $remainingBalance + $monthlyPrincipal,
                'monthly_payment' => $monthlyPayment,
                'principal_component' => $monthlyPrincipal,
                'interest_component' => $monthlyInterest,
                'ending_balance' => $remainingBalance,
            ];

            // Store data for "extra_repayment_schedule" table
            DB::table('extra_repayment_schedule')->insert([
                'month_number' => $month,
                'starting_balance' => $remainingBalance + $monthlyPrincipal,
                'monthly_payment' => $monthlyPayment,
                'principal_component' => $monthlyPrincipal,
                'interest_component' => $monthlyInterest,
                'extra_repayment_made' => $monthlyExtraPayment,
                'ending_balance_after_extra_repayment' => $remainingBalance,
                'remaining_loan_term_after_extra_repayment' => $numberOfMonths - $month,
            ]);

            // Store data in the array for further use
            $extraRepaymentSchedule[] = [
                'month_number' => $month,
                'starting_balance' => $remainingBalance + $monthlyPrincipal,
                'monthly_payment' => $monthlyPayment,
                'principal_component' => $monthlyPrincipal,
                'interest_component' => $monthlyInterest,
                'extra_repayment_made' => $monthlyExtraPayment,
                'ending_balance_after_extra_repayment' => $remainingBalance,
                'remaining_loan_term_after_extra_repayment' => $numberOfMonths - $month,
            ];

            $remainingBalance -= $monthlyPrincipal;
        }

        $loanDetails = [
            'loan_amount' => $loanAmount,
            'annual_interest_rate' => $interestRate * 100, // Convert back to percentage
            'loan_term' => $loanTerm,
            'effective_interest_rate' => ($monthlyPayment * $numberOfMonths - $loanAmount) / $loanAmount * 100,
        ];

        return view('calculator', [
            'monthlyPayment' => $monthlyPayment,
            'amortizationSchedule' => $amortizationSchedule,
            'extraRepaymentSchedule' => $extraRepaymentSchedule,
            'loanDetails' => $loanDetails,
        ]);
    }
}
