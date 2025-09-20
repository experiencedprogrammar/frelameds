<?php
header('Content-Type: application/json');
session_start();
require 'vendor/autoload.php';
require 'db_config.php';

$response = ['success' => false, 'error' => ''];

// 1. Validate Email Input
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $response['error'] = 'Invalid request method';
    echo json_encode($response);
    exit();
}

if (empty($_POST['email'])) {
    $response['error'] = 'Email is required';
    echo json_encode($response);
    exit();
}

$email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
if (!$email) {
    $response['error'] = 'Invalid email format';
    echo json_encode($response);
    exit();
}

// 2. Check if email exists in database
try {
    $pdo = new PDO($dsn, $db_user, $db_pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if email exists (without revealing if it doesn't)
    $stmt = $pdo->prepare("SELECT id FROM admin WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if (!$user) {
        // For security, return success message even if email doesn't exist
        $response['success'] = true;
        echo json_encode($response);
        exit();
    }

    // 3. Generate OTP/Token (6-digit code)
    $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
    $expires = date('Y-m-d H:i:s', strtotime('+10 minutes'));

    // Delete any existing tokens for this email
    $stmt = $pdo->prepare("DELETE FROM password_resets WHERE email = ?");
    $stmt->execute([$email]);

    // Store new token
    $stmt = $pdo->prepare("INSERT INTO password_resets (email, token, expires_at) VALUES (?, ?, ?)");
    $stmt->execute([$email, $otp, $expires]);

    // 4. Send Email with PHPMailer
    $mail = new PHPMailer\PHPMailer\PHPMailer(true);
    
    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'jerinsjuma@gmail.com';
        $mail->Password = 'gybk qrcj gftc klsg';
        $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;

        // Recipients
        $mail->setFrom('jerinsjuma@gmail.com', 'Mpesa');
        $mail->addAddress($email);

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Password Reset Code';
        $mail->Body = "
            <h2>Password Reset Request</h2>
            <p>Your verification code is: <strong>$otp</strong></p>
            <p>This code will expire in 10 minutes.</p>
            <p>If you didn't request this, please ignore this email.</p>
        ";

        $mail->send();
        $response['success'] = true;
        echo json_encode($response);
    } catch (Exception $e) {
        error_log("Mailer Error: " . $mail->ErrorInfo);
        $response['error'] = 'Failed to send email. Please try again.';
        echo json_encode($response);
    }
} catch (PDOException $e) {
    error_log("Database Error: " . $e->getMessage());
    $response['error'] = 'System error. Please try again.';
    echo json_encode($response);
}