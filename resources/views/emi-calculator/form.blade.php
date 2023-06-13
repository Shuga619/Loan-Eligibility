<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.15/dist/tailwind.min.css" rel="stylesheet">
    @vite('resources/css/app.css')
</head>
<body>
    <form class="max-w-md mx-auto p-4 shadow-lg rounded mt-20" method="POST" action="{{ route('emi-calculator.calculate') }}">
        @csrf
        <h2 class="text-2xl font-bold mb-4">EMI Calculator</h2>

        <div class="mb-4 grid grid-cols-2 gap-4">
            <div>
                <label for="loan_amount" class="block font-bold mb-1">Loan Amount (in Nu):</label>
                <input type="number" id="loan_amount" name="loan_amount" required class="w-full p-2 border border-gray-300 rounded">
            </div>

            <div>
                <label for="interest_rate" class="block font-bold mb-1">Bank Interest Rate:</label>
                <input type="number" id="interest_rate" name="interest_rate" step="0.01" required class="w-full p-2 border border-gray-300 rounded">
            </div>
        </div>

        <div class="mb-4 grid grid-cols-2 gap-4">
            <div>
                <label for="loan_term" class="block font-bold mb-1">Loan Term (in months):</label>
                <input type="number" id="loan_term" name="loan_term" max="60" required class="w-full p-2 border border-gray-300 rounded">
            </div>

            <div>
                <label for="net_monthly_income" class="block font-bold mb-1">Net Monthly Income:</label>
                <input type="number" id="net_monthly_income" name="net_monthly_income" required class="w-full p-2 border border-gray-300 rounded">
            </div>
        </div>

        <div class="flex justify-center">
            <button type="submit" class="hover:bg-blue-400 text-white font-bold py-2 px-4 border-b-4 border-blue-700 hover:border-blue-500 rounded">Calculate EMI</button>
        </div>
    </form>
</body>
</html>
