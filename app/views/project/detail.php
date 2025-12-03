<?php require_once '../app/views/layouts/header.php'; ?>

<!-- Project Detail -->
<section class="py-16">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            <!-- Back Button -->
            <a href="<?= BASE_URL ?>/project" class="text-blue-600 hover:text-blue-700 mb-6 inline-block">
                <i class="fas fa-arrow-left mr-2"></i>Kembali ke Proyek
            </a>

            <!-- Success/Error Messages -->
            <?php if (isset($_SESSION['message'])): ?>
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                    <i class="fas fa-check-circle mr-2"></i>
                    <?= $_SESSION['message']; unset($_SESSION['message']); ?>
                </div>
            <?php endif; ?>

            <?php if (isset($_SESSION['error'])): ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                    <i class="fas fa-exclamation-circle mr-2"></i>
                    <?= $_SESSION['error']; unset($_SESSION['error']); ?>
                </div>
            <?php endif; ?>

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
                        <span class="bg-[#0F3A75] text-white px-4 py-2 rounded-full">
                            <?= $project['category'] ?>
                        </span>
                        <span class="text-gray-500">
                            <i class="fas fa-calendar mr-2"></i>
                            <?= date('d M Y', strtotime($project['created_at'])) ?>
                        </span>
                    </div>

                    <h1 class="text-4xl font-bold mb-6"><?= $project['title'] ?></h1>

                    <?php if (!empty($project['team_name']) || !empty($project['team_members'])): ?>
                    <!-- Team Info -->
                    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border-l-4 border-[#0F3A75] rounded-lg p-5 mb-6">
                        <div class="flex items-start">
                            <div class="bg-[#0F3A75] text-white rounded-full p-3 mr-4">
                                <i class="fas fa-users text-xl"></i>
                            </div>
                            <div class="flex-1">
                                <?php if (!empty($project['team_name'])): ?>
                                <h3 class="text-lg font-bold text-gray-800 mb-2"><?= $project['team_name'] ?></h3>
                                <?php endif; ?>
                                
                                <?php if (!empty($project['team_members'])): ?>
                                <div class="text-sm text-gray-600 mb-1 font-semibold">Anggota Tim:</div>
                                <div class="flex flex-wrap gap-2">
                                    <?php 
                                    // Split by newline or comma
                                    $members = preg_split('/[\n,]+/', $project['team_members']);
                                    foreach ($members as $member): 
                                        $member = trim($member);
                                        if (!empty($member)):
                                    ?>
                                        <span class="inline-flex items-center bg-white text-gray-700 px-3 py-1 rounded-full text-sm border border-gray-200">
                                            <i class="fas fa-user text-[#0F3A75] mr-2 text-xs"></i>
                                            <?= htmlspecialchars($member) ?>
                                        </span>
                                    <?php 
                                        endif;
                                    endforeach; 
                                    ?>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>

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
                                    <a href="<?= $project['video_url'] ?>" target="_blank" class="text-blue-600 hover:text-blue-700">
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

            <!-- Ratings Section -->
            <div class="bg-white rounded-lg shadow-lg p-8 mb-8">
                <h2 class="text-3xl font-bold mb-6">Ratings & Reviews</h2>
                
                <!-- Rating Summary -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                    <div class="text-center">
                        <div class="text-6xl font-bold text-[#0F3A75] mb-2">
                            <?= number_format($avg_rating, 1) ?>
                        </div>
                        <div class="text-yellow-400 text-3xl mb-2">
                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                <i class="fas fa-star<?= $i <= round($avg_rating) ? '' : '-o' ?>"></i>
                            <?php endfor; ?>
                        </div>
                        <p class="text-gray-600"><?= $total_ratings ?> ratings</p>
                    </div>
                    
                    <div>
                        <?php if ($rating_stats): ?>
                            <?php for ($i = 5; $i >= 1; $i--): ?>
                                <?php 
                                $count_field = ['one_star', 'two_star', 'three_star', 'four_star', 'five_star'][$i-1];
                                $count = $rating_stats[$count_field] ?? 0;
                                $percentage = $total_ratings > 0 ? ($count / $total_ratings) * 100 : 0;
                                ?>
                                <div class="flex items-center mb-2">
                                    <span class="text-sm w-12"><?= $i ?> <i class="fas fa-star text-yellow-400"></i></span>
                                    <div class="flex-1 mx-3 bg-gray-200 rounded-full h-4">
                                        <div class="bg-yellow-400 h-4 rounded-full" style="width: <?= $percentage ?>%"></div>
                                    </div>
                                    <span class="text-sm w-12 text-right"><?= $count ?></span>
                                </div>
                            <?php endfor; ?>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Rate This Project Form -->
                <div class="border-t pt-6">
                    <h3 class="text-xl font-bold mb-4">Rate This Project</h3>
                    <form action="<?= BASE_URL ?>/project/rate/<?= $project['id'] ?>" method="POST" class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">
                                    Your Name <span class="text-sm text-gray-500">(Optional - leave blank for Anonymous)</span>
                                </label>
                                <input type="text" name="contributor_name"
                                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
                                       placeholder="Anonymous">
                            </div>
                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">
                                    Your Email <span class="text-sm text-gray-500">(Optional)</span>
                                </label>
                                <input type="email" name="contributor_email"
                                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
                                       placeholder="your@email.com">
                            </div>
                        </div>
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Your Rating *</label>
                            <div class="flex space-x-2">
                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                    <label class="cursor-pointer">
                                        <input type="radio" name="rating" value="<?= $i ?>" required class="hidden peer">
                                        <i class="fas fa-star text-4xl text-gray-300 peer-checked:text-yellow-400 hover:text-yellow-400"></i>
                                    </label>
                                <?php endfor; ?>
                            </div>
                        </div>
                        <button type="submit" class="bg-[#0F3A75] text-white px-6 py-3 rounded-lg hover:bg-[#0C2F61] transition">
                            <i class="fas fa-star mr-2"></i>Submit Rating
                        </button>
                    </form>
                </div>
            </div>

            <!-- Comments Section -->
            <div class="bg-white rounded-lg shadow-lg p-8 mb-8">
                <h2 class="text-3xl font-bold mb-6">Comments (<?= $total_comments ?>)</h2>
                
                <!-- Comments List -->
                <?php if (!empty($comments)): ?>
                    <div class="space-y-6 mb-8">
                        <?php foreach ($comments as $comment): ?>
                            <div class="border-b pb-6 last:border-0">
                                <div class="flex items-start space-x-4">
                                    <div class="w-12 h-12 bg-[#0F3A75] rounded-full flex items-center justify-center text-white font-bold text-xl">
                                        <?= strtoupper(substr($comment['contributor_name'], 0, 1)) ?>
                                    </div>
                                    <div class="flex-1">
                                        <h4 class="font-bold text-lg"><?= htmlspecialchars($comment['contributor_name']) ?></h4>
                                        <p class="text-sm text-gray-500 mb-2">
                                            <i class="fas fa-clock mr-1"></i>
                                            <?= date('d M Y, H:i', strtotime($comment['created_at'])) ?>
                                        </p>
                                        <p class="text-gray-700"><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <p class="text-gray-500 text-center py-8">No comments yet. Be the first to comment!</p>
                <?php endif; ?>

                <!-- Add Comment Form -->
                <div class="border-t pt-6">
                    <h3 class="text-xl font-bold mb-4">Add Your Comment</h3>
                    <form action="<?= BASE_URL ?>/project/comment/<?= $project['id'] ?>" method="POST" class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">
                                    Your Name <span class="text-sm text-gray-500">(Optional - leave blank for Anonymous)</span>
                                </label>
                                <input type="text" name="contributor_name"
                                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
                                       placeholder="Anonymous">
                            </div>
                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">
                                    Your Email <span class="text-sm text-gray-500">(Optional)</span>
                                </label>
                                <input type="email" name="contributor_email"
                                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
                                       placeholder="your@email.com">
                            </div>
                        </div>
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Your Comment *</label>
                            <textarea name="comment" required rows="4" minlength="10"
                                      class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
                                      placeholder="Share your thoughts about this project... (minimum 10 characters)"></textarea>
                        </div>
                        <p class="text-sm text-gray-500">
                            <i class="fas fa-info-circle mr-1"></i>
                            Your comment will be published after admin approval.
                        </p>
                        <button type="submit" class="bg-[#0F3A75] text-white px-6 py-3 rounded-lg hover:bg-[#0C2F61] transition">
                            <i class="fas fa-comment mr-2"></i>Submit Comment
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once '../app/views/layouts/footer.php'; ?>
