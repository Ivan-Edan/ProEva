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
            barPercentage: 0.2, // Adjusted bar width to be thinner
            borderRadius: 5 // Adjust the border radius here
          },
          {
            label: 'Initial Budget',
            data: [15, 25, 10, 20, 35, 50, 45],
            backgroundColor: '#27374D',
            borderColor: '#27374D',
            borderWidth: 1,
            barPercentage: 0.2, // Adjusted bar width to be thinner
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
            categoryPercentage: 0.6 // Adjust space between groups
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
