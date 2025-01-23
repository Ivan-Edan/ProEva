let currentPage = 1; // Tracks the active page
const rowsPerPage = 5; // Number of rows per page
let tableData = []; // Stores fetched data

// Fetch user submissions for all forms
function loadUserSubmissions(filters = {}) {
    // Build query parameters for filtering
    let queryParams = new URLSearchParams(filters).toString();
    fetch(`includes/get-user-submissions.php?${queryParams}`) // Adjust PHP file path
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                tableData = data.data; // Store all fetched data
                currentPage = 1; // Reset page to 1 when filtering
                updateTableWithPagination(); // Render table and pagination
            } else {
                console.error('Error loading submissions:', data.message);
            }
        })
        .catch(error => console.error('Error fetching submissions:', error));
}

// Update Table Based on Current Page
function updateTableWithPagination() {
    const tableBody = document.querySelector('#submissionsTable tbody');
    tableBody.innerHTML = ''; // Clear existing rows

    // Calculate start and end index for rows
    const startIndex = (currentPage - 1) * rowsPerPage;
    const endIndex = startIndex + rowsPerPage;
    const paginatedData = tableData.slice(startIndex, endIndex); // Get paginated data

    // Populate rows
    paginatedData.forEach(row => {
        const tr = document.createElement('tr');
        tr.innerHTML = `
            <td>${row.project_name}</td>
            <td>${row.department}</td>
            <td>
                <a href="#" class="view-form" data-id="${row.submission_id}" data-form="${row.form_type}">
                    ${formatFormName(row.form_type)}
                </a>
            </td>
            <td>${row.date_submitted}</td>
        `;
        tableBody.appendChild(tr);
    });

    attachFormListeners(); // Attach listeners to modal buttons
    setupPagination(); // Update pagination controls
}

// Setup Pagination Controls
function setupPagination() {
    const paginationContainer = document.getElementById('pagination-container');
    const pagination = document.querySelector('.pagination');
    pagination.innerHTML = ''; // Clear existing pagination buttons

    const totalPages = Math.ceil(tableData.length / rowsPerPage);

    // Previous Button
    const prevButton = document.createElement('li');
    prevButton.classList.add('page-item');
    prevButton.innerHTML = `<a class="page-link" href="#">&laquo;</a>`;
    prevButton.classList.toggle('disabled', currentPage === 1);
    prevButton.addEventListener('click', () => {
        if (currentPage > 1) {
            currentPage--;
            updateTableWithPagination();
        }
    });
    pagination.appendChild(prevButton);

    // Page Numbers
    for (let i = 1; i <= totalPages; i++) {
        const pageItem = document.createElement('li');
        pageItem.classList.add('page-item');
        if (i === currentPage) pageItem.classList.add('active'); // Highlight current page
        pageItem.innerHTML = `<a class="page-link" href="#">${i}</a>`;
        pageItem.addEventListener('click', () => {
            currentPage = i;
            updateTableWithPagination();
        });
        pagination.appendChild(pageItem);
    }

    // Next Button
    const nextButton = document.createElement('li');
    nextButton.classList.add('page-item');
    nextButton.innerHTML = `<a class="page-link" href="#">&raquo;</a>`;
    nextButton.classList.toggle('disabled', currentPage === totalPages);
    nextButton.addEventListener('click', () => {
        if (currentPage < totalPages) {
            currentPage++;
            updateTableWithPagination();
        }
    });
    pagination.appendChild(nextButton);
}



// Format form names based on type
function formatFormName(type) {
    switch (type) {
        case 'form1': return 'INITIAL PROJECT REPORT';
        case 'form2': return 'FINANCIAL & PHYSICAL ACCOMPLISHMENTS';
        case 'form3': return 'EXCEPTION REPORT';
        case 'form4': return 'PROJECT RESULTS';
        default: return 'UNKNOWN FORM';
    }
}


// Attach listeners to dynamically added form links
function attachFormListeners() {
    const formLinks = document.querySelectorAll('.view-form');
    formLinks.forEach(link => {
        link.addEventListener('click', function (event) {
            event.preventDefault();
            const submissionId = this.getAttribute('data-id');
            const formType = this.getAttribute('data-form');

            console.log(`Opening form: ${formType}, Submission ID: ${submissionId}`);
            openFormModal(submissionId, formType); // Open modal dynamically
        });
    });
}



