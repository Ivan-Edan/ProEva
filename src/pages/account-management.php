<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Management</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles/account-management.css"> 
</head>

<body>
    <div class="container p-3 mb-4">
        <h2 class="text-center">Account Management</h2>
    </div>

    <div class="container-fluid p-4">
        <div class="row mb-5">
            <div class="col-md-3 position-relative">
                <input type="text" class="form-control search-input" placeholder="Search" id="searchBar">
                <img src="images/svg/search.svg" class="search-icon" id="searchIcon">
            </div>
            <div class="col-md-3">
                <button class="btn btn-primary"><img src="images/svg/plus.svg" class="nav-icon">Add Account </button>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table">
                <thead class="table-head table-dark">
                    <tr>
                        <th style=" border-top-left-radius: 10px;  border-bottom-left-radius: 10px;">Last Name</th>
                        <th>First Name</th>
                        <th>Middle Name</th>
                        <th>Department</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Role</th>
                        <th style=" border-top-right-radius: 10px;  border-bottom-right-radius: 10px;">Date Added</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Delacruz</td>
                        <td>Ian</td>
                        <td>Pastrana</td>
                        <td>Food Sector</td>
                        <td>JuanDelacruz@yahoo.com</td>
                        <td class="text-center">Admin</td>
                        <td>April 12, 2024</td>
                    </tr>
                    <tr>
                        <td>Del Ray</td>
                        <td>Ryan Carlos</td>
                        <td>Acede</td>
                        <td>Agriculture</td>
                        <td>lunadelray@gmail.com</td>
                        <td class="text-center">Admin</td>
                        <td>March 25, 2024</td>
                    </tr>
                    <tr>
                        <td>Delazar</td>
                        <td>Rian Mae</td>
                        <td>Oliver</td>
                        <td>Agriculture</td>
                        <td>johnjohnDelacruz@gmail.com</td>
                        <td class="text-center">Admin</td>
                        <td>December 25, 2023</td>
                    </tr>
                    <tr>
                        <td>Perez</td>
                        <td>Daisy</td>
                        <td>Reyes</td>
                        <td>Agriculture</td>
                        <td>kolabear@yahoo.com</td>
                        <td class="text-center">Admin</td>
                        <td>April 25, 2024</td>
                    </tr>
                    <tr>
                        <td>Campos</td>
                        <td>Carlos</td>
                        <td>Acede</td>
                        <td>Food Sector</td>
                        <td>benben@yahoo.com</td>
                        <td class="text-center">Admin</td>
                        <td>April 12, 2024</td>
                    </tr>
                    <tr>
                        <td>Yap</td>
                        <td>Juan</td>
                        <td>Punzalan</td>
                        <td>Food Sector</td>
                        <td>paulsam@yahoo.com</td>
                        <td class="text-center">Head Admin</td>
                        <td>April 03, 2024</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <nav>
            <ul class="pagination justify-content-center mt-3">
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">4</a></li>
            </ul>
        </nav>
    </div>
<script>
document.getElementById("searchBar").addEventListener("input", function() {
    const searchIcon = document.getElementById("searchIcon");
    
    if (this.value.length > 0) {
        searchIcon.style.display = "none";
    } else {
        searchIcon.style.display = "block";
    }
});

</script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
