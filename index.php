<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>PostBuilder</title>
  <link rel="stylesheet" href="assets/css/base.css">
  <link rel="stylesheet" href="assets/css/layout.css">
  <link rel="stylesheet" href="assets/css/app.css">
  <link rel="stylesheet" href="assets/css/responsive.css">
</head>
<body>
  <div class="app-layout">
    <!-- Sidebar -->
    <aside class="sidebar">
        <nav class="sidebar-nav">
            <ul>
                <li class="sidebar-item active" data-section="details">
                    <svg class="sidebar-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960">
                        <path d="M80-160v-160h160v160H80Zm240 0v-160h560v160H320ZM80-400v-160h160v160H80Zm240 0v-160h560v160H320ZM80-640v-160h160v160H80Zm240 0v-160h560v160H320Z"/>
                    </svg>
                    <span><span class="hidden">Post </span>Details</span>
                </li>
                <li class="sidebar-item" data-section="author">
                  <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3"><path d="M200-200v-560 179-19 400Zm80-240h221q2-22 10-42t20-38H280v80Zm0 160h157q17-20 39-32.5t46-20.5q-4-6-7-13t-5-14H280v80Zm0-320h400v-80H280v80Zm-80 480q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h560q33 0 56.5 23.5T840-760v258q-14-26-34-46t-46-33v-179H200v560h202q-1 6-1.5 12t-.5 12v56H200Zm409-229q-29-29-29-71t29-71q29-29 71-29t71 29q29 29 29 71t-29 71q-29 29-71 29t-71-29ZM480-120v-56q0-24 12.5-44.5T528-250q36-15 74.5-22.5T680-280q39 0 77.5 7.5T832-250q23 9 35.5 29.5T880-176v56H480Z"/></svg>
                  <span>Author</span>
                </li>
                <li class="sidebar-item" data-section="seo">
                  <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3"><path d="m105-399-65-47 200-320 120 140 160-260 120 180 135-214 65 47-198 314-119-179-152 247-121-141-145 233Zm475 159q42 0 71-29t29-71q0-42-29-71t-71-29q-42 0-71 29t-29 71q0 42 29 71t71 29ZM784-80 676-188q-21 14-45.5 21t-50.5 7q-75 0-127.5-52.5T400-340q0-75 52.5-127.5T580-520q75 0 127.5 52.5T760-340q0 26-7 50.5T732-244l108 108-56 56Z"/></svg>
                  <span>SEO</span>
                </li>
                <li class="sidebar-item" data-section="tags">
                  <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3"><path d="m159-168-34-14q-31-13-41.5-45t3.5-63l72-156v278Zm160 88q-33 0-56.5-23.5T239-160v-240l106 294q3 7 6 13.5t8 12.5h-40Zm206-4q-32 12-62-3t-42-47L243-622q-12-32 2-62.5t46-41.5l302-110q32-12 62 3t42 47l178 488q12 32-2 62.5T827-194L525-84Zm-57.5-487.5Q479-583 479-600t-11.5-28.5Q456-640 439-640t-28.5 11.5Q399-617 399-600t11.5 28.5Q422-560 439-560t28.5-11.5ZM497-160l302-110-178-490-302 110 178 490ZM319-650l302-110-302 110Z"/></svg>                    
                  <span>Tags</span>
                </li>
                <li class="sidebar-item" data-section="media">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3"><path d="M720-330q0 104-73 177T470-80q-104 0-177-73t-73-177v-370q0-75 52.5-127.5T400-880q75 0 127.5 52.5T580-700v350q0 46-32 78t-78 32q-46 0-78-32t-32-78v-370h80v370q0 13 8.5 21.5T470-320q13 0 21.5-8.5T500-350v-350q-1-42-29.5-71T400-800q-42 0-71 29t-29 71v370q-1 71 49 120.5T470-160q70 0 119-49.5T640-330v-390h80v390Z"/></svg>
                    <span>Media</span>
                </li>
                <li class="sidebar-item" data-section="settings">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3"><path d="m370-80-16-128q-13-5-24.5-12T307-235l-119 50L78-375l103-78q-1-7-1-13.5v-27q0-6.5 1-13.5L78-585l110-190 119 50q11-8 23-15t24-12l16-128h220l16 128q13 5 24.5 12t22.5 15l119-50 110 190-103 78q1 7 1 13.5v27q0 6.5-2 13.5l103 78-110 190-118-50q-11 8-23 15t-24 12L590-80H370Zm70-80h79l14-106q31-8 57.5-23.5T639-327l99 41 39-68-86-65q5-14 7-29.5t2-31.5q0-16-2-31.5t-7-29.5l86-65-39-68-99 42q-22-23-48.5-38.5T533-694l-13-106h-79l-14 106q-31 8-57.5 23.5T321-633l-99-41-39 68 86 64q-5 15-7 30t-2 32q0 16 2 31t7 30l-86 65 39 68 99-42q22 23 48.5 38.5T427-266l13 106Zm42-180q58 0 99-41t41-99q0-58-41-99t-99-41q-59 0-99.5 41T342-480q0 58 40.5 99t99.5 41Zm-2-140Z"/></svg>
                    <span><span class="hidden">Publish </span> Settings</span>
                </li>
            </ul>
            <!-- Submt Button -->
            <div>
              <button type="submit" form="postForm" id="btnPublish">Publish Post</button>
            </div>
        </nav>
    </aside>
    <!-- Main App Area -->
    <div class="app-main">
      <!-- Header -->
      <header class="app-header">
        <?php include 'layouts/header.php'?>
      </header>
      <main class="main-layout">
        <div class="clearForm"><a id="clearFormBtn">Clear Form</a></div>
        <!-- Workspace -->
        <div class="workspace">
          <!-- Editor -->
          <section class="editor">
            <!-- FORM -->
            <form id="postForm" action="api/jsonGenerator.php" method="POST" enctype="multipart/form-data">
              <div id="formError" class="hidden-error"></div>
              <!-- Post Details -->
              <section class="form-section active" id="section-details">
                <div class="form-component">
                  <label for="title">Post Title <span class="required">*</span></label>
                  <input 
                    type="text" 
                    id="title" 
                    name="title" 
                    placeholder="Enter post title" 
                    maxlength="150" 
                    required>
                  <small>Characters <span id="titleCount">0</span> / 150 characters</small>
                </div>
                <div class="form-component">
                  <label for="slug">Slug</label>
                  <input 
                    type="text" 
                    id="slug" 
                    name="slug" 
                    placeholder="Auto-generated from title" 
                    pattern="^[a-z0-9]+(?:-[a-z0-9]+)*$" 
                    title="Lowercase letters, numbers, hyphens only"
                    readonly>
                  <small>Will be auto-generated from the title</small>
                </div>
                <div class="form-component">
                  <label for="description">Short Description <span class="required">*</span></label>
                  <textarea 
                    id="description" 
                    name="description" 
                    rows="4" 
                    maxlength="300" 
                    placeholder="Enter a brief description of the post" 
                    required></textarea>
                  <small>Characters <span id="descriptionCount">0</span> / 300 characters</small>
                </div>
                <div class="form-component">
                  <label for="content">Post Content <span class="required">*</span></label>
                  <textarea 
                    id="content" 
                    name="content" 
                    rows="12" 
                    placeholder="Write your post content here..."
                    maxlength="20000" 
                    required></textarea>
                  <small>Characters <span id="contentCount">0</span> / 20000 characters</small>
                </div>
              </section>
              <!-- Author -->
              <section class="form-section" id="section-author">
                <div class="form-component">
                  <label for="authorName">Author Name <span class="required">*</span></label>
                  <input 
                    type="text" 
                    id="authorName" 
                    name="authorName" 
                    maxlength="50" 
                    placeholder="Enter author name" 
                    required>
                  <small>Characters <span id="authorNameCount">0</span> / 50 characters</small>
                </div>
                <div class="form-component">
                  <label for="authorRole">Author Role</label>
                  <input 
                    type="text" 
                    id="authorRole" 
                    name="authorRole" 
                    maxlength="50" 
                    placeholder="Optional role/title of the author">
                  <small>Characters <span id="authorRoleCount">0</span> / 50 characters</small>
                </div>
                <div class="form-component">
                  <label for="authorBio">Author Bio<span class="required">*</span></label>
                  <textarea id="authorBio" name="authorBio" rows="4" maxlength="500" required></textarea>
                  <small>Characters <span id="authorBioCount">0</span> / 500 characters</small>
                </div>
              </section>
              <!-- SEO Settings -->
              <section class="form-section" id="section-seo">
                <div class="form-component">
                  <label for="metaTitle">Meta Title</label>
                  <input 
                    type="text" 
                    id="metaTitle" 
                    name="metaTitle" 
                    maxlength="60" 
                    placeholder="SEO meta title">
                  <small>Characters <span id="metaTitleCount">0</span> / 60 characters</small>
                </div>
                <div class="form-component">
                  <label for="metaDescription">Meta Description</label>
                  <textarea 
                    id="metaDescription" 
                    name="metaDescription" 
                    rows="3" 
                    maxlength="160" 
                    placeholder="SEO meta description"></textarea>
                  <small>Characters <span id="metaDescriptionCount">0</span> / 160 characters</small>
                </div>
              </section>
              <!-- Tags -->
              <section class="form-section" id="section-tags">
                <div class="form-component">
                  <label for="tagInput">Tags</label>
                  <div id="tag-selector">
                    <div id="tag-list"></div>
                    <input
                      type="text"
                      id="tagInput"
                      maxlength="50" 
                      placeholder="Type a tag and press Enter">
                    <div class="smallTag">
                      <small>Characters <span id="tagCount">0</span> / 50 characters</small>
                      <small>Add up to 5 tags</small>
                    </div>
                    <input type="hidden" name="tags" id="tagsField">
                  </div>
                </div>
              </section>
              <!-- Media -->
              <section class="form-section" id="section-media">
                <div class="form-component">
                  <label for="featuredImage">Featured Image</label>
                  <input 
                    type="file" 
                    id="featuredImage" 
                    name="featuredImage" 
                    accept="image/png, image/jpeg">
                  <small>Max size 2MB. JPG or PNG only.</small>
                </div>
                <!-- Image Preview -->
                <div class="form-component" id="featuredImagePreviewContainer">
                  <label>Preview:</label>
                  <img id="featuredImagePreview" src="" alt="Image Preview">
                </div>
              </section>
              <!-- Publish Settings -->
              <section class="form-section" id="section-publish">
                <div class="form-component">
                  <label for="publishPreference">Preferred Publish Timing</label>
                  <select id="publishPreference" name="publishPreference">
                  <option value="anytime">Anytime</option>
                  <option value="asap">As soon as possible</option>
                  <option value="specific">Specific date</option>
                  </select>              
                </div>
                <div class="form-component" id="specificDateContainer" style="display:none;">
                  <label for="specificPublishDate">Select Publish Date</label>
                  <input type="date" id="specificPublishDate" name="specificPublishDate">
                </div>
              </section>
            </form>
          </section>
          <!-- Live Preview -->
          <section class="preview">
            <article class="post-preview">
              <div>
                <h2 id="preview-title">Post Title</h2>
              </div>
              <div>
                  <p id="preview-description" class="text-muted">Post description preview will appear here...</p>
              </div>
              <div>
                <p id="preview-author">
                  by Author
                </p>
              </div>
              <div id="mainContentContainer">
                <div class="form-component" id="previewImageContainer">
                  <img id="preview-image" src="">
                </div>
                <div>
                  <p id="preview-content">
                    Post content preview will appear here...
                  </p>
                </div>
              </div>
              <div><p id="preview-date">Publish date</p></div>
              <div class="tag-layout"><span class="tags">Tags: </span><span id="preview-tags"></span></div>
              <div id="previewAuthorBioContainer">
                <p class="aboutAuthor">About the Author:</p>
                <div>
                  <div class="authorquickInfo">
                    <small id="preview-authorBioName">Author Name</small>
                    <small id="preview-authorRole"></small>
                  </div>
                  <small id="preview-authorBio">About the author section will appear here...</small>
                </div>
              </div>
            </article>
          </section>
        </div>
        <!-- JSON Output -->
      <section class="json-section card hidden-json" id="jsonSection">
        <div class="json-header">
          <h3>JSON Output</h3>
          <div class="json-actions">
            <button type="button" id="copyJsonBtn">Copy</button>
            <button type="button" id="downloadJsonBtn">Download</button>
          </div>
        </div>
        <pre id="json-output">{}</pre>
      </section>
      </main>
      <div id="uploadModal" class="modal">
        <div class="modal-content">
          <span class="close">x</span>
          <div id="uploadStatus">
            <strong id="uploadMessage">En progreso…</strong>
            <div id="uploadProgress">
              <div id="uploadBar"></div>
            </div>
            <div id="uploadPercent">0%</div>
          </div>
          <div id="uploadResults"></div>
        </div>
      </div>
      <div id="introModal" class="modal">
        <div class="modal-content intro-modal">
          <h2>Welcome!</h2>
          <p>
            <b>How it Works:</b><br>Create your blog post step by step using the navigation bar. A live preview updates as you type so you can preview your post in real time.
          </p>
          <p>
            When you're ready, submit the form and the application will generate a JSON output.
          </p>
          <p>
            <b>What it Does:</b><br>This tool simulates a lightweight content management workflow, demonstrating how structured data can be prepared for publishing systems, APIs, or static site generation.
          </p>
          <p>
            <b>Note:</b><br>This is a demo tool. Content and uploads may be stored temporarily and automatically removed. Please avoid entering sensitive or personal information.
          </p>
          <button id="closeIntroBtn">Got it</button>
        </div>
      </div>
      <!-- Footer -->
        <?php include 'layouts/footer.php'?>
    </div>
  </div>
<script src="assets/js/app.js"></script>
<script src="assets/js/form-submit.js"></script>
<script src="assets/js/autosave.js"></script>
</body>
</html>
