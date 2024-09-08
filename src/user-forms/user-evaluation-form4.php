<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/user-evaluation-forms.css"> <!-- Link to your custom CSS file -->
    <title>Project Results Form</title>
</head>
<body>
    <div id="form4" class="form-container">
        <div class="card shadow-sm">
            <div class="card-header text-white">
                PROJECT RESULTS
            </div>
            <div class="card-body">
                <form>
                    <h5>Project Details</h5>

                    <div class="mb-3 row">
                        <div class="form-group col-md-4">
                            <label for="projectTitle">Program / Project Title :</label>
                            <input type="text" class="form-control" id="projectTitle" placeholder="Enter title">
                        </div>
                        <div class="col-md-2">
                            <label for="month">Month:</label>
                            <select class="form-control" id="month">
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
                        <div class="form-group col-md-4">
                            <label for="implementingAgency">Implementing Agency :</label>
                            <input type="text" class="form-control" id="implementingAgency" placeholder="Enter implementing agency">
                        </div>
                    </div>

                    <!-- Additional Details -->
                    <h5>Additional Details</h5>

                    <div class="mb-3 row">
                        <div class="form-group col-md-12">
                            <label for="objectives">Program/Project Objectives :</label>
                            <input type="text" class="form-control" id="objectives" placeholder="Enter objectives" style="height: 100px;">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="form-group col-md-12">
                            <label for="resultIndicator">Results/Outcome Indicator/Target :</label>
                            <input type="text" class="form-control" id="resultIndicator" placeholder="Enter indicator/target" style="height: 100px;">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="form-group col-md-12">
                            <label for="observedResults">Observed Results/Outcome/Impact :</label>
                            <input type="text" class="form-control" id="observedResults" placeholder="Enter results/outcome/impact" style="height: 100px;">
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
                            <span class="form-control-plaintext text-center" style="margin-top: 24px;">Michelle F. Mapua</span>
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
