<?php $page_title = (isset($data['member']) ? 'Edit' : 'Tambah') . ' Anggota Tim'; require_once '../app/views/layouts/admin_header.php'; ?>

<div class="mb-6">
    <nav class="text-sm text-gray-500 mb-4">
        <a href="<?= BASE_URL ?>/admin" class="hover:text-primary">Dashboard</a>
        <span class="mx-2">/</span>
        <a href="<?= BASE_URL ?>/admin/lab_profile" class="hover:text-primary">Profil Lab</a>
        <span class="mx-2">/</span>
        <span class="text-gray-700"><?= isset($data['member']) ? 'Edit' : 'Tambah' ?> Anggota Tim</span>
    </nav>
    <h3 class="text-2xl font-bold"><?= isset($data['member']) ? 'Edit' : 'Tambah' ?> Anggota Tim</h3>
</div>

<?php if (isset($_SESSION['error'])): ?>
    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-lg">
        <div class="flex items-center">
            <i class="fas fa-exclamation-circle mr-3"></i>
            <span><?= $_SESSION['error']; unset($_SESSION['error']); ?></span>
        </div>
    </div>
<?php endif; ?>

<div class="bg-white rounded-lg shadow-lg p-6">
    <form action="<?= isset($data['member']) ? BASE_URL . '/admin/team_member_update/' . $data['member']['id'] : BASE_URL . '/admin/team_member_store' ?>" 
          method="POST" enctype="multipart/form-data">
        
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                Nama Lengkap <span class="text-red-600">*</span>
            </label>
            <input type="text" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent" 
                   id="name" name="name" 
                   value="<?= isset($data['member']) ? htmlspecialchars($data['member']['name']) : '' ?>" 
                   required>
        </div>

        <div class="mb-4">
            <label for="position" class="block text-sm font-medium text-gray-700 mb-2">
                Jabatan <span class="text-red-600">*</span>
            </label>
            <input type="text" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent" 
                   id="position" name="position" 
                   value="<?= isset($data['member']) ? htmlspecialchars($data['member']['position']) : '' ?>" 
                   placeholder="Contoh: Kepala Laboratorium, Asisten Peneliti, dll." 
                   required>
        </div>

        <div class="mb-4">
            <label for="photo" class="block text-sm font-medium text-gray-700 mb-2">Foto</label>
            <?php if (isset($data['member']) && $data['member']['photo']): ?>
            <div class="mb-3">
                <img src="<?= BASE_URL ?>/assets/img/team/<?= htmlspecialchars($data['member']['photo']) ?>" 
                     alt="Foto saat ini" 
                     class="w-32 h-32 rounded-lg object-cover border-2 border-gray-200">
                <p class="text-sm text-gray-500 mt-2">Foto saat ini (biarkan kosong untuk mempertahankan)</p>
            </div>
            <?php endif; ?>
            <input type="file" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent" 
                   id="photo" name="photo" accept="image/*">
            <p class="text-sm text-gray-500 mt-1">
                Rekomendasi: Gambar persegi (500x500px), Maks 2MB, format JPG/PNG
            </p>
        </div>

        <div class="mb-4">
            <label class="flex items-center">
                <input type="checkbox" class="w-5 h-5 text-primary border-gray-300 rounded focus:ring-primary" 
                       id="is_head" name="is_head" value="1"
                       <?= isset($data['member']) && $data['member']['is_head'] ? 'checked' : '' ?>>
                <span class="ml-2 text-sm font-medium text-gray-700">Kepala Laboratorium</span>
            </label>
            <p class="text-sm text-gray-500 ml-7 mt-1">Centang jika orang ini adalah kepala laboratorium</p>
        </div>

        <div class="mb-6">
            <label for="display_order" class="block text-sm font-medium text-gray-700 mb-2">
                Urutan Tampilan <span class="text-red-600">*</span>
            </label>
            <input type="number" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent" 
                   id="display_order" name="display_order" 
                   value="<?= isset($data['member']) ? $data['member']['display_order'] : '0' ?>" 
                   min="0" required>
            <p class="text-sm text-gray-500 mt-1">
                Angka lebih kecil muncul lebih dulu (0 = posisi pertama)
            </p>
        </div>

        <div class="flex gap-3">
            <button type="submit" class="px-6 py-3 bg-primary text-white rounded-lg hover:bg-blue-700 transition">
                <i class="fas fa-save mr-2"></i><?= isset($data['member']) ? 'Perbarui' : 'Simpan' ?>
            </button>
            <a href="<?= BASE_URL ?>/admin/lab_profile" class="px-6 py-3 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition">
                <i class="fas fa-times mr-2"></i>Batal
            </a>
        </div>
    </form>
</div>


<?php require_once '../app/views/layouts/admin_footer.php'; ?>
