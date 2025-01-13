<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/user-evaluation-forms.css"> <!-- Link to your custom CSS file -->
    <title>Project Exception Report</title>
</head>
<body>
    <div id="userForm3" class="form-container">
        <div class="card shadow-sm">
            <div class="card-header text-white ">
                Project Exception Report
            </div>
            <div class="card-body">
                <form id="form3-form" data-action="includes/user-submit-form3.php" method="POST">
                    <h5>Project Details</h5>
                    <div class="row mb-3">
                        <div class="col-md-12">
                        <label for="projectTitle">Program / Project Title:</label>
                        <input type="text" class="form-control" id="projectTitle" name="user_project_title_1" required>
                        <input type="hidden" id="hiddenProjectTitle" name="project_title">
                        <input type="hidden" id="hiddenProjectYear" name="project_year">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="implementingAgency">Implementing Agency:</label>
                            <input type="text" class="form-control" id="implementingAgency"  name = "user_implementing_agency_1">
                        </div>
                        <div class="col-md-6">
                        <label for="sector">Sector:</label>
                            <select id="sector" class="form-control" name="user_sector_1">
                                <option value="General Public Services">General Public Services</option>
                                <option value="Social Services">Social Services</option>
                                <option value="Economic Services">Economic Services</option>
                                <option value="Other Services">Other Services</option>
                            </select>
                        </div>
                    </div>

                    <h5>Location</h5>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="province">Province:</label>
                            <input type="text" class="form-control" id="province" name = "user_province_1">
                        </div>
                        <div class="col-md-4">
                            <label for="city">City/Municipality:</label>
                            <input type="text" class="form-control" id="city" name = "user_city_1">
                        </div>
                        <div class="col-md-4">
                            <label for="barangay">Barangay:</label>
                            <input type="text" class="form-control" id="barangay" name = "user_barangay_1">
                        </div>
                    </div>

                    <h5>Additional Details</h5>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="findings">Findings:</label>
                            <input type="text" class="form-control" id="findings" name = "user_findings_3">
                        </div>
                        <div class="col-md-4">
                            <label for="typology">Typology:</label>
                            <select id="typology" class="form-control" placeholder="Select Issue Typology" name = "user_typology_3">
                                <option value="Site Condition/Availability"> Site Condition/Availability</option>
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
                        <div class="col-md-4">
                            <label for="issueStatus">Issue Status:</label>
                            <select id="issueStatus" class="form-control" placeholder="Select Issue Typology" name = "user_issue_status_3">
                                <option value="Current">Current</option>
                                <option value="Resolved">Resolved</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="reasons">Reasons:</label>
                            <textarea class="form-control" id="reasons" name = "user_reasons_3"></textarea>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="actionsTaken">Actions Taken:</label>
                            <textarea class="form-control" id="actionsTaken" name = "user_actions_taken_3"></textarea>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="actionsToBeTaken">Actions to be Taken:</label>
                            <textarea class="form-control" id="actionsToBeTaken" name = "user_actions_to_be_taken_3"></textarea>
                        </div>
                    </div>


                    <h5>Project Validation</h5>
                    <div class="mb-3 row">
                        <div class="form-group col-md-4">
                            <label for="submittedBy">Submitted By :</label>
                            <input type="text" class="form-control" id="submittedBy" placeholder="Enter name" name = "user_submit_by_1">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="user_designation_1">Designation/Office :</label>
                            <input type="text" class="form-control" id="user_designation_1" placeholder="Enter designation/office" name="user_designation_1">
                        </div>
                    </div>



                    <div class="form-group">
                    <div class="btn-container">
                            <button type="button" class="btn btn-secondary btn-custom" id="cancel_btn">Cancel</button>
                            <button type="submit" class="btn btn-submit btn-custom" id ="submit_btn">Submit</button>
                    </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
