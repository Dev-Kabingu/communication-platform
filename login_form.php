<?php
include "./connect.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get user input
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    // Check if user exists in the database
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        // Verify password
        if (password_verify($password, $user['password'])) {
            // Login successful
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_type'] = $user['user_type'];

            // Redirect based on user type
            if ($user['user_type'] == 'admin') {
                header('Location: ../Admin Dashboard/admin_dashboard.php');
            } elseif ($user['user_type'] == 'teacher') {
                header('Location: ../Dashboard/uploaded_files.php');
            } elseif ($user['user_type'] == 'parent') {
                header('Location: ../Dashboard/uploaded_files.php');
            }
        } else {
            echo "Incorrect password!";
        }
    } else {
        echo "No user found with that email!";
    }

    $conn->close();
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
            <form action="login.php" method="post">
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