<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MortgageCalculatorController extends Controller
{
    //
    public function showCalculator(Request $request)
    {
        $request->validate([
            'loan_amount' => 'required|numeric|min:1',
            'interest_rate' => 'required|numeric|min:0',
            'loan_term' => 'required|integer|min:1',
            // Add more validation rules as needed
        ]);

        $loanAmount = $request->input('loan_amount');
        $interestRate = $request->input('interest_rate') / 100; // Convert percentage to decimal
        $loanTerm = $request->input('loan_term');

        $monthlyInterestRate = ($interestRate / 12);
        $numberOfMonths = $loanTerm * 12;

        // Monthly payment formula
        $monthlyPayment = ($loanAmount * $monthlyInterestRate) / (1 - pow(1 + $monthlyInterestRate, -$numberOfMonths));

        // Your controller logic goes here, you can pass $monthlyPayment to the view

        return view('calculator', ['monthlyPayment' => $monthlyPayment]);
    }
}
