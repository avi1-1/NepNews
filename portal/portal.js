// Function to handle redirection based on the role clicked (Admin or Staff)
function redirectToLogin(role) {
    // Log which role the user is trying to log in as (for debugging purposes)
    console.log("Redirecting to: " + role);
    
    // Check if the role is admin
    if (role === 'admin') {
        // Redirect to the admin login page
        console.log("Redirecting to admin login");
        window.location.href = 'admin_login.html'; // Make sure this file exists and matches the name exactly
    } 
    // Check if the role is staff
    else if (role === 'staff') {
        // Redirect to the roles login page
        console.log("Redirecting to roles login");
        window.location.href = 'roles-login.html'; // Make sure this file exists and matches the name exactly
    }
}
