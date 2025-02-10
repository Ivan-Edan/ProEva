<?php
require_once __DIR__ . '/../includes/config.php';

?>


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
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
  <div class="container mt-4">
    <div class="row">
      <div class="col-md-12">
        <div class="container-1">Reports</div>
        <div class="container-2">Performance Reports</div>
        <div class="container-3">
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th class="text-center">Project Name</th>
                <th id="department-header">
                  <span id="department-sort-icon" data-feather="chevron-up"></span>
                  <span>Department</span>
                </th>
                <th class="text-center">Sector</th>
                <th>Budget</th>
                <th class="text-start">Start Date</th>
                <th class="text-start">End Date</th>
                <th>Completed Task</th>
                <th>In Progress Task</th>
              </tr>
            </thead>
            <tbody id="project-data">
              <!-- Data will be inserted here -->
            </tbody>
          </table>
        </div>
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

    fetch(`includes/fetch_project_details.php?project_id=${projectId}`)
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

  function initializeChart() {
    const ctx = document.getElementById('projectChart').getContext('2d');
    projectChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Quarter 1', 'Quarter 2', 'Quarter 3', 'Quarter 4', 'Total'], // Add 'Total' column
            datasets: [
                {
                    label: 'Appropriations',
                    data: [0, 0, 0, 0, 0], // Placeholder data
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
                    data: [0, 0, 0, 0, 0], // Placeholder data
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
                    data: [0, 0, 0, 0, 0], // Placeholder data
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
                    data: [0, 0, 0, 0, 0], // Placeholder data
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

function updateChart(data) {
    const quarterlyData = {
        Q1: { appropriations: 0, allotments: 0, obligations: 0, disbursements: 0 },
        Q2: { appropriations: 0, allotments: 0, obligations: 0, disbursements: 0 },
        Q3: { appropriations: 0, allotments: 0, obligations: 0, disbursements: 0 },
        Q4: { appropriations: 0, allotments: 0, obligations: 0, disbursements: 0 }
    };

    data.forEach(item => {
        const date = new Date(item.created_at);
        const quarter = getQuarter(date);

        if (!isNaN(item.appropriations)) quarterlyData[quarter].appropriations += parseFloat(item.appropriations);
        if (!isNaN(item.allotment)) quarterlyData[quarter].allotments += parseFloat(item.allotment);
        if (!isNaN(item.obligations)) quarterlyData[quarter].obligations += parseFloat(item.obligations);
        if (!isNaN(item.disbursements)) quarterlyData[quarter].disbursements += parseFloat(item.disbursements);
    });

    // Calculate totals
    const totals = {
        appropriations: Object.values(quarterlyData).reduce((sum, q) => sum + q.appropriations, 0),
        allotments: Object.values(quarterlyData).reduce((sum, q) => sum + q.allotments, 0),
        obligations: Object.values(quarterlyData).reduce((sum, q) => sum + q.obligations, 0),
        disbursements: Object.values(quarterlyData).reduce((sum, q) => sum + q.disbursements, 0)
    };

    // Update the chart data
    projectChart.data.datasets[0].data = [
        quarterlyData.Q1.appropriations, quarterlyData.Q2.appropriations,
        quarterlyData.Q3.appropriations, quarterlyData.Q4.appropriations, totals.appropriations
    ];
    projectChart.data.datasets[1].data = [
        quarterlyData.Q1.allotments, quarterlyData.Q2.allotments,
        quarterlyData.Q3.allotments, quarterlyData.Q4.allotments, totals.allotments
    ];
    projectChart.data.datasets[2].data = [
        quarterlyData.Q1.obligations, quarterlyData.Q2.obligations,
        quarterlyData.Q3.obligations, quarterlyData.Q4.obligations, totals.obligations
    ];
    projectChart.data.datasets[3].data = [
        quarterlyData.Q1.disbursements, quarterlyData.Q2.disbursements,
        quarterlyData.Q3.disbursements, quarterlyData.Q4.disbursements, totals.disbursements
    ];

    projectChart.update();
}


  // Function to determine the quarter of a given date
  function getQuarter(date) {
    const month = date.getMonth() + 1; // Months are 0-indexed
    if (month >= 1 && month <= 3) return 'Q1';
    if (month >= 4 && month <= 6) return 'Q2';
    if (month >= 7 && month <= 9) return 'Q3';
    return 'Q4';
  }

  // Initialize chart with placeholder data when no project is selected
  initializeChart();

  // Fetch project titles and populate dropdown
  fetch('includes/fetch_project_admintitle.php')
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

        <div class="container-5">
          <div id="chart-container">
            <canvas id="spi-chart"></canvas>
          </div>
          <h3 class="text-graph">Per Project of the Department Overall Schedule Performance Index</h3>
        </div>
        <div class="container-6" style="height: auto;">
          <div class="d-flex justify-content-between align-items-start">
            <!-- Card Content -->
            <div class="card flex-fill">
              <div class="card-content">
                <h5>Project Name :</h5>
                <p>
                  <select class="form-control mainproject" id="mainproject" name="mainproject">
                    <option>Select Project</option>
                    <?php
                    $projects = mysqli_query($conn, "SELECT DISTINCT upfar.Form2_id, p.*, s.*, fa.*, fs.*, tc.*, fs1.*, pa.*, ad.*, te.*, rm.*, ia.*, si.*, li.*, afd.* FROM userphysfinaccompreport upfar 
                                                                      JOIN userprojecttitle p ON p.project_id = upfar.project_id
                                                                      JOIN userprojectexptrprt upe ON p.project_id = upe.project_id                                                                    
                                                                      JOIN usersdateedate s ON s.s_date_e_date_id = upfar.s_date_e_date_id
                                                                      JOIN userfundagency fa ON fa.fund_agency_id = upfar.fund_agency_id
                                                                      JOIN userfundsource fs ON fs.fund_source_id = upfar.fund_source_id
                                                                      JOIN usertotalcost tc ON tc.total_cost_id = upfar.total_cost_id
                                                                      JOIN userfinancialstatus fs1 ON fs1.financial_status_id = upfar.financial_status_id
                                                                      JOIN userphysaccomplishments pa ON pa.Phys_Accomplishment_id = upfar.Phys_Accomplishment_id
                                                                      JOIN useraddidetails ad ON ad.Addi_Details_id = upfar.Addi_Details_id
                                                                      JOIN usertargetemployee te ON te.target_employee_id = upfar.Target_employee_id
                                                                      JOIN userremarks rm ON rm.remarks_id = upfar.remarks_id
                                                                      JOIN userimplementingagency ia ON ia.implementing_agency_id = upe.implementing_agency_id
                                                                      JOIN usersector si ON si.sector_id = upe.sector_id
                                                                      JOIN userlocation li ON li.location_id = upe.location_id
                                                                      JOIN userform3addidetails afd ON upe.Addi_form3_details_id = afd.Addi_form3_details_id");
                    if (mysqli_num_rows($projects) > 0) {
                      while ($row = mysqli_fetch_assoc($projects)) {
                        $formId2 = ['Form2_id'];
                        $projId = $row['project_id'];
                        $projName = $row['project_title'];
                        $startDate = $row['start_date'];
                        $endDate = $row['end_date'];
                        $fundAgency = $row['fund_agency'];
                        $fundSource = $row['fund_source'];
                        $totalCost = $row['total_cost'];
                        $appropriations = $row['appropriations'];
                        $allotment = $row['allotment'];
                        $obligations = $row['obligations'];
                        $disbursement = $row['disbursements'];
                        $targetOWPA = $row['target_owpa'];
                        $actualOWPA = $row['actual_owpa'];
                        $slippage = $row['slippage'];
                        $targetDate = $row['target_date'];
                        $actualDate = $row['actual_date'];
                        $male = $row['male'];
                        $female = $row['female'];
                        $remarks1 = $row['remarks'];
                        $implementingAgency = $row['implementing_agency'];
                        $sector = $row['sector'];
                        $location = $row['location'];
                        $city = $row['city'];
                        $barangay = $row['barangay'];
                        $findings = $row['findings'];
                        $typology = $row['typology'];
                        $issueStatus = $row['issue_status'];
                        $reasons = $row['reasons'];
                        $actionTaken = $row['actions_taken'];
                        $actionToBeTaken = $row['actions_to_be_taken'];
                        echo "<option value='$projId' 
                                              data-id='$projId'
                                              data-name='$projName'
                                              data-start='$startDate' 
                                              data-end='$endDate' 
                                              data-fundagency='$fundAgency'
                                              data-fundsource='$fundSource'
                                              data-totalcost='$totalCost'
                                              data-appropriations='$appropriations'
                                              data-allotment='$allotment'
                                              data-obligations='$obligations'
                                              data-disbursement='$disbursement'
                                              data-targetowpa='$targetOWPA'
                                              data-actualowpa='$actualOWPA'
                                              data-slippage='$slippage'
                                              data-targetdate='$targetDate'
                                              data-actualdate='$actualDate'
                                              data-male='$male'
                                              data-female='$female'
                                              data-remarks='$remarks1'
                                              data-implementingagency='$implementingAgency'
                                              data-sector='$sector'
                                              data-location='$location'
                                              data-city='$city'
                                              data-barangay='$barangay'
                                              data-findings='$findings'
                                              data-typology='$typology'
                                              data-issuestatus='$issueStatus'
                                              data-reasons='$reasons'
                                              data-actiontaken='$actionTaken'
                                              data-actiontobetaken='$actionToBeTaken'
                                              >$projName</option>";
                      }
                    } else {
                      echo "<option value=''>No Main Project Found!</option>";
                    }
                    ?>
                  </select>
                </p>
              </div>
            </div>
          </div>
          <div class="card-content">
            <h4>Planned Value (PV) :</h4>
            <p class="pv-detail" id="pv-detail"></p>
          </div>
          <div class="card-content">
            <h4>Earned Value (EV) :</h4>
            <p class="ev-detail" id="ev-detail"></p>
          </div>
          <div class="card-content">
            <h4>Performance Index (SPI) values :</h4>
            <p class="spi-detail" id="spi-detail"></p>
          </div>
          <div class="card-content">
            <h4>Status :</h4>
            <p class="text-detail" id="status-detail"></p>
          </div>
          <h4 class="text-issue">Issue Details :</h4>
          <p class="text-detail-2" id="issue-detail"></p>
        </div>
        <br>
      </div>
    </div>
  </div>

  <!-- Include JavaScript -->
  <script src="scripts/admin-reports.js"></script>
  <script>
    let spiChartInstance;
    $(document).ready(function() {
      $('#mainproject').on('change', function() {
        console.log("AJAX request triggered"); // Check if this logs to the console

        console.log('Selected Project:', $(this).val());

        $('#pv-detail').text('');
        $('#ev-detail').text('');
        $('#spi-detail').text('');
        $('#status-detail').text('');
        $('#issue-detail').text('');
        $('#spi-chart').attr('src', '');

        // Clear the chart if it exists
        if (spiChartInstance) {
          spiChartInstance.destroy(); // Destroy the existing chart instance
        }

        const projectId = $(this).val();
        const selectedProjectName = $(this).find(':selected').data('name') || 'No project selected';
        console.log(selectedProjectName);

        const projectData = {
          id: projectId,
          name: $(this).find(':selected').data('name'),
          start: $(this).find(':selected').data('start'),
          end: $(this).find(':selected').data('end'),
          totalcost: $(this).find(':selected').data('totalcost'),
          fundagency: $(this).find(':selected').data('fundagency'),
          fundsource: $(this).find(':selected').data('fundsource'),
          appropriations: $(this).find(':selected').data('appropriations'),
          allotment: $(this).find(':selected').data('allotment'),
          obligations: $(this).find(':selected').data('obligations'),
          disbursement: $(this).find(':selected').data('disbursement'),
          targetowpa: $(this).find(':selected').data('targetowpa'),
          actualowpa: $(this).find(':selected').data('actualowpa'),
          slippage: $(this).find(':selected').data('slippage'),
          male: $(this).find(':selected').data('male'),
          female: $(this).find(':selected').data('female'),
          remarks: $(this).find(':selected').data('remarks'),
          implementingagency: $(this).find(':selected').data('implementingagency'),
          sector: $(this).find(':selected').data('sector'),
          location: $(this).find(':selected').data('location'),
          city: $(this).find(':selected').data('city'),
          barangay: $(this).find(':selected').data('barangay'),
          finding: $(this).find(':selected').data('findings'),
          typology: $(this).find(':selected').data('typology'),
          issuestatus: $(this).find(':selected').data('issuestatus'),
          reasons: $(this).find(':selected').data('reasons'),
          actiontaken: $(this).find(':selected').data('actiontaken'),
          actiontobetaken: $(this).find(':selected').data('actiontobetaken'),

        };

        console.log(projectData)
        $.ajax({
          url: 'pages/process_spi.php',
          type: 'POST',
          data: projectData,
          success: function(response) {
            console.log('ASD: ', projectData)
            console.log("AJAX response:", response);

            console.log("Raw Responses:", response);

            if (response && response.length > 0) {
              const pv = response[0].pv;
              const ev = response[0].ev;
              const spi = response[0].spi;
              const status = response[0].status || 'No status data';
              const issueDetails = response[0].issue_details || 'No issue details';

              // Convert newlines to <br> for line breaks in HTML
              const formattedIssueDetails = issueDetails.replace(/\n/g, '<br>');

              const totalProgramCost = parseFloat(response[0].total_program_cost);

              $('#pv-detail').text(Number(pv).toLocaleString());
              $('#ev-detail').text(Number(ev).toLocaleString());
              $('#spi-detail').text(spi);
              $('#status-detail').text(status);
              $('#issue-detail').html('<b>' + formattedIssueDetails.replace(/\*/g, '') + '</b>'); // Use .html() to insert formatted text

              console.log(spi);

              const ctx = document.getElementById('spi-chart').getContext('2d');
              const SPI = [parseFloat(spi)];
              console.log('spi', SPI);
              spiChartInstance = new Chart(ctx, {
                type: 'bar',
                data: {
                  labels: [selectedProjectName],
                  datasets: [{
                    data: SPI,
                    backgroundColor: '#9DB2BF',
                    borderColor: '#9DB2BF',
                    borderWidth: 1,
                    barPercentage: 0.3, // Adjusted bar width
                    borderRadius: 5 // Adjust the border radius here
                  }]
                },
                options: {
                  responsive: true,
                  maintainAspectRatio: false, // Ensures the chart fits the container
                  plugins: {
                    legend: {
                      display: false,
                      position: 'bottom', // Move the legend to the bottom
                      align: 'start', // Center the legend
                      labels: {
                        boxWidth: 40, // Set the width of the legend box
                        padding: 10, // Adjust the padding around the legend items
                        usePointStyle: false, // Use point styles (circles) instead of boxes
                      }
                    },
                    tooltip: {
                      enabled: true // Disable tooltips
                    }
                  },
                  layout: {
                    padding: {
                      left: 40, // Add space on the left side of the chart
                      right: 40, // Add space on the right side of the chart
                      top: 10, // Add space on the top of the chart
                      bottom: 5 // Add space at the bottom to accommodate both legend and custom title
                    }
                  },
                  scales: {
                    x: {
                      stacked: false,
                      grid: {
                        display: false // Remove vertical grid lines
                      },
                      categoryPercentage: 0.8 // Adjust space between groups
                    },
                    y: {
                      beginAtZero: true,
                      grid: {
                        display: true // Show horizontal grid lines
                      }
                    }
                  }
                },
              });

            }
          },
          error: function(xhr, status, error) {
            console.error("AJAX Error:", status, error);
            console.log("XHR Response:", xhr.responseText);
          }
        });
      });
    });
  </script>
</body>

</html>