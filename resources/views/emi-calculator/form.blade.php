<!DOCTYPE html>
<html>
<head>
<title>EMI Calculator</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.15/dist/tailwind.min.css" rel="stylesheet">
    @vite('resources/css/app.css')
    <style>

    </style>
</head>
<body>
    <div class="calculator-container">
        <div class="calculator">
        <div class="header">
            <img src="../images/website-header-final.png" alt="EMI Calculator Header" class="header-image mx-auto">
        </div>
            <h2 class="calculator-title">EMI Calculator</h2>
            <form id="emi-form">
                <div class="form-field">
                    <label for="loan_amount" class="form-label">Loan Amount (Nu):</label>
                    <input type="text" name="loan_amount" id="loan_amount" required class="form-input" oninput="formatNumberInput(this)">
                </div>
                <div>
                    <label for="interest_rate" class="form-label">Bank Interest Rate (%):</label>
                    <input type="number" id="interest_rate" name="interest_rate" step="0.01" required class="form-input">
                </div>
                <div>
                    <label for="loan_term" class="form-label">Loan Term (Months):</label>
                    <input type="number" id="loan_term" name="loan_term" max="60" required class="form-input">
                </div>
            <div class="flex justify-between gap-2">
                <button type="submit" class="form-button">Calculate EMI</button>
                <button type="button" class="form-button" onclick="clearForm()">Clear</button>
            </div>
            </form>
            <div id="emi-result" class="emi-result" style="display: none;"></div>
        </div>
        <div id="amortization-table-container" class="amortization-table-container">
            <table id="amortization-table" class="amortization-table"></table>
        </div>
    </div>
    <script>
        function formatNumberInput(input) {
            let value = input.value.replace(/,/g, ''); // Remove existing commas
            let formattedValue = Number(value).toLocaleString(); // Add commas as thousand separators
            input.value = formattedValue;
        }

        function clearForm() {
            document.getElementById('loan_amount').value = '';
            document.getElementById('interest_rate').value = '';
            document.getElementById('loan_term').value = '';

            document.getElementById('emi-result').style.display = 'none';
            document.getElementById('amortization-table-container').style.display = 'none';

            const calculatorContainer = document.querySelector('.calculator-container');
            calculatorContainer.style.maxWidth = '400px';
        }

        document.getElementById('emi-form').addEventListener('submit', function (e) {
            e.preventDefault();

            // Get form values
            const loanAmount = parseFloat(document.getElementById('loan_amount').value.replace(/,/g, '')); // Remove commas
            const interestRate = parseFloat(document.getElementById('interest_rate').value);
            const loanTerm = parseFloat(document.getElementById('loan_term').value);

            // Calculate EMI
            const monthlyInterest = interestRate / 100 / 12;
            const emi = (loanAmount * monthlyInterest * Math.pow(1 + monthlyInterest, loanTerm)) /
            (Math.pow(1 + monthlyInterest, loanTerm) - 1);

            // Calculate additional values
            const totalPayable = emi * loanTerm;
            const interestPayable = totalPayable - loanAmount;

            // Display result
            function addCommasToNumber(number) {
            return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            }

            const emiResult = document.getElementById('emi-result');
            emiResult.innerHTML = `
            EMI: Nu. ${addCommasToNumber(emi.toFixed(2))}<br>
            Interest Payable: Nu. ${addCommasToNumber(interestPayable.toFixed(2))}<br>
            Total Payment: Nu. ${addCommasToNumber(totalPayable.toFixed(2))}<br>
            `;

            if (emi < 0) {
            emiResult.style.color = 'red';
            } else {
            emiResult.style.color = 'green';
            }

            // Generate loan amortization schedule table
            const amortizationTableContainer = document.getElementById('amortization-table-container');
            const amortizationTable = document.getElementById('amortization-table');
            amortizationTable.innerHTML = `
            <tr>
                <th>Month</th>
                <th>Ending Balance(Nu)</th>
                <th>Interest Paid(Nu)</th>
                <th>Principal Paid(Nu)</th>
                <th>Installment<br>(Nu)</th>
            </tr>
            `;

            let balance = loanAmount;
            for (let month = 1; month <= loanTerm; month++) {
            const interest = balance * monthlyInterest;
            const principal = emi - interest;
            balance -= principal;

            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${month}</td>
                <td>${addCommasToNumber(balance.toFixed(2))}</td>
                <td>${addCommasToNumber(interest.toFixed(2))}</td>
                <td>${addCommasToNumber(principal.toFixed(2))}</td>
                <td>${addCommasToNumber(emi.toFixed(2))}</td>
            `;
            amortizationTable.appendChild(row);
            }

            amortizationTableContainer.style.display = 'block';
            emiResult.style.display = 'block';
            const calculatorContainer = document.querySelector('.calculator-container');
            calculatorContainer.style.maxWidth = '900px';
        });
    </script>

</body>
</html>
