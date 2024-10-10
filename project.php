<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

$upload_success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Define the upload directory
    $upload_dir = 'uploads/';
    
    // Sanitize the file name
    $file_name = basename($_FILES['project_image']['name']);
    $uploaded_file = $upload_dir . $file_name;

    // Validate file type (optional, adjust as needed)
    $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
    if (!in_array($_FILES['project_image']['type'], $allowed_types)) {
        $upload_success = "Invalid file type. Only JPG, PNG, and GIF files are allowed.";
    } else {
        // Attempt to move the uploaded file
        if (move_uploaded_file($_FILES['project_image']['tmp_name'], $uploaded_file)) {
            $upload_success = "File uploaded successfully.";
        } else {
            $upload_success = "File upload failed.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projects - Shanmugam Associates</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<!-- Add logout link at the top -->
<div style="text-align: right;">
    <a href="logout.php" style="color: red; font-size: 16px;">Logout</a>
</div>

<h1>Welcome, <?php echo htmlspecialchars($_SESSION['user_id']); ?></h1>

<!-- Existing HTML Content for Project Section -->
<div class="project-section">
    <!-- Your existing project section HTML goes here -->
</div>

<p>Upload your project images here:</p>

<!-- Show upload status -->
<?php if ($upload_success): ?>
    <p style="color: green;"><?php echo htmlspecialchars($upload_success); ?></p>
<?php endif; ?>

<!-- Add the file upload form -->
<form action="projects.php" method="POST" enctype="multipart/form-data">
    <label for="project_image">Choose Image:</label>
    <input type="file" name="project_image" id="project_image" required>
    <button type="submit">Upload Image</button>
</form>

</body>
</html>
