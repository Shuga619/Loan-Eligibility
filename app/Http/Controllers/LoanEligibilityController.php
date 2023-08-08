<?php

namespace App\Http\Controllers;

use App\Models\LoanEligibility;
use Illuminate\Http\Request;


class LoanEligibilityController extends Controller
{
    public function checkEligibility(Request $request)
{ 
    // Retrieve the input values from the request
    $employmentType = $request->input('employment_type');
    $age = $request->input('age');
    $netMonthlyIncome = $request->input('net_monthly_income');
    $loanAmount = $request->input('loan_amount');
    $interestRate = $request->input('interest_rate');
    $interestRate = $interestRate / (12 * 100); // one month interest
    $loanTerm = $request->input('loan_term');
    $employeeLoan = $request->input('employee_loan');
    $sanctionedLoan = $request->input('sanctioned_loan', 0); // Default to 0 if not provided

    // Initialize variables for loan eligibility
    $isEligible = false;
    $maximumLoanAmount = 0;
    $guarantorRequired = false;
    $reason = '';
    $sanctionedLoan = null;

    if ($age >= 18) {
        // Government Employees, Armed Forces, Government Corporations, Listed Companies, NGOs, International Organizations, Monastic Body
        if ($employmentType === 'Government Employees' || $employmentType === 'Armed Forces' ||
            $employmentType === 'Government Corporations' || $employmentType === 'Listed Companies' ||
            $employmentType === 'NGOs' || $employmentType === 'International Organizations' ||
            $employmentType === 'Monastic Body') {

            $workExperience = $request->input('work_experience');

            if ($workExperience === 'On probation period') {
                $maximumLoanAmount = 50000;
                $guarantorRequired = true;
            } elseif ($workExperience === 'After probation period till 3 years') {
                $maximumLoanAmount = 300000;
                $guarantorRequired = true;
            } elseif ($workExperience === '3 years and above') {
                $maximumLoanAmount = 500000;
                $guarantorRequired = false;
            }
        }
        // Private Companies (Not Listed)
        elseif ($employmentType === 'Private Companies Employee (Not Listed)') {
            $workExperience = $request->input('work_experience');

            if ($workExperience === 'After probation period till 3 years') {
                $maximumLoanAmount = 100000;
                $guarantorRequired = true;
            } elseif ($workExperience === '3 years till 5 years') {
                $maximumLoanAmount = 300000;
                $guarantorRequired = true;
            } elseif ($workExperience === '5 years and above') {
                $maximumLoanAmount = 500000;
                $guarantorRequired = true;
            }
        }
        // Contract Employees (Management Level)
        elseif ($employmentType === 'Contract Employees (Management Level)') {
            $maximumLoanAmount = 500000;
            $guarantorRequired = true;
        }

        $minimumTakeaway = max(0.3 * $netMonthlyIncome, 4000);
        $emi = ($loanAmount * $interestRate * pow(1 + $interestRate, $loanTerm)) / (pow(1 + $interestRate, $loanTerm) - 1);
        $yourTakeaway = $netMonthlyIncome - $emi;
        $yourTakeaway = round($yourTakeaway, 2);
        $yourInstallment = round($emi, 2);

        if ($loanAmount > 0 && $yourTakeaway >= $minimumTakeaway && $loanAmount <= $maximumLoanAmount) {
            $isEligible = true;
        } else {
            if ($loanAmount <= 0) {
                $reason = 'Loan amount must be greater than zero.';
            } elseif ($yourTakeaway < $minimumTakeaway) {
                $reason = 'Your monthly income is not sufficient. Your monthly takeaway must be at least Nu.' . $minimumTakeaway . '.';
            } elseif ($loanAmount > $maximumLoanAmount) {
                $reason = 'Requested loan amount exceeded, maximum loan amount available for your employment type and work experience is Nu. ' . $maximumLoanAmount . '.';
            }
        }
        
    } 
    
    // If the user is eligible for the loan, calculate the available loan amount
    $availableLoanAmount = $isEligible ? $maximumLoanAmount - $sanctionedLoan : 0;

    // Prepare the data to be passed to the view
    $data = [
        'isEligible' => $isEligible,
        'reason' => $reason,
    ];
    // Render the appropriate view based on eligibility
    return view('loan-eligibility.result', compact('loanAmount', 'isEligible', 'maximumLoanAmount', 'guarantorRequired', 'minimumTakeaway', 'yourTakeaway', 'reason','yourInstallment','sanctionedLoan'))->render();
}


    public function showForm()
    {
        return view('loan-eligibility.form');
    }
    public function showEmiForm()
    {
        return view('emi-calculator.form');
    }
}
