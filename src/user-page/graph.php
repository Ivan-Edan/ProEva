<?php
require_once '../includes/config.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['project_id']) && isset($_POST['user_id'])) {

    $projectId = $_POST['project_id'];
    $userId = $_POST['user_id'];
    $sqlMain = "SELECT * FROM user_mainproject WHERE project_id = ?";
    $stmt = $conn->prepare($sqlMain);
    $stmt->bind_param("i", $projectId);
    $stmt->execute();
    $resultMain = $stmt->get_result();

    if ($resultMain->num_rows > 0) {
        while ($main = $resultMain->fetch_assoc()) {
            $mainId = $main['id'];
            $formattedIdMain = $main['formatted_id'];
            $projectName = $main['projectName'];
            $startMonthMain = (int)(new DateTime($main['startDate']))->format('n');
            $endMonthMain = (int)(new DateTime($main['endDate']))->format('n');
            $durationMain = $endMonthMain - $startMonthMain + 1;
    
            // Initialize variables
            $comments = [];
            $photos = [];
            $fullnames = [];
    
            // Fetch all comments for the main project
            $commentMain = "SELECT m.*, u.* FROM main_comment m JOIN users_info u ON u.user_id = m.userId
                                WHERE m.formatted_id_main = ?"; 
            $stmt = $conn->prepare($commentMain);
            $stmt->bind_param("s", $formattedIdMain);
            $stmt->execute();
            $commentResults = $stmt->get_result();
    
            if ($commentResults->num_rows > 0) {
                while ($comm = $commentResults->fetch_assoc()) {
                    $comments[] = $comm['comment'];
                    $photos[] = $comm['photoPath'];
                    $fullnames[] = $comm['first_name'] . ' ' . $comm['last_name'];
                }
            }
    
            // Convert arrays into a string for easier handling later
            $commentsString = implode(" | ", $comments);
            $photosString = implode(" | ", $photos);
            $fullnamesString = implode(" | ", $fullnames);
    
            echo "<tr class='main-task' data-target='#maintask_$mainId'
                    data-project-name='$projectName'
                    data-start-date='".$main['startDate']."'
                    data-end-date='".$main['endDate']."'
                    data-total-cost='".$main['projectCost']."'  
                    data-fund-source='".$main['fundSource']."' 
                    data-funding-agency='".$main['fundAgency']."'
                    data-status='".$main['status']."'
                    data-comments='$commentsString'
                    data-photos='$photosString'
                    data-fullnames='$fullnamesString'
                    data-id-formatted='$formattedIdMain'
                    data-id='$mainId'
                    data-type='main'>";
    
            echo "<td>
                    <i class='fas fa-chevron-down task-icon'></i>
                    <div class='blue-circle'></div>
                    <span class='task-name'>$projectName</span>
                </td>";
            for ($i = 1; $i <= 12; $i++) {
                if ($i == $startMonthMain) {
                    echo "<td colspan='$durationMain'><span class='progress-bar' style='width: 100%;'></span></td>";
                    $i += $durationMain - 1;
                } else {
                    echo "<td></td>";
                }
            }
            echo "</tr>";
    
            // Fetch sub-projects for the main project
            $sqlSub = "SELECT * FROM user_subproject WHERE main_id = $mainId";
            $resultSub = $conn->query($sqlSub);
    
            if ($resultSub->num_rows > 0) {
                while ($sub = $resultSub->fetch_assoc()) {
                    $subId = $sub['id'];
                    $formattedIdSub = $sub['formatted_id'];
                    $subProjectName = $sub['subProjectName'];
                    $subStartMonth = (int)(new DateTime($sub['subStartDate']))->format('n');
                    $subEndMonth = (int)(new DateTime($sub['subEndDate']))->format('n');
                    $durationSub = $subEndMonth - $subStartMonth + 1;
    
                    // Initialize variables for subtasks
                    $commentsSub = [];
                    $photosSub = [];
                    $fullnamesSub = [];
    
                    // Fetch all comments for the subtask
                    $commentSubQuery = "SELECT m.*, u.* FROM sub_comment m JOIN users_info u ON u.user_id = m.userId
                                       WHERE m.formatted_id_sub = ?"; 
                    $stmtSub = $conn->prepare($commentSubQuery);
                    $stmtSub->bind_param("s", $formattedIdSub);
                    $stmtSub->execute();
                    $commentResultsSub = $stmtSub->get_result();
    
                    if ($commentResultsSub->num_rows > 0) {
                        while ($comm = $commentResultsSub->fetch_assoc()) {
                            $commentsSub[] = $comm['comment'];
                            $photosSub[] = $comm['photoPath'];
                            $fullnamesSub[] = $comm['first_name'] . ' ' . $comm['last_name'];
                        }
                    }
    
                    // Convert arrays into a string for easier handling later
                    $commentsSubString = implode(" | ", $commentsSub);
                    $photosSubString = implode(" | ", $photosSub);
                    $fullnamesSubString = implode(" | ", $fullnamesSub);
    
                    // Display subtask row
                    echo "<tr class='subtasks-name' data-target='#subtasks_$subId'
                           data-subproject-name='$subProjectName'
                           data-substart-date='".$sub['subStartDate']."'
                           data-subend-date='".$sub['subEndDate']."'
                           data-subtotal-cost='".$sub['subProjectCost']."'  
                           data-subfund-source='".$sub['subFundSource']."' 
                           data-subfunding-agency='".$sub['subFundingAgency']."'
                           data-substatus='".$sub['status']."'
                           data-subcomments='".$commentsSubString."'
                           data-subphotos='$photosSubString'
                           data-subfullnames='$fullnamesSubString'
                           data-id-formatted='$formattedIdSub'
                           data-id='$subId'
                           data-type='sub'>";
    
                    echo "<td class='subtask-name'>$subProjectName</td>";
                    for ($j = 1; $j <= 12; $j++) {
                        if ($j == $subStartMonth) {
                            echo "<td colspan='$durationSub'><span class='progress-bar-subtask' style='width: 100%;'></span></td>";
                            $j += $durationSub - 1;
                        } else {
                            echo "<td></td>";
                        }
                    }
                    echo "</tr>";
                }
            }
        }
    }
}

?>
