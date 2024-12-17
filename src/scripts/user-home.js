function updatePhilippineTimeDateAndDay() {
    const timeOptions = {
        timeZone: 'Asia/Manila',
        hour: 'numeric',
        minute: 'numeric',
        second: 'numeric',
        hour12: true
    };
    
    const dayOptions = {
        timeZone: 'Asia/Manila',
        weekday: 'long'
    };

    const dateOptions = {
        timeZone: 'Asia/Manila',
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    };

    // Get current time, day, and date in Philippine timezone
    const currentTime = new Intl.DateTimeFormat('en-US', timeOptions).format(new Date());
    const currentDay = new Intl.DateTimeFormat('en-US', dayOptions).format(new Date());
    const currentDate = new Intl.DateTimeFormat('en-US', dateOptions).format(new Date());

    // Update time, day, and date elements
    document.getElementById('philippine-time').textContent = currentTime;
    document.getElementById('philippine-day').textContent = currentDay;
    document.getElementById('philippine-date').textContent = currentDate;
}

// Initial call to display the time, day, and date immediately
updatePhilippineTimeDateAndDay();
// Update the time, day, and date every second
setInterval(updatePhilippineTimeDateAndDay, 1000);

// Function to fetch task counts and update the dashboard
function fetchTaskCounts() {
    fetch('includes/fetch-user-task-counts.php') // Assuming this file returns the task counts data
      .then(response => response.json())
      .then(data => {
        // Check if the data contains task counts
        if (data.error) {
          alert(data.error);
          return;
        }
  
        // Initialize counters for each status
        let totalDone = 0;
        let totalInProgress = 0;
        let totalIncoming = 0;

        // Iterate through the task_counts array and sum up the values
        data.task_counts.forEach(task => {
          totalDone += task.done_tasks;
          totalInProgress += task.in_progress_tasks;
          totalIncoming += task.incoming_tasks;
        });

        // Update the task counts on the dashboard
        document.querySelector('.stat-number.done').textContent = totalDone;
        document.querySelector('.stat-number.incoming').textContent = totalIncoming;
        document.querySelector('.stat-number.in_progress').textContent = totalInProgress;
      })
      .catch(error => console.error('Error:', error));
}

// Call the fetchTaskCounts function to update the dashboard when the page loads
fetchTaskCounts();


let currentPage = 1; // Default to page 1
let currentStatus = ''; // Initially show all projects

// Function to fetch projects based on status and page
function fetchProjects(status = '', page = 1) {
    const url = `includes/fetch-projects.php?status=${encodeURIComponent(status)}&page=${page}`;

    fetch(url)
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                alert(data.error);
                return;
            }

            // Get the table body
            const tableBody = document.querySelector('#table-body');
            tableBody.innerHTML = '';  // Clear existing rows

            if (data.projects.length === 0) {
                // No data found, display the no-data placeholder
                const noDataRow = document.createElement('tr');
                noDataRow.innerHTML = `
                    <td colspan="6" class="text-center no-data-placeholder">
                        <img src="images/illustration/no-data.png" class="no-data" alt="no-data">
                        <p style="font-weight: 500;">There are no project data available to display.</p>
                    </td>
                `;
                tableBody.appendChild(noDataRow);
            } else {
                // Populate the table with project data
                data.projects.forEach(project => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td class="text-center">${project.main_project_name}</td>
                        <td class="text-center">${project.project_title}</td> 
                        <td class="text-center">${project.task_status}</td>
                        <td class="text-center">${project.start_date}</td>
                        <td class="text-center">${project.end_date}</td>
                        <td class="text-center">${project.created_at}</td>
                    `;
                    tableBody.appendChild(row);
                });
            }

            // Update pagination controls
            updatePaginationControls(data.total_pages);
        })
        .catch(error => console.error('Error:', error));
}

// Function to update pagination controls
function updatePaginationControls(totalPages) {
    const paginationControls = document.querySelector('#pagination-controls');
    paginationControls.innerHTML = '';  // Clear existing controls

    for (let i = 1; i <= totalPages; i++) {
        const pageLink = document.createElement('button');
        pageLink.classList.add('page-link');
        pageLink.textContent = i;

        // Add active class to the current page
        if (i === currentPage) {
            pageLink.classList.add('active');
        }

        pageLink.addEventListener('click', () => {
            currentPage = i;
            fetchProjects(currentStatus, currentPage);  // Fetch projects for the selected page
        });

        paginationControls.appendChild(pageLink);
    }
}

// Event listener for the dropdown selection
document.querySelectorAll('.dropdown-item').forEach(item => {
    item.addEventListener('click', function() {
        const selectedStatus = this.textContent.trim();
        currentStatus = selectedStatus === 'All' ? '' : selectedStatus;  // Reset status to empty for all projects
        fetchProjects(currentStatus, currentPage); // Fetch and update the table with the selected status and current page
    });
});

// Initial fetch with no status selected (loads all projects)
fetchProjects(currentStatus, currentPage);


  