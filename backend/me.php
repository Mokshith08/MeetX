<?php
header("Content-Type: application/json");
require "config.php";
session_start();

if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(['error' => 'Not logged in']);
    exit;
}

$stmt = $pdo->prepare("SELECT id,name,email,phone,org FROM users WHERE id=?");
$stmt->execute([$_SESSION['user_id']]);
echo json_encode($stmt->fetch());
