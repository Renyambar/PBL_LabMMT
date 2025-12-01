<?php $page_title = 'Manage Partners'; require_once '../app/views/layouts/admin_header.php'; ?>

<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold">Partners Management</h2>
    <a href="<?= BASE_URL ?>/admin/partners/create" class="bg-primary text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition">
        <i class="fas fa-plus mr-2"></i>Add New Partner
    </a>
</div>

<!-- Partners Grid -->
<div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
    <?php if (!empty($partners)): ?>
        <?php foreach ($partners as $partner): ?>
            <div class="bg-white rounded-lg shadow-lg overflow-hidden group">
                <div class="aspect-video bg-gray-100 flex items-center justify-center p-6">
                    <?php if ($partner['logo']): ?>
                        <img src="<?= BASE_URL ?>/uploads/partners/<?= $partner['logo'] ?>" 
                             alt="<?= $partner['name'] ?>" 
                             class="max-w-full max-h-full object-contain">
                    <?php else: ?>
                        <i class="fas fa-building text-gray-300 text-6xl"></i>
                    <?php endif; ?>
                </div>
                
                <div class="p-4">
                    <h3 class="font-semibold text-gray-900 truncate mb-1"><?= $partner['name'] ?></h3>
                    <?php if ($partner['website']): ?>
                        <a href="<?= $partner['website'] ?>" target="_blank" 
                           class="text-sm text-primary hover:underline truncate block">
                            <i class="fas fa-external-link-alt mr-1"></i>Visit Website
                        </a>
                    <?php endif; ?>
                    
                    <div class="flex gap-2 mt-4">
                        <a href="<?= BASE_URL ?>/admin/partners/edit/<?= $partner['id'] ?>" 
                           class="flex-1 text-center bg-indigo-600 text-white px-3 py-2 rounded hover:bg-indigo-700 text-sm">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <a href="<?= BASE_URL ?>/admin/partners/delete/<?= $partner['id'] ?>" 
                           onclick="return confirm('Are you sure you want to delete this partner?')"
                           class="flex-1 text-center bg-red-600 text-white px-3 py-2 rounded hover:bg-red-700 text-sm">
                            <i class="fas fa-trash"></i> Delete
                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="col-span-full bg-white rounded-lg shadow-lg p-12 text-center">
            <i class="fas fa-handshake text-6xl mb-4 text-gray-300"></i>
            <p class="text-lg text-gray-500">No partners found</p>
            <a href="<?= BASE_URL ?>/admin/partners/create" class="text-primary hover:underline mt-2 inline-block">
                Add your first partner
            </a>
        </div>
    <?php endif; ?>
</div>

<?php require_once '../app/views/layouts/admin_footer.php'; ?>
