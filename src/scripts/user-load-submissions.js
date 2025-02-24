// This file is for displaying fetched userSumbmitted forms to the submitted forms table in userSide
// This file is also the filter funtion of the submitted forms table
// This file also the open modal funtion
let currentPage = 1; // Tracks the active page
const rowsPerPage = 5; // Number of rows per page
let tableData = []; // Stores fetched data

// Fetch user submissions for all forms
function loadUserSubmissions(filters = {}) {
    // Build query parameters for filtering
    let queryParams = new URLSearchParams(filters).toString();
    fetch(`includes/get-user-submitted-form.php?${queryParams}`) // Adjust PHP file path
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
    const tableBody = document.querySelector('#userSubmissionsTable tbody');
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
            <td>
                <a href="#" class="view-form" data-id="${row.submission_id}" data-form="${row.form_type}">
                    ${formatFormName(row.form_type)}
                </a>
            </td>
            <td>${row.date_submitted}</td>
            <td>${row.status.toUpperCase()}</td>
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

                    // Populate formType and submissionId hidden inputs
                    const submissionInput = document.getElementById(`${formType}SubmissionId`);
                    const typeInput = document.getElementById(`${formType}Type`);
                    if (submissionInput && typeInput) {
                        submissionInput.value = submissionId;
                        typeInput.value = formType;
                    } else {
                        console.error(`Hidden input fields for ${formType} not found.`);
                        return;
                    }
            // Handle Form 1
            if (formType === 'form1') {
                // Populate Form 1 modal fields

                // Project Details
                document.getElementById('form1SubmissionId').value = formData.details_id; // Store details_id
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
                                <input type="text" class="form-control" value="${indicator}" >
                            </div>
                        </div>`;
                });

                const monthlyTargetsContainer = document.getElementById('monthlyTargetsContainer');
                if (!monthlyTargetsContainer) {
                    console.error("monthlyTargetsContainer not found in the DOM!");
                } else {
                    monthlyTargetsContainer.innerHTML = ''; // Clear existing rows
                }

                const months = [
                    'January', 'February', 'March', 'April', 'May', 'June', 
                    'July', 'August', 'September', 'October', 'November', 'December'
                ];

                // Ensure mty_position is an array and adjust indexes (assuming it's zero-based)
                const mty_target_position = formData.mty_target_position ? formData.mty_target_position.split(',').map(num => parseInt(num.trim(), 10) - 1) : [];
                const financialTargetsRaw = formData.mt_financial_targets ? String(formData.mt_financial_targets) : '';
                const physicalTargetsRaw = formData.mt_physical_targets ? String(formData.mt_physical_targets) : '';

                console.log("Financial Targets Raw:", financialTargetsRaw);
                console.log("Physical Targets Raw:", physicalTargetsRaw);
                console.log("mty_target_position:", mty_target_position);

                const financialTargets = financialTargetsRaw.split(',').map(item => item.trim());
                const physicalTargets = physicalTargetsRaw.split(',').map(item => item.trim());

                console.log("Processed Financial Targets:", financialTargets);
                console.log("Processed Physical Targets:", physicalTargets);

                // Iterate through the mty_position values instead of all months
                mty_target_position.forEach((pos, i) => {
                    if (pos >= 0 && pos < months.length) {
                        const month = months[pos];
                        const financial = financialTargets[i] && financialTargets[i] !== "" ? financialTargets[i] : null;
                        const physical = physicalTargets[i] && physicalTargets[i] !== "" ? physicalTargets[i] : null;

                        if (financial !== null && physical !== null) {
                            console.log(`Displaying: ${month} - Financial Target: ${financial}, Physical Target: ${physical}`);

                            if (monthlyTargetsContainer) {
                                monthlyTargetsContainer.innerHTML += `
                                    <div class="row mb-3 align-items-center">
                                        <div class="col-sm-3">
                                            <label class="form-label">${month}:</label>
                                        </div>
                                        <div class="col-sm-4">
                                            <label class="form-label">Financial Target:</label>
                                            <input type="text" class="form-control" value="${financial}" >
                                        </div>
                                        <div class="col-sm-4">
                                            <label class="form-label">Physical Target (%):</label>
                                            <input type="text" class="form-control" value="${physical}" >
                                        </div>
                                    </div>`;
                            }
                        }
                    } else {
                        console.warn(`Invalid month position: ${pos + 1}`);
                    }
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
                                <input type="text" class="form-control" value="${output}" >
                            </div>
                        </div>`;
                });
                // Get update button
                const updateButton = document.getElementById('updateForm1');

                // Check if formData.status is 'rejected'
                if (formData.status === 'rejected') {
                    updateButton.disabled = false;  // Enable update button
                } else {
                    updateButton.disabled = true;   // Disable update button
                }

                // Show modal for Form 1
                const modal = new bootstrap.Modal(document.getElementById('form1Modal'));
                modal.show();
            }



                // Handle Form 2
                if (formType === 'form2') {
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
                // Get update button
                const updateButton = document.getElementById('updateForm2');

                // Check if formData.status is 'rejected'
                if (formData.status === 'rejected') {
                    updateButton.disabled = false;  // Enable update button
                } else {
                    updateButton.disabled = true;   // Disable update button
                }
                    // Show modal for Form 2
                    const modal = new bootstrap.Modal(document.getElementById('form2Modal'));
                    modal.show();
                }

                // Handle Form 3
                else if (formType === 'form3') {
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

                    // Get update button
                    const updateButton = document.getElementById('updateForm3');

                    // Check if formData.status is 'rejected'
                    if (formData.status === 'rejected') {
                        updateButton.disabled = false;  // Enable update button
                    } else {
                        updateButton.disabled = true;   // Disable update button
                    }
                    // Show Form 3 modal
                    const modal = new bootstrap.Modal(document.getElementById('form3Modal'));
                    modal.show();
                }
                

                // Handle Form 4
                else if (formType === 'form4') {
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

                    
                    // Get update button
                    const updateButton = document.getElementById('updateForm4');

                    // Check if formData.status is 'rejected'
                    if (formData.status === 'rejected') {
                        updateButton.disabled = false;  // Enable update button
                    } else {
                        updateButton.disabled = true;   // Disable update button
                    }
                

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
        fetch(`includes/get-user-form-data.php?formType=${formType}&submissionId=${submissionId}`)
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

                    if (["form1", "form2", "form3", "form4"].includes(formType)) {
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
        const monthYear = today.toLocaleString("en-US", { month: "long", year: "numeric" });
        const monthYear_form1 = today.getFullYear();

        if (formType === "form1") worksheet.getCell("B5").value = `CY ${monthYear_form1}`;
        if (formType === "form4") worksheet.getCell("B5").value = `As of ${monthYear}`;
        if (formType === "form3" || formType === "form2") worksheet.getCell("A3").value = `As of ${monthYear}`;

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

document.getElementById('updateForm1').addEventListener('click', function() {
    const updateButton = this;

    if (updateButton.innerText === "Update") {
        // Step 1: Enable Editing
        document.querySelectorAll('#form1Modal input, #form1Modal textarea').forEach(input => {
            input.removeAttribute('readonly');
        });

        updateButton.innerText = "Save Changes"; // Change button text
    } else {
        // Step 2: Collect Updated Data
        const updatedData = {
            details_id: document.getElementById('form1SubmissionId').value, // Use this for updating
            project_title: document.getElementById('projectTitleForm1').value,
            implementing_agency: document.getElementById('implementingAgencyForm1').value,
            sector: document.getElementById('sectorForm1').value,
            mode_of_implementation: document.getElementById('modeOfImplementationForm1').value,
        
            // Location
            location: document.getElementById('locationForm1').value,
            city: document.getElementById('cityForm1').value,
            barangay: document.getElementById('barangayForm1').value,
        
            // Cost and Dates
            total_cost: document.getElementById('totalCostForm1').value,
            start_date: document.getElementById('startDateForm1').value,
            end_date: document.getElementById('endDateForm1').value,
        
            // Funding Information
            fund_agency: document.getElementById('fundAgencyForm1').value,
            fund_source: document.getElementById('fundSourceForm1').value,
        
            // Employment Generated
            male: document.getElementById('maleForm1').value,
            female: document.getElementById('femaleForm1').value,
        
            // Financial and Physical Targets
            year_financial_target: document.getElementById('financialTargetsForm1').value,
            year_phy_target_percent: document.getElementById('physicalTargetsForm1').value,
        
            // Additional Details
            comp_details: document.getElementById('compDetailsForm1').value,
            remarks: document.getElementById('remarksForm1').value,
        
            // Project Validation
            submitted_designation: document.getElementById('submittedDesignationForm1').value,
            submitted_by: document.getElementById('submittedByForm1').value,
        
            // Dynamic Fields - Output Indicators
            output_indicators: (() => {
                const indicators = [];
                document.querySelectorAll('#outputIndicatorsContainer input').forEach(input => {
                    indicators.push(input.value);
                });
                return indicators.join(', ');
            })(),
        
            // Dynamic Fields - Target Outputs
            target_outputs: (() => {
                const targets = [];
                document.querySelectorAll('#targetOutputsContainer input').forEach(input => {
                    targets.push(input.value);
                });
                return targets.join(', ');
            })(),
        
            // Monthly Financial and Physical Targets
            monthly_targets: (() => {
                const targets = [];
                document.querySelectorAll('#monthlyTargetsContainer .row').forEach(row => {
                    const month = row.querySelector('label').textContent.replace(':', '').trim();
                    const financial = row.querySelectorAll('input')[0].value;
                    const physical = row.querySelectorAll('input')[1].value;
                    targets.push({ month, financial, physical });
                });
                return targets;
            })()
        };
        
        console.log("Sending data:",updatedData);
        

        // Step 3: Send Data to Backend via AJAX
        fetch('includes/update-form1.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(updatedData)

        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert("Form updated successfully!");
                updateButton.innerText = "Update"; // Change button back
                document.querySelectorAll('#form1Modal input, #form1Modal textarea').forEach(input => {
                    input.setAttribute('readonly', true); // Make fields readonly again
                });
            } else {
                alert("Error updating form: " + data.message);
            }
        })
        .catch(error => console.error("Error:", error));
    }
});
