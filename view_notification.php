<?php
// session_start();

// Check if the user is logged in
// if (!isset($_SESSION['user'])) {
//     header("Location: login.html");
//     exit();
// }

// $user = $_SESSION['user'];

// Fetch notifications from the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "school_forum_db";
$conn = new mysqli($servername, $username, $password, $dbname);

$sql = "SELECT * FROM notifications ORDER BY created_at DESC";
$result = $conn->query($sql);

echo "<h2>Notifications</h2>";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Notifications</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f1f1f1;
            padding: 20px;
        }
        .notification {
            background-color: white;
            padding: 20px;
            margin: 10px 0;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #333;
        }
        h3 {
            color: #333;
        }
        p {
            color: #555;
        }
    </style>
</head>
<body>
    <?php while ($row = $result->fetch_assoc()) { ?>
    <div class="notification">
        <h3><strong>Title:</strong><?php echo $row['title']; ?></h3>
        <p> <strong>Posted On:</strong><br> <?php echo $row['created_at']; ?></p>
        <p><strong>Message:</strong><br><?php echo $row['message']; ?></p>
    </div>
    <?php } ?>
</body>
</html>
