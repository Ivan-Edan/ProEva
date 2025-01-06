<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="styles/user-reports.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="container-1">Reports</div>
                <div class="container-2">Performance Reports</div>
                <div class="container-3">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-center">Project Name</th>
                                <th class="text-center">Sector</th>
                                <th class="text-center">Budget</th>
                                <th class="text-center">Start Date</th>
                                <th class="text-center">End Date</th>
                                <th class="text-center">Completed Task</th>
                                <th class="text-center">In Progress Task</th>
                            </tr>
                        </thead>
                        <tbody id="project-data">
                            <!-- Dynamic data will be inserted here -->
                        </tbody>
                    </table>

                    <div id="pagination" class="text-center">
                        <!-- Pagination buttons will appear here -->
                    </div>
                </div>

                <div class="container-4">
                    <!-- Dropdown Menu -->
                    <div class="dropdown d-flex justify-content-end mb-3">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="projectDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            Project Title
                            <i data-feather="chevron-down" class="icon-edge"></i>
                        </button>
                        <ul class="dropdown-menu" id="projectList" aria-labelledby="projectDropdown">
                            <li>
                                <input type="text" class="form-control" id="searchField" placeholder="Search Project">
                            </li>
                        </ul>
                    </div>

                    <!-- Project Details Section -->
                    <div id="projectDetails">
                        <canvas id="projectChart"></canvas>
                        <div id="noDataMessage" style="display: none;">
                            <img src="images/illustration/no-data.png" class="no-data" alt="no-data">
                            <p style="font-weight: 500;">There are no project data available to compute.</p>
                        </div>
                    </div>
                    <br>
                    <h5 class="text-graph">Per Department’s Project Financial Status Report (in PHP)</h5>
                </div>
                <br>
            </div>
        </div>
    </div>

    <!-- Include JavaScript -->
    <script src="scripts/user-reports.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</body>

</html>