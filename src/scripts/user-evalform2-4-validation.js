function isEmpty(value) {
    return value.trim() === '';
}

function isValidLength(value, maxLength) {
    return value.trim().length <= maxLength;
}

function isPositiveNumber(value) {
    const number = parseFloat(value);
    return !isNaN(number) && number > 0;
}

function startsWithLetter(value) {
    return /^[A-Za-z]/.test(value.trim());
}

function isValidDropdown(value) {
    return value !== '' && value !== 'default';
}

function isValidDateRange(startDate, endDate) {
    const start = new Date(startDate);
    const end = new Date(endDate);
    return start < end;
}

function validateForm2() {
    const form = document.getElementById('form2-form');
    if (!form) {
        console.error('Form 2 not found.');
        return false;
    }

    const errors = [];
    let isValid = true;

    // Helper function for adding validation error
    function addError(input, message) {
        errors.push(message);
        input.classList.add('is-invalid');
        const errorFeedback = document.createElement('div');
        errorFeedback.className = 'invalid-feedback';
        errorFeedback.textContent = message;

        // Remove previous error if present
        const previousError = input.parentNode.querySelector('.invalid-feedback');
        if (previousError) previousError.remove();

        input.parentNode.appendChild(errorFeedback);
    }

    // Helper function to clear validation error
    function clearError(input) {
        input.classList.remove('is-invalid');
        const previousError = input.parentNode.querySelector('.invalid-feedback');
        if (previousError) previousError.remove();
    }

    // 1. Project Title
    const projectTitle = form.querySelector('[name="user_project_title_1"]');
    if (!projectTitle || isEmpty(projectTitle.value) || !startsWithLetter(projectTitle.value) || !isValidLength(projectTitle.value, 255)) {
        addError(projectTitle, 'Project Title must start with a letter, be non-empty, and not exceed 255 characters.');
        isValid = false;
    } else {
        clearError(projectTitle);
    }

    // 2. Implementing Agency
    const implementingAgency = form.querySelector('[name="user_implementing_agency_1"]');
    if (!implementingAgency || isEmpty(implementingAgency.value) || !startsWithLetter(implementingAgency.value) || !isValidLength(implementingAgency.value, 100)) {
        addError(implementingAgency, 'Implementing Agency must start with a letter, be non-empty, and not exceed 100 characters.');
        isValid = false;
    } else {
        clearError(implementingAgency);
    }

    // 3. Start Date
    const startDate = form.querySelector('[name="user_start_date_2"]');
    if (!startDate || isEmpty(startDate.value)) {
        addError(startDate, 'Start Date is required.');
        isValid = false;
    } else {
        clearError(startDate);
    }

    // 4. End Date
    const endDate = form.querySelector('[name="user_end_date_2"]');
    if (!endDate || isEmpty(endDate.value)) {
        addError(endDate, 'End Date is required.');
        isValid = false;
    } else if (new Date(endDate.value) <= new Date(startDate.value)) {
        addError(endDate, 'End Date must be after Start Date.');
        isValid = false;
    } else {
        clearError(endDate);
    }

    // 5. Fund Source
    const fundSource = form.querySelector('[name="user_fund_source_1"]');
    if (!fundSource || isEmpty(fundSource.value) || !startsWithLetter(fundSource.value)) {
        addError(fundSource, 'Fund Source is required and must start with a letter.');
        isValid = false;
    } else {
        clearError(fundSource);
    }

    // 6. Funding Agency
    const fundingAgency = form.querySelector('[name="user_funding_agency_1"]');
    if (!fundingAgency || isEmpty(fundingAgency.value) || !startsWithLetter(fundingAgency.value)) {
        addError(fundingAgency, 'Funding Agency is required and must start with a letter.');
        isValid = false;
    } else {
        clearError(fundingAgency);
    }

    // 7. Total Cost
    const totalCost = form.querySelector('[name="user_total_cost_2"]');
    if (!totalCost || !isPositiveNumber(totalCost.value)) {
        addError(totalCost, 'Total Cost must be a positive number.');
        isValid = false;
    } else {
        clearError(totalCost);
    }

    // 8. Financial Status
    const financialFields = ['user_appropriations_2', 'user_allotment_2', 'user_obligations_2', 'user_disbursements_2'];
    financialFields.forEach((fieldName) => {
        const field = form.querySelector(`[name="${fieldName}"]`);
        if (field && !isPositiveNumber(field.value)) {
            addError(field, `${fieldName.replace(/_/g, ' ')} must be a positive number.`);
            isValid = false;
        } else if (field) {
            clearError(field);
        }
    });

    // 9. Physical Accomplishment
    const targetOWPA = form.querySelector('[name="user_target_owpa_2"]');
    const actualOWPA = form.querySelector('[name="user_actual_owpa_2"]');


    if (targetOWPA && !isPositiveNumber(targetOWPA.value)) {
        addError(targetOWPA, 'Target OWPA must be a positive number.');
        isValid = false;
    } else if (targetOWPA) {
        clearError(targetOWPA);
    }

    if (actualOWPA && !isPositiveNumber(actualOWPA.value)) {
        addError(actualOWPA, 'Actual OWPA must be a positive number.');
        isValid = false;
    } else if (actualOWPA) {
        clearError(actualOWPA);
    }

    // 10. Output Indicator
    const outputIndicator = form.querySelector('[name="user_output_indicator_2"]');
    if (!outputIndicator || isEmpty(outputIndicator.value) || !isValidLength(outputIndicator.value, 255)) {
        addError(outputIndicator, 'Output Indicator must not exceed 255 characters.');
        isValid = false;
    } else {
        clearError(outputIndicator);
    }

    // 11. Employment Generated
    const male = form.querySelector('[name="user_male_2"]');
    const female = form.querySelector('[name="user_female_2"]');

    if (male && !isPositiveNumber(male.value)) {
        addError(male, 'Male count must be a positive number.');
        isValid = false;
    } else if (male) {
        clearError(male);
    }

    if (female && !isPositiveNumber(female.value)) {
        addError(female, 'Female count must be a positive number.');
        isValid = false;
    } else {
        clearError(female);
    }

    // 12. Remarks
    const remarks = form.querySelector('[name="user_remarks_2"]');
    if (!remarks || isEmpty(remarks.value)) {
        addError(remarks, 'Remarks is required.');
        isValid = false;
    } else {
        clearError(remarks);
    }

    // 13. End-of-Project Target
    const endProjectTarget = form.querySelector('[name="user_end_project_target_2"]');
    if (!endProjectTarget || isEmpty(endProjectTarget.value)) {
        addError(endProjectTarget, 'End-of-Project Target is required.');
        isValid = false;
    } else {
        clearError(endProjectTarget);
    }

    // 14. Target to Date
    const targetToDate = form.querySelector('[name="user_target_to_date_2"]');
    if (!targetToDate || isEmpty(targetToDate.value)) {
        addError(targetToDate, 'Target to Date is required.');
        isValid = false;
    } else {
        clearError(targetToDate);
    }

    // 15. Actual to Date
    const actualToDate = form.querySelector('[name="user_actual_to_date_2"]');
    if (!actualToDate || isEmpty(actualToDate.value)) {
        addError(actualToDate, 'Actual to Date is required.');
        isValid = false;
    } else {
        clearError(actualToDate);
    }

    // 16. Submitted By
    const submittedBy = form.querySelector('[name="user_submitted_by_1"]');
    if (!submittedBy || isEmpty(submittedBy.value) || !startsWithLetter(submittedBy.value)) {
        addError(submittedBy, 'Submitted By is required and must start with a letter.');
        isValid = false;
    } else {
        clearError(submittedBy);
    }

    // 17. Designation/Office
    const designation = form.querySelector('[name="user_designation_1"]');
    if (!designation || isEmpty(designation.value) || !startsWithLetter(designation.value)) {
        addError(designation, 'Designation/Office is required and must start with a letter.');
        isValid = false;
    } else {
        clearError(designation);
    }

    // Log errors to the console for debugging
    if (errors.length > 0) {
        console.error('Validation Errors:', errors);
    }

    return isValid;
}

