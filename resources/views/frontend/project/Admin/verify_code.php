<?php
header('Content-Type: application/json');
session_start();
require 'vendor/autoload.php';
require 'db_config.php';

$response = ['success' => false, 'error' => ''];

// 1. Validate Input
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $response['error'] = 'Invalid request method';
    echo json_encode($response);
    exit();
}

// Get raw POST data
$data = json_decode(file_get_contents('php://input'), true);

if (empty($data['verificationCode'])) {
    $response['error'] = 'Verification code is required';
    echo json_encode($response);
    exit();
}

$verificationCode = trim($data['verificationCode']);

// 2. Check if verification code exists in database
try {
    $pdo = new PDO($dsn, $db_user, $db_pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if code exists and is not expired
    $stmt = $pdo->prepare("SELECT email FROM password_resets WHERE token = ? AND expires_at > NOW()");
    $stmt->execute([$verificationCode]);
    $resetRequest = $stmt->fetch();

    if (!$resetRequest) {
        $response['error'] = 'Invalid or expired verification code';
        echo json_encode($response);
        exit();
    }

    // Store email in session for password reset
    $_SESSION['reset_email'] = $resetRequest['email'];
    
    $response['success'] = true;
    echo json_encode($response);
} catch (PDOException $e) {
    error_log("Database Error: " . $e->getMessage());
    $response['error'] = 'System error. Please try again.';
    echo json_encode($response);
}