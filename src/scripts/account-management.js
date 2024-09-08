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
