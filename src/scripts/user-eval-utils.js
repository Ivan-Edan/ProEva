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
