document.addEventListener('DOMContentLoaded', function() {
  // Get the canvas element
  var ctx = document.getElementById('myBarChart').getContext('2d');

  // Create a new bar chart
  var myBarChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['Build a Building', 'Road Widening'],
      datasets: [
        {
          label: 'Actual Cost',
          data: [10, 20, 15, 25, 30, 45, 40],
          backgroundColor: '#9DB2BF',
          borderColor: '#9DB2BF',
          borderWidth: 1,
          barPercentage: 0.3, // Adjusted bar width
          borderRadius: 5 // Adjust the border radius here
        },
        {
          label: 'Initial Budget',
          data: [15, 25, 10, 20, 35, 50, 45],
          backgroundColor: '#27374D',
          borderColor: '#27374D',
          borderWidth: 1,
          barPercentage: 0.3, // Adjusted bar width
          borderRadius: 5 // Adjust the border radius here
        }
      ]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false, // Ensures the chart fits the container
      plugins: {
        legend: {
          display: true,
          position: 'bottom', // Move the legend to the bottom
          align: 'start', // Center the legend
          labels: {
            boxWidth: 40, // Set the width of the legend box
            boxHeight: 40, // Set the height of the legend box
            padding: 10, // Adjust the padding around the legend items
            usePointStyle: true, // Use point styles (circles) instead of boxes
            pointStyle: 'circle', // Set the point style to circle
            pointRadius: 15 // Increase the size of the circle in the legend
          }
        },
        tooltip: {
          enabled: false // Disable tooltips
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
    }
  });
});


// Initialize Feather icons
feather.replace();

// Get all the buttons
const sortButtons = document.querySelectorAll('.sort-icon-btn');

sortButtons.forEach(button => {
    button.addEventListener('click', function() {
        // Get the column type from data attribute
        const column = button.getAttribute('data-column');
        const sortIcon = button.querySelector('.sort-icon');
        
        // Toggle the sorting state for this column
        sortingStates[column] = !sortingStates[column];

        // Update the icon based on the sorting state
        const iconType = sortingStates[column] ? 'arrow-up' : 'arrow-down';
        sortIcon.setAttribute('data-feather', iconType);

        // Re-render the Feather icons to update the display
        feather.replace();

        // Sorting logic placeholder (replace with actual sorting logic)
        console.log(`Sorting ${column} in ${sortingStates[column] ? 'ascending' : 'descending'} order...`);
    });
});

$(document).ready(function () {
  let currentPage = 1;
  const recordsPerPage = 5;
  let departmentSortOrder = 'ASC'; // Default sort order

  // Initialize Feather Icons
  feather.replace();

  // Function to fetch project data with pagination and sorting
  function fetchProjects(page = 1, sortOrder = 'ASC') {
      $.ajax({
          url: 'includes/fetch-reports-data.php',
          type: 'GET',
          data: {
              page: page,
              sort_order: sortOrder,
          },
          dataType: 'json',
          success: function (data) {
              let tableBody = $('#project-data');
              tableBody.empty();

              if (data.projects && data.projects.length > 0) {
                  // Loop through the data and add rows to the table
                  $.each(data.projects, function (index, project) {
                      let row = '<tr>';
                      row += '<td class="text-center" title="' + project.project_title + '">' + project.project_title + '</td>';
                      row += '<td class="text-end" title="' + project.department_name + '">' + project.department_name + '</td>';                      
                      row += '<td class="text-center">' + project.sector + '</td>';
                      row += '<td>' + project.total_cost + '</td>';
                      row += '<td>' + formatDate(project.start_date) + '</td>';
                      row += '<td>' + formatDate(project.end_date) + '</td>';
                      row += '<td class="text-center">' + project.completed_tasks + '</td>';
                      row += '<td class="text-center">' + project.in_progress_tasks + '</td>';
                      row += '</tr>';
                      tableBody.append(row);
                  });

                  // Update pagination
                  generatePagination(data.totalPages, page);
              } else {
                  tableBody.html(`
                      <tr>
                          <td colspan="8" class="text-center no-data-placeholder">
                              <img src="images/illustration/no-data.png" class="no-data" alt="no-data">
                              <p style="font-weight: 500;">There are no project data available.</p>
                          </td>
                      </tr>
                  `);
              }
          },
          error: function () {
              $('#project-data').html(
                  '<tr><td colspan="8" class="text-center">Error fetching data</td></tr>'
              );
          },
      });
  }

  // Sorting by department
  $('#department-header').click(function () {
      departmentSortOrder = departmentSortOrder === 'ASC' ? 'DESC' : 'ASC';
      const sortIcon = $('#department-sort-icon');
      sortIcon.attr('data-feather', departmentSortOrder === 'ASC' ? 'chevron-up' : 'chevron-down');
      feather.replace();
      fetchProjects(currentPage, departmentSortOrder);
  });

  // Date formatting
  function formatDate(date) {
      const options = { year: 'numeric', month: 'long', day: 'numeric' };
      return new Date(date).toLocaleDateString('en-US', options);
  }

  // Pagination buttons
  function generatePagination(totalPages, currentPage) {
      let paginationHTML = '';
      for (let i = 1; i <= totalPages; i++) {
          paginationHTML += `<button class="page-btn" data-page="${i}" ${i === currentPage ? 'disabled' : ''}>${i}</button>`;
      }
      $('#pagination').html(paginationHTML);

      $('.page-btn').click(function () {
          const page = $(this).data('page');
          fetchProjects(page, departmentSortOrder);
      });
  }

  // Fetch projects on page load
  fetchProjects(currentPage);
});

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