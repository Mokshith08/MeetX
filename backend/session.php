<?php
// session.php
session_start();

function require_login() {
    if (!isset($_SESSION['user_id'])) {
        header("HTTP/1.1 401 Unauthorized");
        echo json_encode(['error' => 'Not logged in']);
        exit;
    }
}
