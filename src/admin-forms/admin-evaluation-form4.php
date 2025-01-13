<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/admin-evaluation-forms.css"> <!-- Link to your custom CSS file -->
    <title>Problem Solving Sessions / Facilitation Meeting Conducted</title>
</head>
<body>
    <div id="form8" class="d" data-form-type="adminform4">
        <div class="card shadow-sm">
            <div class="card-header text-white">
                Problem Solving Sessions / Facilitation Meeting Conducted
            </div>
            <div class="card-body">
                <form id="admin-form-8" data-form-type="adminform4">
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
                            <label for="issueDetails">Issue Details</label>
                            <input type="text" class="form-control" id="issueDetails" name="issueDetails" placeholder="Enter issue details">
                        </div>
                    </div>

                    <div class="mb-3 row">
                    <div class="form-group col-md-6">
                            <label for="issueTypology">Issue Typology :</label>
                            <select id="issueTypology" class="form-control" placeholder="Select Issue Typology" name="issueTypology">
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
                        <div class="form-group col-md-6">
                            <label for="IA">IA</label>
                            <input type="text" class="form-control" id="IA" placeholder="Enter IA" name="IA">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="form-group col-md-12">
                            <label for="location">Location</label>
                            <input type="text" class="form-control" id="location" placeholder="Enter location" style="height: 50px;" name="location">
                        </div>
                    </div>
                    <h5>Additional Information</h5>


                    <div class="mb-3 row">
                        <div class="form-group col-md-6">
                            <label for="dateOfMeeting">Date of Meeting</label>
                            <input type="date" class="form-control" id="dateOfMeeting" placeholder="Enter date of meeting" name="dateOfMeeting">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="concernedAgencies">Concerned Agencies</label>
                            <input type="text" class="form-control" id="concernedAgencies" placeholder="Enter concerned agencies" name="concernedAgencies">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="form-group col-md-12">
                            <label for="agreementsReached">Agreements Reached</label>
                            <input type="text" class="form-control" id="agreementsReached" placeholder="Enter agreements reached" style="height: 50px;" name="agreementsReached">
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


