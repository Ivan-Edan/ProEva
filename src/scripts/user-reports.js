  // Initialize feather icons
  document.addEventListener('DOMContentLoaded', function () {
    feather.replace(); // Replaces the <i> elements with icons
});


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
<td colspan="7" class="text-center no-data-placeholder">
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
                    <td class="text-center">${report.completed_tasks}</td>
                    <td class="text-center">${report.in_progress_tasks}</td>
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

let projectChart; // Global variable for the chart instance

// Function to show "No Data" message
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

// Function to initialize the chart
function initializeChart() {
    const ctx = document.getElementById('projectChart').getContext('2d');
    projectChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Appropriations', 'Allotments', 'Obligations', 'Disbursements'],
            datasets: [{
                label: 'Project Financial Status',
                data: [0, 0, 0, 0], // Default to zero for all bars
                backgroundColor: ['#27374D', '#9DB2BF', '#5478A9', '#4BC0C0'],
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false, // Hide legend since labels are clear
                },
                tooltip: {
                    enabled: true,
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return value.toLocaleString(); // Format numbers with commas
                        }
                    }
                },
                x: {
                    barThickness: 10, // Set a fixed bar thickness
                    maxBarThickness: 15, // Limit maximum bar thickness
                    ticks: {
                        autoSkip: false
                    },
                    grid: {
                        display: false, // Disable grid lines on the x-axis
                    }
                }
            }
        }
    });
}

// Function to update the chart with fetched data
function updateChart(data) {
    const appropriations = parseFloat(data[0]?.appropriations) || 0;
    const allotments = parseFloat(data[0]?.allotment) || 0;
    const obligations = parseFloat(data[0]?.obligations) || 0;
    const disbursements = parseFloat(data[0]?.disbursements) || 0;

    if (appropriations || allotments || obligations || disbursements) {
        // Update chart data
        projectChart.data.datasets[0].data = [appropriations, allotments, obligations, disbursements];
        projectChart.update();
    } else {
        showNoDataMessage();
    }
}

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

            if (data.error || !data.length) {
                showNoDataMessage();
            } else {
                updateChart(data);
                chartElement.style.display = 'block';
            }
        })
        .catch(error => {
            console.error('Error fetching project details:', error);
            showNoDataMessage();
        });
}

// Function to fetch and display project titles
function fetchProjects() {
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
}

// Initialize chart and fetch projects on load
initializeChart();
fetchProjects();
