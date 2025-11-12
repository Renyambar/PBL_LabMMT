<?php require_once '../app/views/layouts/header.php'; ?>

<!-- Project Detail -->
<section class="py-16">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            <!-- Back Button -->
            <a href="<?= BASE_URL ?>/project" class="text-primary hover:text-blue-700 mb-6 inline-block">
                <i class="fas fa-arrow-left mr-2"></i>Kembali ke Proyek
            </a>

            <!-- Project Header -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-8">
                <div class="h-96 bg-gray-300">
                    <?php if ($project['thumbnail']): ?>
                        <img src="<?= BASE_URL ?>/assets/img/<?= $project['thumbnail'] ?>" alt="<?= $project['title'] ?>" class="w-full h-full object-cover">
                    <?php else: ?>
                        <div class="flex items-center justify-center h-full">
                            <i class="fas fa-image text-gray-400 text-8xl"></i>
                        </div>
                    <?php endif; ?>
                </div>
                
                <div class="p-8">
                    <div class="flex items-center justify-between mb-4">
                        <span class="bg-primary text-white px-4 py-2 rounded-full">
                            <?= $project['category'] ?>
                        </span>
                        <span class="text-gray-500">
                            <i class="fas fa-calendar mr-2"></i>
                            <?= date('d M Y', strtotime($project['created_at'])) ?>
                        </span>
                    </div>

                    <h1 class="text-4xl font-bold mb-6"><?= $project['title'] ?></h1>

                    <!-- Tags -->
                    <div class="flex flex-wrap gap-2 mb-6">
                        <?php 
                        $tags = explode(',', $project['tags']);
                        foreach ($tags as $tag): 
                        ?>
                            <span class="bg-gray-200 text-gray-700 px-3 py-1 rounded"><?= trim($tag) ?></span>
                        <?php endforeach; ?>
                    </div>

                    <!-- Description -->
                    <div class="prose max-w-none mb-8">
                        <p class="text-gray-700 text-lg leading-relaxed"><?= nl2br($project['description']) ?></p>
                    </div>

                    <!-- Video Demo -->
                    <?php if ($project['video_url']): ?>
                        <div class="mb-8">
                            <h3 class="text-2xl font-bold mb-4">Demo Video</h3>
                            <div class="aspect-video">
                                <?php if (strpos($project['video_url'], 'youtube.com') !== false || strpos($project['video_url'], 'youtu.be') !== false): ?>
                                    <?php
                                    preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([^&\n?#]+)/', $project['video_url'], $matches);
                                    $video_id = $matches[1] ?? '';
                                    ?>
                                    <iframe class="w-full h-full rounded-lg" 
                                            src="https://www.youtube.com/embed/<?= $video_id ?>" 
                                            frameborder="0" 
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                            allowfullscreen>
                                    </iframe>
                                <?php else: ?>
                                    <a href="<?= $project['video_url'] ?>" target="_blank" class="text-primary hover:text-blue-700">
                                        <i class="fas fa-play-circle mr-2"></i>Lihat Demo Video
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Share Buttons -->
                    <div class="border-t pt-6">
                        <h4 class="font-semibold mb-3">Bagikan Proyek:</h4>
                        <div class="flex space-x-3">
                            <a href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode(BASE_URL . '/project/detail/' . $project['slug']) ?>" 
                               target="_blank" 
                               class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                                <i class="fab fa-facebook mr-2"></i>Facebook
                            </a>
                            <a href="https://twitter.com/intent/tweet?url=<?= urlencode(BASE_URL . '/project/detail/' . $project['slug']) ?>&text=<?= urlencode($project['title']) ?>" 
                               target="_blank" 
                               class="bg-sky-500 text-white px-4 py-2 rounded hover:bg-sky-600 transition">
                                <i class="fab fa-twitter mr-2"></i>Twitter
                            </a>
                            <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?= urlencode(BASE_URL . '/project/detail/' . $project['slug']) ?>&title=<?= urlencode($project['title']) ?>" 
                               target="_blank" 
                               class="bg-blue-700 text-white px-4 py-2 rounded hover:bg-blue-800 transition">
                                <i class="fab fa-linkedin mr-2"></i>LinkedIn
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once '../app/views/layouts/footer.php'; ?>
