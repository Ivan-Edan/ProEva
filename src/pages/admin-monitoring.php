<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="<?php echo 'images/landing-pic.png'; ?>">
    <title>Monitoring Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles/admin-monitoring.css">
</head>
<body>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="container-title">Project Monitoring</div>
                <div class="container-table">
                <table class="table">
                  <thead>
                    <tr>
                      <th class="text-center">Project Name</th>
                      <th>Department</th>
                      <th>Project Personnel</th>
                      <th>Project Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td class="text-center">
                        <a class="direct-link" href="admin-progress/admin-monitoring-chart.php">Bridge Building 1</a>
                      </td>
                      <td>Engineering Office</td>
                      <td>Juan Carlos Garcia</td>
                      <td>On Progress</td>
                    </tr>
                    <tr>
                      <td class="text-center">
                        <a class="direct-link">Package Distribution</a>
                      </td>
                      <td>Social Service Office</td>
                      <td>Bernadette Campos</td>
                      <td>On Progress</td>
                    </tr>
                    <tr>
                      <td class="text-center">
                        <a class="direct-link">Dog Vaccination</a>
                      </td>
                      <td>City Vet Office</td>
                      <td>Nestor De Castro</td>
                      <td>On Progress</td>
                    </tr>
                    <!-- Add more rows as needed -->
                  </tbody>
                </table>
              </div>
            </div>
        </div>
    </div>

    <!--JavaScript -->
    <script src="scripts/admin-monitoring.js"></script>

</body>
</html>
