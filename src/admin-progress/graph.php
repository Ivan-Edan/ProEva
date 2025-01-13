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
        while ($main = $resultMain->fetch_assoc()) {
            $mainId = $main['id'];
            $formattedIdMain = $main['formatted_id'];
            $projectName = $main['projectName'];
            $startDateMain = new DateTime($main['startDate']);
            $endDateMain = new DateTime($main['endDate']);

            // Initialize variables for main project
            $comments = [];
            $photos = [];
            $fullnames = [];

            // Fetch comments for main project
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

            // Convert arrays to strings
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
                    <div class='blue-circle'></div>
                    <span class='task-name'>$projectName</span>
                  </td>";

            // Day-based Gantt chart rendering for main task
            for ($month = 1; $month <= 12; $month++) {
                for ($day = 1; $day <= 31; $day++) {
                    $currentDate = DateTime::createFromFormat('Y-n-j', date("Y") . "-$month-$day");

                    if ($currentDate && $currentDate >= $startDateMain && $currentDate <= $endDateMain) {
                        echo "<td class='active-day'><span class='progress-bar' style='width: 100%;'></span></td>";
                    } elseif ($currentDate) {
                        echo "<td></td>";
                    }
                }
            }

            echo "</tr>";

            // Fetch subtasks for the main project
$sqlSub = "SELECT * FROM user_subproject WHERE main_id = ?";
$stmtSub = $conn->prepare($sqlSub);
$stmtSub->bind_param("i", $mainId);
$stmtSub->execute();
$resultSub = $stmtSub->get_result();

if ($resultSub->num_rows > 0) {
    while ($sub = $resultSub->fetch_assoc()) {
        $subId = $sub['id'];
        $formattedIdSub = $sub['formatted_id'];
        $subProjectName = $sub['subProjectName'];

        // Initialize start and end dates as DateTime objects
        $subStartDate = new DateTime($sub['subStartDate']);
        $subEndDate = new DateTime($sub['subEndDate']);
        
        $subStartMonth = (int)$subStartDate->format('n');
        $subEndMonth = (int)$subEndDate->format('n');
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

        echo "<td><div class='light-circle'></div> <span class='subtasks-name'>$subProjectName</span></td>";

        // Day-based Gantt chart rendering for subtasks
        for ($month = 1; $month <= 12; $month++) {
            for ($day = 1; $day <= 31; $day++) {
                $currentDate = DateTime::createFromFormat('Y-n-j', date("Y") . "-$month-$day");

                if ($currentDate && $currentDate >= $subStartDate && $currentDate <= $subEndDate) {
                    echo "<td class='active-day'><span class='progress-bar' style='width: 100%;'></span></td>";
                } elseif ($currentDate) {
                    echo "<td></td>";
                }
            }
        }

        echo "</tr>";
    }
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