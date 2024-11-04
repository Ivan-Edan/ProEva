// Pagination settings
let currentPage = 1;
const rowsPerPage = 5;

function displayTablePage(page) {
    const table = document.getElementById('table-body');
    const rows = Array.from(table.getElementsByTagName('tr'));
    const totalRows = rows.length;
    const start = (page - 1) * rowsPerPage;
    const end = start + rowsPerPage;

    // Hide all rows and then show the ones for the current page
    rows.forEach((row, index) => {
        row.style.display = index >= start && index < end ? '' : 'none';
    });

    // Update current page
    currentPage = page;
}

function generatePagination(totalRows) {
    const paginationContainer = document.getElementById('pagination-container');
    paginationContainer.innerHTML = ''; // Clear existing pagination buttons

    const totalPages = Math.ceil(totalRows / rowsPerPage);

    // Generate page numbers dynamically
    for (let i = 1; i <= totalPages; i++) {
        const pageItem = document.createElement('li');
        pageItem.classList.add('page-item');
        if (i === currentPage) pageItem.classList.add('active'); // Highlight current page

        const pageLink = document.createElement('a');
        pageLink.classList.add('page-link');
        pageLink.href = '#';
        pageLink.textContent = i;
        pageLink.onclick = (function(page) {
            return function() {
                displayTablePage(page);
                updatePagination(totalPages);
            };
        })(i);

        pageItem.appendChild(pageLink);
        paginationContainer.appendChild(pageItem);
    }
}

function updatePagination(totalPages) {
    const paginationItems = document.querySelectorAll('.pagination .page-item');
    paginationItems.forEach((item, index) => {
        item.classList.toggle('active', index === currentPage - 1);
    });
}

// Initialize pagination on page load
document.addEventListener("DOMContentLoaded", function() {
    const totalRows = document.getElementById('table-body').getElementsByTagName('tr').length;
    generatePagination(totalRows);
    displayTablePage(currentPage);
});
