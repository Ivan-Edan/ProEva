document.addEventListener('DOMContentLoaded', function() {
    const formListItems = document.querySelectorAll('#form-list .list-group-item');
    const formContent = document.getElementById('form-content');
    const formsList = document.getElementById('forms-list');

    // Function to reset and show the form list
    function resetFormAndShowList() {
        console.log("Resetting form and showing form list");
        formContent.style.display = 'none';  // Hide the form content
        formContent.innerHTML = '';          // Clear the form content
        formsList.style.display = 'block';   // Show the form list
    }

    formListItems.forEach(item => {
        item.addEventListener('click', function() {
            const formFile = this.getAttribute('data-form');
            console.log("Fetching form: ", formFile);

            // Show a loading indicator while the form is being fetched
            formContent.innerHTML = '<p>Loading form...</p>';
            
            // Load the form content via AJAX
            fetch(formFile)
                .then(response => {
                    if (response.ok) {
                        return response.text();
                    }
                    throw new Error('Network response was not ok.');
                })
                .then(html => {
                    formContent.innerHTML = html;
                    
                    // Hide the forms list and show the form content
                    formsList.style.display = 'none';
                    formContent.style.display = 'block';

                    // Add submit button functionality
                    const submitButton = document.getElementById('submit_btn');
                    if (submitButton) {
                        submitButton.addEventListener('click', function(event) {
                            event.preventDefault(); // Prevent default form submission

                            console.log("Form submission initiated");

                            // Dynamically select the form element
                            const formElement = formContent.querySelector('form');
                            if (!formElement) {
                                alert("Form not found.");
                                return;
                            }

                            // Perform form validation
                            if (!formElement.checkValidity()) {
                                alert("Please fill out the form correctly.");
                                return;
                            }

                            // Get the form's data-action attribute for the submit endpoint
                            const actionUrl = formElement.getAttribute('data-action');
                            if (!actionUrl) {
                                alert("Submission endpoint not specified.");
                                return;
                            }

                            // Collect form data
                            const formData = new FormData(formElement);

                            // Disable submit button to prevent multiple clicks
                            submitButton.disabled = true;

                            // Send data to the server
                            fetch(actionUrl, {
                                method: 'POST',
                                body: formData
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.status === 'success') {
                                    console.log("Form submitted successfully");
                                    alert(data.message); // Notify user of success
                                    resetFormAndShowList(); // Re-display form list after successful submission
                                } else {
                                    alert(data.message); // Notify user of error
                                    console.log("Form submission error: ", data.message);
                                }
                            })
                            .catch(error => {
                                console.error('Error submitting form:', error);
                                alert('Error submitting form.');
                            })
                            .finally(() => {
                                // Re-enable submit button
                                submitButton.disabled = false;
                            });
                        });
                    }
                })
                .catch(error => {
                    console.error('There was a problem with the fetch operation:', error);
                    formContent.innerHTML = '<p>Failed to load form. Please try again later.</p>'; // Display error message in the UI
                });
        });
    });

    // Handle the cancel button click event
    document.addEventListener('click', function(event) {
        if (event.target && event.target.id === 'cancel_btn') {
            resetFormAndShowList();  // Show the form list and reset form content on cancel
        }
    });
});
