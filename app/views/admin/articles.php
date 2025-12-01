<?php $page_title = 'Manage Articles'; require_once '../app/views/layouts/admin_header.php'; ?>

<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold">Articles Management</h2>
    <a href="<?= BASE_URL ?>/admin/articles/create" class="bg-primary text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition">
        <i class="fas fa-plus mr-2"></i>Add New Article
    </a>
</div>

<!-- Search -->
<div class="bg-white rounded-lg shadow-lg p-6 mb-6">
    <form method="GET" class="flex gap-4">
        <input type="text" name="search" placeholder="Search articles..." 
               value="<?= $_GET['search'] ?? '' ?>"
               class="flex-1 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
        
        <button type="submit" class="bg-primary text-white px-6 py-2 rounded-lg hover:bg-blue-700">
            <i class="fas fa-search mr-2"></i>Search
        </button>
    </form>
</div>

<!-- Articles Table -->
<div class="bg-white rounded-lg shadow-lg overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Thumbnail</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Author</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Published</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            <?php if (!empty($articles)): ?>
                <?php foreach ($articles as $article): ?>
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <?php if ($article['thumbnail']): ?>
                                <img src="<?= BASE_URL ?>/uploads/articles/<?= $article['thumbnail'] ?>" 
                                     alt="<?= $article['title'] ?>" 
                                     class="h-16 w-16 object-cover rounded">
                            <?php else: ?>
                                <div class="h-16 w-16 bg-gray-200 rounded flex items-center justify-center">
                                    <i class="fas fa-newspaper text-gray-400"></i>
                                </div>
                            <?php endif; ?>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm font-medium text-gray-900"><?= $article['title'] ?></div>
                            <div class="text-sm text-gray-500"><?= substr(strip_tags($article['content']), 0, 80) ?>...</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <?= $article['author_name'] ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <?= date('d M Y', strtotime($article['created_at'])) ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="<?= BASE_URL ?>/admin/articles/edit/<?= $article['id'] ?>" 
                               class="text-indigo-600 hover:text-indigo-900 mr-3">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <a href="<?= BASE_URL ?>/admin/articles/delete/<?= $article['id'] ?>" 
                               onclick="return confirm('Are you sure you want to delete this article?')"
                               class="text-red-600 hover:text-red-900">
                                <i class="fas fa-trash"></i> Delete
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                        <i class="fas fa-file-alt text-6xl mb-4 text-gray-300"></i>
                        <p class="text-lg">No articles found</p>
                        <a href="<?= BASE_URL ?>/admin/articles/create" class="text-primary hover:underline mt-2 inline-block">
                            Write your first article
                        </a>
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php require_once '../app/views/layouts/admin_footer.php'; ?>
