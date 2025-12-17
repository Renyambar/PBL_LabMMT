<?php $page_title = 'Dashboard'; require_once '../app/views/layouts/admin_header.php'; ?>

<!-- Welcome Section -->
<div class="bg-white border-l-4 border-[#0F3A75] rounded-lg shadow p-6 mb-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-semibold text-gray-800 mb-1">Selamat Datang, <?= $_SESSION['user_name'] ?? 'Admin' ?></h1>
            <p class="text-gray-600">Kelola konten Laboratorium Multimedia dan Mobile Technology</p>
        </div>
        <div class="hidden md:block">
            <i class="fas fa-tachometer-alt text-5xl text-gray-200"></i>
        </div>
    </div>
</div>

<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
    <div class="bg-white rounded-lg shadow p-5 border-l-4 border-[#0F3A75]">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-xs mb-1">Total Proyek</p>
                <h3 class="text-2xl font-semibold text-gray-800"><?= $total_projects ?></h3>
            </div>
            <div class="bg-[#0F3A75] rounded-lg p-3">
                <i class="fas fa-folder text-white text-xl"></i>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-5 border-l-4 border-green-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-xs mb-1">Total Artikel</p>
                <h3 class="text-2xl font-semibold text-gray-800"><?= $total_articles ?></h3>
            </div>
            <div class="bg-green-500 rounded-lg p-3">
                <i class="fas fa-newspaper text-white text-xl"></i>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-5 border-l-4 border-purple-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-xs mb-1">Item Galeri</p>
                <h3 class="text-2xl font-semibold text-gray-800"><?= $total_galleries ?></h3>
            </div>
            <div class="bg-purple-500 rounded-lg p-3">
                <i class="fas fa-image text-white text-xl"></i>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-5 border-l-4 border-orange-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-xs mb-1">Mitra</p>
                <h3 class="text-2xl font-semibold text-gray-800"><?= $total_partners ?></h3>
            </div>
            <div class="bg-orange-500 rounded-lg p-3">
                <i class="fas fa-handshake text-white text-xl"></i>
            </div>
        </div>
    </div>
</div>

<!-- Recent Content -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Recent Projects -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="bg-[#0F3A75] p-5">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold text-white flex items-center">
                    <i class="fas fa-folder mr-2"></i>
                    Proyek Terbaru
                </h3>
                <a href="<?= BASE_URL ?>/admin/projects/create" class="bg-white text-[#0F3A75] px-3 py-1.5 rounded hover:bg-gray-100 transition text-sm">
                    <i class="fas fa-plus mr-1"></i>Tambah
                </a>
            </div>
        </div>
        <div class="p-5">
            <?php if (!empty($recent_projects)): ?>
                <div class="space-y-2">
                    <?php foreach ($recent_projects as $project): ?>
                        <div class="flex items-center justify-between p-3 border-b border-gray-100 hover:bg-gray-50">
                            <div class="flex items-center space-x-3">
                                <div class="bg-[#0F3A75] text-white rounded p-2">
                                    <i class="fas fa-folder text-sm"></i>
                                </div>
                                <div>
                                    <h4 class="text-sm font-medium text-gray-800"><?= $project['title'] ?></h4>
                                    <p class="text-xs text-gray-500"><?= $project['category'] ?></p>
                                </div>
                            </div>
                            <a href="<?= BASE_URL ?>/admin/projects/edit/<?= $project['id'] ?>" class="text-[#0F3A75] hover:text-blue-900">
                                <i class="fas fa-edit"></i>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
                <a href="<?= BASE_URL ?>/admin/projects" class="block text-center mt-4 text-[#0F3A75] hover:underline text-sm">
                    Lihat Semua <i class="fas fa-arrow-right ml-1 text-xs"></i>
                </a>
            <?php else: ?>
                <div class="text-center py-8">
                    <i class="fas fa-folder-open text-gray-300 text-3xl mb-2"></i>
                    <p class="text-gray-500 text-sm">Belum ada proyek</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Recent Articles -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="bg-[#0F3A75] p-5">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold text-white flex items-center">
                    <i class="fas fa-newspaper mr-2"></i>
                    Artikel Terbaru
                </h3>
                <a href="<?= BASE_URL ?>/admin/articles/create" class="bg-white text-[#0F3A75] px-3 py-1.5 rounded hover:bg-gray-100 transition text-sm">
                    <i class="fas fa-plus mr-1"></i>Tambah
                </a>
            </div>
        </div>
        <div class="p-5">
            <?php if (!empty($recent_articles)): ?>
                <div class="space-y-2">
                    <?php foreach ($recent_articles as $article): ?>
                        <div class="flex items-center justify-between p-3 border-b border-gray-100 hover:bg-gray-50">
                            <div class="flex items-center space-x-3">
                                <div class="bg-[#0F3A75] text-white rounded p-2">
                                    <i class="fas fa-file-alt text-sm"></i>
                                </div>
                                <div>
                                    <h4 class="text-sm font-medium text-gray-800"><?= $article['title'] ?></h4>
                                    <p class="text-xs text-gray-500">Oleh <?= $article['author_name'] ?></p>
                                </div>
                            </div>
                            <a href="<?= BASE_URL ?>/admin/articles/edit/<?= $article['id'] ?>" class="text-[#0F3A75] hover:text-blue-900">
                                <i class="fas fa-edit"></i>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
                <a href="<?= BASE_URL ?>/admin/articles" class="block text-center mt-4 text-[#0F3A75] hover:underline text-sm">
                    Lihat Semua <i class="fas fa-arrow-right ml-1 text-xs"></i>
                </a>
            <?php else: ?>
                <div class="text-center py-8">
                    <i class="fas fa-newspaper text-gray-300 text-3xl mb-2"></i>
                    <p class="text-gray-500 text-sm">Belum ada artikel</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php require_once '../app/views/layouts/admin_footer.php'; ?>
