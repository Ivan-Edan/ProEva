<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="images/landing-pic.png">
    <title>Account Management</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
                            <input type="text" class="form-control search-input" placeholder="Search by First or Last Name" id="searchBar">
                        </div>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAccountModal">
                            <img src="images/svg/plus.svg" class="nav-icon"> Add Account
                        </button>
                    </div>
                    <br>
                    <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-center">Last Name</th>
                                <th class="text-center">First Name</th>
                                <th class="text-center">Middle Name</th>
                                <th class="text-center">Department <i id="sort-icon" class="fas fa-sort"></i></th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Role</th>
                                <th class="text-center">Date Added</th>
                            </tr>
                        </thead>
                        <tbody id="account-table-body">
                            <!-- Account entries will be updated dynamically -->
                        </tbody>
                    </table>
                    </div>
                    <div id="pagination-controls" class="d-flex justify-content-center mt-3">
                        <!-- Pagination buttons will be dynamically added here -->
                    </div>

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
                            <div class="col-md-6">
                                <label for="firstName" class="form-label">First Name</label>
                                <input class="form-control" id="firstName" name="first_name" placeholder="Juan Carlos" required>
                            </div>
                            <div class="col-md-6">
                                <label for="middleName" class="form-label">Middle Name</label>
                                <input class="form-control" id="middleName" name="middle_name" placeholder="Castro">
                            </div>
                            <div class="col-md-6">
                                <label for="lastName" class="form-label">Last Name</label>
                                <input class="form-control" id="lastName" name="last_name" placeholder="Cruz" required>
                            </div>
                            <div class="col-md-6">
                                <label for="suffix" class="form-label">Suffix</label>
                                <input class="form-control" id="suffix" name="suffix" placeholder="Jr">
                            </div>
                        </div>

                        <!-- Account Information Section -->
                        <h6>Account Information</h6>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="cruz@gmail.com" required>
                            </div>
                            <div class="col-md-6">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                            </div>
                        </div>
                        <div class="row mb-3">
    <div class="col-md-6">
        <label for="role" class="form-label">Role Type</label>
        <select class="form-select" id="role" name="role" required>
            <option value="" disabled selected>Select a role</option>
            <option value="Admin">Admin</option>
            <option value="User">User</option>
        </select>
    </div>
    <div class="col-md-6">
        <label for="department" class="form-label">Department</label>
        <select class="form-select" id="department" name="department" required>
            <option value="" disabled selected>Select a department</option>
            <!-- Dynamic options will be inserted here -->
        </select>
    </div>
</div>

<script>
    const roleSelect = document.getElementById('role');
    const departmentSelect = document.getElementById('department');

    // Fetch departments and store them for dynamic control
    let allDepartments = [];

    fetch('includes/fetch_departments.php')
        .then(response => response.json())
        .then(data => {
            allDepartments = data; // Store fetched departments
            populateDepartments(allDepartments); // Initially populate all departments
        })
        .catch(error => console.error('Error fetching departments:', error));

    // Populate department dropdown
    function populateDepartments(departments) {
        // Clear the existing options
        departmentSelect.innerHTML = '<option value="" disabled selected>Select a department</option>';

        if (departments.length > 0) {
            departments.forEach(department => {
                const option = document.createElement('option');
                option.value = department.id;
                option.textContent = department.name;
                departmentSelect.appendChild(option);
            });
        } else {
            const noOption = document.createElement('option');
            noOption.value = "";
            noOption.textContent = "No departments available";
            noOption.disabled = true;
            departmentSelect.appendChild(noOption);
        }
    }

    // Adjust department options based on the selected role
    roleSelect.addEventListener('change', () => {
        if (roleSelect.value === "") {
            // Clear department options if no role is selected
            departmentSelect.innerHTML = '<option value="" disabled selected>Select a department</option>';
        } else if (roleSelect.value === "Admin") {
            // Show only the department with id = 1 for Admin
            const adminDepartments = allDepartments.filter(department => department.id === "1");
            populateDepartments(adminDepartments);
        } else if (roleSelect.value === "User") {
            // Show all departments starting from index 2 for User
            const userDepartments = allDepartments.slice(1); // Skip index 0 (assuming index 0 is for Admin)
            populateDepartments(userDepartments);
        }
    });
</script>


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
                        <input type="hidden" id="userId" name="userId">
                        <!-- Personal Information Section -->
                        <h6>Personal Information</h6>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="editFirstName" class="form-label">First Name</label>
                                <input class="form-control" id="editFirstName" placeholder="Juan Carlos">
                            </div>
                            <div class="col-md-6">
                                <label for="editMiddleName" class="form-label">Middle Name</label>
                                <input class="form-control" id="editMiddleName" placeholder="Castro">
                            </div>
                            <div class="col-md-6">
                                <label for="editLastName" class="form-label">Last Name</label>
                                <input class="form-control" id="editLastName" placeholder="Cruz">
                            </div>
                            <div class="col-md-6">
                                <label for="editSuffix" class="form-label">Suffix</label>
                                <input class="form-control" id="editSuffix" placeholder="Jr">
                            </div>
                        </div>

                        <!-- Account Information Section -->
                        <h6>Account Information</h6>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="editEmail" class="form-label">Email</label>
                                <input type="email" class="form-control" id="editEmail" placeholder="cruz@gmail.com">
                            </div>
                        </div>
                        <!-- Submit Buttons -->
                        <div class="d-flex justify-content-center">
                            <button type="button" class="btn btn-danger me-2" id="deleteAccountBtn">Delete</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Modal -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="addAccountLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img src="images/illustration/successful.png" class="icon-modal-success" alt="Success Icon">
                    <h5 class="text-modal">The account has been created successfully.</h5>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Edit Modal -->
<div class="modal fade" id="successEditModal" tabindex="-1" aria-labelledby="successEditLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img src="images/illustration/successful.png" class="icon-modal-success" alt="Success Icon">
                <h5 class="text-modal">The account has been edited successfully.</h5>
            </div>
        </div>
    </div>
</div>

<!-- Success Delete Modal -->
<div class="modal fade" id="successDeleteModal" tabindex="-1" aria-labelledby="successDeleteLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img src="images/illustration/successful.png" class="icon-modal-success" alt="Success Icon">
                <h5 class="text-modal">The account has been deleted successfully.</h5>
            </div>
        </div>
    </div>
</div>

<!-- Delete Account Modal -->
<div class="modal fade deleteModals" id="deleteAccountModal" tabindex="-1" aria-labelledby="deleteAccountModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
        <img src="images/illustration/warning.png" class="icon-modal" alt="warning Icon">
                <h5 class="text-modal">Are you sure you want to delete this account?</h5>
            <div class="d-flex justify-content-center">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="button" id="confirmDeleteAccountBtn" class="btn btn-danger">Delete</button>
            </div>
        </div>
    </div>
</div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <script src="scripts/account-management.js"></script>

</body>
</html>
