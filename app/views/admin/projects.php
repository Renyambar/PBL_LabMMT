<?php $page_title = 'Kelola Proyek'; require_once '../app/views/layouts/admin_header.php'; ?>

<div class="flex justify-between items-center mb-6">
    <h3 class="text-2xl font-bold">Semua Proyek</h3>
    <a href="<?= BASE_URL ?>/admin/projects/create" class="bg-primary text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition">
        <i class="fas fa-plus mr-2"></i>Tambah Proyek Baru
    </a>
</div>

<!-- Projects Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <?php if (!empty($projects)): ?>
        <?php foreach ($projects as $project): ?>
            <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition group">
                <!-- Thumbnail -->
                <div class="h-48 bg-gray-200 relative overflow-hidden">
                    <?php if ($project['thumbnail']): ?>
                        <img src="<?= BASE_URL ?>/assets/img/<?= $project['thumbnail'] ?>" 
                             alt="<?= $project['title'] ?>" 
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                    <?php else: ?>
                        <div class="flex items-center justify-center h-full bg-gradient-to-br from-blue-100 to-blue-200">
                            <i class="fas fa-project-diagram text-blue-300 text-6xl"></i>
                        </div>
                    <?php endif; ?>
                    
                    <!-- Category Badge -->
                    <div class="absolute top-3 right-3">
                        <span class="px-3 py-1 text-xs font-semibold rounded-full bg-blue-600 text-white shadow-lg">
                            <?= $project['category'] ?>
                        </span>
                    </div>
                </div>

                <!-- Content -->
                <div class="p-5">
                    <h3 class="font-bold text-lg text-gray-900 mb-2 line-clamp-2 min-h-[56px]">
                        <?= $project['title'] ?>
                    </h3>
                    
                    <p class="text-sm text-gray-600 mb-3 line-clamp-2">
                        <?= substr($project['description'], 0, 100) ?>...
                    </p>

                    <!-- Team Info -->
                    <?php if (!empty($project['team_name'])): ?>
                    <div class="mb-3 pb-3 border-b border-gray-100">
                        <div class="flex items-center text-sm">
                            <i class="fas fa-users text-blue-600 mr-2"></i>
                            <span class="font-semibold text-gray-700"><?= htmlspecialchars($project['team_name']) ?></span>
                        </div>
                        <?php if (!empty($project['team_members'])): ?>
                        <div class="mt-2 flex flex-wrap gap-1">
                            <?php 
                            $members = array_filter(array_map('trim', preg_split('/[\n,]+/', $project['team_members'])));
                            $displayMembers = array_slice($members, 0, 3);
                            foreach ($displayMembers as $member): 
                            ?>
                                <span class="inline-block px-2 py-1 text-xs bg-blue-50 text-blue-700 rounded">
                                    <?= htmlspecialchars($member) ?>
                                </span>
                            <?php endforeach; ?>
                            <?php if (count($members) > 3): ?>
                                <span class="inline-block px-2 py-1 text-xs bg-gray-100 text-gray-600 rounded">
                                    +<?= count($members) - 3 ?> lainnya
                                </span>
                            <?php endif; ?>
                        </div>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>

                    <!-- Technologies -->
                    <?php if (!empty($project['technologies'])): ?>
                    <div class="mb-3">
                        <div class="flex items-center text-xs text-gray-500 mb-1">
                            <i class="fas fa-laptop-code mr-1"></i>
                            <span>Teknologi:</span>
                        </div>
                        <div class="flex flex-wrap gap-1">
                            <?php 
                            $technologies = array_filter(array_map('trim', preg_split('/[\n,]+/', $project['technologies'])));
                            $displayTechs = array_slice($technologies, 0, 4);
                            foreach ($displayTechs as $tech): 
                            ?>
                                <span class="inline-block px-2 py-1 text-xs bg-orange-50 text-orange-700 rounded font-medium">
                                    <?= htmlspecialchars($tech) ?>
                                </span>
                            <?php endforeach; ?>
                            <?php if (count($technologies) > 4): ?>
                                <span class="inline-block px-2 py-1 text-xs bg-gray-100 text-gray-600 rounded">
                                    +<?= count($technologies) - 4 ?>
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endif; ?>

                    <!-- Supervisor & Client -->
                    <div class="mb-3 space-y-1 text-xs">
                        <?php if (!empty($project['supervisor'])): ?>
                        <div class="flex items-center text-gray-600">
                            <i class="fas fa-chalkboard-teacher text-green-600 mr-2 w-4"></i>
                            <span class="truncate"><?= htmlspecialchars($project['supervisor']) ?></span>
                        </div>
                        <?php endif; ?>
                        <?php if (!empty($project['client'])): ?>
                        <div class="flex items-center text-gray-600">
                            <i class="fas fa-building text-purple-600 mr-2 w-4"></i>
                            <span class="truncate"><?= htmlspecialchars($project['client']) ?></span>
                        </div>
                        <?php endif; ?>
                    </div>

                    <!-- Meta Info -->
                    <div class="flex items-center justify-between text-xs text-gray-500 mb-4">
                        <span>
                            <i class="fas fa-calendar mr-1"></i>
                            <?= date('d M Y', strtotime($project['created_at'])) ?>
                        </span>
                        <span class="font-semibold text-gray-600">ID: <?= $project['id'] ?></span>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex gap-2">
                        <a href="<?= BASE_URL ?>/admin/projects/edit/<?= $project['id'] ?>" 
                           class="flex-1 text-center bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition">
                            <i class="fas fa-edit mr-1"></i>Edit
                        </a>
                        <a href="<?= BASE_URL ?>/admin/projects/delete/<?= $project['id'] ?>" 
                           onclick="return confirm('Apakah Anda yakin ingin menghapus proyek ini?\n\nProyek: <?= addslashes($project['title']) ?>')"
                           class="flex-1 text-center bg-red-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-red-700 transition">
                            <i class="fas fa-trash mr-1"></i>Hapus
                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="col-span-full bg-white rounded-lg shadow-lg p-12 text-center">
            <i class="fas fa-folder-open text-6xl mb-4 text-gray-300"></i>
            <p class="text-lg text-gray-500 mb-4">Tidak ada proyek ditemukan</p>
            <a href="<?= BASE_URL ?>/admin/projects/create" class="inline-block bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition">
                <i class="fas fa-plus mr-2"></i>Buat Proyek Pertama
            </a>
        </div>
    <?php endif; ?>
</div>

<?php require_once '../app/views/layouts/admin_footer.php'; ?>
