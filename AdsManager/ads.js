document.getElementById("adForm").addEventListener("submit", (e) => {
  e.preventDefault(); // Stop form from reloading the page

  const adImage = document.getElementById("adImage").files[0];
  const start = document.getElementById("startTime").value;
  const end = document.getElementById("endTime").value;
  const link = document.getElementById("redirectLink").value;

  if (!adImage) {
    alert("Please upload an advertisement image.");
    return;
  }

  if (!start || !end) {
    alert("Please set a schedule for the advertisement.");
    return;
  }

  if (!link.startsWith("http")) {
    alert("Please enter a valid redirect URL (include http/https).");
    return;
  }

  const formData = new FormData();
  formData.append("adImage", adImage);
  formData.append("startTime", start);
  formData.append("endTime", end);
  formData.append("redirectLink", link);

  fetch("ads.php", {
    method: "POST",
    body: formData
  })
    .then(response => response.text())
    .then(data => {
      alert(data);
      // Optionally reset form after success
      document.getElementById("adForm").reset();
    })
    .catch(error => {
      console.error("Error:", error);
      alert("Something went wrong while posting the ad.");
    });
});
