<?php

// Database Configuration
define('DB_HOST', getenv('DB_HOST') ?: 'localhost');
define('DB_NAME', getenv('DB_NAME') ?: 'lab_multimedia');
define('DB_USER', getenv('DB_USER') ?: 'postgres');
define('DB_PASS', getenv('DB_PASS') !== false ? getenv('DB_PASS') : 'your_password_here');
define('DB_PORT', getenv('DB_PORT') ?: '5432');

// App Configuration
define('BASE_URL', getenv('BASE_URL') ?: 'http://localhost/PBL_LabMMT/public');
define('APP_NAME', getenv('APP_NAME') ?: 'Portal Showcase Lab MMT');
define('APP_ENV', getenv('APP_ENV') ?: 'development'); // 'development' atau 'production'

// Session Configuration
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
