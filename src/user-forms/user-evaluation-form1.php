<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/user-evaluation-forms.css"> <!-- Link to your custom CSS file -->
    <title>Initial Project Report</title>
</head>
<body>
    <div id="form1" class="form-container">
        <div class="card shadow-sm">
            <div class="card-header text-white ">
                Initial Project Report
            </div>
            <div class="card-body">
                <form>
                    <h5>Project Details</h5>
                    <div class="row mb-3">
                        <div class="col-md-5">
                            <label for="projectTitle">Program / Project Title:</label>
                            <input type="text" class="form-control" id="projectTitle">
                        </div>
                        <div class="col-md-2">
                            <label for="year">Year:</label>
                            <select class="form-control" id="year">
                                <option value="2024">2024</option>
                                <option value="2023">2023</option>
                                <option value="2022">2022</option>
                                <option value="2021">2021</option>
                                <option value="2020">2020</option>
                                <!-- Add more years as needed -->
                            </select>
                        </div>
                        <div class="col-md-5">
                            <label for="implementingAgency">Implementing Agency:</label>
                            <input type="text" class="form-control" id="implementingAgency">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="componentDetails">Component Details:</label>
                            <input type="text" class="form-control" id="componentDetails">
                        </div>
                        <div class="col-md-3">
                            <label for="fundSource">Fund Source:</label>
                            <input type="text" class="form-control" id="fundSource">
                        </div>
                        <div class="col-md-3">
                            <label for="fundingAgency">Funding Agency:</label>
                            <input type="text" class="form-control" id="fundingAgency">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="modeImplementation">Mode of Implementation:</label>
                            <input type="text" class="form-control" id="modeImplementation">
                        </div>
                        <div class="col-md-2">
                            <label for="sector">Sector:</label>
                            <input type="text" class="form-control" id="sector">
                        </div>
                        <div class="col-md-3">
                            <label for="totalCost">Total Program / Project Cost (PHP):</label>
                            <input type="text" class="form-control" id="totalCost">
                        </div>
                        <div class="col-md-2">
                            <label for="startDate">Start Date:</label>
                            <input type="date" class="form-control" id="startDate">
                        </div>
                        <div class="col-md-2">
                            <label for="endDate">End Date:</label>
                            <input type="date" class="form-control" id="endDate">
                        </div>
                    </div>

                    <h5>Location</h5>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="province">Province:</label>
                            <input type="text" class="form-control" id="province">
                        </div>
                        <div class="col-md-4">
                            <label for="city">City/Municipality:</label>
                            <input type="text" class="form-control" id="city">
                        </div>
                        <div class="col-md-4">
                            <label for="barangay">Barangay:</label>
                            <input type="text" class="form-control" id="barangay">
                        </div>
                    </div>

                    <h5>Additional Details</h5>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="remarks">Remarks:</label>
                            <textarea class="form-control" id="remarks"></textarea>
                        </div>
                    </div>

                    <h5>Target Employment Generated</h5>
                    <div class="row mb-3">
                        <div class="col-md-1">
                            <label for="male">Male:</label>
                            <input type="text" class="form-control" id="male">
                        </div>
                        <div class="col-md-1">
                            <label for="female">Female:</label>
                            <input type="text" class="form-control" id="female">
                        </div>
                        <div class="col-md-10">
                            <label for="outputIndicators">Output Indicators:</label>
                            <input type="text" class="form-control" id="outputIndicators">
                        </div>
                    </div>

                    <h5>Year Financial Targets</h5>
                    <div class="row mb-3">
                        <div class="form-group col-md-4 d-flex align-items-center justify-content-left">
                            <span class="form-control-plaintext text-left" style="margin-top: 24px;"  >Total Target for the Year :</span>
                        </div>
                        <div class="col-md-2">
                            <label for="financialTargets">Financial Targets:</label>
                            <input type="text" class="form-control" id="financialTargets">
                        </div>
                        <div class="col-md-6">
                            <label for="physicalTargets">Physical Targets (in %):</label>
                            <input type="text" class="form-control" id="physicalTargets">
                        </div>
                    </div>

                    <h5>Targets of Output</h5>
                    <div class="row mb-3">
                        <div class="col-md-2">
                            <label for="indicator1">Indicator 1:</label>
                            <input type="text" class="form-control" id="indicator1">
                        </div>
                        <div class="col-md-2">
                            <label for="indicator2">Indicator 2:</label>
                            <input type="text" class="form-control" id="indicator2">
                        </div>
                        <div class="col-md-2">
                            <label for="indicator3">Indicator 3:</label>
                            <input type="text" class="form-control" id="indicator3">
                        </div>
                        <div class="col-md-2">
                            <label for="indicator4">Indicator 4:</label>
                            <input type="text" class="form-control" id="indicator4">
                        </div>
                        <div class="col-md-2">
                            <label for="indicator5">Indicator 5:</label>
                            <input type="text" class="form-control" id="indicator5">
                        </div>
                    </div>

                    <h5>Per Month/Quarter Financial Targets</h5>
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="firstStart">1st Starting Date (M/D/Y):</label>
                            <input type="date" class="form-control" id="firstStart">
                        </div>
                        <div class="col-md-3">
                            <label for="firstEnd">1st End Date (M/D/Y):</label>
                            <input type="date" class="form-control" id="firstEnd">
                        </div>
                        <div class="col-md-3">
                            <label for="firstFinancialTargets"> Financial Targets:</label>
                            <input type="text" class="form-control" id="firstFinancialTargets">
                        </div>
                        <div class="col-md-3">
                            <label for="firstPhysicalTargets"> Physical Targets (in %):</label>
                            <input type="text" class="form-control" id="firstPhysicalTargets">
                        </div>
                    </div>
                    
                    <!-- Repeat this structure for 2nd, 3rd, 4th, and 5th months/quarters -->

                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="secondStart">2nd Starting Date (M/D/Y):</label>
                            <input type="date" class="form-control" id="secondStart">
                        </div>
                        <div class="col-md-3">
                            <label for="secondEnd">2nd End Date (M/D/Y):</label>
                            <input type="date" class="form-control" id="secondEnd">
                        </div>
                        <div class="col-md-3">
                            <label for="secondFinancialTargets"> Financial Targets:</label>
                            <input type="text" class="form-control" id="secondFinancialTargets">
                        </div>
                        <div class="col-md-3">
                            <label for="secondPhysicalTargets"> Physical Targets (in %):</label>
                            <input type="text" class="form-control" id="secondPhysicalTargets">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="thirdStart">3rd Starting Date (M/D/Y):</label>
                            <input type="date" class="form-control" id="thirdStart">
                        </div>
                        <div class="col-md-3">
                            <label for="thirdEnd">3rd End Date (M/D/Y):</label>
                            <input type="date" class="form-control" id="thirdEnd">
                        </div>
                        <div class="col-md-3">
                            <label for="thirdFinancialTargets"> Financial Targets:</label>
                            <input type="text" class="form-control" id="thirdFinancialTargets">
                        </div>
                        <div class="col-md-3">
                            <label for="thirdPhysicalTargets"> Physical Targets (in %):</label>
                            <input type="text" class="form-control" id="thirdPhysicalTargets">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="fourthStart">4th Starting Date (M/D/Y):</label>
                            <input type="date" class="form-control" id="fourthStart">
                        </div>
                        <div class="col-md-3">
                            <label for="fourthEnd">4th End Date (M/D/Y):</label>
                            <input type="date" class="form-control" id="fourthEnd">
                        </div>
                        <div class="col-md-3">
                            <label for="fourthFinancialTargets"> Financial Targets:</label>
                            <input type="text" class="form-control" id="fourthFinancialTargets">
                        </div>
                        <div class="col-md-3">
                            <label for="fourthPhysicalTargets"> Physical Targets (in %):</label>
                            <input type="text" class="form-control" id="fourthPhysicalTargets">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="fifthStart">5th Starting Date (M/D/Y):</label>
                            <input type="date" class="form-control" id="fifthStart">
                        </div>
                        <div class="col-md-3">
                            <label for="fifthEnd">5th End Date (M/D/Y):</label>
                            <input type="date" class="form-control" id="fifthEnd">
                        </div>
                        <div class="col-md-3">
                            <label for="fifthFinancialTargets"> Financial Targets:</label>
                            <input type="text" class="form-control" id="fifthFinancialTargets">
                        </div>
                        <div class="col-md-3">
                            <label for="fifthPhysicalTargets"> Physical Targets (in %):</label>
                            <input type="text" class="form-control" id="fifthPhysicalTargets">
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
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
