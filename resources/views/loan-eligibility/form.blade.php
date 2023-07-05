<!DOCTYPE html>
<html>
<head>
    <title>Loan Eligibility Form</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.15/dist/tailwind.min.css" rel="stylesheet">
    @vite('resources/css/app.css')
</head>
<body>
    <div class="container">
    
        <div class="form-container text-sm"> 
          <form method="POST" action="{{ route('loan-eligibility.check') }}" id="loanEligibilityForm">
          <div class="header">
            <img src="../images/website-header-final.png" alt="EMI Calculator Header" class="header-image mx-auto">
        </div>
          <h1 class="form-title mx-auto">Loan Eligibility Form</h1>
            @csrf
            <div class="grid grid-cols-2 gap-2">
                <div class="form-field">
                    <label for="loan_type" class="form-label">Type of Loan:</label>
                    <select id="loan_type" name="loan_type" class="form-select">
                        <option value="Employee/Consumer Loan">Employee/Consumer Loan</option>
                        <!-- <option value="Standard Education Loan">Standard Education Loan</option>
                        <option value="EducAid">EducAid</option>
                        <option value="Housing Loan">Housing Loan</option>
                        <option value="Transport Loan">Transport Loan</option>
                        <option value="Personal Loan">Personal Loan</option>
                        <option value="Loan to Purchase Share">Loan to Purchase Share</option>
                        <option value="Loan Against Fix Deposit">Loan Against Fix Deposit</option> -->
                    </select>
                </div>
                <div class="form-field">
                    <label for="employment_type" class="form-label">Employment Type:</label>
                    <select name="employment_type" id="employment_type" class="form-select">
                        <option value="Government Employees">Government Employees</option>
                        <option value="Armed Forces">Armed Forces</option>
                        <option value="Government Corporations">Government Corporations</option>
                        <option value="Listed Companies">Listed Companies</option>
                        <option value="NGOs">NGOs</option>
                        <option value="International Organizations">International Organizations</option>
                        <option value="Monastic Body">Monastic Body</option>
                        <option value="Private Companies Employee (Not Listed)">Private Companies (Not Listed)</option>
                        <option value="Contract Employees (Management Level)">Contract Employees (Management Level)</option>
                    </select>
                </div>
                <div class="form-field">
                    <label for="age" class="form-label">Age (Years):</label>
                    <input type="number" id="age" name="age" min="18" required class="form-input">
                </div>
                <div class="form-field">
                    <label for="net_monthly_income" class="form-label">Net Monthly Income (Nu):</label>
                    <input type="number" name="net_monthly_income" id="net_monthly_income" required class="form-input">
                </div>
                <div class="form-field">
                    <label for="loan_amount" class="form-label">Loan Amount (Nu):</label>
                    <input type="number" name="loan_amount" id="loan_amount" required class="form-input">
                </div>
                <div class="form-field flex items-center mb-4">
                    <label class="form-label">Interest Rate (%):</label>
                    <div class="form-radio-label">
                        <input type="radio" name="interest_rate" value="11" required>
                        <span>Fixed Rate (11%)</span>
                    </div>
                    <div class="form-radio-label">
                        <input type="radio" name="interest_rate" value="9.5" required>
                        <span>Floating Rate (9.5%)</span>
                    </div>
                </div>
                <div class="form-field">
                    <label for="loan_term" class="form-label">Loan Term (Months):</label>
                    <input type="number" name="loan_term" id="loan_term" max="60" required class="form-input">
                </div>
                <div id="work_experience_container" class="form-field" style="display: none;">
                    <label for="work_experience" class="form-label">Work Experience:</label>
                    <select name="work_experience" id="work_experience" class="form-select">
                        <!-- Options -->
                    </select>
                </div>
            </div>
            <div class="form-field">
                <button type="submit" class="form-submit-button">Check Eligibility</button>
                <p type="button" id="emiCalculatorButton" class="form-submit-button">Check Your EMI</p>
                </div>
            </form>
            <div id="resultContainer" class="result-container hidden"></div>
        </div>
            
    </div>
    <script>
            document.addEventListener("DOMContentLoaded", function () {
        document.getElementById("emiCalculatorButton").addEventListener("click", function () {
            window.location.href = "/emi-calculator";
        });
    });
document.addEventListener("DOMContentLoaded", function () {
    // Get the interest rate radio buttons
    var fixedRateRadio = document.querySelector('input[value="11"]');
    var floatingRateRadio = document.querySelector('input[value="9.5"]');

    // Get the labels for fixed and floating rate
    var fixedRateLabel = document.querySelector('input[value="11"] + span');
    var floatingRateLabel = document.querySelector('input[value="9.5"] + span');

    // Add click event listeners to the labels
    fixedRateLabel.addEventListener("click", function () {
        fixedRateRadio.checked = true;
    });

    floatingRateLabel.addEventListener("click", function () {
        floatingRateRadio.checked = true;
    });
});

    document.getElementById('loanEligibilityForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent the form from submitting

        var form = this;
        var formData = new FormData(form);

        // Send a POST request to the server with the form data
        fetch(form.action, {
            method: form.method,
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            // Update the result container with the received data
            document.getElementById('resultContainer').innerHTML = data;
            document.getElementById('resultContainer').classList.remove('hidden'); // Show the result container
        
            var formContainer = document.querySelector('.form-container');
        formContainer.style.width = '1000px';
        })
        .catch(error => console.error('Error:', error));
    });
    var workExperienceOptions = {
            'Government Employees': ['On probation period', 'After probation period till 3 years', '3 years and above'],
            'Armed Forces': ['On probation period', 'After probation period till 3 years', '3 years and above'],
            'Government Corporations': ['On probation period', 'After probation period till 3 years', '3 years and above'],
            'Listed Companies': ['On probation period', 'After probation period till 3 years', '3 years and above'],
            'NGOs': ['On probation period', 'After probation period till 3 years', '3 years and above'],
            'International Organizations': ['On probation period', 'After probation period till 3 years', '3 years and above'],
            'Monastic Body': ['On probation period', 'After probation period till 3 years', '3 years and above'],
            'Private Companies Employee (Not Listed)': ['After probation period till 3 years', '3 years till 5 years', '5 years and above']
        };

        function updateWorkExperienceOptions() {
            var employmentType = document.getElementById('employment_type').value;
            var workExperienceContainer = document.getElementById('work_experience_container');
            var workExperienceSelect = document.getElementById('work_experience');

            workExperienceSelect.innerHTML = '';

            var options = workExperienceOptions[employmentType];
            if (options && options.length > 0) {
                for (var i = 0; i < options.length; i++) {
                    var option = document.createElement('option');
                    option.text = options[i];
                    option.value = options[i];
                    workExperienceSelect.appendChild(option);
                }
                workExperienceContainer.style.display = 'block';
            } else {
                workExperienceContainer.style.display = 'none';
            }
        }
        updateWorkExperienceOptions();
        document.getElementById('employment_type').addEventListener('change', updateWorkExperienceOptions);   
</script>    
</body>
</html>
