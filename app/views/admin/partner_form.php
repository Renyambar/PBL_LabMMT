<?php $page_title = isset($partner) ? 'Ubah Mitra' : 'Tambah Mitra'; require_once '../app/views/layouts/admin_header.php'; ?>

<div class="mb-6">
    <a href="<?= BASE_URL ?>/admin/partners" class="text-primary hover:text-blue-700">
        <i class="fas fa-arrow-left mr-2"></i>Kembali ke Mitra
    </a>
</div>

<div class="bg-white rounded-lg shadow-lg p-8 max-w-2xl">
    <h2 class="text-2xl font-bold mb-6"><?= isset($partner) ? 'Ubah' : 'Tambah' ?> Mitra</h2>

    <form action="<?= isset($partner) ? BASE_URL . '/admin/partners/update/' . $partner['id'] : BASE_URL . '/admin/partners/store' ?>" 
          method="POST" enctype="multipart/form-data">
        
        <!-- Name -->
        <div class="mb-6">
            <label class="block text-gray-700 font-semibold mb-2">
                <i class="fas fa-building mr-2"></i>Nama Mitra *
            </label>
            <input type="text" name="name" required
                   value="<?= $partner['name'] ?? '' ?>"
                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
                   placeholder="Masukkan nama mitra">
        </div>

        <!-- Website -->
        <div class="mb-6">
            <label class="block text-gray-700 font-semibold mb-2">
                <i class="fas fa-link mr-2"></i>URL Website
            </label>
            <input type="url" name="website"
                   value="<?= $partner['website'] ?? '' ?>"
                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
                   placeholder="https://example.com">
        </div>

        <!-- Logo -->
        <div class="mb-6">
            <label class="block text-gray-700 font-semibold mb-2">
                <i class="fas fa-image mr-2"></i>Logo Mitra
            </label>
            <?php if (isset($partner['logo']) && $partner['logo']): ?>
                <div class="mb-3 p-4 bg-gray-50 rounded inline-block">
                    <img src="<?= BASE_URL ?>/assets/img/<?= $partner['logo'] ?>" 
                         alt="Logo saat ini" 
                         class="h-24 w-auto">
                    <p class="text-sm text-gray-500 mt-1">Logo saat ini</p>
                </div>
            <?php endif; ?>
            <input type="file" name="logo" accept="image/*"
                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
            <p class="text-sm text-gray-500 mt-1">Ukuran maks: 2MB. Format: JPG, PNG, SVG (background transparan disarankan)</p>
        </div>

        <!-- Submit Buttons -->
        <div class="flex justify-end gap-4 mt-8">
            <a href="<?= BASE_URL ?>/admin/partners" 
               class="px-6 py-3 border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                Batal
            </a>
            <button type="submit" 
                    class="bg-primary text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition">
                <i class="fas fa-save mr-2"></i><?= isset($partner) ? 'Update' : 'Tambah' ?> Mitra
            </button>
        </div>
    </form>
</div>

<?php require_once '../app/views/layouts/admin_footer.php'; ?>
