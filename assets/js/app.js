//SIDEBAR TOGGLE BETWEEN SECTIONS
// Select all sidebar items and all form sections
const sidebarItems = document.querySelectorAll('.sidebar-item');
const formSections = document.querySelectorAll('.form-section');

// Function to hide all sections and remove active classes
function hideAllSections() {
  formSections.forEach(section => section.classList.remove('active'));
  sidebarItems.forEach(item => item.classList.remove('active'));
}

// Add click listeners to each sidebar item
sidebarItems.forEach((item, index) => {
  item.addEventListener('click', () => {
    // Hide all sections and deactivate all sidebar items
    hideAllSections();

    // Activate clicked sidebar item
    item.classList.add('active');

    // Show the corresponding form section
    formSections[index].classList.add('active');
  });
});

//SHOW DATE SELECTOR IF OPTIONG FOR SPECIFIC PUBLISH DATE SELECTED
const publishPreference = document.getElementById('publishPreference');
const specificDateContainer = document.getElementById('specificDateContainer');

publishPreference.addEventListener('change', () => {
  if (publishPreference.value === 'specific') {
    specificDateContainer.style.display = 'block';
  } else {
    specificDateContainer.style.display = 'none';
    document.getElementById('specificPublishDate').value = '';
  }
});

//MEDIA PREVIEW
const featuredImageInput = document.getElementById('featuredImage');
const featuredImagePreview = document.getElementById('featuredImagePreview');
const featuredImagePreviewContainer = document.getElementById('featuredImagePreviewContainer');
const previewImage = document.getElementById('preview-image');
const previewImageContainer = document.getElementById('previewImageContainer');

// warning element
let imageWarning = document.getElementById('featuredImageWarning');
if (!imageWarning) {
    imageWarning = document.createElement('small');
    imageWarning.id = 'featuredImageWarning';
    imageWarning.style.color = 'red';
    imageWarning.style.display = 'none';
    featuredImageInput.parentNode.appendChild(imageWarning);
}

featuredImageInput.addEventListener('change', () => {
    const file = featuredImageInput.files[0];
    const maxSize = 2 * 1024 * 1024; // 1.5MB
    const allowedTypes = ['image/jpeg', 'image/png'];

    if (!file) {
        // No file selected
        featuredImagePreview.src = '';
        featuredImagePreviewContainer.style.display = 'none';
        previewImage.src = '';
        previewImageContainer.style.display = 'none';
        imageWarning.style.display = 'none';
        return;
    }

    // Check file type
    if (!allowedTypes.includes(file.type)) {
        imageWarning.textContent = `Invalid file type. Only JPEG and PNG are allowed.`;
        imageWarning.style.display = 'block';
        featuredImagePreview.src = '';
        featuredImagePreviewContainer.style.display = 'none';
        previewImage.src = '';
        previewImageContainer.style.display = 'none';
        return;
    }

    // Check file size
    if (file.size > maxSize) {
        imageWarning.textContent = `File is too large. Maximum size is 1.5MB.`;
        imageWarning.style.display = 'block';
        featuredImagePreview.src = '';
        featuredImagePreviewContainer.style.display = 'none';
        previewImage.src = '';
        previewImageContainer.style.display = 'none';
        return;
    }

    // File is valid
    imageWarning.style.display = 'none';
    const reader = new FileReader();
    reader.onload = function(e) {
        featuredImagePreview.src = e.target.result;
        featuredImagePreviewContainer.style.display = 'block';
        previewImage.src = e.target.result;
        previewImageContainer.style.display = 'block';
    };
    reader.readAsDataURL(file);
});

// LIVE POST PREVIEW
const form = document.getElementById('postForm');

// Preview elements
const previewTitle = document.getElementById('preview-title');
const previewDescription = document.getElementById('preview-description');
const previewContent = document.getElementById('preview-content');
const previewAuthor = document.getElementById('preview-author');
const previewAuthorBioName = document.getElementById('preview-authorBioName');
const previewAuthorRole = document.getElementById('preview-authorRole');
const previewAuthorBio = document.getElementById('preview-authorBio');
const previewDate = document.getElementById('preview-date');
const previewTags = document.getElementById('preview-tags');

// Helper to format publish date nicely
function formatDate(dateStr) {
    if (!dateStr) return 'Publish date';
    const date = new Date(dateStr);
    return date.toLocaleDateString(undefined, { year: 'numeric', month: 'short', day: 'numeric' });
}

//Tag Inputs
const tagInput = document.getElementById("tagInput");
const tagList = document.getElementById("tag-list");

let tags = [];
const MAX_TAGS = 5;

tagInput.addEventListener("keydown", function(e){
  if(e.key === "Enter"){
    e.preventDefault();

    const tag = tagInput.value.trim().toLowerCase();
    if(tag && !tags.includes(tag) && tags.length < MAX_TAGS){
        tags.push(tag);
        renderTags();
        updatePreview();
        document.getElementById("tagsField").value = tags.join(",");
        tagInput.value = "";
    }
  }
});

postForm.addEventListener("submit", () => {
  document.getElementById("tagsField").value = tags.join(",");
});


function renderTags(){
  tagList.innerHTML = "";
  
  tags.forEach((tag, index) => {
    const chip = document.createElement("span");
    chip.className = "tag-chip";

    const text = document.createTextNode(tag);
    chip.appendChild(text);

    // Remove button
    const remove = document.createElement("span");
    remove.className = "tag-remove";
    remove.dataset.index = index;
    remove.textContent = "×";

    chip.appendChild(remove);

    tagList.appendChild(chip);
  });
}


