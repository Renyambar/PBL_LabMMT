<?php require_once '../app/views/layouts/header.php'; ?>

<!-- Page Header -->
<section class="bg-gradient-to-r from-black/100 via-blue-800 to-blue-600 text-white py-16">
    <div class="container mx-auto px-4" data-aos="fade-down">
        <h1 class="text-4xl font-bold mb-4">Galeri Multimedia</h1>
        <p class="text-xl">Dokumentasi kegiatan dan karya Lab MMT</p>
    </div>
</section>

<!-- Filter Section -->
<section class="py-8 bg-gray-100">
    <div class="container mx-auto px-4" data-aos="zoom-in">
        <div class="flex justify-center space-x-4">
            <a href="<?= BASE_URL ?>/gallery" 
               class="px-6 py-3 rounded-lg <?= !isset($current_type) ? 'bg-[#0F3A75] text-white' : 'bg-white text-gray-700 hover:bg-gray-200' ?> transition">
                <i class="fas fa-th mr-2"></i>Semua
            </a>
            <a href="<?= BASE_URL ?>/gallery?type=image" 
               class="px-6 py-3 rounded-lg <?= isset($current_type) && $current_type == 'image' ? 'bg-[#0F3A75] text-white' : 'bg-white text-gray-700 hover:bg-gray-200' ?> transition">
                <i class="fas fa-image mr-2"></i>Foto
            </a>
            <a href="<?= BASE_URL ?>/gallery?type=video" 
               class="px-6 py-3 rounded-lg <?= isset($current_type) && $current_type == 'video' ? 'bg-[#0F3A75] text-white' : 'bg-white text-gray-700 hover:bg-gray-200' ?> transition">
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
                <?php foreach ($galleries as $index => $item): ?>
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition group cursor-pointer" data-aos="flip-up" data-aos-delay="<?= ($index % 8) * 100 ?>"
                         onclick="openMedia('<?= $item['media_type'] ?>', '<?= BASE_URL ?>/assets/img/<?= $item['file_path'] ?>', '<?= addslashes($item['title']) ?>', '<?= addslashes($item['description'] ?? '') ?>')">
                        <div class="h-64 bg-gray-300 relative overflow-hidden">
                            <?php if ($item['media_type'] == 'image'): ?>
                                <img src="<?= BASE_URL ?>/assets/img/<?= $item['file_path'] ?>" 
                                     alt="<?= $item['title'] ?>" 
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                            <?php else: ?>
                                <video class="w-full h-full object-cover" muted>
                                    <source src="<?= BASE_URL ?>/assets/img/<?= $item['file_path'] ?>" type="video/<?= pathinfo($item['file_path'], PATHINFO_EXTENSION) ?>">
                                </video>
                                <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-40">
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
                                    <p class="text-xs mt-2">
                                        <i class="fas fa-<?= $item['media_type'] == 'image' ? 'search-plus' : 'play' ?> mr-1"></i>
                                        Klik untuk <?= $item['media_type'] == 'image' ? 'memperbesar' : 'memutar' ?>
                                    </p>
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

<!-- Media Modal -->
<div id="mediaModal" class="fixed inset-0 bg-black bg-opacity-90 z-50 hidden flex items-center justify-center p-4">
    <div class="max-w-6xl w-full">
        <div class="flex justify-end mb-4">
            <button onclick="closeMedia()" class="text-white hover:text-gray-300 text-3xl">
                <i class="fas fa-times"></i>
            </button>
        </div>
        
        <div id="mediaContent" class="bg-white rounded-lg overflow-hidden">
            <!-- Content will be inserted here -->
        </div>
        
        <div id="mediaInfo" class="text-white mt-4 text-center">
            <h3 id="mediaTitle" class="text-2xl font-bold mb-2"></h3>
            <p id="mediaDescription" class="text-gray-300"></p>
        </div>
    </div>
</div>

<script>
function openMedia(type, path, title, description) {
    const modal = document.getElementById('mediaModal');
    const content = document.getElementById('mediaContent');
    const titleEl = document.getElementById('mediaTitle');
    const descEl = document.getElementById('mediaDescription');
    
    titleEl.textContent = title;
    descEl.textContent = description;
    
    if (type === 'image') {
        content.innerHTML = `<img src="${path}" alt="${title}" class="w-full h-auto max-h-[80vh] object-contain">`;
    } else {
        content.innerHTML = `
            <video controls autoplay class="w-full h-auto max-h-[80vh]" controlsList="nodownload">
                <source src="${path}" type="video/${path.split('.').pop()}">
                Browser Anda tidak mendukung video.
            </video>
        `;
    }
    
    modal.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeMedia() {
    const modal = document.getElementById('mediaModal');
    const content = document.getElementById('mediaContent');
    
    // Stop video if playing
    const video = content.querySelector('video');
    if (video) {
        video.pause();
        video.currentTime = 0;
    }
    
    modal.classList.add('hidden');
    document.body.style.overflow = 'auto';
    content.innerHTML = '';
}

// Close on ESC key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeMedia();
    }
});

// Close when clicking outside
document.getElementById('mediaModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeMedia();
    }
});
</script>

<?php require_once '../app/views/layouts/footer.php'; ?>
