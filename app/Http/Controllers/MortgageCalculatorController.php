<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MortgageCalculatorController extends Controller
{
    //
    public function showCalculator()
    {
        // Your controller logic goes here
        return view('calculator');
    }
}
