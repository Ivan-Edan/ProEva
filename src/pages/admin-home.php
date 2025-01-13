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

// Fetch the count of admin accounts
$resultAdmin = $conn->query("SELECT COUNT(*) AS admin_count FROM users WHERE role = 'admin'");
$adminCount = $resultAdmin->fetch_assoc()['admin_count'];

// Fetch the count of user accounts
$resultUser = $conn->query("SELECT COUNT(*) AS user_count FROM users WHERE role = 'user'");
$userCount = $resultUser->fetch_assoc()['user_count'];

// Fetch the count of departments
$resultDepartment = $conn->query("SELECT COUNT(*) AS department_count FROM departments");
$departmentCount = $resultDepartment->fetch_assoc()['department_count'];

// Close the database connection
$conn->close();
?>
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
                <h1 class="greet">Greetings, <span class="greet-2"><?php echo $fullName; ?></span></h1>
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
                        <p class="stat-number"><?php echo htmlspecialchars($adminCount); ?></p> <!-- Display admin count -->
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="stat-box d-flex align-items-center">
                    <div class="stat-content d-flex align-items-center justify-content-between w-100">
                        <img src="images/illustration/done-icon.png" alt="Projects To Do Icon" class="stat-icon">
                        <p class="stat-label">Number of User Accounts:</p>
                        <p class="stat-number"><?php echo htmlspecialchars($userCount); ?></p> <!-- Display user count -->
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="stat-box d-flex align-items-center">
                    <div class="stat-content d-flex align-items-center justify-content-between w-100">
                        <img src="images/illustration/done-icon.png" alt="Projects In Progress Icon" class="stat-icon">
                        <p class="stat-label-dept">Number of Departments:</p>
                        <p class="stat-number-dept"><?php echo htmlspecialchars($departmentCount); ?></p> <!-- Display department count -->
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
                        <img src="images/illustration/calendar.png" alt="Tasks Done Icon" class="stat-icon">
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
        <!-- Outer Container for Projects Table -->
        <div class="projects-outer-box">
            <!-- Dropdown Menu -->
            <div class="dropdown d-flex justify-content-end mb-3">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="departmentDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    Department
                </button>
                <ul class="dropdown-menu" id="departmentList" aria-labelledby="departmentDropdown">
                    <li>
                        <input type="text" class="form-control" id="searchField" placeholder="Search">
                    </li>
                    <!-- Dynamic departments will be inserted here -->
                </ul>
                <script>
                    // Fetch departments and populate dropdown
                    fetch('includes/fetch_departments.php')
                        .then(response => response.json())
                        .then(data => {
                            const departmentList = document.getElementById('departmentList');
                            const searchField = document.getElementById('searchField');

                            // Function to render the department items
                            function renderDepartments(departments) {
                                // Clear previous list items (not the search input)
                                const listItems = departmentList.querySelectorAll('li:not(:first-child)');
                                listItems.forEach(item => item.remove());

                                // Add department items based on filtered departments
                                if (departments.length > 0) {
                                    departments.forEach(department => {
                                        const li = document.createElement('li');
                                        const a = document.createElement('a');
                                        a.classList.add('dropdown-item');
                                        a.href = '#';
                                        a.textContent = department.name; 
                                        li.appendChild(a);
                                        departmentList.appendChild(li);
                                    });
                                } else {
                                    // If no departments are found, show a "No Results" message
                                    const li = document.createElement('li');
                                    li.textContent = 'No departments found.';
                                    departmentList.appendChild(li);
                                }
                            }

                            // Function to filter the departments based on the search query
                            function filterDepartments(query) {
                                // Filter departments based on the search query
                                const filteredDepartments = data.filter(department =>
                                    department.name.toLowerCase().includes(query.toLowerCase())
                                );

                                // Render the filtered departments
                                renderDepartments(filteredDepartments);
                            }

                            // Initial render of all departments
                            renderDepartments(data);

                            // Search Function: Listen for input and filter departments
                            searchField.addEventListener('input', function() {
                                const query = this.value;
                                filterDepartments(query); 
                            });
                        })
                        .catch(error => console.error('Error fetching departments:', error));
                        
                </script>

            </div>
            <!-- Inner Container for Projects Table -->
            <div class="projects-inner-box">
                <div id="noSlippageData" class="no-data-placeholder">
                    <img src="images/illustration/no-data.png" class="no-data" alt="no-data">
                    <p style="font-weight: 500;">There are no project slippage data available to compute.</p>
                </div>
                <canvas id="projectChart"></canvas>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Link for Line Chart, Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.min.js"></script>
    <!-- Link to your custom JS -->
    <script src="scripts/admin-home.js"></script>
</body>

</html>