let currentPage = 1; // Tracks the active page
const rowsPerPage = 5; // Number of rows per page
let tableData = []; // Stores fetched data

// Fetch approved forms for the archive table
function loadArchiveData(filters = {}) {
    let queryParams = new URLSearchParams(filters).toString();
    fetch(`includes/get-archive-forms.php?${queryParams}`)
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                tableData = data.data; // Store all fetched data
                currentPage = 1; // Reset to page 1 when filtering
                updateTableWithPagination(); // Render table and pagination
            } else {
                console.error('Error loading archive data:', data.message);
            }
        })
        .catch(error => console.error('Error fetching archive data:', error));
}


function updateTableWithPagination() {
    console.log('Table Data:', tableData); // Debugging log
    if (!tableData || tableData.length === 0) {
        console.warn('No data available for pagination.');
        return;
    }

    const startIndex = (currentPage - 1) * rowsPerPage;
    const endIndex = startIndex + rowsPerPage;
    const paginatedData = tableData.slice(startIndex, endIndex); // Get paginated data

    console.log('Paginated Data:', paginatedData); // Debugging log

    const tableBody = document.querySelector('#archiveTable tbody');
    tableBody.innerHTML = ''; // Clear existing rows

    paginatedData.forEach(row => {
        const formName = formatFormName(row.form_type); // Convert form type to form name
        const tr = document.createElement('tr');
        tr.innerHTML = `
            <td>${row.project_name}</td>
            <td>${row.department}</td>
            <td>${row.date_created}</td>
            <td>
                <a href="#" class="view-form" data-id="${row.submission_id}" data-form="${row.form_type}">
                    ${formName}
                </a>
            </td>
        `;
        tableBody.appendChild(tr);
    });

    attachArchiveFormListeners(); // Attach listeners after rows are added
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
        case 'adminform1': return 'SUMMARY OF FINANCIAL AND PHYSICAL ACCOMPLISMENTS';
        case 'adminform2': return 'Report on the Status of Projects Encountering Implementation Problems'; // Add Admin Form 2
        case 'adminform3': return 'Project Inspection Report'; // Add Admin Form 2
        case 'adminform4': return 'Problem Solving Sessions / Facilitation Meeting Conducted'; // Add Admin Form 2
        case 'adminform5': return 'TRAINING/WORKSHOP CONDUCTED / FACILITATED/ATTENDED BY THE RPMC'; // Add Admin Form 2
        case 'adminform6': return 'RPMC and RDC Resolutions Related to Implementation of the RPMES'; // Add Admin Form 2
        case 'adminform7': return 'Key Lessons Learned from Issues Resolved and Best Practices'; // Add Admin Form 2
        default: return 'UNKNOWN FORM';
    }
}

// Initialize the archive table
document.addEventListener('DOMContentLoaded', function () {
    loadArchiveData({ formType: 'all' }); // Load all approved forms by default
});

// Filter Change Handler
document.querySelector('#filterDropdown').addEventListener('change', function () {
    const selectedForm = this.value; // Get selected filter
    currentPage = 1; // Reset to page 1 when a new filter is applied
    loadArchiveData({ formType: selectedForm }); // Fetch filtered data
});

// Open Form Modal dynamically based on formType (for Archive)
function openArchiveFormModal(submissionId, formType) {
    console.log(`Loading modal for ${formType} with Submission ID ${submissionId}`);
    fetch(`includes/load-archive-form-content.php?formType=${formType}&submissionId=${submissionId}`)
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                const formData = data.data;

                // Handle different form types dynamically
                switch (formType) {
                    case 'form1':
                        handleForm1Modal(formData, submissionId, formType);
                        break;
                    case 'form2':
                        handleForm2Modal(formData, submissionId, formType);
                        break;
                    case 'form3':
                        handleForm3Modal(formData, submissionId, formType);
                        break;
                    case 'form4':
                        handleForm4Modal(formData, submissionId, formType);
                        break;
                    case 'adminform1':
                        handleAdminForm1Modal(formData, submissionId, formType);
                        break;    
                    case 'adminform2':
                        handleAdminForm2Modal(formData, submissionId, formType);
                        break;   
                    case 'adminform3':
                        handleAdminForm3Modal(formData, submissionId, formType);
                        break;        
                    case 'adminform4':
                        handleAdminForm4Modal(formData, submissionId, formType);
                        break;   
                    case 'adminform5':
                        handleAdminForm5Modal(formData, submissionId, formType);
                        break;   
                    case 'adminform6':
                        handleAdminForm6Modal(formData, submissionId, formType);
                        break;   
                    case 'adminform7':
                        handleAdminForm7Modal(formData, submissionId, formType);
                        break;   
                    default:
                        console.error(`Unknown form type: ${formType}`);
                }
            } else {
                console.error('No data available for the selected form.');
            }
        })
        .catch(error => console.error('Error loading modal:', error));
}

