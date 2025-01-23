<?php
require_once 'includes/config.php';

$user_id = $_SESSION['user_id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="images/landing-pic.png">
    <title>Monitoring Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles/user-monitoring.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="container-1">Project Monitoring</div>
                <div class="container-2">
                    <span class="title">Project Gantt Chart</span>
                    <div class="select-container"> 
    <select class="form-control project" id="project" name="project">
        <option value="0">Project List</option>
        <?php
        // Prepare the SQL query to fetch approved projects
        $stmt = $conn->prepare("SELECT pt.project_title, ip.project_id
                                FROM initialprojectreport ip
                                JOIN userprojecttitle pt
                                ON ip.project_id = pt.project_id
                                WHERE ip.user_id = ? AND ip.status = 'approved'");
        $stmt->bind_param("i", $user_id); // Bind the user_id parameter
        $stmt->execute(); // Execute the query
        $result = $stmt->get_result(); // Get the result set
        
        if (mysqli_num_rows($result) > 0) {
            // Loop through the results and populate the dropdown
            while ($row = mysqli_fetch_assoc($result)) {
                $projId1 = htmlspecialchars($row['project_id']); // Sanitize output
                $projName1 = htmlspecialchars($row['project_title']); // Sanitize output
                echo "<option value='$projId1' data-id='$user_id'>$projName1</option>";
            }
        } else {
            // Display a message if no approved projects are found
            echo "<option value=''>No Approved Projects Found!</option>";
        }
        ?>
    </select>
</div>

                </div>

                <div class="container-3" style="height: fit-content;">
                    <h3 class="project-title"></h3>
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
                                <!-- Dynamic rows appended here -->
                            </tbody>
                        </table>
                    </div>
                    <br>
                </div>

                <br>
                <br>
                <div class="container-7">Project Backlog</div>
                <div class="container-8 position-relative">
                <div class="button-container position-absolute d-flex flex-column" style="top: 20px; right: 30px;">
                    <button type="button" class="btn btn-primary mb-2 mainProject">
                        <i class="fas fa-plus"></i> Add Main Task Details
                    </button>
                    <button type="button" class="btn btn-secondary subProject">
                        <i class="fas fa-plus"></i> Add Sub Task Details
                    </button>
                </div>
                <br><br><br>
                <div class="row">
                    <!-- Done Projects Card -->
                    <div class="col-md-12 mt-4">
                        <div class="card" style="background-color: #F8F8F8;">
                            <div class="card-body">
                                <div class="card card-head">
                                    <div class="card-title">
                                        <p class="card-text">Task Done</p>
                                    </div>
                                </div>
                                <p class="card-text-detail-no-data">No Done Project Found!</p>
                            </div>
                        </div>
                    </div>
                    <!-- In Progress Projects Card -->
                    <div class="col-md-12 mt-4">
                        <div class="card" style="background-color: #F8F8F8;">
                            <div class="card-body">
                                <div class="card card-head">
                                    <div class="card-title">
                                        <p class="card-text">Task In Progress</p>
                                    </div>
                                </div>
                                <p class="card-text-detail-no-data">No In Progress Project Found!</p>
                            </div>
                        </div>
                    </div>
                    <!-- Incoming Projects Card -->
                    <div class="col-md-12 mt-4">
                        <div class="card" style="background-color: #F8F8F8;">
                            <div class="card-body">
                                <div class="card card-head">
                                    <div class="card-title">
                                        <p class="card-text">Task Incoming</p>
                                    </div>
                                </div>
                                <p class="card-text-detail-no-data">No Incoming Project Found!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
    <script>
document.getElementById('project').addEventListener('change', function () {
    const projectId = this.value;

    if (projectId !== '0') {
        fetch('includes/fetch_backlogs.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ project_id: projectId }),
        })
            .then(response => response.json())
            .then(data => {
                // Update Task Done Section
                const taskDoneContainer = document.querySelector('.col-md-12.mt-4:nth-child(1) .card-body');
                taskDoneContainer.innerHTML = `
                    <div class="card card-head">
                        <div class="card-title">
                            <p class="card-text">Task Done</p>
                        </div>
                    </div>
                    ${
                        data.done.length
                            ? data.done.map(task => `<p class='card-text-detail'>${task.projectName}</p>`).join('')
                            : "<p class='card-text-detail-no-data'>No Done Project Found!</p>"
                    }`;

                // Update Task In Progress Section
                const inProgressContainer = document.querySelector('.col-md-12.mt-4:nth-child(2) .card-body');
                inProgressContainer.innerHTML = `
                    <div class="card card-head">
                        <div class="card-title">
                            <p class="card-text">Task In Progress</p>
                        </div>
                    </div>
                    ${
                        data.inProgress.length
                            ? data.inProgress.map(task => `<p class='card-text-detail'>${task.projectName}</p>`).join('')
                            : "<p class='card-text-detail-no-data'>No In Progress Project Found!</p>"
                    }`;

                // Update Task Incoming Section
                const incomingContainer = document.querySelector('.col-md-12.mt-4:nth-child(3) .card-body');
                incomingContainer.innerHTML = `
                    <div class="card card-head">
                        <div class="card-title">
                            <p class="card-text">Task Incoming</p>
                        </div>
                    </div>
                    ${
                        data.incoming.length
                            ? data.incoming.map(task => `<p class='card-text-detail'>${task.projectName}</p>`).join('')
                            : "<p class='card-text-detail-no-data'>No Incoming Project Found!</p>"
                    }`;
            })
            .catch(error => console.error('Error fetching backlog data:', error));
    }
});
</script>

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
                    <hr style="border: 1px solid #27374D; width: 100%; margin: auto; margin-bottom: 5px;">
                    <p style="font-size: 20px;"><strong>Status:</strong>
                        <select class="form-control statusDropdown" id="statusDropdown" name="statusDropdown">
                            <option value="Done">Done</option>
                            <option value="In Progress">In Progress</option>
                            <option value="Incoming">Incoming</option>
                        </select>
                    </p>

                    <hr style="border: 1px solid #27374D; width: 100%; margin: auto; margin-bottom: 5px;">
                    <p style="font-size: 20px;"><strong>Project Task Details</strong></p>
                    <p style="font-size: 15px;"><strong>Start Date:</strong> <span id="startDate"></span></p>
                    <p style="font-size: 15px;"><strong>End Date:</strong> <span id="endDate"></span></p>
                    <p style="font-size: 15px;"><strong>Total Task Cost:</strong> <span id="totalCost"></span></p>
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
                            <p class="comment-title"><strong>Project Task Image Details</strong></p>
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

    <!-- Modal for adding Main Project Details-->
    <div class="modal fade" id="taskModalMain" tabindex="-1" aria-labelledby="taskModalMainLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-end" style="margin: 0; right: 0; position: fixed; height: 100%; top: 0; width: 500px;">
            <div class="modal-content" style="border-radius: 10px; padding: 20px; height: 100%; overflow-y: auto;">
                <div class="modal-header" style="border-bottom: none; text-align: center; display: block;">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="position: absolute; right: 20px;"></button>
                    <h3 class="modal-title" style="font-weight: bold;">Main Task Details</h3>
                </div>

                <form method="POST" action="user-page/functions/addProject.php" enctype="multipart/form-data">
                    <div class="modal-body" style="text-align: left;">
                        <hr style="border: 1px solid #27374D; width: 100%; margin: auto; margin-bottom: 20px;">

                        <p style="font-size: 20px;"><strong>Status:</strong>
                            <select class="form-control statusDropdown" id="statusDropdown" name="statusDropdown">
                                <option value="In Progress">In Progress</option>
                                <option value="Incoming">Incoming</option>
                            </select>
                        </p>

                        <div class="project-form">
                            <p class="form-label">Task Name:</p>
                            <input type="text" class="form-control" id="projectName" name="projectName" placeholder="Add Project Name">

                            <p class="form-label">Start Date:</p>
                            <input type="date" class="form-control" id="startDate" name="startDate">

                            <p class="form-label">End Date:</p>
                            <input type="date" class="form-control" id="endDate" name="endDate">

                            <p class="form-label">Total Task Cost:</p>
                            <input type="number" class="form-control" id="projectCost" name="projectCost" min="1000" placeholder="Add Project Cost">
                            <small id="warningMessage" style="color: red; display: none;">Total cost must be at least 1000.</small>

                            <p class="form-label">Fund Source:</p>
                            <input type="text" class="form-control" id="fundSource" name="fundSource" placeholder="Add Fund Source">

                            <p class="form-label">Funding Agency:</p>
                            <input type="text" class="form-control" id="fundingAgency" name="fundingAgency" placeholder="Add Funding Agency">
                        </div>

                        <div id="commentContainer" style="margin-top: 20px;"></div>

                        <p style="font-size: 20px;"><strong>Comments:</strong></p>
                        <div class="comment-input-wrapper">
                            <textarea
                                class="form-control comment"
                                id="comment"
                                name="comment"
                                rows="4"
                                placeholder="Add comment"></textarea>

                            <!-- Image Upload Icon -->
                            <div class="upload-button-wrapper">
                                <label for="uploadImages" class="upload-button">
                                    <i class="fas fa-upload"></i> <!-- Font Awesome upload icon -->
                                </label>
                                <input
                                    type="file"
                                    id="uploadImages"
                                    name="photo"
                                    accept="image/*"
                                    class="upload-input"
                                    onchange="handleImageUploadMain(event)" />
                            </div>
                        </div>
                        <div id="previewContainerss" style="margin-top: 10px;"></div>
                        <input type="hidden" class="form-control status" id="project1" name="project1" value="">
                        <input type="hidden" class="form-control status" id="status" name="status">
                    </div>

                    <div class="modal-footer" style="border-top: none; justify-content: flex-end;">
                        <!-- <button type="button" class="btn" data-bs-dismiss="modal" style="background-color: #C4C4C4; border-radius: 25px; width: 150px; border-color: #C4C4C4;">Cancel</button> -->
                        <button type="submit" class="btn btn-primary submitBtn" id="submitBtn" name="submitBtn" style="background-color: #27374D; border-radius: 25px; width: 150px; border-color: #27374D; margin-left: 10px;">Submit</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- Modal for adding Sub Project Details-->
    <div class="modal fade" id="taskModalSub" tabindex="-1" aria-labelledby="taskModalSubLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-end" style="margin: 0; right: 0; position: fixed; height: 100%; top: 0; width: 500px;">
            <div class="modal-content" style="border-radius: 10px; padding: 20px; height: 100%; overflow-y: auto;">
                <div class="modal-header" style="border-bottom: none; text-align: center; display: block;">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="position: absolute; right: 20px;"></button>
                    <h3 class="modal-title" style="font-weight: bold;">Sub Task Details</h3>
                </div>

                <form method="POST" action="user-page/functions/addSubProject.php" enctype="multipart/form-data">
                    <div class="modal-body" style="text-align: left;">
                        <hr style="border: 1px solid #27374D; width: 100%; margin: auto; margin-bottom: 20px;">

                        <p style="font-size: 20px;"><strong>Status:</strong>
                            <select class="form-control statusDropdown" id="statusDropdown" name="statusDropdown">
                                <option value="In Progress">In Progress</option>
                                <option value="Incoming">Incoming</option>
                            </select>
                        </p>

                        <div class="project-form">
                            <p class="form-label"><strong>Main Task Name:</strong></p>
                            <select class="form-control" id="mainproject" name="mainproject">
                                <option value="">Select Main Project</option>
                                <?php
                                $projects = mysqli_query($conn, "SELECT * FROM user_mainproject");
                                if (mysqli_num_rows($projects) > 0) {
                                    while ($row = mysqli_fetch_assoc($projects)) {
                                        $projId = $row['id'];
                                        $projName = $row['projectName'];
                                        $projStartDate = $row['startDate'];
                                        $projEndDate = $row['endDate'];
                                        echo "<option value='$projId' data-project-id='" . $row['project_id'] . "' data-start='$projStartDate' data-end='$projEndDate'>$projName</option>";
                                    }
                                } else {
                                    echo "<option value=''>No Main Project Found!</option>";
                                }
                                ?>
                            </select>

                            <script>
                            document.getElementById('project').addEventListener('change', function() {
                                var selectedProjectId = this.value;
                                var mainProjectDropdown = document.getElementById('mainproject');
                                var mainProjectOptions = mainProjectDropdown.getElementsByTagName('option');

                                // Loop through all options and hide those that do not match the selected project_id
                                for (var i = 0; i < mainProjectOptions.length; i++) {
                                    var option = mainProjectOptions[i];
                                    var projectId = option.getAttribute('data-project-id');

                                    if (selectedProjectId === "0" || selectedProjectId === projectId) {
                                        option.style.display = ''; // Show the option
                                    } else {
                                        option.style.display = 'none'; // Hide the option
                                    }
                                }
                            });
                            </script>
                            <p class="form-label">Sub Task Name:</p>
                            <input type="text" class="form-control" id="subProjectName" name="subProjectName" placeholder="Add Sub Project Name">

                            <p class="form-label">Start Date:</p>
                            <input type="date" class="form-control" id="subStartDate" name="subStartDate">

                            <p class="form-label">End Date:</p>
                            <input type="date" class="form-control" id="subEndDate" name="subEndDate">

                            <p class="form-label">Total Task Cost:</p>
                            <input type="number" class="form-control" id="subProjectCost" name="subProjectCost" min="1000" placeholder="Add Project Cost">
                            <small id="warningMessage1" style="color: red; display: none;">Total cost must be at least 1000.</small>

                            <p class="form-label">Fund Source:</p>
                            <input type="text" class="form-control" id="subFundSource" name="subFundSource" placeholder="Add Fund Source">

                            <p class="form-label">Funding Agency:</p>
                            <input type="text" class="form-control" id="subFundingAgency" name="subFundingAgency" placeholder="Add Funding Agency">
                        </div>
                        <br>

                        <p style="font-size: 20px;"><strong>Comments:</strong></p>
                        <div class="comment-input-wrapper">
                            <textarea
                                class="form-control comment"
                                id="subComment"
                                name="subComment"
                                rows="4"
                                placeholder="Add comment"></textarea>

                            <!-- Image Upload Icon -->
                            <div class="upload-button-wrapper">
                                <label for="uploadImages1" class="upload-button">
                                    <i class="fas fa-upload"></i>
                                </label>
                                <input
                                    type="file"
                                    id="uploadImages1"
                                    name="photo"
                                    accept="image/*"
                                    class="upload-input"
                                    onchange="handleImageUploadSub(event)" />
                            </div>
                        </div>

                        <div id="previewContainers1" style="margin-top: 10px;"></div>
                        <input type="hidden" class="form-control status" id="project2" name="project2" value="">

                    </div>
                    <div class="modal-footer" style="border-top: none; justify-content: flex-end;">
                        <!-- <button type="button" class="btn" data-bs-dismiss="modal" style="background-color: #C4C4C4; border-radius: 25px; width: 150px; border-color: #C4C4C4;">Cancel</button> -->
                        <button type="submit" class="btn btn-primary submitBtn1" id="submitBtn1" name="submitBtn1" style="background-color: #27374D; border-radius: 25px; width: 150px; border-color: #27374D; margin-left: 10px;">Submit</button>
                    </div>
                </form>

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
    document.getElementById('submitGantt').addEventListener('click', function (event) {
        event.preventDefault(); // Prevent default form submission

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
        }, 500); // Delay to simulate processing
    });

    // Add an event listener to refresh the page when the success modal is hidden
    const successModalElement = document.getElementById('successModal');
    successModalElement.addEventListener('hidden.bs.modal', function () {
        location.reload(); // Refresh the page
    });
