<?php require_once '../app/views/layouts/header.php'; ?>

<!-- Page Header -->
<section class="bg-gradient-to-r from-black/100 via-blue-800 to-blue-600 text-white py-16">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            <span class="inline-block bg-white/20 text-white px-3 py-1 rounded-full text-sm font-semibold mb-4">
                <?= htmlspecialchars($data['publication']['publication_type'] ?? '') ?>
            </span>
            <h1 class="text-4xl font-bold mb-4"><?= htmlspecialchars($data['publication']['title'] ?? '') ?></h1>
            <p class="text-xl">
                <i class="fas fa-users mr-2"></i>
                <?= htmlspecialchars($data['publication']['authors'] ?? '') ?>
            </p>
        </div>
    </div>
</section>

<!-- Publication Details -->
<section class="py-16">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white rounded-lg shadow-lg p-8">
                
                <!-- Publication Metadata -->
                <div class="grid md:grid-cols-2 gap-6 mb-8 pb-8 border-b">
                    <?php if (!empty($data['publication']['publication_date'])): ?>
                        <div>
                            <h3 class="text-sm font-semibold text-gray-500 mb-2">TANGGAL PUBLIKASI</h3>
                            <p class="text-lg">
                                <i class="fas fa-calendar text-[#0F3A75] mr-2"></i>
                                <?= date('d F Y', strtotime($data['publication']['publication_date'])) ?>
                            </p>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($data['publication']['journal_name'])): ?>
                        <div>
                            <h3 class="text-sm font-semibold text-gray-500 mb-2">JURNAL</h3>
                            <p class="text-lg">
                                <i class="fas fa-book text-[#0F3A75] mr-2"></i>
                                <?= htmlspecialchars($data['publication']['journal_name']) ?>
                            </p>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($data['publication']['conference_name'])): ?>
                        <div>
                            <h3 class="text-sm font-semibold text-gray-500 mb-2">KONFERENSI</h3>
                            <p class="text-lg">
                                <i class="fas fa-chalkboard-teacher text-[#0F3A75] mr-2"></i>
                                <?= htmlspecialchars($data['publication']['conference_name']) ?>
                            </p>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($data['publication']['publisher'])): ?>
                        <div>
                            <h3 class="text-sm font-semibold text-gray-500 mb-2">PENERBIT</h3>
                            <p class="text-lg">
                                <i class="fas fa-building text-[#0F3A75] mr-2"></i>
                                <?= htmlspecialchars($data['publication']['publisher']) ?>
                            </p>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($data['publication']['volume']) || !empty($data['publication']['issue'])): ?>
                        <div>
                            <h3 class="text-sm font-semibold text-gray-500 mb-2">VOLUME/ISSUE</h3>
                            <p class="text-lg">
                                <i class="fas fa-layer-group text-[#0F3A75] mr-2"></i>
                                <?php if (!empty($data['publication']['volume'])): ?>
                                    Vol. <?= htmlspecialchars($data['publication']['volume']) ?>
                                <?php endif; ?>
                                <?php if (!empty($data['publication']['issue'])): ?>
                                    (<?= htmlspecialchars($data['publication']['issue']) ?>)
                                <?php endif; ?>
                            </p>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($data['publication']['pages'])): ?>
                        <div>
                            <h3 class="text-sm font-semibold text-gray-500 mb-2">HALAMAN</h3>
                            <p class="text-lg">
                                <i class="fas fa-file text-[#0F3A75] mr-2"></i>
                                <?= htmlspecialchars($data['publication']['pages']) ?>
                            </p>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($data['publication']['doi'])): ?>
                        <div>
                            <h3 class="text-sm font-semibold text-gray-500 mb-2">DOI</h3>
                            <p class="text-lg">
                                <a href="https://doi.org/<?= htmlspecialchars($data['publication']['doi']) ?>" 
                                   target="_blank"
                                   class="text-blue-600 hover:text-blue-800">
                                    <i class="fas fa-link text-[#0F3A75] mr-2"></i>
                                    <?= htmlspecialchars($data['publication']['doi']) ?>
                                </a>
                            </p>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($data['publication']['isbn'])): ?>
                        <div>
                            <h3 class="text-sm font-semibold text-gray-500 mb-2">ISBN</h3>
                            <p class="text-lg">
                                <i class="fas fa-barcode text-[#0F3A75] mr-2"></i>
                                <?= htmlspecialchars($data['publication']['isbn']) ?>
                            </p>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($data['publication']['issn'])): ?>
                        <div>
                            <h3 class="text-sm font-semibold text-gray-500 mb-2">ISSN</h3>
                            <p class="text-lg">
                                <i class="fas fa-barcode text-[#0F3A75] mr-2"></i>
                                <?= htmlspecialchars($data['publication']['issn']) ?>
                            </p>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($data['publication']['citation_count']) && $data['publication']['citation_count'] > 0): ?>
                        <div>
                            <h3 class="text-sm font-semibold text-gray-500 mb-2">SITASI</h3>
                            <p class="text-lg">
                                <i class="fas fa-quote-right text-[#0F3A75] mr-2"></i>
                                <?= $data['publication']['citation_count'] ?> citations
                            </p>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Abstract -->
                <?php if (!empty($data['publication']['abstract'])): ?>
                    <div class="mb-8">
                        <h2 class="text-2xl font-bold mb-4 text-[#0F3A75]">
                            <i class="fas fa-align-left mr-2"></i>Abstrak
                        </h2>
                        <p class="text-gray-700 leading-relaxed text-justify">
                            <?= nl2br(htmlspecialchars($data['publication']['abstract'])) ?>
                        </p>
                    </div>
                <?php endif; ?>

                <!-- Keywords -->
                <?php if (!empty($data['publication']['keywords'])): ?>
                    <div class="mb-8">
                        <h3 class="text-xl font-bold mb-4 text-[#0F3A75]">
                            <i class="fas fa-tags mr-2"></i>Kata Kunci
                        </h3>
                        <div class="flex flex-wrap gap-2">
                            <?php 
                            $keywords = explode('|', $data['publication']['keywords']);
                            foreach ($keywords as $keyword): 
                            ?>
                                <span class="bg-gray-100 text-gray-700 px-4 py-2 rounded-full">
                                    #<?= htmlspecialchars(trim($keyword)) ?>
                                </span>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Download & Links -->
                <div class="flex flex-wrap gap-4 mb-8">
                    <?php if (!empty($data['publication']['pdf_file'])): ?>
                        <a href="<?= BASE_URL ?>/assets/pdf/publications/<?= $data['publication']['pdf_file'] ?>" 
                           target="_blank"
                           class="bg-red-600 text-white px-6 py-3 rounded-lg hover:bg-red-700 transition inline-flex items-center font-semibold">
                            <i class="fas fa-file-pdf mr-2"></i>Download PDF
                        </a>
                    <?php endif; ?>

                    <?php if (!empty($data['publication']['url'])): ?>
                        <a href="<?= htmlspecialchars($data['publication']['url']) ?>" 
                           target="_blank"
                           class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition inline-flex items-center font-semibold">
                            <i class="fas fa-external-link-alt mr-2"></i>Link Eksternal
                        </a>
                    <?php endif; ?>

                    <a href="<?= BASE_URL ?>/article" 
                       class="bg-gray-600 text-white px-6 py-3 rounded-lg hover:bg-gray-700 transition inline-flex items-center font-semibold">
                        <i class="fas fa-arrow-left mr-2"></i>Kembali
                    </a>
                </div>

                <!-- Citation -->
                <div class="bg-gray-50 p-6 rounded-lg">
                    <h3 class="text-lg font-bold mb-3 text-[#0F3A75]">
                        <i class="fas fa-quote-left mr-2"></i>Cara Sitasi
                    </h3>
                    <div class="bg-white p-4 rounded border font-mono text-sm break-words">
                        <?= htmlspecialchars($data['publication']['authors']) ?>. 
                        (<?= date('Y', strtotime($data['publication']['publication_date'])) ?>). 
                        <?= htmlspecialchars($data['publication']['title']) ?>. 
                        <?php if (!empty($data['publication']['journal_name'])): ?>
                            <em><?= htmlspecialchars($data['publication']['journal_name']) ?></em>
                            <?php if (!empty($data['publication']['volume'])): ?>
                                , <em><?= htmlspecialchars($data['publication']['volume']) ?></em>
                            <?php endif; ?>
                            <?php if (!empty($data['publication']['issue'])): ?>
                                (<?= htmlspecialchars($data['publication']['issue']) ?>)
                            <?php endif; ?>
                            <?php if (!empty($data['publication']['pages'])): ?>
                                , <?= htmlspecialchars($data['publication']['pages']) ?>
                            <?php endif; ?>
                            <?php if (!empty($data['publication']['doi'])): ?>
                                . https://doi.org/<?= htmlspecialchars($data['publication']['doi']) ?>
                            <?php endif; ?>
                        <?php elseif (!empty($data['publication']['conference_name'])): ?>
                            In <em><?= htmlspecialchars($data['publication']['conference_name']) ?></em>
                            <?php if (!empty($data['publication']['pages'])): ?>
                                (pp. <?= htmlspecialchars($data['publication']['pages']) ?>)
                            <?php endif; ?>
                            <?php if (!empty($data['publication']['publisher'])): ?>
                                . <?= htmlspecialchars($data['publication']['publisher']) ?>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<?php require_once '../app/views/layouts/footer.php'; ?>
