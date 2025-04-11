<?php
function isAdmin($conn, $user_id) {
    $stmt = $conn->prepare("SELECT is_admin FROM account WHERE id = ?");
    $stmt->execute([$user_id]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result && $result['is_admin'] == 1;
}