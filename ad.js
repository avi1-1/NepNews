// Sidebar toggle
const hamburger = document.getElementById("hamburger");
const sidebar = document.getElementById("sidebar");

hamburger.addEventListener("click", function () {
  sidebar.classList.toggle("collapsed");
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
    eyeIcon.innerHTML = '&#128064;'; // Open eye icon
  } else {
    passwordInput.type = "password";
    eyeIcon.innerHTML = '&#128065;'; // Closed eye icon
  }
}

// Username and password validation
function validateForm() {
  const username = document.getElementById("username").value;
  const password = document.getElementById("password").value;
  const email = document.getElementById("email").value;
  const role = document.getElementById("role").value;

  let valid = true;

  // Username validation
  if (username.length < 3) {
    document.getElementById("username-error").textContent = "Username must be at least 3 characters.";
    valid = false;
  } else {
    document.getElementById("username-error").textContent = "";
  }

  // Password validation
  const passwordRegex = /^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
  if (!password.match(passwordRegex)) {
    document.getElementById("password-error").textContent = "Password must be at least 8 characters, with 1 uppercase letter, 1 number, and 1 special character.";
    valid = false;
  } else {
    document.getElementById("password-error").textContent = "";
  }

  // Check if all fields are filled
  if (!email || !username || !password || !role) {
    alert("Please fill in all fields.");
    valid = false;
  }

  return valid;
}

// Form submission for creating a new user
document.getElementById("create-user-form").addEventListener("submit", function (e) {
  e.preventDefault();

  if (!validateForm()) return;

  const email = document.getElementById("email").value;
  const username = document.getElementById("username").value;
  const password = document.getElementById("password").value;
  const role = document.getElementById("role").value;

  // Create new user object
  const newUser = {
    email,
    username,
    password,
    role
  };

  // Add user to the table
  const tbody = document.getElementById("user-table").getElementsByTagName("tbody")[0];
  const row = tbody.insertRow();
  row.innerHTML = `<td>${newUser.email}</td><td>${newUser.username}</td><td>${newUser.role}</td>`;

  // Store the new user in localStorage (or handle persistent storage)
  let users = JSON.parse(localStorage.getItem("users")) || [];
  users.push(newUser);
  localStorage.setItem("users", JSON.stringify(users));

  // Clear form fields
  document.getElementById("create-user-form").reset();

  // Show success message with username and role
  alert(`User Created Successfully!  ${username} is now a ${role} of our NepNews.`);
});

// Delete user form submission
document.getElementById("delete-user-form").addEventListener("submit", function (e) {
  e.preventDefault();

  const deleteEmail = document.getElementById("delete-email").value;
  const deleteRole = document.getElementById("delete-role").value;

  // Check if the user exists in the table
  const rows = document.getElementById("user-table").getElementsByTagName("tbody")[0].rows;
  let userDeleted = false;

  for (let i = 0; i < rows.length; i++) {
    const row = rows[i];
    const email = row.cells[0].textContent;
    const role = row.cells[2].textContent;

    if (email === deleteEmail && role === deleteRole) {
      // Remove the row from the table
      row.remove();
      userDeleted = true;
      break;
    }
  }

  // If a user is deleted, remove it from localStorage as well
  if (userDeleted) {
    let users = JSON.parse(localStorage.getItem("users")) || [];
    users = users.filter(user => user.email !== deleteEmail || user.role !== deleteRole);
    localStorage.setItem("users", JSON.stringify(users));
    alert("User deleted successfully.");
  } else {
    alert("User not found.");
  }

  // Clear the delete form
  document.getElementById("delete-user-form").reset();
});

// Load users from localStorage when the page loads
window.onload = function () {
  const users = JSON.parse(localStorage.getItem("users")) || [];
  const tbody = document.getElementById("user-table").getElementsByTagName("tbody")[0];

  users.forEach(user => {
    const row = tbody.insertRow();
    row.innerHTML = `<td>${user.email}</td><td>${user.username}</td><td>${user.role}</td>`;
  });
};
