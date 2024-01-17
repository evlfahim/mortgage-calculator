<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



use App\Http\Controllers\MortgageCalculatorController;

// web.php
Route::middleware(['web'])->group(function () {
    Route::get('/calculator', 'MortgageCalculatorController@showCalculator');
});


//Route::get('/', [MortgageCalculatorController::class, 'showCalculator']);
// web.php
Route::get('/', 'MortgageCalculatorController@showCalculator');


