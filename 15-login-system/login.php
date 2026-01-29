<?php
session_start();

// Helper function for URLs that work both via router and directly
function url($file) {
    return isset($_GET['day']) ? "?day=15&file=$file" : $file;
}

// Read users from JSON file
$json = file_get_contents(__DIR__ . '/users.json');
$users = json_decode($json, true);

$error = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Check credentials using password_verify for hashed passwords
    if (isset($users[$username]) && password_verify($password, $users[$username])) {
        $_SESSION['user'] = $username;
        header('Location: ' . url('index.php'));
        exit;
    } else {
        $error = 'Invalid username or password!';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
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
            background: #007bff;
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
    <h1>Login</h1>

    <?php if ($error): ?>
        <div class="error"><?= $error ?></div>
    <?php endif; ?>

    <form method="POST">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>

    <p>Don't have an account? <a href="<?= url('register.php') ?>">Register</a></p>
    <p><a href="<?= url('index.php') ?>">Back to Home</a></p>

    <hr>
    <p><small>Test users: admin/admin123, kiran/kiran123, student/student123</small></p>
</body>
</html>
