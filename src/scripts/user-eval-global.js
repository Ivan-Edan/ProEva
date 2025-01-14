document.addEventListener('DOMContentLoaded', function () {
    // Track unsaved changes
    let unsavedChanges = false;

    // Dynamically detect changes in any form input, textarea, or select
    document.addEventListener('input', (event) => {
        if (event.target.matches('form input, form textarea ')) {
            unsavedChanges = true; // Mark unsaved changes
            console.log("Unsaved changes detected.");
        }
    });

    // Intercept sidebar navigation clicks
    document.querySelectorAll('.nav-link').forEach((link) => {
        link.addEventListener('click', function (event) {
            if (unsavedChanges) {
                event.preventDefault();

                // Show the Cancel Confirmation Modal
                const cancelModal = new bootstrap.Modal(document.getElementById('cancelConfirmationModal'));
                cancelModal.show();

                // Remove previous listeners and attach navigation logic
                const confirmCancelButton = document.getElementById('confirmCancelButton');
                confirmCancelButton.onclick = function () {
                    cancelModal.hide();
                    unsavedChanges = false; // Reset the flag
                    window.location.href = link.href; // Navigate
                };
            }
        });
    });

    // Reset unsavedChanges on form submission
    document.querySelectorAll('form').forEach((form) => {
        form.addEventListener('submit', () => {
            unsavedChanges = false;
        });
    });


    // Function to dynamically update the quarter display
    function updateQuarterDisplay() {
        const quarterDisplay = document.querySelector('#quarter-display'); // Target the span for the quarter text

        if (quarterDisplay) {
            const currentMonth = new Date().getMonth() + 1; // JavaScript months are 0-indexed
            let quarter = '';

            if (currentMonth >= 1 && currentMonth <= 3) {
                quarter = '1st';
            } else if (currentMonth >= 4 && currentMonth <= 6) {
                quarter = '2nd';
            } else if (currentMonth >= 7 && currentMonth <= 9) {
                quarter = '3rd';
            } else if (currentMonth >= 10 && currentMonth <= 12) {
                quarter = '4th';
            }

            quarterDisplay.textContent = `QUARTER : ${quarter}`; // Update the text dynamically
        }
    }


    // Form-related logic
    const formListItems = document.querySelectorAll('#form-list .list-group-item');
    const formContent = document.getElementById('form-content');
    const formsList = document.getElementById('forms-list');
    const quarterContainer = document.getElementById('quarter-container');
    const submittedFormsContainer = document.getElementById('submitted-forms-container');
    const paginationContainer = document.getElementById('pagination-container');

    function resetFormAndShowList() {
        console.log("Resetting form and showing form list.");
        formContent.style.display = 'none';
        formContent.innerHTML = '';
        formsList.style.display = 'block';

        if (quarterContainer) quarterContainer.style.display = 'block';
        if (submittedFormsContainer) submittedFormsContainer.style.display = 'block';
        if (paginationContainer) paginationContainer.style.display = 'block';
    }

    // Handle form list item clicks
    formListItems.forEach((item) => {
        item.addEventListener('click', function () {
            const formFile = this.getAttribute('data-form');
            const formType = this.getAttribute('data-form-type');
            console.log(`Fetching form: ${formFile} (${formType})`);

            formContent.innerHTML = '<p>Loading form...</p>';

            fetch(formFile)
                .then((response) => {
                    if (response.ok) return response.text();
                    throw new Error("Network response was not ok.");
                })
                .then((html) => {
                    formContent.innerHTML = html;

                    formsList.style.display = 'none';
                    formContent.style.display = 'block';

                    if (quarterContainer) quarterContainer.style.display = 'none';
                    if (submittedFormsContainer) submittedFormsContainer.style.display = 'none';
                    if (paginationContainer) paginationContainer.style.display = 'none';

                    updateQuarterDisplay();

                    // Attach dynamic event listeners
                    const targetOWPA = document.getElementById('targetOWPA');
                    const actualOWPA = document.getElementById('actualOWPA');
                    const slippage = document.getElementById('slippage');

                    if (targetOWPA && actualOWPA && slippage) {
                        function calculateSlippage() {
                            const target = parseFloat(targetOWPA.value) || 0;
                            const actual = parseFloat(actualOWPA.value) || 0;
                            const result = actual - target;
                    
                            // Set the slippage value without percentage sign
                            slippage.value = result.toFixed(2);
                        }
                    
                        targetOWPA.addEventListener('input', calculateSlippage);
                        actualOWPA.addEventListener('input', calculateSlippage);
                    }
                    

                    // Load form-specific logic
                    if (formType === 'form1') {
                        loadForm1Logic();
                    }

                    // Enable project title autofill for forms 2, 3, and 4
                    if (['form2', 'form3', 'form4'].includes(formType)) {
                        enableProjectTitleAutofill();
                    }

                    attachFormSubmitListener(formType);
                })
                .catch((error) => {
                    console.error("Error loading form:", error);
                    formContent.innerHTML = '<p>Failed to load form. Please try again later.</p>';
                    formsList.style.display = 'block'; // Reset state
                });
        });
    });

// Handle the cancel button click
document.addEventListener('click', function (event) {
    if (event.target && event.target.id === 'cancel_btn') {
        console.log("Cancel button clicked.");

        if (unsavedChanges) {
            // Show the Cancel Confirmation Modal only if there are unsaved changes
            const cancelModal = new bootstrap.Modal(document.getElementById('cancelConfirmationModal'));
            cancelModal.show();

            const confirmCancelButton = document.getElementById('confirmCancelButton');
            confirmCancelButton.onclick = function () {
                cancelModal.hide();
                unsavedChanges = false; // Reset unsaved changes flag
                resetFormAndShowList();
            };
        } else {
            // No unsaved changes, reset the form immediately
            console.log("No unsaved changes. Resetting form without confirmation.");
            resetFormAndShowList();
        }
    }
});

});
