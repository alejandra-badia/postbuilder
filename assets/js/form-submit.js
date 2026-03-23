document.addEventListener("DOMContentLoaded", () => {
   
    const form = document.getElementById("postForm");

    //CHECK IF ANY EMPTRY REQUIRED FIELDS PRIOR TO PROCEEDING
    // Get all required fields
    const requiredFields = form.querySelectorAll("[required]");

    requiredFields.forEach(field => {
        field.addEventListener("invalid", (e) => {
            e.preventDefault();

            // Show global error
            const errorBox = document.getElementById("formError");
            if (errorBox) {
                errorBox.textContent = "Please fill out all required fields.";
                errorBox.classList.remove("hidden-error");
            }

            // Switch section
            const section = field.closest(".form-section");
            if (section) {
                document.querySelectorAll(".form-section").forEach(s => s.classList.remove("active"));
                section.classList.add("active");
                section.scrollIntoView({ behavior: "smooth", block: "start" });

                // ✅ NEW: update sidebar active state
                const sectionName = section.id.replace("section-", "");

                document.querySelectorAll(".sidebar-item").forEach(item => {
                    item.classList.remove("active");

                    if (item.dataset.section === sectionName) {
                        item.classList.add("active");
                    }
                });
            }

            field.focus();
        });
    });

    //FORM SUBMISSION / PROGRESS BAR
    document.getElementById("postForm").addEventListener("submit", function (e) {
        e.preventDefault();
               
        const form = e.target;
        const formData = new FormData(form);
        const xhr = new XMLHttpRequest();

        // Modal (pop-up)
        const modal = document.getElementById("uploadModal");
        const bar = document.getElementById("uploadBar");
        const percentText = document.getElementById("uploadPercent");
        const message = document.getElementById("uploadMessage");
        const results = document.getElementById("uploadResults");
        const closeBtn = document.querySelector(".close");

        // Open modal
        modal.style.display = "flex";
        modal.classList.remove("fade-out");

        // Progress
        message.textContent = "Uploading…";
        bar.style.width = "0%";
        percentText.textContent = "0%";
        results.innerHTML = "";

        // Close Modal
        closeBtn.onclick = function () {
            modal.style.display = "none";
        };

        // Progress Bar
        xhr.upload.addEventListener("progress", function (event) {
            if (event.lengthComputable) {
                const percent = Math.round((event.loaded / event.total) * 100);
                bar.style.width = percent + "%";
                percentText.textContent = percent + "%";
                message.textContent = "Upload Complete!";
            }
        });

        // Completed state
        xhr.addEventListener("load", function () {
            bar.style.width = "100%";
            percentText.textContent = "100%";

            try {
                const response = JSON.parse(xhr.responseText);
                const hasErrors = response.errors && response.errors.length > 0;
                const hasSuccess = response.success && response.success.length > 0;

                if(response.generated_json){
                    const jsonSection = document.getElementById("jsonSection");
                    const jsonOutput = document.getElementById("json-output");

                    jsonOutput.textContent = JSON.stringify(response.generated_json, null, 2);
                    jsonSection.classList.remove("hidden-json");
                }

                // Uploaded file
                if (hasSuccess) {
                    message.textContent = "Upload Completed!";

                    results.innerHTML += `<p>Uploaded files:</p>` + 
                    response.success.map(f => {
                        // If it's an object
                        if (typeof f === "object") {
                            let parts = [];
                            if (f.json) parts.push(`JSON: ${f.json}`);
                            if (f.image) parts.push(`Image: ${f.image}`);
                            if (!f.json && !f.image && f.slug) parts.push(`Slug: ${f.slug}`);
                            return `${parts.join(' | ')}`;
                        } else {
                        return `${f}`;
                        }
                    }).join('<br>')
                        
                    //hide empty required input error if success (meaning errors cleared)
                    const errorBox = document.getElementById("formError");
                    if (form.checkValidity()) {
                        errorBox.classList.add("hidden-error");
                        errorBox.textContent = "";
                    }
                }

                // Show errors with open modal
                if (hasErrors) {
                results.innerHTML += `<p>Errors:</p>${response.errors.map(e => `${e}`).join(' , ')}`;
                message.textContent = "Error uploading files!";
                }

                // Close modal after 3 seconds there aren't any errors
                if (!hasErrors) {
                    setTimeout(() => {
                        modal.classList.add("fade-out");

                        setTimeout(() => {
                        modal.style.display = "none";

                        const jsonSection = document.getElementById("jsonSection");

                        jsonSection.scrollIntoView({
                        behavior: "smooth",
                        block: "start"
                        });

                        }, 500);
                    }, 3000);
                }

                } catch (err) {
                    message.textContent = "Form submitted; however a problem has occured with processing the response from the server.";
                    results.innerHTML += "<p>Please check if file has uploaded correctly or try again</p>";
                    // modal se mantiene abierto, para cerrar manualmente
                }
        });

     // Send Form Data
        xhr.open("POST", form.action);
        xhr.send(formData);
    });

    
const copyBtn = document.getElementById("copyJsonBtn");

copyBtn.addEventListener("click", () => {
    const jsonText = document.getElementById("json-output").textContent;
    navigator.clipboard.writeText(jsonText);
    copyBtn.textContent = "Copied!";
    setTimeout(() => {
        copyBtn.textContent = "Copy";
    }, 1500);
});


const downloadBtn = document.getElementById("downloadJsonBtn");

downloadBtn.addEventListener("click", () => {
    const jsonText = document.getElementById("json-output").textContent;
    const blob = new Blob([jsonText], { type: "application/json" });
    const url = URL.createObjectURL(blob);
    const a = document.createElement("a");
    a.href = url;
    a.download = "post.json";
    a.click();
    URL.revokeObjectURL(url);
});
});