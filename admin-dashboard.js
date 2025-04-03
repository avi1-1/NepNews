document.addEventListener("DOMContentLoaded", () => {
    displayUsers();
});

document.getElementById("create-user-form").addEventListener("submit", async function (event) {
    event.preventDefault();

    const username = document.getElementById("username").value.trim();
    const email = document.getElementById("user-email").value.trim();
    const password = document.getElementById("user-password").value.trim();
    const role = document.getElementById("user-role").value;

    if (!username || !email || !password || !role) {
        showMessage("All fields are required!", "error");
        return;
    }

    try {
        const response = await fetch("server.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ username, email, password, role }),
        });

        const result = await response.json();
        if (result.success) {
            showMessage(result.success, "success");
            document.getElementById("create-user-form").reset();
            displayUsers();
        } else {
            showMessage(result.error, "error");
        }
    } catch (error) {
        showMessage("Failed to connect to server.", "error");
    }
});

// Function to fetch and display users
async function displayUsers() {
    try {
        const response = await fetch("server.php");
        const users = await response.json();

        const userList = document.getElementById("user-list");
        userList.innerHTML = ""; // Clear list

        users.forEach(user => {
            const li = document.createElement("li");
            li.textContent = `${user.username} - ${user.email} - Role: ${user.role}`;
            userList.appendChild(li);
        });
    } catch (error) {
        console.error("Error fetching users:", error);
    }
}

// Function to display messages
function showMessage(message, type) {
    const messageDiv = document.getElementById("message");
    messageDiv.textContent = message;
    messageDiv.className = type;
    setTimeout(() => (messageDiv.textContent = ""), 3000);
}
