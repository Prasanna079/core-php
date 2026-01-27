<?php
// IMPORTANT: session_start() must be called BEFORE any output!
session_start();

// Helper function for URLs that work both via router and directly
function url($file) {
    return isset($_GET['day']) ? "?day=13&file=$file" : $file;
}

// ========== SESSIONS ==========

// Store data in session
$_SESSION['username'] = 'Kiran';
$_SESSION['cart'] = ['Apple', 'Banana', 'Mango'];

// Read session data
$username = $_SESSION['username'];
$cart = $_SESSION['cart'];

// ========== COOKIES ==========

// Handle theme change BEFORE any output
if (isset($_POST['theme'])) {
    $theme = $_POST['theme'];
    // Set cookie for 30 days
    setcookie('theme', $theme, time() + (30 * 24 * 60 * 60), '/');
    // Also update for current request
    $_COOKIE['theme'] = $theme;
}

// Read cookie (use ?? for default if not set)
$theme = $_COOKIE['theme'] ?? 'light';

// Theme definitions
$themes = [
    'light' => ['bg' => '#ffffff', 'text' => '#333333', 'card' => '#f5f5f5'],
    'dark' => ['bg' => '#1a1a2e', 'text' => '#eaeaea', 'card' => '#16213e'],
    'blue' => ['bg' => '#e3f2fd', 'text' => '#0d47a1', 'card' => '#bbdefb'],
];

$activeTheme = $themes[$theme] ?? $themes['light'];



?>
<!DOCTYPE html>
<html>
<head>
    <title>Day 13: Sessions & Cookies</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: <?= $activeTheme['bg'] ?>;
            color: <?= $activeTheme['text'] ?>;
            padding: 40px;
            transition: all 0.3s ease;
        }
        h1, h2, h3 { color: <?= $activeTheme['text'] ?>; }
        .card {
            background: <?= $activeTheme['card'] ?>;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            border: 1px solid rgba(128,128,128,0.1);
        }
        a { color: #4CAF50; }
        .theme-btn {
            padding: 8px 16px;
            margin-right: 5px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
        }
        .theme-btn:hover { opacity: 0.9; }
        .theme-btn.active { outline: 2px solid #4CAF50; }
    </style>
</head>
<body>
    <h1>Sessions & Cookies in PHP</h1>

    <h2>Session Data (stored on server)</h2>
    <div class="card">
        <p>Username: <strong><?= $username ?></strong></p>
        <p>Cart: <?= implode(', ', $cart) ?></p>
    </div>

    <h2>Cookie Data (stored in browser)</h2>
    <div class="card">
        <p>Theme: <strong><?= $theme ?></strong></p>
        
        <div style="margin-top: 15px;">
            <p style="margin-bottom: 10px;">Select Theme:</p>
            <?php foreach (['light', 'dark', 'blue'] as $t): ?>
                <form method="POST" style="display: inline;">
                    <input type="hidden" name="theme" value="<?= $t ?>">
                    <button type="submit" 
                            class="theme-btn"
                            style="background: <?= $themes[$t]['bg'] ?>; color: <?= $themes[$t]['text'] ?>; border: 1px solid #ccc;">
                        <?= ucfirst($t) ?>
                    </button>
                </form>
            <?php endforeach; ?>
        </div>
    </div>

    <hr>
    <h3>Session ID</h3>
    <div class="card">
        <p><code><?= session_id() ?></code></p>
    </div>

    <hr>
    <p><a href="<?= url('logout.php') ?>">Logout (destroy session)</a></p>
</body>
</html>
