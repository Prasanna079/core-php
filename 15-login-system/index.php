<?php
session_start();

// Helper function for URLs that work both via router and directly
function url($file) {
    return isset($_GET['day']) ? "?day=15&file=$file" : $file;
}

// Check if user is logged in
$isLoggedIn = isset($_SESSION['user']);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Day 15: Simple Login System</title>
    <style>
        body {
            font-family: Arial;
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
        }
        .welcome {
            background: #d4edda;
            padding: 20px;
            border-radius: 8px;
        }
        .guest {
            background: #fff3cd;
            padding: 20px;
            border-radius: 8px;
        }
        .btn {
            padding: 10px 20px;
            background: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .btn-danger {
            background: #dc3545;
        }
    </style>
</head>
<body>
    <h1>Simple Login System</h1>

    <?php if ($isLoggedIn): ?>
        <div class="welcome">
            <h2>Welcome, <?= $_SESSION['user'] ?>!</h2>
            <p>You are now logged in.</p>
            <a href="<?= url('logout.php') ?>" class="btn btn-danger">Logout</a>
        </div>
    <?php else: ?>
        <div class="guest">
            <p>You are not logged in.</p>
            <a href="<?= url('login.php') ?>" class="btn">Login</a>
            <a href="<?= url('register.php') ?>" class="btn" style="background: #28a745; margin-left: 10px;">Register</a>
        </div>
    <?php endif; ?>
</body>
</html>
