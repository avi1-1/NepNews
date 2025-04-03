document.getElementById("roles-login-form").addEventListener("submit", async function (event) {
    event.preventDefault(); // Prevent default form submission

    // Get input values
    let email = document.getElementById("login-email").value.trim();
    let password = document.getElementById("login-password").value.trim();
    let role = document.getElementById("role-selection").value;

    if (!email || !password || !role) {
        alert("Please fill in all fields.");
        return;
    }

    // Send AJAX request to PHP
    let formData = new FormData();
    formData.append("email", email);
    formData.append("password", password);
    formData.append("role", role);

    try {
        let response = await fetch("role-login.php", {
            method: "POST",
            body: formData
        });

        let result = await response.json();

        if (result.success) {
            switch (role.toLowerCase()) {
                case "ads-manager":
                    window.location.href = "ads-manager-dashboard.html";
                    break;
                case "editor":
                    window.location.href = "editor-dashboard.html";
                    break;
                case "writer":
                    window.location.href = "writer-dashboard.html";
                    break;
                default:
                    alert("Invalid role.");
            }
        } else {
            alert(result.message);
        }
    } catch (error) {
        console.error("Error:", error);
        alert("Something went wrong. Please try again.");
    }
});
