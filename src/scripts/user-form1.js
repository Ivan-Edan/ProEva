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
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="col-md-2">
                                <label for="year_${projectCount}">Year:</label>
                                <div class="invalid-feedback"></div>
                                <select class="form-control" id="year_${projectCount}" name="project_year_${projectCount}">
                                    <option value="2025">2025</option>
                                    <option value="2026">2026</option>
                                    <option value="2027">2027</option>
                                    <option value="2028">2028</option>
                                    <option value="2029">2029</option>
                                </select>
                            </div>
                            <div class="col-md-5">
                                <label for="implementing_agency_${projectCount}">Implementing Agency:</label>
                                <input type="text" class="form-control" id="implementing_agency_${projectCount}" name="implementing_agency_${projectCount}" required>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="component_details_${projectCount}">Component Details:</label>
                                <input type="text" class="form-control" id="user_component_details_${projectCount}" name="comp_details_${projectCount}" required>
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="col-md-3">
                                <label for="fund_source_${projectCount}">Fund Source:</label>
                                <div class="invalid-feedback"></div>
                                <select class="form-control" id="user_fund_source_${projectCount}" name="fund_source_${projectCount}" required>
                                    <option value="ODA Loan">ODA Loan</option>
                                    <option value="ODA Grant">ODA Grant</option>
                                    <option value="Oda loan and Grant">Oda loan and Grant</option>
                                    <option value="LFP">LFP</option>
                                    <option value="PPP">PPP</option>
                                    <option value="NTA">NTA</option>
                                    <option value="Local Development Fund">Local Development Fund</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="funding_agency_${projectCount}">Funding Agency:</label>
                                <input type="text" class="form-control" id="user_funding_agency_${projectCount}" name="fund_agency_${projectCount}" required>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label for="mode_implementation_${projectCount}">Mode of Implementation:</label>
                                <select class="form-control" id="mode_implementation_${projectCount}" name="mode_of_implementation_${projectCount}">
                                <div class="invalid-feedback"></div>
                                    <option value=" By administration"> By administration</option>
                                    <option value=" By Contract"> By Contract</option>
                                    <option value=" Implemented by the Development Partner/Funding Agency">Implemented by the Development Partner/Funding Agency</option>
                                    <option value="Coursed through NGOs/CSOs">Coursed through NGOs/CSOs</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="sector_${projectCount}">Sector:</label>
                                <select class="form-control" id="sector_${projectCount}" name="sector_${projectCount}" required>
                                <div class="invalid-feedback"></div>
                                    <option value=" General Public Services"> General Public Services</option>
                                    <option value=" Social Services"> Social Services</option>
                                    <option value="Economic Services">Economic Services</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label for="total_cost_${projectCount}">Total Program / Project Cost (PHP):</label>
                                <input type="number" class="form-control" id="user_total_cost_${projectCount}" name="total_cost_${projectCount}" required>
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="col-md-2">
                                <label for="start_date_${projectCount}">Start Date:</label>
                                <input type="date" class="form-control" id="user_start_date_${projectCount}" name="start_date_${projectCount}" required>
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="col-md-2">
                                <label for="end_date_${projectCount}">End Date:</label>
                                <input type="date" class="form-control" id="user_end_date_${projectCount}" name="end_date_${projectCount}" required>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>

                        <h5>Location</h5>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="province_${projectCount}">Province:</label>
                                <input type="text" class="form-control" id="user_location_${projectCount}" name="location_${projectCount}" required>
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="col-md-4">
                                <label for="city_${projectCount}">City/Municipality:</label>
                                <input type="text" class="form-control" id="user_city_${projectCount}" name="city_${projectCount}" required>
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="col-md-4">
                                <label for="barangay_${projectCount}">Barangay:</label>
                                <input type="text" class="form-control" id="user_barangay_${projectCount}" name="barangay_${projectCount}" required>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>

                        <h5>Additional Details</h5>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="remarks_${projectCount}">Remarks:</label>
                                <select class="form-control" id="remarks_${projectCount}" name="remarks_${projectCount}" required>
                                <div class="invalid-feedback"></div>
                                    <option value=" Ongoing"> Ongoing</option>
                                    <option value=" Completed"> Completed</option>
                                </select>
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
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="col-md-4">
                                <label for="female_${projectCount}">Female:</label>
                                <input type="number" class="form-control" id="female_${projectCount}" name="female_${projectCount}" placeholder="Enter female count">
                                <div class="invalid-feedback"></div>
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
                                <input type="number" class="form-control" id="user_financial_targets_${projectCount}" name="year_financial_target_${projectCount}" required>
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="col-md-6">
                                <label for="year_phy_target_percent_${projectCount}">Physical Targets (in %):</label>
                                <input type="number" class="form-control" id="user_physical_targets_${projectCount}" name="year_phy_target_percent_${projectCount}" required>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                    <h5>Targets of Output</h5>
                        <div id="target-output-container-${projectCount}">
                            <!-- Target output fields will be dynamically added here -->
                        </div>

                        
                        <!-- Monthly/Quarterly Financial Targets -->
                        <h5>Per Month/Quarter Financial Targets</h5>
                        ${generateStaticMonthlyTargets(projectCount)}

                        <div class="form-group col-md-5">
                            <label for="submitted_by_${projectCount}">Submitted By :</label>
                            <input type="text" class="form-control" id="user_submitted_by_${projectCount}" placeholder="Enter Submitted By" name="submitted_by_${projectCount}" required>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-group col-md-5">
                            <label for="designation_${projectCount}">Designation/Office :</label>
                            <input type="text" class="form-control" id="user_designation_${projectCount}" placeholder="Enter designation/office" name="submitted_designation_${projectCount}" required>
                            <div class="invalid-feedback"></div>
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

    // Automatically add one project form when Form 1 is loaded
    if (projectFormsContainer) {
        createProjectForm();
        enforceNumberInput();
    }
    
    
    /**
     * Function to attach Add Indicator functionality to a specific project
     */
    function attachAddIndicatorFunctionality(projectCount) {
        const addIndicatorButton = document.getElementById(`add-indicator-${projectCount}`);
        const indicatorContainer = document.getElementById(`output-indicator-container-${projectCount}`);
        const targetOutputContainer = document.getElementById(`target-output-container-${projectCount}`);
        let indicatorCount = 0; // Track the number of indicators
        const maxIndicators = 5; // Set the maximum limit
    
        addIndicatorButton.addEventListener('click', () => {
            if (indicatorCount >= maxIndicators) {
                alert(`You can only add up to ${maxIndicators} indicators.`);
                return; // Prevent adding more fields
            }
    
            indicatorCount++;
    
            // Add Output Indicator Field
            const indicatorHTML = `
                <div class="row mb-3 indicator-group" id="indicator-group-${indicatorCount}">
                    <div class="col-md-10">
                        <label for="output_indicator_${projectCount}_${indicatorCount}">Output Indicator ${indicatorCount}:</label>
                        <input type="text" class="form-control" id="output_indicator_${projectCount}_${indicatorCount}" name="output_indicator_${projectCount}_${indicatorCount}" required>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="col-md-2 d-flex align-items-center">
                        <button type="button" class="btn btn-danger btn-sm delete-indicator" data-indicator-id="${indicatorCount}">
                            Delete
                        </button>
                    </div>
                </div>
            `;
            indicatorContainer.insertAdjacentHTML('beforeend', indicatorHTML);
    
            // Add Corresponding Target Output Field
            const targetOutputHTML = `
                <div class="row mb-3 target-output-group" id="target-output-group-${indicatorCount}">
                    <div class="col-md-10">
                        <label for="target_output_${projectCount}_${indicatorCount}">Target Output ${indicatorCount}:</label>
                        <input type="text" class="form-control" id="target_output_${projectCount}_${indicatorCount}" name="target_output_${projectCount}_${indicatorCount}" required>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="col-md-2 d-flex align-items-center">
                        <button type="button" class="btn btn-danger btn-sm delete-indicator" data-indicator-id="${indicatorCount}">
                            Delete
                        </button>
                    </div>
                </div>
            `;
            targetOutputContainer.insertAdjacentHTML('beforeend', targetOutputHTML);
    
            // Reattach Delete Functionality for All Indicators
            reattachDeleteIndicatorFunctionality(projectCount);
        });
    
        /**
         * Function to reattach delete functionality to all indicators
         */
        function reattachDeleteIndicatorFunctionality(projectCount) {
            const deleteButtons = document.querySelectorAll(`#output-indicator-container-${projectCount} .delete-indicator`);
            deleteButtons.forEach((button) => {
                const indicatorId = button.getAttribute('data-indicator-id');
                button.onclick = () => {
                    const indicatorGroup = document.getElementById(`indicator-group-${indicatorId}`);
                    const targetOutputGroup = document.getElementById(`target-output-group-${indicatorId}`);
    
                    if (indicatorGroup) indicatorGroup.remove();
                    if (targetOutputGroup) targetOutputGroup.remove();
    
                    // Decrement the counter and renumber indicators
                    indicatorCount--;
                    renumberIndicatorsAndOutputs(projectCount);
                };
            });
        }
    
        /**
         * Function to renumber indicators and target outputs dynamically
         */
        function renumberIndicatorsAndOutputs(projectCount) {
            const indicatorGroups = document.querySelectorAll(`#output-indicator-container-${projectCount} .indicator-group`);
            const targetOutputGroups = document.querySelectorAll(`#target-output-container-${projectCount} .target-output-group`);
    
            // Reset the count and reassign IDs and labels
            indicatorCount = 0;
    
            indicatorGroups.forEach((group, index) => {
                const newNumber = index + 1;
                const label = group.querySelector('label');
                const input = group.querySelector('input');
                const deleteButton = group.querySelector('.delete-indicator');
    
                group.setAttribute('id', `indicator-group-${newNumber}`);
                label.setAttribute('for', `output_indicator_${projectCount}_${newNumber}`);
                label.textContent = `Output Indicator ${newNumber}:`;
                input.setAttribute('id', `output_indicator_${projectCount}_${newNumber}`);
                input.setAttribute('name', `output_indicator_${projectCount}_${newNumber}`);
                deleteButton.setAttribute('data-indicator-id', newNumber);
    
                // Update the count
                indicatorCount = newNumber;
            });
    
            targetOutputGroups.forEach((group, index) => {
                const newNumber = index + 1;
                const label = group.querySelector('label');
                const input = group.querySelector('input');
                const deleteButton = group.querySelector('.delete-indicator');
    
                group.setAttribute('id', `target-output-group-${newNumber}`);
                label.setAttribute('for', `target_output_${projectCount}_${newNumber}`);
                label.textContent = `Target Output ${newNumber}:`;
                input.setAttribute('id', `target_output_${projectCount}_${newNumber}`);
                input.setAttribute('name', `target_output_${projectCount}_${newNumber}`);
                deleteButton.setAttribute('data-indicator-id', newNumber);
            });
    
            // Reattach Delete Functionality after Renumbering
            reattachDeleteIndicatorFunctionality(projectCount);
        }
    }
    


    function handleSubmit(event) {
        event.preventDefault();
    
        const projectFormsContainer = document.getElementById('project-forms-container');
        const forms = projectFormsContainer.querySelectorAll('.accordion-item');
        let hasErrors = false;

        forms.forEach((form, index) => {
            const errors = validateForm(form, index + 1);
            if (errors.length > 0) {
                hasErrors = true;
            }
        });

        if (hasErrors) {
            alert('Please fix the errors before submitting.');
            return; // Stop submission if there are validation errors
        }
    
    
    
        // Show confirmation modal
        const confirmationModal = new bootstrap.Modal(document.getElementById('confirmationModal'));
        confirmationModal.show();
    
        // Handle Confirm Button Click
        const confirmButton = document.getElementById('confirmSubmitButton');
        confirmButton.onclick = function () {
            // Close the modal
            confirmationModal.hide();
    
            // Proceed with form data collection and submission
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
                // Show the success modal
                const successModal = new bootstrap.Modal(document.getElementById('successModal'));
                successModal.show();

                // Reset form and navigate back to the form list after modal closes
                const modalCloseButton = document.querySelector('#successModal .btn[data-bs-dismiss="modal"]');
                modalCloseButton.addEventListener('click', () => {
                    window.location.reload(); // Reload the page to reset the form
                });
            } else {
                alert(`Error: ${data.message}`);
            }
                    
                })
                .catch((error) => {
                    console.error('Error submitting forms:', error);
                    alert('An error occurred while submitting the forms.');
                });
        };
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
                    <div class="invalid-feedback"></div>
                </div>
                <div class="col-md-3">
                    <label>End ${month}:</label>
                    <input type="date" class="form-control" name="period_end_${projectCount}[]" required>
                    <div class="invalid-feedback"></div>
                </div>
                <div class="col-md-3">
                    <label>Financial Targets:</label>
                    <input type="number" class="form-control" name="financial_target_${projectCount}[]" required>
                    <div class="invalid-feedback"></div>
                </div>
                <div class="col-md-3">
                    <label>Physical Targets (in %):</label>
                    <input type="number" class="form-control" name="physical_target_percent_${projectCount}[]" required>
                    <div class="invalid-feedback"></div>
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

    let unsavedChanges = false; // Flag to track if there are unsaved changes

    // Detect changes in any form input, textarea, or select
    document.addEventListener('input', (event) => {
        if (event.target.matches('form input, form textarea, form select')) {
            unsavedChanges = true; // Mark unsaved changes
            console.log("Unsaved changes detected.");
        }
    });
    
    // Cancel button functionality (updated to show modal only when necessary)
    cancelButton.addEventListener('click', function (event) {
        event.preventDefault();
    
        if (unsavedChanges) {
            // Show the Cancel Confirmation Modal only if there are unsaved changes
            const cancelModal = new bootstrap.Modal(document.getElementById('cancelConfirmationModal'));
            cancelModal.show();
    
            // Handle Confirm Cancel Button Click
            const confirmCancelButton = document.getElementById('confirmCancelButton');
            confirmCancelButton.onclick = function () {
                cancelModal.hide();
                resetFormAndShowList(); // Proceed with the original cancel logic
                unsavedChanges = false; // Reset unsaved changes flag
            };
        } else {
            // No unsaved changes, reset the form immediately without showing the modal
            console.log("No unsaved changes. Resetting form without confirmation.");
            resetFormAndShowList();
        }
    });
    
    // Function to reset the form and return to the form list
    function resetFormAndShowList() {
        if (projectFormsContainer) {
            projectFormsContainer.innerHTML = ''; // Remove all dynamic forms
            projectCount = 0; // Reset project count
            createProjectForm(); // Automatically add one project form
        }
        formContent.style.display = 'none';
        formsList.style.display = 'block'; // Show form selection list
        if (quarterContainer) quarterContainer.style.display = 'block'; // Show quarter container
        if (submittedFormsContainer) submittedFormsContainer.style.display = 'block'; // Show submitted forms container
        if (paginationContainer) paginationContainer.style.display = 'block';
    }
    
    

    // Add project form on button click
    addProjectFormButton.addEventListener('click', function () {
        createProjectForm();
        enforceNumberInput();
    });
}
