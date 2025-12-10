<?php require_once '../app/views/layouts/header.php'; ?>

<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4 max-w-5xl">

        <!-- Back -->
        <a href="<?= BASE_URL ?>/article" class="inline-flex text-blue-600 hover:text-blue-700 mb-8 font-semibold">
            <i class="fas fa-arrow-left mr-2"></i>Kembali ke Artikel
        </a>

        <article class="bg-white shadow-md rounded-xl overflow-hidden">
            <?php if (!empty($article['thumbnail'])): ?>
            <div class="h-96 overflow-hidden">
                <img src="<?= BASE_URL ?>/assets/img/<?= $article['thumbnail'] ?>"
                     alt="<?= htmlspecialchars($article['title']) ?>"
                     class="object-cover w-full h-full">
            </div>
            <?php endif; ?>

            <div class="p-10">
                <div class="flex items-center text-gray-600 mb-6">
                    <i class="fas fa-calendar text-blue-600 mr-2"></i><?= date('d F Y', strtotime($article['created_at'])) ?>
                    <span class="mx-3">•</span>
                    <i class="fas fa-user text-blue-600 mr-2"></i><?= $article['author_name']; ?>
                </div>

                <h1 class="text-4xl font-bold mb-6 text-gray-800"><?= $article['title']; ?></h1>

                <div class="prose prose-lg leading-relaxed text-gray-700">
                    <?= nl2br($article['content']); ?>
                </div>

                <!-- Share -->
                <div class="mt-12 border-t pt-6">
                    <h4 class="font-semibold mb-3">Bagikan Artikel:</h4>
                    <div class="flex flex-wrap gap-3">
                        <button class="bg-blue-600 px-5 py-2 rounded-lg text-white hover:bg-blue-700 transition">Facebook</button>
                        <button class="bg-sky-500 px-5 py-2 rounded-lg text-white hover:bg-sky-600 transition">Twitter</button>
                        <button class="bg-blue-700 px-5 py-2 rounded-lg text-white hover:bg-blue-800 transition">LinkedIn</button>
                        <button class="bg-green-500 px-5 py-2 rounded-lg text-white hover:bg-green-600 transition">WhatsApp</button>
                    </div>
                </div>
            </div>
        </article>
    </div>
</section>

<?php require_once '../app/views/layouts/footer.php'; ?>
