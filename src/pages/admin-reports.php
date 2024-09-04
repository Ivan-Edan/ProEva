<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Evaluation Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles/admin-reports.css"> <!-- Your existing custom styles -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
                      <th class="text-center">Progress</th>
                      <th>Budget</th>
                      <th>Start Date</th>
                      <th>End Date</th>
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
                      <td>Jan 01, 2024</td>
                      <td>Jan 01, 2025</td>
                      <td class="text-center">9</td>
                      <td class="text-center">2</td>
                    </tr>
                    <!-- Add more rows as needed -->
                  </tbody>
                </table>
              </div>
                <div class="container-4">
                    <div id="chart-container">
                        <canvas id="myBarChart"></canvas>
                    </div>
                    <h3 class="text-graph">Per Department Budget Performance Overview</h3>
                </div>
                <div class="container-5">
                    <div id="chart-container">
                      <canvas id="projectChart"></canvas>
                    </div>
                    <h3 class="text-graph">Per Department Schedule Performance Index</h3>
                </div>
                <div class="container-6">
                  <div class = "card"><h5>Project Name :</h5><p>Building Relief Center</p></div>
                </div>
                <br>
                <br>
                <div class="container-7">Archive</div>
                <div class="container-8">
                <table class="table">
                  <thead>
                    <tr>
                      <th class="text-center">Project Name</th>
                      <th class="text-center">Department</th>
                      <th class="text-center">Form Type</th>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="scripts/admin-reports.js"></script> <!-- Your existing custom script -->
</body>
</html>