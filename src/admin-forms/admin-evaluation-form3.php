<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/admin-evaluation-forms.css"> <!-- Link to the CSS file -->
    <title>Project Inspection Report</title>
</head>
<body>
    <div id="form7" class="d" data-form-type="adminform3">
        <div class="card shadow-sm">
            <div class="card-header text-white">
                Project Inspection Report
            </div>
            <div class="card-body">
                <form id="admin-form-7" data-form-type="adminform3">
                    <div class="details-header">
                        <h5>Project Details</h5>
                        <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu" data-bs-toggle="dropdown" aria-expanded="false">
                            Form# | Department | Project Title
                        </button>
                        <ul class="dropdown-menu" id="formDropdown" aria-labelledby="dropdownMenu">
                            <li>
                                <input type="text" class="form-control" id="searchField" name="searchField" placeholder="Search">
                            </li>
                            <div id="dropdownList">
                                <!-- Dropdown items will be dynamically populated here -->
                            </div>
                        </ul>
                    </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="form-group col-md-6">
                            <label for="projectTitle">Program / Project Title</label>
                            <input type="text" class="form-control" id="projectTitle" name="projectTitle" placeholder="Enter title">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="totalCost">Total Program/Project Cost (PHP)</label>
                            <input type="text" class="form-control" id="totalCost" name="totalCost" placeholder="Enter cost">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="form-group col-md-6">
                            <label for="location">Location</label>
                            <input type="text" class="form-control" id="location" name="location" placeholder="Enter location">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="IA">IA</label>
                            <input type="text" class="form-control" id="IA" name="IA" placeholder="Enter IA">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="form-group col-md-6">
                            <label for="inspectionDate">Date of Project Inspection</label>
                            <input type="date" class="form-control" id="inspectionDate" name="inspectionDate" placeholder="Enter date">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="siteDetails">Details on Site(s) Inspected</label>
                            <input type="text" class="form-control" id="siteDetails" name="siteDetails" placeholder="Enter details">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="form-group col-md-12">
                            <label for="findings">Findings</label>
                            <input type="text" class="form-control" id="findings" name="findings" placeholder="Enter findings" style="height: 75px;">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="form-group col-md-12">
                            <label for="Issues">Issues</label>
                            <input type="text" class="form-control" id="Issues" name="Issues" placeholder="Enter Issues" style="height: 75px;">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="form-group col-md-12">
                            <label for="actionsTaken">Actions Taken</label>
                            <input type="text" class="form-control" id="actionsTaken" name="actionsTaken" placeholder="Enter actions taken" style="height: 75px;">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="form-group col-md-12">
                            <label for="actionsToBeTaken">Actions to be Taken</label>
                            <input type="text" class="form-control" id="actionsToBeTaken" name="actionsToBeTaken" placeholder="Enter actions" style="height: 75px;">
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
