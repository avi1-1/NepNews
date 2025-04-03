document.getElementById("admin-login-form").addEventListener("submit", function(event) {
    event.preventDefault();

    const email = document.getElementById("admin-email").value;
    const password = document.getElementById("admin-password").value;

    if (email === "admin@example.com" && password === "Admin@123") {
        window.location.href = "admin_dashboard.php"; 
    } else {
        alert("Invalid Admin Credentials.");
    }
});