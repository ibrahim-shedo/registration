markdown
Copy code
# User Registration and Login System

This project is a simple user registration and login system using HTML, CSS, JavaScript, PHP, and MySQL. The system allows users to register with their details and then log in to the system. Upon successful login, users are welcomed, and if login fails, an alert is shown.

## Prerequisites

- A web server with PHP support (e.g., Apache)
- MySQL database server
- Basic knowledge of HTML, CSS, JavaScript, PHP, and SQL

## Setup Instructions

### 1. Database Setup

1. Open your MySQL command line or a database management tool like phpMyAdmin.
2. Create a new database named `user_registration`:
   ```sql
   CREATE DATABASE user_registration;
Use the newly created database:
sql
Copy code
USE user_registration;
Create a users table:
sql
Copy code
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    user_account VARCHAR(100) NOT NULL,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL
);
2. Project Files
Place the following files in your web server's root directory (e.g., htdocs for XAMPP, www for WAMP, etc.):

register.html
html
Copy code
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <form action="register.php" method="post">
            <h2>Register</h2>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
            <label for="user_account">User Account:</label>
            <input type="text" id="user_account" name="user_account" required>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <div class="buttons">
                <button type="submit">Submit</button>
                <button type="reset">Clear</button>
            </div>
        </form>
    </div>
</body>
</html>
style.css
css
Copy code
body {
    font-family: Arial, sans-serif;
    background-color: #f2f2f2;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}
.container {
    background-color: #fff;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    width: 300px;
}
h2 {
    margin-bottom: 20px;
}
label {
    display: block;
    margin-bottom: 5px;
}
input[type="text"], input[type="password"] {
    width: 100%;
    padding: 8px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 3px;
}
.buttons {
    display: flex;
    justify-content: space-between;
}
button {
    padding: 10px 15px;
    border: none;
    background-color: #5cb85c;
    color: #fff;
    border-radius: 3px;
    cursor: pointer;
}
button[type="reset"] {
    background-color: #d9534f;
}
register.php
php
Copy code
<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_registration";

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
        echo "Registration successful!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
login.html
html
Copy code
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <form action="login.php" method="post">
            <h2>Login</h2>
            <label for="user_account">User Account:</label>
            <input type="text" id="user_account" name="user_account" required>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
login.php
php
Copy code
<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_registration";

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
welcome.php
php
Copy code
<?php
echo "You are welcome!";
?>
Usage
Open your web browser and navigate to http://localhost/register.html.
Fill out the registration form and submit it.
After successful registration, navigate to http://localhost/login.html.
Enter your credentials to log in.
If the login is successful, you will be redirected to a welcome page. If not, an alert will be shown.
Troubleshooting
Not Found Error: Ensure all files are placed correctly in the web server's root directory and the form actions point to the correct URLs.
Database Connection Error: Ensure your MySQL server is running, and the database credentials in the PHP files are correct.
Permissions Error: Ensure the web server has the necessary permissions to read and execute the files.
License
This project is open-source and available under the MIT License.

css
Copy code

Save this content in a file named `README.md` in the root directory of your project. This wi
