document.addEventListener('DOMContentLoaded', function() {
    feather.replace(); // Initializes Feather icons

    const addAccountForm = document.getElementById('addAccountForm');
    const searchBar = document.getElementById('searchBar');
    const searchIcon = document.getElementById('searchIcon');

    // Add Account form submit handling
    addAccountForm.addEventListener('submit', function(e) {
        e.preventDefault();

        // Reset form fields after submission
        addAccountForm.reset();
    });

    // Hide search icon when the user types in the search bar
    searchBar.addEventListener('input', function() {
        if (this.value.length > 0) {
            searchIcon.style.display = 'none';
        } else {
            searchIcon.style.display = 'block';
        }
    });
});
document.getElementById('addAccountForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent the default form submission

    // Gather form data
    const formData = new FormData(this);

    // Make AJAX request
    fetch('includes/add-account.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        // Handle the response data
        if (data.status === 'success') {
            // Optionally refresh the table or add the new account to the table dynamically
            // refreshAccountTable();

            // Close the "Add Account" modal
            const addAccountModal = bootstrap.Modal.getInstance(document.getElementById('addAccountModal'));
            addAccountModal.hide();

            // Show the success modal
            const successModal = new bootstrap.Modal(document.getElementById('successModal'));
            successModal.show();

            // Reload the page when the success modal is dismissed
            const successModalElement = document.getElementById('successModal');
            successModalElement.addEventListener('hidden.bs.modal', function() {
                location.reload(); // Reload the page after modal is dismissed
            });
        } else {
            // Handle errors (e.g., show error messages in the modal)
            alert('Error: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while adding the account.');
    });
});

 // Handle account deletion
document.getElementById('deleteAccountBtn').addEventListener('click', function() {
    const userId = document.getElementById('userId').value; // Get user ID from the form
    const deleteAccountModal = new bootstrap.Modal(document.getElementById('deleteAccountModal'));

    const editAccountModal = bootstrap.Modal.getInstance(document.getElementById('editAccountModal'));
    editAccountModal.hide();
        
    // Show the delete confirmation modal
    deleteAccountModal.show();

    // Handle the Cancel button click in the delete modal
    const cancelBtn = document.querySelector('#deleteAccountModal .btn-secondary'); // Select cancel button in delete modal
    
    // Remove any existing listeners before adding a new one
    cancelBtn.removeEventListener('click', showEditAccountModal); // Ensure no duplicate listeners
    cancelBtn.addEventListener('click', showEditAccountModal);

    function showEditAccountModal() {
        // When the cancel button is clicked, show the edit account modal again
        editAccountModal.show();
    }

    // Remove any existing event listener for the confirm button to avoid duplicates
    const confirmDeleteBtn = document.getElementById('confirmDeleteAccountBtn');
    confirmDeleteBtn.removeEventListener('click', confirmDeleteAccount); // Remove existing listener
    confirmDeleteBtn.addEventListener('click', confirmDeleteAccount); // Add the new listener

    // Function to handle the delete confirmation
    function confirmDeleteAccount() {
        // Send the delete request
        fetch(`includes/delete-account.php?id=${userId}`, {
            method: 'DELETE',
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                
                // Close the delete modal
                deleteAccountModal.hide();

                // Show the success modal
                const successDeleteModal = new bootstrap.Modal(document.getElementById('successDeleteModal'));
                successDeleteModal.show();

                // Reload the page when the success modal is dismissed
                successDeleteModal._element.addEventListener('hidden.bs.modal', function() {
                    location.reload(); // Reload the page
                });
            } else {
                alert('Error deleting account: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while deleting the account.');
        });
    }
});


