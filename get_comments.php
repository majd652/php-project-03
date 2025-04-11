<?php
session_start();
require_once "database/database.php";

$post_id = $_GET['post_id'];

try {
    $stmt = $conn->prepare("SELECT c.*, a.username 
                           FROM comments c 
                           JOIN account a ON c.user_id = a.id 
                           WHERE c.post_id = ? 
                           ORDER BY c.created_at DESC");
    $stmt->execute([$post_id]);
    echo json_encode($stmt->fetchAll());
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}