document.addEventListener('DOMContentLoaded', function () {
    const formListItems = document.querySelectorAll('#form-list .list-group-item');
    const formContent = document.getElementById('form-content');
    const formsList = document.getElementById('forms-list');
    const quarterContainer = document.getElementById('quarter-container');
    const submittedFormsContainer = document.getElementById('submitted-forms-container');
    const paginationContainer = document.getElementById('pagination-container');

    // Utility: Hide additional containers
    function hideAdditionalContainers() {
        if (quarterContainer) quarterContainer.style.display = 'none';
        if (submittedFormsContainer) submittedFormsContainer.style.display = 'none';
        if (paginationContainer) paginationContainer.style.display = 'none';
    }

    // Utility: Show additional containers
    function showAdditionalContainers() {
        if (quarterContainer) quarterContainer.style.display = 'block';
        if (submittedFormsContainer) submittedFormsContainer.style.display = 'block';
        if (paginationContainer) paginationContainer.style.display = 'block';
    }

    // Event listener for form selection
    formListItems.forEach(item => {
        item.addEventListener('click', function () {
            const formFile = this.getAttribute('data-form');
            const formType = this.getAttribute('data-form-type');
            console.log('Form Type:', formType);
            hideAdditionalContainers();

            // Dynamically load form content
            fetch(formFile)
                .then(response => response.ok ? response.text() : Promise.reject('Error loading form content.'))
                .then(html => {
                    formContent.innerHTML = html;
                    formsList.style.display = 'none';
                    formContent.style.display = 'block';

                    // Initialize dropdown
                    initializeFormDropdown(formType);
                })
                .catch(error => console.error('Error loading form:', error));
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

        loadDropdownOptions(formType, dropdownList);

        // Attach search functionality
        dropdownSearch.addEventListener('input', function () {
            const searchTerm = this.value.toLowerCase();
            const items = dropdownList.querySelectorAll('.dropdown-item');
            items.forEach(item => {
                item.style.display = item.textContent.toLowerCase().includes(searchTerm) ? '' : 'none';
            });
        });
    }

    // Load dropdown options dynamically
    function loadDropdownOptions(formType, dropdownList) {
        console.log('Fetching dropdown options for formType:', formType);
        fetch(`includes/get-admin-dropdown-options.php?formType=${encodeURIComponent(formType)}`)
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success' && Array.isArray(data.options)) {
                    dropdownList.innerHTML = ''; // Clear previous options
                    data.options.forEach(option => {
                        const listItem = document.createElement('li');
                        listItem.classList.add('dropdown-item', 'px-3', 'py-2', 'border-bottom');
                        listItem.textContent = option.label;
                        listItem.dataset.value = option.value;
                        listItem.dataset.info = JSON.stringify(option.data);
                        dropdownList.appendChild(listItem);
                    });
                    attachDropdownListeners(dropdownList, formType);
                } else {
                    console.error('Invalid response format:', data);
                    dropdownList.innerHTML = '<li class="dropdown-item">No options found</li>';
                }
            })
            .catch(error => console.error('Error fetching dropdown options:', error));
    }

    // Attach click listeners to dropdown items
    function attachDropdownListeners(dropdownList, formType) {
        dropdownList.querySelectorAll('.dropdown-item').forEach(item => {
            item.addEventListener('click', function () {
                const selectedData = JSON.parse(this.dataset.info);
                console.log('Selected Data:', selectedData);

                autofillFormFields(formType, selectedData);
            });
        });
    }

function autofillFormFields(formType, data) {
    console.log('Autofilling form fields for:', formType);
    console.log('Data passed to autofillFormFields:', data); // Debugging

    const mappings = {
        adminform1: {
            projectTitle: 'project_title',
            implementingAgency: 'implementing_agency',
            startDate: 'start_date',
            endDate: 'end_date',
            fundingAgency: 'fund_agency',
            projectCost: 'total_cost',
            appropriations: 'appropriations',
            sector:'sector',
            fundSource: 'fund_source',
            allotment: 'allotment',
            obligations: 'obligations',
            disbursements: 'disbursements',
            fundingSupport: 'funding_support',
            fundUtilization: 'fund_utilization',
            targetOWPA: 'target_owpa',
            actualOWPA: 'actual_owpa',
            slippage: 'slippage',
            male: 'male',
            female: 'female'
        },
        adminform2: {
            projectTitle: 'project_title',
            location: 'location', // Assuming data.location includes city, barangay concatenated
            IA: 'implementing_agency',
            fundUtilization: 'fund_utilization',
            targetOWPA: 'target_owpa',
            actualOWPA: 'actual_owpa',
            slippage: 'slippage'
        },
        adminform3: {
            projectTitle: 'project_title',
            totalCost: 'total_cost',
            location: 'location', // Same as above
            IA: 'implementing_agency'
        },
        adminform4: {
            projectTitle: 'project_title',
            IA: 'implementing_agency',
            location: 'location'
        }
    };

    if (mappings[formType]) {
        const formMapping = mappings[formType];
        Object.keys(formMapping).forEach(field => {
            const dataKey = formMapping[field];
            const element = document.getElementById(field);

            if (element) {
                const value = data[dataKey];
                element.value = value !== undefined ? value : ''; // Set to empty string if value is missing
            } else {
                console.warn(`Field "${field}" not found in the form.`);
            }
        });
    } else {
        console.error(`No mappings found for formType: ${formType}`);
    }
}



    // Reset form fields
    function resetForm(formId) {
        const form = document.getElementById(formId);
        if (form) form.reset();
    }

    // Submit forms dynamically
    function submitForm(formType, formData) {
        fetch(`includes/admin-submit-${formType}.php`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(formData)
        })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    const successModal = new bootstrap.Modal(document.getElementById('successModal'));
                    successModal.show();
                    successModal._element.addEventListener('hidden.bs.modal', function () {
                        resetToFormList();
                    });
                    resetForm(`admin-form-${formType}`);
                } else {
                    alert(`Error: ${data.message}`);
                }
            })
            .catch(error => {
                console.error('Error submitting form:', error);
                alert('An error occurred while submitting the form.');
            });
    }

    // Handle form submission
    document.addEventListener('click', function (event) {
        if (event.target && event.target.matches('.btn-submit')) {
            event.preventDefault();

            const form = event.target.closest('form');
            const formType = form.getAttribute('data-form-type');

            if (formType) {
                const formData = Array.from(new FormData(form)).reduce((obj, [key, value]) => ({ ...obj, [key]: value }), {});
                submitForm(formType, formData);
                
                
                
            }
        }
    });

    // Cancel button functionality
    document.addEventListener('click', function (event) {
        if (event.target && event.target.id === 'cancelBtn') {
            formContent.style.display = 'none';
            formsList.style.display = 'block';
            resetForm(event.target.closest('form').id);
            showAdditionalContainers();
        }
    });
});


function resetToFormList() {
    const formContent = document.getElementById('form-content');
    const formsList = document.getElementById('forms-list');
    const quarterContainer = document.getElementById('quarter-container');
    const submittedFormsContainer = document.getElementById('submitted-forms-container');
    const paginationContainer = document.getElementById('pagination-container');

    if (formContent) {
        formContent.style.display = 'none';
        formContent.innerHTML = '';
    }
    if (formsList) formsList.style.display = 'block';
    if (quarterContainer) quarterContainer.style.display = 'block';
    if (submittedFormsContainer) submittedFormsContainer.style.display = 'block';
    if (paginationContainer) paginationContainer.style.display = 'block';
}