

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/admin-evaluation-forms.css"> <!-- Link to the CSS file -->
    <title>Project Inspection Report</title>
</head>
<body>
    <div id="form2" class="d">
        <div class="card shadow-sm">
            <div class="card-header text-white">
                Project Inspection Report
            </div>
            <div class="card-body">
                <form>
                    <div class="details-header">
                        <h5>Project Details</h5>
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
                        <div class="form-group col-md-6">
                            <label for="projectTitle">Program / Project Title</label>
                            <input type="text" class="form-control" id="projectTitle" placeholder="Enter title">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="month">Month</label>
                            <select id="month" class="form-control">
                                <option>January</option>
                                <option>February</option>
                                <option>March</option>
                                <option>April</option>
                                <option>May</option>
                                <option>June</option>
                                <option>July</option>
                                <option>August</option>
                                <option>September</option>
                                <option>October</option>
                                <option>November</option>
                                <option>December</option>
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="year">Year</label>
                            <input type="text" class="form-control" id="year" placeholder="Enter year">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="quarter">Quarter</label>
                            <select id="quarter" class="form-control">
                                <option>Q1</option>
                                <option>Q2</option>
                                <option>Q3</option>
                                <option>Q4</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="form-group col-md-6">
                            <label for="location">Location</label>
                            <input type="text" class="form-control" id="location" placeholder="Enter location">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="IA">IA</label>
                            <input type="text" class="form-control" id="IA" placeholder="Enter IA">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="totalCost">Total Program/Project Cost (PHP)</label>
                            <input type="text" class="form-control" id="totalCost" placeholder="Enter cost">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="form-group col-md-4">
                            <label for="inspectionDate">Date of Project Inspection</label>
                            <input type="text" class="form-control" id="inspectionDate" placeholder="Enter date">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="siteDetails">Details on Site(s) Inspected</label>
                            <input type="text" class="form-control" id="siteDetails" placeholder="Enter details">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="slippage">Slippage</label>
                            <input type="text" class="form-control" id="slippage" placeholder="Enter slippage">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="form-group col-md-12">
                            <label for="findings">Findings</label>
                            <input type="text" class="form-control" id="findings" placeholder="Enter findings" style="height: 100px;">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="form-group col-md-12">
                            <label for="issues">Issues</label>
                            <input type="text" class="form-control" id="issues" placeholder="Enter issues" style="height: 100px;">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="form-group col-md-12">
                            <label for="actionsTaken">Actions Taken</label>
                            <input type="text" class="form-control" id="actionsTaken" placeholder="Enter actions" style="height: 100px;">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="form-group col-md-12">
                            <label for="actionsToBeTaken">Actions to be Taken</label>
                            <input type="text" class="form-control" id="actionsToBeTaken" placeholder="Enter actions" style="height: 100px;">
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
