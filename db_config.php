<?php
// db_config.php - MySQLi connection file

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "school_forum_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
