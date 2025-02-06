<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher-Parent Communication Platform</title>
    <!-- <link rel="stylesheet" href="style.css"> -->
    <style>
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f9;
    color: #333;
    line-height: 1.6;
}

header {
    background-color: #3e8e41;
    color: white;
    padding: 1rem 0;
    text-align: center;
}

header h1 {
    font-size: 2.5rem;
}

nav ul {
    list-style-type: none;
    padding: 0;
}

nav ul li {
    display: inline;
    margin: 0 15px;
}

nav ul li a {
    color: white;
    text-decoration: none;
    font-size: 1.1rem;
}

main {
    padding: 20px;
}

.intro {
    text-align: center;
    margin-bottom: 40px;
}

.features {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
}

.feature {
    background-color: white;
    padding: 20px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
}

.feature h3 {
    color: #3e8e41;
    font-size: 1.5rem;
    margin-bottom: 10px;
}

footer {
    text-align: center;
    padding: 10px;
    background-color: #3e8e41;
    color: white;
}

    </style>
</head>
<body>
    <header>
        <h1>Teacher-Parent Communication Platform</h1>
        <nav>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="login_communication_forum.php" >Messages</a></li>
                <li><a href="#">Notifications</a></li>
                <li><a href="uploaded_files.php">Assignments</a></li>
                <li><a href="#">Guides</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="intro">
            <h2>Welcome to the Communication Platform</h2>
            <p>Here you can interact with teachers and keep up with important events, assignments, and guides!</p>
        </section>

        <section class="features">
            <div class="feature">
                <h3>Messages</h3>
                <p>Send and receive messages between parents and teachers.</p>
            </div>
            <div class="feature">
                <h3>Notifications</h3>
                <p>Stay updated with important events and notices from the teacher.</p>
            </div>
            <div class="feature">
                <h3>Assignments</h3>
                <p>View and submit assignments posted by the teacher.</p>
            </div>
            <div class="feature">
                <h3>Step-by-Step Guides</h3>
                <p>Access guides for how to complete different assignments.</p>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 Teacher-Parent Communication Platform</p>
    </footer>
</body>
</html>
