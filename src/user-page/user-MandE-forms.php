<!DOCTYPE html>
<html lang="en">
<head>
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
                    QUARTER : 1st
                </div>
            <!-- Table Section -->
            <div class="card shadow-sm mt-4" id="submitted-forms-container">
                <div class="card-body" >
                <table class="table table-hover" >
            <thead class="table-header">
                <tr>
                    <th>Project Name</th>
                    <th>User Submitted Forms</th>
                    <th>Date Submitted</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Bridge Building 1</td>
                    <td>INITIAL PROJECT REPORT</td>
                    <td>Jan 24, 2024</td>
                </tr>
                <tr>
                    <td>Bridge Building 2</td>
                    <td>INITIAL PROJECT REPORT</td>
                    <td>Jan 24, 2024</td>
                </tr>
                <tr>
                    <td>Bridge Building 3</td>
                    <td>INITIAL PROJECT REPORT</td>
                    <td>Jan 24, 2024</td>
                </tr>
            </tbody>
        </table>
                    <nav class="pagination-container" id="pagination-container">
                        <ul class="pagination justify-content-center">
                            <li class="page-item"><a class="page-link active" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">4</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Include JavaScript -->
    <script src="scripts/user-eval-utils.js"></script>
    <script src="scripts/user-eval-global.js"></script>
    <script src="scripts/user-form1.js"></script>
</body>
</html>
