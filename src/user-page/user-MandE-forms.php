<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evaluation Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles/main.css">
    <link rel="stylesheet" href="styles/user-evaluation.css"> <!-- Your existing custom styles -->
</head>
<body>
    <div class="container-fluid evaluation-container">
        <div class="custom-container">
        <div class="container-1">Evaluation</div>
            <div class="card shadow-sm forms-container" id="forms-list">
                <div class="card-header text-white">
                    Project Forms
                </div>
                <ul class="list-group list-group-flush" id="form-list">
                    <li class="list-group-item" data-form="user-forms/user-evaluation-form1.php">
                        INITIAL PROJECT REPORT
                    </li>
                </ul>
                <ul class="list-group list-group-flush" id="form-list">
                    <li class="list-group-item" data-form="user-forms/user-evaluation-form2.php">
                        PHYSICAL AND FINANCIAL ACCOMPLISHMENT REPORT
                    </li>
                </ul>
                <ul class="list-group list-group-flush" id="form-list">
                    <li class="list-group-item" data-form="user-forms/user-evaluation-form3.php">
                        PROJECT EXCEPTION REPORT
                    </li>
                </ul>
                <ul class="list-group list-group-flush" id="form-list">
                    <li class="list-group-item" data-form="user-forms/user-evaluation-form4.php">
                        PROJECT RESULTS
                    </li>
                </ul>
            </div>
            <div id="form-content" class="mt-4">
                <!-- Form content will be loaded here -->
            </div>
        </div>
    </div>

    <!-- Include JavaScript -->
    <script src="scripts/user-evaluation.js"></script> <!-- Your existing custom script -->
</body>
</html>
