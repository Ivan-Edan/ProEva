document.addEventListener('DOMContentLoaded', function() {
    const sidebarButton = document.querySelector('.sidebar-user .hamburger-button');
    const headerButton = document.querySelector('header .hamburger-button');
    const sidebar = document.querySelector('.sidebar-user');
    const header = document.querySelector('header');
    const mainContent = document.querySelector('.main-content');

    function toggleSidebar() {
        sidebar.classList.toggle('hidden');
        if (sidebar.classList.contains('hidden')) {
            mainContent.style.marginLeft = '0';
            mainContent.style.width = '100%'; // Make main content take full width
            header.style.left = '0';
            header.style.width = '100%'; // Make header take full width
            headerButton.style.display = 'block'; // Show hamburger button in header
        } else {
            mainContent.style.marginLeft = '345px';
            mainContent.style.width = 'calc(100% - 345px)'; // Adjust main content width
            header.style.left = '345px';
            header.style.width = 'calc(100% - 345px)'; // Adjust header width
            headerButton.style.display = 'none'; // Hide hamburger button in header
        }

        // Add a slight delay to ensure the CSS changes are applied before resizing the chart
        setTimeout(function() {
            projectChart.resize(); // Resizes the chart after sidebar toggle
        }, 10); // Adjust the timeout duration if needed
    }

    // Add event listener for the button in the sidebar
    sidebarButton.addEventListener('click', toggleSidebar);

    // Add event listener for the button in the header
    headerButton.addEventListener('click', toggleSidebar);
});
