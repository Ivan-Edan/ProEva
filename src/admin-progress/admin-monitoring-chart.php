<?php
require_once 'includes/config.php';


$projectId = $_GET['project_id'];
$sql = "SELECT project_title FROM userprojecttitle WHERE project_id =?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $projectId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Fetch the project title
    $row = $result->fetch_assoc();
    $projectName = $row['project_title'];
} else {
    echo "No project found with the given ID.";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="src/images/landing-pic.png">
    <title>Progress Page</title>
    <link rel="stylesheet" href="styles/admin-monitoring.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #F5F5F5;
            color: #585858;
        }

        /* Container for horizontal scrolling */
.gantt-chart-container {
    width: 100%;
    overflow-x: auto;
    overflow-y: hidden;
    white-space: nowrap;
    border: 1px solid #ddd;
    border-radius: 10px; /* Rounded corners */
    margin-top: 20px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Add shadow for a modern look */
}

/* Gantt chart table styles */
.gantt-chart {
    border-collapse: collapse;
    width: max-content;
    font-size: 12px;
    background-color: #fff;
    table-layout: fixed;
    border-bottom: 1px solid #ddd; /* X-axis border */
}

/* Table headers and cells */
.gantt-chart th, 
.gantt-chart td {
    padding: 0;
    width: 30px; /* Adjust width as needed */
    height: 35px; /* Consistent height */
    border-top: 1px solid #ddd; /* Horizontal top border */
    border-bottom: 1px solid #ddd; /* Horizontal bottom border */
    border-left: none; /* Remove vertical left border */
    border-right: none; /* Remove vertical right border */
}

.gantt-chart th {
    text-align: center;
    vertical-align: middle;
    background-color: #f0f0f0;
    font-weight: bold;
    color: #333;
    border-bottom: 1px solid #ddd; /* Header-bottom border */
}

/* Make the first column sticky */
.gantt-chart th:first-child, 
.gantt-chart td:first-child {
    position: sticky;
    left: 0;
    z-index: 2; /* Ensure it stays above other cells */
    background-color: #f9f9f9; /* Background color for visibility */
    text-align: left;
    padding-left: 10px; /* Add some padding for spacing */
}

/* Remove horizontal lines (borders between rows) */
.gantt-chart tbody td {
    border-top: none; /* Remove top borders from body rows */
}

/* Alternating row colors */
.gantt-chart tbody tr:nth-child(odd) {
    background-color: #f9f9f9;
}

.gantt-chart tbody tr:nth-child(even) {
    background-color: #f1f1f1;
}

/* Progress bar container spanning entire row */
.progress-bar-container {
    position: relative;
    width: 100%; /* Ensures it spans the full row */
    height: 20px; /* Adjust height for a thinner bar */
    background-color: #e0e0e0; /* Light gray background for the progress track */
    overflow: hidden; /* Ensures smooth edges */
    margin: 5px 0; /* Adds spacing between bars */
}

/* Blue ombre progress bar */
.progress-bar {
    height: 50%;
    background: rgb(42, 195, 52);
    transition: width 0.5s ease-in-out; /* Smooth progress animation */
}

/* Label for task name or progress percentage */
.progress-label {
    position: absolute;
    width: 100%;
    text-align: center;
    top: 0;
    left: 0;
    height: 70%;
    line-height: 20px; /* Align text vertically in the bar */
    font-size: 12px;
    color: #fff; /* White text */
    font-weight: bold;
    pointer-events: none; /* Prevent interaction */
}

/* Hover effect on the table row */
.gantt-chart tr:hover {
    background-color: #e0e0e0;
    cursor: pointer;
}

/* Task and subtask icon styles */
.task-icon {
    margin-right: 10px;
}

.blue-circle, .light-circle {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    display: inline-block;
    vertical-align: middle;
}
.light-circle{
    width: 10px;
    height: 10px;
    border-radius: 50%;
    padding-left: 10px;
    display: inline-block;
    vertical-align: middle;
}
.blue-circle {
    background-color: #27374D; 
}

.light-circle {
    background-color: #6fa4cc;
}

/* Task and subtask styles */
.task-name {
    font-weight: 500;
    cursor: pointer;
    font-size: 14px;
    margin-right: 10px !important;
}

.subtasks-name {
    font-weight: 500;
    cursor: pointer;
    font-size: 13px;
    margin-right: 10px !important;
}

