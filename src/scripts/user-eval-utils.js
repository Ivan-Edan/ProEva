function fetchForm(url) {
    return fetch(url).then((response) => {
        if (!response.ok) throw new Error("Failed to fetch form.");
        return response.text();
    });
}

function attachFormSubmitListener(formType) {
    const submitButton = document.getElementById('submit_btn');
    if (!submitButton) return;

    submitButton.addEventListener('click', function (event) {
        event.preventDefault();

        const form = document.querySelector(`#${formType}-form`);
        if (!form) {
            console.error("Form not found.");
            return;
        }

        if (!form.checkValidity()) {
            const invalidFields = form.querySelectorAll(':invalid');
            invalidFields.forEach((field) => {
                field.classList.add('is-invalid');
            });
            alert("Please fill out all required fields.");
            return;
        }

        const formData = new FormData(form);
        const actionUrl = form.getAttribute('data-action');

        // Add loading state
        submitButton.disabled = true;
        submitButton.textContent = 'Submitting...';

        fetch(actionUrl, {
            method: 'POST',
            body: formData,
        })
            .then((response) => response.json())
            .then((data) => {
                showNotification(data.status === 'success' ? 'success' : 'danger', data.message);
            })
            .catch((error) => {
                console.error("Error submitting form:", error);
                showNotification('danger', 'An error occurred while submitting the form.');
            })
            .finally(() => {
                submitButton.disabled = false;
                submitButton.textContent = 'Submit';
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
    if (!projectTitleInput) return;

    // Create dropdown container
    let suggestionsContainer = document.createElement('ul');
    suggestionsContainer.className = 'autocomplete-list';
    projectTitleInput.parentNode.style.position = 'relative';
    projectTitleInput.parentNode.appendChild(suggestionsContainer);

    projectTitleInput.addEventListener('input', function () {
        const query = projectTitleInput.value.trim();
        if (query.length > 1) {
            fetch(`includes/fetch-project-autofillTitle.php?query=${encodeURIComponent(query)}`)
                .then(response => response.json())
                .then(data => {
                    suggestionsContainer.innerHTML = '';
                    if (data.length === 0) {
                        suggestionsContainer.innerHTML = '<li class="autocomplete-item">No matches found</li>';
                        return;
                    }

                    data.forEach(title => {
                        const item = document.createElement('li');
                        item.className = 'autocomplete-item';
                        item.innerHTML = highlightMatch(title, query);
                        item.addEventListener('click', () => {
                            projectTitleInput.value = title;
                            suggestionsContainer.innerHTML = '';
                        });
                        suggestionsContainer.appendChild(item);
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

// Highlight matched text in dropdown
function highlightMatch(text, query) {
    const regex = new RegExp(`(${query})`, 'gi');
    return text.replace(regex, '<span class="autocomplete-highlight">$1</span>');
}


