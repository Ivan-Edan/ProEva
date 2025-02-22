// Function to fetch slippage data based on selected department
function fetchSlippageData(departmentId) {
    fetch(`includes/fetch_slippage_data.php?department_id=${departmentId}`)
        .then(response => response.json())
        .then(data => {
            if (data.labels && data.labels.length > 0) {
                updateChart(data);
                document.getElementById('projectChart').style.display = 'block';
                document.getElementById('noSlippageData').style.display = 'none';
            } else {
                document.getElementById('projectChart').style.display = 'none';
                document.getElementById('noSlippageData').style.display = 'block';
            }
        })
        .catch(error => console.error('Error fetching slippage data:', error));
}

// Function to update the chart
function updateChart(data) {
    const ctx = document.getElementById('projectChart').getContext('2d');

    // Simplify project names to only show the first two words
    const simplifiedLabels = data.labels.map(label => {
        const words = label.split(' ');
        return words.slice(0, 3).join(' ');
    });

    const chartData = {
        labels: simplifiedLabels, // Use simplified labels
        datasets: [
            {
                label: 'Positive Slippage',
                data: data.positiveSlippage,
                backgroundColor: '#27374D',
                borderColor: '#27374D',
                borderWidth: 1
            },
            {
                label: 'Negative Slippage',
                data: data.negativeSlippage,
                backgroundColor: '#FF0000',
                borderColor: '#FF0000',
                borderWidth: 1
            }
        ]
    };

    // Destroy the old chart instance if it exists
    if (window.barChart) {
        window.barChart.destroy();
    }

    // Create a new chart
    window.barChart = new Chart(ctx, {
        type: 'bar',
        data: chartData,
        options: {
            scales: {
                x: {
                    stacked: true,
                    barPercentage: 0.5,
                    categoryPercentage: 0.8,
                    grid: { display: false }
                },
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function (value) {
                            return Math.abs(value);
                        }
                    },
                    grid: {
                        borderDash: [6, 6],
                        color: '#e0e0e0',
                        lineWidth: 1
                    }
                }
            },
            plugins: {
                legend: {
                    display: true,
                    position: 'bottom',
                    align: 'start',
                    labels: {
                        boxWidth: 20,
                        boxHeight: 20,
                        padding: 20,
                        usePointStyle: true,
                        pointStyle: 'circle',
                    }
                },
                title: {
                    display: true,
                    text: 'Per Department Project Slippage Summary',
                    align: 'center',
                    position: 'bottom',
                    padding: { top: 10 },
                    font: { size: 16, weight: 'bold' }
                }
            },
            responsive: true,
            maintainAspectRatio: false
        }
    });
}


// Fetch departments and populate dropdown
fetch('includes/fetch_departments.php')
    .then(response => response.json())
    .then(data => {
        const departmentList = document.getElementById('departmentList');
        const searchField = document.getElementById('searchField');

        // Function to render the department items
        function renderDepartments(departments) {
            const listItems = departmentList.querySelectorAll('li:not(:first-child)');
            listItems.forEach(item => item.remove());

            if (departments.length > 0) {
                departments.forEach(department => {
                    const li = document.createElement('li');
                    const a = document.createElement('a');
                    a.classList.add('dropdown-item');
                    a.href = '#';
                    a.textContent = department.name;
                    a.setAttribute('data-department-id', department.id);
                    li.appendChild(a);
                    departmentList.appendChild(li);
                });
            } else {
                const li = document.createElement('li');
                li.textContent = 'No departments found.';
                departmentList.appendChild(li);
            }
        }

        // Function to filter the departments based on the search query
        function filterDepartments(query) {
            const filteredDepartments = data.filter(department =>
                department.name.toLowerCase().includes(query.toLowerCase())
            );
            renderDepartments(filteredDepartments);
        }

        // Initial render of all departments
        renderDepartments(data);

        // Search Function: Listen for input and filter departments
        searchField.addEventListener('input', function () {
            const query = this.value;
            filterDepartments(query);
        });

        // Department selection listener
        departmentList.addEventListener('click', function (e) {
            if (e.target && e.target.matches('a.dropdown-item')) {
                const departmentId = e.target.getAttribute('data-department-id');
                fetchSlippageData(departmentId);
            }
        });

        // Default: Automatically fetch slippage data for the first department (index 1)
        if (data.length > 1) {
            const defaultDepartmentId = data[1].id; // Assuming index 1 exists
            fetchSlippageData(defaultDepartmentId); // Fetch data for the default department
        }
    })
    .catch(error => console.error('Error fetching departments:', error));

// Function to update Philippine time, day, and date
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

    const currentTime = new Intl.DateTimeFormat('en-US', timeOptions).format(new Date());
    const currentDay = new Intl.DateTimeFormat('en-US', dayOptions).format(new Date());
    const currentDate = new Intl.DateTimeFormat('en-US', dateOptions).format(new Date());

    document.getElementById('philippine-time').textContent = currentTime;
    document.getElementById('philippine-day').textContent = currentDay;
    document.getElementById('philippine-date').textContent = currentDate;
}

// Initial call to display time, day, and date
updatePhilippineTimeDateAndDay();
// Update every second
setInterval(updatePhilippineTimeDateAndDay, 1000);
document.addEventListener("DOMContentLoaded", function () {
    function checkTableData() {
        const tableBody = document.getElementById("table-body");

        // Remove existing placeholder if present
        const existingPlaceholder = document.querySelector(".no-data-placeholder");
        if (existingPlaceholder) {
            existingPlaceholder.remove();
        }

        // If no rows exist, add the placeholder inside tbody
        if (tableBody.children.length === 0) {
            const placeholderRow = document.createElement("tr");
            placeholderRow.innerHTML = `
                <td colspan="5" class="text-center">
                    <div class="no-data-placeholder">
                        <img src="images/illustration/no-data.png" class="no-data" alt="no-data">
                        <p style="font-weight: 500;">There are no data available to compute.</p>
                    </div>
                </td>
            `;
            tableBody.appendChild(placeholderRow);
        }
    }

    // Run on initial load
    checkTableData();

    // Observe table changes
    const observer = new MutationObserver(checkTableData);
    observer.observe(document.getElementById("table-body"), { childList: true });
});
