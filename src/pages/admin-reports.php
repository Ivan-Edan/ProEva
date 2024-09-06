<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="<?php echo 'images/landing-pic.png'; ?>">
    <title>Reports Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles/admin-reports.css"> <!-- Your existing custom styles -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://unpkg.com/feather-icons"></script>
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
                      <th>Department</th>
                      <th>
                          <button class="sort-icon-btn" data-column="progress">
                              <i class="sort-icon" data-feather="arrow-down"></i>
                          </button>
                          Progress 
                      </th>
                      <th>
                          Budget
                      </th>
                      <th>
                          <button class="sort-icon-btn" data-column="start-date">
                              <i class="sort-icon" data-feather="arrow-down"></i>
                          </button>
                          Start Date
                      </th>
                      <th>
                          <button class="sort-icon-btn" data-column="end-date">
                              <i class="sort-icon" data-feather="arrow-down"></i>
                          </button>
                          End Date
                      </th>
                      <th class="text-center">Completed Task</th>
                      <th class="text-center">Pending Task</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Bridge Building 1</td>
                      <td>Engineering Office</td>
                      <td class="text-center">75%</td>
                      <td>₱ 100,000</td>
                      <td class="text-center">Jan 01, 2024</td>
                      <td class="text-center">Jan 01, 2025</td>
                      <td class="text-center">9</td>
                      <td class="text-center">2</td>
                    </tr>
                    <!-- Add more rows as needed -->
                  </tbody>
                </table>
              </div>
                <div class="container-4">
                  <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="departmentDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                      Departments
                      <i data-feather="chevron-down" class="icon-edge"></i>
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
                    <div id="chart-container">
                        <canvas id="myBarChart"></canvas>
                    </div>
                    <h3 class="text-graph">Per Department Budget Performance Overview</h3>
                </div>
                <div class="container-5">
                  <div class="dropdown">
                      <button class="btn btn-secondary dropdown-toggle" type="button" id="departmentDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        Departments
                        <i data-feather="chevron-down" class="icon-edge"></i>
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
                    <div id="chart-container">
                      <canvas id="projectChart"></canvas>
                    </div>
                    <h3 class="text-graph">Per Department Schedule Performance Index</h3>
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
                          Departments
                          <i data-feather="chevron-down" class="icon-edge"></i>
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
                    </div>
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
                <br>
                <br>
                <div class="container-7">Archive</div>
                <div class="container-8">
                <table class="table">
                  <thead>
                    <tr>
                      <th class="text-center">Project Name</th>
                      <th class="text-center">
                          <button class="sort-icon-btn" data-column="progress">
                              <i class="sort-icon" data-feather="arrow-down"></i>
                          </button>
                          Department
                      </th>
                      <th class="text-center">
                          <button class="sort-icon-btn" data-column="progress">
                              <i class="sort-icon" data-feather="arrow-down"></i>
                          </button>
                          Form Type
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td class="text-center">Bridge Building 1</td>
                      <td class="text-center">Engineering Office</td>
                      <td class="text-center download-link">SUMMARY OF FINANCIAL AND PHYSICAL ACCOMPLISHMENTS</td>
                    </tr>
                    <tr>
                      <td class="text-center">Bridge Building 1</td>
                      <td class="text-center">Engineering Office</td>
                      <td class="text-center download-link">REPORT ON THE STATUS OF PROJECTS ENCOUNTERING IMPLEMEN....</td>
                    </tr>
                    <tr>
                      <td class="text-center">Bridge Building 1</td>
                      <td class="text-center">Engineering Office</td>
                      <td class="text-center download-link">PROJECT INSPECTION REPORT</td>
                    </tr>
                    <!-- Add more rows as needed -->
                  </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Include JavaScript -->
    <script src="scripts/admin-reports.js"></script>

</body>
</html>