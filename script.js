document.getElementById("create-user-form").addEventListener("submit", function (event) {
    event.preventDefault();

    const formData = new FormData(this);

    fetch("save_user.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        const messageDiv = document.getElementById("message");
        messageDiv.textContent = data.message;
        messageDiv.style.color = data.status === "success" ? "green" : "red";
    })
    .catch(error => {
        console.error("Error:", error);
        const messageDiv = document.getElementById("message");
        messageDiv.textContent = "An error occurred.";
        messageDiv.style.color = "red";
    });
});
