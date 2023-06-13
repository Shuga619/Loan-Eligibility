<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoanEligibilityController;

Route::get('/', [LoanEligibilityController::class, 'showForm'])->name('loan-eligibility.form');

// Route for displaying the loan eligibility form
Route::get('/loan-eligibility', [LoanEligibilityController::class, 'showForm'])->name('loan-eligibility.form');

// Route for submitting the loan eligibility form
Route::post('/loan-eligibility', [LoanEligibilityController::class, 'checkEligibility'])->name('loan-eligibility.check');

// Route for displaying the EMI calculator form
Route::get('/emi-calculator', [LoanEligibilityController::class, 'showEmiForm'])->name('emi-calculator.form');

// Route for calculating the EMI
Route::post('/emi-calculator', [LoanEligibilityController::class, 'calculateEMI'])->name('emi-calculator.calculate');