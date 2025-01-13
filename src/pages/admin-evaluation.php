<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'includes/admin-submittedForms-table-modal.php'; ?><!-- Fetches the submittedForm files modal -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Evaluation Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles/main.css">
    <link rel="stylesheet" href="styles/admin-evaluation.css"> <!-- Your existing custom styles -->
</head>
<body>
    <div class="container-fluid evaluation-container">
        <div class="custom-container">
        <div class="container-1">FORMS</div>
            <div class="card shadow-sm forms-container" id="forms-list">
                <div class="card-header text-white">
                    Project Evaluation Forms
                </div>
                <ul class="list-group list-group-flush" id="form-list">
                    <li class="list-group-item" data-form="admin-forms/admin-evaluation-form1.php" data-form-type="adminform1">
                        SUMMARY OF FINANCIAL AND PHYSICAL ACCOMPLISHMENTS
                    </li>
                    <li class="list-group-item" data-form="admin-forms/admin-evaluation-form2.php" data-form-type="adminform2">
                        REPORT ON THE STATUS OF PROJECTS ENCOUNTERING IMPLEMENTATION PROBLEMS
                    </li>
                    <li class="list-group-item" data-form="admin-forms/admin-evaluation-form3.php" data-form-type="adminform3">
                        PROJECT INSPECTION REPORT
                    </li>
                    <li class="list-group-item" data-form="admin-forms/admin-evaluation-form4.php" data-form-type="adminform4">
                        PROBLEM SOLVING SESSIONS / FACILITATION MEETING CONDUCTED
                    </li>
                    <li class="list-group-item" data-form="admin-forms/admin-evaluation-form5.php" data-form-type="adminform5">
                        TRAINING/WORKSHOP CONDUCTED / FACILITATED/ATTENDED BY THE RPMC
                    </li>
                    <li class="list-group-item" data-form="admin-forms/admin-evaluation-form6.php" data-form-type="adminform6">
                        RPMC AND RDC RESOLUTIONS RELATED TO IMPLEMENTATION OF THE RPMES
                    </li>
                    <li class="list-group-item" data-form="admin-forms/admin-evaluation-form7.php" data-form-type="adminform7">
                        KEY LESSONS LEARNED FROM ISSUES RESOLVED AND BEST PRACTICES
                    </li>
                </ul>
            </div>
            <div id="form-content" class="mt-4">
                <!-- Form content will be loaded here -->
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
                QUARTER : 1st
            </div>

            <!-- Table Section -->
            <div class="card shadow-sm mt-4" id="submitted-forms-container">
                <div class="card-body" >
                <table id="submissionsTable" class="table">
                    <thead>
                        <tr>
                            <th>Project Name</th>
                            <th>Department</th>
                            <th>User Submitted Forms</th>
                            <th>Date Submitted</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Dynamic rows will be inserted here -->
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

    <!-- Success Modal -->
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="successModalLabel">Submission Successful</h5>
            </div>
            <div class="modal-body">
                Your form has been submitted successfully.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-bs-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>


    <!-- Include JavaScript -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Updated jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> <!-- Updated Bootstrap JS -->
    <script src="scripts/admin-load-submissions.js"></script>
    <script src="scripts/admin-evaluation.js"></script> <!-- Your existing custom script -->

</body>
</html>
