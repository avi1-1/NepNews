
const hamburger = document.getElementById('hamburger');
const sidebar = document.getElementById('sidebar');
const postAdBtn = document.getElementById('postAdBtn');

hamburger.addEventListener('click', () => {
  sidebar.classList.toggle('open');
});

postAdBtn.addEventListener('click', () => {
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

  alert("Ad successfully posted to NepNews Front Page 🚀");
});