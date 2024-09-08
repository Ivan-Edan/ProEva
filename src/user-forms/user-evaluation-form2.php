<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/user-evaluation-forms.css"> <!-- Link to your custom CSS file -->
    <title>Physical and Financial Accomplishment Report</title>
</head>
<body>
    <div id="form2" class="form-container">
        <div class="card shadow-sm">
            <div class="card-header text-white">
                Physical and Financial Accomplishment Report
            </div>
            <div class="card-body">
                <form>
                    <h5>Project Details</h5>
                    <div class="row mb-3">
                        <div class="col-md-5">
                            <label for="projectTitle">Program / Project Title:</label>
                            <input type="text" class="form-control" id="projectTitle">
                        </div>
                        <div class="col-md-1">
                            <label for="month">Month:</label>
                            <input type="text" class="form-control" id="month">
                        </div>
                        <div class="col-md-1">
                            <label for="year">Year:</label>
                            <input type="text" class="form-control" id="year">
                        </div>
                        <div class="col-md-1">
                            <label for="quarter">Quarter:</label>
                            <input type="text" class="form-control" id="quarter">
                        </div>
                        <div class="col-md-4">
                            <label for="implementingAgency">Implementing Agency:</label>
                            <input type="text" class="form-control" id="implementingAgency">
                        </div>
                    </div>

                    <h6>Implementation Schedule:</h6>

                    <div class="row mb-3">
                        <div class="col-md-2">
                            <label for="startDate">Start Date:</label>
                            <input type="date" class="form-control" id="startDate">
                        </div>
                        <div class="col-md-2">
                            <label for="endDate">End Date:</label>
                            <input type="date" class="form-control" id="endDate">
                        </div>
                        <div class="col-md-2">
                            <label for="fundSource">Fund Source:</label>
                            <input type="text" class="form-control" id="fundSource">
                        </div>
                        <div class="col-md-2">
                            <label for="fundingAgency">Funding Agency:</label>
                            <input type="text" class="form-control" id="fundingAgency">
                        </div>
                        <div class="col-md-4">
                            <label for="totalCost">Total Program/Project Cost (PHP):</label>
                            <input type="text" class="form-control" id="totalCost">
                        </div>
                    </div>

                    <h5>Financial Status (in PHP exact figures)</h5>
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="appropriations">Appropriations:</label>
                            <input type="text" class="form-control" id="appropriations">
                        </div>
                        <div class="col-md-3">
                            <label for="allotment">Allotment:</label>
                            <input type="text" class="form-control" id="allotment">
                        </div>
                        <div class="col-md-3">
                            <label for="obligations">Obligations:</label>
                            <input type="text" class="form-control" id="obligations">
                        </div>
                        <div class="col-md-3">
                            <label for="disbursements">Disbursements:</label>
                            <input type="text" class="form-control" id="disbursements">
                        </div>
                    </div>

                    <h5>Physical Accomplishment</h5>
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="targetOWPA">Target OWPA to date (%):</label>
                            <input type="text" class="form-control" id="targetOWPA">
                        </div>
                        <div class="col-md-3">
                            <label for="actualOWPA">Actual OWPA to date (%):</label>
                            <input type="text" class="form-control" id="actualOWPA">
                        </div>
                        <div class="col-md-2">
                            <label for="slippage">Slippage:</label>
                            <input type="text" class="form-control" id="slippage">
                        </div>
                        <div class="col-md-4">
                            <label for="outputIndicator">Output Indicator:</label>
                            <input type="text" class="form-control" id="outputIndicator">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-8">
                            <h5>Additional Details</h5>
                        </div>
                        <div class="col-md-4">
                            <h6>Employment Generated</h6>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="endProjectTarget">End-of-Project Target:</label>
                                    <input type="text" class="form-control" id="endProjectTarget">
                                </div>
                                <div class="col-md-4">
                                    <label for="targetToDate">Target to date:</label>
                                    <input type="text" class="form-control" id="targetToDate">
                                </div>
                                <div class="col-md-4">
                                    <label for="actualToDate">Actual to date:</label>
                                    <input type="text" class="form-control" id="actualToDate">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="male">Male:</label>
                                    <input type="text" class="form-control" id="male">
                                </div>
                                <div class="col-md-6">
                                    <label for="female">Female:</label>
                                    <input type="text" class="form-control" id="female">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="remarks">Remarks:</label>
                            <textarea class="form-control" id="remarks"></textarea>
                        </div>
                    </div>

                    <h5>Project Validation</h5>
                    <div class="mb-3 row">
                        <div class="form-group col-md-4">
                            <label for="submittedBy">Submitted By :</label>
                            <input type="text" class="form-control" id="submittedBy" placeholder="Enter name">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="designation">Designation/Office :</label>
                            <input type="text" class="form-control" id="designation" placeholder="Enter designation/office">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="submissionDate">Date :</label>
                            <input type="text" class="form-control" id="submissionDate" placeholder="Enter date">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="form-group col-md-4">
                            <label for="approvedBy">Approved By :</label>
                            <input type="text" class="form-control" id="approvedBy" placeholder="Enter name">
                        </div>
                        <div class="form-group col-md-4 d-flex align-items-center justify-content-center">
                            <span class="form-control-plaintext text-center" style="margin-top: 24px;">Regional Director</span>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="approvalDate">Date :</label>
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
