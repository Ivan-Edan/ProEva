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
        <div class="custom-container">
            <div class="heading-container mb-4">
                <h1 class="text-primary font-weight-bold">Evaluation</h1>
            </div>
            <div class="card shadow-sm forms-container" id="forms-list">
                <div class="card-header bg-dark text-white">
                    Project Evaluation Forms
                </div>
                <ul class="list-group list-group-flush" id="form-list">
                    <li class="list-group-item" data-form="admin-forms/admin-evaluation-form1.php">
                        REPORT ON THE STATUS OF PROJECTS ENCOUNTERING IMPLEMENTATION PROBLEMS
                    </li>
                    <li class="list-group-item" data-form="admin-forms/admin-evaluation-form2.php">
                        PROJECT INSPECTION REPORT
                    </li>
                    <li class="list-group-item" data-form="admin-forms/admin-evaluation-form3.php">
                        PROBLEM SOLVING SESSIONS / FACILITATION MEETING CONDUCTED
                    </li>
                    <li class="list-group-item" data-form="admin-forms/admin-evaluation-form4.php">
                        TRAINING/WORKSHOP CONDUCTED / FACILITATED/ATTENDED BY THE RPMC
                    </li>
                    <li class="list-group-item" data-form="admin-forms/admin-evaluation-form5.php">
                        RPMC AND RDC RESOLUTIONS RELATED TO IMPLEMENTATION OF THE RPMES
                    </li>
                    <li class="list-group-item" data-form="admin-forms/admin-evaluation-form6.php">
                        KEY LESSONS LEARNED FROM ISSUES RESOLVED AND BEST PRACTICES
                    </li>
                    <li class="list-group-item" data-form="admin-forms/admin-evaluation-form7.php">
                        SUMMARY OF FINANCIAL AND PHYSICAL ACCOMPLISHMENTS
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
