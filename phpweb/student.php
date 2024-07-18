<?php
session_start();
if (!isset($_SESSION['user_account']) || ($_SESSION['user_account'] !== 'student' && $_SESSION['user_account'] !== 'admin')) {
    header('Location: login.html');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Page</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
    <p>This is the student page.</p>
</body>

</html>
