// Example of existing users with their roles (normally these would be fetched from a database)
let users = [
    { name: "John Doe", email: "adsmanager@example.com", role: "Ads Manager" },
    { name: "Jane Smith", email: "editor@example.com", role: "Editor" },
    { name: "Mark Taylor", email: "writer@example.com", role: "Writer" }
];

// Function to display users
function displayUsers() {
    const userList = document.getElementById("user-list");
    userList.innerHTML = ""; // Clear the existing list
    users.forEach(user => {
        const li = document.createElement("li");
        li.textContent = `${user.name} - ${user.email} - Role: ${user.role}`;
        userList.appendChild(li);
    });
}

// Add event listener for creating new user
document.getElementById("create-user-form").addEventListener("submit", function(event) {
    event.preventDefault();

    const name = document.getElementById("user-name").value;
    const email = document.getElementById("user-email").value;
    const password = document.getElementById("user-password").value;
    const role = document.getElementById("role-selection").value;

    if (!role) {
        alert("Please select a role.");
        return;
    }

    // Simulate adding user (in real applications, save to database)
    users.push({ name: name, email: email, role: role });
    alert("User created successfully!");

    // Clear the form
    document.getElementById("user-name").value = "";
    document.getElementById("user-email").value = "";
    document.getElementById("user-password").value = "";
    document.getElementById("role-selection").value = "";

    // Re-display the updated list of users
    displayUsers();
});

// Display existing users on page load
displayUsers();
