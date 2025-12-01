<?php $page_title = isset($gallery) ? 'Edit Media' : 'Upload Media'; require_once '../app/views/layouts/admin_header.php'; ?>

<div class="mb-6">
    <a href="<?= BASE_URL ?>/admin/gallery" class="text-primary hover:text-blue-700">
        <i class="fas fa-arrow-left mr-2"></i>Back to Gallery
    </a>
</div>

<div class="bg-white rounded-lg shadow-lg p-8">
    <h2 class="text-2xl font-bold mb-6"><?= isset($gallery) ? 'Edit' : 'Upload' ?> Media</h2>

    <form action="<?= isset($gallery) ? BASE_URL . '/admin/gallery/update/' . $gallery['id'] : BASE_URL . '/admin/gallery/store' ?>" 
          method="POST" enctype="multipart/form-data">
        
        <!-- Title -->
        <div class="mb-6">
            <label class="block text-gray-700 font-semibold mb-2">
                <i class="fas fa-heading mr-2"></i>Media Title *
            </label>
            <input type="text" name="title" required
                   value="<?= $gallery['title'] ?? '' ?>"
                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
                   placeholder="Enter media title">
        </div>

        <!-- Media Type -->
        <div class="mb-6">
            <label class="block text-gray-700 font-semibold mb-2">
                <i class="fas fa-layer-group mr-2"></i>Media Type *
            </label>
            <select name="media_type" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                <option value="">Select Type</option>
                <option value="image" <?= (($gallery['media_type'] ?? '') == 'image') ? 'selected' : '' ?>>Image</option>
                <option value="video" <?= (($gallery['media_type'] ?? '') == 'video') ? 'selected' : '' ?>>Video</option>
            </select>
        </div>

        <!-- Description -->
        <div class="mb-6">
            <label class="block text-gray-700 font-semibold mb-2">
                <i class="fas fa-align-left mr-2"></i>Description
            </label>
            <textarea name="description" rows="4"
                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
                      placeholder="Optional description"><?= $gallery['description'] ?? '' ?></textarea>
        </div>

        <!-- File Upload -->
        <div class="mb-6">
            <label class="block text-gray-700 font-semibold mb-2">
                <i class="fas fa-upload mr-2"></i>Upload File <?= isset($gallery) ? '(Leave empty to keep current file)' : '*' ?>
            </label>
            <?php if (isset($gallery['file_path']) && $gallery['file_path']): ?>
                <div class="mb-3">
                    <?php if ($gallery['media_type'] == 'image'): ?>
                        <img src="<?= BASE_URL ?>/uploads/gallery/<?= $gallery['file_path'] ?>" 
                             alt="Current file" 
                             class="h-32 w-auto rounded border">
                    <?php else: ?>
                        <div class="h-32 w-32 bg-gray-800 rounded flex items-center justify-center">
                            <i class="fas fa-video text-white text-4xl"></i>
                        </div>
                    <?php endif; ?>
                    <p class="text-sm text-gray-500 mt-1">Current file: <?= $gallery['file_path'] ?></p>
                </div>
            <?php endif; ?>
            <input type="file" name="file" accept="image/*,video/*" <?= !isset($gallery) ? 'required' : '' ?>
                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
            <p class="text-sm text-gray-500 mt-1">Max size: 5MB for images, 20MB for videos</p>
        </div>

        <!-- Submit Buttons -->
        <div class="flex justify-end gap-4 mt-8">
            <a href="<?= BASE_URL ?>/admin/gallery" 
               class="px-6 py-3 border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                Cancel
            </a>
            <button type="submit" 
                    class="bg-primary text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition">
                <i class="fas fa-save mr-2"></i><?= isset($gallery) ? 'Update' : 'Upload' ?> Media
            </button>
        </div>
    </form>
</div>

<?php require_once '../app/views/layouts/admin_footer.php'; ?>
