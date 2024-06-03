<?php
// Database connection parameters
$host = "localhost"; // Change this if your database is hosted elsewhere
$username = "root"; // Your MySQL username
$password = ""; // Your MySQL password
$database = "Shopfyx"; // Your database name

// Establishing a connection to the database
$connection = mysqli_connect($id, $username,$email, $password, $create_at);

// Check connection
if ($connection){
	echo "connection successful";
}
else (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Function to validate user credentials
function authenticateUser($username_or_email, $password) {
    global $connection;

    // Sanitize user input to prevent SQL injection
    $username_or_email = mysqli_real_escape_string($connection, $username_or_email);
    $password = mysqli_real_escape_string($connection, $password);

    // Query to fetch user details based on username or email
    $query = "SELECT * FROM user WHERE username = '$username_or_email' OR email = '$username_or_email'";
    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);
        // Verify hashed password
        if (password_verify($password, $user['password'])) {
            return $user; // Return user details if authentication successful
        }
    }
    return null; // Return null if authentication fails
}

// Example usage:
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username_or_email = $_POST["username_or_email"];
    $password = $_POST["password"];

    // Validate user credentials
    $user = authenticateUser($username_or_email, $password);

    if ($user) {
        // Authentication successful, redirect to dashboard or another page
        header("Location: dashboard.php");
        exit();
    } else {
        // Authentication failed, display error message
        $error_message = "Invalid username/email or password.";
    }
}

// Close database connection
mysqli_close($connection);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopfyx Login</title>
    <link rel="stylesheet" href="styles.css">
    <!-- Font Awesome CDN for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            color: #333;
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            width: 100%;
            max-width: 400px;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #007bff;
            margin-bottom: 20px;
        }

        .input-group {
            margin-bottom: 15px;
            text-align: left;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        .btn {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 12px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        p {
            margin-top: 20px;
        }

        .alternative-login {
            margin-top: 10px;
        }

        .alternative-login a {
            display: inline-block;
            margin-right: 10px;
            color: #007bff;
            font-size: 24px;
        }

        a {
            text-decoration: none;
            color: #007bff;
            font-size: 16px;
            transition: color 0.3s ease;
        }

        a:hover {
            color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Login to Shopfyx</h2>
        <form action="#" method="POST">
            <div class="input-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="input-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="btn">Login</button>
            <p>Or login with:</p>
            <div class="alternative-login">
                <a href="#"><i class="fab fa-google"></i></a>
                <a href="#"><i class="fab fa-facebook"></i></a>
            </div>
        </form>
        <p>Don't have an account? <a href="sign.html">Sign Up</a></p>
    </div>
</body>
</html>
