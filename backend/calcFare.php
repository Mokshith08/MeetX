<?php
header("Content-Type: application/json");
require "config.php";

$start = $_POST['start'] ?? '';
$end   = $_POST['end'] ?? '';
$room  = $_POST['room'] ?? '';

if (!$start || !$end || !$room) {
    echo json_encode(['error' => 'Missing data']);
    exit;
}

$stmt = $pdo->prepare("SELECT rate_per_hour FROM rooms WHERE room_name=?");
$stmt->execute([$room]);
$r = $stmt->fetch();

if (!$r) {
    echo json_encode(['error' => 'Room not found']);
    exit;
}

$rate = (float)$r['rate_per_hour'];

$start_dt = new DateTime($start);
$end_dt   = new DateTime($end);

/* HANDLE OVERNIGHT BOOKING */
if ($end_dt <= $start_dt) {
    $end_dt->modify('+1 day');
}

/* TOTAL HOURS CALCULATION */
$seconds = $end_dt->getTimestamp() - $start_dt->getTimestamp();
$hours   = round($seconds / 3600, 2);

if ($hours <= 0) {
    $hours = 1;
}

$fare = round($hours * $rate, 2);

echo json_encode([
    'fare'  => $fare,
    'rate'  => $rate,
    'hours' => $hours
]);
