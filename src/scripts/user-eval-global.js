document.addEventListener('DOMContentLoaded', function () {
    const formListItems = document.querySelectorAll('#form-list .list-group-item');
    const formContent = document.getElementById('form-content');
    const formsList = document.getElementById('forms-list');
    const quarterContainer = document.getElementById('quarter-container');
    const submittedFormsContainer = document.getElementById('submitted-forms-container');
    const paginationContainer = document.getElementById('pagination-container');

    // Utility function to reset and show the form list
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
        
                // Attach event listeners for the dynamically loaded form
                const targetOWPA = document.getElementById('targetOWPA');
                const actualOWPA = document.getElementById('actualOWPA');
                const slippage = document.getElementById('slippage');
        
                if (targetOWPA && actualOWPA && slippage) {
                    function calculateSlippage() {
                        const target = parseFloat(targetOWPA.value) || 0;
                        const actual = parseFloat(actualOWPA.value) || 0;
                        const result = actual - target ;
                        slippage.value = result.toFixed(2) + '%';
                    }
        
                    targetOWPA.addEventListener('input', calculateSlippage);
                    actualOWPA.addEventListener('input', calculateSlippage);
                }
        
                // Load form-specific logic
                if (formType === 'form1') {
                    loadForm1Logic();
                }
        
                // Enable project title autofill for forms 2, 3, and 4
                if (formType === 'form2' || formType === 'form3' || formType === 'form4') {
                    enableProjectTitleAutofill();
                }
        
                attachFormSubmitListener(formType); // Attach form submission handler
            })
        
                .catch((error) => {
                    console.error("Error loading form:", error);
                    formContent.innerHTML = '<p>Failed to load form. Please try again later.</p>';
                });
        });
    });
    
    

    // Handle the cancel button click
    document.addEventListener('click', function (event) {
        if (event.target && event.target.id === 'cancel_btn') {
            console.log("Cancel button clicked.");
            resetFormAndShowList();
        }
    });
});

