<?php require_once '../app/views/layouts/header.php'; ?>

<!-- Hero Section -->
<section class="bg-gradient-to-r from-primary to-secondary text-white py-20">
    <div class="container mx-auto px-4">
        <div class="max-w-3xl mx-auto text-center">
            <h1 class="text-5xl font-bold mb-6">Laboratorium Multimedia & Mobile Technology</h1>
            <p class="text-xl mb-8">Mengembangkan inovasi digital dan teknologi mobile untuk masa depan yang lebih baik</p>
            <div class="flex justify-center space-x-4">
                <a href="<?= BASE_URL ?>/project" class="bg-white text-primary px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition">
                    Lihat Proyek
                </a>
                <a href="<?= BASE_URL ?>/home/about" class="border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-primary transition">
                    Tentang Kami
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-16">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white p-8 rounded-lg shadow-lg text-center">
                <div class="text-primary text-5xl mb-4">
                    <i class="fas fa-laptop-code"></i>
                </div>
                <h3 class="text-2xl font-bold mb-4">Web Development</h3>
                <p class="text-gray-600">Membangun aplikasi web modern dengan teknologi terkini seperti Laravel, React, dan Vue.js</p>
            </div>

            <div class="bg-white p-8 rounded-lg shadow-lg text-center">
                <div class="text-primary text-5xl mb-4">
                    <i class="fas fa-mobile-alt"></i>
                </div>
                <h3 class="text-2xl font-bold mb-4">Mobile Development</h3>
                <p class="text-gray-600">Mengembangkan aplikasi mobile cross-platform menggunakan Flutter dan React Native</p>
            </div>

            <div class="bg-white p-8 rounded-lg shadow-lg text-center">
                <div class="text-primary text-5xl mb-4">
                    <i class="fas fa-vr-cardboard"></i>
                </div>
                <h3 class="text-2xl font-bold mb-4">AR/VR Technology</h3>
                <p class="text-gray-600">Eksplorasi teknologi Augmented dan Virtual Reality untuk berbagai kebutuhan</p>
            </div>
        </div>
    </div>
</section>

<!-- Featured Projects Section -->
<section class="py-16 bg-gray-100">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold mb-4">Proyek Unggulan</h2>
            <p class="text-gray-600">Karya terbaik dari mahasiswa dan peneliti Lab MMT</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <?php if (!empty($featured_projects)): ?>
                <?php foreach ($featured_projects as $project): ?>
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition">
                        <div class="h-48 bg-gray-300 relative">
                            <?php if ($project['thumbnail']): ?>
                                <img src="<?= BASE_URL ?>/assets/img/<?= $project['thumbnail'] ?>" alt="<?= $project['title'] ?>" class="w-full h-full object-cover">
                            <?php else: ?>
                                <div class="flex items-center justify-center h-full">
                                    <i class="fas fa-image text-gray-400 text-5xl"></i>
                                </div>
                            <?php endif; ?>
                            <span class="absolute top-4 right-4 bg-primary text-white px-3 py-1 rounded-full text-sm">
                                <?= $project['category'] ?>
                            </span>
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-bold mb-2"><?= $project['title'] ?></h3>
                            <p class="text-gray-600 mb-4 line-clamp-3"><?= substr($project['description'], 0, 100) ?>...</p>
                            <div class="flex flex-wrap gap-2 mb-4">
                                <?php 
                                $tags = explode(',', $project['tags']);
                                foreach (array_slice($tags, 0, 3) as $tag): 
                                ?>
                                    <span class="bg-gray-200 text-gray-700 px-2 py-1 rounded text-sm"><?= trim($tag) ?></span>
                                <?php endforeach; ?>
                            </div>
                            <a href="<?= BASE_URL ?>/project/detail/<?= $project['slug'] ?>" class="text-primary hover:text-blue-700 font-semibold">
                                Lihat Detail <i class="fas fa-arrow-right ml-1"></i>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="col-span-3 text-center text-gray-500">Belum ada proyek tersedia</p>
            <?php endif; ?>
        </div>

        <div class="text-center mt-8">
            <a href="<?= BASE_URL ?>/project" class="bg-primary text-white px-8 py-3 rounded-lg hover:bg-blue-700 transition inline-block">
                Lihat Semua Proyek
            </a>
        </div>
    </div>
</section>

<!-- Recent Articles Section -->
<section class="py-16">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold mb-4">Artikel & Berita Terkini</h2>
            <p class="text-gray-600">Update kegiatan dan publikasi dari Lab MMT</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <?php if (!empty($recent_articles)): ?>
                <?php foreach ($recent_articles as $article): ?>
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition">
                        <div class="h-48 bg-gray-300">
                            <?php if ($article['thumbnail']): ?>
                                <img src="<?= BASE_URL ?>/assets/img/<?= $article['thumbnail'] ?>" alt="<?= $article['title'] ?>" class="w-full h-full object-cover">
                            <?php else: ?>
                                <div class="flex items-center justify-center h-full">
                                    <i class="fas fa-newspaper text-gray-400 text-5xl"></i>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="p-6">
                            <div class="text-sm text-gray-500 mb-2">
                                <i class="fas fa-calendar mr-1"></i>
                                <?= date('d M Y', strtotime($article['created_at'])) ?>
                            </div>
                            <h3 class="text-xl font-bold mb-2"><?= $article['title'] ?></h3>
                            <p class="text-gray-600 mb-4"><?= substr(strip_tags($article['content']), 0, 100) ?>...</p>
                            <a href="<?= BASE_URL ?>/article/detail/<?= $article['slug'] ?>" class="text-primary hover:text-blue-700 font-semibold">
                                Baca Selengkapnya <i class="fas fa-arrow-right ml-1"></i>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="col-span-3 text-center text-gray-500">Belum ada artikel tersedia</p>
            <?php endif; ?>
        </div>

        <div class="text-center mt-8">
            <a href="<?= BASE_URL ?>/article" class="bg-primary text-white px-8 py-3 rounded-lg hover:bg-blue-700 transition inline-block">
                Lihat Semua Artikel
            </a>
        </div>
    </div>
</section>

<!-- Partners Section -->
<?php if (!empty($partners)): ?>
<section class="py-16 bg-gray-100">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold mb-4">Mitra & Partner</h2>
            <p class="text-gray-600">Bekerjasama dengan berbagai institusi dan perusahaan</p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
            <?php foreach ($partners as $partner): ?>
                <div class="bg-white p-6 rounded-lg shadow-lg flex items-center justify-center hover:shadow-xl transition">
                    <?php if ($partner['logo']): ?>
                        <img src="<?= BASE_URL ?>/assets/img/<?= $partner['logo'] ?>" alt="<?= $partner['name'] ?>" class="max-h-20">
                    <?php else: ?>
                        <span class="text-gray-700 font-semibold"><?= $partner['name'] ?></span>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Call to Action -->
<section class="bg-primary text-white py-16">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-4xl font-bold mb-4">Tertarik Bergabung?</h2>
        <p class="text-xl mb-8">Mari bersama-sama mengembangkan teknologi untuk masa depan yang lebih baik</p>
        <a href="<?= BASE_URL ?>/home/contact" class="bg-white text-primary px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition inline-block">
            Hubungi Kami
        </a>
    </div>
</section>

<?php require_once '../app/views/layouts/footer.php'; ?>