document.addEventListener('DOMContentLoaded', function () {
    let currentPage = 1; // Current page number
    const rowsPerPage = 5; // Number of rows per page
    let totalRows = 0; // Total number of rows in the table

    const tableBody = document.getElementById('account-table-body');
    const paginationControls = document.getElementById('pagination-controls');

    // Function to fetch and display accounts with pagination
    function fetchAccounts(page = 1) {
        fetch(`includes/fetch-accounts.php?page=${page}&limit=${rowsPerPage}`)
            .then(response => response.text())
            .then(data => {
                const responseData = JSON.parse(data);
                totalRows = responseData.totalRows;
                tableBody.innerHTML = responseData.html;
                updatePaginationControls();
            })
            .catch(error => {
                console.error('Error fetching accounts:', error);
                tableBody.innerHTML = '<tr><td colspan="7" class="text-center">Error loading accounts.</td></tr>';
            });
    }

    // Function to create pagination controls
    function updatePaginationControls() {
        const totalPages = Math.ceil(totalRows / rowsPerPage);
        paginationControls.innerHTML = ''; // Clear existing buttons

        for (let i = 1; i <= totalPages; i++) {
            const button = document.createElement('button');
            button.className = 'btn btn-secondary mx-1';
            button.textContent = i;
            if (i === currentPage) {
                button.classList.add('active');
            }

            button.addEventListener('click', function () {
                currentPage = i;
                fetchAccounts(currentPage);
            });

            paginationControls.appendChild(button);
        }
    }

    // Fetch accounts for the initial page
    fetchAccounts(currentPage);
});


// Event listener for opening the edit modal
document.getElementById('account-table-body').addEventListener('click', function(event) {
    if (event.target && event.target.matches('a[data-bs-toggle="modal"]')) {
        const button = event.target;
        const id = button.getAttribute('data-id');
        const firstName = button.getAttribute('data-firstname');
        const middleName = button.getAttribute('data-middlename');
        const lastName = button.getAttribute('data-lastname');
        const suffix = button.getAttribute('data-suffix');
        const email = button.getAttribute('data-email');

        // Populate the modal fields
        document.getElementById('userId').value = id;
        document.getElementById('editFirstName').value = firstName;
        document.getElementById('editMiddleName').value = middleName;
        document.getElementById('editLastName').value = lastName;
        document.getElementById('editSuffix').value = suffix;
        document.getElementById('editEmail').value = email;

    }
});

