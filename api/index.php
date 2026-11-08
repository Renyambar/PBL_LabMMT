<?php

// Pastikan direktori kerja relatif terhadap folder public agar include '../app/...' berfungsi
chdir(__DIR__ . '/../public');

// Ambil path request jika $_GET['url'] belum di-set oleh rewriter
if (!isset($_GET['url']) && isset($_SERVER['REQUEST_URI'])) {
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $uri = trim($uri, '/');
    if (!empty($uri)) {
        $_GET['url'] = $uri;
    }
}

// Teruskan ke public/index.php
require __DIR__ . '/../public/index.php';

