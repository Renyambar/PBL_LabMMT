<?php $page_title = 'Dashboard'; require_once '../app/views/layouts/admin_header.php'; ?>

<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-lg shadow-lg p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm mb-1">Total Projects</p>
                <h3 class="text-3xl font-bold text-primary"><?= $total_projects ?></h3>
            </div>
            <div class="bg-blue-100 rounded-full p-4">
                <i class="fas fa-project-diagram text-primary text-2xl"></i>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-lg p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm mb-1">Total Articles</p>
                <h3 class="text-3xl font-bold text-green-600"><?= $total_articles ?></h3>
            </div>
            <div class="bg-green-100 rounded-full p-4">
                <i class="fas fa-newspaper text-green-600 text-2xl"></i>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-lg p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm mb-1">Gallery Items</p>
                <h3 class="text-3xl font-bold text-purple-600"><?= $total_galleries ?></h3>
            </div>
            <div class="bg-purple-100 rounded-full p-4">
                <i class="fas fa-images text-purple-600 text-2xl"></i>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-lg p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm mb-1">Partners</p>
                <h3 class="text-3xl font-bold text-orange-600"><?= $total_partners ?></h3>
            </div>
            <div class="bg-orange-100 rounded-full p-4">
                <i class="fas fa-handshake text-orange-600 text-2xl"></i>
            </div>
        </div>
    </div>
</div>

<!-- Recent Content -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <!-- Recent Projects -->
    <div class="bg-white rounded-lg shadow-lg">
        <div class="p-6 border-b">
            <h3 class="text-xl font-bold flex items-center justify-between">
                Recent Projects
                <a href="<?= BASE_URL ?>/project/create" class="text-sm bg-primary text-white px-4 py-2 rounded hover:bg-blue-700">
                    <i class="fas fa-plus mr-1"></i>Add New
                </a>
            </h3>
        </div>
        <div class="p-6">
            <?php if (!empty($recent_projects)): ?>
                <div class="space-y-4">
                    <?php foreach ($recent_projects as $project): ?>
                        <div class="flex items-center justify-between border-b pb-3">
                            <div>
                                <h4 class="font-semibold"><?= $project['title'] ?></h4>
                                <p class="text-sm text-gray-500"><?= $project['category'] ?></p>
                            </div>
                            <a href="<?= BASE_URL ?>/project/edit/<?= $project['id'] ?>" class="text-primary hover:text-blue-700">
                                <i class="fas fa-edit"></i>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
                <a href="<?= BASE_URL ?>/admin/projects" class="block text-center mt-4 text-primary hover:text-blue-700">
                    View All <i class="fas fa-arrow-right ml-1"></i>
                </a>
            <?php else: ?>
                <p class="text-gray-500 text-center py-8">No projects yet</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Recent Articles -->
    <div class="bg-white rounded-lg shadow-lg">
        <div class="p-6 border-b">
            <h3 class="text-xl font-bold flex items-center justify-between">
                Recent Articles
                <a href="<?= BASE_URL ?>/admin/articles/create" class="text-sm bg-primary text-white px-4 py-2 rounded hover:bg-blue-700">
                    <i class="fas fa-plus mr-1"></i>Add New
                </a>
            </h3>
        </div>
        <div class="p-6">
            <?php if (!empty($recent_articles)): ?>
                <div class="space-y-4">
                    <?php foreach ($recent_articles as $article): ?>
                        <div class="flex items-center justify-between border-b pb-3">
                            <div>
                                <h4 class="font-semibold"><?= $article['title'] ?></h4>
                                <p class="text-sm text-gray-500">By <?= $article['author_name'] ?></p>
                            </div>
                            <a href="<?= BASE_URL ?>/admin/articles/edit/<?= $article['id'] ?>" class="text-primary hover:text-blue-700">
                                <i class="fas fa-edit"></i>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
                <a href="<?= BASE_URL ?>/admin/articles" class="block text-center mt-4 text-primary hover:text-blue-700">
                    View All <i class="fas fa-arrow-right ml-1"></i>
                </a>
            <?php else: ?>
                <p class="text-gray-500 text-center py-8">No articles yet</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php require_once '../app/views/layouts/admin_footer.php'; ?>
