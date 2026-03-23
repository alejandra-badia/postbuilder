// Autosave every 5s
setInterval(() => {
  const data = {
    title: postForm.title.value,
    description: postForm.description.value,
    content: postForm.content.value,
    authorName: postForm.authorName.value,
    authorRole: postForm.authorRole.value,
    authorBio: postForm.authorBio.value,
    metaTitle: postForm.metaTitle.value,
    metaDescription: postForm.metaDescription.value,
    tags: tags
  };

  localStorage.setItem('postDraft', JSON.stringify(data));
}, 5000);

// Restore on page load
window.addEventListener('load', () => {
  const draft = localStorage.getItem('postDraft');
  if (draft) {
    const data = JSON.parse(draft);

    // Restore title first
    postForm.title.value = data.title || "";

    // Regenerate slug after restoring title
    const slug = postForm.title.value
      .toLowerCase()
      .trim()
      .replace(/[^a-z0-9\s-]/g, "")
      .replace(/\s+/g, "-")
      .replace(/-+/g, "-");
    slugInput.value = slug;

    // Restore other fields
    postForm.description.value = data.description || "";
    postForm.content.value = data.content || "";
    postForm.authorName.value = data.authorName || "";
    postForm.authorRole.value = data.authorRole || "";
    postForm.authorBio.value = data.authorBio || "";
    postForm.metaTitle.value = data.metaTitle || "";
    postForm.metaDescription.value = data.metaDescription || "";

    // Restore tags
    if (data.tags) {
      tags = data.tags;
      renderTags();
      document.getElementById("tagsField").value = tags.join(",");
    }

    // Update live preview
    updatePreview();

    // Restore character counts
    updateCharacterCounts();
  }
});


// Clear Autosave
clearFormBtn.addEventListener("click", () => {
    if (!confirm("Clear all form data?")) return;

    const form = document.getElementById("postForm");

    form.reset();

    // Clear tags
    tags = [];
    tagList.innerHTML = "";
    document.getElementById("tagsField").value = "";
    document.getElementById("preview-tags").textContent = "";

    // Reset post preview text
    document.getElementById("preview-title").textContent = "Post Title";
    document.getElementById("preview-description").textContent = "Post description preview will appear here...";
    document.getElementById("preview-author").textContent = "by Author";
    document.getElementById("preview-content").textContent = "Post content preview will appear here...";
    document.getElementById("preview-authorBio").textContent = "About the author section will appear here...";
    document.getElementById("preview-authorBioName").textContent = "Author Name ";
    document.getElementById("preview-authorRole").textContent = "";

    // Reset JSON preview
    const jsonSection = document.getElementById("jsonSection");
    document.getElementById("json-output").textContent = "{}";
    jsonSection.classList.add("hidden-json");

    // Reset Featured Image
    featuredImageInput.value = ""; // Clear the file input
    featuredImagePreview.src = "";
    featuredImagePreviewContainer.style.display = "none";
    previewImage.src = "";
    previewImageContainer.style.display = "none";
    if (imageWarning) imageWarning.style.display = "none";
});

//update character counts
function updateCharacterCounts() {
  titleCount.textContent = titleInput.value.length;
  descriptionCount.textContent = descriptionInput.value.length;
  contentCount.textContent = contentInput.value.length;
  authorNameCount.textContent = authorNameInput.value.length;
  authorRoleCount.textContent = authorRoleInput.value.length;
  authorBioCount.textContent = authorBioInput.value.length;
  metaTitleCount.textContent = metaTitleInput.value.length;
  metaDescriptionCount.textContent = metaDescriptionInput.value.length;
  tagCount.textContent = tagInput.value.length;
}

