<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="<?php echo 'images/landing-pic.png'; ?>">
    <title>Reports Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles/user-reports.css"> <!-- Your existing custom styles -->
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
                      <th class="text-center">Progress</th>
                      <th class="text-center">Budget</th>
                      <th class="text-center">Start Date</th>
                      <th class="text-center">End Date</th>
                      <th class="text-center">Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td class="text-center">Bridge Building 1</td>
                      <td class="text-center">75%</td>
                      <td class="text-center">₱ 100,000</td>
                      <td class="text-center">Jan 01, 2024</td>
                      <td class="text-center">Jan 01, 2025</td>
                      <td class="text-center">In Progress</td>
                    </tr>
                    <!-- Add more rows as needed -->
                  </tbody>
                </table>
              </div>
                <div class="container-4">
                    <div id="chart-container">
                        <canvas id="myBarChart"></canvas>
                    </div>
                    <h3 class="text-graph">Budget Performance Overview</h3>
                </div>
                <br>
                <div class="container-7">Archive</div>
                <div class="container-8">
                <table class="table">
                  <thead>
                    <tr>
                      <th class="text-center">Form Name</th>
                      <th class="text-center">Date Created</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td class="text-center download-link">SUMMARY OF FINANCIAL AND PHYSICAL ACCOMPLISHMENTS</td>
                      <td class="text-center">January 27, 2024</td>
                    </tr>
                    <tr>
                      <td class="text-center download-link">REPORT ON THE STATUS OF PROJECTS ENCOUNTERING IMPLEMEN....</td>
                      <td class="text-center">December 27, 2024</td>
                    </tr>
                    <tr>
                      <td class="text-center download-link">PROJECT INSPECTION REPORT</td>
                      <td class="text-center">June 27, 2024</td>
                    </tr>
                    <!-- Add more rows as needed -->
                  </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Include JavaScript -->
    <script src="scripts/user-reports.js"></script>

</body>
</html>