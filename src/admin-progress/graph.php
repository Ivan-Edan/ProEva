<?php
if (isset($_GET['project_id'])) {
    $projectId = $_GET['project_id'];

    // Fetch data for the selected project
    $sqlMain = "SELECT * FROM user_mainproject WHERE project_id = ?";
    $stmt = $conn->prepare($sqlMain);
    $stmt->bind_param("s", $projectId);
    $stmt->execute();
    $resultMain = $stmt->get_result();

    if ($resultMain->num_rows > 0) {
        $main = $resultMain->fetch_assoc();
        $mainId = $main['id'];
        $formattedIdMain = $main['formatted_id'];
        $projectName = $main['projectName'];
        $startMonth = (int)(new DateTime($main['startDate']))->format('n');
        $endMonth = (int)(new DateTime($main['endDate']))->format('n');
        $duration = $endMonth - $startMonth + 1;
        $status = $main['status'];

        // Prepare data for the graph
        $months = [];
        $progress = [];
        for ($i = 1; $i <= 12; $i++) {
            $months[] = date("F", mktime(0, 0, 0, $i, 10)); // Generate month names
            $progress[] = ($i >= $startMonth && $i <= $endMonth) ? 100 : 0; // Progress data
        }

        // Initialize variables for subtasks
        $commentsMain = [];
        $photosMain = [];
        $fullnamesMain = [];

        // Fetch all comments for the subtask
        $commentMainQuery = "SELECT m.*, u.* FROM main_comment m JOIN users_info u ON u.user_id = m.userId
                           WHERE m.formatted_id_main = ?"; 
        $stmtMain = $conn->prepare($commentMainQuery);
        $stmtMain->bind_param("s", $formattedIdMain);
        $stmtMain->execute();
        $commentResultsMain = $stmtMain->get_result();

        if ($commentResultsMain->num_rows > 0) {
            while ($comm = $commentResultsMain->fetch_assoc()) {
                $commentsMain[] = $comm['comment'];
                $photosMain[] = $comm['photoPath_admin'];
                $fullnamesMain[] = $comm['first_name'] . ' ' . $comm['last_name'];
            }
        }

        // Convert arrays into a string for easier handling later
        $commentsMainString = implode(" | ", $commentsMain);
        $photosMainString = implode(" | ", $photosMain);
        $fullnamesMainString = implode(" | ", $fullnamesMain);

        echo "<tr class='main-task' data-target='#maintask_$mainId'
                data-project-name='$projectName'
                data-start-date='".$main['startDate']."'
                data-end-date='".$main['endDate']."'
                data-total-cost='".$main['projectCost']."'  
                data-fund-source='".$main['fundSource']."' 
                data-funding-agency='".$main['fundAgency']."'
                data-status='".$main['status']."'
                data-comments='".$commentsMainString."'
                data-photos='$photosMainString'
                data-fullnames='$fullnamesMainString'
                data-id-formatted='$formattedIdMain'
                data-id='$mainId'
                data-type='main'>";

        echo "<td>
                <i class='fas fa-chevron-down task-icon'></i>
                <div class='blue-circle'></div>
                <span class='task-name'>$projectName</span>
            </td>";
        for ($i = 1; $i <= 12; $i++) {
            if ($i == $startMonth) {
                echo "<td colspan='$duration'><span class='progress-bar' style='width: 100%;'></span></td>";
                $i += $duration - 1;
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
                        $photosSub[] = $comm['photoPath_admin'];
                        $fullnamesSub[] = $comm['first_name'] . ' ' . $comm['last_name'];
                    }
                }

                // Convert arrays into a string for easier handling later
                $commentsSubString = implode(" | ", $commentsSub);
                $photosSubString = implode(" | ", $photosSub);
                $fullnamesSubString = implode(" | ", $fullnamesSub);

                // Display subtask row
                echo "<tr class='subtask-name' data-target='#subtasks_$subId'
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
    } else {
        echo "Project not found.";
        exit;
    }
} else {
    echo "No project selected.";
    exit;
}
?>
