<?php
// Database connection parameters
$host = 'localhost';
$dbname = 'shopfyx';
$username = 'root'; // Replace with your database username
$password = ''; // Replace with your database password

// Connect to the database
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Set PDO to throw exceptions on error
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error: Could not connect to the database. " . $e->getMessage());
}

// Function to sanitize input data
function sanitizeInput($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// Login functionality
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login2'])) {
    $email = sanitizeInput($_POST['email']);
    $password = sanitizeInput($_POST['password']);

    // Prepare and execute SQL statement to check if user exists
    $stmt = $pdo->prepare("SELECT * FROM details WHERE email = :email AND password = :password");
    $stmt->execute(['email' => $email, 'password' => $password]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // User found, redirect to dashboard or wherever you want
        header("Location: dashboard.php");
        exit();
    } else {
        // User not found or password incorrect
        echo "Invalid email or password.";
    }
}

// Signup functionality
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['signup'])) {
    $email = sanitizeInput($_POST['email']);
    $password = sanitizeInput($_POST['password']);
    $firstName = sanitizeInput($_POST['first-name']);
    $lastName = sanitizeInput($_POST['last-name']);

    // Prepare and execute SQL statement to insert new user
    $stmt = $pdo->prepare("INSERT INTO details (username, email, password, create_at) VALUES (:username, :email, :password, NOW())");
    $stmt->execute(['username' => $firstName . ' ' . $lastName, 'email' => $email, 'password' => $password]);

    // Redirect to login page or wherever you want after signup
    header("Location: login2.php");
    exit();
}
?>
