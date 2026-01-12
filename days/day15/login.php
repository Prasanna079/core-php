<?php
/**
 * DAY 15 - Capstone Project: Login Page
 */

session_start();
require_once 'functions.php';

// Redirect if already logged in
if (isLoggedIn()) {
    redirect('dashboard.php');
}

$error = '';

// Process login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    // Find user
    $user = findUserByUsername($username);

    if ($user && password_verify($password, $user['password'])) {
        // Success - log them in
        loginUser($user);
        redirect('dashboard.php');
    } else {
        // Fail - vague error message for security
        $error = "Invalid username or password";
    }
}

$theme = getTheme();
$isLight = $theme === 'light';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - UserDash</title>
    <style>
        * { box-sizing: border-box; }
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
            padding: 20px;
        }
        .card {
            background: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
            width: 100%;
            max-width: 380px;
        }
        h1 {
            text-align: center;
            margin: 0 0 30px;
            color: #333;
        }
        .form-group { margin-bottom: 20px; }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #555;
        }
        input {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            border: 2px solid #ddd;
            border-radius: 6px;
        }
        input:focus {
            border-color: #667eea;
            outline: none;
        }
        button {
            width: 100%;
            padding: 14px;
            font-size: 16px;
            font-weight: bold;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }
        button:hover { opacity: 0.9; }
        .error {
            background: #ffe6e6;
            color: #d63031;
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 20px;
            text-align: center;
        }
        .links {
            text-align: center;
            margin-top: 20px;
        }
        .links a { color: #667eea; }
    </style>
</head>
<body>
    <div class="card">
        <h1>🔐 Log In</h1>

        <?php if ($error): ?>
            <div class="error"><?= e($error) ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username"
                       value="<?= e($_POST['username'] ?? '') ?>"
                       required autofocus>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>

            <button type="submit">Log In</button>
        </form>

        <div class="links">
            <a href="register.php">Don't have an account? Sign up</a><br><br>
            <a href="index.php">← Back to Home</a>
        </div>
    </div>
</body>
</html>
