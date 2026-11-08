<?php

// Load configuration (prioritaskan config.php lokal, fallback ke config.example.php untuk hosting/Vercel)
if (file_exists(__DIR__ . '/../config/config.php')) {
    require_once __DIR__ . '/../config/config.php';
} else {
    require_once __DIR__ . '/../config/config.example.php';
}

// Load core classes
require_once '../app/core/Database.php';
require_once '../app/core/Controller.php';
require_once '../app/core/App.php';

// Initialize app
$app = new App();
