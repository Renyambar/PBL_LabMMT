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
                        primary: '#0F3A75',
                        secondary: '#1e5a9e',
                    }
                }
            }
        }
    </script>
    <style>
        .sidebar-link.active {
            background-color: #0F3A75;
            color: white;
        }
        .sidebar-link:hover {
            background-color: #f3f4f6;
        }
        .sidebar-link.active:hover {
            background-color: #0d3263;
        }
    </style>
</head>
<body class="bg-gray-50">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-white border-r border-gray-200 flex flex-col">
            <div class="p-6 border-b border-gray-200 bg-[#0F3A75]">
                <div class="flex items-center space-x-3">
                    <img src="<?= BASE_URL ?>/assets/img/favicon.ico" alt="Logo Lab MMT" class="h-10 w-10 object-contain">
                    <div class="text-white">
                        <h1 class="text-base font-semibold">Lab MMT</h1>
                        <p class="text-xs opacity-80">Panel Admin</p>
                    </div>
                </div>
            </div>

            <nav class="flex-1 p-4 overflow-y-auto">
                <a href="<?= BASE_URL ?>/admin" class="sidebar-link flex items-center space-x-3 px-4 py-2.5 rounded-md transition mb-1 text-gray-700">
                    <i class="fas fa-th-large w-5"></i>
                    <span class="text-sm">Dashboard</span>
                </a>
                <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                <a href="<?= BASE_URL ?>/admin/lab_profile" class="sidebar-link flex items-center space-x-3 px-4 py-2.5 rounded-md transition mb-1 text-gray-700">
                    <i class="fas fa-building w-5"></i>
                    <span class="text-sm">Profil Lab</span>
                </a>
                <?php endif; ?>
                <a href="<?= BASE_URL ?>/admin/projects" class="sidebar-link flex items-center space-x-3 px-4 py-2.5 rounded-md transition mb-1 text-gray-700">
                    <i class="fas fa-folder w-5"></i>
                    <span class="text-sm">Proyek</span>
                </a>
                <a href="<?= BASE_URL ?>/admin/articles" class="sidebar-link flex items-center space-x-3 px-4 py-2.5 rounded-md transition mb-1 text-gray-700">
                    <i class="fas fa-newspaper w-5"></i>
                    <span class="text-sm">Artikel</span>
                </a>
                <a href="<?= BASE_URL ?>/admin/publications" class="sidebar-link flex items-center space-x-3 px-4 py-2.5 rounded-md transition mb-1 text-gray-700">
                    <i class="fas fa-book w-5"></i>
                    <span class="text-sm">Publikasi</span>
                </a>
                <a href="<?= BASE_URL ?>/admin/gallery" class="sidebar-link flex items-center space-x-3 px-4 py-2.5 rounded-md transition mb-1 text-gray-700">
                    <i class="fas fa-image w-5"></i>
                    <span class="text-sm">Galeri</span>
                </a>
                <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                <a href="<?= BASE_URL ?>/admin/partners" class="sidebar-link flex items-center space-x-3 px-4 py-2.5 rounded-md transition mb-1 text-gray-700">
                    <i class="fas fa-handshake w-5"></i>
                    <span class="text-sm">Mitra</span>
                </a>
                <?php endif; ?>
                <a href="<?= BASE_URL ?>/admin/comments" class="sidebar-link flex items-center space-x-3 px-4 py-2.5 rounded-md transition mb-1 text-gray-700">
                    <i class="fas fa-comment w-5"></i>
                    <span class="text-sm">Komentar</span>
                </a>
                <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                <a href="<?= BASE_URL ?>/admin/users" class="sidebar-link flex items-center space-x-3 px-4 py-2.5 rounded-md transition mb-1 text-gray-700">
                    <i class="fas fa-users w-5"></i>
                    <span class="text-sm">Pengguna</span>
                </a>
                <?php endif; ?>
            </nav>

            <div class="p-4 border-t border-gray-200">
                <div class="flex items-center space-x-3 mb-3 p-2">
                    <div class="bg-[#0F3A75] text-white rounded-full w-9 h-9 flex items-center justify-center">
                        <i class="fas fa-user text-sm"></i>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-medium text-gray-800"><?= $_SESSION['user_name'] ?? 'User' ?></p>
                        <p class="text-xs text-gray-500 capitalize"><?= $_SESSION['role'] ?? 'guest' ?></p>
                    </div>
                </div>
                <a href="<?= BASE_URL ?>" class="block text-center bg-white border border-gray-300 text-gray-700 py-2 rounded-md hover:bg-gray-50 transition mb-2 text-sm">
                    <i class="fas fa-home mr-2 text-xs"></i>Website
                </a>
                <a href="<?= BASE_URL ?>/auth/logout" class="block text-center bg-red-600 text-white py-2 rounded-md hover:bg-red-700 transition text-sm">
                    <i class="fas fa-sign-out-alt mr-2 text-xs"></i>Logout
                </a>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Bar -->
            <header class="bg-white shadow-sm border-b border-gray-200 py-4 px-6">
                <div class="flex justify-between items-center">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800"><?= $page_title ?? 'Dashboard' ?></h2>
                        <p class="text-sm text-gray-500 mt-1">Laboratorium Multimedia dan Mobile Technology</p>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="text-gray-600 text-sm">
                            <i class="fas fa-calendar mr-2 text-primary"></i>
                            <?php
                                $days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
                                $months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                                $day = $days[date('w')];
                                $date = date('d');
                                $month = $months[date('n') - 1];
                                $year = date('Y');
                                echo "$day, $date $month $year";
                            ?>
                        </div>
                        <div class="text-gray-600 text-sm">
                            <i class="fas fa-clock mr-2 text-primary"></i>
                            <span id="current-time"></span>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Content Area -->
            <main class="flex-1 overflow-y-auto p-6 bg-gray-50">
                <?php if (isset($_SESSION['message'])): ?>
                    <div class="bg-green-50 border-l-4 border-green-500 text-green-800 px-4 py-3 rounded-lg mb-4 shadow-sm">
                        <div class="flex items-center">
                            <i class="fas fa-check-circle mr-3 text-xl"></i>
                            <span><?= $_SESSION['message'] ?></span>
                        </div>
                        <?php unset($_SESSION['message']); ?>
                    </div>
                <?php endif; ?>

                <?php if (isset($_SESSION['error'])): ?>
                    <div class="bg-red-50 border-l-4 border-red-500 text-red-800 px-4 py-3 rounded-lg mb-4 shadow-sm">
                        <div class="flex items-center">
                            <i class="fas fa-exclamation-circle mr-3 text-xl"></i>
                            <span><?= $_SESSION['error'] ?></span>
                        </div>
                        <?php unset($_SESSION['error']); ?>
                    </div>
                <?php endif; ?>
                
                <script>
                    // Update current time
                    function updateTime() {
                        const now = new Date();
                        const hours = String(now.getHours()).padStart(2, '0');
                        const minutes = String(now.getMinutes()).padStart(2, '0');
                        const seconds = String(now.getSeconds()).padStart(2, '0');
                        document.getElementById('current-time').textContent = `${hours}:${minutes}:${seconds}`;
                    }
                    updateTime();
                    setInterval(updateTime, 1000);
                </script>
