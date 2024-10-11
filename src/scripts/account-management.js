document.addEventListener('DOMContentLoaded', function() {
    feather.replace(); // Initializes Feather icons

    const addAccountForm = document.getElementById('addAccountForm');
    const searchBar = document.getElementById('searchBar');
    const searchIcon = document.getElementById('searchIcon');

    // Add Account form submit handling
    addAccountForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Add account form logic (AJAX request, validation, etc.)
        const addAccountModal = new bootstrap.Modal(document.getElementById('addAccountModal'));
        addAccountModal.hide();

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

    // Show the delete confirmation modal
    deleteAccountModal.show();

    // Set up listener for confirmation
    document.getElementById('confirmDeleteAccountBtn').addEventListener('click', function() {
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
    });
});

// Fetch existing accounts on page load
fetch('includes/fetch-accounts.php')
    .then(response => response.text())
    .then(data => {
        document.getElementById('account-table-body').innerHTML = data;
    })
    .catch(error => {
        console.error('Error fetching accounts:', error);
        document.getElementById('account-table-body').innerHTML = '<tr><td colspan="7" class="text-center">Error loading accounts.</td></tr>';
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

        // Show the modal
        const editAccountModal = new bootstrap.Modal(document.getElementById('editAccountModal'));
        editAccountModal.show();
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
