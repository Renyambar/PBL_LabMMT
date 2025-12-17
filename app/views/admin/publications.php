<?php $page_title = 'Kelola Publikasi'; require_once '../app/views/layouts/admin_header.php'; ?>

<div class="flex justify-between items-center mb-6">
    <h3 class="text-2xl font-bold">Publikasi Ilmiah</h3>
    <a href="<?= BASE_URL ?>/admin/publication/create" class="bg-primary text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition">
        <i class="fas fa-plus mr-2"></i>Tambah Publikasi
    </a>
</div>

<?php if (isset($_SESSION['message'])): ?>
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg">
        <div class="flex items-center">
            <i class="fas fa-check-circle mr-3"></i>
            <span><?= $_SESSION['message']; unset($_SESSION['message']); ?></span>
        </div>
    </div>
<?php endif; ?>

<?php if (isset($_SESSION['error'])): ?>
    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-lg">
        <div class="flex items-center">
            <i class="fas fa-exclamation-circle mr-3"></i>
            <span><?= $_SESSION['error']; unset($_SESSION['error']); ?></span>
        </div>
    </div>
<?php endif; ?>

<div class="bg-white rounded-lg shadow-lg overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">Tipe</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Penulis</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">Tanggal</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">PDF</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <?php if (!empty($data['publications'])): ?>
                    <?php foreach ($data['publications'] as $pub): ?>
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-gray-900 max-w-md">
                                    <?= htmlspecialchars($pub['title'] ?? '') ?>
                                </div>
                                <?php if (!empty($pub['journal_name'])): ?>
                                    <div class="text-xs text-gray-500 mt-1">
                                        <i class="fas fa-book mr-1"></i><?= htmlspecialchars($pub['journal_name']) ?>
                                    </div>
                                <?php elseif (!empty($pub['conference_name'])): ?>
                                    <div class="text-xs text-gray-500 mt-1">
                                        <i class="fas fa-chalkboard-teacher mr-1"></i><?= htmlspecialchars($pub['conference_name']) ?>
                                    </div>
                                <?php endif; ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                    <?= htmlspecialchars($pub['publication_type'] ?? '') ?>
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-900 max-w-xs truncate">
                                    <?= htmlspecialchars($pub['authors'] ?? '') ?>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <?= !empty($pub['publication_date']) ? date('d/m/Y', strtotime($pub['publication_date'])) : '-' ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <?php if (!empty($pub['pdf_file'])): ?>
                                    <a href="<?= BASE_URL ?>/assets/pdf/publications/<?= $pub['pdf_file'] ?>" 
                                       target="_blank"
                                       class="text-red-600 hover:text-red-900">
                                        <i class="fas fa-file-pdf"></i>
                                    </a>
                                <?php else: ?>
                                    <span class="text-gray-400">-</span>
                                <?php endif; ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="<?= BASE_URL ?>/publication/detail/<?= $pub['slug'] ?>" 
                                   target="_blank"
                                   class="text-green-600 hover:text-green-900 mr-3" 
                                   title="Lihat">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="<?= BASE_URL ?>/admin/publication/edit/<?= $pub['id'] ?>" 
                                   class="text-blue-600 hover:text-blue-900 mr-3" 
                                   title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="<?= BASE_URL ?>/admin/publication/delete/<?= $pub['id'] ?>" 
                                   class="text-red-600 hover:text-red-900" 
                                   onclick="return confirm('Yakin ingin menghapus publikasi ini?')"
                                   title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                            <i class="fas fa-book-open text-4xl mb-4 block text-gray-300"></i>
                            Belum ada publikasi. <a href="<?= BASE_URL ?>/admin/publication/create" class="text-blue-600 hover:text-blue-800">Tambah publikasi pertama</a>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once '../app/views/layouts/admin_footer.php'; ?>
