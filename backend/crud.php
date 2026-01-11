<?php
header("Content-Type: application/json");
require "config.php";
session_start();

if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(['error' => 'Not logged in']);
    exit;
}

$action = $_GET['action'] ?? $_POST['action'] ?? '';


// GET BOOKING DETAILS

if ($action === 'get') {
    $id = $_GET['id'] ?? 0;

    $stmt = $pdo->prepare("SELECT * FROM bookings WHERE id=? AND user_id=?");
    $stmt->execute([$id, $_SESSION['user_id']]);
    $booking = $stmt->fetch();

    echo json_encode($booking);
    exit;
}


// UPDATE BOOKING
if ($action === 'update') {
    $id      = $_POST['id'] ?? 0;
    $date    = $_POST['date'] ?? '';
    $start   = $_POST['start'] ?? '';
    $end     = $_POST['end'] ?? '';
    $room    = $_POST['room'] ?? '';
    $purpose = $_POST['purpose'] ?? '';

    // Get room rate
    $stmt = $pdo->prepare("SELECT rate_per_hour FROM rooms WHERE room_name=?");
    $stmt->execute([$room]);
    $roomRow = $stmt->fetch();

    if (!$roomRow) {
        echo json_encode(['error' => 'Room not found']);
        exit;
    }

    $rate = $roomRow['rate_per_hour'];

    // Calculate duration
    $start_dt = new DateTime($start);
    $end_dt   = new DateTime($end);
    $interval = $start_dt->diff($end_dt);

    $hours = $interval->h + ($interval->i / 60);
    if ($hours <= 0) $hours = 1;

    $fare = round($hours * $rate, 2);

    // Update booking
    $stmt = $pdo->prepare("
        UPDATE bookings
        SET booking_date=?, start_time=?, end_time=?, room=?, purpose=?, fare=?
        WHERE id=? AND user_id=?
    ");

    $ok = $stmt->execute([
        $date, $start, $end, $room, $purpose, $fare,
        $id, $_SESSION['user_id']
    ]);

    echo json_encode(['success' => $ok, 'fare' => $fare]);
    exit;
}

// DELETE BOOKING

if ($action === 'delete') {
    $id = $_GET['id'] ?? 0;

    $stmt = $pdo->prepare("DELETE FROM bookings WHERE id=? AND user_id=?");
    $ok = $stmt->execute([$id, $_SESSION['user_id']]);

    echo json_encode(['success' => $ok]);
    exit;
}

// INVALID ACTION

echo json_encode(['error' => 'Invalid action']);
?>
