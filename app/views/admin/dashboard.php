<?php $page_title = 'Dashboard'; require_once '../app/views/layouts/admin_header.php'; ?>

<!-- Welcome Section -->
<div class="bg-gradient-to-r from-primary to-secondary rounded-lg shadow-lg p-6 mb-6 text-white">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold mb-2">Selamat Datang, <?= $_SESSION['user_name'] ?? 'Admin' ?>! 👋</h1>
            <p class="opacity-90">Kelola konten Lab MMT dengan mudah melalui dashboard ini</p>
        </div>
        <div class="hidden md:block">
            <i class="fas fa-chart-line text-6xl opacity-20"></i>
        </div>
    </div>
</div>

<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-primary transform transition hover:scale-105">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm mb-1 font-medium">Total Proyek</p>
                <h3 class="text-3xl font-bold text-gray-800"><?= $total_projects ?></h3>
                <p class="text-xs text-gray-400 mt-1">Proyek aktif</p>
            </div>
            <div class="bg-gradient-to-br from-blue-400 to-primary rounded-full p-4 shadow-lg">
                <i class="fas fa-project-diagram text-white text-2xl"></i>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-green-500 transform transition hover:scale-105">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm mb-1 font-medium">Total Artikel</p>
                <h3 class="text-3xl font-bold text-gray-800"><?= $total_articles ?></h3>
                <p class="text-xs text-gray-400 mt-1">Artikel dipublikasi</p>
            </div>
            <div class="bg-gradient-to-br from-green-400 to-green-600 rounded-full p-4 shadow-lg">
                <i class="fas fa-newspaper text-white text-2xl"></i>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-purple-500 transform transition hover:scale-105">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm mb-1 font-medium">Item Galeri</p>
                <h3 class="text-3xl font-bold text-gray-800"><?= $total_galleries ?></h3>
                <p class="text-xs text-gray-400 mt-1">Foto kegiatan</p>
            </div>
            <div class="bg-gradient-to-br from-purple-400 to-purple-600 rounded-full p-4 shadow-lg">
                <i class="fas fa-images text-white text-2xl"></i>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-orange-500 transform transition hover:scale-105">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm mb-1 font-medium">Mitra</p>
                <h3 class="text-3xl font-bold text-gray-800"><?= $total_partners ?></h3>
                <p class="text-xs text-gray-400 mt-1">Kerjasama aktif</p>
            </div>
            <div class="bg-gradient-to-br from-orange-400 to-orange-600 rounded-full p-4 shadow-lg">
                <i class="fas fa-handshake text-white text-2xl"></i>
            </div>
        </div>
    </div>
</div>

<!-- Recent Content -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Recent Projects -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="bg-gradient-to-r from-primary to-secondary p-6">
            <div class="flex items-center justify-between">
                <h3 class="text-xl font-bold text-white flex items-center">
                    <i class="fas fa-project-diagram mr-2"></i>
                    Proyek Terbaru
                </h3>
                <a href="<?= BASE_URL ?>/admin/projects/create" class="bg-white text-primary px-4 py-2 rounded-lg hover:bg-gray-100 transition text-sm font-medium">
                    <i class="fas fa-plus mr-1"></i>Tambah
                </a>
            </div>
        </div>
        <div class="p-6">
            <?php if (!empty($recent_projects)): ?>
                <div class="space-y-3">
                    <?php foreach ($recent_projects as $project): ?>
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                            <div class="flex items-center space-x-3">
                                <div class="bg-primary text-white rounded-lg p-2">
                                    <i class="fas fa-folder"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-800"><?= $project['title'] ?></h4>
                                    <p class="text-xs text-gray-500"><i class="fas fa-tag mr-1"></i><?= $project['category'] ?></p>
                                </div>
                            </div>
                            <a href="<?= BASE_URL ?>/admin/projects/edit/<?= $project['id'] ?>" class="text-primary hover:text-blue-700 bg-blue-50 p-2 rounded-lg">
                                <i class="fas fa-edit"></i>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
                <a href="<?= BASE_URL ?>/admin/projects" class="block text-center mt-4 text-primary hover:text-blue-700 font-medium">
                    Lihat Semua Proyek <i class="fas fa-arrow-right ml-1"></i>
                </a>
            <?php else: ?>
                <div class="text-center py-8">
                    <i class="fas fa-folder-open text-gray-300 text-4xl mb-3"></i>
                    <p class="text-gray-500">Belum ada proyek</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Recent Articles -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="bg-gradient-to-r from-primary to-secondary p-6">
            <div class="flex items-center justify-between">
                <h3 class="text-xl font-bold text-white flex items-center">
                    <i class="fas fa-newspaper mr-2"></i>
                    Artikel Terbaru
                </h3>
                <a href="<?= BASE_URL ?>/admin/articles/create" class="bg-white text-primary px-4 py-2 rounded-lg hover:bg-gray-100 transition text-sm font-medium">
                    <i class="fas fa-plus mr-1"></i>Tambah
                </a>
            </div>
        </div>
        <div class="p-6">
            <?php if (!empty($recent_articles)): ?>
                <div class="space-y-3">
                    <?php foreach ($recent_articles as $article): ?>
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                            <div class="flex items-center space-x-3">
                                <div class="bg-primary text-white rounded-lg p-2">
                                    <i class="fas fa-file-alt"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-800"><?= $article['title'] ?></h4>
                                    <p class="text-xs text-gray-500"><i class="fas fa-user mr-1"></i>Oleh <?= $article['author_name'] ?></p>
                                </div>
                            </div>
                            <a href="<?= BASE_URL ?>/admin/articles/edit/<?= $article['id'] ?>" class="text-primary hover:text-blue-700 bg-blue-50 p-2 rounded-lg">
                                <i class="fas fa-edit"></i>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
                <a href="<?= BASE_URL ?>/admin/articles" class="block text-center mt-4 text-primary hover:text-blue-700 font-medium">
                    Lihat Semua Artikel <i class="fas fa-arrow-right ml-1"></i>
                </a>
            <?php else: ?>
                <div class="text-center py-8">
                    <i class="fas fa-newspaper text-gray-300 text-4xl mb-3"></i>
                    <p class="text-gray-500">Belum ada artikel</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php require_once '../app/views/layouts/admin_footer.php'; ?>