</script>

    <!-- Include JavaScript -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- <script src="scripts/user-monitoring.js"></script>
    <script src="scripts/user-monitoring-sub.js"></script> -->

</body>

</html>
<script>
    $(document).ready(function() {
        $('.mainProject').click(function() {
            $('#taskModalMainLabel').text($(this).text());
            const modal = new bootstrap.Modal(document.getElementById('taskModalMain'));
            modal.show();
        });

        $('.subProject').click(function() {
            $('#taskModalSubLabel').text($(this).text());
            const modal = new bootstrap.Modal(document.getElementById('taskModalSub'));
            modal.show();
        });
    });
</script>

<script>
    // Function to dynamically load a script
    function loadScript(src) {
        var script = document.createElement('script');
        script.src = src;
        script.type = 'text/javascript';
        document.head.appendChild(script);
    }
</script>
<script>
    document.getElementById('mainproject').addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const mainStartDate = selectedOption.getAttribute('data-start');
        const mainEndDate = selectedOption.getAttribute('data-end');

        if (mainStartDate && mainEndDate) {
            document.getElementById('subStartDate').setAttribute('min', mainStartDate);
            document.getElementById('subStartDate').setAttribute('max', mainEndDate);
            document.getElementById('subEndDate').setAttribute('min', mainStartDate);
            document.getElementById('subEndDate').setAttribute('max', mainEndDate);
        } else {
            document.getElementById('subStartDate').removeAttribute('min');
            document.getElementById('subStartDate').removeAttribute('max');
            document.getElementById('subEndDate').removeAttribute('min');
            document.getElementById('subEndDate').removeAttribute('max');
        }
    });

    document.getElementById('subStartDate').addEventListener('change', function() {
        const subStartDate = this.value;
        document.getElementById('subEndDate').setAttribute('min', subStartDate);
    });
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

