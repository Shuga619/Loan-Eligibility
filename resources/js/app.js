/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
import { createApp } from 'vue';

/**
 * Next, we will create a fresh Vue application instance. You may then begin
 * registering components with the application instance so they are ready
 * to use in your application's views. An example is included for you.
 */

const app = createApp({});

import ExampleComponent from './components/ExampleComponent.vue';
app.component('example-component', ExampleComponent);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// Object.entries(import.meta.glob('./**/*.vue', { eager: true })).forEach(([path, definition]) => {
//     app.component(path.split('/').pop().replace(/\.\w+$/, ''), definition.default);
// });

/**
 * Finally, we will attach the application instance to a HTML element with
 * an "id" attribute of "app". This element is included with the "auth"
 * scaffolding. Otherwise, you will need to add an element yourself.
 */

app.mount('#app');

   // JavaScript code for eligibility form
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

document.getElementById('emi-form').addEventListener('submit', function (e) {
    e.preventDefault();

    // Get form values
    const loanAmount = parseFloat(document.getElementById('loan_amount').value);
    const interestRate = parseFloat(document.getElementById('interest_rate').value);
    const loanTerm = parseFloat(document.getElementById('loan_term').value);
    const monthlyIncome = parseFloat(document.getElementById('net_monthly_income').value);

    // Calculate EMI
    const monthlyInterest = interestRate / 100 / 12;
    const emi = (loanAmount * monthlyInterest * Math.pow(1 + monthlyInterest, loanTerm)) /
        (Math.pow(1 + monthlyInterest, loanTerm) - 1);

    // Calculate additional values
    const totalPayable = emi * loanTerm;
    const interestPayable = totalPayable - loanAmount;
    const yourTakeaway = monthlyIncome - emi;
    const minimumTakeaway = Math.max(0.3 * monthlyIncome, 4000);

    // Display result
    const emiResult = document.getElementById('emi-result');
    emiResult.innerHTML = `
        EMI: Nu ${emi.toFixed(2)}<br>
        Total Payable: Nu ${totalPayable.toFixed(2)}<br>
        Interest Payable: Nu ${interestPayable.toFixed(2)}<br>
        Your Takeaway: Nu ${yourTakeaway.toFixed(2)}<br>
        Minimum Takeaway: Nu ${minimumTakeaway.toFixed(2)}
    `;

    if (emi > 0.6 * monthlyIncome) {
        emiResult.style.color = 'red';
    } else {
        emiResult.style.color = 'green';
    }

    emiResult.style.display = 'block';
});

