// Example: Form validation (if needed)
document.querySelector("form").addEventListener("submit", function(e) {
    let title = document.querySelector("input[name='title']").value;
    let content = document.querySelector("textarea[name='content']").value;
    let author = document.querySelector("input[name='author']").value;

    if (!title || !content || !author) {
        e.preventDefault();
        alert("All fields must be filled out.");
    }
});