function validateForm3() {
    const form = document.getElementById('form3-form');
    if (!form) {
        console.error('Form 3 not found.');
        return false;
    }

    const errors = [];
    let isValid = true;

    // Helper function for adding validation error
    function addError(input, message) {
        errors.push(message);
        input.classList.add('is-invalid');
        const errorFeedback = document.createElement('div');
        errorFeedback.className = 'invalid-feedback';
        errorFeedback.textContent = message;

        // Remove previous error if present
        const previousError = input.parentNode.querySelector('.invalid-feedback');
        if (previousError) previousError.remove();

        input.parentNode.appendChild(errorFeedback);
    }

    // Helper function to clear validation error
    function clearError(input) {
        input.classList.remove('is-invalid');
        const previousError = input.parentNode.querySelector('.invalid-feedback');
        if (previousError) previousError.remove();
    }

    // 1. Project Title
    const projectTitle = form.querySelector('[name="user_project_title_1"]');
    if (!projectTitle || isEmpty(projectTitle.value) || !startsWithLetter(projectTitle.value) || !isValidLength(projectTitle.value, 255)) {
        addError(projectTitle, 'Project Title must start with a letter, be non-empty, and not exceed 255 characters.');
        isValid = false;
    } else {
        clearError(projectTitle);
    }

    // 2. Implementing Agency
    const implementingAgency = form.querySelector('[name="user_implementing_agency_1"]');
    if (!implementingAgency || isEmpty(implementingAgency.value) || !startsWithLetter(implementingAgency.value) || !isValidLength(implementingAgency.value, 100)) {
        addError(implementingAgency, 'Implementing Agency must start with a letter, be non-empty, and not exceed 100 characters.');
        isValid = false;
    } else {
        clearError(implementingAgency);
    }

    // 3. Sector
    const sector = form.querySelector('[name="user_sector_1"]');
    if (!sector || !isValidDropdown(sector.value)) {
        addError(sector, 'Sector is required. Please select a valid option.');
        isValid = false;
    } else {
        clearError(sector);
    }

    // 4. Location
    const province = form.querySelector('[name="user_province_1"]');
    if (!province || isEmpty(province.value) || !startsWithLetter(province.value) || !isValidLength(province.value, 100)) {
        addError(province, 'Province must start with a letter, be non-empty, and not exceed 100 characters.');
        isValid = false;
    } else {
        clearError(province);
    }

    const city = form.querySelector('[name="user_city_1"]');
    if (!city || isEmpty(city.value) || !startsWithLetter(city.value) || !isValidLength(city.value, 100)) {
        addError(city, 'City must start with a letter, be non-empty, and not exceed 100 characters.');
        isValid = false;
    } else {
        clearError(city);
    }

    const barangay = form.querySelector('[name="user_barangay_1"]');
    if (barangay && (!startsWithLetter(barangay.value) || !isValidLength(barangay.value, 100))) {
        addError(barangay, 'Barangay must start with a letter and not exceed 100 characters.');
        isValid = false;
    } else if (barangay) {
        clearError(barangay);
    }

    // 5. Findings
    const findings = form.querySelector('[name="user_findings_3"]');
    if (!findings || isEmpty(findings.value) || !isValidLength(findings.value, 255)) {
        addError(findings, 'Findings must be non-empty and not exceed 255 characters.');
        isValid = false;
    } else {
        clearError(findings);
    }

    // 6. Typology
    const typology = form.querySelector('[name="user_typology_3"]');
    if (!typology || !isValidDropdown(typology.value)) {
        addError(typology, 'Typology is required. Please select a valid option.');
        isValid = false;
    } else {
        clearError(typology);
    }

    // 7. Issue Status
    const issueStatus = form.querySelector('[name="user_issue_status_3"]');
    if (!issueStatus || !isValidDropdown(issueStatus.value)) {
        addError(issueStatus, 'Issue Status is required. Please select a valid option.');
        isValid = false;
    } else {
        clearError(issueStatus);
    }

    // 8. Reasons
    const reasons = form.querySelector('[name="user_reasons_3"]');
    if (!reasons || isEmpty(reasons.value) || !isValidLength(reasons.value, 500)) {
        addError(reasons, 'Reasons must not exceed 500 characters.');
        isValid = false;
    } else {
        clearError(reasons);
    }

    // 9. Actions Taken
    const actionsTaken = form.querySelector('[name="user_actions_taken_3"]');
    if (!actionsTaken || isEmpty(actionsTaken.value) || !isValidLength(actionsTaken.value, 500)) {
        addError(actionsTaken, 'Actions Taken must not exceed 500 characters.');
        isValid = false;
    } else {
        clearError(actionsTaken);
    }

    // 10. Actions to Be Taken
    const actionsToBeTaken = form.querySelector('[name="user_actions_to_be_taken_3"]');
    if (!actionsToBeTaken || isEmpty(actionsToBeTaken.value) || !isValidLength(actionsToBeTaken.value, 500)) {
        addError(actionsToBeTaken, 'Actions to Be Taken must not exceed 500 characters.');
        isValid = false;
    } else {
        clearError(actionsToBeTaken);
    }

    // 11. Submitted By
    const submittedBy = form.querySelector('[name="user_submit_by_1"]');
    if (!submittedBy || isEmpty(submittedBy.value) || !startsWithLetter(submittedBy.value)) {
        addError(submittedBy, 'Submitted By is required and must start with a letter.');
        isValid = false;
    } else {
        clearError(submittedBy);
    }

    // 12. Designation/Office
    const designation = form.querySelector('[name="user_designation_1"]');
    if (!designation || isEmpty(designation.value) || !startsWithLetter(designation.value)) {
        addError(designation, 'Designation/Office is required and must start with a letter.');
        isValid = false;
    } else {
        clearError(designation);
    }

    // Log errors to the console for debugging
    if (errors.length > 0) {
        console.error('Validation Errors:', errors);
    }

    return isValid;
}

