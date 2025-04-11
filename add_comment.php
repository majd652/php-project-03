<?php
session_start();
require_once "database/database.php";

$data = json_decode(file_get_contents('php://input'), true);
$post_id = $data['post_id'];
$content = $data['content'];
$user_id = $_SESSION['user_id'];

try {
    $stmt = $conn->prepare("INSERT INTO comments (post_id, user_id, content) VALUES (?, ?, ?)");
    $stmt->execute([$post_id, $user_id, $content]);
    echo json_encode(['success' => true]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}