<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/user-evaluation-forms.css"> <!-- Link to your custom CSS file -->
    <link rel="stylesheet" href="styles/main.css">
    <title>Initial Project Report</title>
</head>
<body>
    <div id="userForm1" class="form-container">
        <div class="card shadow-sm">
            <div class="card-header text-white ">
                Initial Project Report
            </div>
            <div class="card-body">
                <form id="user_form1" data-action="includes/user-submit-form1.php">
                    <h5>Project Details</h5>
                    <div class="row mb-3">
                        <div class="col-md-5">
                            <label for="project_title">Program / Project Title:</label>
                            <input type="text" class="form-control" id="user_project_title_1" name="user_project_title_1" required>
                        </div>
                        <div class="col-md-2">
                            <label for="year">Year:</label>
                            <select class="form-control" id="user_year_1" name="user_year_1">
                                <option value="2024">2024</option>
                                <option value="2023">2023</option>
                                <option value="2022">2022</option>
                                <option value="2021">2021</option>
                                <option value="2020">2020</option>
                            </select>
                        </div>
                        <div class="col-md-5">
                            <label for="implementing_agency">Implementing Agency:</label>
                            <input type="text" class="form-control" id="user_implementing_agency_1" name="user_implementing_agency_1" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="component_details">Component Details:</label>
                            <input type="text" class="form-control" id="user_component_details_1" name="user_component_details_1" required>
                        </div>
                        <div class="col-md-3">
                            <label for="fund_source">Fund Source:</label>
                            <input type="text" class="form-control" id="user_fund_source_1" name="user_fund_source_1" required>
                        </div>
                        <div class="col-md-3">
                            <label for="funding_agency">Funding Agency:</label>
                            <input type="text" class="form-control" id="user_funding_agency_1" name="user_funding_agency_1" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="mode_implementation">Mode of Implementation:</label>
                            <input type="text" class="form-control" id="user_mode_implementation_1" name="user_mode_implementation_1" required>
                        </div>
                        <div class="col-md-2">
                            <label for="sector">Sector:</label>
                            <input type="text" class="form-control" id="user_sector_1" name="user_sector_1" required>
                        </div>
                        <div class="col-md-3">
                            <label for="total_cost">Total Program / Project Cost (PHP):</label>
                            <input type="text" class="form-control" id="user_total_cost_1" name="user_total_cost_1" required>
                        </div>
                        <div class="col-md-2">
                            <label for="start_date">Start Date:</label>
                            <input type="date" class="form-control" id="user_start_date_1" name="user_start_date_1" required>
                        </div>
                        <div class="col-md-2">
                            <label for="end_date">End Date:</label>
                            <input type="date" class="form-control" id="user_end_date_1" name="user_end_date_1" required>
                        </div>
                    </div>

                    <h5>Location</h5>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="province">Province:</label>
                            <input type="text" class="form-control" id="user_province_1" name="user_province_1" required>
                        </div>
                        <div class="col-md-4">
                            <label for="city">City/Municipality:</label>
                            <input type="text" class="form-control" id="user_city_1" name="user_city_1" required>
                        </div>
                        <div class="col-md-4">
                            <label for="barangay">Barangay:</label>
                            <input type="text" class="form-control" id="user_barangay_1" name="user_barangay_1" required>
                        </div>
                    </div>

                    <h5>Additional Details</h5>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="remarks">Remarks:</label>
                            <textarea class="form-control" id="user_remarks_1" name="user_remarks_1" required></textarea>
                        </div>
                    </div>

                    <h5>Target Employment Generated</h5>
                    <div class="row mb-3">
                        <div class="col-md-1">
                            <label for="male">Male:</label>
                            <input type="text" class="form-control" id="user_male_1" name="user_male_1" required>
                        </div>
                        <div class="col-md-1">
                            <label for="female">Female:</label>
                            <input type="text" class="form-control" id="user_female_1" name="user_female_1" required>
                        </div>
                        <div class="col-md-10">
                            <label for="output_indicators">Output Indicators:</label>
                            <input type="text" class="form-control" id="user_output_indicators_1" name="user_output_indicators_1" required>
                        </div>
                    </div>

                    <h5>Year Financial Targets</h5>
                    <div class="row mb-3">
                        <div class="form-group col-md-4 d-flex align-items-center justify-content-left">
                            <span class="form-control-plaintext text-left" style="margin-top: 24px;"  >Total Target for the Year :</span>
                        </div>
                        <div class="col-md-2">
                            <label for="financial_targets">Financial Targets:</label>
                            <input type="text" class="form-control" id="user_financial_targets_1" name="user_financial_targets_1" required>
                        </div>
                        <div class="col-md-6">
                            <label for="physical_targets">Physical Targets (in %):</label>
                            <input type="text" class="form-control" id="user_physical_targets_1" name="user_physical_targets_1" required>
                        </div>
                    </div>
                    <h5>Targets of Output</h5>
                    <div class="row mb-3">
                        <div class="col-md-2">
                            <label for="indicator_1">Indicator 1:</label>
                            <input type="text" class="form-control" id="user_indicator_1_1" name="user_indicator_1_1" required>
                        </div>
                        <div class="col-md-2">
                            <label for="indicator_2">Indicator 2:</label>
                            <input type="text" class="form-control" id="user_indicator_2_1" name="user_indicator_2_1" required>
                        </div>
                        <div class="col-md-2">
                            <label for="indicator_3">Indicator 3:</label>
                            <input type="text" class="form-control" id="user_indicator_3_1" name="user_indicator_3_1" required>
                        </div>
                        <div class="col-md-2">
                            <label for="indicator_4">Indicator 4:</label>
                            <input type="text" class="form-control" id="user_indicator_4_1" name="user_indicator_4_1" required>
                        </div>
                        <div class="col-md-2">
                            <label for="indicator_5">Indicator 5:</label>
                            <input type="text" class="form-control" id="user_indicator_5_1" name="user_indicator_5_1" required>
                        </div>
                    </div>

                    <h5>Per Month/Quarter Financial Targets</h5>
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="first_start">1st Starting Date (M/D/Y):</label>
                            <input type="date" class="form-control" id="user_first_start_1" name="user_first_start_1" required>
                        </div>
                        <div class="col-md-3">
                            <label for="first_end">1st End Date (M/D/Y):</label>
                            <input type="date" class="form-control" id="user_first_end_1" name="user_first_end_1" required>
                        </div>
                        <div class="col-md-3">
                            <label for="first_financial_targets"> Financial Targets:</label>
                            <input type="text" class="form-control" id="user_first_financial_targets_1" name="user_first_financial_targets_1" required>
                        </div>
                        <div class="col-md-3">
                            <label for="first_physical_targets"> Physical Targets (in %):</label>
                            <input type="text" class="form-control" id="user_first_physical_targets_1" name="user_first_physical_targets_1" required>
                        </div>
                    </div>
                    
                    <!-- Repeat this structure for 2nd, 3rd, 4th, and 5th months/quarters -->

                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="second_start">2nd Starting Date (M/D/Y):</label>
                            <input type="date" class="form-control" id="user_second_start_1" name="user_first_start_2" required>
                        </div>
                        <div class="col-md-3">
                            <label for="second_end">2nd End Date (M/D/Y):</label>
                            <input type="date" class="form-control" id="user_second_end_1" name="user_first_end_2" required>
                        </div>
                        <div class="col-md-3">
                            <label for="second_financial_targets"> Financial Targets:</label>
                            <input type="text" class="form-control" id="user_second_financial_targets_1" name="user_first_financial_targets_2" required>
                        </div>
                        <div class="col-md-3">
                            <label for="second_physical_targets"> Physical Targets (in %):</label>
                            <input type="text" class="form-control" id="user_second_physical_targets_1" name="user_first_physical_targets_2" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="third_start">3rd Starting Date (M/D/Y):</label>
                            <input type="date" class="form-control" id="user_third_start_1" name="user_first_start_3" required>
                        </div>
                        <div class="col-md-3">
                            <label for="third_end">3rd End Date (M/D/Y):</label>
                            <input type="date" class="form-control" id="user_third_end_1" name="user_first_end_3" required>
                        </div>
                        <div class="col-md-3">
                            <label for="third_financial_targets"> Financial Targets:</label>
                            <input type="text" class="form-control" id="user_third_financial_targets_1" name="user_first_financial_targets_3" required>
                        </div>
                        <div class="col-md-3">
                            <label for="third_physical_targets"> Physical Targets (in %):</label>
                            <input type="text" class="form-control" id="user_third_physical_targets_1" name="user_first_physical_targets_3" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="fourth_start">4th Starting Date (M/D/Y):</label>
                            <input type="date" class="form-control" id="user_fourth_start_1" name="user_first_start_4" required>
                        </div>
                        <div class="col-md-3">
                            <label for="fourth_end">4th End Date (M/D/Y):</label>
                            <input type="date" class="form-control" id="user_fourth_end_1" name="user_first_end_4" required>
                        </div>
                        <div class="col-md-3">
                            <label for="fourth_financial_targets"> Financial Targets:</label>
                            <input type="text" class="form-control" id="user_fourth_financial_targets_1" name="user_first_financial_targets_4" required>
                        </div>
                        <div class="col-md-3">
                            <label for="fourth_physical_targets"> Physical Targets (in %):</label>
                            <input type="text" class="form-control" id="user_fourth_physical_targets_1" name="user_first_physical_targets_4" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="fifth_start">5th Starting Date (M/D/Y):</label>
                            <input type="date" class="form-control" id="user_fifth_start_1" name="user_first_start_5" required>
                        </div>
                        <div class="col-md-3">
                            <label for="fifth_end">5th End Date (M/D/Y):</label>
                            <input type="date" class="form-control" id="user_fifth_end_1" name="user_first_end_5" required>
                        </div>
                        <div class="col-md-3">
                            <label for="fifth_financial_targets"> Financial Targets:</label>
                            <input type="text" class="form-control" id="user_fifth_financial_targets_1" name="user_first_financial_targets_5" required>
                        </div>
                        <div class="col-md-3">
                            <label for="fifth_physical_targets"> Physical Targets (in %):</label>
                            <input type="text" class="form-control" id="user_fifth_physical_targets_1" name="user_first_physical_targets_5" required>
                        </div>
                    </div>

                    <h5>Project Validation</h5>
                    <div class="mb-3 row">
                        <!--<div class="form-group col-md-4"> 
                            <label for="submitted_by">Submitted By :</label>
                            <input type="text" class="form-control" id="user_submitted_by_1" placeholder="Enter name" name="user_submitted_by_1" required>
                        </div>-->
                        <div class="form-group col-md-4">
                            <label for="designation">Designation/Office :</label>
                            <input type="text" class="form-control" id="user_designation_1" placeholder="Enter designation/office" name="user_designation_1" required>
                        </div>
                         <!--<div class="form-group col-md-4">
                            <label for="submission_date">Date :</label>
                            <input type="date" class="form-control" id="user_submission_date_1" placeholder="Enter date" name="user_submission_date_1" required>
                        </div>-->
                    </div>

                    <!--<div class="mb-3 row">
                        <div class="form-group col-md-4">
                            <label for="approved_by">Approved By :</label>
                            <input type="text" class="form-control" id="user_approved_by_1" placeholder="Enter name" name="user_approved_by_1" required>
                        </div>
                        <div class="form-group col-md-4 d-flex align-items-center justify-content-center">
                            <span class="form-control-plaintext text-center" style="margin-top: 24px;">Regional Director</span>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="approval_date">Date :</label>
                            <input type="date" class="form-control" id="user_approval_date_1" placeholder="Enter date" name="user_approval_date_1" required>
                        </div>
                    </div>-->

                    <div class="form-group">
                        <div class="btn-container">
                            <button type="button" class="btn btn-secondary btn-custom" id="cancel_btn">Cancel</button>
                            <button type="submit" class="btn btn-submit btn-custom" id ="submit_btn">Submit</button>
                        </div>
                    </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
