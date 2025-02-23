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
    <link rel="stylesheet" href="styles/admin-chart.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
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
    <!-- Success Modal -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img src="images/illustration/successful.png" class="icon-modal-success" alt="Success Icon" style="width: 100px;">
                    <h5 class="text-modal">The task has been updated successfully.</h5>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('submitGantt').addEventListener('click', function(event) {
            event.preventDefault();

            // Simulate a successful submission (you can replace this with actual AJAX or form handling logic)
            setTimeout(() => {
                // Hide the current modal
                const taskModal = bootstrap.Modal.getInstance(document.getElementById('taskModal'));
                if (taskModal) {
                    taskModal.hide();
                }

                // Show the success modal
                const successModal = new bootstrap.Modal(document.getElementById('successModal'));
                successModal.show();
            }, 500);
        });

        // Add an event listener to refresh the page when the success modal is hidden
        const successModalElement = document.getElementById('successModal');
        successModalElement.addEventListener('hidden.bs.modal', function() {
            location.reload();
        });
    </script>

    <!-- Include JavaScript -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="admin-progress/admin-monitoring.js"></script>

    <script>
        // Event listener for clicking on a row (either main or sub)
        document.querySelectorAll('.main-task, .subtasks-name').forEach(item => {
            item.addEventListener('click', function() {
                var projectType = this.getAttribute('data-type');

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