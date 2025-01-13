<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/admin-evaluation-forms.css"> <!-- Link to your custom CSS file -->
</head>
<body>
    <div id="form5" class="d" data-form-type="adminform1">
        <div class="card shadow-sm">
            <div class="card-header text-white">
                SUMMARY OF FINANCIAL AND PHYSICAL ACCOMPLISHMENTS
            </div>
            <div class="card-body">
                <form id="admin-form-5" data-form-type="adminform1">
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
                            <label for="implementingAgency">Implementing Agency</label>
                            <input type="text" class="form-control" id="implementingAgency" name="implementingAgency" placeholder="Enter agency">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="col-md-6">
                            <label for="startDate">Start Date:</label>
                            <input type="date" class="form-control" id="startDate" name="startDate" placeholder="Enter start date">
                        </div>
                        <div class="col-md-6">
                            <label for="endDate">End Date:</label>
                            <input type="date" class="form-control" id="endDate" name="endDate" placeholder="Enter end date">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="form-group col-md-4">
                            <label for="sector">Sector</label>
                            <select id="sector" class="form-control" name="sector">
                                    <option value=" General Public Services"> General Public Services</option>
                                    <option value=" Social Services"> Social Services</option>
                                    <option value="Economic Services">Economic Services</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="fundSource">Fund Source</label>
                            <select id="fundSource" class="form-control" name="fundSource">
                                    <option value="ODA Loan">ODA Loan</option>
                                    <option value="ODA Grant">ODA Grant</option>
                                    <option value="Oda loan and Grant">Oda loan and Grant</option>
                                    <option value="LFP">LFP</option>
                                    <option value="PPP">PPP</option>
                                    <option value="NTA">NTA</option>
                                    <option value="Local Development Fund">Local Development Fund</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="fundingAgency">Funding Agency</label>
                            <input type="text" class="form-control" id="fundingAgency" name="fundingAgency" placeholder="Enter funding agency">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="form-group col-md-12">
                            <label for="projectCost">Total Program/Project Cost (PHP)</label>
                            <input type="text" class="form-control" id="projectCost" name="projectCost" placeholder="Enter project cost">
                        </div>
                    </div>

                    <h5>Financial Status (in PHP exact figures)</h5>
                    <div class="mb-3 row">
                        <div class="form-group col-md-3">
                            <label for="appropriations">Appropriations</label>
                            <input type="text" class="form-control" id="appropriations"  name="appropriations" placeholder="Enter appropriations">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="allotment">Allotment</label>
                            <input type="text" class="form-control" id="allotment" name="allotment" placeholder="Enter allotment"> 
                        </div>
                        <div class="form-group col-md-3">
                            <label for="obligations">Obligations</label>
                            <input type="text" class="form-control" id="obligations"  name="obligations" placeholder="Enter obligations">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="disbursements">Disbursements</label>
                            <input type="text" class="form-control" id="disbursements" name="disbursements" placeholder="Enter disbursements">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="form-group col-md-6">
                            <label for="fundingSupport">Funding Support (%)</label>
                            <input type="text" class="form-control" id="fundingSupport" name="fundingSupport" placeholder="Enter funding support percentage">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="fundUtilization">Fund Utilization (%)</label>
                            <input type="text" class="form-control" id="fundUtilization" name="fundUtilization" placeholder="Enter fund utilization percentage">
                        </div>
                    </div>

                    <h5>Physical Accomplishment</h5>
                    <div class="mb-3 row">
                        <div class="form-group col-md-3">
                            <label for="targetOWPA">Target OWPA to date (%)</label>
                            <input type="text" class="form-control" id="targetOWPA" name="targetOWPA" placeholder="Enter target OWPA percentage">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="actualOWPA">Actual OWPA to date (%)</label>
                            <input type="text" class="form-control" id="actualOWPA" name="actualOWPA" placeholder="Enter actual OWPA percentage">
                        </div>
                        <div class="form-group col-md-1">
                            <label for="slippage">Slippage</label>
                            <input type="text" class="form-control" id="slippage" name="slippage" placeholder="Enter slippage percentage">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="targetEmployment" class="form-control-plaintext text-center align-middle" style="margin-top: 24px;">Target Employment Generated</label>
                        </div>
                        <div class="form-group col-md-1">
                            <label for="male">Male</label>
                            <input type="text" class="form-control" id="male" style="width: 75px;" name="male" placeholder="Enter male employment">
                        </div>
                        <div class="form-group col-md-1">
                            <label for="female">Female</label>
                            <input type="text" class="form-control" id="female" style="width: 75px;" name="female" placeholder="Enter female employment">
                        </div>
                    </div>
                    <h5>Additional Details</h5>
                    <div class="mb-3 row">
                        <div class="form-group col-md-12">
                            <label for="remarks">Remarks</label>
                            <select id="remarks" class="form-control" name="remarks">
                                <option>Ongoing</option>
                                <option>Completed</option>
                            </select>
                        </div>
                    </div>
                    <h5>Project Validation</h5>
                    <div class="mb-3 row">
                        <div class="form-group col-md-4">
                            <label for="submittedBy">Submitted By</label>
                            <input type="text" class="form-control" id="submittedBy"  name="submittedBy" placeholder="Enter name">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="designation">Designation/Office</label>
                            <input type="text" class="form-control" id="designation" name="designation" placeholder="Enter designation/office">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="submissionDate">Submission Date</label>
                            <input type="date" class="form-control" id="submissionDate" name="submissionDate" placeholder="Enter submission date">
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
