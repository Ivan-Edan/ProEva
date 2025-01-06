document.addEventListener('DOMContentLoaded', function () {
    const formListItems = document.querySelectorAll('#form-list .list-group-item');
    const formContent = document.getElementById('form-content');
    const formsList = document.getElementById('forms-list');

    const quarterContainer = document.getElementById('quarter-container');
    const submittedFormsContainer = document.getElementById('submitted-forms-container');
    const paginationContainer = document.getElementById('pagination-container');

     // Function to hide additional containers
    function hideAdditionalContainers() {
        if (quarterContainer) quarterContainer.style.display = 'none';
        if (submittedFormsContainer) submittedFormsContainer.style.display = 'none';
        if (paginationContainer) paginationContainer.style.display = 'none';
    }

    // Function to show additional containers
    function showAdditionalContainers() {
        if (quarterContainer) quarterContainer.style.display = 'block';
        if (submittedFormsContainer) submittedFormsContainer.style.display = 'block';
        if (paginationContainer) paginationContainer.style.display = 'block';
    }

    // Event listener for form selection
    formListItems.forEach(item => {
        item.addEventListener('click', function () {
            const formFile = this.getAttribute('data-form');
            const formType = this.getAttribute('data-form-type'); // Form type attribute
            console.log('Form Type:', formType);
            hideAdditionalContainers();

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
                    initializeFormDropdown(formType); // Dropdown initialization
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
    function loadDropdownOptions(formType, dropdownList) {
        console.log('Fetching dropdown options for formType:', formType);
        fetch('includes/get-admin-dropdown-options.php?formType=' + encodeURIComponent(formType))
            .then(response => response.json())
            .then(data => {
                console.log('Dropdown options received:', data); // Debugging

                // Validate response format
                if (data.status === 'success' && Array.isArray(data.options)) {
                    const options = data.options;
                    dropdownList.innerHTML = ''; // Clear previous options
                    options.forEach(option => {
                        const listItem = document.createElement('li');
                        listItem.classList.add('dropdown-item', 'px-3', 'py-2', 'border-bottom');
                        listItem.textContent = option.label;
                        listItem.setAttribute('data-value', option.value);
                        listItem.setAttribute('data-info', JSON.stringify(option.data)); // Store additional data
                        dropdownList.appendChild(listItem);
                    });
                    attachDropdownListeners(dropdownList, formType); // Pass form type for mappings
                } else {
                    console.error('Invalid response format:', data);
                    dropdownList.innerHTML = '<li class="dropdown-item">No options found</li>';
                }
            })
            .catch(error => {
                console.error('Error fetching dropdown options:', error);
            });
    }

    // Attach click event listeners to dropdown items
    function attachDropdownListeners(dropdownList, formType) {
        const items = dropdownList.querySelectorAll('.dropdown-item');
        items.forEach(item => {
            item.addEventListener('click', function () {
                const selectedValue = this.getAttribute('data-value');
                const selectedData = JSON.parse(this.getAttribute('data-info')); // Retrieve additional data
                console.log('Selected Value:', selectedValue);
                console.log('Selected Data:', selectedData);

                // Autofill form fields based on the selected data
                autofillFormFields(formType, selectedData); // Call autofill function
            });
        });
    }

    // Autofill form fields
    function autofillFormFields(formType, data) {
        console.log('Autofilling form fields for:', formType);

        // Admin Form 1 Mapping
        if (formType === 'adminform1') {
            document.getElementById('projectTitle').value = data.project_title || '';
            document.getElementById('implementingAgency').value = data.implementing_agency || '';
            document.getElementById('startDate').value = data.start_date || '';
            document.getElementById('endDate').value = data.end_date || '';
            document.getElementById('fundingAgency').value = data.fund_agency || '';
            document.getElementById('projectCost').value = data.total_cost || '';
            document.getElementById('appropriations').value = data.appropriations || '';
            document.getElementById('allotment').value = data.allotment || '';
            document.getElementById('obligations').value = data.obligations || '';
            document.getElementById('disbursements').value = data.disbursements || '';
            document.getElementById('fundingSupport').value = data.funding_support || '';
            document.getElementById('fundUtilization').value = data.fund_utilization || '';
            document.getElementById('targetOWPA').value = data.target_owpa || '';
            document.getElementById('actualOWPA').value = data.actual_owpa || '';
            document.getElementById('slippage').value = data.slippage || '';
            document.getElementById('male').value = data.male || '';
            document.getElementById('female').value = data.female || '';
        }

        // Admin Form 2 Mapping
        else if (formType === 'adminform2') {
            document.getElementById('projectTitle').value = data.project_title || '';
            document.getElementById('location').value = `${data.location}, ${data.city}, ${data.barangay}` || '';
            document.getElementById('IA').value = data.implementing_agency || '';
            document.getElementById('fundUtilization').value = data.fund_utilization || '';
            document.getElementById('targetOWPA').value = data.target_owpa || '';
            document.getElementById('actualOWPA').value = data.actual_owpa || '';
            document.getElementById('slippage').value = data.slippage || '';
        }

        // Admin Form 3 Mapping
        else if (formType === 'adminform3') {
            document.getElementById('projectTitle').value = data.project_title || '';
            document.getElementById('totalCost').value = data.total_cost || '';
            document.getElementById('location').value = `${data.location}, ${data.city}, ${data.barangay}` || '';
            document.getElementById('IA').value = data.implementing_agency || '';
        }
         // Admin Form 4 Mapping
        else if (formType === 'adminform4') {
            document.getElementById('projectTitle').value = data.project_title || '';
            document.getElementById('IA').value = data.implementing_agency || '';
        }
    }

    

    // Cancel button functionality
    document.addEventListener('click', function (event) {
        if (event.target && event.target.id === 'cancelBtn') {
            formContent.style.display = 'none';
            formsList.style.display = 'block';
            showAdditionalContainers();
        }
    });

    
});
