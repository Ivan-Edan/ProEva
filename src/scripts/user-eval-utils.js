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

        // Perform form-specific validation
        let isValid = true;
        if (formType === 'form2') {
            isValid = validateForm2(); // Call your form2 validation logic
        } else if (formType === 'form3') {
            isValid = validateForm3(); // Placeholder for form3 validation
        } else if (formType === 'form4') {
            isValid = validateForm4(); // Placeholder for form4 validation
        }

        if (!isValid) {
            console.warn('Form validation failed. Correct the highlighted errors.');
            return; // Stop submission if validation fails
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

                        // Refresh the page after the success modal is closed
                        successModal._element.addEventListener('hidden.bs.modal', function () {
                            console.log('Modal closed, refreshing page...');
                            window.location.reload();  // Reload the page
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

    // Select all form fields except project title
    const formFields = document.querySelectorAll(".form-control:not(#projectTitle)");

    // Function to disable all fields except project title
    function disableFields(state) {
        formFields.forEach(field => {
            field.disabled = state;
        });
    }

    // Initially disable all fields
    disableFields(true);

    projectTitleInput.addEventListener('input', function () {
        const query = projectTitleInput.value.trim();
        if (query.length > 1) {
            fetch(`includes/fetch-user-project-autofillTitle.php?query=${encodeURIComponent(query)}`)
                .then(response => response.json())
                .then(data => {
                    suggestionsContainer.innerHTML = '';

                    if (data.length === 0) {
                        suggestionsContainer.innerHTML = '<li class="autocomplete-item">No matches found</li>';
                        disableFields(true); // Keep fields disabled if no match
                        return;
                    }

                    // Populate dropdown with suggestions
                    data.forEach(item => {
                        const { project_title, project_year } = item;
                        const displayText = `${project_title} (${project_year})`;

                        const suggestionItem = document.createElement('li');
                        suggestionItem.className = 'autocomplete-item';
                        suggestionItem.textContent = displayText;

                        suggestionItem.addEventListener('click', () => {
                            projectTitleInput.value = displayText; // Set only title
                            hiddenProjectTitle.value = project_title;
                            hiddenProjectYear.value = project_year;
                            suggestionsContainer.innerHTML = ''; // Clear dropdown

                            disableFields(false); // Enable fields after selection
                        });

                        suggestionsContainer.appendChild(suggestionItem);
                    });
                })
                .catch(err => {
                    console.error('Error fetching titles:', err);
                    disableFields(true); // Disable fields on error
                });
        } else {
            suggestionsContainer.innerHTML = '';
            disableFields(true); // Disable fields if input is empty
        }
    });

    // Close suggestions when clicking outside
    document.addEventListener('click', (e) => {
        if (!projectTitleInput.contains(e.target) && !suggestionsContainer.contains(e.target)) {
            suggestionsContainer.innerHTML = '';
        }
    });

    // Handle manual changes (when user types instead of clicking)
    projectTitleInput.addEventListener("change", function () {
        const selectedTitle = projectTitleInput.value.trim();
        if (!selectedTitle) {
            disableFields(true); // Disable fields if input is cleared
            return;
        }

        fetch(`includes/fetch-user-project-autofillTitle.php?query=${encodeURIComponent(selectedTitle)}`)
            .then(response => response.json())
            .then(data => {
                const matchedProject = data.find(p => p.project_title === selectedTitle);
                if (matchedProject) {
                    hiddenProjectTitle.value = matchedProject.project_title;
                    hiddenProjectYear.value = matchedProject.project_year;
                    disableFields(false); // Enable fields if valid title is selected
                } else {
                    hiddenProjectTitle.value = "";
                    hiddenProjectYear.value = "";
                    disableFields(true); // Keep fields disabled if no match
                }
            })
            .catch(err => {
                console.error("Error validating project title:", err);
                disableFields(true);
            });
    });
}

// Utility function to highlight matching text
function highlightMatch(text, query) {
    const regex = new RegExp(`(${query})`, 'gi');
    return text.replace(regex, '<strong>$1</strong>');
}



