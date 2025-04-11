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
    
    $stmt = $conn->prepare("SELECT id FROM likes WHERE post_id = ? AND user_id = ?");
    $stmt->execute([$post_id, $user_id]);
    
    if ($stmt->rowCount() > 0) {
       
        $conn->prepare("DELETE FROM likes WHERE post_id = ? AND user_id = ?")->execute([$post_id, $user_id]);
        $hasLiked = false;
    } else {
        
        $conn->prepare("INSERT INTO likes (post_id, user_id) VALUES (?, ?)")->execute([$post_id, $user_id]);
        $hasLiked = true;
    }
    
    $stmt = $conn->prepare("SELECT COUNT(*) as count FROM likes WHERE post_id = ?");
    $stmt->execute([$post_id]);
    $likes = $stmt->fetch(PDO::FETCH_ASSOC)['count'];
    
    echo json_encode([
        'success' => true, 
        'likes' => $likes, 
        'hasLiked' => $hasLiked,
        'postId' => $post_id
    ]);
} catch (PDOException $e) {
    error_log("Like error: " . $e->getMessage());
    echo json_encode(['success' => false, 'error' => 'Database error']);
}