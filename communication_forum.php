
<?php
include 'conn.php';

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login_communication_forum.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Unknown';
$role = isset($_SESSION['role']) ? $_SESSION['role'] : 'Unknown';

// Check if user_id exists in the users table
$sql = $conn->prepare("SELECT * FROM users WHERE id = ?");
$sql->execute([$user_id]);
$user = $sql->fetch();

if (!$user) {
    die("User ID not found in the users table.");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $content = $_POST['content'];
    $parent_id = $_POST['parent_id'] ?? 0;

    $sql = $conn->prepare("INSERT INTO posts (user_id, content, parent_id) VALUES (?, ?, ?)");
    $sql->execute([$user_id, $content, $parent_id]);

    header("Location: communication_forum.php");
    exit();
}

$sql = $conn->prepare("SELECT posts.*, users.username, users.role FROM posts JOIN users ON posts.user_id = users.id ORDER BY posts.created_at DESC");
$sql->execute();
$posts = $sql->fetchAll();

function display_posts($posts, $parent_id = 0, $indent = 0) {
    foreach ($posts as $post) {
        if ($post['parent_id'] == $parent_id) {
            echo '<div style="margin-left: ' . $indent . 'px; padding: 10px; border: 1px solid #ccc; border-radius: 8px margin-bottom: 10px;">';
            echo '<p><strong>' . $post['username'] . ' (' . $post['role'] . ')</strong> ' . $post['created_at'] . '</p>';
            echo '<p>' . $post['content'] . '</p>';
            echo '<button class="reply-button" data-id="' . $post['id'] . '">Reply</button>';
            echo '<form class="reply-form" method="POST" action="communication_forum.php" style="display: none; margin-top: 10px;">';
            echo '<textarea name="content" required></textarea>';
            echo '<input type="hidden" name="parent_id" value="' . $post['id'] . '">';
            echo '<button type="submit" class = "reply-btn">Post Reply</button>';
            echo '</form>';
            
            // Display replies
            $replies = array_filter($posts, function($reply) use ($post) {
                return $reply['parent_id'] == $post['id'];
            });

            $reply_count = count($replies);
            echo '<div class="replies" id="replies-' . $post['id'] . '">';
            foreach ($replies as $index => $reply) {
                $style = $index > 0 ? 'display: none;' : '';
                echo '<div class="reply-container" style="margin-left: 40px; padding: 4px; border-bottom: 1px solid #ccc; margin-bottom: 10px;' . $style . '">';
                echo '<p><strong>' . $reply['username'] . ' (' . $reply['role'] . ')</strong> ' . $reply['created_at'] . '</p>';
                echo '<p>' . $reply['content'] . '</p>';
                echo '</div>';
            }
            if ($reply_count > 1) {
                echo '<button class="view-replies-button" data-post-id="' . $post['id'] . '" style="margin-left: 40px;">View All Replies (' . ($reply_count - 1) . ' more)</button>';
            }
            echo '</div>';  
            echo '</div>'; 
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Forum</title>
    <link rel="stylesheet" type="text/css" href="styles_forum.css">
</head>
<body>
    
    <form method="POST" action="communication_forum.php">
    <h2>Community Forum</h2>
        <textarea name="content" placeholder = "Write a message" required></textarea>
        <button type="submit" class= "post-message-btn">Post</button>
    </form>
    <hr>
    <?php display_posts($posts); ?>
    
    <script>
        // Handle reply form toggling
        document.addEventListener('DOMContentLoaded', function() {
            // Toggle reply form visibility
            document.querySelectorAll('.reply-button').forEach(button => {
                button.addEventListener('click', function() {
                    var form = this.nextElementSibling;
                    form.style.display = form.style.display === 'none' ? 'block' : 'none';
                });
            });

            // Handle view replies and hide replies
            document.querySelectorAll('.view-replies-button').forEach(button => {
                button.addEventListener('click', function() {
                    var postId = this.getAttribute('data-post-id');
                    var replies = document.getElementById('replies-' + postId);
                    
                    // Show all hidden replies
                    replies.querySelectorAll('.reply-container').forEach(container => {
                        container.style.display = 'block';
                    });

                    // Change button text to "Hide Replies"
                    this.textContent = 'Hide Replies';
                    this.classList.add('hide-replies-button'); 
                });
            });

            // Handle hide replies
            document.querySelectorAll('.hide-replies-button').forEach(button => {
                button.addEventListener('click', function() {
                    var postId = this.getAttribute('data-post-id');
                    var replies = document.getElementById('replies-' + postId);
                    
                    // Hide all replies again
                    replies.querySelectorAll('.reply-container').forEach((container, index) => {
                        if (index > 0) {
                            container.style.display = 'none';
                        }
                    });

                    // Change button text back to "View All Replies"
                    this.textContent = 'View All Replies';
                    this.classList.remove('hide-replies-button');
                });
            });
        });
    </script> 
</body>
</html>
