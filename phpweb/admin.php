<?php
session_start();
if (!isset($_SESSION['user_account']) || $_SESSION['user_account'] !== 'admin') {
    header('Location: login.html');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link rel="stylesheet">
    <style>
    /* Resetting default margin and padding */
    body,
    h1,
    p,
    ul {
        margin: 0;
        padding: 0;
    }

    /* Basic styles */
    body {
        font-family: Arial, sans-serif;
        background-color: #f0f0f0;
        line-height: 1.6;
    }

    .container {
        max-width: 800px;
        margin: 20px auto;
        padding: 20px;
        background-color: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        border-radius: 5px;
    }

    h1 {
        font-size: 2em;
        color: #333;
        margin-bottom: 20px;
        text-align: center;
    }

    p {
        font-size: 1.2em;
        color: #666;
        margin-bottom: 15px;
    }

    ul {
        list-style-type: none;
        margin-top: 20px;
    }

    ul li {
        margin-bottom: 10px;
    }

    ul li a {
        text-decoration: none;
        color: #007bff;
        font-weight: bold;
    }

    ul li a:hover {
        text-decoration: underline;
        color: #0056b3;
    }
    </style>
</head>

<body>
    <h1>Welcome, Admin <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
    <p>This is the admin page. You can access all other pages:</p>
    <ul>
        <li><a href="student.php">Student Page</a></li>
        <li><a href="lecturer.php">Lecturer Page</a></li>
    </ul>
</body>

</html>
