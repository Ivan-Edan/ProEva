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
            <form id="admin-form-6">
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
                            <input type="text" class="form-control" id="projectTitle" placeholder="Enter title">
                        </div>
                        <div class="form-group col-md-8">
                            <label for="location">Location :</label>
                            <input type="text" class="form-control" id="location" placeholder="Enter location">
                        </div>
                    </div>

                    <!-- Rest of the form remains unchanged -->
                    <div class="mb-3 row">
                        <div class="form-group col-md-6">
                            <label for="IA">IA :</label>
                            <input type="text" class="form-control" id="IA" placeholder="Enter IA">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="fundUtilization">Fund Utilization(%) :</label>
                            <input type="text" class="form-control" id="fundUtilization" placeholder="Enter fund utilization">
                        </div>
                    </div>

                    <h5>Physical Accomplishment</h5>
                    <div class="mb-3 row">
                        <div class="form-group col-md-4">
                            <label for="targetOWPA">Target OWPA to Date (%) :</label>
                            <input type="text" class="form-control" id="targetOWPA" placeholder="Enter target OWPA">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="actualOWPA">Actual OWPA to Date (%) :</label>
                            <input type="text" class="form-control" id="actualOWPA" placeholder="Enter actual OWPA">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="slippage">Slippage :</label>
                            <input type="text" class="form-control" id="slippage" placeholder="Enter slippage">
                        </div>
                    </div>

                    <h5>Additional Information</h5>
                    <div class="mb-3 row">
                        <div class="form-group col-md-12">
                            <label for="issueDetails">Issue Details :</label>
                            <input type="text" class="form-control" id="issueDetails" placeholder="Enter issue details" style="height: 75px;">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="form-group col-md-4">
                            <label for="issueTypology">Issue Typology :</label>
                            <select id="issueTypology" class="form-control" placeholder="Select Issue Typology">
                                <option>Site Condition/Availability</option>
                                <option>Procurement</option>
                                <option>Government/Funding Institution Approvals</option>
                                <option>Budget and Funds Flow</option>
                                <option>Design, Scope, Technical Specifications</option>
                                <option>Performance of Contractors/Consultants</option>
                                <option>Capacity of Project Management Unit and Other Implementing Partners</option>
                                <option>Institutional Support</option>
                                <option>Inputs and Costs</option>
                                <option>Legal and Policy Issuances</option>
                                <option>Sustainability, Operations and Maintenance</option>
                                <option>Force Majeure</option>
                                <option>Others</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="issueStatus">Issue Status :</label>
                            <input type="text" class="form-control" id="issueStatus" placeholder="Enter issue status">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="sourceOfInfo">Source of Information :</label>
                            <input type="text" class="form-control" id="sourceOfInfo" placeholder="Enter source of information">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="form-group col-md-12">
                            <label for="actionTaken">Action Taken :</label>
                            <input type="text" class="form-control" id="actionTaken" placeholder="Enter action taken" style="height: 75px;">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="form-group col-md-12">
                            <label for="actionsToBeTaken">Actions to be Taken :</label>
                            <input type="text" class="form-control" id="actionsToBeTaken" placeholder="Enter actions to be taken" style="height: 75px;">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="form-group col-md-3">
                            <label for="NPMCAction">For NPMC Action (Y/N) :</label>
                            <select id="NPMCAction" class="form-control">
                                <option>Yes</option>
                                <option>No</option>
                            </select>
                        </div>
                        <div class="form-group col-md-9">
                            <label for="requestedAction">Requested Action from the NPMC :</label>
                            <input type="text" class="form-control" id="requestedAction" placeholder="Enter requested action">
                        </div>
                    </div>

                    <h5>Project Validation</h5>
                    <div class="mb-3 row">
                        <div class="form-group col-md-4">
                            <label for="designation">Designation/Office :</label>
                            <input type="text" class="form-control" id="designation" placeholder="Enter designation/office">
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









