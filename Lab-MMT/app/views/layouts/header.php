<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? APP_NAME ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#1D4ED8',
                        secondary: '#3B82F6',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg sticky top-0 z-50">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center space-x-2">
                    <i class="fas fa-flask text-primary text-2xl"></i>
                    <span class="text-xl font-bold text-gray-800">Lab MMT</span>
                </div>
                
                <div class="hidden md:flex space-x-6">
                    <a href="<?= BASE_URL ?>" class="text-gray-700 hover:text-primary transition">Home</a>
                    <a href="<?= BASE_URL ?>/project" class="text-gray-700 hover:text-primary transition">Projects</a>
                    <a href="<?= BASE_URL ?>/article" class="text-gray-700 hover:text-primary transition">Articles</a>
                    <a href="<?= BASE_URL ?>/gallery" class="text-gray-700 hover:text-primary transition">Gallery</a>
                    <a href="<?= BASE_URL ?>/home/about" class="text-gray-700 hover:text-primary transition">About</a>
                    <a href="<?= BASE_URL ?>/home/contact" class="text-gray-700 hover:text-primary transition">Contact</a>
                </div>

                <div class="flex items-center space-x-4">
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <a href="<?= BASE_URL ?>/admin" class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                            <i class="fas fa-dashboard mr-2"></i>Dashboard
                        </a>
                        <a href="<?= BASE_URL ?>/auth/logout" class="text-gray-700 hover:text-primary transition">
                            <i class="fas fa-sign-out-alt"></i>
                        </a>
                    <?php else: ?>
                        <a href="<?= BASE_URL ?>/auth/login" class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                            <i class="fas fa-sign-in-alt mr-2"></i>Login
                        </a>
                    <?php endif; ?>
                </div>

                <!-- Mobile menu button -->
                <button id="mobile-menu-btn" class="md:hidden text-gray-700">
                    <i class="fas fa-bars text-2xl"></i>
                </button>
            </div>

            <!-- Mobile menu -->
            <div id="mobile-menu" class="hidden md:hidden pb-4">
                <a href="<?= BASE_URL ?>" class="block py-2 text-gray-700 hover:text-primary">Home</a>
                <a href="<?= BASE_URL ?>/project" class="block py-2 text-gray-700 hover:text-primary">Projects</a>
                <a href="<?= BASE_URL ?>/article" class="block py-2 text-gray-700 hover:text-primary">Articles</a>
                <a href="<?= BASE_URL ?>/gallery" class="block py-2 text-gray-700 hover:text-primary">Gallery</a>
                <a href="<?= BASE_URL ?>/home/about" class="block py-2 text-gray-700 hover:text-primary">About</a>
                <a href="<?= BASE_URL ?>/home/contact" class="block py-2 text-gray-700 hover:text-primary">Contact</a>
            </div>
        </div>
    </nav>