<script>
    // Function to handle image upload and preview
    function handleImageUploadMain(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const previewContainer = document.getElementById('previewContainerss');
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
<script>
    // Function to handle image upload and preview
    function handleImageUploadSub(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const previewContainer = document.getElementById('previewContainers1');
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

<script>
    // Add event listener to the select dropdown
    document.getElementById('project').addEventListener('change', function() {
        // Get the selected value
        const selectedValue = this.value;
        // Update the input field value
        document.getElementById('project1').value = selectedValue;
    });

    // Add event listener to the select dropdown
    document.getElementById('project').addEventListener('change', function() {
        // Get the selected value
        const selectedValue = this.value;
        // Update the input field value
        document.getElementById('project2').value = selectedValue;
    });

    // JavaScript to update the project title dynamically
    document.getElementById('project').addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const projectTitleElement = document.querySelector('.project-title');

        if (selectedOption.value === "0" || selectedOption.value === "") {
            projectTitleElement.textContent = ""; // Clear the title if no valid project is selected
        } else {
            projectTitleElement.textContent = selectedOption.text; // Display the selected project's name
        }
    });

    document.getElementById('project').addEventListener('change', function() {
        const selectedProjectId = this.value;
        const selectedOption = this.options[this.selectedIndex];
        const userId = selectedOption.getAttribute('data-id'); // Retrieve the user_id from the selected option's data-id attribute

        if (selectedProjectId && selectedProjectId !== "0" && userId) {
            fetch('user-page/graph.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: `project_id=${selectedProjectId}&user_id=${userId}` // Send project_id and user_id in the request body
                })
                .then(response => response.text())
                .then(data => {
                    document.getElementById('gantt-chart-body').innerHTML = data;
                    // Add event listener after updating the DOM
                    document.querySelectorAll('.main-task, .subtasks-name').forEach(item => {
                        item.addEventListener('click', function() {
                            var projectType = this.getAttribute('data-type'); // Get project type (main or sub)
                            if (projectType === 'main') {
                                loadScript('scripts/user-monitoring.js');
                            } else if (projectType === 'sub') {
                                loadScript('scripts/user-monitoring-sub.js');
                            }
                        });
                    });
                })
                .catch(error => console.error('Error:', error));
        } else {
            document.getElementById('gantt-chart-body').innerHTML = '<p>Please select a valid project.</p>';
        }
    });
