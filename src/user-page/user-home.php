<?php
require_once 'includes/config.php'; 

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];

    // Fetch the user's info from the database
    $stmt = $conn->prepare("SELECT first_name, last_name FROM users_info WHERE user_id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Check if a result was returned
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $fullName = htmlspecialchars($user['first_name'] . ' ' . $user['last_name']);
    } else {
        $fullName = 'User'; // Fallback name if not found
    }

    $stmt->close();
} else {
    $fullName = 'Guest'; // Fallback name for not logged-in users
}

// Close the database connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Home</title>
    <!-- Link to Bootstrap 5.3 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://unpkg.com/feather-icons"></script>
    <!-- Link to custom CSS -->
    <link rel="stylesheet" href="styles/main.css">
    <link rel="stylesheet" href="styles/user-home.css">
</head>

<body>
    <div class="container-fluid dashboard-container">
        <div class="greeting-box mb-4">
            <div class="greeting-icon-container">
                <img src="images/illustration/welcome-icon.png" alt="Welcome Icon" class="greeting-icon">
            </div>
            <div class="greeting-text">
                <h1 class="greet">Greetings, <span class="greet-2"><?php echo $fullName; ?></span></h1>
                <h4 class="greet-3">This is your <span class="greet-4">dashboard.</span></h4>
            </div>
        </div>

        <!-- Project Stats Section -->
<div class="row project-stats-container mb-4">
    <div class="col">
        <div class="stat-box d-flex align-items-center">
            <div class="stat-content d-flex align-items-center justify-content-between w-100">
                <img src="images/illustration/done-icon.png" alt="Tasks Done Icon" class="stat-icon">
                <p class="stat-label">Number of Task Done:</p>
                <p class="stat-number done">0</p> <!-- Start with 0 or any default value -->
            </div>
        </div>
    </div>
    <div class="col">
        <div class="stat-box d-flex align-items-center">
            <div class="stat-content d-flex align-items-center justify-content-between w-100">
                <img src="images/illustration/done-icon.png" alt="Tasks Incoming Icon" class="stat-icon">
                <p class="stat-label">Number of Task that is Incoming:</p>
                <p class="stat-number incoming">0</p> <!-- Start with 0 or any default value -->
            </div>
        </div>
    </div>
    <div class="col">
        <div class="stat-box d-flex align-items-center">
            <div class="stat-content d-flex align-items-center justify-content-between w-100">
                <img src="images/illustration/done-icon.png" alt="Tasks In Progress Icon" class="stat-icon">
                <p class="stat-label">Number of Task On Progress:</p>
                <p class="stat-number in_progress">0</p> <!-- Start with 0 or any default value -->
            </div>
        </div>
    </div>
</div>

        <div class="row project-stats-container mb-4">
            <div class="col">
                <div class="stat-box-1 d-flex align-items-center">
                    <div class="stat-content d-flex align-items-center justify-content-between w-100">
                        <img src="images/illustration/clock.png" alt="Current Time Icon" class="stat-icon-1">
                        <p id="philippine-time" class="stat-label-1"></p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="stat-box-1 d-flex align-items-center">
                    <div class="stat-content d-flex align-items-center justify-content-between w-100">
                        <img src="images/illustration/calendar.png" alt="Tasks Done Icon" class="stat-icon-3">
                        <p id="philippine-day" class="stat-number-3"></p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="stat-box-1 d-flex align-items-center">
                    <div class="stat-content d-flex align-items-center justify-content-between w-100">
                        <img src="images/illustration/date.png" alt="Tasks Done Icon" class="stat-icon-2">
                        <p id="philippine-date" class="stat-number-4"></p>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="container-8">
    <!-- Dropdown Button -->
    <div class="dropdown-container">
        <div class="dropdown dropdown-details">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="departmentDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                Project Status Sort By: 
                <i data-feather="chevron-down" class="icon-edge"></i>
            </button>
            <ul class="dropdown-menu" aria-labelledby="departmentDropdown">
                <li><a class="dropdown-item" href="#">All</a></li> <!-- Added All option -->
                <li><a class="dropdown-item" href="#">Done</a></li>
                <li><a class="dropdown-item" href="#">In Progress</a></li>
                <li><a class="dropdown-item" href="#">Incoming</a></li>
            </ul>
        </div>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th class="text-center">Main Task Name</th>
                <th class="text-center">Project Title</th>
                <th class="text-center">Project Status</th>
                <th class="text-center">Start Date</th>
                <th class="text-center">End Date</th>
                <th class="text-center">Date Created</th>
            </tr>
        </thead>
        <tbody id="table-body">
            <!-- The rows will be dynamically generated here -->
        </tbody>
    </table>

    <!-- Pagination Controls -->
    <div id="pagination-controls" class="pagination"></div>
    
</div>

        <br>
        <br>
        <div class="container-2">Project’s Information</div>
        <!-- Project Stats Section -->
        <div class="row project-stats-container mb-4">
            <div class="col">
                <div class="stat-box d-flex align-items-center">
                    <div class="stat-content d-flex align-items-center justify-content-between w-100">
                        <img src="images/illustration/done-icon.png" alt="Tasks Done Icon" class="stat-icon">
                        <p class="stat-label">Number of Accepted Projects :</p>
                        <p class="stat-number">9</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="stat-box d-flex align-items-center">
                    <div class="stat-content d-flex align-items-center justify-content-between w-100">
                        <img src="images/illustration/done-icon.png" alt="Tasks Incoming Icon" class="stat-icon">
                        <p class="stat-label">Number of Rejected Projects :</p>
                        <p class="stat-number">2</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="stat-box d-flex align-items-center">
                    <div class="stat-content d-flex align-items-center justify-content-between w-100">
                        <img src="images/illustration/done-icon.png" alt="Tasks In Progress Icon" class="stat-icon">
                        <p class="stat-label">Number of Pending Projects :</p>
                        <p class="stat-number">1</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-6">
            <div class="d-flex justify-content-between align-items-start">
                <!-- Card Content -->
                <div class="card flex-fill">
                    <div class="card-content">
                        <h5>Project Name :</h5>
                        <p>Building Relief Center</p>
                    </div>
                </div>
                <!-- Dropdown Button -->
                <div class="dropdown-container">
                    <div class="dropdown dropdown-details">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="departmentDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            Projects
                            <i data-feather="chevron-down" class="icon-edge"></i>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="departmentDropdown">
                            <li>
                                <input type="text" class="form-control" id="searchField" name="searchField" placeholder="Search">
                            </li>
                            <li><a class="dropdown-item" href="#">Bridge Building</a></li>
                            <li><a class="dropdown-item" href="#">Bridge Building 2</a></li>
                        </ul>
                    </div>
                </div>
                <script>
                    feather.replace(); 
                </script>
            </div>
            <div class="card-content">
                <h4>Performance Index (SPI) values :</h4>
                <p class="text-detail">1.12</p>
            </div>
            <div class="card-content">
                <h4>Status :</h4>
                <p class="text-detail">Ahead of schedule, high confidence</p>
            </div>
            <h4 class="text-issue">Issue Details :</h4>
            <p class="text-detail-2">Project implementation delays due to uncooperative lot owners. Lot owners not fully apprised/informed on <br>the project.</p>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>-->

    <!-- Custom JS -->
    <script src="scripts/user-home.js"></script>
</body>

</html>