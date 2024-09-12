const ctx = document.getElementById('projectChart').getContext('2d');
const projectChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        datasets: [{
            label: 'Positive Slippage',
            data: [20, null, null, 30, null, null, 25, null, null, 50, null, null],
            backgroundColor: '#27374D',
            borderColor: '#27374D',
            borderWidth: 1
        }, {
            label: 'Negative Slippage',
            data: [null, -15, -20, null, -10, -15, null, -15, -50, null, -10, -5],
            backgroundColor: '#FF0000',
            borderColor: '#FF0000',
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            x: {
                stacked: true, // Ensure that bars do not overlap
                barPercentage: 0.5, // Adjust width of the bars
                categoryPercentage: 0.8, // Increase spacing between bars
                grid: {
                    display: false // Remove vertical grid lines
                }
            },
            y: {
                beginAtZero: true,
                ticks: {
                    callback: function(value) {
                        return Math.abs(value); // Display positive values for both positive and negative slippage
                    }
                },
                grid: {
                    borderDash: [6, 6], // Optional: change y-axis grid line style (dashed)
                    color: '#e0e0e0', // Optional: change y-axis grid line color
                    lineWidth: 1 // Optional: change y-axis grid line width
                }
            }
        },
        plugins: {
            legend: {
                display: true,
                position: 'bottom',
                align: 'start',
                labels: {
                    boxWidth: 20,  // Adjust size of the legend box
                    boxHeight: 20,  // Adjust size of the legend box
                    padding: 20,
                    usePointStyle: true,  // Use circular points
                    pointStyle: 'circle',
                }
            },
            title: {
                display: true,
                text: 'Per Department Slippage Summary',
                align: 'center',
                position: 'bottom',
                padding: {
                    top: 10
                },
                font: {
                    size: 16,
                    weight: 'bold'
                }
            }
        },
        responsive: true,
        maintainAspectRatio: false
    }
});
