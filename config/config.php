<?php

// Database Configuration
define('DB_HOST', 'localhost');
define('DB_NAME', 'lab_multimedia');
define('DB_USER', 'postgres');
define('DB_PASS', '87654321');
define('DB_PORT', '5432');

// App Configuration
define('BASE_URL', 'http://localhost/PBL_LabMMT/public');
define('APP_NAME', 'Portal Showcase Lab MMT');

// Session Configuration
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
