<?php
include 'config.php';
include 'helpers.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = getUserId(); // Retrieve the user_id securely
    try {
        // Decode the JSON payload
        $input = json_decode(file_get_contents('php://input'), true);

        if (!isset($input['project_forms']) || empty($input['project_forms'])) {
            throw new Exception("No forms submitted.");
        }

        $project_forms = $input['project_forms'];
        if (!is_array($project_forms)) {
            throw new Exception("Invalid form data structure.");
        }

        $conn->begin_transaction();

        foreach ($project_forms as $project) {
            // Extract data from the current form
            $project_title = $project['project_title'];
            $project_year = $project['project_year'];
            $implementing_agency = $project['implementing_agency'];
            $fund_agency = $project['fund_agency'];
            $fund_source = $project['fund_source'];
            $mode_of_implementation = $project['mode_of_implementation'];
            $sector = $project['sector'];
            $total_cost = $project['total_cost'];
            $start_date = $project['start_date'];
            $end_date = $project['end_date'];
            $location = $project['location'];
            $city = $project['city'];
            $barangay = $project['barangay'];
            $remarks = $project['remarks'];
            $male = $project['male'];
            $female = $project['female'];
            $comp_details = $project['comp_details'];
            $year_financial_target = $project['year_financial_target'];
            $year_phy_target_percent = $project['year_phy_target_percent'];
            $submitted_designation = $project['submitted_designation'];


            // Insert data into related tables and get foreign keys
            // Check if project title and year combination already exists
            $stmt = $conn->prepare("SELECT project_id FROM UserProjectTitle WHERE project_title = ? AND project_year = ?");
            $stmt->bind_param("si", $project_title, $project_year);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                // Duplicate exists, return an error response
                echo json_encode([
                    'status' => 'error',
                    'message' => 'This project title already exists for the selected year.'
                ]);
                exit();
            }

            // If no duplicate, proceed to insert into UserProjectTitle
            $stmt = $conn->prepare("INSERT INTO UserProjectTitle (project_title, project_year) VALUES (?, ?)");
            $stmt->bind_param("si", $project_title, $project_year);
            $stmt->execute();
            $project_id = $conn->insert_id; // Retrieve the inserted project ID

            // 2. Insert into `UserImplementingAgency`
            $stmt = $conn->prepare("INSERT INTO UserImplementingAgency (implementing_agency) VALUES (?)");
            $stmt->bind_param("s", $implementing_agency);
            $stmt->execute();
            $implementing_agency_id = $conn->insert_id;

            // insert into usercompdetails
            $stmt = $conn->prepare("INSERT INTO Usercompdetails (comp_details) VALUES (?)");
            $stmt->bind_param("s", $comp_details);
            $stmt->execute();
            $comp_details_id = $conn->insert_id; // Get the inserted ID

            $stmt = $conn->prepare("
            INSERT INTO useryeartargets ( year_financial_target, year_phy_target_percent) 
            VALUES ( ?, ?)");
            $stmt->bind_param("ss", $year_financial_target, $year_phy_target_percent);
            $stmt->execute();
            $year_targets_id = $conn->insert_id; // Get the inserted ID

            $stmt = $conn->prepare("
            INSERT INTO userprojectvalidation (submitted_designation) 
            VALUES ( ?)");
            $stmt->bind_param("s", $submitted_designation );
            $stmt->execute();
            $project_validation_id = $conn->insert_id; // Get the inserted ID

            // 3. Insert into `UserFundSource`
            $stmt = $conn->prepare("INSERT INTO UserFundSource (fund_source) VALUES (?)");
            $stmt->bind_param("s", $fund_source);
            $stmt->execute();
            $fund_source_id = $conn->insert_id;

            // 4. Insert into `UserFundAgency`
            $stmt = $conn->prepare("INSERT INTO UserFundAgency (fund_agency) VALUES (?)");
            $stmt->bind_param("s", $fund_agency);
            $stmt->execute();
            $fund_agency_id = $conn->insert_id;

            // 5. Insert into `UserModeOfImplementation`
            $stmt = $conn->prepare("INSERT INTO UserModeOfImplementation (mode_of_implementation) VALUES (?)");
            $stmt->bind_param("s", $mode_of_implementation);
            $stmt->execute();
            $mode_of_implementation_id = $conn->insert_id;

            // 6. Insert into `UserSector`
            $stmt = $conn->prepare("INSERT INTO UserSector (sector) VALUES (?)");
            $stmt->bind_param("s", $sector);
            $stmt->execute();
            $sector_id = $conn->insert_id;

            // 7. Insert into `UserTotalCost`
            $stmt = $conn->prepare("INSERT INTO UserTotalCost (total_cost) VALUES (?)");
            $stmt->bind_param("d", $total_cost);
            $stmt->execute();
            $total_cost_id = $conn->insert_id;

            // 8. Insert into `UserSDateEDate`
            $stmt = $conn->prepare("INSERT INTO UserSDateEDate (start_date, end_date) VALUES (?, ?)");
            $stmt->bind_param("ss", $start_date, $end_date);
            $stmt->execute();
            $s_date_e_date_id = $conn->insert_id;

            // 9. Insert into `UserLocation`
            $stmt = $conn->prepare("INSERT INTO UserLocation (location, city, barangay) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $location, $city, $barangay);
            $stmt->execute();
            $location_id = $conn->insert_id;

            // 10. Insert into `UserRemarks`
            $stmt = $conn->prepare("INSERT INTO UserRemarks (remarks) VALUES (?)");
            $stmt->bind_param("s", $remarks);
            $stmt->execute();
            $remarks_id = $conn->insert_id;

            // 11. Insert into `UserTargetEmployee`
            $stmt = $conn->prepare("INSERT INTO UserTargetEmployee (male, female) VALUES (?, ?)");
            $stmt->bind_param("ii", $male, $female);
            $stmt->execute();
            $target_employee_id = $conn->insert_id;

            // 12. Insert into `InitialProjectReport`
            $stmt = $conn->prepare("
                INSERT INTO InitialProjectReport 
                (project_id, implementing_agency_id, fund_source_id, fund_agency_id, mode_of_implementation_id, 
                sector_id, total_cost_id, s_date_e_date_id, location_id, target_employee_id, remarks_id, user_id,comp_details_id, year_targets_id,project_validation_id) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?,?,?,?)");
            $stmt->bind_param("iiiiiiiiiiiiiii", $project_id, $implementing_agency_id, $fund_source_id, $fund_agency_id,
                $mode_of_implementation_id, $sector_id, $total_cost_id, $s_date_e_date_id, $location_id, $target_employee_id, $remarks_id,$user_id,$comp_details_id,$year_targets_id,$project_validation_id);
            $stmt->execute();
            $details_id = $conn->insert_id;
            // 13. Insert dynamic data: `UserOutputIndicator`, `UserTargetOutput`, `UserMtyTarget`

            // Handle `UserOutputIndicator`
            if (isset($project['output_indicators']) && is_array($project['output_indicators'])) {
                $output_indicators = $project['output_indicators'];
            } else {
                $output_indicators = json_decode($project['output_indicators'] ?? '', true); // Decode if necessary
            }

            if (!empty($output_indicators) && is_array($output_indicators)) {
                foreach ($output_indicators as $index => $output_indicator) {
                    $output_text = $output_indicator['output_indicator'] ?? null;
                    $position = $output_indicator['position'] ?? $index + 1;

                    if ($output_text) { // Ensure there's valid output text
                        $stmt = $conn->prepare("INSERT INTO UserOutputIndicator (output_indicator, output_indicator_position, details_id) VALUES (?, ?, ?)");
                        $stmt->bind_param("sii", $output_text, $position, $details_id);
                        $stmt->execute();
                    }
                }
            } else {
                // Optional: Log or handle the case where `output_indicators` is invalid or empty
                file_put_contents('debug_log.txt', "No valid output indicators found for details_id: $details_id\n", FILE_APPEND);
            }

            // Handle `UserTargetOutput`
            if (isset($project['target_outputs']) && is_array($project['target_outputs'])) {
                $target_outputs = $project['target_outputs'];
            } else {
                $target_outputs = json_decode($project['target_outputs'] ?? '', true); // Decode if necessary
            }

            if (!empty($target_outputs) && is_array($target_outputs)) {
                foreach ($target_outputs as $target_output) {
                    if ($target_output) { // Ensure there's valid target output text
                        $stmt = $conn->prepare("INSERT INTO UserTargetOutput (target_output, details_id) VALUES (?, ?)");
                        $stmt->bind_param("si", $target_output, $details_id);
                        $stmt->execute();
                    }
                }
            } else {
                // Optional: Log or handle the case where `target_outputs` is invalid or empty
                file_put_contents('debug_log.txt', "No valid target outputs found for details_id: $details_id\n", FILE_APPEND);
            }

        
            // 3. Insert into `UserMtyTarget`
            if (isset($project['monthly_targets']) && is_array($project['monthly_targets'])) {
                $monthly_targets = $project['monthly_targets']; // Use array directly if already decoded
            } else {
                $monthly_targets = json_decode($project['monthly_targets'] ?? '', true); // Decode if necessary
            }

            // Check if $monthly_targets is valid and not empty
            if (!empty($monthly_targets) && is_array($monthly_targets)) {
                foreach ($monthly_targets as $target) {
                    // Validate each target entry to ensure all necessary fields are present
                    $position = $target['position'] ?? null;
                    $start_date = $target['start'] ?? null;
                    $end_date = $target['end'] ?? null;
                    $financial_target = $target['financial'] ?? null;
                    $physical_target_percent = $target['physical'] ?? null;

                    // Only insert if at least one of the values is provided
                    if ($position !== null || $start_date !== null || $end_date !== null || $financial_target !== null || $physical_target_percent !== null) {
                        $stmt = $conn->prepare("
                            INSERT INTO UserMtyTarget (mty_target_position, period_start, period_end, financial_target, physical_target_percent, details_id)
                            VALUES (?, ?, ?, ?, ?, ?)");
                        $stmt->bind_param("issdii", 
                            $position, 
                            $start_date, 
                            $end_date, 
                            $financial_target, 
                            $physical_target_percent, 
                            $details_id
                        );
                        $stmt->execute();
                    }
                }
            } else {
                // Optional: Log or handle the case where `monthly_targets` is invalid or empty
                file_put_contents('debug_log.txt', "No valid monthly targets found for details_id: $details_id\n", FILE_APPEND);
            }
            }

        $conn->commit();
        echo json_encode(['status' => 'success', 'message' => 'Forms submitted successfully!']);

    } catch (Exception $e) {
        $conn->rollback();
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }
}
?>
