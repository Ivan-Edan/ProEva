function fetchForm(url) {
    return fetch(url).then((response) => {
        if (!response.ok) throw new Error("Failed to fetch form.");
        return response.text();
    });
}

function showConfirmationModal(formElement, onSubmit) {
    // Attach event listener to the Confirm button
    const confirmButton = document.getElementById('confirmSubmitButton');
    confirmButton.onclick = function () {
        // Close the modal
        const modal = bootstrap.Modal.getInstance(document.getElementById('confirmationModal'));
        modal.hide();

        // Call the submit logic
        onSubmit(formElement);
    };

    // Show the modal
    const modal = new bootstrap.Modal(document.getElementById('confirmationModal'));
    modal.show();
}

function attachFormSubmitListener(formType) {
    const submitButton = document.getElementById('submit_btn');
    if (!submitButton) return;

    submitButton.addEventListener('click', function (event) {
        event.preventDefault();

        const form = document.querySelector(`#${formType}-form`);
        if (!form) {
            console.error('Form not found.');
            return;
        }

        if (!form.checkValidity()) {
            const invalidFields = form.querySelectorAll(':invalid');
            invalidFields.forEach((field) => {
                field.classList.add('is-invalid');
            });
            alert('Please fill out all required fields.');
            return;
        }

        // Show confirmation modal
        showConfirmationModal(form, function (formElement) {
            const formData = new FormData(formElement);
            const actionUrl = formElement.getAttribute('data-action');

            // Add loading state
            submitButton.disabled = true;
            submitButton.textContent = 'Submitting...';

            fetch(actionUrl, {
                method: 'POST',
                body: formData,
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.status === 'error') {
                        // Display the error modal
                        const errorModalBody = document.getElementById('errorModalBody');
                        errorModalBody.textContent = data.message; // Set error message
                        const errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
                        errorModal.show();
                    } else {
                        // Show success modal
                        const successModal = new bootstrap.Modal(document.getElementById('successModal'));
                        successModal.show();

                        // Reset to form list after modal is closed
                        successModal._element.addEventListener('hidden.bs.modal', function () {
                            resetToFormList();
                        });
                    }
                })
                .catch((error) => {
                    console.error('Error submitting form:', error);
                    showNotification('danger', 'An error occurred while submitting the form.');
                })
                .finally(() => {
                    submitButton.disabled = false;
                    submitButton.textContent = 'Submit';
                    
                });
        });
    });
}

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


function showNotification(type, message) {
    const alertDiv = document.createElement('div');
    alertDiv.className = `alert alert-${type}`;
    alertDiv.textContent = message;
    document.body.appendChild(alertDiv);

    setTimeout(() => {
        alertDiv.remove();
    }, 3000);
}

function enableProjectTitleAutofill() {
    const projectTitleInput = document.getElementById('projectTitle');
    const hiddenProjectTitle = document.getElementById('hiddenProjectTitle');
    const hiddenProjectYear = document.getElementById('hiddenProjectYear');

    if (!projectTitleInput || !hiddenProjectTitle || !hiddenProjectYear) return;

    // Create dropdown container
    let suggestionsContainer = document.createElement('ul');
    suggestionsContainer.className = 'autocomplete-list';
    projectTitleInput.parentNode.style.position = 'relative';
    projectTitleInput.parentNode.appendChild(suggestionsContainer);

    projectTitleInput.addEventListener('input', function () {
        const query = projectTitleInput.value.trim();
        if (query.length > 1) {
            fetch(`includes/fetch-user-project-autofillTitle.php?query=${encodeURIComponent(query)}`)
                .then(response => response.json())
                .then(data => {
                    suggestionsContainer.innerHTML = '';

                    if (data.length === 0) {
                        suggestionsContainer.innerHTML = '<li class="autocomplete-item">No matches found</li>';
                        return;
                    }

                    // Populate dropdown with suggestions
                    data.forEach(item => {
                        const { project_title, project_year } = item;
                        const displayText = `${project_title} (${project_year})`;

                        const suggestionItem = document.createElement('li');
                        suggestionItem.className = 'autocomplete-item'; // Apply the class
                        suggestionItem.textContent = displayText;

                        suggestionItem.addEventListener('click', () => {
                            projectTitleInput.value = displayText; // Show selected title
                            hiddenProjectTitle.value = project_title; // Store title
                            hiddenProjectYear.value = project_year; // Store year
                            suggestionsContainer.innerHTML = ''; // Clear dropdown
                        });

                        suggestionsContainer.appendChild(suggestionItem);
                    });
                })
                .catch(err => console.error('Error fetching titles:', err));
        } else {
            suggestionsContainer.innerHTML = '';
        }
    });

    // Close suggestions when clicking outside
    document.addEventListener('click', (e) => {
        if (!projectTitleInput.contains(e.target) && !suggestionsContainer.contains(e.target)) {
            suggestionsContainer.innerHTML = '';
        }
    });
}

// Utility function to highlight matching text
function highlightMatch(text, query) {
    const regex = new RegExp(`(${query})`, 'gi');
    return text.replace(regex, '<strong>$1</strong>');
}



