<?php
/**
 * DAY 15 - Capstone Project: Logout
 *
 * This file handles the logout process:
 * 1. Clears all session data
 * 2. Destroys the session cookie
 * 3. Destroys the session
 * 4. Redirects to home page
 */

session_start();
require_once 'functions.php';

// Use our helper function to handle logout properly
logoutUser();

// Redirect to home page
redirect('index.php');
?>
