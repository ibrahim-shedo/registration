<?php
session_start();

// Redirect to login if user is not logged in or is not an admin
if (!isset($_SESSION['user_account']) || $_SESSION['user_account'] !== 'admin') {
    header('Location: login.html');
    exit;
}

// Simulated admin data (replace with actual data fetching logic)
$adminData = [
    'username' => isset($_SESSION['username']) ? $_SESSION['username'] : 'Admin',
    'userStats' => [
        'students' => 120,
        'lecturers' => 15,
        'courses' => 25,
    ],
    'recentActivity' => [
        ['timestamp' => '2024-07-17 14:23', 'action' => 'User John Doe logged in.'],
        ['timestamp' => '2024-07-17 15:02', 'action' => 'Course "Introduction to PHP" updated.'],
    ],
];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f8f9fa;
        margin: 0;
        padding: 0;
    }

    .container {
        padding: 2%;
        background: #fff;
    }

    h1 {
        color: #007bff;
        text-align: center;
    }

    .section {
        margin-bottom: 20px;
    }

    .section h2 {
        border-bottom: 2px solid #007bff;
        padding-bottom: 10px;
        margin-bottom: 10px;
        color: #007bff;
    }

    .section p {
        margin: 5px 0;
    }

    .stats {
        display: flex;
        justify-content: space-around;
        text-align: center;
    }

    .stats div {
        background: #f1f1f1;
        padding: 15px;
        border-radius: 4px;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    }

    .recent-activity {
        list-style-type: none;
        padding: 0;
    }

    .recent-activity li {
        padding: 10px;
        background: #f8f9fa;
        border-bottom: 1px solid #ddd;
    }

    .recent-activity li:last-child {
        border-bottom: none;
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

    .nav-links {
        text-align: center;
        margin: 20px 0;
    }

    .nav-links a {
        text-decoration: none;
        color: #007bff;
        font-weight: bold;
        margin: 0 15px;
    }

    .nav-links a:hover {
        text-decoration: underline;
    }

    .notifications {
        background: #e7f0ff;
        padding: 15px;
        border-radius: 4px;
        margin-bottom: 20px;
    }

    .notifications h3 {
        margin-top: 0;
    }

    .system-health {
        background: #d4edda;
        padding: 15px;
        border-radius: 4px;
        margin-bottom: 20px;
    }

    .system-health h3 {
        margin-top: 0;
    }
    </style>
</head>

<body>
    <div class="container">
        <h1>Welcome, Admin <?php echo htmlspecialchars($adminData['username']); ?>!</h1>

        <div class="nav-links">
            <a href="student.php">Student Page</a>
            <a href="lecturer.php">Lecturer Page</a>

        </div>

        <div class="notifications">
            <h3>Notifications</h3>
            <p>No new notifications.</p> <!-- Replace with actual notifications -->
        </div>

        <div class="system-health">
            <h3>System Health</h3>
            <p>Server Uptime: 99.99%</p>
            <p>Errors: 0</p> <!-- Replace with actual system metrics -->
        </div>

        <div class="section">
            <h2>System Statistics</h2>
            <div class="stats">
                <div>
                    <h3><?php echo htmlspecialchars($adminData['userStats']['students']); ?></h3>
                    <p>Students</p>
                </div>
                <div>
                    <h3><?php echo htmlspecialchars($adminData['userStats']['lecturers']); ?></h3>
                    <p>Lecturers</p>
                </div>
                <div>
                    <h3><?php echo htmlspecialchars($adminData['userStats']['courses']); ?></h3>
                    <p>Courses</p>
                </div>
            </div>
        </div>

        <div class="section">
            <h2>Recent Activity</h2>
            <ul class="recent-activity">
                <?php foreach ($adminData['recentActivity'] as $activity) : ?>
                <li>
                    <strong><?php echo htmlspecialchars($activity['timestamp']); ?>:</strong>
                    <p><?php echo htmlspecialchars($activity['action']); ?></p>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>

        <div class="footer">
            <p>© <?php echo date('Y'); ?> Mount Kenya University. All rights reserved.</p>
        </div>
    </div>
</body>

</html>