function validateForm4() {
    const form = document.getElementById('form4-form');
    if (!form) {
        console.error('Form 4 not found.');
        return false;
    }

    const errors = [];
    let isValid = true;

    // Helper function for adding validation error
    function addError(input, message) {
        errors.push(message);
        input.classList.add('is-invalid');
        const errorFeedback = document.createElement('div');
        errorFeedback.className = 'invalid-feedback';
        errorFeedback.textContent = message;

        // Remove previous error if present
        const previousError = input.parentNode.querySelector('.invalid-feedback');
        if (previousError) previousError.remove();

        input.parentNode.appendChild(errorFeedback);
    }

    // Helper function to clear validation error
    function clearError(input) {
        input.classList.remove('is-invalid');
        const previousError = input.parentNode.querySelector('.invalid-feedback');
        if (previousError) previousError.remove();
    }

    // 1. Project Title
    const projectTitle = form.querySelector('[name="user_project_title_1"]');
    if (!projectTitle || isEmpty(projectTitle.value) || !startsWithLetter(projectTitle.value) || !isValidLength(projectTitle.value, 255)) {
        addError(projectTitle, 'Project Title must start with a letter, be non-empty, and not exceed 255 characters.');
        isValid = false;
    } else {
        clearError(projectTitle);
    }

    // 2. Implementing Agency
    const implementingAgency = form.querySelector('[name="user_implementing_agency_1"]');
    if (!implementingAgency || isEmpty(implementingAgency.value) || !startsWithLetter(implementingAgency.value) || !isValidLength(implementingAgency.value, 100)) {
        addError(implementingAgency, 'Implementing Agency must start with a letter, be non-empty, and not exceed 100 characters.');
        isValid = false;
    } else {
        clearError(implementingAgency);
    }

    // 3. Program/Project Objectives
    const objectives = form.querySelector('[name="user_objectives_4"]');
    if (!objectives || isEmpty(objectives.value) || !isValidLength(objectives.value, 500)) {
        addError(objectives, 'Program/Project Objectives must not exceed 500 characters.');
        isValid = false;
    } else {
        clearError(objectives);
    }

    // 4. Results/Outcome Indicator/Target
    const resultIndicator = form.querySelector('[name="user_result_indicator_4"]');
    if (!resultIndicator || isEmpty(resultIndicator.value) || !isValidLength(resultIndicator.value, 500)) {
        addError(resultIndicator, 'Results/Outcome Indicator/Target must not exceed 500 characters.');
        isValid = false;
    } else {
        clearError(resultIndicator);
    }

    // 5. Observed Results/Outcome/Impact
    const observedResults = form.querySelector('[name="user_observed_results_4"]');
    if (!observedResults || isEmpty(observedResults.value) || !isValidLength(observedResults.value, 500)) {
        addError(observedResults, 'Observed Results/Outcome/Impact must not exceed 500 characters.');
        isValid = false;
    } else {
        clearError(observedResults);
    }

    // 6. Submitted By
    const submittedBy = form.querySelector('[name="user_submitted_by_1"]');
    if (!submittedBy || isEmpty(submittedBy.value) || !startsWithLetter(submittedBy.value) || !isValidLength(submittedBy.value, 100)) {
        addError(submittedBy, 'Submitted By is required, must start with a letter, and not exceed 100 characters.');
        isValid = false;
    } else {
        clearError(submittedBy);
    }

    // 7. Designation/Office
    const designation = form.querySelector('[name="user_designation_1"]');
    if (!designation || isEmpty(designation.value) || !startsWithLetter(designation.value) || !isValidLength(designation.value, 100)) {
        addError(designation, 'Designation/Office is required, must start with a letter, and not exceed 100 characters.');
        isValid = false;
    } else {
        clearError(designation);
    }

    // Log errors to the console for debugging
    if (errors.length > 0) {
        console.error('Validation Errors:', errors);
    }

    return isValid;
}

