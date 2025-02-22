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
    fetch(`includes/fetch-projects.php?page=${page}&status=${status}`)
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                alert(data.error);
                return;
            }

            const tableBody = document.querySelector('#table-body');
            tableBody.innerHTML = ''; // Clear existing rows

            // Add projects to the table
            data.projects.forEach(project => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${project.main_project_name}</td>
                    <td class="text-center">${project.task_status}</td>
                    <td class="text-center">${project.startDate}</td>
                    <td class="text-center">${project.endDate}</td>
                    <td class="text-center">${project.created_at}</td>
                `;
                tableBody.appendChild(row);
            });

            // Update pagination controls
            updatePaginationControls(data.totalPages);
        })
        .catch(error => console.error('Error:', error));
}

// Function to update pagination controls
function updatePaginationControls(totalPages) {
    const paginationControls = document.querySelector('#pagination-controls');
    paginationControls.innerHTML = ''; // Clear existing controls

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
            fetchProjects(currentStatus, currentPage); // Fetch projects for the selected page
        });

        paginationControls.appendChild(pageLink);
    }
}

// Event listener for the dropdown selection
document.querySelectorAll('.dropdown-item').forEach(item => {
    item.addEventListener('click', function () {
        const selectedStatus = this.textContent.trim();
        currentStatus = selectedStatus === 'All' ? '' : selectedStatus; // Reset status to empty for all projects
        currentPage = 1; // Reset to first page when status changes
        fetchProjects(currentStatus, currentPage); // Fetch and update the table with the selected status and current page
    });
});

// Initial fetch with no status selected (loads all projects)
fetchProjects(currentStatus, currentPage);

document.addEventListener('DOMContentLoaded', function() {

    // Convert markdown to HTML using marked.js
    const htmlContent = marked(issueDetails);

    // Insert the converted HTML into the <p class="text-detail-2">
    document.querySelector('.text-detail-2').innerHTML = htmlContent;
});


document.addEventListener('DOMContentLoaded', function () {
    fetch('includes/get-user-form-stats.php') // Replace with your PHP endpoint
        .then(response => response.json())
        .then(data => {
            // Update the numbers dynamically
            document.querySelector('.stat-number.accepted').textContent = data.accepted || 0;
            document.querySelector('.stat-number.rejected').textContent = data.rejected || 0;
            document.querySelector('.stat-number.pending').textContent = data.pending || 0;
        })
        .catch(error => console.error('Error fetching project stats:', error));
});

// No data
function checkIfNoProjects() {
    const projectDropdown = document.getElementById("mainprojectDropdown");
    const noProjectMessage = document.getElementById("no-project-message");
    const projectDetails = document.getElementById("project-details");

    // Check if there are any options beyond "Select Project"
    if (projectDropdown.options.length <= 1) {
        noProjectMessage.style.display = "block"; // Show "no data" message
        projectDetails.style.display = "none"; // Hide project details
    } else {
        noProjectMessage.style.display = "none"; // Hide "no data" message
    }
}

function handleProjectSelection() {
    const projectDropdown = document.getElementById("mainprojectDropdown");
    const noProjectMessage = document.getElementById("no-project-message");
    const projectDetails = document.getElementById("project-details");

    if (projectDropdown.value === "") {
        projectDetails.style.display = "none"; // Hide project details
        noProjectMessage.style.display = "block"; // Show "no data" message
    } else {
        projectDetails.style.display = "block"; // Show project details
        noProjectMessage.style.display = "none"; // Hide "no data" message
    }
}

// Run check on page load
document.addEventListener("DOMContentLoaded", checkIfNoProjects);

// Add event listener for dropdown changes
document.getElementById("mainprojectDropdown").addEventListener("change", handleProjectSelection);


function checkIfNoData() {
    const tableBody = document.getElementById("table-body");
    const noDataMessage = document.getElementById("no-data-message");

    if (tableBody.children.length === 0) {
        noDataMessage.style.display = "block"; // Show "No Data" message
    } else {
        noDataMessage.style.display = "none"; // Hide "No Data" message
    }
}

// Run function on page load
document.addEventListener("DOMContentLoaded", checkIfNoData);

// Observe changes in the table body to automatically check if data exists
const observer = new MutationObserver(checkIfNoData);
observer.observe(document.getElementById("table-body"), { childList: true });