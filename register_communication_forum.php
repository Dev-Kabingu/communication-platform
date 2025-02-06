
<?php
include 'conn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $role = $_POST['role'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $sql = $conn->prepare("INSERT INTO users (username, role, password) VALUES (?, ?, ?)");
    $sql->execute([$username, $role, $password]);

    header("Location: login_communication_forum.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" type="text/css" href="./css/styles.css">
</head>
<body>
    <div class="form-container">
    
    <form method="POST" action="register_communication_forum.php">
    <h2>Register</h2>
    <h4>Register for the communication forum</h4>
       <div class="form-group">
       <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        
       </div>
        <div class="form-group">
        <label for="role">Role:</label>
        <select id="role" name="role" required>
            <option value="parent">Parent</option>
            <option value="teacher">Teacher</option>
        </select>
        </div>
        <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        </div>
        <div class="form-group">
        <button type="submit" class = "formButton btn">Register</button>
        </div>
        <p>Already have an account? <a href="login_communication_forum.php">Login Here</a></p>
    </form>
    </div>
</body>
</html>
