<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/admin-evaluation-forms.css"> <!-- Link to the CSS file -->
</head>
<body>
    <div id="form1" class="d">
        <div class="card shadow-sm">
            <div class="card-header text-white">
                Report on the Status of Projects Encountering Implementation Problems
            </div>
            <div class="card-body">
                <form>
                    <h5>Project Details</h5>
                        <div class="form-group">
                            <div class="row">
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
                                        <!-- Add other months -->
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
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="location">Location</label>
                                    <input type="text" class="form-control" id="location" placeholder="Enter location">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="IA">IA</label>
                                    <input type="text" class="form-control" id="IA" placeholder="Enter IA">
                                </div>
                                <div class="form-group col-md-3 ">
                                    <label for="fundUtilization">Fund Utilization(%)</label>
                                    <input type="text" class="form-control" id="fundUtilization" placeholder="Enter fund utilization">
                                </div>
                            </div>
                        </div>
                    <h5>Physical Accomplishment</h5>
                    <div class="form-group">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="targetOWPA">Target OWPA to Date (%)</label>
                                <input type="text" class="form-control" id="targetOWPA" placeholder="Enter target OWPA">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="actualOWPA">Actual OWPA to Date (%)</label>
                                <input type="text" class="form-control" id="actualOWPA" placeholder="Enter actual OWPA">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="slippage">Slippage</label>
                                <input type="text" class="form-control" id="slippage" placeholder="Enter slippage">
                            </div>
                        </div>
                    </div>
                    <h5>Additional Information</h5>
                    <div class="form-group">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="issueDetails">Issue Details</label>
                                <input type="text" class="form-control" id="issueDetails" placeholder="Enter issue details"style="height: 100px;">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="issueTypology">Issue Typology</label>
                                <input type="text" class="form-control" id="issueTypology" placeholder="Enter issue typology">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="issueStatus">Issue Status</label>
                                <input type="text" class="form-control" id="issueStatus" placeholder="Enter issue status">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="sourceOfInfo">Source of Information</label>
                                <input type="text" class="form-control" id="sourceOfInfo" placeholder="Enter source of information">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="actionTaken">Action Taken</label>
                                <input type="text" class="form-control" id="actionTaken" placeholder="Enter action taken"style="height: 100px;">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="actionsToBeTaken">Actions to be Taken</label>
                                <input type="text" class="form-control" id="actionsToBeTaken" placeholder="Enter actions to be taken"style="height: 100px;">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for="NPMCAction">For NPMC Action (Y/N)</label>
                                <select id="NPMCAction" class="form-control">
                                    <option>Yes</option>
                                    <option>No</option>
                                </select>
                            </div>
                            <div class="form-group col-md-9">
                                <label for="requestedAction">Requested Action from the NPMC</label>
                                <input type="text" class="form-control" id="requestedAction" placeholder="Enter requested action">
                            </div>
                        </div>
                    </div>
                    <h5>Project Validation</h5>
                    <div class="form-group">
                        <div class="row">
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
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="approvedBy">Approved By</label>
                                <input type="text" class="form-control" id="approvedBy" placeholder="Enter name">
                            </div>
                            <div class="form-group col-md-4 d-flex align-items-center">
                                <label for="regionalDirector" class="form-control-plaintext text-center align-middle" style="margin-top: 24px;">Regional Director</label>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="approvalDate">Date</label>
                                <input type="text" class="form-control" id="approvalDate" placeholder="Enter date">
                            </div>
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
