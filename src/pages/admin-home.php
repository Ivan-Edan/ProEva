<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Admin</title>
    <!-- Link to Bootstrap 5.3 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <!-- Link to your custom CSS -->
    <link rel="stylesheet" href="styles/main.css">
    <link rel="stylesheet" href="styles/admin-home.css">

</head>
<body>
    <div class="container-fluid dashboard-container">
        <!-- Greeting Section -->
        <div class="greeting-box mb-4">
            <div class="greeting-icon-container">
                <img src="images/illustration/welcome-icon.png" alt="Welcome Icon" class="greeting-icon">
            </div>
            <div class="greeting-text">
            <h1 class="greet">Greetings, <span class="greet-2">Juan Carlos.</span></h1>
            <h4 class="greet-3">This is your <span class="greet-4">dashboard.</span></h4>
        </div>
        </div>
        <!-- Project Stats Section -->
        <div class="row project-stats-container mb-4">
            <div class="col">
                <div class="stat-box d-flex align-items-center">
                    <div class="stat-content d-flex align-items-center justify-content-between w-100">
                        <img src="images/illustration/done-icon.png" alt="Projects Done Icon" class="stat-icon">
                        <p class="stat-label">Number of Admin Accounts:</p>
                        <p class="stat-number">9</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="stat-box d-flex align-items-center">
                    <div class="stat-content d-flex align-items-center justify-content-between w-100">
                        <img src="images/illustration/done-icon.png" alt="Projects To Do Icon" class="stat-icon">
                        <p class="stat-label">Number of User Accounts:</p>
                        <p class="stat-number">47</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="stat-box d-flex align-items-center">
                    <div class="stat-content d-flex align-items-center justify-content-between w-100">
                        <img src="images/illustration/done-icon.png" alt="Projects In Progress Icon" class="stat-icon">
                        <p class="stat-label">Number of Departments:</p>
                        <p class="stat-number">48</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Outer Container for Projects Table -->
        <div class="projects-outer-box">
            <!-- Dropdown Menu -->
            <div class="dropdown d-flex justify-content-end mb-3">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="departmentDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    Departments
                </button>
                <ul class="dropdown-menu" aria-labelledby="departmentDropdown">
                    <li>
                        <input type="text" class="form-control" id="searchField" name="searchField" placeholder="Search">
                    </li>
                    <li><a class="dropdown-item" href="#">DSWD</a></li>
                    <li><a class="dropdown-item" href="#">NDRRMC</a></li>
                    <li><a class="dropdown-item" href="#">CPDO</a></li>
                </ul>
            </div>
            <!-- Inner Container for Projects Table -->
            <div class="projects-inner-box">
                <canvas id="projectChart"></canvas>
            </div>
        </div>
    </div>
    <!-- Link for Line Chart, Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.min.js"></script>
    <!-- Link to your custom JS -->
    <script src="scripts/admin-home.js"></script>
</body>
</html>