// Edit account form submission
document.getElementById('editAccountForm').addEventListener('submit', function(event) {
    event.preventDefault();
    const userId = document.getElementById('userId').value;

    const updatedData = {
        firstName: document.getElementById('editFirstName').value,
        middleName: document.getElementById('editMiddleName').value,
        lastName: document.getElementById('editLastName').value,
        suffix: document.getElementById('editSuffix').value,
        email: document.getElementById('editEmail').value,
    };

    fetch(`includes/update-account.php?id=${userId}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(updatedData),
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {

            const editAccountModal = bootstrap.Modal.getInstance(document.getElementById('editAccountModal'));
            editAccountModal.hide();

            // Show success modal instead of alert
            const successModal = new bootstrap.Modal(document.getElementById('successEditModal'));
            successModal.show();

            // Optionally, reload after modal is dismissed
            successModal._element.addEventListener('hidden.bs.modal', function() {
                location.reload();
            });
        } else {
            alert('Error updating account: ' + data.message);
        }
    })
    .catch(error => console.error('Error:', error));
});

    // Department Sort Function
    document.getElementById("sort-icon").addEventListener("click", function() {
        sortTableAlphabetically();
        toggleSortIcon();
    });

    let ascending = true;

    function sortTableAlphabetically() {
        const tableBody = document.getElementById("account-table-body");
        const rows = Array.from(tableBody.rows);

        rows.sort((a, b) => {
            const deptA = a.cells[3].textContent.trim();
            const deptB = b.cells[3].textContent.trim();
            return ascending ? deptA.localeCompare(deptB) : deptB.localeCompare(deptA);
        });

        rows.forEach(row => tableBody.appendChild(row));
        ascending = !ascending;
    }

    function toggleSortIcon() {
        const icon = document.getElementById("sort-icon");
        icon.classList.toggle("fa-sort-up", ascending);
        icon.classList.toggle("fa-sort-down", !ascending);
    }

  // Search Function
        document.getElementById("searchBar").addEventListener("input", function() {
            const query = this.value.toLowerCase();
            filterTable(query);
        });

        function filterTable(query) {
            const tableBody = document.getElementById("account-table-body");
            const rows = tableBody.getElementsByTagName("tr");

            let matchFound = false;

            for (let row of rows) {
                const firstName = row.cells[1]?.textContent.toLowerCase();
                const lastName = row.cells[0]?.textContent.toLowerCase();

                // Check if either first name or last name includes the query
                if (firstName.includes(query) || lastName.includes(query)) {
                    row.style.display = ""; // Show matching row
                    matchFound = true;
                } else {
                    row.style.display = "none"; // Hide non-matching row
                }
            }

            // Display "No Results" message if no matches are found in both first and last names
            if (!matchFound) {
                displayNoResultsMessage(tableBody);
            } else {
                // Remove "No results" row if matches are found
                const noResultsRow = document.getElementById("no-results-row");
                if (noResultsRow) noResultsRow.remove();
            }
        }

        function displayNoResultsMessage(tableBody) {
            // Remove any existing "No results" message row
            const existingNoResultsRow = document.getElementById("no-results-row");
            if (existingNoResultsRow) existingNoResultsRow.remove();

            // Create a new row for the "No results" message
            const noResultsRow = document.createElement("tr");
            noResultsRow.id = "no-results-row";

            // Create a cell to span all columns
            const noResultsCell = document.createElement("td");
            noResultsCell.colSpan = 7; // Adjust based on the total number of columns
            noResultsCell.classList.add("text-center");

            // Add image and message content
            noResultsCell.innerHTML = `
                <img src="images/illustration/successful.png" class="icon-modal-success" alt="Success Icon">
                <h5 class="text-modal">There is no name existed</h5>
            `;

            noResultsRow.appendChild(noResultsCell);
            tableBody.appendChild(noResultsRow);
        }
        
        // Search Function
        document.getElementById("searchBar").addEventListener("input", function() {
            const query = this.value.toLowerCase();
            filterTable(query);
        });

        function filterTable(query) {
            const tableBody = document.getElementById("account-table-body");
            const rows = tableBody.getElementsByTagName("tr");

            let matchFound = false;

            // Remove the "No Results" message row if it exists
            const existingNoResultsRow = document.getElementById("no-results-row");
            if (existingNoResultsRow) existingNoResultsRow.remove();

            for (let row of rows) {
                const firstName = row.cells[1]?.textContent.toLowerCase();
                const lastName = row.cells[0]?.textContent.toLowerCase();

                // Check if either first name or last name includes the query
                if (firstName.includes(query) || lastName.includes(query)) {
                    row.style.display = ""; // Show matching row
                    matchFound = true;
                } else {
                    row.style.display = "none"; // Hide non-matching row
                }
            }

            // Display "No Results" message if no matches are found in both first and last names
            if (!matchFound) {
                displayNoResultsMessage(tableBody);
            }
        }

        function displayNoResultsMessage(tableBody) {
            // Create a new row for the "No results" message
            const noResultsRow = document.createElement("tr");
            noResultsRow.id = "no-results-row";

            // Create a cell to span all columns
            const noResultsCell = document.createElement("td");
            noResultsCell.colSpan = 7; // Adjust based on the total number of columns
            noResultsCell.classList.add("text-center");

            // Add image and message content
            noResultsCell.innerHTML = `
                <img src="images/illustration/successful.png" class="icon-modal-success" alt="Success Icon">
                <h5 class="text-modal">There is no name existed</h5>
            `;

            noResultsRow.appendChild(noResultsCell);
            tableBody.appendChild(noResultsRow);
        }

    