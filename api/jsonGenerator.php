<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {

     // Get slug safely
     
    $slug = $_POST["slug"] ?? "";

    // sanitize slug
    $slug = strtolower($slug);
    $slug = preg_replace('/[^a-z0-9-]/', '', $slug);
    $slug = preg_replace('/-+/', '-', $slug);
    $slug = trim($slug, '-');

    if (!$slug) {
        $slug = "post-" . time();
        error_log("Warning: slug missing, fallback used: $slug");
    }

    $uploadDir = __DIR__ . "/uploads/posts/";

    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    //Prevent duplicate slug
    $baseSlug = $slug;
    $counter = 1;

    while (file_exists($uploadDir . $slug . ".json")) {
        $slug = $baseSlug . "-" . $counter;
        $counter++;
    }

    $imagePath = "";

    $errors = [];
    $success = [];

    if (!empty($_FILES["featuredImage"]["name"])) {

        $file = $_FILES["featuredImage"];

        //Check file type
        $allowedExt = ['jpg', 'jpeg', 'png'];
        $ext = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));
        if (!in_array($ext, $allowedExt)) {
            $errors[] = "Invalid file extension.";
        }

        $allowed = ["image/jpeg","image/png"];
        $maxSize = 2 * 1024 * 1024;

        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo,$file["tmp_name"]);
        finfo_close($finfo);

        if (!in_array($mime,$allowed)) {
            $errors[] = "Invalid image type.";
        }

        if ($file["size"] > $maxSize) {
            $errors[] = "Image too large (max 2MB).";
        }

        if (empty($errors) && !empty($_FILES["featuredImage"]["name"])) {

            $ext = pathinfo($file["name"], PATHINFO_EXTENSION);
            $filename = $slug . "." . $ext;
            $destination = $uploadDir . $filename;
            if (move_uploaded_file($file["tmp_name"], $destination)) {
                $imagePath = "/uploads/posts/" . $filename;
                $success[] = [
                    "image" => $filename
                ];
            } else {
                $errors[] = "Failed to upload image.";
            }
        }
    }

        //Check character lengths
    $title = $_POST['title'] ?? '';
    if (strlen($title) > 150) {
        $errors[] = "Title must be 150 characters or less";
    }

    $description = $_POST['description'] ?? '';
    if (strlen($description) > 300) {
        $errors[] = "Description must be 300 characters or less";
    }

    $content = $_POST['content'] ?? '';
    if (strlen($content) > 20000) {
        $errors[] = "Content must be 20000 characters or less";
    }

    $authorName = $_POST['authorName'] ?? '';
    if (strlen($authorName) > 50) {
        $errors[] = "Author's name must be 50 characters or less";
    }

    $authorRole = $_POST['authorRole'] ?? '';
    if (strlen($authorRole) > 50) {
        $errors[] = "Author's role must be 50 characters or less";
    }

    $authorBio = $_POST['authorBio'] ?? '';
    if (strlen($authorBio) > 500) {
        $errors[] = "Author's bio must be 500 characters or less";
    }

    $metaTitle = $_POST['metaTitle'] ?? '';
    if (strlen($metaTitle) > 60) {
        $errors[] = "Meta Title must be 60 characters or less";
    }

    $metaDescription = $_POST['metaDescription'] ?? '';
    if (strlen($metaDescription) > 160) {
        $errors[] = "Meta description title must be 160 characters or less";
    }

    $data = [
        "title" => $_POST["title"] ?? "",
        "slug" => $slug ?? "",
        "description" => $_POST["description"] ?? "",
        "content" => $_POST["content"] ?? "",
        "tags" => explode(",", $_POST["tags"] ?? ""),
        "author" => [
            "name" => $_POST["authorName"] ?? "",
            "role" => $_POST["authorRole"] ?? "",
            "bio" => $_POST["authorBio"] ?? ""
        ],
        "metaTitle" => $_POST["metaTitle"] ?? "",
        "metaDescription" => $_POST["metaDescription"] ?? "",
        "featuredImage" => $imagePath ?? "",
        "publishPreference" => $_POST["publishPreference"] ?? "",
        "specificPublishDate" => $_POST["specificPublishDate"] ?? ""
    ];

    if (!$slug) {
        $errors[] = "Slug missing or invalid.";
    }

    //check storage limit
    if (count(glob($uploadDir . "*.json")) > 100) {
    $errors[] = "Storage limit reached. Please contact administrator";
    }

    //cleanup function for max 20 files in the uploads posts folder
    function cleanupUploads($uploadsDir, $maxFiles = 20) {
    if (!is_dir($uploadsDir)) return; // skip if folder missing

    $files = array_filter(glob($uploadsDir . '/*'), 'is_file'); // only files

    if (count($files) > $maxFiles) {
        // Sort oldest first
        usort($files, function($a, $b) {
            return filemtime($a) - filemtime($b);
        });

        $toDelete = count($files) - $maxFiles;

        for ($i = 0; $i < $toDelete; $i++) {
            if (is_writable($files[$i])) { // avoid fatal error
                @unlink($files[$i]);
            }
        }
    }
    }

    //call cleanup function
    if (empty($errors)) {
        cleanupUploads($uploadDir, 20);
    }

    $response = [
        "success" => $success,
        "errors" => $errors
    ];
    
    $jsonFile = $uploadDir . $slug . ".json";

    if (empty($errors)) {
        // Only create JSON if no errors
        $jsonFile = $uploadDir . $slug . ".json";

        if (file_put_contents($jsonFile, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES))) {
            $response["success"][] = [
                "slug" => $slug,
                "json" => $slug . ".json",
                "filename" => $filename ?? ""
            ];

            $response["generated_json"] = $data;

        } else {
            $response["errors"][] = "Failed to save JSON file.";
        }
    }

    header("Content-Type: application/json");
    echo json_encode($response);
    exit;
}
?>