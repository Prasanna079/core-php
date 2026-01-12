<?php
/**
 * DAY 15 - Capstone Project: Registration Page
 */

session_start();
require_once 'functions.php';

// Redirect if already logged in
if (isLoggedIn()) {
    redirect('dashboard.php');
}

$errors = [];
$success = false;
$username = '';
$email = '';

// Process registration
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirm_password'] ?? '';

    // Validate all fields
    $errors = array_merge(
        validateUsername($username),
        validateEmail($email),
        validatePassword($password)
    );

    // Check password confirmation
    if ($password !== $confirmPassword) {
        $errors[] = "Passwords do not match";
    }

    // Check for existing users
    if (empty($errors)) {
        if (findUserByUsername($username)) {
            $errors[] = "Username already taken";
        }
        if (findUserByEmail($email)) {
            $errors[] = "Email already registered";
        }
    }

    // Create user if no errors
    if (empty($errors)) {
        createUser($username, $email, $password);
        $success = true;
        $username = $email = '';
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
    <title>Register - UserDash</title>
    <style>
        * { box-sizing: border-box; }
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: <?= $isLight ? '#f5f7fa' : '#1a1a2e' ?>;
            color: <?= $isLight ? '#333' : '#eee' ?>;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
            padding: 20px;
        }
        .card {
            background: <?= $isLight ? '#fff' : '#16213e' ?>;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 400px;
        }
        h1 {
            text-align: center;
            margin: 0 0 30px;
            color: #667eea;
        }
        .form-group { margin-bottom: 20px; }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
        }
        input {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            border: 2px solid <?= $isLight ? '#ddd' : '#3a3a5a' ?>;
            border-radius: 6px;
            background: <?= $isLight ? '#fff' : '#1a1a2e' ?>;
            color: <?= $isLight ? '#333' : '#eee' ?>;
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
        .errors {
            background: #ffe6e6;
            color: #d63031;
            padding: 15px;
            border-radius: 6px;
            margin-bottom: 20px;
        }
        .errors ul { margin: 0; padding-left: 20px; }
        .success {
            background: #d4edda;
            color: #155724;
            padding: 15px;
            border-radius: 6px;
            margin-bottom: 20px;
            text-align: center;
        }
        .links {
            text-align: center;
            margin-top: 20px;
        }
        .links a { color: #667eea; }
        .requirements {
            background: <?= $isLight ? '#fff3cd' : '#3d3a20' ?>;
            color: <?= $isLight ? '#856404' : '#ffc107' ?>;
            padding: 15px;
            border-radius: 6px;
            margin-bottom: 20px;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="card">
        <h1>Create Account</h1>

        <?php if ($success): ?>
            <div class="success">
                Account created successfully!<br>
                <a href="login.php">Click here to log in</a>
            </div>
        <?php endif; ?>

        <?php if (!empty($errors)): ?>
            <div class="errors">
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?= e($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <div class="requirements">
            <strong>Password requirements:</strong>
            8+ chars, uppercase, lowercase, number
        </div>

        <form method="POST">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username"
                       value="<?= e($username) ?>" required autofocus>
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email"
                       value="<?= e($email) ?>" required>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>

            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" required>
            </div>

            <button type="submit">Create Account</button>
        </form>

        <div class="links">
            <a href="login.php">Already have an account? Log in</a><br><br>
            <a href="index.php">← Back to Home</a>
        </div>
    </div>
</body>
</html>
