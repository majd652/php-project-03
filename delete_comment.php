<?php
session_start();
require_once "database/database.php";

$data = json_decode(file_get_contents('php://input'), true);
$comment_id = $data['comment_id'];

try {
    
    $stmt = $conn->prepare("SELECT post_id FROM comments WHERE id = ? AND user_id = ?");
    $stmt->execute([$comment_id, $_SESSION['user_id']]);
    $post_id = $stmt->fetch()['post_id'];

    
    $stmt = $conn->prepare("DELETE FROM comments WHERE id = ? AND user_id = ?");
    $stmt->execute([$comment_id, $_SESSION['user_id']]);
    
    echo json_encode(['success' => true, 'post_id' => $post_id]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}