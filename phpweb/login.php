<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user-registration";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_account = $_POST['user_account'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE user_account='$user_account' AND username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            header("Location: welcome.php");
            exit();
        } else {
            echo "<script>alert('User does not exist. Check your username and password and your user account');</script>";
        }
    } else {
        echo "<script>alert('User does not exist. Check your username and password and your user account');</script>";
    }
}

$conn->close();
?>