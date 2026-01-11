<?php
header("Content-Type: application/json");
require "config.php";

$stmt = $pdo->query("SELECT room_name, capacity, rate_per_hour FROM rooms ORDER BY room_name");
echo json_encode($stmt->fetchAll());
