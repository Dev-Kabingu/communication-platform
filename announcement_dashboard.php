<?php

session_start();

// // Check if the user is logged in
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$user = $_SESSION['user'];
$role = $_SESSION['role'];

// Redirect parents to view page (if they access the dashboard)
if ($role == 'parent') {
    header("Location: view_announcements.php");
    exit();
}

// Check if user is admin or teacher
if ($role != 'admin' && $role != 'teacher') {
    echo "You do not have permission to access this page.";
    exit();
}

 echo "Welcome, $user. You can now manage announcements and events.";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Announcement Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f1f1f1;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #333;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 20px;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Welcome, <?php echo $user; ?>. You can manage announcements and events.</h2>
        <button onclick="window.location.href='add_announcement.php'">Add Announcement</button>
        <button onclick="window.location.href='add_event.php'">Add Event</button>
    </div>
</body>
</html>
