<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="images/landing-pic.png">
    <title>Account Management</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles/account-management.css"> 
</head>
<body>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="container-1">Account Management</div>
                <div class="container-3">
                <div class="d-flex align-items-center mb-3">
                    <div class="d-flex me-3 position-relative">
                        <img src="images/svg/search.svg" class="search-icon" id="searchIcon">
                        <input type="text" class="form-control search-input" placeholder="Search" id="searchBar">
                    </div>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAccountModal">
                        <img src="images/svg/plus.svg" class="nav-icon"> Add Account
                    </button>
                </div>
                    <br>
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-center">Last Name</th>
                                <th class="text-center">First Name</th>
                                <th class="text-center">Middle Name</th>
                                <th>Department</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Role</th>
                                <th>Date Added</th>
                            </tr>
                        </thead>
                        <tbody id="account-table-body">
                            <tr>
                                <td class="text-center">Edan</td>
                                <td class="text-center">Ivan Angelo</td>
                                <td class="text-center">Pastrana</td>
                                <td>Engineering Office</td>
                                <td class="text-center"><a href="#" class="edit-email" data-bs-toggle="modal" data-bs-target="#editAccountModal" data-first-name="Ivan Angelo" data-last-name="Edan" data-middle-name="Pastrana" data-department="Engineering Office" data-email="edan@gmail.com" data-role="Admin">edan@gmail.com</a></td>
                                <td class="text-center">Admin</td>
                                <td>January 27, 2024</td>
                            </tr>
                            <!-- Add more rows as needed -->
                        </tbody>
                    </table>
                    <br>
                    <nav>
                        <ul class="pagination justify-content-center mt-3">
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">4</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Account Modal -->
    <div class="modal fade" id="addAccountModal" tabindex="-1" aria-labelledby="addAccountLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addAccountLabel">Add Account</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addAccountForm">
                        <!-- Personal Information Section -->
                        <h6>Personal Information</h6>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="firstName" class="form-label">First Name</label>
                                <input class="form-control" id="firstName" placeholder="Juan Carlos">
                            </div>
                            <div class="col-md-4">
                                <label for="middleName" class="form-label">Middle Name</label>
                                <input class="form-control" id="middleName" placeholder="Castro">
                            </div>
                            <div class="col-md-4">
                                <label for="lastName" class="form-label">Last Name</label>
                                <input class="form-control" id="lastName" placeholder="Cruz">
                            </div>
                        </div>

                        <!-- Account Information Section -->
                        <h6>Account Information</h6>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" placeholder="cruz@gmail.com">
                            </div>
                            <div class="col-md-6">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" placeholder="Password">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="role" class="form-label">Role Type</label>
                                <select class="form-select" id="role">
                                    <option value="Admin">Admin</option>
                                    <option value="User">User</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="department" class="form-label">Department</label>
                                <select class="form-select" id="department">
                                    <option value="Engineering">Engineering</option>
                                    <option value="Agriculture">Agriculture</option>
                                    <!-- Add more departments as needed -->
                                </select>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary modal-btn">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Account Modal -->
    <div class="modal fade" id="editAccountModal" tabindex="-1" aria-labelledby="editAccountLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editAccountLabel">Edit Account</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editAccountForm">
                        <!-- Personal Information Section -->
                        <h6>Personal Information</h6>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="editFirstName" class="form-label">First Name</label>
                                <input class="form-control" id="editFirstName" placeholder="Juan Carlos">
                            </div>
                            <div class="col-md-4">
                                <label for="editMiddleName" class="form-label">Middle Name</label>
                                <input class="form-control" id="editMiddleName" placeholder="Castro">
                            </div>
                            <div class="col-md-4">
                                <label for="editLastName" class="form-label">Last Name</label>
                                <input class="form-control" id="editLastName" placeholder="Cruz">
                            </div>
                        </div>

                         <!-- Account Information Section -->
                        <h6>Account Information</h6>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" placeholder="cruz@gmail.com">
                            </div>
                            <div class="col-md-6">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" placeholder="Password">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="role" class="form-label">Role Type</label>
                                <select class="form-select" id="role">
                                    <option value="Admin">Admin</option>
                                    <option value="User">User</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="department" class="form-label">Department</label>
                                <select class="form-select" id="department">
                                    <option value="Engineering">Engineering</option>
                                    <option value="Agriculture">Agriculture</option>
                                    <!-- Add more departments as needed -->
                                </select>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary modal-btn delete">Delete</button>
                            <button type="submit" class="btn btn-primary modal-btn">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <script src="scripts/account-management.js"></script>
</body>
</html>
