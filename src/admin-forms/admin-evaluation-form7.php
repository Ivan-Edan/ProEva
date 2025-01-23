
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/admin-evaluation-forms.css"> <!-- Link to your custom CSS file -->
</head>
<body>
    <div id="form7" class="d">
        <div class="card shadow-sm">
            <div class="card-header text-white">
                Key Lessons Learned from Issues Resolved and Best Practices
            </div>
            <div class="card-body">
                <form id="admin-form-11" data-form-type="adminform7">
                    <div class="details-header">
                        <h5>Project Details</h5>
                    </div>
                    <div class="mb-3 row">
                        <div class="form-group col-md-4">
                            <label for="projectTitle">Program / Project Title</label>
                            <input type="text" class="form-control" id="projectTitle" placeholder="Enter title" name="projectTitle">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="location">Location</label>
                            <input type="text" class="form-control" id="location" placeholder="Enter location" name="location">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="implementingAgency">Implementing Agency</label>
                            <input type="text" class="form-control" id="implementingAgency" placeholder="Enter implementing agency" name="implementingAgency">
                        </div>
                    </div>


                    <h5>Problem/Issue</h5>
                    <div class="mb-3 row">
                        <div class="form-group col-md-6">
                            <label for="nature">Nature</label>
                            <input type="text" class="form-control" id="nature" placeholder="Enter nature of the problem/issue" name="nature">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="details">Details</label>
                            <input type="text" class="form-control" id="details" placeholder="Enter details" name="details">
                        </div>
                    </div>
                    <h5>Additional Details</h5>
                    <div class="mb-3 row">
                        <div class="form-group col-md-12">
                            <label for="strategies">Strategies/Actions Taken to Resolve the Problem/Issue</label>
                            <input type="text" class="form-control" id="strategies" placeholder="Enter strategies/actions taken" style="height: 50px;" name="strategies">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="form-group col-md-12">
                            <label for="responsibleEntity">Responsible Entity/Key Actors and their Specific Assistance</label>
                            <input type="text" class="form-control" id="responsibleEntity" placeholder="Enter responsible entity/key actors" style="height: 50px;" name="responsibleEntity">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="form-group col-md-12">
                            <label for="lessonsLearned">Lessons Learned and Good Practices that could be shared to the NPMC/Other PMCs</label>
                            <input type="text" class="form-control" id="lessonsLearned" placeholder="Enter lessons learned and good practices" style="height: 50px;" name="lessonsLearned">
                        </div>
                    </div>
                    <h5>Project Validation</h5>
                    <div class="mb-3 row">
                        <div class="form-group col-md-4">
                            <label for="submittedBy">Submitted By</label>
                            <input type="text" class="form-control" id="submittedBy" name="submittedBy" placeholder="Enter name">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="designation">Designation/Office</label>
                            <input type="text" class="form-control" id="designation" name="designation" placeholder="Enter designation/office">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="submissionDate">Submission Date</label>
                            <input type="date" class="form-control" id="submissionDate" name="submissionDate" placeholder="Enter date">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="form-group col-md-12 d-flex align-items-center justify-content-center">
                            <span class="form-control-plaintext text-center" style="margin-top: 24px;">Regional Director</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="btn-container">
                            <button type="button" class="btn btn-secondary btn-custom" id="cancelBtn">Cancel</button>
                            <button type="button" class="btn btn-submit btn-custom">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
