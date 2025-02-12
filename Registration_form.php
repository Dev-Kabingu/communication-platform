<?php
include "conn.php";

// Store the error messages
$email_error = "";
$password_error = "";
$confirm_password_error = "";

$error = false;

// Check form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = isset($_POST['name']) ? htmlspecialchars(trim($_POST['name'])) : '';
    $email = isset($_POST['email']) ? htmlspecialchars(trim($_POST['email'])) : '';
    $user_type = isset($_POST['user-type']) ? htmlspecialchars(trim($_POST['user-type'])) : '';
    $password = isset($_POST['password']) ? htmlspecialchars(trim($_POST['password'])) : '';
    $confirm_password = isset($_POST['confirm_password']) ? htmlspecialchars(trim($_POST['confirm_password'])) : '';

    $hash_password = password_hash($password, PASSWORD_BCRYPT);

    // Check if user exists
    $user_exist = "SELECT * FROM users_credentials WHERE email = ?";
    $stmt = $conn->prepare($user_exist);
    $stmt->execute([$email]);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($results) > 0) {
        $email_error = "User Already Exist";
        $error = true;
    } else {
        // Validate data before inserting into the database
        if (strlen($password) < 8) {
            $password_error = 'Password must be more than 8 characters';
            $error = true;
        } elseif ($confirm_password != $password) {
            $confirm_password_error = "Passwords do not match";
            $error = true;
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $email_error = 'Unsupported email format';
            $error = true;
        }

        // If there are no errors
        if (!$error) {
            $sql_insert = "INSERT INTO users_credentials (full_name, email, role, password)
                           VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql_insert);
            $stmt->execute([$name, $email, $user_type, $hash_password]);

            if ($stmt->rowCount() > 0) {
                echo "Registration successful";
                header("Location: login_form.php");
                exit();
            }
        }
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="./css/styles.css">
</head>
<body>

    <section>
        <div class="form-container registration-form">
            <form action="Registration_form.php" method="post">
                <h1>Register</h1>
                <div class="form-group">
                    <label for="name">Full Name:</label>
                    <input type="text" id="name" name="name">

                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                    <span class = "error-message" ><?= $email_error?></span>
                </div>
                <div class="form-group">
                    <select name="user-type" id="user-type" required>
                        <option value=""></option>
                        <option value="admin">Admin</option>
                        <option value="teacher">Teacher</option>
                        <option value="parent">Parent</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                    <span class = "error-message" ><?= $password_error?></span>
                </div>
                <div class="form-group">
                    <label for="confirm_password">Confirm Password:</label>
                    <input type="password" id="confirm_password" name="confirm_password" required>
                    <span class = "error-message" > <?= $confirm_password_error ?></span>
                </div>
                <div class="form-group">
                    <input type="submit" id="register" class="registerBtn formButton" name="register" value="Register">
                </div>
                <p>Already have an account? &nbsp<a href="login_form.php">Login now</a></p>
            </form>
        </div>
    </section>
    
</body>
</html>