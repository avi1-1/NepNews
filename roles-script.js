document.getElementById("roles-login-form").addEventListener("submit", function(event) {
    event.preventDefault();
    
    const email = document.getElementById("login-email").value;
    const password = document.getElementById("login-password").value;
    const role = document.getElementById("role-selection").value;

    if (!role) {
        alert("Please select a role before signing in.");
        return;
    }

    // Validate user credentials based on role (for this example, we're just checking hardcoded values)
    let userCredentials = {
        "ads-manager": { email: "adsmanager@example.com", password: "ads123" },
        "editor": { email: "editor@example.com", password: "editor123" },
        "writer": { email: "writer@example.com", password: "writer123" }
    };

    if (email === userCredentials[role].email && password === userCredentials[role].password) {
        // Redirect based on role
        switch (role) {
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
        alert("Invalid credentials. Please try again.");
    }
});
