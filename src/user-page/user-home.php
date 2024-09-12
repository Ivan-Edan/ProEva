<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Home</title>
    <!-- Link to Bootstrap 5.3 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <!-- Link to custom CSS -->
    <link rel="stylesheet" href="styles/main.css">
    <link rel="stylesheet" href="styles/user-home.css">
</head>
<body>
    <div class="container-fluid dashboard-container">
        <!-- Greeting Section -->
        <div class="greeting-box mb-4">
            <div class="greeting-icon-container">
                <img src="images/illustration/welcome-icon.png" alt="Welcome Icon" class="greeting-icon">
            </div>
            <h2>Greetings, Ivan Angelo. This is your dashboard.</h2>
        </div>
        
        <!-- Project Stats Section -->
        <div class="row project-stats-container mb-4">
            <div class="col">
                <div class="stat-box d-flex align-items-center">
                    <div class="stat-content d-flex align-items-center justify-content-between w-100">
                        <img src="images/illustration/done-icon.png" alt="Tasks Done Icon" class="stat-icon">
                        <p class="stat-label">Number of Task Done:</p>
                        <p class="stat-number">9</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="stat-box d-flex align-items-center">
                    <div class="stat-content d-flex align-items-center justify-content-between w-100">
                        <img src="images/illustration/done-icon.png" alt="Tasks Incoming Icon" class="stat-icon">
                        <p class="stat-label">Number of Task that is Incoming:</p>
                        <p class="stat-number">2</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="stat-box d-flex align-items-center">
                    <div class="stat-content d-flex align-items-center justify-content-between w-100">
                        <img src="images/illustration/done-icon.png" alt="Tasks In Progress Icon" class="stat-icon">
                        <p class="stat-label">Number of Task On Progress:</p>
                        <p class="stat-number">1</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Projects Table Section -->
        <div class="projects-outer-box mb-4">
            <div class="projects-inner-box">
                <table class="table table-hover">
                    <thead class="table-header">
                        <tr>
                            <th>Project Name</th>
                            <th>Project Personnel</th>
                            <th>Project Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Bridge Building</td>
                            <td>Juan Carlos Garcia</td>
                            <td>On Progress</td>
                        </tr>
                        <tr>
                            <td>Package Distribution</td>
                            <td>Bernadette Campos</td>
                            <td>On Progress</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JS -->
    <script src="scripts/user-home.js"></script>
</body>
</html>
