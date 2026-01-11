<?php
header("Content-Type: application/json");
require "config.php";
session_start();

if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode([]);
    exit;
}

$stmt = $pdo->prepare("
    SELECT id, booking_date, start_time, end_time, room, purpose, fare, created_at
    FROM bookings
    WHERE user_id = ?
    ORDER BY created_at DESC
");
$stmt->execute([$_SESSION['user_id']]);

echo json_encode($stmt->fetchAll());
