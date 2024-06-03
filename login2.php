<?php
session_start(); // Start session to store user data if logged in
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include database connection
    include 'db_connection.php';

    // Function to sanitize input data
    

    // Get form data
    $email = sanitizeInput($_POST['email']);
    $password = sanitizeInput($_POST['password']);

    // Prepare and execute SQL statement to check if user exists
    $stmt = $pdo->prepare("SELECT * FROM details WHERE email = :email AND password = :password");
    $stmt->execute(['email' => $email, 'password' => $password]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // User found, store user data in session and redirect to dashboard or wherever you want
        $_SESSION['user'] = $user;
        header("Location: indexsample.html");
        exit();
    } else {
        // User not found or password incorrect
        $error = "Invalid email or password.";
    }
}
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
			background: rgb(25,223,194);
background: linear-gradient(90deg, rgba(25,223,194,0.700717787114846) 38%, rgba(255,0,241,0.7035189075630253) 100%);
        }

        .container {
            width: 100%;
            max-width: 400px;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.5);
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
        <p>Don't have an account? <a href="signup.php">Sign Up</a></p>
        <?php if (isset($error)) { ?>
            <p><?php echo $error; ?></p>
        <?php } ?>
        
    </div>
</body>
</html>
