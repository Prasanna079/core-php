<?php
/**
 * DAY 15 - Capstone Project: Landing Page
 */

session_start();
require_once 'functions.php';

// Handle theme toggle
if (isset($_POST['toggle_theme'])) {
    $newTheme = getTheme() === 'light' ? 'dark' : 'light';
    setTheme($newTheme);
}

$theme = getTheme();
$isLight = $theme === 'light';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Day 15: User Dashboard Project</title>
    <style>
        * { box-sizing: border-box; }
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            margin: 0;
            padding: 0;
            background: <?= $isLight ? '#f5f7fa' : '#1a1a2e' ?>;
            color: <?= $isLight ? '#333' : '#eee' ?>;
            min-height: 100vh;
            transition: all 0.3s ease;
        }
        .navbar {
            background: <?= $isLight ? '#fff' : '#16213e' ?>;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .logo {
            font-size: 1.5em;
            font-weight: bold;
            color: #667eea;
        }
        .nav-links { display: flex; gap: 15px; align-items: center; }
        .nav-links a {
            color: <?= $isLight ? '#555' : '#ccc' ?>;
            text-decoration: none;
            padding: 8px 16px;
            border-radius: 4px;
            transition: background 0.2s;
        }
        .nav-links a:hover {
            background: <?= $isLight ? '#f0f0f0' : '#2a2a4a' ?>;
        }
        .btn {
            padding: 10px 20px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: bold;
            display: inline-block;
        }
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        .btn-outline {
            border: 2px solid #667eea;
            color: #667eea;
        }
        .theme-toggle {
            background: none;
            border: none;
            font-size: 1.5em;
            cursor: pointer;
            padding: 5px;
        }
        .hero {
            text-align: center;
            padding: 80px 20px;
        }
        .hero h1 {
            font-size: 2.5em;
            margin-bottom: 20px;
        }
        .hero p {
            font-size: 1.2em;
            color: <?= $isLight ? '#666' : '#aaa' ?>;
            margin-bottom: 30px;
        }
        .hero-buttons { display: flex; gap: 15px; justify-content: center; }
        .features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            padding: 40px;
            max-width: 1000px;
            margin: 0 auto;
        }
        .feature {
            background: <?= $isLight ? '#fff' : '#16213e' ?>;
            padding: 30px;
            border-radius: 12px;
            text-align: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .feature-icon { font-size: 3em; margin-bottom: 15px; }
        .feature h3 { margin: 0 0 10px; }
        .feature p { color: <?= $isLight ? '#666' : '#aaa' ?>; margin: 0; }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="logo">🚀 UserDash</div>
        <div class="nav-links">
            <?php if (isLoggedIn()): ?>
                <a href="dashboard.php">Dashboard</a>
                <a href="logout.php">Logout</a>
            <?php else: ?>
                <a href="login.php">Login</a>
                <a href="register.php" class="btn btn-primary">Sign Up</a>
            <?php endif; ?>

            <form method="POST" style="display: inline;">
                <button type="submit" name="toggle_theme" class="theme-toggle">
                    <?= $isLight ? '🌙' : '☀️' ?>
                </button>
            </form>
        </div>
    </nav>

    <section class="hero">
        <h1>Welcome to the Capstone Project!</h1>
        <p>A complete user management system built with PHP</p>

        <?php if (isLoggedIn()): ?>
            <p>You're logged in as <strong><?= e(getCurrentUser()['username']) ?></strong></p>
            <a href="dashboard.php" class="btn btn-primary">Go to Dashboard</a>
        <?php else: ?>
            <div class="hero-buttons">
                <a href="register.php" class="btn btn-primary">Get Started</a>
                <a href="login.php" class="btn btn-outline">Login</a>
            </div>
        <?php endif; ?>
    </section>

    <section class="features">
        <div class="feature">
            <div class="feature-icon">📁</div>
            <h3>File Storage</h3>
            <p>JSON-based user data storage using file handling</p>
        </div>
        <div class="feature">
            <div class="feature-icon">🔐</div>
            <h3>Secure Auth</h3>
            <p>Password hashing with bcrypt for security</p>
        </div>
        <div class="feature">
            <div class="feature-icon">🍪</div>
            <h3>Preferences</h3>
            <p>Theme settings saved with cookies</p>
        </div>
        <div class="feature">
            <div class="feature-icon">🔄</div>
            <h3>Sessions</h3>
            <p>Persistent login state with PHP sessions</p>
        </div>
    </section>
</body>
</html>
