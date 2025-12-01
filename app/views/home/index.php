<?php require_once '../app/views/layouts/header.php'; ?>

<!-- Hero Section -->
<section class="bg-gradient-to-r from-black/100 via-blue-800 to-blue-600 text-white py-16">
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between">
            <div class="w-1/3 flex justify-center">
                <img src="<?= BASE_URL ?>/assets/img/favicon.ico" alt="Lab MMT Mascot" class="w-64 h-auto">
            </div>
            <div class="w-2/3 pl-8">
                <h1 class="text-4xl font-bold mb-4">Laboratorium Multimedia &<br>Mobile Technology</h1>
                <p class="text-lg mb-6">Mengembangkan inovasi digital dan teknologi mobile masa depan yang<br>lebih baik</p>
                <div class="flex space-x-4">
                    <a href="<?= BASE_URL ?>/project" class="bg-white text-blue-700 px-6 py-2 rounded font-semibold hover:bg-gray-100 transition">
                        Lihat Proyek
                    </a>
                    <a href="<?= BASE_URL ?>/home/about" class="border-2 border-white text-white px-6 py-2 rounded font-semibold hover:bg-white hover:text-blue-700 transition">
                        Tentang Kami
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-12 bg-white">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition text-center border">
                <div class="text-[#0F3A75] text-5xl mb-4">
                <i class="fas fa-laptop-code"></i>
                </div>
                <h3 class="text-xl font-bold mb-3">Web Development</h3>
                <p class="text-gray-600 text-sm">Membangun aplikasi web modern dengan teknologi terkini seperti Laravel, React, dan Vue.js</p>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition text-center border">
                <div class="text-[#0F3A75] text-5xl mb-4">
                    <i class="fas fa-mobile-alt"></i>
                </div>
                <h3 class="text-xl font-bold mb-3">Mobile Development</h3>
                <p class="text-gray-600 text-sm">Mengembangkan aplikasi mobile cross-platform menggunakan Flutter dan React Native</p>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition text-center border">
                <div class="text-[#0F3A75] text-5xl mb-4">
                    <i class="fas fa-vr-cardboard"></i>
                </div>
                <h3 class="text-xl font-bold mb-3">AR/VR Technology</h3>
                <p class="text-gray-600 text-sm">Eksplorasi teknologi Augmented dan Virtual Reality untuk berbagai kebutuhan</p>
            </div>
        </div>
    </div>
</section>

<!-- Featured Projects Section -->
<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold mb-2">Proyek Unggulan</h2>
            <p class="text-gray-600 text-sm">Karya terbaik dari mahasiswa dan peneliti Lab MMT</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <?php if (!empty($featured_projects)): ?>
                <?php foreach ($featured_projects as $project): ?>
                    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition">
                        <div class="h-56 bg-gradient-to-br from-blue-500 to-purple-600 relative">
                            <?php if ($project['thumbnail']): ?>
                                <img src="<?= BASE_URL ?>/assets/img/<?= $project['thumbnail'] ?>" alt="<?= $project['title'] ?>" class="w-full h-full object-cover">
                            <?php else: ?>
                                <div class="flex items-center justify-center h-full">
                                    <i class="fas fa-mobile-alt text-white text-6xl opacity-50"></i>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="p-5">
                            <h3 class="text-lg font-bold mb-2"><?= $project['title'] ?></h3>
                            <p class="text-gray-600 text-sm mb-3 line-clamp-3"><?= substr($project['description'], 0, 100) ?>...</p>
                            <a href="<?= BASE_URL ?>/project/detail/<?= $project['slug'] ?>" class="text-blue-600 hover:text-blue-700 font-semibold text-sm">
                                Lihat Detail →
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="col-span-3 text-center text-gray-500">Belum ada proyek tersedia</p>
            <?php endif; ?>
        </div>

        <div class="text-center mt-6">
            <a href="<?= BASE_URL ?>/project" class="bg-[#0F3A75] text-white px-6 py-2 rounded hover:bg-[#0C2F61] transition inline-block text-sm">
                Lihat Semua Proyek
            </a>
        </div>
    </div>
</section>

<!-- Recent Articles Section -->
<section class="py-12 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold mb-2">Artikel & Berita Terkini</h2>
            <p class="text-gray-600 text-sm">Update kegiatan dan publikasi dari Lab MMT</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <?php if (!empty($recent_articles)): ?>
                <?php foreach ($recent_articles as $article): ?>
                    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition">
                        <div class="h-48 bg-gray-200">
                            <?php if ($article['thumbnail']): ?>
                                <img src="<?= BASE_URL ?>/assets/img/<?= $article['thumbnail'] ?>" alt="<?= $article['title'] ?>" class="w-full h-full object-cover">
                            <?php else: ?>
                                <div class="flex items-center justify-center h-full bg-gray-300">
                                    <i class="fas fa-users text-gray-400 text-5xl"></i>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="p-5">
                            <div class="text-xs text-gray-500 mb-2">
                                <i class="fas fa-calendar mr-1"></i>
                                <?= date('d M Y', strtotime($article['created_at'])) ?>
                            </div>
                            <h3 class="text-lg font-bold mb-2"><?= $article['title'] ?></h3>
                            <p class="text-gray-600 text-sm mb-3"><?= substr(strip_tags($article['content']), 0, 80) ?>...</p>
                            <a href="<?= BASE_URL ?>/article/detail/<?= $article['slug'] ?>" class="text-blue-600 hover:text-blue-700 font-semibold text-sm">
                                Baca Selengkapnya →
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="col-span-3 text-center text-gray-500">Belum ada artikel tersedia</p>
            <?php endif; ?>
        </div>

        <div class="text-center mt-6">
            <a href="<?= BASE_URL ?>/article" class="bg-[#0F3A75] text-white px-6 py-2 rounded hover:bg-[#0C2F61] transition inline-block text-sm">
                Lihat Semua Artikel
            </a>
        </div>
    </div>
</section>

<!-- Partners Section -->
<?php if (!empty($partners)): ?>
<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold mb-2">Mitra dan Kolaborasi</h2>
            <p class="text-gray-600 text-sm">Bekerjasama dengan berbagai institusi dan perusahaan</p>
        </div>

        <div class="flex justify-center items-center gap-12 flex-wrap">
            <?php foreach ($partners as $partner): ?>
                <div class="flex flex-col items-center">
                    <div class="w-24 h-24 rounded-full bg-white shadow-md flex items-center justify-center hover:shadow-lg transition border-2 border-gray-100">
                        <?php if ($partner['logo']): ?>
                            <img src="<?= BASE_URL ?>/assets/img/<?= $partner['logo'] ?>" alt="<?= $partner['name'] ?>" class="w-16 h-16 object-contain">
                        <?php else: ?>
                            <i class="fas fa-building text-gray-400 text-3xl"></i>
                        <?php endif; ?>
                    </div>
                    <span class="text-xs text-gray-600 mt-2 text-center"><?= $partner['name'] ?></span>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Call to Action -->
<section class="bg-gradient-to-r from-blue-800 via-blue-800 to-black/100 text-white py-16">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl font-bold mb-3">Tertarik Bergabung?</h2>
        <p class="text-lg mb-6">Mari bersama-sama mengembangkan teknologi untuk masa depan yang lebih baik</p>
        <a href="<?= BASE_URL ?>/home/contact" class="bg-white text-blue-600 px-6 py-2 rounded font-semibold hover:bg-gray-100 transition inline-block">
            Hubungi Kami
        </a>
    </div>
</section>

<?php require_once '../app/views/layouts/footer.php'; ?>
