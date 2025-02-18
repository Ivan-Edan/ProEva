    function enforceNumberInput() {
        const numberInputs = document.querySelectorAll('input[type="number"]');
        numberInputs.forEach((input) => {
            input.addEventListener('input', () => {
                // Remove invalid characters
                input.value = input.value.replace(/[^0-9.]/g, '');
            });

            input.addEventListener('keypress', (event) => {
                // Allow only numbers and one decimal point
                const char = String.fromCharCode(event.which);
                if (!/[\d.]/.test(char) || (char === '.' && input.value.includes('.'))) {
                    event.preventDefault();
                }
            });
        });
    }

    function isEmpty(value) {
        return value.trim() === '';
    }

    function isValidLength(value, maxLength) {
        return value.trim().length <= maxLength;
    }

    function startsWithLetter(value) {
        return /^[A-Za-z]/.test(value.trim());
    }

    function isPositiveNumber(value) {
        const number = parseFloat(value);
        return !isNaN(number) && number > 0 && /^\d+(\.\d+)?$/.test(value.trim());
    }
    

    function isValidPercentage(value) {
        const number = parseFloat(value);
        return !isNaN(number) && number >= 0 && number <= 100;
    }

    function isValidDropdown(value) {
        return value !== '' && value !== 'default';
    }

    function isValidDateRange(startDate, endDate) {
        const start = new Date(startDate);
        const end = new Date(endDate);
        return start < end;
    }

    function validateProjectDetailsSection(projectForm, projectCount) {
        const errors = [];
    
        // Helper functions to display and clear error messages
        function displayError(field, message) {
            const feedback = field.parentNode.querySelector('.invalid-feedback');
            if (feedback) {
                feedback.textContent = message;
                feedback.style.display = 'block';
            }
            field.classList.add('is-invalid');
        }
    
        function clearError(field) {
            const feedback = field.parentNode.querySelector('.invalid-feedback');
            if (feedback) {
                feedback.textContent = '';
                feedback.style.display = 'none';
            }
            field.classList.remove('is-invalid');
        }
    
        // 1. Project Title
        const projectTitle = projectForm.querySelector(`[name="project_title_${projectCount}"]`);
        if (!projectTitle || isEmpty(projectTitle.value)) {
            displayError(projectTitle, 'Project Title is required.');
            errors.push(`Form ${projectCount}: Project Title is required.`);
        } else if (!startsWithLetter(projectTitle.value)) {
            displayError(projectTitle, 'Project Title must start with a letter.');
            errors.push(`Form ${projectCount}: Project Title must start with a letter.`);
        } else if (!isValidLength(projectTitle.value, 255)) {
            displayError(projectTitle, 'Project Title must not exceed 255 characters.');
            errors.push(`Form ${projectCount}: Project Title must not exceed 255 characters.`);
        } else {
            clearError(projectTitle);
        }
    
        // 2. Year
        const year = projectForm.querySelector(`[name="project_year_${projectCount}"]`);
        if (!year || !isValidDropdown(year.value)) {
            displayError(year, 'Year is required. Please select a valid option.');
            errors.push(`Form ${projectCount}: Year is required.`);
        } else {
            clearError(year);
        }
    
        // 3. Implementing Agency
        const implementingAgency = projectForm.querySelector(`[name="implementing_agency_${projectCount}"]`);
        if (!implementingAgency || isEmpty(implementingAgency.value)) {
            displayError(implementingAgency, 'Implementing Agency is required.');
            errors.push(`Form ${projectCount}: Implementing Agency is required.`);
        } else if (!startsWithLetter(implementingAgency.value)) {
            displayError(implementingAgency, 'Implementing Agency must start with a letter.');
            errors.push(`Form ${projectCount}: Implementing Agency must start with a letter.`);
        } else if (!isValidLength(implementingAgency.value, 100)) {
            displayError(implementingAgency, 'Implementing Agency must not exceed 100 characters.');
            errors.push(`Form ${projectCount}: Implementing Agency must not exceed 100 characters.`);
        } else {
            clearError(implementingAgency);
        }
    
        // 4. Component Details
        const componentDetails = projectForm.querySelector(`[name="comp_details_${projectCount}"]`);
        if (componentDetails && (!startsWithLetter(componentDetails.value) || !isValidLength(componentDetails.value, 255))) {
            displayError(componentDetails, 'Component Details must start with a letter and not exceed 255 characters.');
            errors.push(`Form ${projectCount}: Component Details must start with a letter and not exceed 255 characters.`);
        } else if (componentDetails) {
            clearError(componentDetails);
        }
    
        // 5. Fund Source
        const fundSource = projectForm.querySelector(`[name="fund_source_${projectCount}"]`);
        if (!fundSource || !isValidDropdown(fundSource.value)) {
            displayError(fundSource, 'Fund Source is required. Please select a valid option.');
            errors.push(`Form ${projectCount}: Fund Source is required.`);
        } else {
            clearError(fundSource);
        }
    
        // 6. Funding Agency
        const fundingAgency = projectForm.querySelector(`[name="fund_agency_${projectCount}"]`);
        if (!fundingAgency || isEmpty(fundingAgency.value)) {
            displayError(fundingAgency, 'Funding Agency is required.');
            errors.push(`Form ${projectCount}: Funding Agency is required.`);
        } else if (!startsWithLetter(fundingAgency.value)) {
            displayError(fundingAgency, 'Funding Agency must start with a letter.');
            errors.push(`Form ${projectCount}: Funding Agency must start with a letter.`);
        } else if (!isValidLength(fundingAgency.value, 100)) {
            displayError(fundingAgency, 'Funding Agency must not exceed 100 characters.');
            errors.push(`Form ${projectCount}: Funding Agency must not exceed 100 characters.`);
        } else {
            clearError(fundingAgency);
        }
    
        // 7. Mode of Implementation
        const modeOfImplementation = projectForm.querySelector(`[name="mode_of_implementation_${projectCount}"]`);
        if (!modeOfImplementation || !isValidDropdown(modeOfImplementation.value)) {
            displayError(modeOfImplementation, 'Mode of Implementation is required. Please select a valid option.');
            errors.push(`Form ${projectCount}: Mode of Implementation is required.`);
        } else {
            clearError(modeOfImplementation);
        }
    
        // 8. Sector
        const sector = projectForm.querySelector(`[name="sector_${projectCount}"]`);
        if (!sector || !isValidDropdown(sector.value)) {
            displayError(sector, 'Sector is required. Please select a valid option.');
            errors.push(`Form ${projectCount}: Sector is required.`);
        } else {
            clearError(sector);
        }
    
        // 9. Total Cost
        const totalCost = projectForm.querySelector(`[name="total_cost_${projectCount}"]`);
        if (!totalCost || !isPositiveNumber(totalCost.value)) {
            displayError(totalCost, 'Total Cost must be a positive number.');
            errors.push(`Form ${projectCount}: Total Cost must be a positive number.`);
        } else {
            clearError(totalCost);
        }
    
        // 10. Start Date
        const startDate = projectForm.querySelector(`[name="start_date_${projectCount}"]`);
        const endDate = projectForm.querySelector(`[name="end_date_${projectCount}"]`);
        if (!startDate || isEmpty(startDate.value)) {
            displayError(startDate, 'Start Date is required.');
            errors.push(`Form ${projectCount}: Start Date is required.`);
        } else if (endDate && !isValidDateRange(startDate.value, endDate.value)) {
            displayError(startDate, 'Start Date must be before the End Date.');
            errors.push(`Form ${projectCount}: Start Date must be before the End Date.`);
        } else {
            clearError(startDate);
        }
    
        // 11. End Date
        if (!endDate || isEmpty(endDate.value)) {
            displayError(endDate, 'End Date is required.');
            errors.push(`Form ${projectCount}: End Date is required.`);
        } else if (startDate && !isValidDateRange(startDate.value, endDate.value)) {
            displayError(endDate, 'End Date must be after the Start Date.');
            errors.push(`Form ${projectCount}: End Date must be after the Start Date.`);
        } else {
            clearError(endDate);
        }
    
        return errors;
    }
    

    function validateLocationSection(projectForm, projectCount) {
        const errors = [];
    
        // Helper functions to display and clear error messages
        function displayError(field, message) {
            const feedback = field.parentNode.querySelector('.invalid-feedback');
            if (feedback) {
                feedback.textContent = message;
                feedback.style.display = 'block';
            }
            field.classList.add('is-invalid');
        }
    
        function clearError(field) {
            const feedback = field.parentNode.querySelector('.invalid-feedback');
            if (feedback) {
                feedback.textContent = '';
                feedback.style.display = 'none';
            }
            field.classList.remove('is-invalid');
        }
    
        // Validate Province
        const province = projectForm.querySelector(`[name="location_${projectCount}"]`);
        if (!province || isEmpty(province.value)) {
            displayError(province, 'Province is required.');
            errors.push(`Form ${projectCount}: Province is required.`);
        } else if (!startsWithLetter(province.value)) {
            displayError(province, 'Province must start with a letter.');
            errors.push(`Form ${projectCount}: Province must start with a letter.`);
        } else if (!isValidLength(province.value, 100)) {
            displayError(province, 'Province must not exceed 100 characters.');
            errors.push(`Form ${projectCount}: Province must not exceed 100 characters.`);
        } else {
            clearError(province);
        }
    
        // Validate City
        const city = projectForm.querySelector(`[name="city_${projectCount}"]`);
        if (!city || isEmpty(city.value)) {
            displayError(city, 'City is required.');
            errors.push(`Form ${projectCount}: City is required.`);
        } else if (!startsWithLetter(city.value)) {
            displayError(city, 'City must start with a letter.');
            errors.push(`Form ${projectCount}: City must start with a letter.`);
        } else if (!isValidLength(city.value, 100)) {
            displayError(city, 'City must not exceed 100 characters.');
            errors.push(`Form ${projectCount}: City must not exceed 100 characters.`);
        } else {
            clearError(city);
        }
    
        // Validate Barangay
        const barangay = projectForm.querySelector(`[name="barangay_${projectCount}"]`);
        if (barangay && (!startsWithLetter(barangay.value) || !isValidLength(barangay.value, 100))) {
            displayError(barangay, 'Barangay must start with a letter and not exceed 100 characters.');
            errors.push(`Form ${projectCount}: Barangay must start with a letter and not exceed 100 characters.`);
            barangay.classList.add('is-invalid');
        } else if (barangay) {
            clearError(barangay);
        }
    
        return errors;
    }
    
    function validateAdditionalDetailsSection(projectForm, projectCount) {
        const errors = [];
    
        // Helper functions to display and clear error messages
        function displayError(field, message) {
            const feedback = field.parentNode.querySelector('.invalid-feedback');
            if (feedback) {
                feedback.textContent = message;
                feedback.style.display = 'block';
            }
            field.classList.add('is-invalid');
        }
    
        function clearError(field) {
            const feedback = field.parentNode.querySelector('.invalid-feedback');
            if (feedback) {
                feedback.textContent = '';
                feedback.style.display = 'none';
            }
            field.classList.remove('is-invalid');
        }
    
        // Validate Remarks
        const remarks = projectForm.querySelector(`[name="remarks_${projectCount}"]`);
        if (!remarks || !isValidDropdown(remarks.value)) {
            displayError(remarks, 'Remarks is required. Please select a valid option.');
            errors.push(`Form ${projectCount}: Remarks is required.`);
        } else {
            clearError(remarks);
        }
    
        return errors;
    }
    

    function validateTargetEmploymentSection(projectForm, projectCount) {
        const errors = [];
    
        // Helper functions to display and clear error messages
        function displayError(field, message) {
            const feedback = field.parentNode.querySelector('.invalid-feedback');
            if (feedback) {
                feedback.textContent = message;
                feedback.style.display = 'block';
            }
            field.classList.add('is-invalid');
        }
    
        function clearError(field) {
            const feedback = field.parentNode.querySelector('.invalid-feedback');
            if (feedback) {
                feedback.textContent = '';
                feedback.style.display = 'none';
            }
            field.classList.remove('is-invalid');
        }
    
        // Validate Male Count
        const male = projectForm.querySelector(`[name="male_${projectCount}"]`);
        if (male && !isPositiveNumber(male.value)) {
            displayError(male, 'Male count must be a positive number.');
            errors.push(`Form ${projectCount}: Male count must be a positive number.`);
        } else if (male) {
            clearError(male);
        }
    
        // Validate Female Count
        const female = projectForm.querySelector(`[name="female_${projectCount}"]`);
        if (female && !isPositiveNumber(female.value)) {
            displayError(female, 'Female count must be a positive number.');
            errors.push(`Form ${projectCount}: Female count must be a positive number.`);
        } else if (female) {
            clearError(female);
        }
    
        // Validate Output Indicators
        const outputIndicators = projectForm.querySelectorAll(`[name^="output_indicator_${projectCount}_"]`);
        const targetOutputs = projectForm.querySelectorAll(`[name^="target_output_${projectCount}_"]`);
    
        outputIndicators.forEach((outputIndicator, index) => {
            if (!outputIndicator || isEmpty(outputIndicator.value) || !isValidLength(outputIndicator.value, 255)) {
                displayError(outputIndicator, `Indicator ${index + 1}: Output Indicator is required and must not exceed 255 characters.`);
                errors.push(`Form ${projectCount}, Indicator ${index + 1}: Output Indicator is required and must not exceed 255 characters.`);
            } else {
                clearError(outputIndicator);
            }
        });
    
        targetOutputs.forEach((targetOutput, index) => {
            if (!targetOutput || isEmpty(targetOutput.value) || !isValidLength(targetOutput.value, 255)) {
                displayError(targetOutput, `Indicator ${index + 1}: Target Output is required and must not exceed 255 characters.`);
                errors.push(`Form ${projectCount}, Indicator ${index + 1}: Target Output is required and must not exceed 255 characters.`);
            } else {
                clearError(targetOutput);
            }
        });
    
        if (outputIndicators.length === 0) {
            console.warn(`Form ${projectCount}: No indicators added. Skipping validation for indicators.`);
        }
    
        return errors;
    }
    
    function validateYearFinancialTargets(projectForm, projectCount) {
        const errors = [];
    
        // Helper functions to display and clear error messages
        function displayError(field, message) {
            const feedback = field.parentNode.querySelector('.invalid-feedback');
            if (feedback) {
                feedback.textContent = message;
                feedback.style.display = 'block';
            }
            field.classList.add('is-invalid');
        }
    
        function clearError(field) {
            const feedback = field.parentNode.querySelector('.invalid-feedback');
            if (feedback) {
                feedback.textContent = '';
                feedback.style.display = 'none';
            }
            field.classList.remove('is-invalid');
        }
    
        // Validate Financial Target
        const financialTarget = projectForm.querySelector(`[name="year_financial_target_${projectCount}"]`);
        if (!financialTarget || !isPositiveNumber(financialTarget.value)) {
            displayError(financialTarget, 'Total Financial Target must be a positive number.');
            errors.push(`Form ${projectCount}: Total Financial Target must be a positive number.`);
        } else {
            clearError(financialTarget);
        }
    
        // Validate Physical Target
        const physicalTarget = projectForm.querySelector(`[name="year_phy_target_percent_${projectCount}"]`);
        if (!physicalTarget || !isPositiveNumber(physicalTarget.value) || !isValidPercentage(physicalTarget.value)) {
            displayError(physicalTarget, 'Total Physical Target must be a positive percentage (0-100).');
            errors.push(`Form ${projectCount}: Total Physical Target must be a positive percentage (0-100).`);
        } else {
            clearError(physicalTarget);
        }
    
        return errors;
    }
    function validateMonthlyTargets(projectForm, projectCount) {
        const errors = [];
    
        // Helper functions to display and clear error messages
        function displayError(field, message) {
            const feedback = field.parentNode.querySelector('.invalid-feedback');
            if (feedback) {
                feedback.textContent = message;
                feedback.style.display = 'block';
            }
            field.classList.add('is-invalid');
        }
    
        function clearError(field) {
            const feedback = field.parentNode.querySelector('.invalid-feedback');
            if (feedback) {
                feedback.textContent = '';
                feedback.style.display = 'none';
            }
            field.classList.remove('is-invalid');
        }
    
        const financialTargets = projectForm.querySelectorAll(`[name="financial_target_${projectCount}[]"]`);
        const physicalTargets = projectForm.querySelectorAll(`[name="physical_target_percent_${projectCount}[]"]`);
    
        startMonths.forEach((index) => {
            const financialTarget = financialTargets[index];
            const physicalTarget = physicalTargets[index];
    
            // Check if any of the fields in the current month are filled
            const isMonthFilled =
                financialTarget.value.trim() ||
                physicalTarget.value.trim();
    
            // If none of the fields are filled, skip validation for this month
            if (!isMonthFilled) {
                return;
            }
            // Financial Target Validation
            if (financialTarget && !isPositiveNumber(financialTarget.value)) {
                displayError(financialTarget, `Financial Target must be a positive number.`);
                errors.push(`Form ${projectCount}, Month ${index + 1}: Financial Target must be a positive number.`);
            } else if (financialTarget) {
                clearError(financialTarget);
            }
    
            // Physical Target Validation
            if (!physicalTarget || !isPositiveNumber(physicalTarget.value) || !isValidPercentage(physicalTarget.value)) {
                displayError(physicalTarget, `Physical Target must be a positive percentage (0-100).`);
                errors.push(`Form ${projectCount}, Month ${index + 1}: Physical Target must be a positive percentage (0-100).`);
            } else {
                clearError(physicalTarget);
            }
        });
    
        return errors;
    }
    
    function validateSubmissionSection(projectForm, projectCount) {
        const errors = [];
    
        // Helper functions to display and clear error messages
        function displayError(field, message) {
            const feedback = field.parentNode.querySelector('.invalid-feedback');
            if (feedback) {
                feedback.textContent = message;
                feedback.style.display = 'block';
            }
            field.classList.add('is-invalid');
        }
    
        function clearError(field) {
            const feedback = field.parentNode.querySelector('.invalid-feedback');
            if (feedback) {
                feedback.textContent = '';
                feedback.style.display = 'none';
            }
            field.classList.remove('is-invalid');
        }
    
        const submittedBy = projectForm.querySelector(`[name="submitted_by_${projectCount}"]`);
        if (!submittedBy || isEmpty(submittedBy.value) || !startsWithLetter(submittedBy.value) || !isValidLength(submittedBy.value, 100)) {
            displayError(submittedBy, `Submitted By must start with a letter, be non-empty, and not exceed 100 characters.`);
            errors.push(`Form ${projectCount}: Submitted By must start with a letter, be non-empty, and not exceed 100 characters.`);
        } else {
            clearError(submittedBy);
        }
    
        const designationOffice = projectForm.querySelector(`[name="submitted_designation_${projectCount}"]`);
        if (!designationOffice || isEmpty(designationOffice.value) || !startsWithLetter(designationOffice.value) || !isValidLength(designationOffice.value, 100)) {
            displayError(designationOffice, `Designation/Office must start with a letter, be non-empty, and not exceed 100 characters.`);
            errors.push(`Form ${projectCount}: Designation/Office must start with a letter, be non-empty, and not exceed 100 characters.`);
        } else {
            clearError(designationOffice);
        }
    
        return errors;
    }
    

function validateForm(projectForm, projectCount) {
    let errors = [];

    // Validate individual sections
    errors = errors.concat(validateProjectDetailsSection(projectForm, projectCount));
    errors = errors.concat(validateLocationSection(projectForm, projectCount));
    errors = errors.concat(validateAdditionalDetailsSection(projectForm, projectCount));
    errors = errors.concat(validateTargetEmploymentSection(projectForm, projectCount));
    errors = errors.concat(validateYearFinancialTargets(projectForm, projectCount));
    errors = errors.concat(validateMonthlyTargets(projectForm, projectCount));
    errors = errors.concat(validateSubmissionSection(projectForm, projectCount));

    return errors;
}
