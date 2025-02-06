
<?php
include 'conn.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $sql->execute([$username]);
    $user = $sql->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];
        header("Location: communication_forum.php");
        exit();
    } else {
        $error = "Invalid username or password";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>
    <div class="form-container">
    
    <?php if (isset($error)) { echo "<p>$error</p>"; } ?>
    <form method="POST" action="login_communication_forum.php">
    <h2>Login</h2>
    <h4>Welcome to the communication forum</h4>
       <div class="form-group">
       <label for="username">Username:</label>
       <input type="text" id="username" name="username" required>
       </div>
       <div class="form-group">
       <label for="password">Password:</label>
       <input type="password" id="password" name="password" required>
       </div>
       <div class="form-group">
       <button type="submit" class = "formButton btn">Login</button>
       </div>
       <p>Don't have an account? <a href="register_communication_forum.php">Register Here</a></p>
    </form>
    </div>
</body>
</html>
