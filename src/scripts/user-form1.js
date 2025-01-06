function loadForm1Logic() {
    let projectCount = 0;

    const projectFormsContainer = document.getElementById('project-forms-container'); // Container for dynamic forms
    const addProjectFormButton = document.getElementById('add-project-form'); // Button to add new project forms
    const cancelButton = document.getElementById('cancel-btn'); // Form 1's Cancel button
    const formsList = document.getElementById('forms-list'); // Form selection list
    const formContent = document.getElementById('form-content'); // Content container for active form
    const quarterContainer = document.getElementById('quarter-container'); // Quarter display
    const submittedFormsContainer = document.getElementById('submitted-forms-container'); // Submitted forms table
    const paginationContainer = document.getElementById('pagination-container');
    const submitButton = document.getElementById('submit-btn-form1');

    // Function to create a collapsible project form
    function createProjectForm() {
        projectCount++;
        const formId = `project-form-${projectCount}`;

        // Create collapsible structure
        const projectForm = document.createElement('div');
        projectForm.classList.add('accordion-item', 'mb-3');
        projectForm.setAttribute('id', formId);
        projectForm.innerHTML = `
            <h2 class="accordion-header" id="heading-${projectCount}">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-${projectCount}" aria-expanded="false" aria-controls="collapse-${projectCount}">
                    Project ${projectCount}
                </button>
            </h2>
            <div id="collapse-${projectCount}" class="accordion-collapse collapse" aria-labelledby="heading-${projectCount}" data-bs-parent="#project-forms-container">
                <div class="accordion-body">
                    <form id="user_form_${projectCount}" class="user-form">
                        <!-- Project Details Section -->
                        <h5>Project Details</h5>
                        <div class="row mb-3">
                            <div class="col-md-5">
                                <label for="project_title_${projectCount}">Program / Project Title:</label>
                                <input type="text" class="form-control" id="project_title_${projectCount}" name="project_title_${projectCount}" required>
                            </div>
                            <div class="col-md-2">
                                <label for="year_${projectCount}">Year:</label>
                                <select class="form-control" id="year_${projectCount}" name="project_year_${projectCount}">
                                    <option value="2024">2024</option>
                                    <option value="2023">2023</option>
                                    <option value="2022">2022</option>
                                    <option value="2021">2021</option>
                                    <option value="2020">2020</option>
                                </select>
                            </div>
                            <div class="col-md-5">
                                <label for="implementing_agency_${projectCount}">Implementing Agency:</label>
                                <input type="text" class="form-control" id="implementing_agency_${projectCount}" name="implementing_agency_${projectCount}" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="component_details_${projectCount}">Component Details:</label>
                                <input type="text" class="form-control" id="user_component_details_${projectCount}" name="comp_details_${projectCount}" required>
                            </div>
                            <div class="col-md-3">
                                <label for="fund_source_${projectCount}">Fund Source:</label>
                                <input type="text" class="form-control" id="user_fund_source_${projectCount}" name="fund_source_${projectCount}" required>
                            </div>
                            <div class="col-md-3">
                                <label for="funding_agency_${projectCount}">Funding Agency:</label>
                                <input type="text" class="form-control" id="user_funding_agency_${projectCount}" name="fund_agency_${projectCount}" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label for="mode_implementation_${projectCount}">Mode of Implementation:</label>
                                <input type="text" class="form-control" id="user_mode_implementation_${projectCount}" name="mode_of_implementation_${projectCount}" required>
                            </div>
                            <div class="col-md-2">
                                <label for="sector_${projectCount}">Sector:</label>
                                <input type="text" class="form-control" id="user_sector_${projectCount}" name="sector_${projectCount}" required>
                            </div>
                            <div class="col-md-3">
                                <label for="total_cost_${projectCount}">Total Program / Project Cost (PHP):</label>
                                <input type="text" class="form-control" id="user_total_cost_${projectCount}" name="total_cost_${projectCount}" required>
                            </div>
                            <div class="col-md-2">
                                <label for="start_date_${projectCount}">Start Date:</label>
                                <input type="date" class="form-control" id="user_start_date_${projectCount}" name="start_date_${projectCount}" required>
                            </div>
                            <div class="col-md-2">
                                <label for="end_date_${projectCount}">End Date:</label>
                                <input type="date" class="form-control" id="user_end_date_${projectCount}" name="end_date_${projectCount}" required>
                            </div>
                        </div>

                        <h5>Location</h5>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="province_${projectCount}">Province:</label>
                                <input type="text" class="form-control" id="user_location_${projectCount}" name="location_${projectCount}" required>
                            </div>
                            <div class="col-md-4">
                                <label for="city_${projectCount}">City/Municipality:</label>
                                <input type="text" class="form-control" id="user_city_${projectCount}" name="city_${projectCount}" required>
                            </div>
                            <div class="col-md-4">
                                <label for="barangay_${projectCount}">Barangay:</label>
                                <input type="text" class="form-control" id="user_barangay_${projectCount}" name="barangay_${projectCount}" required>
                            </div>
                        </div>

                        <h5>Additional Details</h5>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="remarks_${projectCount}">Remarks:</label>
                                <textarea class="form-control" id="remarks_${projectCount}" name="remarks_${projectCount}" required></textarea>
                            </div>
                        </div>

                        <!-- Target Employment Generated Section -->
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5>Target Employment Generated</h5>
                            <button id="add-indicator-${projectCount}" class="btn btn-primary btn-sm" type="button">Add Indicator</button>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="male_${projectCount}">Male:</label>
                                <input type="number" class="form-control" id="male_${projectCount}" name="male_${projectCount}" placeholder="Enter male count">
                            </div>
                            <div class="col-md-4">
                                <label for="female_${projectCount}">Female:</label>
                                <input type="number" class="form-control" id="female_${projectCount}" name="female_${projectCount}" placeholder="Enter female count">
                            </div>
                            <div id="output-indicator-container-${projectCount}">
                                <!-- Output indicators will be added dynamically here -->
                            </div>
                        </div>

                    <h5>Year Financial Targets</h5>
                        <div class="row mb-3">
                            <div class="form-group col-md-4 d-flex align-items-center justify-content-left">
                                <span class="form-control-plaintext text-left" style="margin-top: 24px;"  >Total Target for the Year :</span>
                            </div>
                            <div class="col-md-2">
                                <label for="year_financial_target_${projectCount}">Financial Targets:</label>
                                <input type="text" class="form-control" id="user_financial_targets_${projectCount}" name="year_financial_target_${projectCount}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="year_phy_target_percent_${projectCount}">Physical Targets (in %):</label>
                                <input type="text" class="form-control" id="user_physical_targets_${projectCount}" name="year_phy_target_percent_${projectCount}" required>
                            </div>
                        </div>
                    <h5>Targets of Output</h5>
                        <div id="target-output-container-${projectCount}">
                            <!-- Target output fields will be dynamically added here -->
                        </div>

                        
                        <!-- Monthly/Quarterly Financial Targets -->
                        <h5>Per Month/Quarter Financial Targets</h5>
                        ${generateStaticMonthlyTargets(projectCount)}

                        <div class="form-group col-md-4">
                            <label for="designation_${projectCount}">Designation/Office :</label>
                            <input type="text" class="form-control" id="user_designation_${projectCount}" placeholder="Enter designation/office" name="submitted_designation_${projectCount}" required>
                        </div>

                        <!-- Remove Button -->
                        <div class="text-end mt-3">
                            <button type="button" class="btn btn-danger btn-sm remove-btn" data-id="${formId}">Remove Project</button>
                        </div>
                    </form>
                </div>
            </div>
        `;

        // Append to container
        projectFormsContainer.appendChild(projectForm);

        submitButton.addEventListener('click', handleSubmit);

        // Attach Add Indicator functionality
        attachAddIndicatorFunctionality(projectCount);

        // Attach Remove button functionality
        attachRemoveButton(formId);
    }

    
    
    /**
     * Function to attach Add Indicator functionality to a specific project
     */
    function attachAddIndicatorFunctionality(projectCount) {
        const addIndicatorButton = document.getElementById(`add-indicator-${projectCount}`);
        const indicatorContainer = document.getElementById(`output-indicator-container-${projectCount}`);
        const targetOutputContainer = document.getElementById(`target-output-container-${projectCount}`);
        let indicatorCount = 0; // Track the number of indicators

        addIndicatorButton.addEventListener('click', () => {
            indicatorCount++;

            // Add Output Indicator Field
            const indicatorHTML = `
                <div class="row mb-3">
                    <div class="col-md-12">
                        <label for="output_indicator_${projectCount}_${indicatorCount}">Output Indicator ${indicatorCount}:</label>
                        <input type="text" class="form-control" id="output_indicator_${projectCount}_${indicatorCount}" name="output_indicator_${projectCount}_${indicatorCount}" required>
                    </div>
                </div>
            `;
            indicatorContainer.insertAdjacentHTML('beforeend', indicatorHTML);

            // Add Corresponding Target Output Field
            const targetOutputHTML = `
                <div class="row mb-3">
                    <div class="col-md-12">
                        <label for="target_output_${projectCount}_${indicatorCount}">Indicator ${indicatorCount}:</label>
                        <input type="text" class="form-control" id="target_output_${projectCount}_${indicatorCount}" name="target_output_${projectCount}_${indicatorCount}" required>
                    </div>
                </div>
            `;
            targetOutputContainer.insertAdjacentHTML('beforeend', targetOutputHTML);
        });
    }

function handleSubmit(event) {
    event.preventDefault();

    const projectFormsContainer = document.getElementById('project-forms-container'); // Ensure this ID matches your HTML
    if (!projectFormsContainer) {
        console.error('Error: projectFormsContainer not found.');
        return;
    }

    const forms = projectFormsContainer.querySelectorAll('.accordion-item');
    const projectForms = []; // Array to hold all form data

    forms.forEach((form, index) => {
        const formData = {};
        const inputs = form.querySelectorAll('input, textarea, select');

        inputs.forEach((input) => {
            const fieldName = input.name.replace(`_${index + 1}`, ''); // Strip dynamic suffix
            if (!formData[fieldName]) {
                formData[fieldName] = input.value;
            } else if (Array.isArray(formData[fieldName])) {
                formData[fieldName].push(input.value); // Handle array fields
            } else {
                formData[fieldName] = [formData[fieldName], input.value];
            }
        });

        // Collect Monthly Targets
        const monthlyTargets = [];
        const periodStarts = form.querySelectorAll(`[name="period_start_${index + 1}[]"]`);
        const periodEnds = form.querySelectorAll(`[name="period_end_${index + 1}[]"]`);
        const financialTargets = form.querySelectorAll(`[name="financial_target_${index + 1}[]"]`);
        const physicalTargetPercents = form.querySelectorAll(`[name="physical_target_percent_${index + 1}[]"]`);

        for (let i = 0; i < periodStarts.length; i++) {
            const start = periodStarts[i]?.value || null;
            const end = periodEnds[i]?.value || null;
            const financial = parseFloat(financialTargets[i]?.value) || null;
            const physical = parseFloat(physicalTargetPercents[i]?.value) || null;

            // Add to monthlyTargets only if at least one field is filled
            if (start || end || financial !== null || physical !== null) {
                monthlyTargets.push({
                    position: i + 1,
                    start: start,
                    end: end,
                    financial: financial,
                    physical: physical,
                });
            }
        }
        formData['monthly_targets'] = monthlyTargets.length > 0 ? monthlyTargets : null; // Set to null if no valid entries


        // Collect Output Indicators
        const outputIndicators = [];
        const outputIndicatorInputs = form.querySelectorAll(`[name^="output_indicator_${index + 1}_"]`);
        outputIndicatorInputs.forEach((indicator, idx) => {
            outputIndicators.push({
                output_indicator: indicator.value,
                position: idx + 1,
            });
        });
        formData['output_indicators'] = outputIndicators;

        // Collect Target Outputs
        const targetOutputs = [];
        const targetOutputInputs = form.querySelectorAll(`[name^="target_output_${index + 1}_"]`);
        targetOutputInputs.forEach((target) => {
            targetOutputs.push(target.value);
        });
        formData['target_outputs'] = targetOutputs;

        projectForms.push(formData); // Add this form's data to the array

        console.log(`Form ${index + 1} data collected:`, formData);
    });

    if (projectForms.length === 0) {
        console.error('Error: No forms found or data collected.');
        alert('No forms to submit.');
        return;
    }

    console.log("Submitting the following data to the server:", projectForms);

    // Submit data to the backend
    fetch('includes/user-submit-form1.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ project_forms: projectForms }),
    })
        .then((response) => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then((data) => {
            console.log('Server response:', data);
            if (data.status === 'success') {
                alert('Forms submitted successfully!');
            } else {
                alert(`Error: ${data.message}`);
            }
        })
        .catch((error) => {
            console.error('Error submitting forms:', error);
            alert('An error occurred while submitting the forms.');
        });
}

    
    
    


    /**
     * Static structure for Monthly/Quarterly Financial Targets
     */
    function generateStaticMonthlyTargets(projectCount) {
        return `
            <!-- First Quarter -->
            ${generateTargetRow(projectCount, "January", 1, false)}
            ${generateTargetRow(projectCount, "February", 2, false)}
            ${generateTargetRow(projectCount, "March", 3, false)}
            ${generateTargetRow(projectCount, "April", 4, true)}
            <!-- Second Quarter -->
            ${generateTargetRow(projectCount, "May", 5, false)}
            ${generateTargetRow(projectCount, "June", 6, false)}
            ${generateTargetRow(projectCount, "July", 7, false)}
            ${generateTargetRow(projectCount, "August", 8, true)}
            <!-- Third Quarter -->
            ${generateTargetRow(projectCount, "September", 9, false)}
            ${generateTargetRow(projectCount, "October", 10, false)}
            ${generateTargetRow(projectCount, "November", 11, false)}
            ${generateTargetRow(projectCount, "December", 12, true)}
        `;
    }
    

    /**
     * Helper function to generate a single row for each month
     */
    function generateTargetRow(projectCount, month, position, isQuarterEnd) {
        // Add a border style if it's the end of a quarter
        const borderStyle = isQuarterEnd ? 'border-bottom: 2px solid #ccc; padding-bottom: 16px;' : '';
    
        return `
            <div class="row mb-3" style="${borderStyle}">
                <div class="col-md-3">
                    <label>Start ${month}:</label>
                    <input type="date" class="form-control" name="period_start_${projectCount}[]" required>
                    <input type="hidden" name="mty_target_position_${projectCount}[]" value="${position}">
                </div>
                <div class="col-md-3">
                    <label>End ${month}:</label>
                    <input type="date" class="form-control" name="period_end_${projectCount}[]" required>
                </div>
                <div class="col-md-3">
                    <label>Financial Targets:</label>
                    <input type="number" class="form-control" name="financial_target_${projectCount}[]" required>
                </div>
                <div class="col-md-3">
                    <label>Physical Targets (in %):</label>
                    <input type="number" class="form-control" name="physical_target_percent_${projectCount}[]" required>
                </div>
            </div>
        `;
    }


    
    // Function to remove a specific project form
    function attachRemoveButton(formId) {
        const removeButton = document.querySelector(`.remove-btn[data-id="${formId}"]`);
        removeButton.addEventListener('click', function () {
            const form = document.getElementById(formId);
            if (form) {
                form.remove(); // Remove the entire project form
                console.log(`Project form with ID: ${formId} removed.`);
            }
        });
    }

    // Cancel button functionality (updated to return to the full M&E page)
    cancelButton.addEventListener('click', function () {
        if (projectFormsContainer) {
            projectFormsContainer.innerHTML = ''; // Remove all dynamic forms
            projectCount = 0; // Reset project count
        }
        formContent.style.display = 'none';
        formsList.style.display = 'block'; // Show form selection list
        if (quarterContainer) quarterContainer.style.display = 'block'; // Show quarter container
        if (submittedFormsContainer) submittedFormsContainer.style.display = 'block'; // Show submitted forms container
        if (paginationContainer) paginationContainer.style.display = 'block';
    });

    // Add project form on button click
    addProjectFormButton.addEventListener('click', function () {
        createProjectForm();
    });
}
