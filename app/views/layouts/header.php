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
    <!-- Top Bar -->
    <div class="bg-white border-b">
        <div class="container mx-auto px-4 py-2">
            <div class="flex justify-between items-center text-sm">
                <div class="flex items-center space-x-3">
                    <img src="<?= BASE_URL ?>/assets/img/logo-ptn.png" alt="Logo PTN" class="h-10">
                    <div class="border-l pl-3">
                        <div class="font-bold text-gray-800">JURUSAN TEKNOLOGI INFORMASI</div>
                        <div class="text-gray-600 text-xs">POLITEKNIK NEGERI MALANG</div>
                    </div>
                </div>
                <div class="hidden md:flex space-x-4 text-gray-600">
                    <a href="<?= BASE_URL ?>" class="text-gray-700 hover:text-primary transition">Beranda</a>
                    <a href="<?= BASE_URL ?>/project" class="text-gray-700 hover:text-primary transition">Proyek</a>
                    <a href="<?= BASE_URL ?>/article" class="text-gray-700 hover:text-primary transition">Artikel</a>
                    <a href="<?= BASE_URL ?>/gallery" class="text-gray-700 hover:text-primary transition">Galeri</a>
                    <a href="<?= BASE_URL ?>/home/about" class="text-gray-700 hover:text-primary transition">Profil</a>
                    <a href="<?= BASE_URL ?>/home/contact" class="text-gray-700 hover:text-primary transition">Kontak</a>
                </div>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <a href="<?= BASE_URL ?>/auth/logout" class="bg-primary text-white px-4 py-2 rounded hover:bg-blue-700 transition text-sm">
                        Logout
                    </a>
                <?php else: ?>
                    <a href="<?= BASE_URL ?>/auth/login" class="bg-primary text-white px-4 py-2 rounded hover:bg-blue-700 transition text-sm">
                        Login
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    