document.addEventListener('DOMContentLoaded', function() {
    const formListItems = document.querySelectorAll('#form-list .list-group-item');
    const formContent = document.getElementById('form-content');
    const formsList = document.getElementById('forms-list');

    formListItems.forEach(item => {
        item.addEventListener('click', function() {
            const formFile = this.getAttribute('data-form');
            
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
                })
                .catch(error => {
                    console.error('There was a problem with the fetch operation:', error);
                });
        });
    });

    // Handle the cancel button click event
    document.addEventListener('click', function(event) {
        if (event.target && event.target.id === 'cancelBtn') {
            formContent.style.display = 'none';
            formsList.style.display = 'block';
        }
    });
});
