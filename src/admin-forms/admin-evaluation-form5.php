<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/admin-evaluation-forms.css"> <!-- Link to the CSS file -->
</head>
<body>
    <div id="form5" class="d">
        <div class="card shadow-sm">
            <div class="card-header text-white">
                RPMC and RDC Resolutions Related to Implementation of the RPMES
            </div>
            <div class="card-body">
                <form>
                    <div class="details-header">
                        <h5>Information Details</h5>
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="departmentDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                Departments
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="departmentDropdown">
                                <li>
                                    <input type="text" class="form-control" id="searchField" name="searchField" placeholder="Search">
                                </li>
                                <li><a class="dropdown-item" href="#">DSWD</a></li>
                                <li><a class="dropdown-item" href="#">NDRRMC</a></li>
                                <li><a class="dropdown-item" href="#">CPDO</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="form-group col-md-3">
                            <label for="resolutionNumber">Resolution Number</label>
                            <input type="text" class="form-control" id="resolutionNumber" placeholder="Enter resolution number">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="resolutionTitle">Resolution Title</label>
                            <input type="text" class="form-control" id="resolutionTitle" placeholder="Enter resolution title">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="year">Year</label>
                            <input type="text" class="form-control" id="year" placeholder="Enter year">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="form-group col-md-3">
                            <label for="dateApproved">Date Approved</label>
                            <input type="text" class="form-control" id="dateApproved" placeholder="Enter date approved">
                        </div>
                        <div class="form-group col-md-9">
                            <label for="resolutionLink">Link to the Resolution</label>
                            <input type="text" class="form-control" id="resolutionLink" placeholder="Enter link to the resolution">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="form-group col-md-12">
                            <label for="resolution">Resolution</label>
                            <input type="text" class="form-control" id="resolution" placeholder="Enter resolution" style="height: 100px;">
                        </div>
                    </div>

                    <h5>Project Validation</h5>
                    <div class="mb-3 row">
                        <div class="form-group col-md-4">
                            <label for="submittedBy">Submitted By</label>
                            <input type="text" class="form-control" id="submittedBy" placeholder="Enter name">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="designation">Designation/Office</label>
                            <input type="text" class="form-control" id="designation" placeholder="Enter designation/office">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="submissionDate">Date</label>
                            <input type="text" class="form-control" id="submissionDate" placeholder="Enter date">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="form-group col-md-4">
                            <label for="approvedBy">Approved By</label>
                            <input type="text" class="form-control" id="approvedBy" placeholder="Enter name">
                        </div>
                        <div class="form-group col-md-4 d-flex align-items-center justify-content-center">
                            <span class="form-control-plaintext text-center" style="margin-top: 24px;">Regional Director</span>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="approvalDate">Date</label>
                            <input type="text" class="form-control" id="approvalDate" placeholder="Enter date">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="btn-container">
                            <button type="button" class="btn btn-secondary btn-custom" id="cancelBtn">Cancel</button>
                            <button type="submit" class="btn btn-submit btn-custom">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
