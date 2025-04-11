<?php
session_start();
require_once "database/database.php";

if (!isset($_SESSION['user']) || !isset($_SESSION['user_id'])) {
    header("Location: login-form.php");
    exit();
}
?>
<?php require "partilas/header.php"; ?>
<body>
    <div class="post-container">
        
        <form action="create_post.php" method="POST" class="post-form">
            <textarea name="content" placeholder="What's on your mind?" required></textarea>
            <button type="submit">Post</button>
        </form>

        
        <div id="posts">
            <?php
            $query = "SELECT p.*, a.username, 
                     (SELECT COUNT(*) FROM likes WHERE post_id = p.id) as like_count,
                     EXISTS(SELECT 1 FROM likes WHERE post_id = p.id AND user_id = ?) as user_liked
                     FROM posts p 
                     JOIN account a ON p.user_id = a.id 
                     ORDER BY p.created_at DESC";
            
            try {
                $stmt = $conn->prepare($query);
                $stmt->execute([$_SESSION['user_id']]);
                $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach ($posts as $post) {
                    ?>
                    <div class="post" data-post-id="<?= $post['id'] ?>">
                        <div class="post-header">
                            <span class="username"><?= htmlspecialchars($post['username']) ?></span>
                            <div class="post-actions-right">
                                <?php if ($post['user_id'] == $_SESSION['user_id']): ?>
                                    <button class="delete-post-btn" onclick="deletePost(<?= $post['id'] ?>)">
                                        Delete
                                    </button>
                                <?php endif; ?>
                                <span class="date"><?= date('M d, Y', strtotime($post['created_at'])) ?></span>
                            </div>
                        </div>
                        <div class="post-content">
                            <?= htmlspecialchars($post['content']) ?>
                        </div>
                        <div class="post-actions">
                            <button class="like-btn <?= $post['user_liked'] ? 'liked' : '' ?>" 
                                    onclick="toggleLike(<?= $post['id'] ?>)">
                                <span class="like-count"><?= $post['like_count'] ?></span> Likes
                            </button>
                            <button class="comment-btn" onclick="toggleComments(<?= $post['id'] ?>)">
                                Comments
                            </button>
                        </div>
                        <div class="comments-section" id="comments-<?= $post['id'] ?>">
                            <div class="comments-list" id="comments-list-<?= $post['id'] ?>"></div>
                            <form onsubmit="addComment(event, <?= $post['id'] ?>)" class="comment-form">
                                <input type="text" placeholder="Write a comment..." required>
                                <button type="submit">Comment</button>
                            </form>
                        </div>
                    </div>
                    <?php
                }
            } catch (PDOException $e) {
                echo "Error loading posts: " . $e->getMessage();
            }
            ?>
        </div>
    </div>

    <?php require "partilas/footer.php"; ?>

    <script>
        const userId = <?php echo $_SESSION['user_id']; ?>;
    </script>
    <script src="javascript\main.js"></script>
</body>
</html>
