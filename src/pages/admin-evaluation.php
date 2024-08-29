<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Evaluation Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles/admin-evaluation.css"> <!-- Your existing custom styles -->
</head>
<body>
    <div class="container-fluid evaluation-container">
        <div class="container mb-4">
            <div class="heading-container mb-4">
                <h1 class="text-primary font-weight-bold">Evaluation</h1>
            </div>
            <div class="card shadow-sm forms-container" id="forms-list">
                <div class="card-header bg-dark text-white">
                    Project Evaluation Forms
                </div>
                <ul class="list-group list-group-flush" id="form-list">
                    <li class="list-group-item" data-form="admin-forms/admin-evaluation-form1.php">
                        Report on the Status of Projects Encountering Implementation Problems
                    </li>
                    <li class="list-group-item" data-form="admin-forms/admin-evaluation-form2.php">
                        Project Inspection Report
                    </li>
                    <li class="list-group-item" data-form="admin-forms/admin-evaluation-form3.php">
                        Problem Solving Sessions / Facilitation Meeting Conducted
                    </li>
                    <li class="list-group-item" data-form="admin-forms/admin-evaluation-form4.php">
                        Training/Workshop Conducted / Facilitated/Attended by the RPMC
                    </li>
                    <li class="list-group-item" data-form="admin-forms/admin-evaluation-form5.php">
                        RPMC and RDC Resolutions Related to Implementation of the RPMES
                    </li>
                    <li class="list-group-item" data-form="admin-forms/admin-evaluation-form6.php">
                        Key Lessons Learned from Issues Resolved and Best Practices
                    </li>
                </ul>
            </div>
            <div id="form-content" class="mt-4">
                <!-- Form content will be loaded here -->
            </div>
        </div>
    </div>

    <!-- Include JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="scripts/admin-evaluation.js"></script> <!-- Your existing custom script -->
</body>
</html>
