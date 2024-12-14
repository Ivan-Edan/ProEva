<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="<?php echo 'images/landing-pic.png'; ?>">
    <title>Archive Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles/user-archive.css"> 
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
                                <th class="text-center">Form Type</th>
                                <th class="text-center">Date Created</th>
                            </tr>
                        </thead>
                        <tbody id="table-body">
                            <!-- Additional rows can be added dynamically through JavaScript <td class="text-center download-link"> -->
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
    <script src="scripts/user-archive.js"></script>
</body>
</html>
