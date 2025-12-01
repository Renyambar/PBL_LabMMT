<?php $page_title = isset($article) ? 'Edit Article' : 'Create Article'; require_once '../app/views/layouts/admin_header.php'; ?>

<div class="mb-6">
    <a href="<?= BASE_URL ?>/admin/articles" class="text-primary hover:text-blue-700">
        <i class="fas fa-arrow-left mr-2"></i>Back to Articles
    </a>
</div>

<div class="bg-white rounded-lg shadow-lg p-8">
    <h2 class="text-2xl font-bold mb-6"><?= isset($article) ? 'Edit' : 'Write New' ?> Article</h2>

    <form action="<?= isset($article) ? BASE_URL . '/admin/articles/update/' . $article['id'] : BASE_URL . '/admin/articles/store' ?>" 
          method="POST" enctype="multipart/form-data">
        
        <!-- Title -->
        <div class="mb-6">
            <label class="block text-gray-700 font-semibold mb-2">
                <i class="fas fa-heading mr-2"></i>Article Title *
            </label>
            <input type="text" name="title" required
                   value="<?= $article['title'] ?? '' ?>"
                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
                   placeholder="Enter article title">
        </div>

        <!-- Content -->
        <div class="mb-6">
            <label class="block text-gray-700 font-semibold mb-2">
                <i class="fas fa-align-left mr-2"></i>Content *
            </label>
            <textarea name="content" required rows="15"
                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
                      placeholder="Write your article content here..."><?= $article['content'] ?? '' ?></textarea>
            <p class="text-sm text-gray-500 mt-1">You can use HTML tags for formatting</p>
        </div>

        <!-- Thumbnail -->
        <div class="mb-6">
            <label class="block text-gray-700 font-semibold mb-2">
                <i class="fas fa-image mr-2"></i>Thumbnail Image
            </label>
            <?php if (isset($article['thumbnail']) && $article['thumbnail']): ?>
                <div class="mb-3">
                    <img src="<?= BASE_URL ?>/uploads/articles/<?= $article['thumbnail'] ?>" 
                         alt="Current thumbnail" 
                         class="h-32 w-auto rounded border">
                    <p class="text-sm text-gray-500 mt-1">Current image</p>
                </div>
            <?php endif; ?>
            <input type="file" name="thumbnail" accept="image/*"
                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
            <p class="text-sm text-gray-500 mt-1">Max size: 5MB. Formats: JPG, PNG, GIF</p>
        </div>

        <!-- Submit Buttons -->
        <div class="flex justify-end gap-4 mt-8">
            <a href="<?= BASE_URL ?>/admin/articles" 
               class="px-6 py-3 border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                Cancel
            </a>
            <button type="submit" 
                    class="bg-primary text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition">
                <i class="fas fa-save mr-2"></i><?= isset($article) ? 'Update' : 'Publish' ?> Article
            </button>
        </div>
    </form>
</div>

<?php require_once '../app/views/layouts/admin_footer.php'; ?>
