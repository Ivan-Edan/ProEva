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
