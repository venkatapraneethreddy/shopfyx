<?php
// Include database connection
include 'db_connection.php';

// Function to sanitize input data
function sanitizeInput($data) {
    // Sanitize the input data to prevent SQL injection or other attacks
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $email = sanitizeInput($_POST['email']);
    $password = sanitizeInput($_POST['password']);
    $firstName = sanitizeInput($_POST['first-name']);
    $lastName = sanitizeInput($_POST['last-name']);

    // Send verification email
    $verificationCode = generateVerificationCode(); // Generate a verification code
    sendVerificationEmail($email, $verificationCode); // Send verification email

    // Store verification code in session or database for later validation

    // Proceed with storing user data in the database
    // This part would typically be done after email verification
}

// Function to generate a verification code
function generateVerificationCode() {
    return uniqid(); // Generate a unique ID as the verification code
}

// Function to send verification email
function sendVerificationEmail($email, $verificationCode) {
    $subject = "Verify Your Email Address";
    $message = "Please click the following link to verify your email address: <a href='https://example.com/verify.php?code=$verificationCode'>Verify Email</a>";
    $headers = "From: your@example.com\r\n";
    $headers .= "Content-type: text/html\r\n";

    // Send email
    mail($email, $subject, $message, $headers);
    // Note: This is a simple example using the PHP mail function.
    // For production use, consider using a dedicated email service provider (ESP) or SMTP server.
}
?>
