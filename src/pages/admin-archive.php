<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="<?php echo 'images/landing-pic.png'; ?>">
    <title>Archive Page</title>
    <?php include 'includes/admin-archive-modal.php'; ?><!-- Fetches the submittedForm files modal -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="styles/admin-archive.css">
    <link rel="stylesheet" href="styles/user-archive.css">
</head>
<body>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="container-1">Archive</div>
                <!-- Filter Dropdown -->
                <div class="form-group mb-3">
                    <label for="filterDropdown"></label>
                    <select id="filterDropdown" class="form-control w-25">
                        <option value="all">All Forms</option>
                        <option value="form1">Form1: INITIAL PROJECT REPORT</option>
                        <option value="form2">Form2: FINANCIAL & PHYSICAL ACCOMPLISHMENTS</option>
                        <option value="form3">Form3: EXCEPTION REPORT</option>
                        <option value="form4">Form4: PROJECT RESULTS</option>
                        <option value="adminform1">Form5: SUMMARY OF FINANCIAL AND PHYSICAL ACCOMPLISMENTS</option>
                        <option value="adminform2">Form6: Report on the Status of Projects Encountering Implementation Problems</option>
                        <option value="adminform3">Form7: Project Inspection Report</option>
                        <option value="adminform4">Form8: Problem Solving Sessions / Facilitation Meeting Conducted</option>
                        <option value="adminform5">Form9: TRAINING/WORKSHOP CONDUCTED / FACILITATED/ATTENDED BY THE RPMC</option>
                        <option value="adminform6">Form10: RPMC and RDC Resolutions Related to Implementation of the RPMES</option>
                        <option value="adminform7">Form11: Key Lessons Learned from Issues Resolved and Best Practices</option>
                    </select>
            </div>
                <div class="container-8">
                <div class="table-responsive">
                    <table id="archiveTable" class="table ">
                        <thead>
                            <tr>
                                <th class="text-center">Project Name</th>
                                <th class="text-center">Department</th>
                                <th class="text-center">Date Created</th>
                                <th class="text-center">Form Type</th>
                            </tr>
                        </thead>
                        <tbody id="table-body">
                            <!-- Additional rows can be added dynamically through JavaScript -->
                        </tbody>
                    </table>
                    </div>
                    <!-- Numbered Pagination Buttons -->
                    <nav aria-label="Page navigation">
                        <ul class="pagination justify-content-center" id="pagination-container"></ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Updated jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> <!-- Updated Bootstrap JS -->
    <script src="scripts\load-archive-data.js"></script>
</body>
</html>
