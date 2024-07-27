<?php
session_start();

// Check if user is logged in and authorized
if (!isset($_SESSION['user_account']) || ($_SESSION['user_account'] !== 'lecturer' && $_SESSION['user_account'] !== 'admin')) {
    header('Location: login.html');
    exit;
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if file is uploaded
    if (isset($_FILES['material']) && $_FILES['material']['error'] == 0) {
        $uploadDir = 'uploads/'; // Directory to save uploaded files
        $allowedTypes = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document']; // Allowed MIME types
        $maxSize = 2 * 1024 * 1024; // Max file size: 2MB

        $fileTmpPath = $_FILES['material']['tmp_name'];
        $fileName = $_FILES['material']['name'];
        $fileSize = $_FILES['material']['size'];
        $fileType = $_FILES['material']['type'];

        // Validate file size
        if ($fileSize > $maxSize) {
            echo "File size exceeds the maximum limit of 2MB.";
            exit;
        }

        // Validate file type
        if (!in_array($fileType, $allowedTypes)) {
            echo "Invalid file type. Only PDF and Word documents are allowed.";
            exit;
        }

        // Create a unique file name to avoid overwriting existing files
        $newFileName = uniqid() . '-' . $fileName;
        $uploadFilePath = $uploadDir . $newFileName;

        // Move the file to the upload directory
        if (move_uploaded_file($fileTmpPath, $uploadFilePath)) {
            echo "File uploaded successfully.";
            // Optionally, save file information to the database here
        } else {
            echo "Error occurred while uploading the file.";
        }
    } else {
        echo "No file uploaded or an error occurred.";
    }
} else {
    echo "Invalid request.";
}
?>