//ability to remove tags
tagList.addEventListener("click", function(e){
  if(e.target.classList.contains("tag-remove")){
    const index = e.target.dataset.index;
    tags.splice(index,1);
    renderTags();
    updatePreview();
    document.getElementById("tagsField").value = tags.join(",");
  }
});

// preview function
function updatePreview() {
    // Title
    previewTitle.textContent = form.title.value || 'Post Title';

    // Description
    previewDescription.textContent = form.description.value || 'Post description preview will appear here...';

    // Content
    previewContent.textContent = form.content.value || 'Post content preview will appear here...';

    // Author
    const authorName = form.authorName.value;
    previewAuthor.textContent = authorName ? `by ${authorName}` : 'by Author';
    previewAuthorBioName.textContent = authorName ? `${authorName} ` : "Author's Name ";

    // About Author (Bio)
    const authorBio = form.authorBio.value;
    previewAuthorBio.textContent = authorBio ? `${authorBio}` : "Author's Bio";

    // Author Role
    const authorRole = form.authorRole.value;
    previewAuthorRole.textContent = authorRole ? `${authorRole}` : '';

    // Publish Date
    const publishDate = form.specificPublishDate.value;
    const publishPreference = form.publishPreference.value;
    
    if (publishPreference=='anytime') {
        previewDate.textContent = `Published Date: ${publishPreference[0].toUpperCase()}${publishPreference.slice(1)}`;
    } else if (publishPreference=='asap') {
        previewDate.textContent = `Published Date: ${publishPreference.toUpperCase()}`;
    }else if (publishPreference=='specific') {
        previewDate.textContent = formatDate(publishDate);
    } else {
    previewDate.textContent = 'Publish Date';
    }

    // Tags
    previewTags.innerHTML = tags
    .map(tag => `<span class="preview-tag">${tag}</span>`)
    .join("");
}

// Listen to input events
form.addEventListener('input', updatePreview);

// Initial preview
updatePreview();

//SLUG GENERATOR
let titleInput = document.getElementById('title');
let slugInput = document.getElementById('slug');

titleInput.addEventListener('input', () => {
  let slug = titleInput.value
    .toLowerCase()
    .trim()
    .replace(/[^a-z0-9\s-]/g, "")
    .replace(/\s+/g, "-")
    .replace(/-+/g, "-");

        const MAX_LENGTH = 60; // or whatever you prefer
    if (slug.length > MAX_LENGTH) {
        slug = slug.substring(0, MAX_LENGTH);
        // Optionally remove trailing dash
        slug = slug.replace(/-$/,'');
    }
    
  slugInput.value = slug;
});


//CHARACTER COUNT
const descriptionInput = document.getElementById('description');
const contentInput = document.getElementById('content');
const authorNameInput = document.getElementById('authorName');
const authorRoleInput = document.getElementById('authorRole');
const authorBioInput = document.getElementById('authorBio');
const metaTitleInput = document.getElementById('metaTitle');
const metaDescriptionInput = document.getElementById('metaDescription');


const descriptionCount = document.getElementById('descriptionCount');
const contentCount = document.getElementById('contentCount');
const authorNameCount = document.getElementById('authorNameCount');
const authorRoleCount = document.getElementById('authorRoleCount');
const metaTitleCount = document.getElementById('metaTitleCount');
const metaDescriptionCount = document.getElementById('metaDescriptionCount');
const authorBioCount = document.getElementById('authorBioCount');
const titleCount = document.getElementById('titleCount');
const tagCount = document.getElementById('tagCount');


titleInput.addEventListener('input', () => {
  titleCount.textContent = titleInput.value.length;
});

descriptionInput.addEventListener('input', () => {
  descriptionCount.textContent = descriptionInput.value.length;
});

contentInput.addEventListener('input', () => {
  contentCount.textContent = contentInput.value.length;
});

authorNameInput.addEventListener('input', () => {
  authorNameCount.textContent = authorNameInput.value.length;
});

authorRoleInput.addEventListener('input', () => {
  authorRoleCount.textContent = authorRoleInput.value.length;
});

authorBioInput.addEventListener('input', () => {
  authorBioCount.textContent = authorBioInput.value.length;
});

metaTitleInput.addEventListener('input', () => {
  metaTitleCount.textContent = metaTitleInput.value.length;
});

metaDescriptionInput.addEventListener('input', () => {
  metaDescriptionCount.textContent = metaDescriptionInput.value.length;
});

tagInput.addEventListener('input', () => {
  tagCount.textContent = tagInput.value.length;
});


//WELCOME MODAL
document.addEventListener("DOMContentLoaded", () => {

    const introModal = document.getElementById("introModal");
    const closeBtn = document.getElementById("closeIntroBtn");

    // Show only if not seen before
    if (!localStorage.getItem("introSeen")) {
        introModal.style.display = "flex";
    }

    closeBtn.addEventListener("click", () => {
        introModal.style.display = "none";
        localStorage.setItem("introSeen", "true");
    });
});


// HELP ITEM - INSTRUCTIONS
document.getElementById("openIntroBtn").addEventListener("click", () => {
    document.getElementById("introModal").style.display = "flex";
});
