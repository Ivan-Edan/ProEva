<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/x-icon" href="<?php echo 'images/landing-pic.png'; ?>">
    <title>ProEva</title>

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@feathericons/fontawesome@1.0.0/dist/feather.css" />
    <!-- Styles -->
    <link rel="stylesheet" href="<?php echo 'styles/style.css'; ?>" />
    <!-- JS -->
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@feathericons/fontawesome@1.0.0/dist/feather.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Spinner -->
    <link rel="stylesheet" href="<?php echo 'styles/spinner.css'; ?>" />
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<?php include 'spinner.html'; ?>
    <div class="container">
        <div class="forms-container">
            <div class="signin-signup">
                <!-- Sign In Form -->
                <form action="#" class="sign-in-form">
                    <div class="text-container-landing">
                        <img src="<?php echo 'images/landing-pic.png'; ?>" class="landing-image" alt="">
                    </div>
                    <h2 class="title">ProEva: Project Monitoring System</h2>
                    <input type="submit" class="btn" value="LOGIN" id="sign-up-btn" />
                </form>

                <!-- Login Form -->
                <form action="<?php echo 'login.php'; ?>" method="POST" class="sign-up-form">
                    <h2 class="title login-title">LOGIN</h2>
                    <div class="text-container">
                        <p class="social-text">Enter your existing account to start your progress</p>
                    </div>
                    <label class="label-field" for="email">Email</label>
                    <div class="input-field">
                        <img src="<?php echo 'images/svg/user.svg'; ?>" />
                        <input type="email" id="email" name="email" placeholder="e.g juancarlos@gmail.com" required />
                    </div>
                    <br>
                    <label class="label-field" for="password">Password</label>
                    <div class="input-field-password">
                        <img src="<?php echo 'images/svg/lock.svg'; ?>" alt="Lock Icon" />
                        <input type="password" id="password" name="password" placeholder="Account password" required />
                        <img src="<?php echo 'images/svg/eye.svg'; ?>" id="togglePassword" class="toggle-password" alt="Toggle Password Visibility" />
                    </div>
                    <p class="social-text-text" id="forgotPasswordLink">Forgot password?</p>
                    <input type="submit" value="Login" class="btn solid" id="login-form"/>
                </form>
            </div>
        </div>
        <div class="panels-container">
            <div class="panel left-panel">
                <div class="content">
                    <h3>Learn More !</h3>
                    <br><br>
                    <button class="btn transparent about-btn">About</button>
                </div>
                <img src="<?php echo 'images/svg/register.svg'; ?>" class="image" alt="" />
            </div>
            <div class="panel right-panel">
                <div class="content">
                    <h3>Welcome Back!</h3>
                    <br>
                    <p>Go back to Homepage ?</p>
                    <br>
                    <button class="btn transparent" id="sign-in-btn">Home</button>
                </div>
                <img src="<?php echo 'images/svg/log.svg'; ?>" class="image" alt="" />
            </div>
        </div>
    </div>

<!-- Email Input Modal (First Step) -->
<div id="emailModal" class="modal">
    <div class="modal-content">
        <h2 class="title login-title-2">Forgot Password</h2>
        <div class="text-container">
            <p class="social-text-2">Enter your email address to reset your password</p>
        </div>
        <form action="send_reset_email.php" method="POST">
            <label class="label-field-2" for="email">Email</label>
            <div class="input-field">
                <img src="<?php echo 'images/svg/user.svg'; ?>" />
                <input type="email" id="resetEmail" name="resetEmail" placeholder="Enter your email" required />
            </div>
            <div class="modal-buttons">
                <input type="submit" value="Submit" class="btn" id="submitEmail" disabled />
                <button type="button" class="btn cancel-btn" id="cancelEmail">Cancel</button>
            </div>
        </form>
    </div>
</div>

<!-- Password Reset Modal (Second Step) -->
<div id="passwordResetModal" class="modal">
    <div class="modal-content">
        <h2 class="title login-title-2">Reset Your Password</h2>
        <div class="text-container">
            <p class="social-text-2">Enter your new password for your account</p>
        </div>
        <form action="reset_password.php" method="POST">
            <label class="label-field-2" for="newPassword">New Password</label>
            <div class="input-field-password input-field-password-modal">
                <input type="password" id="newPassword" name="newPassword" placeholder="Enter your new password" required />
                <img src="<?php echo 'images/svg/eye.svg'; ?>" id="toggleNewPassword" class="toggle-password" alt="Toggle Password Visibility" />
            </div>
            <br>
            <label class="label-field-2" for="confirmPassword">Confirm New Password</label>
            <div class="input-field-password input-field-password-modal">
                <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirm your new password" required />
                <img src="<?php echo 'images/svg/eye.svg'; ?>" id="toggleConfirmPassword" class="toggle-password" alt="Toggle Password Visibility" />
            </div>

            <div id="passwordMismatchMessage" style="color: red; display: none;">
                <p>Passwords do not match. Please try again.</p>
            </div>

            <div class="modal-buttons">
                <input type="submit" value="Submit" class="btn" id="submitResetForm" disabled />
                <button type="button" class="btn cancel-btn" id="cancelResetForm">Cancel</button>
            </div>
        </form>
    </div>
