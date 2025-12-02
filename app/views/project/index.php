<?php require_once '../app/views/layouts/header.php'; ?>

<!-- Page Header -->
<section class="bg-gradient-to-r from-black/100 via-blue-700 to-blue-600 text-white py-16">
    <div class="container mx-auto px-4">
        <h1 class="text-4xl font-bold mb-4">Portofolio Proyek</h1>
        <p class="text-xl">Koleksi karya dan inovasi digital dari Lab MMT</p>
    </div>
</section>

<!-- Filter & Search Section -->
<section class="py-8 bg-gray-100">
    <div class="container mx-auto px-4">
        <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
            <!-- Search -->
            <form action="<?= BASE_URL ?>/project" method="GET" class="flex w-full md:w-auto">
                <input type="text" name="search" placeholder="Cari proyek..." value="<?= $search ?? '' ?>" 
                       class="px-4 py-2 border border-gray-300 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-primary w-full md:w-64">
                <button type="submit" class="bg-primary text-white px-6 py-2 rounded-r-lg hover:bg-blue-700 transition">
                    <i class="fas fa-search"></i>
                </button>
            </form>

            <!-- Category Filter -->
            <div class="flex space-x-2 overflow-x-auto">
                <a href="<?= BASE_URL ?>/project" 
                   class="px-4 py-2 rounded-lg <?= !isset($current_category) ? 'bg-primary text-white' : 'bg-white text-gray-700 hover:bg-gray-200' ?> transition whitespace-nowrap">
                    Semua
                </a>
                <?php if (!empty($categories)): ?>
                    <?php foreach ($categories as $cat): ?>
                        <a href="<?= BASE_URL ?>/project?category=<?= urlencode($cat['category']) ?>" 
                           class="px-4 py-2 rounded-lg <?= isset($current_category) && $current_category == $cat['category'] ? 'bg-primary text-white' : 'bg-white text-gray-700 hover:bg-gray-200' ?> transition whitespace-nowrap">
                            <?= $cat['category'] ?>
                        </a>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<!-- Projects Grid -->
<section class="py-16">
    <div class="container mx-auto px-4">
        <?php if (!empty($projects)): ?>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <?php 
                $maxDisplay = 9;
                $displayProjects = array_slice($projects, 0, $maxDisplay);
                foreach ($displayProjects as $project): 
                ?>
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
                            <p class="text-gray-600 mb-4"><?= substr($project['description'], 0, 120) ?>...</p>
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
            </div>
            
            <?php if (count($projects) > $maxDisplay): ?>
                <!-- Button Lihat Semua Proyek -->
                <div class="text-center mt-12">
                    <button id="showAllBtn" onclick="showAllProjects()" class="bg-primary text-white px-8 py-3 rounded-lg font-semibold hover:bg-blue-700 transition shadow-lg">
                        <i class="fas fa-eye mr-2"></i>Lihat Semua Proyek (<?= count($projects) ?>)
                    </button>
                </div>
                
                <!-- Hidden Projects -->
                <div id="hiddenProjects" class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-8" style="display: none;">
                    <?php 
                    $hiddenProjects = array_slice($projects, $maxDisplay);
                    foreach ($hiddenProjects as $project): 
                    ?>
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
                                <p class="text-gray-600 mb-4"><?= substr($project['description'], 0, 120) ?>...</p>
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
                </div>
            <?php endif; ?>
        <?php else: ?>
            <div class="text-center py-16">
                <i class="fas fa-folder-open text-gray-400 text-6xl mb-4"></i>
                <p class="text-gray-500 text-xl">Tidak ada proyek ditemukan</p>
            </div>
        <?php endif; ?>
    </div>
</section>

<script>
function showAllProjects() {
    const hiddenProjects = document.getElementById('hiddenProjects');
    const showAllBtn = document.getElementById('showAllBtn');
    
    if (hiddenProjects.style.display === 'none') {
        hiddenProjects.style.display = 'grid';
        showAllBtn.innerHTML = '<i class="fas fa-eye-slash mr-2"></i>Sembunyikan';
    } else {
        hiddenProjects.style.display = 'none';
        showAllBtn.innerHTML = '<i class="fas fa-eye mr-2"></i>Lihat Semua Proyek (<?= count($projects) ?>)';
        // Scroll to projects section
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }
}
</script>

<?php require_once '../app/views/layouts/footer.php'; ?>