</script>
<!-- Success Modal -->
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content" style="border: 2px solid blue;">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img src="images/illustration/successful.png" class="icon-modal-success" alt="Success Icon">
                <h5 class="text-modal">The <b>Maintask</b> has been added successfully.</h5>
            </div>
        </div>
    </div>
</div>

<!-- Sub Task Success Modal -->
<div class="modal fade" id="successsubModal" tabindex="-1" aria-labelledby="successsubLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content" style="border: 2px solid blue;">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img src="images/illustration/successful.png" class="icon-modal-success" alt="Success Icon">
                <h5 class="text-modal">The <b>Subtask</b> has been added successfully.</h5>
            </div>
        </div>
    </div>
</div>

<!-- Invalid Year Modal -->
<div class="modal fade" id="sinvalidModal" tabindex="-1" aria-labelledby="successupdateLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content" style="border: 2px solid blue;">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img src="images/illustration/successful.png" class="icon-modal-success" alt="Success Icon">
                <h5 class="text-modal">The StartDate and EndDate must be within the current year (2025).</h5>
            </div>
        </div>
    </div>
</div>
<!-- UPDATE Modal -->
<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="successupLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content" style="border: 2px solid blue;">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img src="images/illustration/successful.png" class="icon-modal-success" alt="Success Icon">
                <h5 class="text-modal">The <b>Task</b> has been updated successfully.</h5>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<script>
