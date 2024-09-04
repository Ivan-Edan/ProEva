<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/admin-evaluation-forms.css"> <!-- Link to your custom CSS file -->
</head>
<body>
    <div id="form4" class="d">
        <div class="card shadow-sm">
            <div class="card-header text-white">
                TRAINING/WORKSHOP CONDUCTED / FACILITATED/ATTENDED BY THE RPMC
            </div>
            <div class="card-body">
                <form>
                    <div class="details-header">
                        <h5>Title Details</h5>
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="departmentDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                Departments
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="departmentDropdown">
                                <li>
                                    <input type="text" class="form-control" id="searchField" name="searchField" placeholder="Search">
                                </li>
                                <li><a class="dropdown-item" href="#">DSWD</a></li>
                                <li><a class="dropdown-item" href="#">NDRRMC</a></li>
                                <li><a class="dropdown-item" href="#">CPDO</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="form-group col-md-6">
                            <label for="trainingTitle">Title of Training/Workshop</label>
                            <input type="text" class="form-control" id="trainingTitle" placeholder="Enter title">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="year">Year</label>
                            <input type="text" class="form-control" id="year" placeholder="Enter year">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="form-group col-md-6">
                            <label for="location">Location</label>
                            <input type="text" class="form-control" id="location" placeholder="Enter location">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="date">Date</label>
                            <input type="text" class="form-control" id="date" placeholder="Enter date">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="conductedBy">Conducted/Facilitated/Attended</label>
                            <input type="text" class="form-control" id="conductedBy" placeholder="Enter details">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="form-group col-md-12">
                            <label for="objective">Objective of the Training/Workshop</label>
                            <input type="text" class="form-control" id="objective" placeholder="Enter objective" style="height: 100px;">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="form-group col-md-4">
                            <label for="leadOffice">Lead Office/Unit</label>
                            <input type="text" class="form-control" id="leadOffice" placeholder="Enter lead office/unit">
                        </div>
                        <div class="form-group col-md-8">
                            <label for="participatingOffices">Participating Offices/Agencies/Organizations</label>
                            <input type="text" class="form-control" id="participatingOffices" placeholder="Enter participating offices/agencies/organizations">
                        </div>
                    </div>

                    <h5>Total No. of Participants</h5>
                    <div class="mb-3 row">
                        <div class="form-group col-md-2">
                            <label for="maleParticipants">Male</label>
                            <input type="text" class="form-control" id="maleParticipants" placeholder="Enter number">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="femaleParticipants">Female</label>
                            <input type="text" class="form-control" id="femaleParticipants" placeholder="Enter number">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="totalParticipants">Total</label>
                            <input type="text" class="form-control" id="totalParticipants" placeholder="Enter total number">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="form-group col-md-12">
                            <label for="resultsFeedback">Results and Feedback</label>
                            <input type="text" class="form-control" id="resultsFeedback" placeholder="Enter results and feedback" style="height: 100px;">
                        </div>
                    </div>

                    <h5>Project Validation</h5>
                    <div class="mb-3 row">
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

                    <div class="mb-3 row">
                        <div class="form-group col-md-4">
                            <label for="approvedBy">Approved By</label>
                            <input type="text" class="form-control" id="approvedBy" placeholder="Enter name">
                        </div>
                        <div class="form-group col-md-4 d-flex align-items-center justify-content-center">
                            <span class="form-control-plaintext text-center" style="margin-top: 24px;">Regional Director</span>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="approvalDate">Date</label>
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
