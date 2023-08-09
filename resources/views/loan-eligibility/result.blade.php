<h1 class="form-title text-white">Loan Eligibility Result</h1>

@if($isEligible)
<p class="mb-4 font-bold text-green-600">Congratulations! You are eligible for a loan.</p>

<div class="p-4 border border-gray-300 shadow-md font-semibold">
    <!-- <p class="mb-1">Maximum Loan Amount: Nu. <span class="amount">{{ number_format($maximumLoanAmount) }}</span></p>
    <p class="mb-1">Minimum Takeaway: Nu. <span class="amount">{{ number_format($minimumTakeaway) }}</span></p> -->
    <p class="mb-1">Your Loan Amount: <span class="amount">Nu. {{ number_format($loanAmount) }}</span></p>
    <!-- <p class="mb-1">Monthly Salary Takeaway: <span class="amount">Nu. {{ number_format($yourTakeaway) }}</span></p> -->
    <div class="flex">
        <p class="mb-1">Your Monthly Installment/EMI: <span class="amount">Nu. {{ number_format($yourInstallment) }}</span> </p>
        <div class="hint-icon-container">
            <span class="hint-icon">ℹ️</span>
            <div class="hint-text">The condition for availing a loan is that, after deducting the Equated Monthly Installment (EMI) from your net monthly income, your minimum take-home pay should be either 30% of the remaining net monthly income or Nu. 4000, whichever is higher.</div>
        </div>
    </div>
    <p>Note: The maximum loan amount you can avail is <span class="amount">Nu. {{ number_format($maximumLoanAmount) }}</span></p>
</div>
@if($guarantorRequired)
<div class="mt-6">
    <p class="mb-2 text-red-600 font-bold">A guarantor is required for the loan.</p>
    <p class="mb-2 font-semibold">Guarantor requirements:</p>
    <div class="p-4 border border-gray-300 shadow-md ">
        <ul class="list-disc pl-6 font-semibold">
            <li>Must be a government, corporation, NGO, or international organization employee</li>
            <li>Must be a proprietor or senior of a private company</li>
            <li>Minimum 5 years of work experience</li>
            <li>Must be a PF member (not applicable for proprietors)</li>
            <li>Proprietor can guarantee for more than one person</li>
            <li>Employee of a private company may guarantee, but they must not have guaranteed for any other salary-based loans from any organization</li>
        </ul>
    </div>
</div>
@else
<p class="mt-4 text-green-600 font-bold">A guarantor is not required for the loan.</p>
@endif
<!-- New section to display the available loan amount -->

@else
<p class="mb-4 text-red-600 font-bold">Sorry, you are not eligible for the requested loan of Nu. {{number_format($loanAmount)}}</p>
<div class="p-4 border border-gray-300 shadow-md font-sans font-semibold">
    <h2 class="semi-bold">Reason:</h2>
    <p class="semi-bold">{{ $reason }}</p>
    <p>But you are eligible for: Nu. <span class="amount"> {{number_format($maximumLoanAmount)}} </span> </p>
    <p>Monthly Installment/EMI: Nu. <span class="amount">{{number_format($emi2)}} </span></p>
</div>
@endif
<br>
<p class="font-semibold">Note: You can still avail a loan from BNB, even if you have loans with other financial institutions, as long as your net monthly income meets their requirements. BNB considers applicants based on their income eligibility, irrespective of existing loans with other institutions.</p>
