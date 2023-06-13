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
<form method="POST" action="{{ route('loan-eligibility.check') }}" class="max-w-md mx-auto p-4 shadow-lg rounded mt-5">
    @csrf
    <h1 class="text-2xl font-bold mb-4">Loan Eligibility Form</h1>
    <div class="grid grid-cols-2 gap-4">
    <div class="col-span-2">
    <label for="loan_type" class="block font-bold mb-1">Types of Loan</label>
    <select id="loan_type" name="loan_type" class="w-full p-2 border border-gray-300 rounded">
        <option value="Employee/Consumer Loan">Employee/Consumer Loan</option>
        <option value="Standard Education Loan">Standard Education Loan</option>
        <option value="EducAid">EducAid</option>
        <option value="Housing Loan">Housing Loan</option>
        <option value="Transport Loan">Transport Loan</option>
        <option value="Personal Loan">Personal Loan</option>
        <option value="Loan to Purchase Share">Loan to Purchase Share</option>
        <option value="Loan Against Fix Deposit">Loan Against Fix Deposit</option>
    </select>
    </div>
        <div>
            <label for="employment_type" class="block font-bold mb-1">Employment Type:</label>
            <select name="employment_type" id="employment_type" class="w-full p-2 border border-gray-300 rounded">
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
        <div>
            <label for="age" class="block font-bold mb-1">Age:</label>
            <input type="number" id="age" name="age" min="18" required class="w-full p-2 border border-gray-300 rounded">
        </div>
        <div>
            <label for="net_monthly_income" class="block font-bold mb-1">Net Monthly Income:</label>
            <input type="number" name="net_monthly_income" id="net_monthly_income" required class="w-full p-2 border border-gray-300 rounded">
        </div>
        <div>
            <label for="loan_amount" class="block font-bold mb-1">Loan Amount (in Nu):</label>
            <input type="number" name="loan_amount" id="loan_amount" required class="w-full p-2 border border-gray-300 rounded">
        </div>
        <div>
            <label for="interest_rate" class="block font-bold mb-1">Interest Rate:</label>
            <input type="number" name="interest_rate" id="interest_rate" required class="w-full p-2 border border-gray-300 rounded">
        </div>
        <div>
            <label for="loan_term" class="block font-bold mb-1">Loan Term (in months):</label>
            <input type="number" name="loan_term" id="loan_term" max="60" required class="w-full p-2 border border-gray-300 rounded">
        </div>
        <div id="work_experience_container" class="col-span-2" style="display: none;">
            <label for="work_experience" class="block font-bold mb-1">Work Experience:</label>
            <select name="work_experience" id="work_experience" class="w-full p-2 border border-gray-300 rounded">
                <!-- options -->
            </select>
        </div>
    </div>
    <div class="mt-4">
        <button type="submit" class="hover:bg-blue-400 text-white font-bold py-2 px-4 border-b-4 border-blue-700 hover:border-blue-500 rounded">Check Eligibility</button>
    </div>
</form>

<script>
    // Map employment types to their corresponding work experience options
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

    // Function to update the work experience options based on the selected employment type
    function updateWorkExperienceOptions() {
        var employmentType = document.getElementById('employment_type').value;
        var workExperienceContainer = document.getElementById('work_experience_container');
        var workExperienceSelect = document.getElementById('work_experience');

        // Clear previous options
        workExperienceSelect.innerHTML = '';

        // Add new options based on the selected employment type
        var options = workExperienceOptions[employmentType];
        for (var i = 0; i < options.length; i++) {
            var option = document.createElement('option');
            option.text = options[i];
            option.value = options[i];
            workExperienceSelect.appendChild(option);
        }

        // Show or hide the work experience field based on the selected employment type
        if (options && options.length > 0) {
            workExperienceContainer.style.display = 'block';
        } else {
            workExperienceContainer.style.display = 'none';
        }
    }

    // Update the work experience options initially
    updateWorkExperienceOptions();

    // Add an event listener to update the work experience options whenever the employment type is changed
    document.getElementById('employment_type').addEventListener('change', updateWorkExperienceOptions);
</script>
</body>
</html>
