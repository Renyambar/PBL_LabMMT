<?php require_once '../app/views/layouts/header.php'; ?>

<!-- Page Header -->
<section class="bg-gradient-to-r from-black/100 via-blue-800 to-blue-600 text-white py-16">
    <div class="container mx-auto px-4">
        <h1 class="text-4xl font-bold mb-4">PUBLIKASI ILMIAH</h1>
        <p class="text-xl">Hasil Penelitian dan Karya Ilmiah Lab MMT</p>
    </div>
</section>

<!-- Search & Filter -->
<section class="py-8 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            <form action="<?= BASE_URL ?>/publication" method="GET" class="flex flex-col md:flex-row gap-4">
                <input type="text" name="search" value="<?= htmlspecialchars($data['keyword'] ?? '') ?>" 
                       placeholder="Cari publikasi..." 
                       class="flex-1 px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                
                <select name="type" class="px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Semua Tipe</option>
                    <?php foreach ($data['types'] as $type): ?>
                        <option value="<?= $type ?>" <?= $data['selected_type'] == $type ? 'selected' : '' ?>>
                            <?= $type ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                
                <button type="submit" class="bg-[#0F3A75] text-white px-6 py-3 rounded-lg hover:bg-[#0C2F61] transition">
                    <i class="fas fa-search mr-2"></i>Cari
                </button>
            </form>
        </div>
    </div>
</section>

<!-- Publications List -->
<section class="py-16">
    <div class="container mx-auto px-4">
        <?php if (!empty($data['publications'])): ?>
            <div class="max-w-5xl mx-auto space-y-6">
                <?php foreach ($data['publications'] as $pub): ?>
                    <article class="bg-white rounded-lg shadow-md hover:shadow-xl transition p-6 border-l-4 border-[#0F3A75]">
                        <div class="flex items-start justify-between mb-3">
                            <span class="inline-block bg-[#0F3A75] text-white px-3 py-1 rounded-full text-sm font-semibold">
                                <?= htmlspecialchars($pub->publication_type) ?>
                            </span>
                            <?php if ($pub->publication_date): ?>
                                <span class="text-gray-500 text-sm">
                                    <i class="fas fa-calendar mr-1"></i>
                                    <?= date('Y', strtotime($pub->publication_date)) ?>
                                </span>
                            <?php endif; ?>
                        </div>

                        <h2 class="text-2xl font-bold mb-3 hover:text-[#0F3A75] transition">
                            <a href="<?= BASE_URL ?>/publication/detail/<?= $pub->slug ?>">
                                <?= htmlspecialchars($pub->title) ?>
                            </a>
                        </h2>

                        <p class="text-gray-600 mb-3">
                            <i class="fas fa-users text-[#0F3A75] mr-2"></i>
                            <?= htmlspecialchars($pub->authors) ?>
                        </p>

                        <?php if ($pub->journal_name): ?>
                            <p class="text-gray-700 mb-3 italic">
                                <i class="fas fa-book text-[#0F3A75] mr-2"></i>
                                <?= htmlspecialchars($pub->journal_name) ?>
                                <?php if ($pub->volume): ?>
                                    , Vol. <?= htmlspecialchars($pub->volume) ?>
                                <?php endif; ?>
                                <?php if ($pub->issue): ?>
                                    (<?= htmlspecialchars($pub->issue) ?>)
                                <?php endif; ?>
                                <?php if ($pub->pages): ?>
                                    , pp. <?= htmlspecialchars($pub->pages) ?>
                                <?php endif; ?>
                            </p>
                        <?php elseif ($pub->conference_name): ?>
                            <p class="text-gray-700 mb-3 italic">
                                <i class="fas fa-chalkboard-teacher text-[#0F3A75] mr-2"></i>
                                <?= htmlspecialchars($pub->conference_name) ?>
                            </p>
                        <?php endif; ?>

                        <?php if ($pub->abstract): ?>
                            <p class="text-gray-600 mb-4 line-clamp-2">
                                <?= htmlspecialchars(substr($pub->abstract, 0, 200)) ?>...
                            </p>
                        <?php endif; ?>

                        <div class="flex flex-wrap items-center gap-3">
                            <a href="<?= BASE_URL ?>/publication/detail/<?= $pub->slug ?>" 
                               class="bg-[#0F3A75] text-white px-4 py-2 rounded-lg hover:bg-[#0C2F61] transition inline-flex items-center">
                                <i class="fas fa-eye mr-2"></i>Detail
                            </a>

                            <?php if ($pub->pdf_file): ?>
                                <a href="<?= BASE_URL ?>/assets/pdf/publications/<?= $pub->pdf_file ?>" 
                                   target="_blank"
                                   class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition inline-flex items-center">
                                    <i class="fas fa-file-pdf mr-2"></i>Download PDF
                                </a>
                            <?php endif; ?>

                            <?php if ($pub->doi): ?>
                                <a href="https://doi.org/<?= htmlspecialchars($pub->doi) ?>" 
                                   target="_blank"
                                   class="text-blue-600 hover:text-blue-800 inline-flex items-center">
                                    <i class="fas fa-link mr-1"></i>DOI
                                </a>
                            <?php endif; ?>

                            <?php if ($pub->citation_count > 0): ?>
                                <span class="text-gray-600 text-sm">
                                    <i class="fas fa-quote-right mr-1"></i>
                                    <?= $pub->citation_count ?> citations
                                </span>
                            <?php endif; ?>
                        </div>

                        <?php if ($pub->keywords): ?>
                            <div class="mt-4 flex flex-wrap gap-2">
                                <?php 
                                $keywords = explode('|', $pub->keywords);
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
                <p class="text-gray-500 text-xl">Belum ada publikasi</p>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php require_once '../app/views/layouts/footer.php'; ?>
