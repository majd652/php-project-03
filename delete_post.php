<?php
session_start();
require_once "database/database.php";

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'error' => 'Not logged in']);
    exit();
}

$data = json_decode(file_get_contents('php://input'), true);
$post_id = $data['post_id'];
$user_id = $_SESSION['user_id'];

try {
    // Check if the post belongs to the user
    $stmt = $conn->prepare("SELECT id FROM posts WHERE id = ? AND user_id = ?");
    $stmt->execute([$post_id, $user_id]);
    
    if ($stmt->rowCount() === 0) {
        echo json_encode(['success' => false, 'error' => 'Unauthorized']);
        exit();
    }

    // Delete related likes and comments first
    $conn->prepare("DELETE FROM likes WHERE post_id = ?")->execute([$post_id]);
    $conn->prepare("DELETE FROM comments WHERE post_id = ?")->execute([$post_id]);
    
    // Delete the post
    $conn->prepare("DELETE FROM posts WHERE id = ? AND user_id = ?")->execute([$post_id, $user_id]);
    
    echo json_encode(['success' => true]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}