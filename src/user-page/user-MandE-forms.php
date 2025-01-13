<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'includes/user-submittedForms-table-modal.php'; ?><!-- Fetches the submittedForm files modal -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forms Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles/main.css">
    <link rel="stylesheet" href="styles/user-evaluation.css">
</head>
<body>
    <div class="container-fluid evaluation-container">
        <div class="custom-container">
            <div class="container-1">Forms</div>
            <!-- Project Forms Section -->
            <div class="card shadow-sm forms-container" id="forms-list">
                <div class="card-header text-white">
                    Project Forms
                </div>
                <ul class="list-group list-group-flush" id="form-list">
                    <li class="list-group-item" data-form="user-forms/user-evaluation-form1.php" data-form-type="form1">Form 1: INITIAL PROJECT REPORT</li>
                    <li class="list-group-item" data-form="user-forms/user-evaluation-form2.php" data-form-type="form2">Form 2: PHYSICAL AND FINANCIAL ACCOMPLISHMENT REPORT</li>
                    <li class="list-group-item" data-form="user-forms/user-evaluation-form3.php" data-form-type="form3">Form 3: PROJECT EXCEPTION REPORT</li>
                    <li class="list-group-item" data-form="user-forms/user-evaluation-form4.php" data-form-type="form4">Form 4: PROJECT RESULTS</li>
                </ul>
            </div>
            <div id="form-content" class="mt-4">
                <!-- Form content will be dynamically loaded here -->
            </div>
            <!-- Quarter Section -->
            <div class="card-header text-white mt-4" id="quarter-container">
                <select id="filterDropdown">
                    <option value="all">All Forms</option>
                    <option value="form1">Form1: Initial Project Report</option>
                    <option value="form2">Form2: Financial & Physical Accomplishments</option>
                    <option value="form3">Form3: Exception Report</option>
                    <option value="form4">Form4: Project Results</option>
                </select>
                <span id="quarter-display">QUARTER : 1st</span>
            </div>
            <!-- Table Section -->
            <div class="card shadow-sm mt-4" id="submitted-forms-container">
                <div class="card-body" >
                <table id="userSubmissionsTable" class="table table-striped">
            <thead class="table-header">
                <tr>
                    <th>Project Name</th>
                    <th>User Submitted Forms</th>
                    <th>Date Submitted</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
        <nav class="pagination-container" id="pagination-container">
                    <ul class="pagination justify-content-center" id="pagination">
                        <!-- Dynamic pagination links will be generated here -->
                    </ul>
        </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- Confirmation Modal -->
    <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmationModalLabel">Confirm Submission</h5>
                </div>
                <div class="modal-body">
                    Are you sure you want to submit this form?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" id="confirmSubmitButton" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </div>

        <!-- Cancel Confirmation Modal -->
    <div class="modal fade" id="cancelConfirmationModal" tabindex="-1" aria-labelledby="cancelConfirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cancelConfirmationModalLabel">Cancel Confirmation</h5>
                </div>
                <div class="modal-body">
                    Are you sure you want to cancel? All unsaved changes will be lost.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No, Stay</button>
                    <button type="button" id="confirmCancelButton" class="btn btn-danger">Yes, Cancel</button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="errorModalLabel">Error</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="errorModalBody">
                <!-- Error message will be dynamically inserted here -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="successModalLabel">Submission Successful</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Your form has been successfully submitted.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-bs-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>


    <!-- Include JavaScript -->
    <script src="scripts/user-eval-utils.js"></script>
    <script src="scripts/user-eval-global.js"></script>
    <script src="scripts/user-form1.js"></script>
    <script src="scripts/user-load-submissions.js"></script>
</body>
</html>
