<?php require_once '../app/views/layouts/header.php'; ?>

<!-- Article Detail -->
<section class="py-16">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            <!-- Back Button -->
            <a href="<?= BASE_URL ?>/article" class="text-primary hover:text-blue-700 mb-6 inline-block">
                <i class="fas fa-arrow-left mr-2"></i>Kembali ke Artikel
            </a>

            <!-- Article Content -->
            <article class="bg-white rounded-lg shadow-lg overflow-hidden mb-8">
                <!-- Featured Image -->
                <?php if ($article['thumbnail']): ?>
                    <div class="h-96 bg-gray-300">
                        <img src="<?= BASE_URL ?>/assets/img/<?= $article['thumbnail'] ?>" alt="<?= $article['title'] ?>" class="w-full h-full object-cover">
                    </div>
                <?php endif; ?>
                
                <div class="p-8">
                    <!-- Article Meta -->
                    <div class="flex items-center text-gray-600 mb-6">
                        <i class="fas fa-calendar mr-2"></i>
                        <?= date('d F Y', strtotime($article['created_at'])) ?>
                        <span class="mx-3">•</span>
                        <i class="fas fa-user mr-2"></i>
                        <?= $article['author_name'] ?>
                    </div>

                    <!-- Article Title -->
                    <h1 class="text-4xl font-bold mb-6"><?= $article['title'] ?></h1>

                    <!-- Article Content -->
                    <div class="prose max-w-none text-gray-700 leading-relaxed text-lg">
                        <?= nl2br($article['content']) ?>
                    </div>

                    <!-- Share Buttons -->
                    <div class="border-t mt-8 pt-6">
                        <h4 class="font-semibold mb-3">Bagikan Artikel:</h4>
                        <div class="flex space-x-3">
                            <a href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode(BASE_URL . '/article/detail/' . $article['slug']) ?>" 
                               target="_blank" 
                               class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                                <i class="fab fa-facebook mr-2"></i>Facebook
                            </a>
                            <a href="https://twitter.com/intent/tweet?url=<?= urlencode(BASE_URL . '/article/detail/' . $article['slug']) ?>&text=<?= urlencode($article['title']) ?>" 
                               target="_blank" 
                               class="bg-sky-500 text-white px-4 py-2 rounded hover:bg-sky-600 transition">
                                <i class="fab fa-twitter mr-2"></i>Twitter
                            </a>
                            <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?= urlencode(BASE_URL . '/article/detail/' . $article['slug']) ?>&title=<?= urlencode($article['title']) ?>" 
                               target="_blank" 
                               class="bg-blue-700 text-white px-4 py-2 rounded hover:bg-blue-800 transition">
                                <i class="fab fa-linkedin mr-2"></i>LinkedIn
                            </a>
                        </div>
                    </div>
                </div>
            </article>

            <!-- Related Articles -->
            <?php if (!empty($recent_articles)): ?>
                <div class="mt-12">
                    <h2 class="text-3xl font-bold mb-6">Artikel Terkait</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <?php foreach (array_slice($recent_articles, 0, 3) as $related): ?>
                            <?php if ($related['id'] != $article['id']): ?>
                                <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition">
                                    <div class="h-32 bg-gray-300">
                                        <?php if ($related['thumbnail']): ?>
                                            <img src="<?= BASE_URL ?>/assets/img/<?= $related['thumbnail'] ?>" alt="<?= $related['title'] ?>" class="w-full h-full object-cover">
                                        <?php endif; ?>
                                    </div>
                                    <div class="p-4">
                                        <h3 class="font-bold mb-2"><?= $related['title'] ?></h3>
                                        <a href="<?= BASE_URL ?>/article/detail/<?= $related['slug'] ?>" class="text-primary hover:text-blue-700 text-sm">
                                            Baca <i class="fas fa-arrow-right ml-1"></i>
                                        </a>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php require_once '../app/views/layouts/footer.php'; ?>
