<?php
session_start();
require_once "database/database.php";
require_once "check_admin.php";


if (!isset($_SESSION['user_id']) || !isAdmin($conn, $_SESSION['user_id'])) {
    header("Location: login-form.php");
    exit();
}


if (isset($_POST['delete_user'])) {
    $user_id = $_POST['user_id'];
    try {
        
        $conn->prepare("DELETE FROM likes WHERE user_id = ?")->execute([$user_id]);
        $conn->prepare("DELETE FROM comments WHERE user_id = ?")->execute([$user_id]);
        $conn->prepare("DELETE FROM posts WHERE user_id = ?")->execute([$user_id]);

        $conn->prepare("DELETE FROM account WHERE id = ? AND username != 'majd'")->execute([$user_id]);
    } catch(PDOException $e) {
        $error = "Error deleting user: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Upost</title>
    <link rel="stylesheet" href="css/main2.css">
</head>
<body>
    <?php require "partilas/header.php"; ?>

    <div class="admin-container">
        <h1>Admin Panel</h1>
        
        <?php if (isset($error)): ?>
            <div class="error-message"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <div class="users-list">
            <h2>Manage Users</h2>
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Registration Date</th>
                        <th>Posts</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $stmt = $conn->query("
                        SELECT a.*, 
                        (SELECT COUNT(*) FROM posts WHERE user_id = a.id) as post_count 
                        FROM account a 
                        ORDER BY a.id DESC
                    ");
                    while ($user = $stmt->fetch(PDO::FETCH_ASSOC)):
                        if ($user['username'] !== 'majd'): 
                    ?>
                        <tr>
                            <td><?= htmlspecialchars($user['id']) ?></td>
                            <td><?= htmlspecialchars($user['username']) ?></td>
                            <td><?= date('M d, Y', strtotime($user['created_at'])) ?></td>
                            <td><?= $user['post_count'] ?></td>
                            <td>
                                <form method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                    <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                                    <button type="submit" name="delete_user" class="delete-user-btn">Delete User</button>
                                </form>
                            </td>
                        </tr>
                    <?php 
                        endif;
                    endwhile; 
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>