<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? APP_NAME ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center">
    <!-- Header Bar -->
    <div class="fixed top-0 left-0 right-0 bg-gradient-to-r from-[#0F3A75] to-[#2563eb] text-white py-4 px-6 shadow-lg z-10">
        <div class="flex items-center">
            <img src="<?= BASE_URL ?>/assets/img/logo-ptn.png" alt="Logo" class="h-12 mr-3">
            <h1 class="text-xl font-bold">Welcome to Lab Multimedia & Mobile Tech</h1>
        </div>
    </div>

    <div class="container mx-auto px-4 mt-20">
        <div class="max-w-md mx-auto bg-white rounded-2xl shadow-2xl overflow-hidden">
            <!-- Mascot & Title -->
            <div class="text-center pt-8 pb-6">
                <div class="flex justify-center mb-4">
                    <img src="<?= BASE_URL ?>/assets/img/favicon.ico" alt="Lab MMT Mascot" class="w-32 h-auto">
                </div>
                <h2 class="text-3xl font-bold text-[#0F3A75]">Portal Admin</h2>
            </div>

            <div class="px-8 pb-8">
                <?php if (isset($_SESSION['error'])): ?>
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        <?= $_SESSION['error'] ?>
                        <?php unset($_SESSION['error']); ?>
                    </div>
                <?php endif; ?>

                <?php if (isset($_SESSION['message'])): ?>
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        <?= $_SESSION['message'] ?>
                        <?php unset($_SESSION['message']); ?>
                    </div>
                <?php endif; ?>

                <form action="<?= BASE_URL ?>/auth/authenticate" method="POST">
                    <div class="mb-5">
                        <label class="block text-gray-700 font-semibold mb-2 text-sm" for="email">
                            <i class="fas fa-envelope mr-2 text-gray-600"></i>Email
                        </label>
                        <input type="email" id="email" name="email" required
                               class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition"
                               placeholder="reny@mail.com">
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 font-semibold mb-2 text-sm" for="password">
                            <i class="fas fa-lock mr-2 text-gray-600"></i>Password
                        </label>
                        <input type="password" id="password" name="password" required
                               class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition"
                               placeholder="reny15">
                    </div>

                    <button type="submit" 
                            class="w-full bg-[#2563eb] text-white py-3 rounded-full font-semibold hover:bg-[#1d4ed8] transition shadow-lg">
                        LOGIN
                    </button>
                </form>

                <div class="text-center mt-6">
                    <a href="<?= BASE_URL ?>" class="text-gray-700 hover:text-[#0F3A75] inline-flex items-center transition">
                        <i class="fas fa-arrow-left mr-2"></i>Kembali ke Home
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