</div>


<script>
    // Email Modal Input Validation
    const resetEmailInput = document.getElementById('resetEmail');
    const submitEmailButton = document.getElementById('submitEmail');

    resetEmailInput.addEventListener('input', function() {
        if (resetEmailInput.value.trim() === "") {
            submitEmailButton.disabled = true;
        } else {
            submitEmailButton.disabled = false;
        }
    });

    // Password Reset Modal Input Validation
    const newPasswordInput = document.getElementById('newPassword');
    const confirmPasswordInput = document.getElementById('confirmPassword');
    const submitResetFormButton = document.getElementById('submitResetForm');

    function toggleSubmitButton() {
        if (newPasswordInput.value.trim() === "" || confirmPasswordInput.value.trim() === "") {
            submitResetFormButton.disabled = true;
        } else {
            submitResetFormButton.disabled = false;
        }
    }

    newPasswordInput.addEventListener('input', toggleSubmitButton);
    confirmPasswordInput.addEventListener('input', toggleSubmitButton);
</script>


<!-- Modal about us-->
<div id="aboutModal" class="modalAbout">
    <div class="modal-content">
        <span class="close" id="closeAboutModal">&times;</span>
        <h2 class="title page">About Us</h2>
        <hr class="heading-line">
        <img class="CPDO" src="images/CPDO.png">
        <p class="about-us">The <b>City Planning and Development Office (CPDO)</b> of Santa Rosa City, Laguna, is dedicated to ensuring that 
            urban development aligns with the city’s long-term goals of sustainability and progress. The <b>Project Monitoring System </b> is a 
            vital tool used by CPDO to track and assess the implementation of various city 
            development projects. This system allows for monitoring, data collection, and analyze of project 
            performance, ensuring that resources are efficiently allocated, timelines are adhered to, and outcomes meet the 
            strategic objectives for the city's growth and development.</p>
    </div>
</div>

<script src="<?php echo 'scripts/app.js'; ?>"></script>
<script src="<?php echo 'scripts/spinner.js'; ?>"></script>
<script>
    // Handle forgot password functionality
    const forgotPasswordLink = document.querySelector("#forgotPasswordLink");
    const emailModal = document.getElementById("emailModal");
    const submitEmailBtn = document.getElementById("submitEmail");
    const passwordResetModal = document.getElementById("passwordResetModal");
    const cancelEmailBtn = document.getElementById("cancelEmail");
    const cancelResetForm = document.getElementById("cancelResetForm");

    forgotPasswordLink.addEventListener("click", function() {
        emailModal.style.display = "block";
    });

    submitEmailBtn.addEventListener("click", function(event) {
        event.preventDefault();
        emailModal.style.display = "none";
        passwordResetModal.style.display = "block";
    });

    cancelEmailBtn.addEventListener("click", function() {
        emailModal.style.display = "none";
    });

    cancelResetForm.addEventListener("click", function() {
        passwordResetModal.style.display = "none";
    });

    // Password mismatch check
    var resetForm = document.querySelector("form");
    var newPassword = document.getElementById("newPassword");
    var confirmPassword = document.getElementById("confirmPassword");
    var passwordMismatchMessage = document.getElementById("passwordMismatchMessage");

    resetForm.addEventListener("submit", function(event) {
        if (newPassword.value !== confirmPassword.value) {
            event.preventDefault();
            passwordMismatchMessage.style.display = "block";
        }
    });

    // Toggle password visibility for new and confirm password
    const toggleNewPassword = document.querySelector("#toggleNewPassword");
    const toggleConfirmPassword = document.querySelector("#toggleConfirmPassword");
    const newPasswordField = document.querySelector("#newPassword");
    const confirmPasswordField = document.querySelector("#confirmPassword");

    toggleNewPassword.addEventListener("click", function() {
        const type = newPasswordField.getAttribute("type") === "password" ? "text" : "password";
        newPasswordField.setAttribute("type", type);
        toggleNewPassword.src = type === "password" ? "images/svg/eye.svg" : "images/svg/eye-slash.svg";
    });

    toggleConfirmPassword.addEventListener("click", function() {
        const type = confirmPasswordField.getAttribute("type") === "password" ? "text" : "password";
        confirmPasswordField.setAttribute("type", type);
        toggleConfirmPassword.src = type === "password" ? "images/svg/eye.svg" : "images/svg/eye-slash.svg";
    });
</script>
<script>
    // Ensure the modal is hidden when the page loads
    $(document).ready(function() {
        $("#aboutModal").hide(); // Hide modal initially

        // Show the About Modal when About button is clicked
        $(".btn.transparent.about-btn").on("click", function() {
            $("#aboutModal").fadeIn();
        });

        // Close the modal when the close button is clicked
        $("#closeAboutModal").on("click", function() {
            $("#aboutModal").fadeOut();
        });

        // Close modal if clicked outside of modal content
        $(window).on("click", function(event) {
            if ($(event.target).is("#aboutModal")) {
                $("#aboutModal").fadeOut();
            }
        });
    });
</script>


</body>
</html>
