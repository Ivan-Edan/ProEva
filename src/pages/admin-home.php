<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Admin</title>
    <!-- Link to Bootstrap 5.3 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <!-- Link to your custom CSS -->
    <link rel="stylesheet" href="styles/admin-home.css">
</head>
<body>
    <div class="container-fluid dashboard-container">
        <!-- Greeting Section -->
        <div class="greeting-box mb-4">
            <div class="greeting-icon-container">
                <img src="images/welcome-icon.svg" alt="Welcome Icon" class="greeting-icon">
            </div>
            <h2>Greetings Juan Carlos. This is your dashboard</h2>
        </div>
        <!-- Project Stats Section -->
        <div class="row project-stats-container mb-4">
            <div class="col">
                <div class="stat-box d-flex align-items-center">
                    <div class="stat-content d-flex align-items-center justify-content-between w-100">
                        <img src="images/done-icon.svg" alt="Projects Done Icon" class="stat-icon">
                        <p class="stat-label">Number of Project Completed:</p>
                        <p class="stat-number">10</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="stat-box d-flex align-items-center">
                    <div class="stat-content d-flex align-items-center justify-content-between w-100">
                        <img src="images/done-icon.svg" alt="Projects To Do Icon" class="stat-icon">
                        <p class="stat-label">Number of Project that is Incoming:</p>
                        <p class="stat-number">5</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="stat-box d-flex align-items-center">
                    <div class="stat-content d-flex align-items-center justify-content-between w-100">
                        <img src="images/done-icon.svg" alt="Projects In Progress Icon" class="stat-icon">
                        <p class="stat-label">Number of Project on Progress:</p>
                        <p class="stat-number">3</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Outer Container for Projects Table -->
        <div class="projects-outer-box">
            <!-- Inner Container for Projects Table -->
            <div class="projects-inner-box">
                <canvas id="projectChart"></canvas>
            </div>
        </div>
    </div>
    <!-- Link for Line Chart, Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>

    <!-- Link to Bootstrap 5.3 JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Link to your custom JS -->
    <script src="scripts/admin-home.js"></script>
</body>
</html>
