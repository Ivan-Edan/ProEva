<?php
require_once __DIR__ . '/../includes/config.php';
?>
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
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th class="text-center">Project Name</th>
                  <th>Department</th>
                  <th>Start Date</th>
                  <th>End Date</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $sql = "SELECT 
            pt.project_id, 
            pt.project_title, 
            d.name AS department_name, 
            ud.start_date, 
            ud.end_date
          FROM initialprojectreport ip
          JOIN usersdateedate ud ON ip.s_date_e_date_id = ud.s_date_e_date_id
          JOIN users_info ui ON ip.user_id = ui.user_id
          JOIN departments d ON ui.department_id = d.id
          JOIN userprojecttitle pt ON ip.project_id = pt.project_id";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                    $projectId = $row['project_id'];  // Assign project_id here
                    $projectName = $row['project_title'];
                    $department = $row['department_name'];
                    $startDate = $row['start_date'];
                    $endDate = $row['end_date'];

                    echo "<tr>";
                    echo "<td class='text-center' style='display:none;'>{$projectId}</td>";
                    echo "<td class='text-center'><a class='direct-link' href='index-admin.php?page=admin-monitoring-chart&project_id={$projectId}'>{$projectName}</a></td>";
                    echo "<td>{$department}</td>";
                    echo "<td>{$startDate}</td>";
                    echo "<td>{$endDate}</td>";
                    echo "</tr>";
                  }
                } else {
                  echo "<tr><td colspan='4' class='text-center'>No data available</td></tr>";
                }
                ?>

              </tbody>
            </table>
            <div id="pagination-controls" class="d-flex justify-content-center mt-3">
              <!-- Pagination buttons will be dynamically added here -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!--JavaScript -->
  <script src="progress-admin/admin-monitoring.js"></script>

</body>

</html>