<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Evaluation Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles/admin-evaluation.css"> <!-- Your existing custom styles -->
</head>
<body>
    <div class="container-fluid evaluation-container">
        <div class="custom-container">
        <div class="container-1">Evaluation</div>
            <div class="card shadow-sm forms-container" id="forms-list">
                <div class="card-header text-white">
                    Project Evaluation Forms
                </div>
                <ul class="list-group list-group-flush" id="form-list">
                    <li class="list-group-item" data-form="admin-forms/admin-evaluation-form1.php">
                        SUMMARY OF FINANCIAL AND PHYSICAL ACCOMPLISHMENTS
                    </li>
                    <li class="list-group-item" data-form="admin-forms/admin-evaluation-form2.php">
                        REPORT ON THE STATUS OF PROJECTS ENCOUNTERING IMPLEMENTATION PROBLEMS
                    </li>
                    <li class="list-group-item" data-form="admin-forms/admin-evaluation-form3.php">
                        PROJECT INSPECTION REPORT
                    </li>
                    <li class="list-group-item" data-form="admin-forms/admin-evaluation-form4.php">
                        PROBLEM SOLVING SESSIONS / FACILITATION MEETING CONDUCTED
                    </li>
                    <li class="list-group-item" data-form="admin-forms/admin-evaluation-form5.php">
                        TRAINING/WORKSHOP CONDUCTED / FACILITATED/ATTENDED BY THE RPMC
                    </li>
                    <li class="list-group-item" data-form="admin-forms/admin-evaluation-form6.php">
                        RPMC AND RDC RESOLUTIONS RELATED TO IMPLEMENTATION OF THE RPMES
                    </li>
                    <li class="list-group-item" data-form="admin-forms/admin-evaluation-form7.php">
                        KEY LESSONS LEARNED FROM ISSUES RESOLVED AND BEST PRACTICES
                    </li>
                </ul>
            </div>
            <div id="form-content" class="mt-4">
                <!-- Form content will be loaded here -->
            </div>
        </div>
    </div>

    <!-- Include JavaScript -->
    <script src="scripts/admin-evaluation.js"></script> <!-- Your existing custom script -->
</body>
</html>
