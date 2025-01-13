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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
                  <th>Department <i id="sort-icon" class="fas fa-sort"></i></th>
                  <th>Start Date</th>
                  <th>End Date</th>
                </tr>
              </thead>
              <tbody id="account-table-body">
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
             JOIN userprojecttitle pt ON ip.project_id = pt.project_id
             WHERE ip.status = 'approved'";           
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                    $projectId = $row['project_id'];
                    $projectName = $row['project_title'];
                    $department = $row['department_name'];
                    $startDate = $row['start_date'];
                    $endDate = $row['end_date'];

                    echo "<tr>";
                    echo "<td class='text-center'><a class='direct-link' href='index-admin.php?page=admin-monitoring-chart&project_id={$projectId}'>{$projectName}</a></td>";
                    echo "<td>{$department}</td>";
                    echo "<td data-startdate='{$startDate}' class='start-date'>{$startDate}</td>";
                    echo "<td data-enddate='{$endDate}' class='end-date'>{$endDate}</td>";
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

  <!-- JavaScript -->
  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const sortIcon = document.getElementById("sort-icon");
      const tableBody = document.getElementById("account-table-body");
      const paginationControls = document.getElementById("pagination-controls");
      const rowsPerPage = 5; // Number of rows per page
      let isAscending = true;
      let currentPage = 1;

      function renderTable() {
        const rows = Array.from(tableBody.querySelectorAll("tr"));
        const startRow = (currentPage - 1) * rowsPerPage;
        const endRow = startRow + rowsPerPage;

        rows.forEach((row, index) => {
          row.style.display = index >= startRow && index < endRow ? "" : "none";
        });

        renderPaginationControls(rows.length);
      }

      function renderPaginationControls(totalRows) {
        const totalPages = Math.ceil(totalRows / rowsPerPage);
        paginationControls.innerHTML = "";

        for (let i = 1; i <= totalPages; i++) {
          const button = document.createElement("button");
          button.textContent = i;
          button.className = "btn btn-sm btn-outline-primary mx-1";
          if (i === currentPage) button.classList.add("active");

          button.addEventListener("click", () => {
            currentPage = i;
            renderTable();
          });

          paginationControls.appendChild(button);
        }
      }

      function sortTable() {
        const rows = Array.from(tableBody.querySelectorAll("tr"));
        rows.sort((a, b) => {
          const departmentA = a.cells[1].textContent.trim().toLowerCase();
          const departmentB = b.cells[1].textContent.trim().toLowerCase();

          if (isAscending) {
            return departmentA > departmentB ? 1 : -1;
          } else {
            return departmentA < departmentB ? 1 : -1;
          }
        });

        // Clear table body and append sorted rows
        tableBody.innerHTML = "";
        rows.forEach(row => tableBody.appendChild(row));

        // Re-render pagination and table
        currentPage = 1; // Reset to the first page after sorting
        renderTable();
      }

      sortIcon.addEventListener("click", () => {
        isAscending = !isAscending;
        sortTable();
        sortIcon.classList.toggle("fa-sort-up", isAscending);
        sortIcon.classList.toggle("fa-sort-down", !isAscending);
      });

      // Function to format date
      function formatDate(dateString) {
        const date = new Date(dateString);
        const options = { month: 'short', day: 'numeric', year: 'numeric' };
        return date.toLocaleDateString('en-US', options);
      }

      // Format the start and end dates
      const rows = document.querySelectorAll("#account-table-body tr");

      rows.forEach(row => {
        const startDateCell = row.querySelector('.start-date');
        const endDateCell = row.querySelector('.end-date');

        if (startDateCell) {
          const startDate = startDateCell.getAttribute('data-startdate');
          startDateCell.textContent = formatDate(startDate);
        }

        if (endDateCell) {
          const endDate = endDateCell.getAttribute('data-enddate');
          endDateCell.textContent = formatDate(endDate);
        }
      });

      // Initial render
      renderTable();
    });
  </script>
</body>

</html>
