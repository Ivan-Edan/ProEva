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
                      row += '<td class="text-center">' + project.project_title + '</td>';
                      row += '<td class="text-end">' + project.department_name + '</td>';
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
