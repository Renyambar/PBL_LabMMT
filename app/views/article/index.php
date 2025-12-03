<?php 
require_once '../app/views/layouts/header.php'; 

$showAll = isset($_GET['show']) && $_GET['show'] == 'all';
$articlesPerPage = 9;

// Pastikan $articles adalah array
if (!isset($articles) || !is_array($articles)) {
    $articles = [];
}

$totalArticles = count($articles);

if ($showAll) {
    $articlesToShow = $articles;
} else {
    $articlesToShow = array_slice($articles, 0, $articlesPerPage);
}

$hasMore = $totalArticles > $articlesPerPage;
?>

<!-- Page Header -->
<section class="bg-gradient-to-r from-black/100 via-blue-800 to-blue-600 text-white py-16">
    <div class="container mx-auto px-4">
        <h1 class="text-4xl font-bold mb-4">Artikel & Berita</h1>
        <p class="text-xl">Update kegiatan dan publikasi Lab MMT</p>
    </div>
</section>

<!-- Search Section -->
<section class="py-8 bg-gray-50">
    <div class="container mx-auto px-4">
        <form action="<?= BASE_URL ?>/article" method="GET" class="flex max-w-2xl mx-auto">
            <input type="text" name="search" placeholder="Cari artikel..."
                   value="<?= $search ?? '' ?>"
                   class="px-4 py-3 border border-gray-300 rounded-l-lg focus:ring-blue-600 flex-1">
            <button type="submit" class="bg-[#0F3A75] text-white px-8 py-3 rounded-r-lg hover:bg-[#0C2F61] transition">
                <i class="fas fa-search mr-2"></i>Cari
            </button>
        </form>
    </div>
</section>

<!-- Articles Grid -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4 max-w-7xl">

        <?php if (!empty($articlesToShow)): ?>

            <!-- GRID: responsive 1 / 2 / 3 kolom -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php foreach ($articlesToShow as $article): ?>
                    <article class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition duration-300 hover:-translate-y-1">

                        <!-- Image-->
                        <div class="h-48 relative overflow-hidden">
                            <img src="/Lab-MMT/public/assets/img/articles/articles-proto.jpg"
                                 alt="" class="w-full h-full object-cover" style="object-position: center 10%;">
                        </div>

                        <!-- Content -->
                        <div class="p-6">
                            <!-- Date and Author -->
                            <div class="text-sm text-gray-500 flex items-center mb-3">
                                <i class="fas fa-calendar text-gray-400 mr-2"></i><?= date('d M Y', strtotime($article['created_at'])) ?>
                                <span class="mx-2">•</span>
                                <i class="fas fa-user text-gray-400 mr-2"></i><?= $article['author_name'] ?>
                            </div>

                            <!-- Title -->
                            <h3 class="text-xl font-bold mb-3 text-gray-800 hover:text-blue-700 transition">
                                <?= $article['title']; ?>
                            </h3>

                            <!-- Excerpt -->
                            <p class="text-gray-600 mb-4 line-clamp-3">
                                <?= substr(strip_tags($article['content']), 0, 120); ?>...
                            </p>

                            <!-- Read More Link -->
                            <a href="<?= BASE_URL ?>/article/detail/<?= $article['slug'] ?>"
                               class="inline-flex items-center text-blue-600 font-semibold hover:text-blue-700 transition">
                                Baca Selengkapnya <i class="fas fa-arrow-right ml-2"></i>
                            </a>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>

            <!-- Lihat Semua Berita Button -->
            <div class="text-center mt-12">
                <a href="<?= BASE_URL ?>/article?show=all<?= isset($search) && $search !== '' ? '&search='.urlencode($search) : '' ?>"
                    class="inline-block bg-[#0F3A75] text-white px-10 py-3 rounded-lg font-semibold hover:bg-[#0C2F61] transition">
                        Lihat Semua Berita
                </a>
            </div>
            

        <?php else: ?>
            <div class="text-center py-20 text-gray-500">Tidak ada artikel ditemukan.</div>
        <?php endif; ?>

    </div>
</section>

<?php require_once '../app/views/layouts/footer.php'; ?>