const ctx = document.getElementById('projectChart').getContext('2d');

const projectChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
        datasets: [
            {
                label: 'Project 1',
                data: [10, 20, 30, 40, 50, 60, 70, 80, 90, 100],
                borderColor: '#9DB2BF',
                backgroundColor: '#9DB2BF',
                fill: false,
                tension: 0.4
            },
            {
                label: 'Project 2',
                data: [15, 20, 35, 45, 60, 75, 90, 100],
                borderColor: '#27374D',
                backgroundColor: '#27374D',
                fill: false,
                tension: 0.4
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
                    boxWidth: 20, // Set the width of the legend box
                    boxHeight: 20, // Set the height of the legend box
                    padding: 10, // Adjust the padding around the legend items
                    usePointStyle: true, // Use point styles (circles) instead of boxes
                    pointStyle: 'circle' // Set the point style to circle
                }
            },
            // Custom title plugin
            tooltip: {
                enabled: false
            }
        },
        layout: {
            padding: {
                bottom: 60 // Add space at the bottom to accommodate both legend and custom title
            }
        }
    },
    plugins: [{
        id: 'bottomTitle',
        beforeDraw: function(chart, args, options) {
            const ctx = chart.ctx;
            const chartWidth = chart.width;
            const chartHeight = chart.height;
            
            ctx.save();
            ctx.font = 'bold 16px Montserrat';
            ctx.textAlign = 'center';
            ctx.textBaseline = 'middle';
            ctx.fillStyle = '#333';

            // Add title at the bottom center
            const title = 'Departments Progress Summary';
            const x = chartWidth / 2;
            const y = chartHeight - 20; // Position just above the bottom padding
            ctx.fillText(title, x, y);

            ctx.restore();
        }
    }]
});
