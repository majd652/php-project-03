<?php
session_start();
require_once "database/database.php";

$data = json_decode(file_get_contents('php://input'), true);
$postId = $data['postId'];
$userId = $_SESSION['user_id'];

try {
 
    $stmt = $conn->prepare("SELECT id FROM likes WHERE post_id = ? AND user_id = ?");
    $stmt->execute([$postId, $userId]);
    
    if ($stmt->rowCount() > 0) {
        /
        $conn->prepare("DELETE FROM likes WHERE post_id = ? AND user_id = ?")->execute([$postId, $userId]);
    } else {
       
        $conn->prepare("INSERT INTO likes (post_id, user_id) VALUES (?, ?)")->execute([$postId, $userId]);
    }
    
    
    $stmt = $conn->prepare("SELECT COUNT(*) as count FROM likes WHERE post_id = ?");
    $stmt->execute([$postId]);
    $count = $stmt->fetch()['count'];
    
    echo json_encode(['success' => true, 'likeCount' => $count]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}