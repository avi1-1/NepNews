// Password Validation Regex: 
// 1 uppercase letter, 1 number, 1 special character, and at least 8 characters long
const passwordRegex = /^(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*(),.?":{}|<>]).{8,}$/;

// Sidebar toggle
const hamburger = document.getElementById("hamburger");
const sidebar = document.getElementById("sidebar");

hamburger.addEventListener("click", function () {
  sidebar.classList.toggle("collapsed");
});
document.addEventListener("DOMContentLoaded", function () {
  const hamburger = document.getElementById("hamburger");

  hamburger.addEventListener("click", function () {
      this.classList.toggle("active"); // Toggle color on click
  });
});

// Menu item navigation
document.getElementById("menu-create").addEventListener("click", function () {
  document.getElementById("section-create").style.display = "block";
  document.getElementById("section-delete").style.display = "none";
});

document.getElementById("menu-delete").addEventListener("click", function () {
  document.getElementById("section-create").style.display = "none";
  document.getElementById("section-delete").style.display = "block"; // Make delete form visible
});

// Toggle password visibility
function togglePassword() {
  const passwordInput = document.getElementById("password");
  const eyeIcon = document.getElementById("eye-icon");
  if (passwordInput.type === "password") {
    passwordInput.type = "text";
    eyeIcon.innerHTML = "&#128064;"; // Eye open icon
  } else {
    passwordInput.type = "password";
    eyeIcon.innerHTML = "&#128065;"; // Eye closed icon
  }
}

// Fetch users and populate the table
window.onload = function() {
  fetch("ad.php", {
    method: "GET",
  })
  .then(response => response.json())
  .then(data => {
    console.log(data);
    const tableBody = document.getElementById("user-list");
    tableBody.innerHTML = ""; // Clear any previous data

    if (data.length > 0) {
        data.forEach(user => {
            const row = document.createElement("tr");
            row.innerHTML = `
              <td>${user.email}</td>
              <td>${user.username}</td>
              <td>${user.role}</td>
            `;
            tableBody.appendChild(row);
        });
    } else {
        const row = document.createElement("tr");
        row.innerHTML = `<td colspan="3">No users found</td>`;
        tableBody.appendChild(row);
    }
  })
  .catch(error => console.log(error));
};

// Handle user creation
document.getElementById("create-user-form").addEventListener("submit", function (e) {
  e.preventDefault(); // Prevent form from submitting if validation fails

  const email = document.getElementById("email").value;
  const username = document.getElementById("username").value;
  const password = document.getElementById("password").value;
  const role = document.getElementById("role").value;

  let valid = true;

  // Clear previous error messages
  document.getElementById("username-error").textContent = "";
  document.getElementById("password-error").textContent = "";

  // Validate username length (at least 3 characters)
  if (username.length < 3) {
    document.getElementById("username-error").textContent = "Username must be at least 3 characters long.";
    valid = false;
  }

  // Validate password (at least 1 uppercase letter, 1 number, 1 special character, and 8 characters long)
  if (!passwordRegex.test(password)) {
    document.getElementById("password-error").textContent = "Password must contain at least 1 uppercase letter, 1 special character, 1 number, and be at least 8 characters long.";
    valid = false;
  }

  // If validation fails, do not proceed with the form submission
  if (!valid) return;

  const formData = new FormData();
  formData.append("create_user", true);
  formData.append("email", email);
  formData.append("username", username);
  formData.append("password", password);
  formData.append("role", role);

  fetch("ad.php", {
    method: "POST",
    body: formData,
  })
  .then(response => response.text()) // Get the plain text message
  .then(message => {
    // Handle success and failure messages
    if (message.includes('created')) {
      alert(`${role.charAt(0).toUpperCase() + role.slice(1)} ${username} has been created successfully`);
    } else if (message.includes('Email is already used')) {
      alert("Email is already used, please try a different one.");
    } else {
      alert(message); // In case of any error
    }
    window.location.reload(); // Reload to fetch updated list of users
  })
  .catch(error => console.log(error));
});

// Handle user deletion
document.getElementById("delete-user-form").addEventListener("submit", function (e) {
  e.preventDefault();

  const email = document.getElementById("delete-email").value;
  const role = document.getElementById("delete-role").value;

  const formData = new FormData();
  formData.append("delete_user", true);
  formData.append("delete-email", email);
  formData.append("delete-role", role);

  fetch("ad.php", {
    method: "POST",
    body: formData,
  })
  .then(response => response.text()) // Get the plain text message
  .then(message => {
    // Handle success and failure messages
    if (message.includes('deleted')) {
      alert(`${role.charAt(0).toUpperCase() + role.slice(1)} ${email} has been deleted successfully`);
    } else if (message.includes('User with this email does not exist')) {
      alert("User does not exist or invalid email/role.");
    } else {
      alert(message); // In case of any error
    }
    window.location.reload(); // Reload to fetch updated list of users
  })
  .catch(error => console.log(error));
});
