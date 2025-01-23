<?php
require_once 'config.php';  // Database connection
require 'vendor/autoload.php';  // Composer autoload (PHPMailer)

// Use PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Step 1: Get the email from the POST request
    $email = $_POST['resetEmail'];

    // Step 2: Generate a secure token
    $token = bin2hex(random_bytes(50));  // Generates a secure random token

    // Step 3: Check if the email exists in the database
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($userId);
    $stmt->fetch();
    $stmt->close();

    if ($userId) {
        // Step 4: Store the token and its expiration time in the database
        $expiration = date('Y-m-d H:i:s', strtotime('+1 hour')); // Token expires in 1 hour
        $stmt = $conn->prepare("INSERT INTO password_resets (user_id, token, expires_at) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $userId, $token, $expiration);
        $stmt->execute();
        $stmt->close();

        // Step 5: Create the reset link
        $resetLink = "http://yourdomain.com/reset_password.php?token=$token";

        // Step 6: Send the password reset email using PHPMailer
        $mail = new PHPMailer(true);  // Instantiate PHPMailer

        try {
            // Server settings for Gmail
            $mail->isSMTP();  // Use SMTP
            $mail->Host = 'smtp.gmail.com';  // Gmail SMTP server
            $mail->SMTPAuth = true;  // Enable SMTP authentication
            $mail->Username = 'your-email@gmail.com';  // Your Gmail email address
            $mail->Password = 'your-email-password';  // Your Gmail email password or App Password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;  // Use TLS encryption
            $mail->Port = 587;  // SMTP port for TLS

            // Recipients
            $mail->setFrom('your-email@gmail.com', 'No Reply');  // Sender's email
            $mail->addAddress($email);  // Recipient's email

            // Content
            $mail->isHTML(false);  // Set email format to plain text
            $mail->Subject = 'Password Reset Request';
            $mail->Body = "Click the link below to reset your password:\n\n$resetLink";

            // Send email
            $mail->send();
            echo 'Password reset email has been sent!';
        } catch (Exception $e) {
            echo "Error sending email: {$mail->ErrorInfo}";
        }
    } else {
        echo "Email not found in the database.";
    }

    // Close DB connection
    $conn->close();
}
?>
