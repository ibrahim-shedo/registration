<?php
session_start();

// Check if user is logged in and is authorized
if (!isset($_SESSION['user_account']) || ($_SESSION['user_account'] !== 'student' && $_SESSION['user_account'] !== 'admin')) {
    header('Location: login.html');
    exit;
}

// Define the upload directory
$uploadDir = 'uploads/';

// Ensure the upload directory exists
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['assignment']) && isset($_POST['course'])) {
    $course = htmlspecialchars($_POST['course']);
    $file = $_FILES['assignment'];

    // Check for upload errors
    if ($file['error'] === UPLOAD_ERR_OK) {
        $fileName = basename($file['name']);
        $filePath = $uploadDir . $fileName;

        // Move the uploaded file to the upload directory
        if (move_uploaded_file($file['tmp_name'], $filePath)) {
            echo "The file has been uploaded successfully.";
        } else {
            echo "An error occurred during file upload.";
        }
    } else {
        echo "Error: " . $file['error'];
    }
} else {
    echo "Invalid request.";
}
?>
