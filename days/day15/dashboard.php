<?php
/**
 * DAY 15 - Capstone Project: Dashboard (Protected Page)
 */

session_start();
require_once 'functions.php';

// Require login - redirects to login.php if not authenticated
requireLogin();

// Handle theme toggle
if (isset($_POST['toggle_theme'])) {
    $newTheme = getTheme() === 'light' ? 'dark' : 'light';
    setTheme($newTheme);
}

$user = getCurrentUser();
$theme = getTheme();
$isLight = $theme === 'light';

// Calculate session duration
$loginTime = strtotime($user['logged_in_at']);
$sessionDuration = time() - $loginTime;
$durationMinutes = floor($sessionDuration / 60);
$durationSeconds = $sessionDuration % 60;

// Get all users for stats
$allUsers = loadUsers();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - UserDash</title>
    <style>
        * { box-sizing: border-box; }
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: <?= $isLight ? '#f5f7fa' : '#1a1a2e' ?>;
            color: <?= $isLight ? '#333' : '#eee' ?>;
            margin: 0;
            padding: 0;
            min-height: 100vh;
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
        }
        .nav-links a:hover {
            background: <?= $isLight ? '#f0f0f0' : '#2a2a4a' ?>;
        }
        .btn-logout {
            background: #f44336;
            color: white;
            padding: 8px 16px;
            border-radius: 4px;
            text-decoration: none;
        }
        .theme-toggle {
            background: none;
            border: none;
            font-size: 1.5em;
            cursor: pointer;
            padding: 5px;
        }
        .container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 30px;
        }
        .welcome {
            text-align: center;
            margin-bottom: 40px;
        }
        .welcome h1 { margin: 0 0 10px; }
        .welcome p { color: <?= $isLight ? '#666' : '#aaa' ?>; }
        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
        }
        .card {
            background: <?= $isLight ? '#fff' : '#16213e' ?>;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .card h2 {
            margin: 0 0 20px;
            color: #667eea;
            font-size: 1.2em;
        }
        .stat {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid <?= $isLight ? '#eee' : '#2a2a4a' ?>;
        }
        .stat:last-child { border-bottom: none; }
        .stat-label { color: <?= $isLight ? '#666' : '#aaa' ?>; }
        .stat-value { font-weight: bold; }
        .session-badge {
            display: inline-block;
            background: #4CAF50;
            color: white;
            padding: 3px 10px;
            border-radius: 12px;
            font-size: 0.8em;
        }
        .user-list {
            margin-top: 15px;
        }
        .user-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            background: <?= $isLight ? '#f9f9f9' : '#1a1a2e' ?>;
            border-radius: 6px;
            margin-bottom: 8px;
        }
        .user-avatar {
            width: 35px;
            height: 35px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
        }
        .quick-actions {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }
        .action-btn {
            padding: 15px;
            text-align: center;
            background: <?= $isLight ? '#f0f0f0' : '#2a2a4a' ?>;
            border-radius: 8px;
            text-decoration: none;
            color: inherit;
            transition: transform 0.2s;
        }
        .action-btn:hover { transform: scale(1.02); }
        .action-icon { font-size: 1.5em; margin-bottom: 5px; }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="logo">🚀 UserDash</div>
        <div class="nav-links">
            <a href="index.php">Home</a>
            <form method="POST" style="display: inline;">
                <button type="submit" name="toggle_theme" class="theme-toggle">
                    <?= $isLight ? '🌙' : '☀️' ?>
                </button>
            </form>
            <a href="logout.php" class="btn-logout">Logout</a>
        </div>
    </nav>

    <div class="container">
        <div class="welcome">
            <h1>Welcome back, <?= e($user['username']) ?>! 👋</h1>
            <p>Here's your dashboard overview</p>
        </div>

        <div class="cards">
            <!-- User Info Card -->
            <div class="card">
                <h2>👤 Your Profile</h2>
                <div class="stat">
                    <span class="stat-label">Username</span>
                    <span class="stat-value"><?= e($user['username']) ?></span>
                </div>
                <div class="stat">
                    <span class="stat-label">Email</span>
                    <span class="stat-value"><?= e($user['email']) ?></span>
                </div>
                <div class="stat">
                    <span class="stat-label">User ID</span>
                    <span class="stat-value">#<?= $user['id'] ?></span>
                </div>
            </div>

            <!-- Session Info Card -->
            <div class="card">
                <h2>🔐 Session Info</h2>
                <div class="stat">
                    <span class="stat-label">Status</span>
                    <span class="session-badge">Active</span>
                </div>
                <div class="stat">
                    <span class="stat-label">Logged in at</span>
                    <span class="stat-value"><?= $user['logged_in_at'] ?></span>
                </div>
                <div class="stat">
                    <span class="stat-label">Duration</span>
                    <span class="stat-value"><?= $durationMinutes ?>m <?= $durationSeconds ?>s</span>
                </div>
                <div class="stat">
                    <span class="stat-label">Theme</span>
                    <span class="stat-value"><?= ucfirst($theme) ?></span>
                </div>
            </div>

            <!-- Stats Card -->
            <div class="card">
                <h2>📊 System Stats</h2>
                <div class="stat">
                    <span class="stat-label">Total Users</span>
                    <span class="stat-value"><?= count($allUsers) ?></span>
                </div>
                <div class="stat">
                    <span class="stat-label">Session ID</span>
                    <span class="stat-value" style="font-size: 0.8em;">
                        <?= substr(session_id(), 0, 12) ?>...
                    </span>
                </div>
            </div>

            <!-- Quick Actions Card -->
            <div class="card">
                <h2>⚡ Quick Actions</h2>
                <div class="quick-actions">
                    <a href="index.php" class="action-btn">
                        <div class="action-icon">🏠</div>
                        Home
                    </a>
                    <form method="POST" style="margin: 0;">
                        <button type="submit" name="toggle_theme" class="action-btn" style="border: none; width: 100%; cursor: pointer;">
                            <div class="action-icon"><?= $isLight ? '🌙' : '☀️' ?></div>
                            Toggle Theme
                        </button>
                    </form>
                    <a href="logout.php" class="action-btn">
                        <div class="action-icon">🚪</div>
                        Logout
                    </a>
                    <a href="register.php" class="action-btn">
                        <div class="action-icon">👥</div>
                        Add User
                    </a>
                </div>
            </div>

            <!-- All Users Card -->
            <div class="card" style="grid-column: span 2;">
                <h2>👥 Registered Users</h2>
                <div class="user-list">
                    <?php foreach ($allUsers as $u): ?>
                        <div class="user-item">
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <div class="user-avatar">
                                    <?= strtoupper(substr($u['username'], 0, 1)) ?>
                                </div>
                                <div>
                                    <strong><?= e($u['username']) ?></strong>
                                    <?php if ($u['username'] === $user['username']): ?>
                                        <span style="color: #667eea;">(You)</span>
                                    <?php endif; ?>
                                    <br>
                                    <small style="color: <?= $isLight ? '#666' : '#aaa' ?>;">
                                        <?= e($u['email']) ?>
                                    </small>
                                </div>
                            </div>
                            <small style="color: <?= $isLight ? '#666' : '#aaa' ?>;">
                                Joined: <?= date('M j, Y', strtotime($u['created_at'])) ?>
                            </small>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
