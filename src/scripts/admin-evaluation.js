document.addEventListener('DOMContentLoaded', function () {
    const formListItems = document.querySelectorAll('#form-list .list-group-item');
    const formContent = document.getElementById('form-content');
    const formsList = document.getElementById('forms-list');

    // Event listener for form selection
    formListItems.forEach(item => {
        item.addEventListener('click', function () {
            const formFile = this.getAttribute('data-form');
            const formType = this.getAttribute('data-form-type'); // Form type attribute
            console.log('Form Type:', formType);

            // Load the form content dynamically
            fetch(formFile)
                .then(response => {
                    if (response.ok) {
                        return response.text();
                    }
                    throw new Error('Network response was not ok.');
                })
                .then(html => {
                    formContent.innerHTML = html;
                    formsList.style.display = 'none';
                    formContent.style.display = 'block';

                    // After form loads, locate the dropdown and populate it
                    initializeFormDropdown(formType);
                })
                .catch(error => {
                    console.error('Error loading form:', error);
                });
        });
    });

    // Initialize the dropdown within the form
    function initializeFormDropdown(formType) {
        const dropdownMenu = document.querySelector('#form-content #formDropdown');
        const dropdownSearch = document.querySelector('#form-content #searchField');
        const dropdownList = document.querySelector('#form-content #dropdownList');

        if (!dropdownMenu || !dropdownSearch || !dropdownList) {
            console.error('Dropdown elements are missing in the loaded form.');
            return;
        }

        // Populate dropdown options
        loadDropdownOptions(formType, dropdownList);

        // Attach search functionality to the dropdown
        if (dropdownSearch) {
            dropdownSearch.addEventListener('input', function () {
                const searchTerm = dropdownSearch.value.toLowerCase();
                const items = dropdownList.querySelectorAll('.dropdown-item');

                items.forEach(item => {
                    const text = item.textContent.toLowerCase();
                    item.style.display = text.includes(searchTerm) ? '' : 'none';
                });
            });
        }
    }

    // Load dropdown options dynamically
    function loadDropdownOptions(formType) {
        console.log('Fetching dropdown options for formType:', formType);
        fetch('includes/get-admin-dropdown-options.php?formType=' + encodeURIComponent(formType))
            .then(response => response.json())
            .then(data => {
                console.log('Dropdown options received:', data);
                dropdownList.innerHTML = ''; // Clear previous options
                data.forEach(option => {
                    const listItem = document.createElement('li');
                    listItem.classList.add('dropdown-item', 'px-3', 'py-2', 'border-bottom');
                    listItem.textContent = option.label;
                    listItem.setAttribute('data-value', option.value);
                    dropdownList.appendChild(listItem);
                });
                attachDropdownListeners(dropdownList);
            })
            .catch(error => {
                console.error('Error fetching dropdown options:', error);
            });
    }
    

    // Attach click event listeners to dropdown items
    function attachDropdownListeners(dropdownList) {
        const items = dropdownList.querySelectorAll('.dropdown-item');
        items.forEach(item => {
            item.addEventListener('click', function () {
                const selectedValue = this.getAttribute('data-value');
                console.log('Selected Value:', selectedValue);
                // Logic to handle the selected dropdown item goes here
            });
        });
    }

    // Cancel button functionality
    document.addEventListener('click', function (event) {
        if (event.target && event.target.id === 'cancelBtn') {
            formContent.style.display = 'none';
            formsList.style.display = 'block';
        }
    });
});
