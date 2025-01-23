<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/admin-evaluation-forms.css"> <!-- Link to your custom CSS file -->
</head>
<body>
    <div id="form6" class="d" data-form-type="adminform2">
        <div class="card shadow-sm">
            <div class="card-header text-white">
                Report on the Status of Projects Encountering Implementation Problems
            </div>
            <div class="card-body">
            <form id="admin-form-6" data-form-type="adminform2">
                    <!-- Wrapping the h5 and dropdown in a flex container -->
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
                        <div class="form-group col-md-4">
                            <label for="projectTitle">Program / Project Title :</label>
                            <input type="text" class="form-control" id="projectTitle"  name="projectTitle" placeholder="Enter title">
                        </div>
                        <div class="form-group col-md-8">
                            <label for="location">Location :</label>
                            <input type="text" class="form-control" id="location"  name="location" placeholder="Enter location">
                        </div>
                    </div>

                    <!-- Rest of the form remains unchanged -->
                    <div class="mb-3 row">
                        <div class="form-group col-md-6">
                            <label for="IA">IA :</label>
                            <input type="text" class="form-control" id="IA" name="IA" placeholder="Enter IA">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="fundUtilization">Fund Utilization(%) :</label>
                            <input type="text" class="form-control" id="fundUtilization" name="fundUtilization" placeholder="Enter fund utilization">
                        </div>
                    </div>

                    <h5>Physical Accomplishment</h5>
                    <div class="mb-3 row">
                        <div class="form-group col-md-4">
                            <label for="targetOWPA">Target OWPA to Date (%) :</label>
                            <input type="text" class="form-control" id="targetOWPA"  name="targetOWPA" placeholder="Enter target OWPA">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="actualOWPA">Actual OWPA to Date (%) :</label>
                            <input type="text" class="form-control" id="actualOWPA" name="actualOWPA" placeholder="Enter actual OWPA">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="slippage">Slippage :</label>
                            <input type="text" class="form-control" id="slippage" name="slippage" placeholder="Enter slippage">
                        </div>
                    </div>

                    <h5>Additional Information</h5>
                    <div class="mb-3 row">
                        <div class="form-group col-md-12">
                            <label for="issueDetails">Issue Details :</label>
                            <input type="text" class="form-control" id="issueDetails" name="issueDetails" placeholder="Enter issue details" style="height: 75px;">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="form-group col-md-4">
                            <label for="issueTypology">Issue Typology :</label>
                            <select id="issueTypology" class="form-control" name="issueTypology" placeholder="Select Issue Typology">
                                <option value="Site Condition/Availability">Site Condition/Availability</option>
                                <option value="Procurement">Procurement</option>
                                <option value="Government/Funding Institution Approvals">Government/Funding Institution Approvals</option>
                                <option value="Budget and Funds Flow">Budget and Funds Flow</option>
                                <option value="Design, Scope, Technical Specifications">Design, Scope, Technical Specifications</option>
                                <option value="Performance of Contractors/Consultants">Performance of Contractors/Consultants</option>
                                <option value="Capacity of Project Management Unit and Other Implementing Partners">Capacity of Project Management Unit and Other Implementing Partners</option>
                                <option value="Institutional Support">Institutional Support</option>
                                <option value="Inputs and Costs">Inputs and Costs</option>
                                <option value="Legal and Policy Issuances">Legal and Policy Issuances</option>
                                <option value="Sustainability, Operations and Maintenance">Sustainability, Operations and Maintenance</option>
                                <option value="Force Majeure">Force Majeure</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="issueStatus">Issue Status :</label>
                            <select id="issueStatus" class="form-control" name="issueStatus" placeholder="Select Issue Typology">
                                <option value="Current">Current</option>
                                <option value="Resolved">Resolved</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="sourceOfInfo">Source of Information :</label>
                            <input type="text" class="form-control" id="sourceOfInfo" name="sourceOfInfo" placeholder="Enter source of information">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="form-group col-md-12">
                            <label for="actionTaken">Action Taken :</label>
                            <input type="text" class="form-control" id="actionTaken" name="actionTaken" placeholder="Enter action taken" style="height: 75px;">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="form-group col-md-12">
                            <label for="actionsToBeTaken">Actions to be Taken :</label>
                            <input type="text" class="form-control" id="actionsToBeTaken" name="actionsToBeTaken" placeholder="Enter actions to be taken" style="height: 75px;">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="form-group col-md-3">
                            <label for="NPMCAction">For NPMC Action (Y/N) :</label>
                            <select id="NPMCAction" class="form-control" name="NPMCAction" placeholder="Select NPMC Action">
                                <option>Yes</option>
                                <option>No</option>
                            </select>
                        </div>
                        <div class="form-group col-md-9">
                            <label for="requestedAction">Requested Action from the NPMC :</label>
                            <input type="text" class="form-control" id="requestedAction" name="requestedAction" placeholder="Enter requested action from the NPMC">
                        </div>
                    </div>
                    <h5>Project Validation</h5>
                    <div class="mb-3 row">
                        <div class="form-group col-md-4">
                            <label for="submittedBy">Submitted By</label>
                            <input type="text" class="form-control" id="submittedBy"  name="submittedBy"placeholder="Enter name">
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









