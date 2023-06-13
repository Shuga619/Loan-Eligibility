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
        $interestRate = $interestRate / (12 * 100); //one month interest
        $loanTerm = $request->input('loan_term');

        // Implement the loan eligibility logic based on the provided requirements
        $isEligible = false;
        $maximumLoanAmount = 0;
        $guarantorRequired = false;

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
                    $maximumLoanAmount = 400000;
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

            if ($loanAmount > 0 && $yourTakeaway >= $minimumTakeaway && $loanAmount <= $maximumLoanAmount) {
                $isEligible = true;
            }
        }

        return view('loan-eligibility.result', compact('loanAmount','isEligible', 'maximumLoanAmount', 'guarantorRequired', 'minimumTakeaway', 'yourTakeaway'));
    }
    public function calculateEMI(Request $request)
    {
        // Retrieve the input values from the request
        $loanAmount = $request->input('loan_amount');
        $interestRate = $request->input('interest_rate');
        $loanTerm = $request->input('loan_term');
        $netMonthlyIncome = $request->input('net_monthly_income');
        // Calculate EMI, interest payable, total payable, and minimum takeaway
        $interestRate = $interestRate / (12 * 100); //one month interest
        $emi = ($loanAmount * $interestRate * pow(1 + $interestRate, $loanTerm)) / (pow(1 + $interestRate, $loanTerm) - 1);
        $totalPayable = $emi * $loanTerm;
        $interestPayable = $totalPayable - $loanAmount;
        $yourTakeaway = $netMonthlyIncome - $emi;
        $minimumTakeaway = max(0.3 * $netMonthlyIncome, 4000);
        $emi = round($emi, 2); // Round the EMI to 2 decimal places
        $totalPayable = round($totalPayable, 2);
        $interestPayable = round($interestPayable, 2);
        $minimumTakeaway = round($minimumTakeaway, 2);
        $yourTakeaway = round($yourTakeaway, 2);
        return view('loan-eligibility.emi-result', compact('emi', 'interestPayable', 'totalPayable', 'minimumTakeaway', 'yourTakeaway','loanAmount'));
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
