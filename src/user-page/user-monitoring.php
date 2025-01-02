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
                    <select class="form-control project" id="project" name="project" style="width:fit-content;">
                        <option value="0">Project</option>
                        <?php
                        $stmt = $conn->prepare("SELECT pt.project_title, ip.project_id
                                                            FROM initialprojectreport ip
                                                            JOIN userprojecttitle pt
                                                            ON ip.project_id = pt.project_id
                                                            WHERE ip.user_id = ?");
                        $stmt->bind_param("i", $user_id);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        // Check if there are any rows
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $projId1 = $row['project_id'];
                                $projName1 = $row['project_title'];
                                echo "<option value='$projId1' data-id='$user_id'>$projName1</option>";
                            }
                        } else {
                            echo "<option value=''>No Main Project Found!</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="container-3" style="width: fit-content; height:fit-content;">
                    <h3 class="project-title"></h3>
                    <table class="gantt-chart">
                        <thead>
                            <tr>
                                <th>Project Name</th>
                                <th>Jan</th>
                                <th>Feb</th>
                                <th>Mar</th>
                                <th>Apr</th>
                                <th>May</th>
                                <th>Jun</th>
                                <th>Jul</th>
                                <th>Aug</th>
                                <th>Sep</th>
                                <th>Oct</th>
                                <th>Nov</th>
                                <th>Dec</th>
                            </tr>
                        </thead>
                        <tbody id="gantt-chart-body">
                            <!--  -->
                        </tbody>
                    </table>
                </div>
                <br>
                <br>
                <div class="container-7">Project Backlog</div>
                <div class="container-8 position-relative">
                    <!-- Button container for the two buttons -->
                    <div class="button-container position-absolute d-flex flex-column" style="top: 20px; right: 30px;">
                        <button type="button" class="btn btn-primary mb-2 mainProject">
                            <i class="fas fa-plus"></i> Add Main Project Details
                        </button>
                        <button type="button" class="btn btn-secondary subProject">
                            <i class="fas fa-plus"></i> Add Sub Project Details
                        </button>
                    </div>
                    <div class="row">
                        <div class="col-md-3 mx-4 mt-7" style="margin-left: 40px;">
                            <div class="card" style="height: 350px; background-color: #F8F8F8;">
                                <div class="card-body">
                                    <div class="card card-head">
                                        <div class="card-title">
                                            <p class="card-text">Project Done</p>
                                        </div>
                                    </div>
                                    <?php
                                    $projectDone = mysqli_query($conn, "SELECT * FROM user_mainproject WHERE status = 'Done'");
                                    if (mysqli_num_rows($projectDone) > 0) {
                                        while ($row = mysqli_fetch_assoc($projectDone)) {
                                            $projName1 = $row['projectName'];
                                            echo "<p class='card-text-detail'>$projName1</p>";
                                        }
                                    } else {
                                        echo "<p class='card-text-detail'>No Done Project Found!</p>";
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mx-4 mt-7">
                            <div class="card" style="height: 350px; background-color: #F8F8F8;">
                                <div class="card-body">
                                    <div class="card card-head">
                                        <div class="card-title">
                                            <p class="card-text">Project On progress</p>
                                        </div>
                                    </div>
                                    <?php
                                    $projectsProgress = mysqli_query($conn, "SELECT * FROM user_mainproject WHERE status = 'In Progress'");
                                    if (mysqli_num_rows($projectsProgress) > 0) {
                                        while ($row = mysqli_fetch_assoc($projectsProgress)) {
                                            $projName2 = $row['projectName'];
                                            echo "<p class='card-text-detail'>$projName2</p>";
                                        }
                                    } else {
                                        echo "<p class='card-text-detail'>No In Progress Project Found!</p>";
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mx-4 mt-7">
                            <div class="card" style="height: 350px; background-color: #F8F8F8;">
                                <div class="card-body">
                                    <div class="card card-head">
                                        <div class="card-title">
                                            <p class="card-text">Project Incoming</p>
                                        </div>
                                    </div>
                                    <?php
                                    $projectIncoming = mysqli_query($conn, "SELECT * FROM user_mainproject WHERE status = 'Incoming'");
                                    if (mysqli_num_rows($projectIncoming) > 0) {
                                        while ($row = mysqli_fetch_assoc($projectIncoming)) {
                                            $projName3 = $row['projectName'];
                                            echo "<p class='card-text-detail'>$projName3</p>";
                                        }
                                    } else {
                                        echo "<p class='card-text-detail'>No Incoming Project Found!</p>";
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="taskModal" tabindex="-1" aria-labelledby="taskModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-end" style="margin: 0; right: 0; position: fixed; height: 100%; top: 0; width: 500px;">
            <div class="modal-content" style="border-radius: 10px; padding: 20px; height: 100%; overflow-y: auto;">
                <div class="modal-header" style="border-bottom: none; text-align: center; display: block;">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="position: absolute; right: 20px;"></button>
                    <h4 class="modal-title" style="font-weight: bold;">Project Title</h4>
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
                    <p style="font-size: 20px;"><strong>Project Details</strong></p>
                    <p style="font-size: 15px;"><strong>Start Date:</strong> <span id="startDate"></span></p>
                    <p style="font-size: 15px;"><strong>End Date:</strong> <span id="endDate"></span></p>
                    <p style="font-size: 15px;"><strong>Total Project Cost:</strong> <span id="totalCost"></span></p>
                    <p style="font-size: 15px;"><strong>Fund Source:</strong> <span id="fundSource"></span></p>
                    <p style="font-size: 15px;"><strong>Funding Agency:</strong> <span id="fundingAgency"></span></p>
                    <hr style="border: 1px solid #27374D; width: 100%; margin: auto; margin-bottom: 10px;">

                    <div class="comment-section">
                        <div class="comment-header">
                            <p class="comment-title"><strong>Project Comment Details</strong></p>
                            <p id="nameDetails" class="nameDetails comment-name"></p>
                        </div>

                        <div id="previewContainers" class="comment-preview"></div>

                        <hr class="divider">

                        <div class="comment-header">
                            <p class="comment-title"><strong>Project Image Details</strong></p>
                        </div>

                        <div id="previewContainersImage" class="comment-image-preview"></div>
                    </div>
                    <br>
                    <hr style="border: 1px solid #27374D; width: 100%; margin: auto; margin-bottom: 10px;">
                    <div class="comment-section">
                        <p class="comment-title"><strong>Add Comment</strong></p>

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
                    <h3 class="modal-title" style="font-weight: bold;">Main Project Details</h3>
                </div>

                <form method="POST" action="user-page/functions/addProject.php" enctype="multipart/form-data">
                    <div class="modal-body" style="text-align: left;">
                        <hr style="border: 1px solid #27374D; width: 100%; margin: auto; margin-bottom: 20px;">

                        <p style="font-size: 20px;"><strong>Status:</strong>
                            <select class="form-control statusDropdown" id="statusDropdown" name="statusDropdown">
                                <option value="Done">Done</option>
                                <option value="In Progress">In Progress</option>
                                <option value="Incoming">Incoming</option>
                            </select>
                        </p>

                        <div class="project-form">
                            <p class="form-label">Project Name:</p>
                            <input type="text" class="form-control" id="projectName" name="projectName" placeholder="Add Project Name">

                            <p class="form-label">Start Date:</p>
                            <input type="date" class="form-control" id="startDate" name="startDate">

                            <p class="form-label">End Date:</p>
                            <input type="date" class="form-control" id="endDate" name="endDate">

                            <p class="form-label">Total Project Cost:</p>
                            <input type="text" class="form-control" id="projectCost" name="projectCost" placeholder="Add Project Cost">

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
                                placeholder="Add comment"
                            ></textarea>

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
                                    onchange="handleImageUploadMain(event)"
                                />
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
                    <h3 class="modal-title" style="font-weight: bold;">Sub Project Details</h3>
                </div>

                <form method="POST" action="user-page/functions/addSubProject.php" enctype="multipart/form-data">
                    <div class="modal-body" style="text-align: left;">
                        <hr style="border: 1px solid #27374D; width: 100%; margin: auto; margin-bottom: 20px;">

                        <p style="font-size: 20px;"><strong>Status:</strong>
                            <select class="form-control statusDropdown" id="statusDropdown" name="statusDropdown">
                                <option value="Done">Done</option>
                                <option value="In Progress">In Progress</option>
                                <option value="Incoming">Incoming</option>
                            </select>
                        </p>

                        <p style="font-size: 20px;"><strong>Main Project Name:</strong></p>
                        <select class="form-control mainproject" id="mainproject" name="mainproject">
                            <option value="">Select Main Project</option>
                            <?php
                            $projects = mysqli_query($conn, "SELECT * FROM user_mainproject");
                            if (mysqli_num_rows($projects) > 0) {
                                while ($row = mysqli_fetch_assoc($projects)) {
                                    $projId = $row['id'];
                                    $projName = $row['projectName'];
                                    $projStartDate = $row['startDate'];
                                    $projEndDate = $row['endDate'];
                                    echo "<option value='$projId' data-start='$projStartDate' data-end='$projEndDate'>$projName</option>";
                                }
                            } else {
                                echo "<option value=''>No Main Project Found!</option>";
                            }
                            ?>
                        </select>

                        <p style="font-size: 20px;"><strong>Sub Project Name:</strong></p>
                        <input type="input" class="form-control subProjectName" id="subProjectName" name="subProjectName" placeholder="Add Sub Project Name">

                        <p style="font-size: 20px;"><strong>Start Date:</strong></p>
                        <input type="date" class="form-control subStartDate" id="subStartDate" name="subStartDate" placeholder="">

                        <p style="font-size: 20px;"><strong>End Date:</strong></p>
                        <input type="date" class="form-control subEndDate" id="subEndDate" name="subEndDate" placeholder="">

                        <p style="font-size: 20px;"><strong>Total Project Cost:</strong></p>
                        <input type="text" class="form-control subProjectCost" id="subProjectCost" name="subProjectCost" placeholder="Add Project Cost">

                        <p style="font-size: 20px;"><strong>Fund Source:</strong></p>
                        <input type="text" class="form-control subFundSource" id="subFundSource" name="subFundSource" placeholder="Add Fund Source">

                        <p style="font-size: 20px;"><strong>Funding Agency:</strong></p>
                        <input type="text" class="form-control subFundingAgency" id="subFundingAgency" name="subFundingAgency" placeholder="Add Funding Agency">

                        <p style="font-size: 20px;"><strong>Comments:</strong></p>
                        <div class="comment-input-wrapper">
                            <textarea
                                class="form-control comment"
                                id="subComment"
                                name="subComment"
                                rows="4"
                                placeholder="Add comment"
                            ></textarea>

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
                                    onchange="handleImageUploadSub(event)"
                                />
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