/* Responsive adjustments for smaller screens */
@media screen and (max-width: 768px) {
    .gantt-chart {
        font-size: 10px;
    }
    .gantt-chart th, .gantt-chart td {
        width: 20px; /* Reduce width for smaller screens */
    }
}
        .project-title {
            text-align: center;
            font-weight: bold;
        }

        .card-head {
            background-color: #2c3e50;
            margin-bottom: 23px;
        }

        .card-text {
            color: white;
            text-align: center;
            font-size: 15px;
            padding-top: 8px;
        }

        .card-text-detail {
            color: #272727;
            text-align: left;
            font-size: 13px;
            padding-left: 13px;
            padding-bottom: 13px;
            border-bottom: 1px solid #ccc;
            font-weight: bold;
        }
        .modal-dialog-end {
    margin: 0;
    margin-right: 0;
    position: absolute;
    right: 0;
    top: 20px; 
    width: auto;
    max-width: 100%;
}
.modal-backdrop {
    display: none !important;
}
.btn-primary,.btn-secondary{
    background-color: #2c3e50 !important;
    border-color: #2c3e50;
    border-radius: 25px;
}
.mt-7 {
    margin-top: 5rem; /* Adjust as needed */
}

.comment-section {
    font-family: Arial, sans-serif;
    margin-top: 20px;
    background-color: #f4f7f6;
    border-radius: 8px;
    padding: 20px;
    box-shadow: 0 1px 4px rgba(0, 0, 0, 0.1);
}

.comment-header {
    display: flex;
    flex-direction: column;
    margin-bottom: 10px;
}

.comment-title {
    font-size: 18px;
    color: #27374D;
    margin: 0;
}

.comment-name {
    font-size: 16px;
    font-weight: bold;
    color: #272727;
    margin-top: 5px;
}

.comment-preview {
    font-size: 14px;
    color: #363636;
    margin-top: 10px;
}

.comment-image-preview {
    width: 100%;
    height: auto;
    background-color: #ddd;
    border-radius: 8px;
    margin-top: 10px;
}

.divider {
    border: 1px solid #e0e0e0;
    width: 100%;
    margin: 20px 0;
    background-color: #fff;
}

.comment-section {
    font-family: Arial, sans-serif;
    background-color: #f4f7f6;
    padding: 15px;
    border-radius: 8px;
    box-shadow: 0 1px 4px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 800px;
    margin: auto;
}

.comment-title {
    font-size: 18px;
    color: #3b5998;
    margin-bottom: 10px;
}

.comment-input-wrapper {
    display: flex;
    align-items: flex-start;
    gap: 10px;
}

.comment-input {
    flex-grow: 1;
    padding: 10px;
    font-size: 16px;
    border: 1px solid #ddd;
    border-radius: 20px;
    resize: none;
    box-sizing: border-box;
    background-color: #fff;
    box-shadow: 0 1px 4px rgba(0, 0, 0, 0.05);
    transition: border-color 0.3s;
}

.comment-input:focus {
    border-color: #3b5998;
    outline: none;
}

.upload-button-wrapper {
    position: relative;
}

.upload-button {
    cursor: pointer;
    background-color: #f0f2f5;
    border-radius: 50%;
    padding: 8px;
    display: inline-block;
    transition: background-color 0.3s;
}

.upload-button:hover {
    background-color: #dbe1e8;
}

.upload-button i {
    font-size: 24px;
    color: #3b5998;
}

.upload-input {
    display: none;
}

.comment-input-wrapper {
    display: flex;
    align-items: flex-start;
    gap: 10px;
}

.comment-input-wrapper .comment {
    flex-grow: 1;
    padding: 10px;
    font-size: 16px;
    border: 1px solid #ddd;
    border-radius: 20px;
    resize: none;
    box-sizing: border-box;
    background-color: #fff;
    box-shadow: 0 1px 4px rgba(0, 0, 0, 0.05);
    transition: border-color 0.3s;
}

.comment-input-wrapper .comment:focus {
    border-color: #3b5998;
    outline: none;
}

.upload-button-wrapper {
    position: relative;
}

.upload-button {
    cursor: pointer;
    background-color: #f0f2f5;
    border-radius: 50%;
    padding: 8px;
    display: inline-block;
    transition: background-color 0.3s;
}

