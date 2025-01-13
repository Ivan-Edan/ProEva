<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/admin-evaluation-forms.css"> <!-- Link to your custom CSS file -->
</head>
<body>
    <div id="form5" class="d">
        <div class="card shadow-sm">
            <div class="card-header text-white">
                TRAINING/WORKSHOP CONDUCTED / FACILITATED/ATTENDED BY THE RPMC
            </div>
            <div class="card-body">
                <form id="admin-form-9" data-form-type="adminform5">
                    <div class="details-header">
                        <h5>Title Details</h5>
                    </div>
                    <div class="mb-3 row">
                        <div class="form-group col-md-6">
                            <label for="trainingTitle">Title of Training/Workshop</label>
                            <input type="text" class="form-control" id="trainingTitle" placeholder="Enter title" name="trainingTitle">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="objective">Objective of the Training/Workshop</label>
                            <input type="text" class="form-control" id="objective" placeholder="Enter objective" name="objective">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="form-group col-md-4">
                            <label for="date">Date</label>
                            <input type="date" class="form-control" id="date" placeholder="Enter date" name="date">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="conductedBy">Conducted/Facilitated/Attended</label>
                            <input type="text" class="form-control" id="conductedBy" placeholder="Enter details" name="conductedBy">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="leadOffice">Lead Office/Unit</label>
                            <input type="text" class="form-control" id="leadOffice" placeholder="Enter lead office/unit" name="leadOffice">
                        </div>
                    </div>


                    <div class="mb-3 row">
                        <div class="form-group col-md-12">
                            <label for="participatingOffices">Participating Offices/Agencies/Organizations</label>
                            <input type="text" class="form-control" id="participatingOffices" placeholder="Enter participating offices/agencies/organizations" name="participatingOffices">
                        </div>
                    </div>

                    <h5>Total No. of Participants</h5>
                    <div class="mb-3 row">
                        <div class="form-group col-md-4">
                            <label for="maleParticipants">Male</label>
                            <input type="text" class="form-control" id="maleParticipants" placeholder="Enter number" name="maleParticipants">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="femaleParticipants">Female</label>
                            <input type="text" class="form-control" id="femaleParticipants" placeholder="Enter number" name="femaleParticipants">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="totalParticipants">Total</label>
                            <input type="text" class="form-control" id="totalParticipants" placeholder="Enter total number" name="totalParticipants">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="form-group col-md-12">
                            <label for="resultsFeedback">Results and Feedback</label>
                            <input type="text" class="form-control" id="resultsFeedback" placeholder="Enter results and feedback" style="height: 50px;" name="resultsFeedback">
                        </div>
                    </div>

                    <h5>Project Validation</h5>
                    <div class="mb-3 row">
                        <div class="form-group col-md-4">
                            <label for="submittedBy">Submitted By</label>
                            <input type="text" class="form-control" id="submittedBy" name="submittedBy" placeholder="Enter name">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="designation">Designation/Office</label>
                            <input type="text" class="form-control" id="designation" name="designation" placeholder="Enter designation/office">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="submissionDate">Submission Date</label>
                            <input type="date" class="form-control" id="submissionDate" name="submissionDate" placeholder="Enter date">
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

