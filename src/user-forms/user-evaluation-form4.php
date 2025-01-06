<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/user-evaluation-forms.css"> <!-- Link to your custom CSS file -->
    <title>Project Results Form</title>
</head>
<body>
    <div id="userForm4" class="form-container">
        <div class="card shadow-sm">
            <div class="card-header text-white">
                PROJECT RESULTS
            </div>
            <div class="card-body">
                <form id="form4-form" data-action="includes/user-submit-form4.php" method="POST">
                    <h5>Project Details</h5>

                    <div class="mb-3 row">
                        <div class="form-group col-md-6">
                        <label for="projectTitle">Program / Project Title:</label>
                        <input type="text" class="form-control" id="projectTitle" name="user_project_title_1" required>
                        <input type="hidden" id="hiddenProjectTitle" name="project_title">
                        <input type="hidden" id="hiddenProjectYear" name="project_year">
                        </div>


                        <div class="form-group col-md-6">
                            <label for="implementingAgency">Implementing Agency :</label>
                            <input type="text" class="form-control" id="implementingAgency" placeholder="Enter implementing agency" name="user_implementing_agency_1">
                        </div>
                    </div>

                    <!-- Additional Details -->
                    <h5>Additional Details</h5>

                    <div class="mb-3 row">
                        <div class="form-group col-md-12">
                            <label for="objectives">Program/Project Objectives :</label>
                            <input type="text" class="form-control" id="objectives" placeholder="Enter objectives" style="height: 100px;" name="user_objectives_4">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="form-group col-md-12">
                            <label for="resultIndicator">Results/Outcome Indicator/Target :</label>
                            <input type="text" class="form-control" id="resultIndicator" placeholder="Enter indicator/target" style="height: 100px;" name="user_result_indicator_4">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="form-group col-md-12">
                            <label for="observedResults">Observed Results/Outcome/Impact :</label>
                            <input type="text" class="form-control" id="observedResults" placeholder="Enter results/outcome/impact" style="height: 100px;" name="user_observed_results_4">
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
                            <input type="text" class="form-control" id="designation" placeholder="Enter designation/office" name="user_designation_1">

                        </div>
                        <div class="form-group col-md-4">
                            <label for="submissionDate">Date :</label>
                            <input type="date" class="form-control" id="submissionDate" placeholder="Enter date">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="form-group col-md-4">
                            <label for="approvedBy">Approved By :</label>
                            <input type="text" class="form-control" id="approvedBy" placeholder="Enter name">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="approvalDate">Date :</label>
                            <input type="date" class="form-control" id="approvalDate" placeholder="Enter date">
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
