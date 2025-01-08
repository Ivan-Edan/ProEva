const sign_in_btn = document.querySelector("#sign-in-btn");
const sign_up_btn = document.querySelector("#sign-up-btn");
const container = document.querySelector(".container");

sign_up_btn.addEventListener("click", () => {
  container.classList.add("sign-up-mode");
});

sign_in_btn.addEventListener("click", () => {
  container.classList.remove("sign-up-mode");
});

const togglePassword = document.querySelector("#togglePassword");
const passwordField = document.querySelector("#password");
const eyeIcon = document.querySelector("#togglePassword");
togglePassword.addEventListener("click", function () {
  // Toggle the type attribute
  const type = passwordField.getAttribute("type") === "password" ? "text" : "password";
  passwordField.setAttribute("type", type);
             
  // Toggle the eye icon
  eyeIcon.src = type === "password" ? "images/svg/eye.svg" : "images/svg/eye-slash.svg";
});

$(document).ready(function () {
  // Validate login form before submission
  $(".sign-up-form").on("submit", function (event) {
    event.preventDefault(); // Prevent form submission

    const email = $("#email").val().trim();
    const password = $("#password").val().trim();
    let isValid = true;

    // Remove previous error and success classes
    $(".error-message").remove();


    if (!isValid) {
      return; // Stop the form from submitting
    }

  // If form is valid, submit via AJAX
$.ajax({
  type: "POST",
  url: "login.php",
  data: $(this).serialize(),
  dataType: "json",
  success: function(response) {
    // Clear previous error messages and border styles
    $(".error-message").remove();
    $(".input-field").removeClass("border-danger border-success");
    $(".input-field-password").removeClass("border-danger border-success");

    if (response.error) {
      $(".sign-up-form").append("<p class='error-message'>" + response.error + "</p>");
      
      // Check the exact error message and apply border-danger accordingly
      if (response.error === "Invalid email and password combination. Please try again.") {
        // Both email and password are incorrect
        $(".input-field").addClass("border-danger");
        $(".input-field-password").addClass("border-danger");
      } else if (response.error.includes("email")) {
        // Only email is incorrect
        $(".input-field").addClass("border-danger");
      } else if (response.error.includes("password")) {
        // Only password is incorrect
        $(".input-field-password").addClass("border-danger");
      }
    } else if (response.redirect) {
      // Clear all error messages and apply success border styles
      $(".sign-up-form").append("<p class='success-message'>Login successful! Redirecting...</p>");
      $(".input-field").addClass("border-success");
      $(".input-field-password").addClass("border-success");
      window.location.href = response.redirect;
    }
  },
  error: function() {
    $(".sign-up-form").append("<p class='error-message'>An error occurred. Please try again.</p>");
  }
});


  });

  // Prevent spaces in input fields
  $("input").on("keydown", function(event) {
    if (event.key === " ") {
      event.preventDefault();
    }
  });

  // Limit input length and remove spaces
  $("input").on("input", function() {
    let input = $(this);
    let maxLength = input.attr("id") === "password" ? 20 : 255;
    let value = input.val();
    if (value.length > maxLength) {
      value = value.substring(0, maxLength);
      input.val(value);
    }
    value = value.replace(/\s/g, "");
    input.val(value);
  });

  // Remove error message and border classes on focus
  $("#email").on("focus", function() {
    $(".input-field").removeClass("border-danger border-success");
    $(".error-message").remove();
  });

  $("#password").on("focus", function() {
    $(".input-field-password").removeClass("border-danger border-success");
    $(".error-message").remove();
  });
});

// Email validation function
function validateEmail(email) {
  const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return re.test(email);
}
// Get the modal elements
var emailModal = document.getElementById("emailModal");
var passwordResetModal = document.getElementById("passwordResetModal");

// Get the link and buttons
var forgotPasswordLink = document.querySelector("#forgotPasswordLink");
var submitEmailBtn = document.getElementById("submitEmail");
var cancelEmailBtn = document.getElementById("cancelEmail");
var cancelResetForm = document.getElementById("cancelResetForm");

// Show the email modal when clicking the "Forgot Password" link
forgotPasswordLink.addEventListener("click", function() {
    emailModal.style.display = "block"; // Show the email modal
});

// Show the password reset modal after submitting the email
submitEmailBtn.addEventListener("click", function(event) {
    event.preventDefault(); // Prevent form submission for now (you can replace this with actual AJAX submission if needed)
    
    // After submitting the email, hide the email modal and show the password reset modal
    emailModal.style.display = "none"; // Hide the email modal
    passwordResetModal.style.display = "block"; // Show the password reset modal
});

// Close the email modal when the cancel button is clicked
cancelEmailBtn.addEventListener("click", function() {
    emailModal.style.display = "none"; // Hide the email modal
});

