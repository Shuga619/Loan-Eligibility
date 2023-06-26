
        <h1 class="form-title">Loan Eligibility Result</h1>

        @if($isEligible)
            <p class="mb-4 font-bold text-green-600">Congratulations! You are eligible for a loan.</p>
            <p class="mb-1 font-xs">Maximum Loan Amount: Nu. {{$maximumLoanAmount}}</p>
            <p class="mb-1 ">Minimum Takeaway: Nu. {{$minimumTakeaway}}</p>
            <p class="mb-1 ">Your Loan Amount: Nu. {{$loanAmount}}</p>
            <p class="mb-1 ">Your Takeaway: Nu. {{$yourTakeaway}}</p>
            <p class="mb-1 ">Your Monthly Installment: Nu. {{$yourInstallment}}</p>

            @if($guarantorRequired)
                <div class="mt-6">
                    <p class="mb-2 text-red-600 font-bold">A guarantor is required for the loan.</p>
                    <p class="mb-2">Guarantor requirements:</p>
                    <ul class="list-disc pl-6">
                        <li >Must be a government, corporation, NGO, or international organization employee</li>
                        <li>Must be a proprietor or senior of a private company</li>
                        <li>Minimum 5 years of work experience</li>
                        <li>Must be a PF member (not applicable for proprietors)</li>
                        <li>Proprietor can guarantee for more than one person</li>
                        <li>Employee of a private company may guarantee, but they must not have guaranteed for any other salary-based loans from any organization</li>
                    </ul>
                </div>
            @else
                <p class="mt-4 text-green-600">A guarantor is not required for the loan.</p>
            @endif
        @else
            <p class="mb-4 text-red-600">Sorry, you are not eligible for the requested loan.</p> 
            <h2>Reason:</h2>
             <p>{{ $reason }}</p>
        @endif
