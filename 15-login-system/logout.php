<?php
session_start();

// Helper function for URLs that work both via router and directly
function url($file) {
    return isset($_GET['day']) ? "?day=15&file=$file" : $file;
}

// Clear all session data
$_SESSION = [];

// Destroy the session
session_destroy();

// Redirect to index
header('Location: ' . url('index.php'));
exit;
