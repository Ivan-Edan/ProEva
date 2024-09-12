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
                    <button class="btn btn-primary">
                        Project <i class="fas fa-chevron-down"></i>
                    </button>
                </div>
                <div class="container-3">
                    <h3 class="project-title">Bridge Building</h3>
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
                        <tbody>
                            <tr class="main-task" data-target="#bridgeSubtasks1">
                                <td>
                                    <i class="fas fa-chevron-down task-icon"></i>
                                    <div class="blue-circle"></div>
                                    <span class="task-name">Bridge Building</span>
                                </td>
                                <td colspan="12">
                                    <span class="progress-bar" style="width: 100%;"></span>
                                </td>
                            </tr>
                            <!-- Subtask under Bridge Building -->
                            <tr id="bridgeSubtasks1" class="subtasks">
                                <td class="subtask-name">Designing</td>
                                <td colspan="4">
                                    <span class="progress-bar-subtask" style="width: 80%;"></span>
                                </td>
                                <td colspan="8"></td>
                            </tr>
                            <tr class="main-task" data-target="#bridgeSubtasks2">
                                <td>
                                    <i class="fas fa-chevron-down task-icon"></i>
                                    <div class="blue-circle"></div>
                                    <span class="task-name">Place Cement</span>
                                </td>
                                <td></td><td></td>
                                <td colspan="3">
                                    <span class="progress-bar-subtask" style="width: 50%;"></span>
                                </td>
                                <td colspan="8"></td>
                            </tr>
                            <!-- Subtask under Place Cement -->
                            <tr id="bridgeSubtasks2" class="subtasks">
                                <td class="subtask-name">Mixing Materials</td>
                                <td colspan="3">
                                    <span class="progress-bar-subtask" style="width: 70%;"></span>
                                </td>
                                <td colspan="9"></td>
                            </tr>
                            <tr class="main-task" data-target="#bridgeSubtasks3">
                                <td>
                                    <i class="fas fa-chevron-down task-icon"></i>
                                    <div class="blue-circle"></div>
                                    <span class="task-name">Resource Procuring</span>
                                </td>
                                <td></td>
                                <td colspan="11">
                                    <span class="progress-bar-subtask" style="width: 90%;"></span>
                                </td>
                            </tr>
                            <tr id="bridgeSubtasks3" class="subtasks">
                                <td class="subtask-name">Resource Collection</td>
                                <td colspan="4">
                                    <span class="progress-bar-subtask" style="width: 60%;"></span>
                                </td>
                                <td colspan="8"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <br>
                <br>
                <div class="container-7">Project Backlog</div>
                <div class="container-8 position-relative">
                    <!-- Button container for the two buttons -->
                    <div class="button-container position-absolute d-flex flex-column" style="top: 20px; right: 30px;">
                        <button type="button" class="btn btn-primary mb-2">
                            <i class="fas fa-plus"></i> Add Main Project Details
                        </button>
                        <button type="button" class="btn btn-secondary">
                            <i class="fas fa-plus"></i> Add Sub Project Details
                        </button>
                    </div>
                    <div class="row">
                        <div class="col-md-3 mx-5 mt-7">
                            <div class="card" style="height: 350px; background-color: #F8F8F8;">
                                <div class="card-body">
                                    <div class="card card-head">
                                        <div class="card-title">
                                            <p class="card-text">Project Done</p>
                                        </div>
                                    </div>
                                    <p class="card-text-detail">Build a Community Center</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mx-5 mt-7">
                            <div class="card" style="height: 350px; background-color: #F8F8F8;">
                                <div class="card-body">
                                    <div class="card card-head">
                                        <div class="card-title">
                                            <p class="card-text">Project On progress</p>
                                        </div>
                                    </div>
                                    <p class="card-text-detail">Build Foundation</p>
                                    <p class="card-text-detail">Relief Facilities</p>
                                    <p class="card-text-detail">Road Widening</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mx-5 mt-7">
                            <div class="card" style="height: 350px; background-color: #F8F8F8;">
                                <div class="card-body">
                                    <div class="card card-head">
                                        <div class="card-title">
                                            <p class="card-text">Project Incoming</p>
                                        </div>
                                    </div>
                                    <p class="card-text-detail">Build Foundation for Brgy Sinalhan</p>
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
            <h3 class="modal-title" style="font-weight: bold;">Project Title</h3>
            <h6 class="modal-title" id="taskModalLabel" style="font-weight: normal;">Bridge Building</h6>
        </div>
        <div class="modal-body" style="text-align: left;">
            <hr style="border: 1px solid #27374D; width: 100%; margin: auto; margin-bottom: 20px;">
            <p style="font-size: 20px;"><strong>Status:</strong> In progress</p>
            <p style="font-size: 20px;"><strong>Project Details</strong></p>
            <p><strong>Start Date:</strong> January 27, 2024</p>
            <p><strong>End Date:</strong> September 12, 2024</p>
            <p><strong>Total Project Cost:</strong> 1,000,000,000</p>
            <p><strong>Fund Source:</strong> LFP</p>
            <p><strong>Funding Agency:</strong> DA</p>
            <p style="font-size: 20px;"><strong>Comments:</strong></p>
            <textarea class="form-control" rows="4" placeholder="add comment"></textarea>
        </div>
        <div class="modal-footer" style="border-top: none; justify-content: flex-end;">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="background-color: #C4C4C4; border-radius: 25px; width: 150px; border-color: #C4C4C4;">Cancel</button>
            <button type="button" class="btn btn-primary" style="background-color: #27374D; border-radius: 25px; width: 150px; border-color: #27374D; margin-left: 10px;">Submit</button>
        </div>
        </div>
    </div>
    </div>

    <!-- Include JavaScript -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="scripts/user-monitoring.js"></script>
</body>
</html>
