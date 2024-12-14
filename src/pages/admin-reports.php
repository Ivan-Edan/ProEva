<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="<?php echo 'images/landing-pic.png'; ?>">
    <title>Reports Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles/admin-reports.css">
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
                                <th id="department-header" class="text-center">
                                    <span id="department-sort-icon" data-feather="chevron-up"></span>
                                    <span>Department</span>
                                </th>
                                </th>
                                <th>Sector</th>
                                <th>Budget</th>
                                <th class="text-start">Start Date</th>
                                <th class="text-start">End Date</th>
                            </tr>
                        </thead>
                        <tbody id="project-data">
                            <!-- Data will be inserted here -->
                        </tbody>
                    </table>

                    <div id="pagination" class="text-center">
                        <!-- Pagination buttons will appear here -->
                    </div>
                </div>

                <script>
                    $(document).ready(function() {
                        let currentPage = 1;
                        const recordsPerPage = 5;
                        let departmentSortOrder = 'ASC'; // Default sort order

                        // Initialize Feather Icons
                        feather.replace();

                        // Function to fetch project data with pagination and sorting
                        function fetchProjects(page = 1, sortOrder = 'ASC') {
                            $.ajax({
                                url: 'includes/fetch-reports-data.php', // URL to fetch the data from
                                type: 'GET',
                                data: {
                                    page: page,
                                    sort_order: sortOrder
                                }, // Pass sort_order as parameter
                                dataType: 'json',
                                success: function(data) {
                                    let tableBody = $('#project-data');
                                    tableBody.empty(); // Clear any existing table rows

                                    if (data.projects.length > 0) {
                                        // Loop through the data and add rows to the table
                                        $.each(data.projects, function(index, project) {
                                            let row = '<tr>';
                                            row += '<td class="text-center">' + project.project_title + '</td>';
                                            row += '<td class="text-center">' + project.department_name + '</td>';
                                            row += '<td>' + project.sector + '</td>';
                                            row += '<td>' + project.total_cost + '</td>';
                                            row += '<td>' + formatDate(project.start_date) + '</td>';
                                            row += '<td>' + formatDate(project.end_date) + '</td>';
                                            row += '</tr>';
                                            tableBody.append(row); // Append the new row to the table body
                                        });

                                        // Update the pagination
                                        generatePagination(data.totalPages, page);
                                    } else {
                                        tableBody.html(`
                        <tr>
                            <td colspan="6" class="text-center no-data-placeholder">
                                <img src="images/illustration/no-data.png" class="no-data" alt="no-data">
                                <p style="font-weight: 500;">There are no project slippage data available to compute.</p>
                            </td>
                        </tr>
                    `);
                                    }
                                },
                                error: function() {
                                    $('#project-data').html('<tr><td colspan="6" class="text-center">Error fetching data</td></tr>');
                                }
                            });
                        }

                        // Function to handle sorting
                        $('#department-header').click(function() {
                            departmentSortOrder = (departmentSortOrder === 'ASC') ? 'DESC' : 'ASC'; // Toggle order

                            // Toggle the sort icon between ascending and descending
                            const sortIcon = $('#department-sort-icon');
                            if (departmentSortOrder === 'ASC') {
                                sortIcon.attr('data-feather', 'chevron-up');
                            } else {
                                sortIcon.attr('data-feather', 'chevron-down');
                            }

                            feather.replace(); // Re-render the icons after the change

                            // Fetch projects with updated sort order
                            fetchProjects(currentPage, departmentSortOrder);
                        });

                        // Function to format date in 'November 5, 2024' format
                        function formatDate(date) {
                            const options = {
                                year: 'numeric',
                                month: 'long',
                                day: 'numeric'
                            };
                            return new Date(date).toLocaleDateString('en-US', options);
                        }

                        // Function to generate pagination buttons
                        function generatePagination(totalPages, currentPage) {
                            let paginationHTML = '';
                            for (let i = 1; i <= totalPages; i++) {
                                paginationHTML += `<button class="page-btn" data-page="${i}" ${i === currentPage ? 'disabled' : ''}>${i}</button>`;
                            }
                            $('#pagination').html(paginationHTML); // Insert pagination buttons

                            // Add click event to pagination buttons
                            $('.page-btn').click(function() {
                                const page = $(this).data('page');
                                fetchProjects(page, departmentSortOrder); // Fetch data for the clicked page
                            });
                        }

                        // Fetch projects on page load
                        fetchProjects(currentPage);
                    });
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
    fetch('includes/fetch_projecttitle.php')
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
            </div>
        </div>
    </div>

    <!-- Include JavaScript -->
    <script src="scripts/admin-reports.js"></script>

</body>

</html>