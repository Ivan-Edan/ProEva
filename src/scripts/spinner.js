// Show the spinner overlay when the page starts loading
document.addEventListener("DOMContentLoaded", function() {
    const spinnerOverlay = document.getElementById("spinner-overlay");
    if (spinnerOverlay) {
        spinnerOverlay.style.display = "flex";  // Ensure spinner is visible while loading
    }
});

// Hide the spinner overlay when the page has fully loaded
window.addEventListener("load", function() {
    const spinnerOverlay = document.getElementById("spinner-overlay");
    if (spinnerOverlay) {
        spinnerOverlay.style.display = "none";  // Hide spinner when load is complete
    }
});
