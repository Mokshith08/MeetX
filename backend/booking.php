<?php
header("Content-Type: application/json");
require "config.php";
session_start();

if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(['error' => 'Not logged in']);
    exit;
}

$user_id = $_SESSION['user_id'];

$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$phone = $_POST['phone'] ?? '';
$org = $_POST['org'] ?? '';
$date = $_POST['date'] ?? '';
$start = $_POST['start'] ?? '';
$end = $_POST['end'] ?? '';
$purpose = $_POST['purpose'] ?? '';
$room = $_POST['room'] ?? '';

$stmt = $pdo->prepare("SELECT rate_per_hour FROM rooms WHERE room_name=?");
$stmt->execute([$room]);
$r = $stmt->fetch();

if (!$r) {
    echo json_encode(['error' => 'Room not found']);
    exit;
}

$rate = $r['rate_per_hour'];

$start_dt = new DateTime($start);
$end_dt = new DateTime($end);
$interval = $start_dt->diff($end_dt);
$hours = $interval->h + ($interval->i / 60);

if ($hours <= 0) $hours = 1;

$fare = round($hours * $rate, 2);

$stmt = $pdo->prepare("
    INSERT INTO bookings (user_id, booking_date, start_time, end_time, room, purpose, fare)
    VALUES (?, ?, ?, ?, ?, ?, ?)
");

$stmt->execute([$user_id, $date, $start, $end, $room, $purpose, $fare]);

echo json_encode([
    'success' => true,
    'booking_id' => $pdo->lastInsertId(),
    'fare' => $fare
]);
