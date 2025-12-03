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
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-gray-900 text-white flex flex-col">
            <div class="p-6 border-b border-gray-800">
                <div class="flex items-center space-x-2">
                    <i class="fas fa-flask text-2xl text-primary"></i>
                    <div>
                        <h1 class="text-xl font-bold">Lab MMT</h1>
                        <p class="text-xs text-gray-400">Admin Panel</p>
                    </div>
                </div>
            </div>

            <nav class="flex-1 p-4">
                <a href="<?= BASE_URL ?>/admin" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-gray-800 transition mb-2">
                    <i class="fas fa-dashboard"></i>
                    <span>Dashboard</span>
                </a>
                <a href="<?= BASE_URL ?>/admin/projects" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-gray-800 transition mb-2">
                    <i class="fas fa-project-diagram"></i>
                    <span>Proyek</span>
                </a>
                <a href="<?= BASE_URL ?>/admin/articles" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-gray-800 transition mb-2">
                    <i class="fas fa-newspaper"></i>
                    <span>Artikel</span>
                </a>
                <a href="<?= BASE_URL ?>/admin/gallery" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-gray-800 transition mb-2">
                    <i class="fas fa-images"></i>
                    <span>Galeri</span>
                </a>
                <a href="<?= BASE_URL ?>/admin/partners" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-gray-800 transition mb-2">
                    <i class="fas fa-handshake"></i>
                    <span>Mitra</span>
                </a>
                <a href="<?= BASE_URL ?>/admin/comments" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-gray-800 transition mb-2">
                    <i class="fas fa-comments"></i>
                    <span>Komentar</span>
                </a>
                <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                <a href="<?= BASE_URL ?>/admin/users" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-gray-800 transition mb-2">
                    <i class="fas fa-users"></i>
                    <span>Pengguna</span>
                </a>
                <?php endif; ?>
            </nav>

            <div class="p-4 border-t border-gray-800">
                <div class="flex items-center justify-between mb-3">
                    <div class="flex items-center space-x-2">
                        <i class="fas fa-user-circle text-2xl"></i>
                        <div>
                            <p class="text-sm font-semibold"><?= $_SESSION['user_name'] ?? 'User' ?></p>
                            <p class="text-xs text-gray-400"><?= $_SESSION['role'] ?? 'guest' ?></p>
                        </div>
                    </div>
                </div>
                <a href="<?= BASE_URL ?>" class="block text-center bg-gray-800 py-2 rounded-lg hover:bg-gray-700 transition mb-2">
                    <i class="fas fa-home mr-2"></i>View Site
                </a>
                <a href="<?= BASE_URL ?>/auth/logout" class="block text-center bg-red-600 py-2 rounded-lg hover:bg-red-700 transition">
                    <i class="fas fa-sign-out-alt mr-2"></i>Logout
                </a>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Bar -->
            <header class="bg-white shadow-sm py-4 px-6">
                <div class="flex justify-between items-center">
                    <h2 class="text-2xl font-bold text-gray-800"><?= $page_title ?? 'Dashboard' ?></h2>
                    <div class="text-gray-600">
                        <i class="fas fa-calendar mr-2"></i>
                        <?= date('l, d F Y') ?>
                    </div>
                </div>
            </header>

            <!-- Content Area -->
            <main class="flex-1 overflow-y-auto p-6">
                <?php if (isset($_SESSION['message'])): ?>
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        <i class="fas fa-check-circle mr-2"></i><?= $_SESSION['message'] ?>
                        <?php unset($_SESSION['message']); ?>
                    </div>
                <?php endif; ?>

                <?php if (isset($_SESSION['error'])): ?>
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        <i class="fas fa-exclamation-circle mr-2"></i><?= $_SESSION['error'] ?>
                        <?php unset($_SESSION['error']); ?>
                    </div>
                <?php endif; ?>
