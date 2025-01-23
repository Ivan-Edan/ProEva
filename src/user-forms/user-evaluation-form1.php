<div class="container-fluid evaluation-container">
    <div class="custom-container">
        <div class="card shadow-sm forms-container">
            <div class="card-header text-white">
            <button id="add-project-form" type="button" class="btn btn-primary ">+ Add Project Form</button>
                INITIAL PROJECT REPORT
            </div>
            <div class="card-body">
                <form id="user_form_1" action="includes/user-submit-form1.php" method="POST">
                    <div id="project-forms-container" class="accordion">
                        <!-- Collapsible project forms will be dynamically added here -->
                    </div>
                    <div class="d-flex justify-content-end mt-4">
                        <button type="button" id="cancel-btn" class="btn btn-secondary">Cancel</button>
                        <button type="submit" id="submit-btn-form1" class="btn btn-submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