// Separate functions to handle each form type modal
function handleForm1Modal(formData, submissionId, formType) {
    document.getElementById('form1SubmissionId').value = submissionId;
    document.getElementById('form1Type').value = formType;

    // Populate fields for Form 1
    document.getElementById('projectTitleForm1').value = formData.project_title || '';
    document.getElementById('implementingAgencyForm1').value = formData.implementing_agency || '';
    // Add other fields as per Form 1 requirements...

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

function handleForm2Modal(formData, submissionId, formType) {
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

function handleForm3Modal(formData, submissionId, formType) {
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

function handleForm4Modal(formData, submissionId, formType) {
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
function handleAdminForm1Modal(formData, submissionId, formType) {
    document.getElementById('adminform1SubmissionId').value = submissionId;
    document.getElementById('adminform1Type').value = formType;


    // Populate fields for Admin Form 1
    document.getElementById('projectTitleAdminForm1').value = formData.project_title || '';
    document.getElementById('implementingAgencyAdminForm1').value = formData.implementing_agency || '';
    document.getElementById('sectorAdminForm1').value = formData.sector || '';
    document.getElementById('startDateAdminForm1').value = formData.start_date || '';
    document.getElementById('endDateAdminForm1').value = formData.end_date || '';
    document.getElementById('fundSourceAdminForm1').value = formData.fund_source || '';
    document.getElementById('fundingAgencyAdminForm1').value = formData.funding_agency || '';
    document.getElementById('totalProjectCostAdminForm1').value = formData.total_project_cost || '';
    document.getElementById('appropriationsAdminForm1').value = formData.appropriations || '';
    document.getElementById('allotmentAdminForm1').value = formData.allotment || '';
    document.getElementById('obligationsAdminForm1').value = formData.obligations || '';
    document.getElementById('disbursementsAdminForm1').value = formData.disbursements || '';
    document.getElementById('fundingSupportAdminForm1').value = formData.funding_support || '';
    document.getElementById('fundUtilizationAdminForm1').value = formData.fund_utilization || '';
    document.getElementById('targetOwpaAdminForm1').value = formData.target_owpa || '';
    document.getElementById('actualOwpaAdminForm1').value = formData.actual_owpa || '';
    document.getElementById('slippageAdminForm1').value = formData.slippage || '';
    document.getElementById('maleAdminForm1').value = formData.male || '';
    document.getElementById('femaleAdminForm1').value = formData.female || '';
    document.getElementById('remarksAdminForm1').value = formData.remarks || '';
    document.getElementById('submittedByAdminForm1').value = formData.submitted_by || '';
    document.getElementById('designationOfficeAdminForm1').value = formData.designation_office || '';
    document.getElementById('submissionDateAdminForm1').value = formData.submission_date || '';


    // Show Admin Form 1 modal
    const modal = new bootstrap.Modal(document.getElementById('adminForm1Modal'));
    modal.show();
}

function handleAdminForm2Modal(formData, submissionId, formType) {
    document.getElementById('adminform2SubmissionId').value = submissionId;
    document.getElementById('adminform2Type').value = formType;

    // Populate fields
    document.getElementById('projectTitleAdminForm2').value = formData.project_title || '';
    document.getElementById('locationAdminForm2').value = formData.location || '';
    document.getElementById('implementingAgencyAdminForm2').value = formData.implementing_agency || '';
    document.getElementById('fundUtilizationAdminForm2').value = formData.fund_utilization || '';
    document.getElementById('targetOwpaAdminForm2').value = formData.target_owpa || '';
    document.getElementById('actualOwpaAdminForm2').value = formData.actual_owpa || '';
    document.getElementById('slippageAdminForm2').value = formData.slippage || '';
    document.getElementById('issueDetailsAdminForm2').value = formData.issue_details || '';
    document.getElementById('issueTypologyAdminForm2').value = formData.issue_typology || '';
    document.getElementById('issueStatusAdminForm2').value = formData.issue_status || '';
    document.getElementById('sourceOfInformationAdminForm2').value = formData.source_of_information || '';
    document.getElementById('actionTakenAdminForm2').value = formData.action_taken || '';
    document.getElementById('actionsToBeTakenAdminForm2').value = formData.actions_to_be_taken || '';
    document.getElementById('forNpmcActionAdminForm2').value = formData.for_npmc_action || '';
    document.getElementById('requestedActionFromNpmcAdminForm2').value = formData.requested_action_from_npmc || '';
    document.getElementById('submittedByAdminForm2').value = formData.submitted_by || '';
    document.getElementById('designationOfficeAdminForm2').value = formData.designation_office || '';
    document.getElementById('submissionDateAdminForm2').value = formData.submission_date || '';

    // Show modal
    const modal = new bootstrap.Modal(document.getElementById('adminForm2Modal'));
    modal.show();
}

function handleAdminForm3Modal(formData, submissionId, formType) {
    document.getElementById('adminform3SubmissionId').value = submissionId;
    document.getElementById('adminform3Type').value = formType;

    // Populate fields
    document.getElementById('projectTitleAdminForm3').value = formData.project_title || '';
    document.getElementById('implementingAgencyAdminForm3').value = formData.implementing_agency || '';
    document.getElementById('totalCostAdminForm3').value = formData.total_cost || '';
    document.getElementById('locationAdminForm3').value = formData.location || '';
    document.getElementById('dateOfInspectionAdminForm3').value = formData.date_of_inspection || '';
    document.getElementById('detailsOnSiteInspectedAdminForm3').value = formData.details_on_site_inspected || '';
    document.getElementById('findingsAdminForm3').value = formData.findings || '';
    document.getElementById('issuesAdminForm3').value = formData.issues || '';
    document.getElementById('actionsTakenAdminForm3').value = formData.action_taken || '';
    document.getElementById('actionsToBeTakenAdminForm3').value = formData.actions_to_be_taken || '';
    document.getElementById('submittedByAdminForm3').value = formData.submitted_by || '';
    document.getElementById('designationOfficeAdminForm3').value = formData.designation_office || '';
    document.getElementById('submissionDateAdminForm3').value = formData.submission_date || '';

    // Show modal
    const modal = new bootstrap.Modal(document.getElementById('adminForm3Modal'));
    modal.show();
}

function handleAdminForm4Modal(formData, submissionId, formType) {
    document.getElementById('adminform4SubmissionId').value = submissionId;
    document.getElementById('adminform4Type').value = formType;

    // Populate modal fields
    document.getElementById('projectTitleAdminForm4').value = formData.project_title || '';
    document.getElementById('issueDetailsAdminForm4').value = formData.issue_details || '';
    document.getElementById('issueTypologyAdminForm4').value = formData.issue_typology || '';
    document.getElementById('locationAdminForm4').value = formData.location || '';
    document.getElementById('implementingAgencyAdminForm4').value = formData.implementing_agency || '';
    document.getElementById('dateOfMeetingAdminForm4').value = formData.date_of_meeting || '';
    document.getElementById('concernedAgencyAdminForm4').value = formData.concerned_agency || '';
    document.getElementById('agreementsReachedAdminForm4').value = formData.agreements_reached || '';
    document.getElementById('submittedByAdminForm4').value = formData.submitted_by || '';
    document.getElementById('designationOfficeAdminForm4').value = formData.designation_office || '';
    document.getElementById('submissionDateAdminForm4').value = formData.submission_date || '';

    // Show Admin Form 4 modal
    const modal = new bootstrap.Modal(document.getElementById('adminForm4Modal'));
    modal.show();
}

function handleAdminForm5Modal(formData, submissionId, formType) {
    document.getElementById('adminform5SubmissionId').value = submissionId;
    document.getElementById('adminform5Type').value = formType;

    // Populate fields
    document.getElementById('trainingTitleAdminForm5').value = formData.training_title || '';
    document.getElementById('trainingObjectiveAdminForm5').value = formData.training_objective || '';
    document.getElementById('trainingDateAdminForm5').value = formData.training_date || '';
    document.getElementById('conductedFacilitatedAdminForm5').value = formData.conducted_facilitated_attended || '';
    document.getElementById('leadOfficeUnitAdminForm5').value = formData.lead_office_unit || '';
    document.getElementById('participatingOfficesAdminForm5').value = formData.participating_offices || '';
    document.getElementById('maleAdminForm5').value = formData.male || '';
    document.getElementById('femaleAdminForm5').value = formData.female || '';
    document.getElementById('totalAdminForm5').value = formData.total || '';
    document.getElementById('resultsFeedbackAdminForm5').value = formData.results_feedback || '';
    document.getElementById('submittedByAdminForm5').value = formData.submitted_by || '';
    document.getElementById('designationOfficeAdminForm5').value = formData.designation_office || '';
    document.getElementById('submissionDateAdminForm5').value = formData.submission_date || '';

    // Show modal for Admin Form 5
    const modal = new bootstrap.Modal(document.getElementById('adminForm5Modal'));
    modal.show();
}

function handleAdminForm6Modal(formData, submissionId, formType) {
    document.getElementById('adminform6SubmissionId').value = submissionId;
    document.getElementById('adminform6Type').value = formType;
    document.getElementById('resolutionNumberAdminForm6').value = formData.resolution_number || '';
    document.getElementById('resolutionTitleAdminForm6').value = formData.resolution_title || '';
    document.getElementById('dateApprovedAdminForm6').value = formData.date_approved || '';
    document.getElementById('resolutionAdminForm6').value = formData.resolution || '';
    document.getElementById('resolutionLinkAdminForm6').href = formData.resolution_link || '#';
    document.getElementById('submittedByAdminForm6').value = formData.submitted_by || '';
    document.getElementById('designationOfficeAdminForm6').value = formData.designation_office || '';
    document.getElementById('submissionDateAdminForm6').value = formData.submission_date || '';

    // Show the modal
    const modal = new bootstrap.Modal(document.getElementById('adminForm6Modal'));
    modal.show();
}
function handleAdminForm7Modal(formData, submissionId, formType) {
    document.getElementById('adminform7SubmissionId').value = submissionId;
    document.getElementById('adminform7Type').value = formType;

    // Populate fields
    document.getElementById('projectTitleAdminForm7').value = formData.project_title || '';
    document.getElementById('locationAdminForm7').value = formData.location || '';
    document.getElementById('implementingAgencyAdminForm7').value = formData.implementing_agency || '';
    document.getElementById('natureAdminForm7').value = formData.nature || '';
    document.getElementById('detailsAdminForm7').value = formData.details || '';
    document.getElementById('strategiesAdminForm7').value = formData.strategies || '';
    document.getElementById('responsibleEntityAdminForm7').value = formData.responsible_entity || '';
    document.getElementById('lessonLearnedAdminForm7').value = formData.lesson_learned || '';
    document.getElementById('submittedByAdminForm7').value = formData.submitted_by || '';
    document.getElementById('designationOfficeAdminForm7').value = formData.designation_office || '';
    document.getElementById('submissionDateAdminForm7').value = formData.submission_date || '';

    // Show modal
    const modal = new bootstrap.Modal(document.getElementById('adminForm7Modal'));
    modal.show();
}





// Attach event listeners to dynamically added links
function attachArchiveFormListeners() {
    const formLinks = document.querySelectorAll('.view-form');
    formLinks.forEach(link => {
        link.addEventListener('click', function (event) {
            event.preventDefault();
            const submissionId = this.getAttribute('data-id');
            const formType = this.getAttribute('data-form');

            console.log(`Opening form: ${formType}, Submission ID: ${submissionId}`);
            openArchiveFormModal(submissionId, formType); // Open modal dynamically
        });
    });
}

// Add event listeners for all "Download as Excel" buttons
document.querySelectorAll('[id^="downloadExcel"]').forEach((button) => {
    button.addEventListener('click', function () {
        const modal = this.closest('.modal');

        if (!modal) {
            console.error('Could not find the modal containing the button.');
            alert('Unable to download Excel: Modal not found.');
            return;
        }

        const submissionIdInput = modal.querySelector('[id$="SubmissionId"]');
        const formTypeInput = modal.querySelector('[id$="Type"]');

        if (!formTypeInput || !submissionIdInput) {
            console.error('Missing hidden input fields.');
            alert('Unable to download Excel: Missing data fields.');
            return;
        }

        const formType = formTypeInput.value.trim();
        const submissionId = submissionIdInput.value.trim();

        if (!formType || !submissionId) {
            console.error(`Invalid data: formType=${formType}, submissionId=${submissionId}`);
            alert('Unable to download Excel: Invalid data.');
            return;
        }

        // Fetch form data and generate Excel
        fetch(`includes/get-form-data.php?formType=${formType}&submissionId=${submissionId}`)
            .then((response) => response.json())
            .then((data) => {
                console.log('Fetched data:', data);

                if (data.status === 'success' && data.data) {
                    const formData = data.data;

                    if (Object.keys(formData).length === 0) {
                        console.warn('Form data is empty.');
                        alert('No data found for this submission.');
                        return;
                    }

                    if (["form1", "form2", "form3", "form4", "adminform1", "adminform2", "adminform3", "adminform4", "adminform5", "adminform6", "adminform7"].includes(formType)) {
                        generateWorksheetForForms(formData, submissionId, formType);
                    } else {
                        const filteredData = Object.entries(formData).filter(([key]) => 
                            !['submission_id', 'adminForm1_id', 'details_id', 'Form2_id', 'form3_id', 'form4_id', 'adminForm2_id', 'adminForm3_id', 'adminForm4_id', 'adminForm5_id', 'adminForm6_id', 'adminForm7_id'].includes(key)
                        );

                        if (filteredData.length === 0) {
                            console.warn('Filtered data is empty.');
                            alert('No valid data fields found for the Excel export.');
                            return;
                        }

                        console.log('Filtered data:', filteredData);

                        const headers = filteredData.map(([key]) => key);
                        const values = filteredData.map(([, value]) => value);
                        const sheetData = [headers, values];

                        let worksheet = XLSX.utils.aoa_to_sheet(sheetData);
                        worksheet['!sheetView'] = [{ showGridLines: false }];

                        const workbook = XLSX.utils.book_new();
                        XLSX.utils.book_append_sheet(workbook, worksheet, `${formType} Data`);

                        const fileName = `${formType}_Submission_${submissionId}.xlsx`;
                        XLSX.writeFile(workbook, fileName);
                    }

                    setTimeout(() => window.location.reload(), 500);
                } else {
                    alert('Unable to fetch form data.');
                    console.error('Error fetching data:', data.message);
                }
            })
            .catch((error) => {
                console.error('Error fetching data:', error);
                alert('An error occurred while processing the request.');
            });
    });
});

async function generateWorksheetForForms(data, submissionId, formType) {
    const templatePath = `includes/excel/${formType.toUpperCase()}.xlsx`;

    try {
        const response = await fetch(templatePath);
        if (!response.ok) throw new Error("Excel template not found.");
        const arrayBuffer = await response.arrayBuffer();

        const workbook = new ExcelJS.Workbook();
        await workbook.xlsx.load(arrayBuffer);
        const worksheet = workbook.worksheets[0];

        const today = new Date();
        let userSelectedMonth = today.getMonth(); // Current month (0 = Jan, 11 = Dec)
        let userSelectedYear = today.getFullYear(); // Current year
        
        // Function to determine the quarter dynamically
        const getQuarterInfo = (month) => {
            if (month >= 0 && month <= 2) return "First Quarter";  // Jan - Mar
            if (month >= 3 && month <= 5) return "Second Quarter"; // Apr - Jun
            if (month >= 6 && month <= 8) return "Third Quarter";  // Jul - Sep
            return "Fourth Quarter";  // Oct - Dec
        };
        
        // Get dynamic quarter
        const quarter = getQuarterInfo(userSelectedMonth);
        
        // Get current month name dynamically
        const currentMonth = new Date(userSelectedYear, userSelectedMonth, 1).toLocaleString("en-US", { month: "long" });
        
        // Define form values dynamically
        const formValues = {
            form1: `CY ${userSelectedYear}`,
            form4: `As of ${currentMonth} ${userSelectedYear}`,
            form3: `As of ${currentMonth} ${userSelectedYear}`,
            form2: `As of ${currentMonth} ${userSelectedYear}`,
            adminform1: `As of ${currentMonth} ${userSelectedYear} (${quarter})`,
            adminform2: `As of ${currentMonth} ${userSelectedYear} (${quarter})`,
            adminform3: `As of ${currentMonth} ${userSelectedYear} (${quarter})`,
            adminform4: `As of ${currentMonth} ${userSelectedYear} (${quarter})`,
            adminform5: `In ${userSelectedYear}`,
            adminform6: `Resolutions Passed in ${userSelectedYear}`,
            adminform7: `In ${userSelectedYear}`
        };
        
        // Assign value dynamically if formType exists
        if (formValues[formType]) {
            worksheet.getCell("B5").value = formValues[formType];
        }
        
        // Special case for form3 and form2 (A3 instead of B5)
        if (formType === "form3" || formType === "form2") {
            worksheet.getCell("A3").value = formValues[formType];
        }
               

        const cellMappings = {
            "form1": {
                "B12": "project_title",
                "C8": "implementing_agency",
                "H12": "sector",
                "F12": "mode_of_implementation",
                "I12": "location",
                "J12": "city",
                "K12": "barangay",

                // Cost & Dates
                "G12": "total_cost",
                "L12": "start_date",
                "M12": "end_date",

                // Funding Information
                "E12": "fund_agency",
                "D12": "fund_source",

                // Target Employment
                "O12": "male",
                "P12": "female",

                // Additional Details
                "C12": "comp_details",
                "S12": "year_financial_target",
                "T12": "year_phy_target_percent",
                "N12": "remarks",

                // Output Indicators
                "Q12": "output_indicators",

                // Monthly Targets (Dynamic row handling)
                "S13": "mt_financial_targets",
                "T13": "mt_physical_targets",

                // Target Outputs (Dynamic column handling)
                "U13": "target_outputs",

                // Project Validation
                "C31": "submitted_designation",
                "C30": "submitted_by"
            },
            "form2": {
                "B9": "project_title",
                "A5": "implementing_agency", 
                "H9": "appropriations",
                "I9": "allotment",
                "J9": "obligations",
                "K9": "disbursements",
                "L9": "target_owpa",
                "M9": "actual_owpa",
                "N9": "slippage",
                "O9": "output_indicator",
                "P9": "end_project_target",
                "Q9": "target_date",
                "R9": "actual_date",
                "S9": "male",
                "T9": "female",
                "U9": "remarks",
                "C12": "submitted_designation",
                "C11": "submitted_by",
                "C9": "start_date",
                "D9": "end_date",
                "E9": "fund_source",
                "F9": "fund_agency",
                "G9": "total_cost"
            },
            "form3": {
                "A9": "project_title",
                "C9": "sector",
                "D9": "location",
                "B9": "implementing_agency",
                "B5": "implementing_agency",
                "E9": "city",
                "F9": "barangay",
                "G9": "findings",
                "H9": "typology",
                "I9": "issue_status",
                "J9": "reasons",
                "K9": "actions_taken",
                "L9": "actions_to_be_taken",
                "B12": "submitted_designation",
                "B11": "submitted_by"
            },
            "form4": {
                "B12": "project_title",
                "C8": "implementing_agency",
                "D12": "objectives",
                "E12": "result_indicator",
                "G12": "observe_results",
                "C24": "submitted_designation",
                "C23": "submitted_by"
            },
            "adminform1": {
                "B10": "project_title",
                "C10": "implementing_agency",
                "D10": "start_date",
                "E10": "end_date",
                "F10": "sector",
                "G10": "fund_source",
                "H10": "funding_agency",
                "I10": "total_project_cost",
                "J10": "appropriations",
                "K10": "allotment",
                "L10": "obligations",
                "M10": "disbursements",
                "N10": "funding_support",
                "O10": "fund_utilization",
                "P10": "target_owpa",
                "Q10": "actual_owpa",
                "R10": "slippage",
                "S10": "male",
                "T10": "female",
                "U10": "remarks",
                "C27": "submitted_by",
                "C28": "designation_office",
                "M29": "submission_date",
                "C29": "created_at"
            },
            "adminform2": {
                "B10": "project_title",
                "D10": "location",
                "E10": "implementing_agency",
                "F10": "fund_utilization",
                "G10": "target_owpa",
                "H10": "actual_owpa",
                "I10": "slippage",
                "J10": "issue_details",
                "K10": "issue_typology",
                "L10": "issue_status",
                "M10": "source_of_information",
                "N10": "action_taken",
                "O10": "actions_to_be_taken",
                "P10": "for_npmc_action",
                "Q10": "requested_action_from_npmc",
                "C27": "submitted_by",
                "C28": "designation_office",
                "J29": "submission_date",
                "C29": "created_at"
            },
            "adminform3": {
                "B9": "project_title",
                "D9": "total_cost",
                "E9": "location",
                "F9": "implementing_agency",
                "G9": "date_of_inspection",
                "H9": "details_on_site_inspected",
                "I9": "findings",
                "K9": "issues",
                "L9": "action_taken",
                "M9": "actions_to_be_taken",
                "C26": "submitted_by",
                "C27": "designation_office",
                "J28": "submission_date",
                "C28": "created_at"
            },
            "adminform4": {
                "B9": "project_title",
                "D9": "issue_details",
                "E9": "issue_typology",
                "F9": "location",
                "G9": "implementing_agency",
                "H9": "date_of_meeting",
                "I9": "concerned_agency",
                "J9": "agreements_reached",
                "C26": "submitted_by",
                "C27": "designation_office",
                "H28": "submission_date",
                "C28": "created_at"
            },
            "adminform5": {
                "B9": "training_title",
                "D9": "training_objective",
                "E9": "training_date",
                "F9": "conducted_facilitated_attended",
                "G9": "lead_office_unit",
                "H9": "participating_offices",
                "I9": "male",
                "J9": "female",
                "K9": "total",
                "L9": "results_feedback",
                "C26": "submitted_by",
                "C27": "designation_office",
                "H28": "submission_date",
                "C28": "created_at"
            },
            "adminform6": {
                "B10": "resolution_number",
                "C10": "resolution_title",
                "E10": "date_approved",
                "F10": "resolution",
                "H10": "resolution_link",
                "D27": "submitted_by",
                "D28": "designation_office",
                "G29": "submission_date",
                "D29": "created_at"
            },
            "adminform7": {
                "B9": "project_title",
                "D9": "location",
                "E9": "implementing_agency",
                "F9": "nature",
                "G9": "details",
                "H9": "strategies",
                "I9": "responsible_entity",
                "J9": "lesson_learned",
                "C26": "submitted_by",
                "C27": "designation_office",
                "H28": "submission_date",
                "C28": "created_at"
            }
        };

        if (cellMappings[formType]) {
            Object.entries(cellMappings[formType]).forEach(([cell, key]) => {
                if (data[key]) {
                    if (["mt_financial_targets", "mt_physical_targets"].includes(key)) {
                        // Handle multiple values in separate rows
                        const values = data[key].split(", ");
                        values.forEach((value, index) => {
                            const rowNumber = parseInt(cell.match(/\d+/)[0]);
                            const columnLetter = cell.match(/[A-Z]+/)[0];
                            const newCell = `${columnLetter}${rowNumber + index}`;
                            worksheet.getCell(newCell).value = value;
                        });
                    } else if (key === "target_outputs") {
                        // Handle multiple values in diagonal columns
                        const values = data[key].split(", ");
                        let columnCharCode = cell.charCodeAt(0); // Get ASCII code of 'U'
                        let rowNumber = parseInt(cell.match(/\d+/)[0]);

                        values.forEach((value, index) => {
                            const newCell = `${String.fromCharCode(columnCharCode + index)}${rowNumber + index}`;
                            worksheet.getCell(newCell).value = value;
                        });
                    } else {
                        worksheet.getCell(cell).value = data[key];
                    }
                }
            });
        }
        if (cellMappings[formType]) {
            Object.entries(cellMappings[formType]).forEach(([cell, key]) => {
                if (data[key]) {
                    // Special case for "implementing_agency" in form2
                    if (formType === "form2" && key === "implementing_agency") {
                        worksheet.getCell(cell).value = `Implementing Agency: ${data[key]}`;
                    } else {
                        worksheet.getCell(cell).value = data[key];
                    }
                }
            });
        }
        
        const fileName = `${formType.toUpperCase()}_Submission_${submissionId}.xlsx`;
        const buffer = await workbook.xlsx.writeBuffer();

        const blob = new Blob([buffer], { type: "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" });
        const link = document.createElement("a");
        link.href = URL.createObjectURL(blob);
        link.download = fileName;
        link.click();

        setTimeout(() => URL.revokeObjectURL(link.href), 1000);
    } catch (error) {
        console.error("Error processing the Excel file:", error);
        alert("Error processing the Excel file. Please check the template.");
    }
}









