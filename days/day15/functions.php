<?php
/**
 * DAY 15 - Capstone Project: Shared Functions
 *
 * This file contains all helper functions used across the application.
 * Including this file in each page gives access to common functionality.
 */

// ============================================
// CONFIGURATION
// ============================================

define('DATA_DIR', __DIR__ . '/data/');
define('USERS_FILE', DATA_DIR . 'users.json');

// Create data directory if needed
if (!is_dir(DATA_DIR)) {
    mkdir(DATA_DIR, 0755, true);
}

// ============================================
// USER DATA FUNCTIONS
// ============================================

/**
 * Load all users from JSON file
 * @return array Array of user records
 */
function loadUsers(): array {
    if (!file_exists(USERS_FILE)) {
        return [];
    }
    $content = file_get_contents(USERS_FILE);
    return json_decode($content, true) ?? [];
}

/**
 * Save users to JSON file
 * @param array $users Array of user records
 * @return bool Success status
 */
function saveUsers(array $users): bool {
    $json = json_encode($users, JSON_PRETTY_PRINT);
    return file_put_contents(USERS_FILE, $json) !== false;
}

/**
 * Find a user by username (case-insensitive)
 * @param string $username Username to find
 * @return array|null User record or null if not found
 */
function findUserByUsername(string $username): ?array {
    $users = loadUsers();
    foreach ($users as $user) {
        if (strtolower($user['username']) === strtolower($username)) {
            return $user;
        }
    }
    return null;
}

/**
 * Find a user by email (case-insensitive)
 * @param string $email Email to find
 * @return array|null User record or null if not found
 */
function findUserByEmail(string $email): ?array {
    $users = loadUsers();
    foreach ($users as $user) {
        if (strtolower($user['email']) === strtolower($email)) {
            return $user;
        }
    }
    return null;
}

/**
 * Create a new user
 * @param string $username
 * @param string $email
 * @param string $password Plain text password (will be hashed)
 * @return array The created user record
 */
function createUser(string $username, string $email, string $password): array {
    $users = loadUsers();

    $newUser = [
        'id' => count($users) + 1,
        'username' => $username,
        'email' => $email,
        'password' => password_hash($password, PASSWORD_DEFAULT),
        'created_at' => date('Y-m-d H:i:s'),
        'last_login' => null,
    ];

    $users[] = $newUser;
    saveUsers($users);

    return $newUser;
}

/**
 * Update user's last login time
 * @param int $userId User ID
 */
function updateLastLogin(int $userId): void {
    $users = loadUsers();
    foreach ($users as &$user) {
        if ($user['id'] === $userId) {
            $user['last_login'] = date('Y-m-d H:i:s');
            break;
        }
    }
    saveUsers($users);
}

// ============================================
// AUTHENTICATION FUNCTIONS
// ============================================

/**
 * Check if user is currently logged in
 * @return bool
 */
function isLoggedIn(): bool {
    return isset($_SESSION['user']);
}

/**
 * Get current logged in user data
 * @return array|null User data or null if not logged in
 */
function getCurrentUser(): ?array {
    return $_SESSION['user'] ?? null;
}

/**
 * Require user to be logged in, redirect to login if not
 * @param string $redirect URL to redirect to after login
 */
function requireLogin(string $redirect = 'login.php'): void {
    if (!isLoggedIn()) {
        header("Location: $redirect");
        exit;
    }
}

/**
 * Log in a user (set session data)
 * @param array $user User record from database
 */
function loginUser(array $user): void {
    // Security: regenerate session ID
    session_regenerate_id(true);

    $_SESSION['user'] = [
        'id' => $user['id'],
        'username' => $user['username'],
        'email' => $user['email'],
        'logged_in_at' => date('Y-m-d H:i:s'),
    ];

    updateLastLogin($user['id']);
}

/**
 * Log out current user
 */
function logoutUser(): void {
    $_SESSION = [];

    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000, $params["path"]);
    }

    session_destroy();
}

// ============================================
// VALIDATION FUNCTIONS
// ============================================

/**
 * Validate username
 * @param string $username
 * @return array Array of error messages (empty if valid)
 */
function validateUsername(string $username): array {
    $errors = [];

    if (strlen($username) < 3) {
        $errors[] = "Username must be at least 3 characters";
    }
    if (strlen($username) > 20) {
        $errors[] = "Username must be less than 20 characters";
    }
    if (!preg_match('/^[a-zA-Z0-9_]+$/', $username)) {
        $errors[] = "Username can only contain letters, numbers, and underscores";
    }

    return $errors;
}

/**
 * Validate email
 * @param string $email
 * @return array Array of error messages (empty if valid)
 */
function validateEmail(string $email): array {
    $errors = [];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Please enter a valid email address";
    }

    return $errors;
}

/**
 * Validate password strength
 * @param string $password
 * @return array Array of error messages (empty if valid)
 */
function validatePassword(string $password): array {
    $errors = [];

    if (strlen($password) < 8) {
        $errors[] = "Password must be at least 8 characters";
    }
    if (!preg_match('/[A-Z]/', $password)) {
        $errors[] = "Password must contain at least one uppercase letter";
    }
    if (!preg_match('/[a-z]/', $password)) {
        $errors[] = "Password must contain at least one lowercase letter";
    }
    if (!preg_match('/[0-9]/', $password)) {
        $errors[] = "Password must contain at least one number";
    }

    return $errors;
}

// ============================================
// THEME FUNCTIONS (Cookies)
// ============================================

/**
 * Get current theme from cookie
 * @return string Theme name ('light' or 'dark')
 */
function getTheme(): string {
    return $_COOKIE['theme'] ?? 'light';
}

/**
 * Set theme cookie
 * @param string $theme Theme name
 */
function setTheme(string $theme): void {
    $validThemes = ['light', 'dark'];
    if (in_array($theme, $validThemes)) {
        setcookie('theme', $theme, time() + (30 * 24 * 60 * 60), '/');
        $_COOKIE['theme'] = $theme;
    }
}

// ============================================
// UTILITY FUNCTIONS
// ============================================

/**
 * Safely output HTML-escaped string
 * @param string $string
 * @return string
 */
function e(string $string): string {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

/**
 * Redirect to another page
 * @param string $url
 */
function redirect(string $url): void {
    header("Location: $url");
    exit;
}
?>
