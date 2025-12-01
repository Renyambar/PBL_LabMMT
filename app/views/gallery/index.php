<?php require_once '../app/views/layouts/header.php'; ?>

<!-- Page Header -->
<section class="bg-gradient-to-r from-primary to-secondary text-white py-16">
    <div class="container mx-auto px-4">
        <h1 class="text-4xl font-bold mb-4">Galeri Multimedia</h1>
        <p class="text-xl">Dokumentasi kegiatan dan karya Lab MMT</p>
    </div>
</section>

<!-- Filter Section -->
<section class="py-8 bg-gray-100">
    <div class="container mx-auto px-4">
        <div class="flex justify-center space-x-4">
            <a href="<?= BASE_URL ?>/gallery" 
               class="px-6 py-3 rounded-lg <?= !isset($current_type) ? 'bg-primary text-white' : 'bg-white text-gray-700 hover:bg-gray-200' ?> transition">
                <i class="fas fa-th mr-2"></i>Semua
            </a>
            <a href="<?= BASE_URL ?>/gallery?type=image" 
               class="px-6 py-3 rounded-lg <?= isset($current_type) && $current_type == 'image' ? 'bg-primary text-white' : 'bg-white text-gray-700 hover:bg-gray-200' ?> transition">
                <i class="fas fa-image mr-2"></i>Foto
            </a>
            <a href="<?= BASE_URL ?>/gallery?type=video" 
               class="px-6 py-3 rounded-lg <?= isset($current_type) && $current_type == 'video' ? 'bg-primary text-white' : 'bg-white text-gray-700 hover:bg-gray-200' ?> transition">
                <i class="fas fa-video mr-2"></i>Video
            </a>
        </div>
    </div>
</section>

<!-- Gallery Grid -->
<section class="py-16">
    <div class="container mx-auto px-4">
        <?php if (!empty($galleries)): ?>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <?php foreach ($galleries as $item): ?>
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition group">
                        <div class="h-64 bg-gray-300 relative overflow-hidden">
                            <?php if ($item['media_type'] == 'image'): ?>
                                <img src="<?= BASE_URL ?>/assets/img/<?= $item['file_path'] ?>" 
                                     alt="<?= $item['title'] ?>" 
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                            <?php else: ?>
                                <div class="flex items-center justify-center h-full bg-gray-800">
                                    <i class="fas fa-play-circle text-white text-6xl"></i>
                                </div>
                            <?php endif; ?>
                            
                            <!-- Overlay -->
                            <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-60 transition-all flex items-center justify-center">
                                <div class="opacity-0 group-hover:opacity-100 transition-opacity text-white text-center p-4">
                                    <h3 class="font-bold text-lg mb-2"><?= $item['title'] ?></h3>
                                    <?php if ($item['description']): ?>
                                        <p class="text-sm"><?= substr($item['description'], 0, 60) ?>...</p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="p-4">
                            <div class="flex items-center justify-between">
                                <h3 class="font-semibold text-gray-800 truncate"><?= $item['title'] ?></h3>
                                <span class="text-xs text-gray-500">
                                    <i class="fas fa-<?= $item['media_type'] == 'image' ? 'image' : 'video' ?>"></i>
                                </span>
                            </div>
                            <p class="text-xs text-gray-500 mt-1">
                                <i class="fas fa-calendar mr-1"></i>
                                <?= date('d M Y', strtotime($item['created_at'])) ?>
                            </p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="text-center py-16">
                <i class="fas fa-images text-gray-400 text-6xl mb-4"></i>
                <p class="text-gray-500 text-xl">Belum ada media di galeri</p>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php require_once '../app/views/layouts/footer.php'; ?>
