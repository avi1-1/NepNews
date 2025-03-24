document.getElementById("admin-login-form").addEventListener("submit", function(event) {
    event.preventDefault();

    const email = document.getElementById("admin-email").value;
    const password = document.getElementById("admin-password").value;

    if (email === "admin@example.com" && password === "admin123") {
        window.location.href = "admin-dashboard.html"; 
    } else {
        alert("Invalid Admin Credentials.");
    }
});