$(document).ready(function() {
    // Handle form submission using Ajax
    $('form').on('submit', function(event) {
        event.preventDefault();  // Prevent default form submission

        var formData = new FormData(this); // Create FormData object from the form
        console.log(formData)
        // Send the form data via Ajax
        $.ajax({
            url: 'user-page/functions/addProject.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
            console.log(response)
                var data = JSON.parse(response); // Parse the JSON response from the server

                if (data.status === 'success') {
                    // Show the success modal for main task
                    var successModal = new bootstrap.Modal(document.getElementById('successModal'));
                    successModal.show();

                    // Optionally, clear the form fields if needed
                    $('form')[0].reset();
                } else if (data.status === 'invalid_year') {
                    // Show the invalid year modal
                    var invalidModal = new bootstrap.Modal(document.getElementById('sinvalidModal'));
                    invalidModal.show();
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX error:', status, error);
                alert('There was an error with the request.');
            }
        });
    });

    // Handle sub-task form submission using Ajax
    $('#submitBtn1').off('click').on('click', function(event) {
        event.preventDefault(); // Prevent the default form submission

        var formData = new FormData($('#taskModalSub form')[0]); // Get form data

        $.ajax({
            url: 'user-page/functions/addSubProject.php', // Endpoint for form submission
            type: 'POST',
            data: formData,
            processData: false, // Prevent jQuery from transforming data into a query string
            contentType: false, // Prevent jQuery from setting content type automatically
            success: function(response) {
                console.log(response);

                try {
                    const data = JSON.parse(response); // Parse the JSON response
                    if (data.status === "success") {
                        // Show success modal for sub-task
                        var successModal = new bootstrap.Modal(document.getElementById('successsubModal'));
                        successModal.show();

                        // Optionally, clear the form fields after successful submission
                        $('#taskModalSub form')[0].reset();
                    } else {
                        alert('Failed to add subtask: ' + data.message);
                    }
                } catch (e) {
                    alert('Error parsing the server response');
                    console.error(e);
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX error: ', status, error);
                alert('Failed to submit data.');
            }
        });
    });

    // Refresh the page when the close button is clicked on any success modal
    $('#successModal .btn-close, #successsubModal .btn-close').on('click', function() {
        location.reload();  // Reload the page
    });

});
</script>
<script>
$(document).ready(function () {
    // Validate the input value for total cost
    $('#projectCost').on('input', function () {
        const value = $(this).val(); // Get the input value
        const warningMessage = $('#warningMessage');
        
        // Check if the value is less than 1000
        if (value && value < 1000) {
            warningMessage.show(); // Show warning message
        } else {
            warningMessage.hide(); // Hide warning message
        }
    });
});
</script>
<script>
$(document).ready(function () {
    // Validate the input value for total cost
    $('#subProjectCost').on('input', function () {
        const value = $(this).val(); // Get the input value
        const warningMessage = $('#warningMessage1');
        
        // Check if the value is less than 1000
        if (value && value < 1000) {
            warningMessage.show(); // Show warning message
        } else {
            warningMessage.hide(); // Hide warning message
        }
    });
});
</script>