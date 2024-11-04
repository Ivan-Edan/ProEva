<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="<?php echo 'images/landing-pic.png'; ?>">
    <title>Archive Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="styles/admin-archive.css">
</head>
<body>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="container-1">Archive</div>
                <div class="container-8">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-center">Project Name</th>
                                <th class="text-center">Department <i id="sort-icon" class="fas fa-sort"></i></th>
                                <th class="text-center">Form Type</th>
                            </tr>
                        </thead>
                        <tbody id="table-body">
                            <tr>
                                <td class="text-center">Bridge Building 1</td>
                                <td class="text-center">CPDO</td>
                                <td class="text-center download-link">SUMMARY OF FINANCIAL AND PHYSICAL ACCOMPLISHMENTS</td>
                            </tr>
                            <tr>
                                <td class="text-center">Bridge Building 1</td>
                                <td class="text-center">Accounting</td>
                                <td class="text-center download-link">REPORT ON THE STATUS OF PROJECTS ENCOUNTERING IMPLEMEN....</td>
                            </tr>
                            <tr>
                                <td class="text-center">Bridge Building 1</td>
                                <td class="text-center">Engineering</td>
                                <td class="text-center download-link">PROJECT INSPECTION REPORT</td>
                            </tr>
                            <!-- Additional rows can be added dynamically through JavaScript -->
                        </tbody>
                    </table>

                    <!-- Numbered Pagination Buttons -->
                    <nav aria-label="Page navigation">
                        <ul class="pagination justify-content-center" id="pagination-container"></ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- Include JavaScript -->
    <script src="scripts/admin-archive.js"></script>
    <script>
        document.getElementById("sort-icon").addEventListener("click", function() {
            sortTableAlphabetically();
            toggleSortIcon();
        });

        // Track sorting order; initialize to ascending.
        let ascending = true;

        // Function to sort table alphabetically by Department column
        function sortTableAlphabetically() {
            const tableBody = document.getElementById("table-body");
            const rows = Array.from(tableBody.rows);

            rows.sort((a, b) => {
                const deptA = a.cells[1].textContent.trim();
                const deptB = b.cells[1].textContent.trim();

                // Sort alphabetically; change direction based on `ascending`
                return ascending ? deptA.localeCompare(deptB) : deptB.localeCompare(deptA);
            });

            // Re-attach sorted rows to the table body
            rows.forEach(row => tableBody.appendChild(row));

            // Toggle sorting order for the next click
            ascending = !ascending;
        }

        // Function to toggle sort icon direction
        function toggleSortIcon() {
            const icon = document.getElementById("sort-icon");
            icon.classList.toggle("fa-sort-up", ascending);   // Ascending order
            icon.classList.toggle("fa-sort-down", !ascending); // Descending order
        }
    </script>
</body>
</html>
