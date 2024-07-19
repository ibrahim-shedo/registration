<?php
session_start();

// Redirect to login if user is not logged in or is not authorized
if (!isset($_SESSION['user_account']) || ($_SESSION['user_account'] !== 'lecturer' && $_SESSION['user_account'] !== 'admin')) {
    header('Location: login.html');
    exit;
}

// Simulated lecturer data (replace with your actual data fetching logic)
$lecturerData = [
    'username' => isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest',
    'courses' => ['internet programming', 'database system', 'mobile computing'],  // Example courses
    'schedule' => [
        'Monday' => '9:00 AM - 11:00 AM: internet programming',
        'Wednesday' => '2:00 PM - 4:00 PM: database system',
        'Friday' => '10:00 AM - 12:00 PM: mobile computing',
    ],  // Example schedule
    'feedback' => [
        ['student' => 'Maina Wanjiru', 'comment' => 'Great lecture, very engaging!'],
        ['student' => 'Ibrahim Mohamed', 'comment' => 'Found the material a bit challenging but helpful.'],
    ],  // Example feedback
];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lecturer Page</title>
    <style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f8f9fa;
        margin: 0;
        padding: 0;
    }

    .container {

        background: #fff;
        padding: 2%;

    }

    h1 {
        color: #333;
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

    .courses-list,
    .feedback-list {
        list-style-type: none;
        padding: 0;
    }

    .courses-list li,
    .feedback-list li {
        padding: 10px;
        background-color: #f8f9fa;
        border-radius: 4px;
        margin-bottom: 10px;
    }

    .feedback-list li {
        border-left: 5px solid #007bff;
    }

    .schedule-table {
        width: 100%;
        border-collapse: collapse;
    }

    .schedule-table th,
    .schedule-table td {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: left;
    }

    .schedule-table th {
        background-color: #007bff;
        color: white;
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
    </style>
</head>

<body>
    <div class="container">
        <h1>Welcome, <?php echo htmlspecialchars($lecturerData['username']); ?>!</h1>

        <div class="section">
            <h2>My Courses</h2>
            <ul class="courses-list">
                <?php foreach ($lecturerData['courses'] as $course) : ?>
                <li><?php echo htmlspecialchars($course); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>

        <div class="section">
            <h2>Lecture Schedule</h2>
            <table class="schedule-table">
                <thead>
                    <tr>
                        <th>Day</th>
                        <th>Time</th>
                        <th>Course</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($lecturerData['schedule'] as $day => $details) : ?>
                    <tr>
                        <td><?php echo htmlspecialchars($day); ?></td>
                        <td><?php echo htmlspecialchars($details); ?></td>
                        <td><?php echo htmlspecialchars($details); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="section">
            <h2>Student Feedback</h2>
            <ul class="feedback-list">
                <?php foreach ($lecturerData['feedback'] as $feedback) : ?>
                <li>
                    <strong><?php echo htmlspecialchars($feedback['student']); ?>:</strong>
                    <p><?php echo htmlspecialchars($feedback['comment']); ?></p>
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
