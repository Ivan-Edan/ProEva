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
                    <?php
                      $sql = "SELECT pt.project_title, ip.project_id
                                        FROM initialprojectreport ip
                                        JOIN userprojecttitle pt
                                        ON ip.project_id = pt.project_id";
                      $resultMain = $conn->query($sql);

                      if ($resultMain->num_rows > 0) {
                          while ($main = $resultMain->fetch_assoc()) {
                            $projectId = $main['project_id'];
                            $projectName = $main['project_title'];

                            echo "<tr>";
                            echo "<td class='text-center' style='display:none;'>{$projectId}</td>";
                            echo "<td class='text-center'><a class='direct-link' href='index-admin.php?page=admin-monitoring-chart&project_id={$projectId}'>{$projectName}</a></td>";
                            echo "<td></td>";
                            echo "<td></td>";
                            echo "<td></td>";
                            echo "</tr>";
                          }
                        }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
        </div>
    </div>

    <!--JavaScript -->
    <script src="progress-admin/admin-monitoring.js"></script>

</body>
</html>
