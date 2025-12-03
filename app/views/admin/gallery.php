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
                <div class="relative aspect-square bg-gray-200">
                    <?php if ($item['media_type'] == 'image'): ?>
                        <img src="<?= BASE_URL ?>/uploads/gallery/<?= $item['file_path'] ?>" 
                             alt="<?= $item['title'] ?>" 
                             class="w-full h-full object-cover">
                    <?php else: ?>
                        <div class="w-full h-full flex items-center justify-center bg-gray-800">
                            <i class="fas fa-video text-white text-6xl"></i>
                        </div>
                    <?php endif; ?>
                    
                    <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-50 transition flex items-center justify-center opacity-0 group-hover:opacity-100">
                        <a href="<?= BASE_URL ?>/admin/gallery/edit/<?= $item['id'] ?>" 
                           class="bg-white text-primary px-4 py-2 rounded-lg mr-2 hover:bg-gray-100">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="<?= BASE_URL ?>/admin/gallery/delete/<?= $item['id'] ?>" 
                           onclick="return confirm('Apakah Anda yakin ingin menghapus media ini?')"
                           class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600">
                            <i class="fas fa-trash"></i>
                        </a>
                    </div>
                </div>
                
                <div class="p-4">
                    <h3 class="font-semibold text-gray-900 truncate"><?= $item['title'] ?></h3>
                    <span class="inline-block px-2 py-1 text-xs rounded-full mt-2 
                                 <?= $item['media_type'] == 'image' ? 'bg-green-100 text-green-800' : 'bg-purple-100 text-purple-800' ?>">
                        <i class="fas fa-<?= $item['media_type'] == 'image' ? 'image' : 'video' ?> mr-1"></i>
                        <?= ucfirst($item['media_type']) ?>
                    </span>
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

<?php require_once '../app/views/layouts/admin_footer.php'; ?>
