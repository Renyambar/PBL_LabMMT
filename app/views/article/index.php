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
        <h1 class="text-4xl font-bold mb-4">Artikel & Publikasi Ilmiah</h1>
        <p class="text-xl">Update kegiatan dan publikasi ilmiah Lab MMT</p>
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
                        <div class="h-48 relative overflow-hidden bg-gray-200">
                            <?php if (!empty($article['thumbnail'])): ?>
                                <img src="<?= BASE_URL ?>/assets/img/<?= $article['thumbnail'] ?>"
                                     alt="<?= htmlspecialchars($article['title']) ?>" 
                                     class="w-full h-full object-cover">
                            <?php else: ?>
                                <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-blue-100 to-blue-200">
                                    <i class="fas fa-newspaper text-blue-300 text-6xl"></i>
                                </div>
                            <?php endif; ?>
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

<!-- Publications Section -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4 max-w-7xl">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-800 mb-4">
                <i class="fas fa-book text-[#0F3A75] mr-3"></i>Publikasi Ilmiah
            </h2>
            <p class="text-gray-600">Hasil penelitian dan karya ilmiah dari Lab MMT</p>
        </div>

        <?php if (!empty($publications)): ?>
            <div class="space-y-6">
                <?php foreach ($publications as $pub): ?>
                    <article class="bg-white rounded-lg shadow-md hover:shadow-xl transition p-6 border-l-4 border-[#0F3A75]">
                        <div class="flex items-start justify-between mb-3">
                            <span class="inline-block bg-[#0F3A75] text-white px-3 py-1 rounded-full text-sm font-semibold">
                                <?= htmlspecialchars($pub['publication_type']) ?>
                            </span>
                            <?php if ($pub['publication_date']): ?>
                                <span class="text-gray-500 text-sm">
                                    <i class="fas fa-calendar mr-1"></i>
                                    <?= date('Y', strtotime($pub['publication_date'])) ?>
                                </span>
                            <?php endif; ?>
                        </div>

                        <h3 class="text-2xl font-bold mb-3 hover:text-[#0F3A75] transition">
                            <a href="<?= BASE_URL ?>/publication/detail/<?= $pub['slug'] ?>">
                                <?= htmlspecialchars($pub['title']) ?>
                            </a>
                        </h3>

                        <p class="text-gray-600 mb-3">
                            <i class="fas fa-users text-[#0F3A75] mr-2"></i>
                            <?= htmlspecialchars($pub['authors']) ?>
                        </p>

                        <?php if ($pub['journal_name']): ?>
                            <p class="text-gray-700 mb-3 italic">
                                <i class="fas fa-book text-[#0F3A75] mr-2"></i>
                                <?= htmlspecialchars($pub['journal_name']) ?>
                                <?php if ($pub['volume']): ?>
                                    , Vol. <?= htmlspecialchars($pub['volume']) ?>
                                <?php endif; ?>
                                <?php if ($pub['issue']): ?>
                                    (<?= htmlspecialchars($pub['issue']) ?>)
                                <?php endif; ?>
                                <?php if ($pub['pages']): ?>
                                    , pp. <?= htmlspecialchars($pub['pages']) ?>
                                <?php endif; ?>
                            </p>
                        <?php elseif ($pub['conference_name']): ?>
                            <p class="text-gray-700 mb-3 italic">
                                <i class="fas fa-chalkboard-teacher text-[#0F3A75] mr-2"></i>
                                <?= htmlspecialchars($pub['conference_name']) ?>
                            </p>
                        <?php endif; ?>

                        <?php if ($pub['abstract']): ?>
                            <p class="text-gray-600 mb-4 line-clamp-2">
                                <?= htmlspecialchars(substr($pub['abstract'], 0, 200)) ?>...
                            </p>
                        <?php endif; ?>

                        <div class="flex flex-wrap items-center gap-3">
                            <a href="<?= BASE_URL ?>/publication/detail/<?= $pub['slug'] ?>" 
                               class="bg-[#0F3A75] text-white px-4 py-2 rounded-lg hover:bg-[#0C2F61] transition inline-flex items-center">
                                <i class="fas fa-eye mr-2"></i>Detail
                            </a>

                            <?php if ($pub['pdf_file']): ?>
                                <a href="<?= BASE_URL ?>/assets/pdf/publications/<?= $pub['pdf_file'] ?>" 
                                   target="_blank"
                                   class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition inline-flex items-center">
                                    <i class="fas fa-file-pdf mr-2"></i>Download PDF
                                </a>
                            <?php endif; ?>

                            <?php if ($pub['doi']): ?>
                                <a href="https://doi.org/<?= htmlspecialchars($pub['doi']) ?>" 
                                   target="_blank"
                                   class="text-blue-600 hover:text-blue-800 inline-flex items-center">
                                    <i class="fas fa-link mr-1"></i>DOI
                                </a>
                            <?php endif; ?>

                            <?php if ($pub['citation_count'] > 0): ?>
                                <span class="text-gray-600 text-sm">
                                    <i class="fas fa-quote-right mr-1"></i>
                                    <?= $pub['citation_count'] ?> citations
                                </span>
                            <?php endif; ?>
                        </div>

                        <?php if ($pub['keywords']): ?>
                            <div class="mt-4 flex flex-wrap gap-2">
                                <?php 
                                $keywords = explode('|', $pub['keywords']);
                                foreach ($keywords as $keyword): 
                                ?>
                                    <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm">
                                        #<?= htmlspecialchars(trim($keyword)) ?>
                                    </span>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="text-center py-16">
                <i class="fas fa-book-open text-gray-300 text-6xl mb-4"></i>
                <p class="text-gray-500 text-xl">Belum ada publikasi ilmiah</p>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php require_once '../app/views/layouts/footer.php'; ?>