.upload-button:hover {
    background-color: #dbe1e8;
}

.upload-button i {
    font-size: 24px;
    color: #3b5998; 
}

.upload-input {
    display: none;
}
.project-form, .sub-project-form{
    background-color: #f0f2f5;
    padding: 20px;
    border-radius: 8px;
    max-width: 500px;
    margin: auto;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.form-label {
    font-size: 15px;
    font-weight: bold;
    color: #1c1e21;
    margin-bottom: 8px;
}

.form-control {
    padding: 12px;
    font-size: 15px;
    border-radius: 8px;
    width: 100%;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    background-color: #fff;
}

.select-container {
    margin-left: auto; /* Push the select-container to the far right */
    display: flex;
    align-items: center;
}

.select-container .form-control {
    width: 250px;
    padding: 10px;
    margin-top: 15px !important;
    font-size: 16px;
    border: 2px solid #ccc;
    border-radius: 25px !important;
    background-color: #27374D;
    color: #f0f0f0;
    box-sizing: border-box;
    transition: all 0.3s ease;
}

/* Hover and Focus States */
.select-container .form-control:hover {
    border-color: #007BFF;
}

.select-container .form-control:focus {
    outline: none;
    border-color: #0056b3;
}

/* Customizing Option Styling */
.select-container .form-control option {
    padding: 10px;
    font-size: 16px;
    color: #333;
    background-color: #fff;
}

.select-container .form-control option:hover {
    background-color: #f1f1f1;
    color: #007BFF;
}

/* Disabled option styling */
.select-container .form-control option:disabled {
    color: #ccc;
    background-color: #f9f9f9;
}

/* Styling for the placeholder */
.select-container .form-control option:first-child {
    color: #999;
    font-style: italic;
}

.icon-modal-success{
    height: 30vh;
    width: 30vh;
    display: flex;
    justify-content: center;
    align-items: center;
    margin: 0 auto;
}
.text-modal{
    padding-top: -60px;
    text-align: center;
}
.modal-backdrop.show {
    background-color: rgba(0, 0, 0, 0.5) !important;
}
        .modal-dialog-end {
            margin: 0;
            margin-right: 0;
            position: absolute;
            right: 0;
            top: 20px;
            /* Adjust as needed */
            width: auto;
            max-width: 100%;
        }

        .modal-backdrop {
            display: none !important;
        }
    </style>
</head>

<body>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="container-1">Project Monitoring</div>
                <div class="container-2">Project Gantt Chart</div>
                <div class="container-3" style="height: fit-content;">
                <h3 class="project-title"><?php echo $projectName; ?></h3>
                    <div class="gantt-chart-container">
                        <table class="gantt-chart">
                            <thead>
                                <tr>
                                    <th style="text-align: center; font-size: 15px;">Task Name</th>
                                    <?php for ($month = 1; $month <= 12; $month++): ?>
                                        <th colspan="31"><?php echo date("M", mktime(0, 0, 0, $month, 1)); ?></th>
                                    <?php endfor; ?>
                                </tr>
                                <tr>
                                    <th></th>
                                    <?php for ($month = 1; $month <= 12; $month++): ?>
                                        <?php for ($day = 1; $day <= 31; $day++): ?>
                                            <th><?php echo $day; ?></th>
                                        <?php endfor; ?>
                                    <?php endfor; ?>
                                </tr>
                            </thead>
                            <tbody id="gantt-chart-body">
                            <?php include 'graph.php'; ?>
                            </tbody>
                        </table>
                    </div>
                    <br>
                </div>
            </div>
        </div>

         <!-- Modal -->
    <div class="modal fade" id="taskModal" tabindex="-1" aria-labelledby="taskModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-end" style="margin: 0; right: 0; position: fixed; height: 100%; top: 0; width: 500px;">
            <div class="modal-content" style="border-radius: 10px; padding: 20px; height: 100%; overflow-y: auto;">
                <div class="modal-header" style="border-bottom: none; text-align: center; display: block;">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="position: absolute; right: 20px;"></button>
                    <h4 class="modal-title" style="font-weight: bold;">Task Title</h4>
                    <h6 class="modal-title" id="taskModalLabel" style="font-weight: normal;"></h6>
                </div>
                <div class="modal-body" style="text-align: left;">
                    <hr style="border: 1px solid #27374D; width: 100%; margin: auto; margin-bottom: 15px;">
                    <p style="font-size: 20px;"><strong>Status:</strong> <span id="status"></span></p>
                    <hr style="border: 1px solid #27374D; width: 100%; margin: auto; margin-bottom: 5px;">
                    <p style="font-size: 20px;"><strong>Project Task Details</strong></p>
                    <p style="font-size: 15px;"><strong>Start Date:</strong> <span id="startDate"></span></p>
                    <p style="font-size: 15px;"><strong>End Date:</strong> <span id="endDate"></span></p>
                    <p style="font-size: 15px;"><strong>Total Project Cost:</strong> <span id="totalCost"></span></p>
                    <p style="font-size: 15px;"><strong>Fund Source:</strong> <span id="fundSource"></span></p>
                    <p style="font-size: 15px;"><strong>Funding Agency:</strong> <span id="fundingAgency"></span></p>
                    <hr style="border: 1px solid #27374D; width: 100%; margin: auto; margin-bottom: 10px;">

                    <div class="comment-section">
                        <div class="comment-header">
                            <p class="comment-title"><strong>Message Board</strong></p>
                            <p id="nameDetails" class="nameDetails comment-name"></p>
                        </div>

                        <div id="previewContainers" class="comment-preview"></div>

                        <hr class="divider">

                        <div class="comment-header">
                            <p class="comment-title"><strong>Project Image Task Details</strong></p>
                        </div>

                        <div id="previewContainersImage" class="comment-image-preview"></div>
                    </div>
                    <br>
                    <hr style="border: 1px solid #27374D; width: 100%; margin: auto; margin-bottom: 10px;">
                    <div class="comment-section">
                        <p class="comment-title"><strong>Add Message</strong></p>

                        <div class="comment-input-wrapper">
                            <textarea
                                class="comment-input"
                                id="commentPrev"
                                name="commentPrev"
                                rows="4"
                                placeholder="Add a comment..."></textarea>

                            <!-- Image Upload Icon -->
                            <div class="upload-button-wrapper">
                                <label for="imagePrev" class="upload-button">
                                    <i class="fas fa-upload"></i>
                                </label>
                                <input
                                    type="file"
                                    id="imagePrev"
                                    accept="image/*"
                                    class="upload-input"
                                    onchange="handleImageUpload(event)" />
                            </div>
                        </div>
                    </div>

                    <div id="previewContainer" style="margin-top: 10px;"></div>

                </div>
                <div class="modal-footer" style="border-top: none; justify-content: flex-end;">
                    <!-- <button type="button" class="btn" data-bs-dismiss="modal" style="background-color: #C4C4C4; border-radius: 25px; width: 150px; border-color: #C4C4C4;">Cancel</button> -->
                    <button type="submit" class="btn btn-primary" name="submitGantt" id="submitGantt" style="background-color: #27374D; border-radius: 25px; width: 150px; border-color: #27374D; margin-left: 10px;">Submit</button>
                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- Include JavaScript -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="admin-progress/admin-monitoring.js"></script>

    <script>
        // Event listener for clicking on a row (either main or sub)
        document.querySelectorAll('.main-task, .subtasks-name').forEach(item => {
            item.addEventListener('click', function() {
                var projectType = this.getAttribute('data-type'); // Get project type (main or sub)

                // Conditionally load the script
                if (projectType === 'main') {
                    loadScript('admin-monitoring.js');
                } else if (projectType === 'sub') {
                    loadScript('admin-progress/admin-monitoring-sub.js');
                    console.log("triggered");
                }
            });
        });

        // Function to dynamically load a script
        function loadScript(src) {
            var script = document.createElement('script');
            script.src = src;
            script.type = 'text/javascript';
            document.head.appendChild(script);
        }
    </script>

    <script>
        // Function to handle image upload and preview
        function handleImageUpload(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const previewContainer = document.getElementById('previewContainer');
                    previewContainer.innerHTML = `
        <div style="margin-top: 10px;">
        <img 
            src="${e.target.result}" 
            alt="Preview" 
            style="width: 100px; height: 100px; object-fit: cover; border: 1px solid #ccc; border-radius: 5px;" />
        </div>
    `;
                };
                reader.readAsDataURL(file);
            }
        }
    </script>
</body>

</html>