// Open Form Modal dynamically based on formType
function openFormModal(submissionId, formType) {
    console.log(`Loading modal for ${formType} with Submission ID ${submissionId}`);
    fetch(`includes/load-user-form-content.php?formType=${formType}&submissionId=${submissionId}`)
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                const formData = data.data;
            // Handle Form 1
            if (formType === 'form1') {
                document.getElementById('form1SubmissionId').value = submissionId;
                document.getElementById('form1Type').value = formType;
                // Populate Form 1 modal fields

                // Project Details
                document.getElementById('projectTitleForm1').value = formData.project_title || '';
                document.getElementById('implementingAgencyForm1').value = formData.implementing_agency || '';
                document.getElementById('sectorForm1').value = formData.sector || '';
                document.getElementById('modeOfImplementationForm1').value = formData.mode_of_implementation || '';

                // Location
                document.getElementById('locationForm1').value = formData.location || '';
                document.getElementById('cityForm1').value = formData.city || '';
                document.getElementById('barangayForm1').value = formData.barangay || '';

                // Cost and Dates
                document.getElementById('totalCostForm1').value = formData.total_cost || '';
                document.getElementById('startDateForm1').value = formData.start_date || '';
                document.getElementById('endDateForm1').value = formData.end_date || '';

                // Funding Information
                document.getElementById('fundAgencyForm1').value = formData.fund_agency || '';
                document.getElementById('fundSourceForm1').value = formData.fund_source || '';

                // Employment Generated
                document.getElementById('maleForm1').value = formData.male || '';
                document.getElementById('femaleForm1').value = formData.female || '';

                document.getElementById('financialTargetsForm1').value = formData.year_financial_target || ''; // Fetch financial target
                document.getElementById('physicalTargetsForm1').value = formData.year_phy_target_percent || ''; // Fetch physical target percentage

                // Additional Details
                document.getElementById('compDetailsForm1').value = formData.comp_details || '';
                document.getElementById('remarksForm1').value = formData.remarks || '';

                // Project Validation
                document.getElementById('submittedDesignationForm1').value = formData.submitted_designation || '';
                document.getElementById('submittedByForm1').value = formData.submitted_by || '';

                // Dynamic Fields - Output Indicators (with numbering)
                const outputIndicatorsContainer = document.getElementById('outputIndicatorsContainer');
                outputIndicatorsContainer.innerHTML = ''; // Clear existing rows
                const outputIndicators = formData.output_indicators ? formData.output_indicators.split(', ') : [];
                const outputPositions = formData.output_positions ? formData.output_positions.split(', ') : [];
                outputIndicators.forEach((indicator, index) => {
                    const position = outputPositions[index] || '';
                    outputIndicatorsContainer.innerHTML += `
                        <div class="row mb-3">
                            <div class="col-sm-7">
                                <label class="form-label">Output Indicator ${index + 1}.:</label>
                                <input type="text" class="form-control" value="${indicator}" readonly>
                            </div>
                        </div>`;
                });

                // Dynamic Fields - Monthly Targets
                const monthlyTargetsContainer = document.getElementById('monthlyTargetsContainer');
                monthlyTargetsContainer.innerHTML = ''; // Clear existing rows
                const periodStarts = formData.mt_period_starts ? formData.mt_period_starts.split(', ') : [];
                const periodEnds = formData.mt_period_ends ? formData.mt_period_ends.split(', ') : [];
                const financialTargets = formData.mt_financial_targets ? formData.mt_financial_targets.split(', ') : [];
                const physicalTargets = formData.mt_physical_targets ? formData.mt_physical_targets.split(', ') : [];
                periodStarts.forEach((start, index) => {
                    const end = periodEnds[index] || '';
                    const financial = financialTargets[index] || '';
                    const physical = physicalTargets[index] || '';
                    monthlyTargetsContainer.innerHTML += `
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <label class="form-label">Start Date:</label>
                                <input type="date" class="form-control" value="${start}" readonly>
                            </div>
                            <div class="col-sm-3">
                                <label class="form-label">End Date:</label>
                                <input type="date" class="form-control" value="${end}" readonly>
                            </div>
                            <div class="col-sm-3">
                                <label class="form-label">Financial Target:</label>
                                <input type="text" class="form-control" value="${financial}" readonly>
                            </div>
                            <div class="col-sm-3">
                                <label class="form-label">Physical Target (%):</label>
                                <input type="text" class="form-control" value="${physical}" readonly>
                            </div>
                        </div>`;
                });

                // Dynamic Fields - Target Outputs (with numbering)
                const targetOutputsContainer = document.getElementById('targetOutputsContainer');
                targetOutputsContainer.innerHTML = ''; // Clear existing rows
                const targetOutputs = formData.target_outputs ? formData.target_outputs.split(', ') : [];
                targetOutputs.forEach((output, index) => {
                    targetOutputsContainer.innerHTML += `
                        <div class="row mb-3">
                            <div class="col-sm-11">
                                <label class="form-label">Target Output ${index + 1}.:</label>
                                <input type="text" class="form-control" value="${output}" readonly>
                            </div>
                        </div>`;
                });

                // Show modal for Form 1
                const modal = new bootstrap.Modal(document.getElementById('form1Modal'));
                modal.show();
            }



                // Handle Form 2
                if (formType === 'form2') {
                document.getElementById('form2SubmissionId').value = submissionId;
                document.getElementById('form2Type').value = formType;
                // Populate Form 2 modal fields
                document.getElementById('projectTitleForm2').value = formData.project_title || '';
                document.getElementById('implementingAgencyForm2').value = formData.implementing_agency || '';

                // Implementation Schedule
                document.getElementById('startDateForm2').value = formData.start_date || '';
                document.getElementById('endDateForm2').value = formData.end_date || '';
                document.getElementById('fundSourceForm2').value = formData.fund_source || '';
                document.getElementById('fundAgencyForm2').value = formData.fund_agency || '';
                document.getElementById('totalCostForm2').value = formData.total_cost || '';

                // Financial Status
                document.getElementById('appropriationsForm2').value = formData.appropriations || '';
                document.getElementById('allotmentForm2').value = formData.allotment || '';
                document.getElementById('obligationsForm2').value = formData.obligations || '';
                document.getElementById('disbursementsForm2').value = formData.disbursements || '';

                // Physical Accomplishment
                document.getElementById('targetOwpaForm2').value = formData.target_owpa || '';
                document.getElementById('actualOwpaForm2').value = formData.actual_owpa || '';
                document.getElementById('slippageForm2').value = formData.slippage || '';
                document.getElementById('outputIndicatorForm2').value = formData.output_indicator || '';

                // Additional Details
                document.getElementById('endProjectTargetForm2').value = formData.end_project_target || '';
                document.getElementById('targetDateForm2').value = formData.target_date || '';
                document.getElementById('actualDateForm2').value = formData.actual_date || '';
                document.getElementById('remarksForm2').value = formData.remarks || '';

                // Employment Generated
                document.getElementById('maleForm2').value = formData.male || '';
                document.getElementById('femaleForm2').value = formData.female || '';

                // Project Validation
                document.getElementById('designationForm2').value = formData.submitted_designation || '';
                document.getElementById('submittedByForm2').value = formData.submitted_by || '';
                    // Show modal for Form 2
                    const modal = new bootstrap.Modal(document.getElementById('form2Modal'));
                    modal.show();
                }

                // Handle Form 3
                else if (formType === 'form3') {
                    document.getElementById('form3SubmissionId').value = submissionId;
                    document.getElementById('form3Type').value = formType;
                    // Project Details
                    document.getElementById('projectTitleForm3').value = formData.project_title || '';
                    document.getElementById('implementingAgencyForm3').value = formData.implementing_agency || '';
                    document.getElementById('sectorForm3').value = formData.sector || '';
                
                    // Location
                    document.getElementById('provinceForm3').value = formData.location || '';
                    document.getElementById('cityForm3').value = formData.city || '';
                    document.getElementById('barangayForm3').value = formData.barangay || '';
                
                    // Additional Details
                    document.getElementById('findingsForm3').value = formData.findings || '';
                    document.getElementById('typologyForm3').value = formData.typology || '';
                    document.getElementById('issueStatusForm3').value = formData.issue_status || '';
                    document.getElementById('reasonsForm3').value = formData.reasons || '';
                    document.getElementById('actionsTakenForm3').value = formData.actions_taken || '';
                    document.getElementById('actionsToBeTakenForm3').value = formData.actions_to_be_taken || '';
                
                    // Project Validation
                    document.getElementById('submittedDesignationForm3').value = formData.submitted_designation || '';
                    document.getElementById('submittedByForm3').value = formData.submitted_by || '';
                
                    // Show Form 3 modal
                    const modal = new bootstrap.Modal(document.getElementById('form3Modal'));
                    modal.show();
                }
                

                // Handle Form 4
                else if (formType === 'form4') {

                    document.getElementById('form4SubmissionId').value = submissionId;
                    document.getElementById('form4Type').value = formType;
                    // Project Details
                    document.getElementById('projectTitleForm4').value = formData.project_title || '';
                    document.getElementById('implementingAgencyForm4').value = formData.implementing_agency || '';

                    // Additional Details
                    document.getElementById('objectivesForm4').value = formData.objectives || '';
                    document.getElementById('resultIndicatorForm4').value = formData.result_indicator || '';
                    document.getElementById('observedResultsForm4').value = formData.observe_results || '';

                    // Project Validation
                    document.getElementById('submittedDesignationForm4').value = formData.submitted_designation || '';
                    document.getElementById('submittedByForm4').value = formData.submitted_by || '';

                    // Show Form 4 modal
                    const modal = new bootstrap.Modal(document.getElementById('form4Modal'));
                    modal.show();
                }

            } else {
                console.error('No data available for the selected form.');
            }
        })
        .catch(error => console.error('Error loading modal:', error));
}
// Initialize the submissions table for all form types
document.addEventListener('DOMContentLoaded', function () {
    loadUserSubmissions({ formType: 'all' }); // Load all forms by default
});


