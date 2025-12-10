<?php $page_title = 'Kelola Galeri'; require_once '../app/views/layouts/admin_header.php'; ?>

<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold">Manajemen Galeri</h2>
    <a href="<?= BASE_URL ?>/admin/gallery/create" class="bg-primary text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition">
        <i class="fas fa-plus mr-2"></i>Tambah Media Baru
    </a>
</div>

<!-- Filter -->
<div class="bg-white rounded-lg shadow-lg p-6 mb-6">
    <form method="GET" class="flex gap-4">
        <select name="type" class="flex-1 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
            <option value="">Semua Jenis Media</option>
            <option value="image" <?= (($_GET['type'] ?? '') == 'image') ? 'selected' : '' ?>>Gambar</option>
            <option value="video" <?= (($_GET['type'] ?? '') == 'video') ? 'selected' : '' ?>>Video</option>
        </select>
        
        <button type="submit" class="bg-primary text-white px-6 py-2 rounded-lg hover:bg-blue-700">
            <i class="fas fa-filter mr-2"></i>Filter
        </button>
    </form>
</div>

<!-- Gallery Grid -->
<div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
    <?php if (!empty($galleries)): ?>
        <?php foreach ($galleries as $item): ?>
            <div class="bg-white rounded-lg shadow-lg overflow-hidden group">
                <div class="relative aspect-square bg-gray-200 cursor-pointer"
                     onclick="openMedia('<?= $item['media_type'] ?>', '<?= BASE_URL ?>/assets/img/<?= $item['file_path'] ?>', '<?= addslashes($item['title']) ?>', '<?= addslashes($item['description'] ?? '') ?>')">
                    <?php if ($item['media_type'] == 'image'): ?>
                        <img src="<?= BASE_URL ?>/assets/img/<?= $item['file_path'] ?>" 
                             alt="<?= $item['title'] ?>" 
                             class="w-full h-48 object-cover">
                    <?php else: ?>
                        <video class="w-full h-48 object-cover" muted>
                            <source src="<?= BASE_URL ?>/assets/img/<?= $item['file_path'] ?>" type="video/<?= pathinfo($item['file_path'], PATHINFO_EXTENSION) ?>">
                        </video>
                        <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-40">
                            <i class="fas fa-play-circle text-white text-6xl"></i>
                        </div>
                    <?php endif; ?>
                    
                    <!-- Preview overlay -->
                    <div class="absolute top-2 right-2 bg-black bg-opacity-60 px-2 py-1 rounded text-white text-xs">
                        <i class="fas fa-<?= $item['media_type'] == 'image' ? 'search-plus' : 'play' ?> mr-1"></i>
                        Lihat
                    </div>
                </div>
                
                <div class="p-4">
                    <h3 class="font-semibold text-gray-900 truncate"><?= $item['title'] ?></h3>
                    <span class="inline-block px-2 py-1 text-xs rounded-full mt-2 
                                 <?= $item['media_type'] == 'image' ? 'bg-green-100 text-green-800' : 'bg-purple-100 text-purple-800' ?>">
                        <i class="fas fa-<?= $item['media_type'] == 'image' ? 'image' : 'video' ?> mr-1"></i>
                        <?= ucfirst($item['media_type']) ?>
                    </span>
                    
                    <!-- Action buttons -->
                    <div class="flex gap-2 mt-3">
                        <a href="<?= BASE_URL ?>/admin/gallery/edit/<?= $item['id'] ?>" 
                           class="flex-1 text-center bg-primary text-white px-3 py-2 rounded-lg text-sm hover:bg-blue-700 transition">
                            <i class="fas fa-edit mr-1"></i>Edit
                        </a>
                        <a href="<?= BASE_URL ?>/admin/gallery/delete/<?= $item['id'] ?>" 
                           onclick="return confirm('Apakah Anda yakin ingin menghapus media ini?')"
                           class="flex-1 text-center bg-red-500 text-white px-3 py-2 rounded-lg text-sm hover:bg-red-600 transition">
                            <i class="fas fa-trash mr-1"></i>Hapus
                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="col-span-full bg-white rounded-lg shadow-lg p-12 text-center">
            <i class="fas fa-images text-6xl mb-4 text-gray-300"></i>
            <p class="text-lg text-gray-500">Tidak ada media ditemukan</p>
            <a href="<?= BASE_URL ?>/admin/gallery/create" class="text-primary hover:underline mt-2 inline-block">
                Unggah media pertama Anda
            </a>
        </div>
    <?php endif; ?>
</div>

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

<?php require_once '../app/views/layouts/admin_footer.php'; ?>
