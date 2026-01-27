<?php
session_start();

// Helper function for URLs that work both via router and directly
function url($file) {
    return isset($_GET['day']) ? "?day=13&file=$file" : $file;
}

// Clear all session data
$_SESSION = [];

// Destroy the session
session_destroy();

// Delete the theme cookie
setcookie('theme', '', time() - 3600);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Logged Out</title>
</head>
<body>
    <h1>Session Destroyed!</h1>
    <p>All session data has been cleared.</p>
    <p><a href="<?= url('index.php') ?>">Go back</a></p>
</body>
</html>
