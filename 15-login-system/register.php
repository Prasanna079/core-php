<?php
session_start();

// Helper function for URLs that work both via router and directly
function url($file) {
    return isset($_GET['day']) ? "?day=15&file=$file" : $file;
}

$error = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm = $_POST['confirm'] ?? '';

    // Validation
    if (empty($username) || empty($password)) {
        $error = 'Username and password are required!';
    } elseif ($password !== $confirm) {
        $error = 'Passwords do not match!';
    } elseif (strlen($password) < 6) {
        $error = 'Password must be at least 6 characters!';
    } else {
        // Read existing users
        $usersFile = __DIR__ . '/users.json';
        $users = file_exists($usersFile) ? json_decode(file_get_contents($usersFile), true) : [];

        // Check if username already exists
        if (isset($users[$username])) {
            $error = 'Username already exists!';
        } else {
            // Hash the password and save
            $users[$username] = password_hash($password, PASSWORD_DEFAULT);
            file_put_contents($usersFile, json_encode($users, JSON_PRETTY_PRINT));

            // Redirect to login page after successful registration
            header('Location: ' . url('login.php'));
            exit;
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <style>
        body {
            font-family: Arial;
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
        }
        input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            box-sizing: border-box;
        }
        button {
            width: 100%;
            padding: 12px;
            background: #28a745;
            color: white;
            border: none;
            cursor: pointer;
        }
        .error {
            background: #f8d7da;
            color: #721c24;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <h1>Register</h1>

    <?php if ($error): ?>
        <div class="error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password (min 6 chars)" required>
            <input type="password" name="confirm" placeholder="Confirm Password" required>
            <button type="submit">Register</button>
        </form>

    <p>Already have an account? <a href="<?= url('login.php') ?>">Login</a></p>
    <p><a href="<?= url('index.php') ?>">Back to Home</a></p>
</body>
</html>
