$(document).ready(function () {
    $("#admin-login-form").on("submit", function (e) {
        e.preventDefault(); // Prevent normal form submission

        $.ajax({
            url: "admin_login.php",
            type: "POST",
            data: $(this).serialize() + '&ajax=true', // Include 'ajax=true' flag
            dataType: "json",
            success: function (response) {
                if (response.status === "success") {
                    alert(response.message);
                    window.location.href = "../AdminDashboard/ad.html"; // Redirect on success
                } else {
                    alert(response.message); // Show error message
                }
            },
            error: function () {
                alert("An unexpected error occurred. Please try again.");
            }
        });
    });
});