// Close the password reset modal when the cancel button is clicked
cancelResetForm.addEventListener("click", function() {
    passwordResetModal.style.display = "none"; // Hide the password reset modal
});




// Password confirmation validation
var resetForm = document.querySelector("form");
var newPassword = document.getElementById("newPassword");
var confirmPassword = document.getElementById("confirmPassword");
var passwordMismatchMessage = document.getElementById("passwordMismatchMessage");

resetForm.addEventListener("submit", function(event) {
    // If passwords do not match, prevent form submission
    if (newPassword.value !== confirmPassword.value) {
        event.preventDefault(); // Stop form submission
        passwordMismatchMessage.style.display = "block"; // Show the mismatch message
    }
});
// Get the cancel button element
var cancelResetForm = document.getElementById("cancelResetForm");

// Get the modal element
var modal = document.getElementById("passwordResetModal");

// Add event listener to the cancel button
cancelResetForm.addEventListener("click", function() {
    // Hide the modal when cancel button is clicked
    modal.style.display = "none";
});
// Get both toggle buttons
const toggleNewPassword = document.querySelector("#toggleNewPassword");
const toggleConfirmPassword = document.querySelector("#toggleConfirmPassword");

// Get the password fields
const newPasswordField = document.querySelector("#newPassword");
const confirmPasswordField = document.querySelector("#confirmPassword");

// Toggle password visibility for the new password field
toggleNewPassword.addEventListener("click", function() {
  const type = newPasswordField.getAttribute("type") === "password" ? "text" : "password";
  newPasswordField.setAttribute("type", type);
  toggleNewPassword.src = type === "password" ? "images/svg/eye.svg" : "images/svg/eye-slash.svg";
});

// Toggle password visibility for the confirm password field
toggleConfirmPassword.addEventListener("click", function() {
  const type = confirmPasswordField.getAttribute("type") === "password" ? "text" : "password";
  confirmPasswordField.setAttribute("type", type);
  toggleConfirmPassword.src = type === "password" ? "images/svg/eye.svg" : "images/svg/eye-slash.svg";
});






$(document).ready(function() {
  $("#submitResetForm").on("click", function(event) {
      event.preventDefault(); 

      var newPassword = $("#newPassword").val().trim();
      var confirmPassword = $("#confirmPassword").val().trim();
      var email = $("#resetEmail").val().trim(); 

      if (newPassword !== confirmPassword) {
          $("#passwordMismatchMessage").show(); 
          return;
      }

      $.ajax({
          type: "POST",
          url: "includes/reset_password.php",
          data: { newPassword: newPassword, confirmPassword: confirmPassword, email: email },
          dataType: "json",
          success: function(response) {
              if (response.status === "success") {
                  // Show success modal
                  $('#successEditModal').modal('show');
                  window.location.href = "login-welcome.php"; 
              } else {
                  alert(response.message); 
              }
          },
          error: function() {
              alert("An error occurred. Please try again.");
          }
      });
  });
});

$(document).ready(function() {
  $("#submitResetForm").on("click", function(event) {
      event.preventDefault(); 

      var newPassword = $("#newPassword").val().trim();
      var confirmPassword = $("#confirmPassword").val().trim();
      var email = $("#resetEmail").val().trim(); 

      if (newPassword !== confirmPassword) {
          $("#passwordMismatchMessage").show(); 
          return;
      }

      $.ajax({
          type: "POST",
          url: "includes/reset_password.php",
          data: { newPassword: newPassword, confirmPassword: confirmPassword, email: email },
          dataType: "json",
          success: function(response) {
              if (response.status === "success") {
                  alert("Password updated successfully.");
                  window.location.href = "login-welcome.php"; 
              } else {
                  alert(response.message); 
              }
          },
          error: function() {
              alert("An error occurred. Please try again.");
          }
      });
  });
});


// Clear input fields when the email modal is closed and disable the submit button
cancelEmailBtn.addEventListener("click", function() {
  emailModal.style.display = "none"; // Hide the email modal
  document.getElementById('resetEmail').value = ''; // Clear the email input
  document.getElementById('submitEmail').disabled = true; // Disable the submit button
});

// Clear input fields when the password reset modal is closed
cancelResetForm.addEventListener("click", function() {
  passwordResetModal.style.display = "none"; // Hide the password reset modal
  document.getElementById('newPassword').value = ''; // Clear the new password input
  document.getElementById('confirmPassword').value = ''; // Clear the confirm password input
  document.getElementById('passwordMismatchMessage').style.display = 'none'; // Hide mismatch message
  document.getElementById('resetEmail').value = ''; // Clear the email input
  document.getElementById('submitEmail').disabled = true; // Disable the submit button
});


