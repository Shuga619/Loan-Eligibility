<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.15/dist/tailwind.min.css" rel="stylesheet">
    @vite('resources/css/app.css')
</head>
<body class>
    <div class="max-w-md mx-auto p-6 new shadow-lg rounded mt-20">
        <h2 class="text-2xl font-bold mb-5">EMI Calculation Result</h2>
        <p class="mb-1 font-semibold">Your Loan Amount: Nu. {{$loanAmount}}</p>
        <p class="mb-1 font-semibold">EMI: Nu. {{ $emi }}</p>
        <p class="mb-1 font-semibold">Total Payable: Nu. {{ $totalPayable }}</p>
        <p class="mb-1 font-semibold">Interest Payable: Nu. {{ $interestPayable }}</p>
        <p class="mb-1 font-semibold">Minimum Monthly Takeaway: Nu. {{ $minimumTakeaway }}</p>
        <p class="font-semibold">Your Monthly Takeaway: Nu. {{ $yourTakeaway }}</p>
    </div>
</body>
</html>
