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
    'courses' => ['Internet Programming', 'Database System', 'Mobile Computing'],  // Example courses
    'schedule' => [
        'Monday' => '9:00 AM - 11:00 AM: Internet Programming',
        'Wednesday' => '2:00 PM - 4:00 PM: Database System',
        'Friday' => '10:00 AM - 12:00 PM: Mobile Computing',
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

    .upload-section {
        margin-top: 20px;
    }

    .upload-section input[type="file"] {
        margin-bottom: 10px;
    }

    .upload-section button {
        background-color: #007bff;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .upload-section button:hover {
        background-color: #0056b3;
    }

    .feedback-response {
        margin-top: 10px;
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
                    <form class="feedback-response" action="respond_feedback.php" method="post">
                        <input type="hidden" name="student"
                            value="<?php echo htmlspecialchars($feedback['student']); ?>">
                        <textarea name="response" rows="2" cols="50" placeholder="Type your response..."></textarea>
                        <button type="submit">Respond</button>
                    </form>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>

        <div class="section upload-section">
            <h2>Upload Course Material</h2>
            <form action="upload_material.php" method="post" enctype="multipart/form-data">
                <label for="course">Course:</label>
                <select name="course" id="course">
                    <?php foreach ($lecturerData['courses'] as $course) : ?>
                    <option value="<?php echo htmlspecialchars($course); ?>"><?php echo htmlspecialchars($course); ?>
                    </option>
                    <?php endforeach; ?>
                </select>
                <input type="file" name="material" id="material">
                <button type="submit">Upload</button>
            </form>
        </div>

        <div class="section">
            <h2>Assignment Management</h2>
            <form action="upload_assignment.php" method="post" enctype="multipart/form-data">
                <label for="course-assignment">Course:</label>
                <select name="course" id="course-assignment">
                    <?php foreach ($lecturerData['courses'] as $course) : ?>
                    <option value="<?php echo htmlspecialchars($course); ?>"><?php echo htmlspecialchars($course); ?>
                    </option>
                    <?php endforeach; ?>
                </select>
                <input type="file" name="assignment" id="assignment">
                <button type="submit">Upload Assignment</button>
            </form>
        </div>

        <div class="section">
            <h2>Grade Management</h2>
            <form action="update_grade.php" method="post">
                <label for="student">Student:</label>
                <input type="text" name="student" id="student" placeholder="Student name">
                <label for="course-grade">Course:</label>
                <select name="course" id="course-grade">
                    <?php foreach ($lecturerData['courses'] as $course) : ?>
                    <option value="<?php echo htmlspecialchars($course); ?>"><?php echo htmlspecialchars($course); ?>
                    </option>
                    <?php endforeach; ?>
                </select>
                <label for="grade">Grade:</label>
                <input type="text" name="grade" id="grade" placeholder="Grade">
                <button type="submit">Update Grade</button>
            </form>
        </div>

        <div class="footer">
            <p>© <?php echo date('Y'); ?> Mount Kenya University. All rights reserved.</p>
        </div>
    </div>
</body>

</html>
