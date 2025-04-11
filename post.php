<?php
session_start();
require_once "database/database.php";


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts - Upost</title>
    <link rel="stylesheet" href="css/main2.css">
</head>
<body>
    <div class="post-container">
        <form action="create_post.php" method="POST" class="post-form">
            <textarea name="content" placeholder="What's on your mind?" required></textarea>
            <button type="submit">Post</button>
        </form>

        <div id="posts">
            <?php
            $query = "SELECT posts.*, account.username, 
                     (SELECT COUNT(*) FROM likes WHERE post_id = posts.id) as like_count
                     FROM posts 
                     JOIN account ON posts.user_id = account.id 
                     ORDER BY posts.created_at DESC";
            
            try {
                $posts = $conn->query($query)->fetchAll(PDO::FETCH_ASSOC);

                foreach ($posts as $post) {
                    echo '<div class="post" data-post-id="' . $post['id'] . '">';
                    echo '<div class="post-header">';
                    echo '<span class="username">' . htmlspecialchars($post['username']) . '</span>';
                    echo '<span class="date">' . date('M d, Y', strtotime($post['created_at'])) . '</span>';
                    echo '</div>';
                    echo '<div class="post-content">' . htmlspecialchars($post['content']) . '</div>';
                    echo '<div class="post-actions">';
                    echo '<button class="like-btn" onclick="toggleLike(' . $post['id'] . ')">';
                    echo '<span class="like-count">' . $post['like_count'] . '</span> Likes</button>';
                    echo '<button onclick="showComments(' . $post['id'] . ')">Comments</button>';
                    echo '</div>';
                    echo '<div class="comments-section" id="comments-' . $post['id'] . '"></div>';
                    echo '</div>';
                }
            } catch (PDOException $e) {
                echo "Error loading posts: " . $e->getMessage();
            }
            ?>
        </div>
    </div>
    <?php include 'partilas/footer.php'; ?>
    <script src="js/posts.js"></script>
</body>
</html>