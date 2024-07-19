<?php
session_start();

// Redirect to login if user is not logged in or is not authorized
if (!isset($_SESSION['user_account']) || ($_SESSION['user_account'] !== 'student' && $_SESSION['user_account'] !== 'admin')) {
    header('Location: login.html');
    exit;
}

// Simulated user data (replace with your actual data fetching logic)
$userData = [
    'username' => isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest',
    'email' => 'user@example.com',  // Example data, replace with actual user data
    'courses' => [
        ['name' => 'Internet Programming', 'assignments' => ['Assignment 1', 'Assignment 2']],
        ['name' => 'Database System', 'assignments' => ['Assignment 1']],
        ['name' => 'Mobile Computing', 'assignments' => ['Assignment 1', 'Assignment 2', 'Assignment 3']],
    ],  // Example courses with assignments
    'grades' => [
        'Internet Programming' => 'A',
        'Database System' => 'B+',
        'Mobile Computing' => 'A-',
    ],  // Example grades
    'notifications' => [
        'Welcome to the new semester!',
        'Your grades for the previous semester have been updated.',
        'Upcoming assignment deadlines are approaching.',
    ],  // Example notifications
];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Page</title>
    <style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f8f9fa;
        margin: 0;
        padding: 0;
    }

    .container {
        max-width: 1200px;
        margin: 20px auto;
        padding: 20px;
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h1 {
        color: #007bff;
        text-align: center;
    }

    h2 {
        color: #007bff;
    }

    .user-info,
    .notifications {
        margin-bottom: 20px;
        border-bottom: 1px solid #ccc;
        padding-bottom: 10px;
    }

    .user-info p,
    .notifications p {
        margin: 5px 0;
    }

    .content {
        margin-top: 30px;
    }

    .logout-btn {
        background-color: #007bff;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        float: center;
        transition: background-color 0.3s;
    }

    .logout-btn:hover {
        background-color: #0056b3;
    }

    .courses-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 20px;
    }

    .course-section {
        padding: 15px;
        background-color: #f8f9fa;
        border-radius: 4px;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    }

    .course-section:hover {
        background-color: #e9ecef;
    }

    .footer {
        margin-top: 20px;
        text-align: center;
        color: #888;
    }

    .footer a {
        color: #888;
        text-decoration: none;
    }

    .footer a:hover {
        text-decoration: underline;
    }

    .grade {
        font-weight: bold;
        color: #007bff;
    }
    </style>
</head>

<body>
    <div class="container">
        <h1>Welcome, <?php echo htmlspecialchars($userData['username']); ?>!</h1>

        <div class="user-info">
            <p><strong>Email:</strong> <?php echo htmlspecialchars($userData['email']); ?></p>
        </div>

        <div class="notifications">
            <h2>Notifications</h2>
            <ul class="notifications-list">
                <?php foreach ($userData['notifications'] as $notification) : ?>
                <li><?php echo htmlspecialchars($notification); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>

        <div class="content">
            <h2>Your Courses</h2>
            <div class="courses-grid">
                <?php foreach ($userData['courses'] as $course) : ?>
                <div class="course-section">
                    <h3><?php echo htmlspecialchars($course['name']); ?></h3>
                    <h4>Assignments:</h4>
                    <ul>
                        <?php foreach ($course['assignments'] as $assignment) : ?>
                        <li><?php echo htmlspecialchars($assignment); ?></li>
                        <?php endforeach; ?>
                    </ul>
                    <p><strong>Grade:</strong> <span
                            class="grade"><?php echo htmlspecialchars($userData['grades'][$course['name']] ?? 'N/A'); ?></span>
                    </p>
                </div>
                <?php endforeach; ?>
            </div>
            <form action="logout.php" method="post">
                <button type="submit" class="logout-btn">Logout</button>
            </form>
        </div>

        <div class="footer">
            <p>© <?php echo date('Y'); ?> Mount Kenya University. All rights reserved.</p>
        </div>
    </div>
</body>

</html>
