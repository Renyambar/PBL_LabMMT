<?php require_once '../app/views/layouts/header.php'; ?>

<!-- Page Header -->
<section class="bg-gradient-to-r from-primary to-secondary text-white py-16">
    <div class="container mx-auto px-4">
        <h1 class="text-4xl font-bold mb-4">Artikel & Berita</h1>
        <p class="text-xl">Update kegiatan dan publikasi Lab MMT</p>
    </div>
</section>

<!-- Search Section -->
<section class="py-8 bg-gray-100">
    <div class="container mx-auto px-4">
        <form action="<?= BASE_URL ?>/article" method="GET" class="flex max-w-2xl mx-auto">
            <input type="text" name="search" placeholder="Cari artikel..." value="<?= $search ?? '' ?>" 
                   class="px-4 py-3 border border-gray-300 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-primary flex-1">
            <button type="submit" class="bg-primary text-white px-8 py-3 rounded-r-lg hover:bg-blue-700 transition">
                <i class="fas fa-search mr-2"></i>Search
            </button>
        </form>
    </div>
</section>

<!-- Articles Grid -->
<section class="py-16">
    <div class="container mx-auto px-4">
        <?php if (!empty($articles)): ?>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <?php foreach ($articles as $article): ?>
                    <article class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition">
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
                            <div class="flex items-center text-sm text-gray-500 mb-3">
                                <i class="fas fa-calendar mr-2"></i>
                                <?= date('d M Y', strtotime($article['created_at'])) ?>
                                <span class="mx-2">•</span>
                                <i class="fas fa-user mr-2"></i>
                                <?= $article['author_name'] ?>
                            </div>
                            <h3 class="text-xl font-bold mb-3"><?= $article['title'] ?></h3>
                            <p class="text-gray-600 mb-4 line-clamp-3"><?= substr(strip_tags($article['content']), 0, 150) ?>...</p>
                            <a href="<?= BASE_URL ?>/article/detail/<?= $article['slug'] ?>" class="text-primary hover:text-blue-700 font-semibold">
                                Baca Selengkapnya <i class="fas fa-arrow-right ml-1"></i>
                            </a>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="text-center py-16">
                <i class="fas fa-newspaper text-gray-400 text-6xl mb-4"></i>
                <p class="text-gray-500 text-xl">Tidak ada artikel ditemukan</p>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php require_once '../app/views/layouts/footer.php'; ?>
