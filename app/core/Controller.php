<?php

class Controller
{
    protected $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    // Load view
    public function view($view, $data = [])
    {
        // Check if view file exists
        $viewFile = '../app/views/' . $view . '.php';
        
        if (file_exists($viewFile)) {
            // Extract data array to variables
            extract($data);
            require_once $viewFile;
        } else {
            die("View not found: " . $view);
        }
    }

    // Load model
    public function model($model)
    {
        require_once '../app/models/' . $model . '.php';
        return new $model();
    }

    // Redirect helper
    public function redirect($url)
    {
        header('Location: ' . BASE_URL . '/' . $url);
        exit();
    }

    // Check if user is logged in
    public function isLoggedIn()
    {
        return isset($_SESSION['user_id']);
    }

    // Check if user is admin
    public function isAdmin()
    {
        return isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
    }

    // Require login
    public function requireLogin()
    {
        if (!$this->isLoggedIn()) {
            $this->redirect('auth/login');
        }
    }

    // Require admin
    public function requireAdmin()
    {
        if (!$this->isAdmin()) {
            $this->redirect('home');
        }
    }

    // Upload file helper
    public function uploadFile($file, $targetDir = 'uploads/')
    {
        $uploadDir = '../public/assets/img/' . $targetDir;
        
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $fileName = time() . '_' . basename($file['name']);
        $targetFile = $uploadDir . $fileName;
        $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Check file type first to determine max size
        $videoTypes = ['mp4', 'avi', 'mov', 'wmv', 'flv', 'mkv', 'webm'];
        $imageTypes = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg'];
        $allowedTypes = array_merge($imageTypes, $videoTypes);
        
        if (!in_array($fileType, $allowedTypes)) {
            return ['success' => false, 'message' => 'Format file tidak diizinkan. Format yang didukung: ' . implode(', ', $allowedTypes)];
        }

        // Different size limits for images and videos
        if (in_array($fileType, $videoTypes)) {
            // Video max 50MB
            if ($file['size'] > 50000000) {
                return ['success' => false, 'message' => 'File video terlalu besar. Maksimal 50MB.'];
            }
        } else {
            // Image max 5MB
            if ($file['size'] > 5000000) {
                return ['success' => false, 'message' => 'File gambar terlalu besar. Maksimal 5MB.'];
            }
        }

        if (move_uploaded_file($file['tmp_name'], $targetFile)) {
            return ['success' => true, 'filename' => $targetDir . $fileName];
        } else {
            return ['success' => false, 'message' => 'Gagal upload file. Pastikan folder memiliki permission yang benar.'];
        }
    }
}