// Filter Change Handler
document.querySelector('#filterDropdown').addEventListener('change', function () {
    const selectedForm = this.value; // Get selected filter
    currentPage = 1; // Reset to page 1 when a new filter is applied

    // Fetch filtered data
    loadUserSubmissions({ formType: selectedForm });
});

///////////////////////////////////////////////////////////
function handleFormAction(action, submissionId, formType) {
    fetch(`includes/update-form-status.php`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
            submissionId: submissionId,
            formType: formType,
            action: action // 'accept' or 'reject'
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            alert(`Form ${action}ed successfully!`);
            // Reload table and close modal
            loadUserSubmissions({ formType: 'all' });
            document.querySelector('.modal.show').querySelector('.btn-close').click(); // Close modal
        } else {
            alert('Failed to process the form. Please try again.');
        }
    })
    .catch(error => console.error('Error:', error));
}

// Accept Button Handlers
document.getElementById('acceptForm1').addEventListener('click', function () {
    handleFormAction('accept', document.getElementById('form1SubmissionId').value, 'form1');
});
document.getElementById('acceptForm2').addEventListener('click', function () {
    handleFormAction('accept', document.getElementById('form2SubmissionId').value, 'form2');
});
document.getElementById('acceptForm3').addEventListener('click', function () {
    handleFormAction('accept', document.getElementById('form3SubmissionId').value, 'form3');
});
document.getElementById('acceptForm4').addEventListener('click', function () {
    handleFormAction('accept', document.getElementById('form4SubmissionId').value, 'form4');
});

// Reject Button Handlers
document.getElementById('rejectForm1').addEventListener('click', function () {
    handleFormAction('reject', document.getElementById('form1SubmissionId').value, 'form1');
});
document.getElementById('rejectForm2').addEventListener('click', function () {
    handleFormAction('reject', document.getElementById('form2SubmissionId').value, 'form2');
});
document.getElementById('rejectForm3').addEventListener('click', function () {
    handleFormAction('reject', document.getElementById('form3SubmissionId').value, 'form3');
});
document.getElementById('rejectForm4').addEventListener('click', function () {
    handleFormAction('reject', document.getElementById('form4SubmissionId').value, 'form4');
});


