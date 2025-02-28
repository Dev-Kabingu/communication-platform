<?php
include('db_config.php');
// add_event.php
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     $eventDate = $_POST['eventDate'];
//     $eventTitle = $_POST['eventTitle'];

    // Database connection
    // $mysqli = new mysqli("localhost", "root", "", "school_db");

    // if ($mysqli->connect_error) {
    //     die("Connection failed: " . $mysqli->connect_error);
    // }

    // Insert event into the database
//     $stmt = $mysqli->prepare("INSERT INTO events (event_date, event_title) VALUES (?, ?)");
//     $stmt->bind_param("ss", $eventDate, $eventTitle);

//     if ($stmt->execute()) {
//         echo "Event added successfully!";
//     } else {
//         echo "Error: " . $stmt->error;
//     }

//     $stmt->close();
//     $mysqli->close();
// }
?>


<?php
// session_start();

// Check if the user is logged in and if they are admin or teacher
// if (!isset($_SESSION['user']) || ($_SESSION['role'] != 'admin' && $_SESSION['role'] != 'teacher')) {
//     header("Location: login.html");
//     exit();
// }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $event_date = $_POST['event_date'];
    $event_title = $_POST['event_title'];
    $event_description = $_POST['event_description'];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "school_forum_db";
    $conn = new mysqli($servername, $username, $password, $dbname);

    $sql = "INSERT INTO events (event_date, event_title, event_description) VALUES ('$event_date', '$event_title','$event_description')";
    if ($conn->query($sql) === TRUE) {
        echo "Event added successfully!";
        header("Location: view_event.php");
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
    <title>Add Event</title>
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
        input {
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
        <h2>Add a New Event</h2>
        <form action="add_event.php" method="POST">
            <label for="event_date">Event Date:</label><br>
            <input type="date" id="event_date" name="event_date" required><br><br>
            <label for="event_title">Event Title:</label><br>
            <input type="text" id="event_title" name="event_title" required><br><br>
            <label for="event_title">Event Description:</label><br>
            <input type="text" id="event_description" name="event_description" required><br><br>
            <button type="submit">Add Event</button>
        </form>
    </div>
</body>
</html>






