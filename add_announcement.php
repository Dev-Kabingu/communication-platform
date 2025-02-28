<?php

include('db_config.php');
// add_announcement.php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $announcement = $_POST['announcement'];

    // Database connection
    $mysqli = new mysqli("localhost", "root", "", "school_db");

    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    // Insert announcement into the database
    $stmt = $mysqli->prepare("INSERT INTO announcements (message) VALUES (?)");
    $stmt->bind_param("s", $announcement);

    if ($stmt->execute()) {
        echo "Announcement added successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $mysqli->close();
}
?>


<?php
// session_start();

// Check if the user is logged in and if they are an admin
// if (!isset($_SESSION['user']) || $_SESSION['role'] != 'admin') {
//     header("Location: login.html");
//     exit();
// }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $announcement_title = $_POST['title'];
    $announcement_content = $_POST['content'];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "$school_forum_db";
    $conn = new mysqli($servername, $username, $password, $school_forum_db);

    $sql = "INSERT INTO announcements (title, content) VALUES ('$announcement_title', '$announcement_content')";
    if ($conn->query($sql) === TRUE) {
        echo "Announcement added successfully!";
        header("Location: view_announcement.php");
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Announcement</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f1f1f1;
            padding: 20px;
        }
        .form-container {
            max-width: 800px;
            margin: auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        label {
            font-size: 16px;
            color: #555;
        }
        input, textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Add a New Announcement</h2>
        <form action="add_announcement.php" method="POST">
            <label for="title">Announcement Title:</label><br>
            <input type="text" id="title" name="title" required><br><br>
            <label for="content">Content:</label><br>
            <textarea id="content" name="content" rows="4" required></textarea><br><br>
            <button type="submit">Add Announcement</button>
        </form>
    </div>
</body>
</html>






