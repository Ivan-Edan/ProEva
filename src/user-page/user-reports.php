<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reports Page</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="styles/user-reports.css"> <!-- Your existing custom styles -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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


        <script>
          // Function to format dates
          function formatDate(dateString) {
            const options = {
              year: 'numeric',
              month: 'long',
              day: 'numeric'
            };
            const date = new Date(dateString);
            return date.toLocaleDateString('en-US', options);
          }

          // Function to fetch data and update the table
          function fetchReports(page = 1) {
            fetch('includes/fetch-user-reports.php?page=' + page)
              .then(response => response.json())
              .then(data => {
                if (data.error) {
                  alert(data.error);
                  return;
                }

                const tableBody = document.getElementById('project-data');
                const paginationDiv = document.getElementById('pagination');

                // Clear previous data
                tableBody.innerHTML = '';

                // Check if no data exists
                if (data.reports.length === 0) {
                  tableBody.innerHTML = `
                    <tr>
                        <td colspan="6" class="text-center no-data-placeholder">
                            <img src="images/illustration/no-data.png" class="no-data" alt="no-data">
                            <p style="font-weight: 500;">There are no project slippage data available to compute.</p>
                        </td>
                    </tr>
                `;
                } else {
                  // Loop through data and create table rows
                  data.reports.forEach(report => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td class="text-center">${report.project_title}</td>
                        <td class="text-center">${report.sector}</td>
                        <td class="text-center">${report.total_cost}</td>
                        <td class="text-center">${formatDate(report.start_date)}</td>
                        <td class="text-center">${formatDate(report.end_date)}</td>
                    `;
                    tableBody.appendChild(row);
                  });
                }

                // Generate pagination buttons
                generatePagination(data.totalPages, page);
              })
              .catch(error => console.error('Error:', error));
          }

          // Function to generate pagination buttons (without Previous and Next buttons)
          function generatePagination(totalPages, currentPage) {
            const paginationDiv = document.getElementById('pagination');
            paginationDiv.innerHTML = ''; // Clear existing pagination buttons

            // Create page number buttons
            for (let i = 1; i <= totalPages; i++) {
              const pageButton = document.createElement('button');
              pageButton.textContent = i;
              pageButton.disabled = i === currentPage;
              pageButton.onclick = () => fetchReports(i);
              paginationDiv.appendChild(pageButton);
            }
          }

          // Initial data load
          fetchReports();
        </script>


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
        <?php if (!empty($projectTitles)): ?>
            <?php foreach ($projectTitles as $title): ?>
                <li>
                    <a class="dropdown-item" href="#"><?php echo htmlspecialchars($title); ?></a>
                </li>
            <?php endforeach; ?>
        <?php else: ?>
            <li>
                <span class="dropdown-item-text">No project titles available for your department.</span>
            </li>
        <?php endif; ?>
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

<h5 class="text-graph">Per Department’s Project Financial Status Report (in PHP)</h5>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    let projectChart; // Declare globally

    // Function to fetch project details and update the chart
    function fetchProjectDetails(projectId) {
        const chartElement = document.getElementById('projectChart');
        const noDataElement = document.getElementById('noDataMessage');

        chartElement.style.display = 'none';
        noDataElement.style.display = 'none';
        
        noDataElement.innerHTML = '<p>Loading data...</p>';
        noDataElement.style.display = 'block';

        fetch(`includes/fetch-graph-user.php?project_id=${projectId}`)
            .then(response => response.json())
            .then(data => {
                console.log("Fetched Data: ", data);

                noDataElement.style.display = 'none';

                if (data.error || data.message) {
                    showNoDataMessage();
                } else {
                    if (!projectChart) {
                        initializeChart(); 
                    }
                    updateChart(data);
                    chartElement.style.display = 'block';
                }
            })
            .catch(error => {
                console.error('Error fetching project details:', error);
                showNoDataMessage();
            });
    }

    // Show "No Data" message
    function showNoDataMessage() {
        const chartElement = document.getElementById('projectChart');
        const noDataElement = document.getElementById('noDataMessage');
        
        chartElement.style.display = 'none';
        noDataElement.style.display = 'block';
        noDataElement.innerHTML = ` 
            <img src="images/illustration/no-data.png" class="no-data" alt="no-data">
            <p style="font-weight: 500;">There are no project data available to compute.</p>
        `;
    }

    // Initialize the chart with default placeholder data
    function initializeChart() {
        const ctx = document.getElementById('projectChart').getContext('2d');
        projectChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Appropriations', 'Allotments', 'Obligations', 'Disbursements'],
                datasets: [
                    {
                        label: 'Appropriations',
                        data: [0, 0, 0, 0], // Default placeholder data
                        borderColor: '#AEAEAE',
                        backgroundColor: '#27374D',
                        borderWidth: 1,
                        fill: true,
                        barThickness: 30,
                        categoryPercentage: 0.5,
                        barPercentage: 1.0
                    },
                    {
                        label: 'Allotments',
                        data: [0, 0, 0, 0], // Default placeholder data
                        borderColor: '#9DB2BF',
                        backgroundColor: '#9DB2BF',
                        borderWidth: 1,
                        fill: true,
                        barThickness: 30,
                        categoryPercentage: 0.5,
                        barPercentage: 1.0
                    },
                    {
                        label: 'Obligations',
                        data: [0, 0, 0, 0], // Default placeholder data
                        borderColor: '#5478A9',
                        backgroundColor: '#5478A9',
                        borderWidth: 1,
                        fill: true,
                        barThickness: 30,
                        categoryPercentage: 0.5,
                        barPercentage: 1.0
                    },
                    {
                        label: 'Disbursements',
                        data: [0, 0, 0, 0], // Default placeholder data
                        borderColor: '#4BC0C0',
                        backgroundColor: '#4BC0C0',
                        borderWidth: 1,
                        fill: true,
                        barThickness: 30,
                        categoryPercentage: 0.5,
                        barPercentage: 1.0
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                animation: {
                    duration: 800,
                    easing: 'easeInOutQuad',
                },
                plugins: {
                    legend: {
                        display: true,
                        position: 'bottom',
                        align: 'start',
                        labels: {
                            boxWidth: 20,
                            boxHeight: 20,
                            padding: 10,
                            usePointStyle: true,
                            pointStyle: 'circle'
                        }
                    },
                    tooltip: {
                        enabled: true
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                    }
                }
            }
        });
    }

    // Function to update the chart with data
    function updateChart(data) {
        const appropriations = parseFloat(data[0].appropriations);
        const allotments = parseFloat(data[0].allotment);
        const obligations = parseFloat(data[0].obligations);
        const disbursements = parseFloat(data[0].disimbursements);

        if (!isNaN(appropriations) && !isNaN(allotments) && !isNaN(obligations) && !isNaN(disbursements)) {
            projectChart.data.datasets[0].data = [appropriations, null, null, null];
            projectChart.data.datasets[1].data = [null, allotments, null, null];
            projectChart.data.datasets[2].data = [null, null, obligations, null];
            projectChart.data.datasets[3].data = [null, null, null, disbursements];

            projectChart.update();
        } else {
            showNoDataMessage();
        }
    }

    // Initialize chart with placeholder data when no project is selected
    initializeChart();

    // Fetch project titles and populate dropdown
    fetch('includes/fetch-user-projects.php')
        .then(response => response.json())
        .then(data => {
            const projectList = document.getElementById('projectList');
            const searchField = document.getElementById('searchField');

            function renderProjects(projects) {
                const listItems = projectList.querySelectorAll('li:not(:first-child)');
                listItems.forEach(item => item.remove());

                if (projects.length > 0) {
                    projects.forEach(project => {
                        const li = document.createElement('li');
                        const a = document.createElement('a');
                        a.classList.add('dropdown-item');
                        a.href = '#';
                        a.textContent = project.project_title;
                        a.dataset.projectId = project.project_id;
                        li.appendChild(a);
                        projectList.appendChild(li);
                    });
                } else {
                    const li = document.createElement('li');
                    li.textContent = 'No projects found.';
                    projectList.appendChild(li);
                }
            }

            function filterProjects(query) {
                const filteredProjects = data.filter(project =>
                    project.project_title.toLowerCase().includes(query.toLowerCase())
                );
                renderProjects(filteredProjects);
            }

            renderProjects(data);

            searchField.addEventListener('input', function() {
                const query = this.value;
                filterProjects(query);
            });

            projectList.addEventListener('click', function(e) {
                if (e.target && e.target.matches('a.dropdown-item')) {
                    const projectId = e.target.dataset.projectId;
                    fetchProjectDetails(projectId);
                }
            });
        })
        .catch(error => console.error('Error fetching projects:', error));
</script>

        <br>
      </div>
    </div>
  </div>

  <!-- Include JavaScript -->
  <script src="scripts/user-reports.js"></script>

</body>

</html>