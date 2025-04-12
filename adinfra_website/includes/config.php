<?php
// Error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Session configuration (must be set before session_start)
ini_set('session.cookie_httponly', 1);
ini_set('session.use_only_cookies', 1);
ini_set('session.cookie_secure', 0); // Set to 1 in production with HTTPS

// Start session
session_start();

// Database configuration - Using SQLite
define('DB_FILE', __DIR__ . '/../database/adinfra.db');

// Establish database connection
try {
    $conn = new PDO("sqlite:" . DB_FILE);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Enable foreign key support
    $conn->exec('PRAGMA foreign_keys = ON;');
} catch(PDOException $e) {
    // Log error and show user-friendly message
    error_log("Database Connection Error: " . $e->getMessage());
    die("We're experiencing technical difficulties. Please try again later.");
}

// Site configuration
define('SITE_NAME', 'AD Infra');
define('SITE_URL', 'http://localhost:8000');
define('ADMIN_EMAIL', 'admin@adinfra.com');

// Color scheme
$colors = [
    'primary' => '#1a5f7a',    // Deep blue
    'secondary' => '#2d88aa',  // Light blue
    'accent' => '#ff6b6b',     // Coral accent
    'dark' => '#2c3e50',       // Dark blue-gray
    'light' => '#ecf0f1',      // Light gray
];

// Time zone
date_default_timezone_set('UTC');

// Security functions
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function generate_csrf_token() {
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function verify_csrf_token($token) {
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}

// Utility functions
function redirect($url) {
    header("Location: $url");
    exit;
}

function is_admin_logged_in() {
    return isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;
}

function format_date($date) {
    return date('M d, Y', strtotime($date));
}

// Error handling
function handle_error($errno, $errstr, $errfile, $errline) {
    $error_message = "Error [$errno]: $errstr in $errfile on line $errline";
    error_log($error_message);
    
    if (ini_get('display_errors')) {
        echo "An error occurred. Please try again later.";
    }
    
    return true;
}
set_error_handler('handle_error');
