<!DOCTYPE html>
<html>
<head>
    <title>Loan Eligibility Result</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.15/dist/tailwind.min.css" rel="stylesheet">
    @vite('resources/css/app.css')
</head>
<body>
    <div class="max-w-md mx-auto p-6 bg-white shadow-lg rounded mt-auto new">
        <h1 class="text-2xl font-bold mb-6">Loan Eligibility Result</h1>

        @if($isEligible)
            <p class="mb-4 font-bold text-green-600">Congratulations! You are eligible for a loan.</p>
            <p class="mb-1 font-semibold">Maximum Loan Amount: Nu. {{$maximumLoanAmount}}</p>
            <p class="mb-1 font-semibold">Minimum Takeaway: Nu. {{$minimumTakeaway}}</p>
            <p class="mb-1 font-semibold">Your Loan Amount: Nu. {{$loanAmount}}</p>
            <p class="mb-1 font-semibold">Your Takeaway: Nu. {{$yourTakeaway}}</p>

            @if($guarantorRequired)
                <div class="mt-6">
                    <p class="mb-2 text-red-600 font-bold">A guarantor is required for the loan.</p>
                    <p class="mb-2 font-semibold">Guarantor requirements:</p>
                    <ul class="list-disc pl-6 font-semibold">
                        <li >Must be a government, corporation, NGO, or international organization employee</li>
                        <li>Must be a proprietor or senior of a private company</li>
                        <li>Minimum 5 years of work experience</li>
                        <li>Must be a PF member (not applicable for proprietors)</li>
                        <li>Proprietor can guarantee for more than one person</li>
                        <li>Employee of a private company may guarantee, but they must not have guaranteed for any other salary-based loans from any organization</li>
                    </ul>
                </div>
            @else
                <p class="mt-4 text-green-600">No guarantor is required for the loan.</p>
            @endif
        @else
            <p class="mb-4 text-red-600">Sorry, you are not eligible for a loan.</p>
        @endif
    </div>
</body>
</html>
