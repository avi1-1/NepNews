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
