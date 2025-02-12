<?php
include "conn.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get user input
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare and execute the query to check if the user exists in the database
    $sql = "SELECT * FROM users_credentials WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($user) {
        // Verify password
        if (password_verify($password, $user['password'])) {
            // Login successful
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];

            // Redirect based on user type
            if ($user['role'] == 'admin') {
                header('Location: admin_dashboard.php');
            } elseif ($user['role'] == 'teacher' || $user['role'] == 'parent') {
                header('Location: dashboard.php');
            }
        } else {
            echo "Incorrect password!";
        }
    } else {
        echo "No user found with that email!";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./css/styles.css">
</head>
<body>

    <section>
        <div class="form-container">
            <form action="login_form.php" method="post">
                <h1>Login</h1>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="form-group">
                    <input type="submit" id="login" class="loginBtn formButton" name="login" value="Login">
                </div>
                <p>Don't have an account? &nbsp<a href="registration_form.php">Register now</a></p>
            </form>
        </div>
    </section>
    
</body>
</html>