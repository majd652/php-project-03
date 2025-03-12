document.getElementById("fileInput").addEventListener("change", function(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById("preview");
            preview.src = e.target.result;
            preview.style.display = "block";
            document.querySelector(".upload-text").style.display = "none"; // إخفاء النص
        };
        reader.readAsDataURL(file);
    }
});


