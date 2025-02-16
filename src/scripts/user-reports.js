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


  let projectChart;

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
