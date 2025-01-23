<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/admin-evaluation-forms.css"> <!-- Link to the CSS file -->
</head>
<body>
    <div id="form6" class="d">
        <div class="card shadow-sm">
            <div class="card-header text-white">
                RPMC and RDC Resolutions Related to Implementation of the RPMES
            </div>
            <div class="card-body">
                <form id="admin-form-10" data-form-type="adminform6">
                    <div class="details-header">
                        <h5>Information Details</h5>
                    </div>
                    <div class="mb-3 row">
                        <div class="form-group col-md-4">
                            <label for="resolutionNumber">Resolution Number</label>
                            <input type="text" class="form-control" id="resolutionNumber" placeholder="Enter resolution number" name="resolutionNumber">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="resolutionTitle">Resolution Title</label>
                            <input type="text" class="form-control" id="resolutionTitle" placeholder="Enter resolution title" name="resolutionTitle">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="dateApproved">Date Approved</label>
                            <input type="date" class="form-control" id="dateApproved" placeholder="Enter date approved" name="dateApproved">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="form-group col-md-12">
                            <label for="resolution">Resolution</label>
                            <input type="text" class="form-control" id="resolution" placeholder="Enter resolution" style="height: 50px;" name="resolution">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="form-group col-md-12">
                            <label for="resolutionLink">Link to the Resolution</label>
                            <input type="text" class="form-control" id="resolutionLink" placeholder="Enter link to the resolution" name="resolutionLink">
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

