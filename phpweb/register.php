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
    $name = $_POST['name'];
    $user_account = $_POST['user_account'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $sql = "INSERT INTO users (name, user_account, username, password) VALUES ('$name', '$user_account', '$username', '$password')";

    if ($conn->query($sql) === TRUE) {
        header("location: login.html");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>










































































