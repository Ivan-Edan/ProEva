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
                <form id="user_form3" data-action="includes/user-submit-form3.php">
                    <h5>Project Details</h5>
                    <div class="row mb-3">
                        <div class="col-md-5">
                            <label for="projectTitle">Program / Project Title:</label>
                            <input type="text" class="form-control" id="projectTitle" name = "user_project_title_1">
                        </div>
                        <div class="col-md-1">
                            <label for="month">Month:</label>
                            <select class="form-control" id="month"  name = "user_month_3">
                                <option value="January">January</option>
                                <option value="February">February</option>
                                <option value="March">March</option>
                                <option value="April">April</option>
                                <option value="May">May</option>
                                <option value="June">June</option>
                                <option value="July">July</option>
                                <option value="August">August</option>
                                <option value="September">September</option>
                                <option value="October">October</option>
                                <option value="November">November</option>
                                <option value="December">December</option>
                            </select>
                        </div>
                        <div class="col-md-1">
                            <label for="year">Year:</label>
                            <select class="form-control" id="year" name = "user_year_3">
                                <option value="2024">2024</option>
                                <option value="2023">2023</option>
                                <option value="2022">2022</option>
                                <option value="2021">2021</option>
                                <option value="2020">2020</option>
                                <!-- Add more years as needed -->
                            </select>
                        </div>
                        <div class="col-md-1">
                            <label for="quarter">Quarter:</label>
                            <select class="form-control" id="quarter" name = "user_quarter_3">
                                <option value="Q1">Q1</option>
                                <option value="Q2">Q2</option>
                                <option value="Q3">Q3</option>
                                <option value="Q4">Q4</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="implementingAgency">Implementing Agency:</label>
                            <input type="text" class="form-control" id="implementingAgency"  name = "user_implementing_agency_1">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="daRegion">Implementing Agency/NGOs/Concerned Citizens: DA Region IV-A:</label>
                            <input type="text" class="form-control" id="daRegion"  name = "user_da_region_3">
                        </div>
                        <div class="col-md-6">
                            <label for="sector">Sector:</label>
                            <input type="text" class="form-control" id="sector" name = "user_sector_1">
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
                            <input type="text" class="form-control" id="typology" name = "user_typology_3">
                        </div>
                        <div class="col-md-4">
                            <label for="issueStatus">Issue Status:</label>
                            <input type="text" class="form-control" id="issueStatus" name = "user_issue_status_3">
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
                        <!--<div class="form-group col-md-4">
                            <label for="submittedBy">Submitted By :</label>
                            <input type="text" class="form-control" id="submittedBy" placeholder="Enter name">
                        </div>-->
                        <div class="form-group col-md-4">
                            <label for="designation">Designation/Office :</label>
                            <input type="text" class="form-control" id="designation" placeholder="Enter designation/office" name="user_designation_1">

                        </div>
                        <!--<div class="form-group col-md-4">
                            <label for="submissionDate">Date :</label>
                            <input type="text" class="form-control" id="submissionDate" placeholder="Enter date">
                        </div>-->
                    </div>

                    <div class="mb-3 row">
                        <!--<div class="form-group col-md-4">
                            <label for="approvedBy">Approved By :</label>
                            <input type="text" class="form-control" id="approvedBy" placeholder="Enter name">
                        </div>
                        <div class="form-group col-md-4 d-flex align-items-center justify-content-center">
                            <span class="form-control-plaintext text-center" style="margin-top: 24px;">Regional Director</span>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="approvalDate">Date :</label>
                            <input type="text" class="form-control" id="approvalDate" placeholder="Enter date">
                        </div>-->
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
