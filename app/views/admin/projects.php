<?php $page_title = 'Kelola Proyek'; require_once '../app/views/layouts/admin_header.php'; ?>

<div class="flex justify-between items-center mb-6">
    <h3 class="text-2xl font-bold">Semua Proyek</h3>
    <a href="<?= BASE_URL ?>/admin/projects/create" class="bg-primary text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition">
        <i class="fas fa-plus mr-2"></i>Tambah Proyek Baru
    </a>
</div>

<!-- Projects Table -->
<div class="bg-white rounded-lg shadow-lg overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50 border-b">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Thumbnail</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dibuat</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <?php if (!empty($projects)): ?>
                    <?php foreach ($projects as $project): ?>
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= $project['id'] ?></td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <?php if ($project['thumbnail']): ?>
                                    <img src="<?= BASE_URL ?>/assets/img/<?= $project['thumbnail'] ?>" 
                                         alt="<?= $project['title'] ?>" 
                                         class="w-16 h-16 object-cover rounded">
                                <?php else: ?>
                                    <div class="w-16 h-16 bg-gray-200 rounded flex items-center justify-center">
                                        <i class="fas fa-image text-gray-400"></i>
                                    </div>
                                <?php endif; ?>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-gray-900"><?= $project['title'] ?></div>
                                <div class="text-sm text-gray-500"><?= substr($project['description'], 0, 50) ?>...</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                    <?= $project['category'] ?>
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <?= date('d M Y', strtotime($project['created_at'])) ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="<?= BASE_URL ?>/admin/projects/edit/<?= $project['id'] ?>" 
                                   class="text-indigo-600 hover:text-indigo-900 mr-3">
                                    <i class="fas fa-edit"></i> Ubah
                                </a>
                                <a href="<?= BASE_URL ?>/admin/projects/delete/<?= $project['id'] ?>" 
                                   onclick="return confirm('Apakah Anda yakin ingin menghapus proyek ini?')"
                                   class="text-red-600 hover:text-red-900">
                                    <i class="fas fa-trash"></i> Hapus
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                            <i class="fas fa-folder-open text-6xl mb-4 text-gray-300"></i>
                            <p class="text-lg">Tidak ada proyek ditemukan</p>
                            <a href="<?= BASE_URL ?>/admin/projects/create" class="text-primary hover:underline mt-2 inline-block">
                                Buat proyek pertama Anda
                            </a>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once '../app/views/layouts/admin_footer.php'; ?>
