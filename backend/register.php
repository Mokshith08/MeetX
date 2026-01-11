<?php
header("Content-Type: application/json");
require "config.php";

$data = json_decode(file_get_contents("php://input"), true);

$name = trim($data['name'] ?? '');
$email = trim($data['email'] ?? '');
$password = trim($data['password'] ?? '');
$phone = trim($data['phone'] ?? '');
$org = trim($data['org'] ?? '');

if (!$name || !$email || !$password) {
    http_response_code(400);
    echo json_encode(['error' => 'Missing required fields']);
    exit;
}

// validate email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['error' => 'Invalid email']);
    exit;
}

// check if email already exists
$stmt = $pdo->prepare("SELECT id FROM users WHERE email=?");
$stmt->execute([$email]);
if ($stmt->fetch()) {
    http_response_code(409);
    echo json_encode(['error' => 'Email already registered']);
    exit;
}

// create user
$passHash = password_hash($password, PASSWORD_DEFAULT);
$stmt = $pdo->prepare("INSERT INTO users (name,email,password_hash,phone,org) VALUES (?,?,?,?,?)");
$stmt->execute([$name, $email, $passHash, $phone, $org]);

session_start();
$_SESSION['user_id'] = $pdo->lastInsertId();
$_SESSION['user_name'] = $name;
$_SESSION['user_email'] = $email;

echo json_encode(['success' => true]);
