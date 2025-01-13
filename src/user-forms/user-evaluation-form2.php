<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/user-evaluation-forms.css"> <!-- Link to your custom CSS file -->
    <title>Physical and Financial Accomplishment Report</title>
</head>
<body>
    <div id="userForm2" class="form-container">
        <div class="card shadow-sm">
            <div class="card-header text-white">
                Physical and Financial Accomplishment Report
                <span id="quarter-display" style="margin-left: 10px; font-weight: bold;"></span>
            </div>
            <div class="card-body">
                <form id="form2-form" data-action="includes/user-submit-form2.php"  method="POST">
                    <h5>Project Details</h5>
                    <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="projectTitle">Program / Project Title:</label>
                        <input type="text" class="form-control" id="projectTitle" name="user_project_title_1" required>
                        <input type="hidden" id="hiddenProjectTitle" name="project_title">
                        <input type="hidden" id="hiddenProjectYear" name="project_year">
                    </div>

                        <div class="col-md-6">
                            <label for="implementingAgency">Implementing Agency:</label>
                            <input type="text" class="form-control" id="implementingAgency" name="user_implementing_agency_1">
                        </div>
                    </div>

                    <h6>Implementation Schedule:</h6>

                    <div class="row mb-3">
                        <div class="col-md-2">
                            <label for="startDate">Start Date:</label>
                            <input type="date" class="form-control" id="startDate" name="user_start_date_2">
                        </div>
                        <div class="col-md-2">
                            <label for="endDate">End Date:</label>
                            <input type="date" class="form-control" id="endDate" name="user_end_date_2">
                        </div>
                        <div class="col-md-2">
                            <label for="fundSource">Fund Source:</label>
                            <input type="text" class="form-control" id="fundSource" name="user_fund_source_1">
                        </div>
                        <div class="col-md-2">
                            <label for="fundingAgency">Funding Agency:</label>
                            <input type="text" class="form-control" id="fundingAgency" name="user_funding_agency_1">
                        </div>
                        <div class="col-md-4">
                            <label for="totalCost">Total Program/Project Cost (PHP):</label>
                            <input type="text" class="form-control" id="totalCost"  name="user_total_cost_2">
                        </div>
                    </div>

                    <h5>Financial Status (in PHP exact figures)</h5>
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="appropriations">Appropriations:</label>
                            <input type="text" class="form-control" id="appropriations" name="user_appropriations_2">
                        </div>
                        <div class="col-md-3">
                            <label for="allotment">Allotment:</label>
                            <input type="text" class="form-control" id="allotment" name="user_allotment_2">
                        </div>
                        <div class="col-md-3">
                            <label for="obligations">Obligations:</label>
                            <input type="text" class="form-control" id="obligations" name="user_obligations_2">
                        </div>
                        <div class="col-md-3">
                            <label for="disbursements">Disbursements:</label>
                            <input type="text" class="form-control" id="disbursements" name="user_disbursements_2">
                        </div>
                    </div>

                    <h5>Physical Accomplishment</h5>
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="targetOWPA">Target OWPA to date (%):</label>
                            <input type="text" class="form-control" id="targetOWPA" name="user_target_owpa_2">
                        </div>
                        <div class="col-md-3">
                            <label for="actualOWPA">Actual OWPA to date (%):</label>
                            <input type="text" class="form-control" id="actualOWPA" name="user_actual_owpa_2">
                        </div>
                        <div class="col-md-2">
                            <label for="slippage">Slippage:</label>
                            <input type="text" class="form-control" id="slippage" name="user_slippage_2">
                        </div>
                        <div class="col-md-4">
                            <label for="outputIndicator">Output Indicator:</label>
                            <input type="text" class="form-control" id="outputIndicator" name="user_output_indicator_2">
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
                                    <input type="text" class="form-control" id="endProjectTarget" name="user_end_project_target_2">
                                </div>
                                <div class="col-md-4">
                                    <label for="targetToDate">Target to date:</label>
                                    <input type="text" class="form-control" id="targetToDate" name="user_target_to_date_2">
                                </div>
                                <div class="col-md-4">
                                    <label for="actualToDate">Actual to date:</label>
                                    <input type="text" class="form-control" id="actualToDate" name="user_actual_to_date_2">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="male">Male:</label>
                                    <input type="text" class="form-control" id="male" name="user_male_2">
                                </div>
                                <div class="col-md-6">
                                    <label for="female">Female:</label>
                                    <input type="text" class="form-control" id="female" name="user_female_2">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="remarks">Remarks:</label>
                            <textarea class="form-control" id="remarks" name="user_remarks_2"></textarea>
                        </div>
                    </div>

                    <h5>Project Validation</h5>
                    <div class="mb-3 row">
                        <div class="form-group col-md-4">
                            <label for="submittedBy">Submitted By :</label>
                            <input type="text" class="form-control" id="submittedBy" placeholder="Enter name" name="user_submitted_by_1">
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
