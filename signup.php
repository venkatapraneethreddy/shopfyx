<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include database connection
    include 'db_connection.php';

    // Function to sanitize input data
    
    // Get form data
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopfyx - Sign Up</title>
    <link rel="stylesheet" href="styles.css">
    <!-- Font Awesome CDN for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
			background: rgb(25,223,194);
background: linear-gradient(90deg, rgba(25,223,194,0.700717787114846) 38%, rgba(255,0,241,0.7035189075630253) 100%);
        }

        .container {
            background-color: rgba(255, 255, 255, 0.5);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
        }

        .input-group {
            margin-bottom: 20px;
            text-align: left;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="email"],
        input[type="password"],
        input[type="text"] {
            width: calc(100% - 10px);
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
            font-size: 16px;
        }

        button.btn {
            background-color: #4CAF50;
            color: white;
            padding: 15px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        button.btn:hover {
            background-color: #45a049;
        }

        .alternative-login a {
            display: inline-block;
            margin-right: 10px;
            margin-bottom: 10px;
            padding: 10px 20px;
            background-color: #3b5998;
            color: #fff;
            border-radius: 5px;
            text-decoration: none;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .alternative-login a:hover {
            background-color: #2d4373;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Sign up to Shopfyx</h2>
        <form action="#" method="POST">
            <div class="input-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="input-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="input-group">
                <label for="first-name">First Name:</label>
                <input type="text" id="first-name" name="first-name" required>
				
            </div>
            <div class="input-group">
                <label for="last-name">Last Name:</label>
                <input type="text" id="last-name" name="last-name" required>
            </div>
            <button type="submit" class="btn">Sign up</button>
        </form>
        <p>Or sign up with:</p>
        <div class="alternative-login">
            <a href="#"><i class="fab fa-google"></i> Sign up with Google</a>
            <a href="#"><i class="fab fa-facebook"></i> Sign up with Facebook</a>
        </div>
		
    </div>
</body>
</html>
