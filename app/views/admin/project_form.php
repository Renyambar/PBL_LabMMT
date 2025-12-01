<?php $page_title = isset($project) ? 'Edit Project' : 'Create Project'; require_once '../app/views/layouts/admin_header.php'; ?>

<div class="mb-6">
    <a href="<?= BASE_URL ?>/admin/projects" class="text-primary hover:text-blue-700">
        <i class="fas fa-arrow-left mr-2"></i>Back to Projects
    </a>
</div>

<div class="bg-white rounded-lg shadow-lg p-8">
    <h2 class="text-2xl font-bold mb-6"><?= isset($project) ? 'Edit' : 'Create New' ?> Project</h2>

    <form action="<?= isset($project) ? BASE_URL . '/admin/projects/update/' . $project['id'] : BASE_URL . '/admin/projects/store' ?>" 
          method="POST" enctype="multipart/form-data">
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Title -->
            <div class="md:col-span-2">
                <label class="block text-gray-700 font-semibold mb-2">
                    <i class="fas fa-heading mr-2"></i>Project Title *
                </label>
                <input type="text" name="title" required
                       value="<?= $project['title'] ?? '' ?>"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
                       placeholder="Enter project title">
            </div>

            <!-- Category -->
            <div>
                <label class="block text-gray-700 font-semibold mb-2">
                    <i class="fas fa-folder mr-2"></i>Category *
                </label>
                <select name="category" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                    <option value="">Select Category</option>
                    <option value="Mobile Development" <?= (($project['category'] ?? '') == 'Mobile Development') ? 'selected' : '' ?>>Mobile Development</option>
                    <option value="Web Development" <?= (($project['category'] ?? '') == 'Web Development') ? 'selected' : '' ?>>Web Development</option>
                    <option value="IoT" <?= (($project['category'] ?? '') == 'IoT') ? 'selected' : '' ?>>IoT</option>
                    <option value="AI/ML" <?= (($project['category'] ?? '') == 'AI/ML') ? 'selected' : '' ?>>AI/ML</option>
                    <option value="Game Development" <?= (($project['category'] ?? '') == 'Game Development') ? 'selected' : '' ?>>Game Development</option>
                </select>
            </div>

            <!-- Technologies -->
            <div>
                <label class="block text-gray-700 font-semibold mb-2">
                    <i class="fas fa-code mr-2"></i>Technologies *
                </label>
                <input type="text" name="technologies" required
                       value="<?= $project['tags'] ?? '' ?>"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
                       placeholder="e.g., React, Node.js, MongoDB">
            </div>

            <!-- Description -->
            <div class="md:col-span-2">
                <label class="block text-gray-700 font-semibold mb-2">
                    <i class="fas fa-align-left mr-2"></i>Description *
                </label>
                <textarea name="description" required rows="4"
                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
                          placeholder="Brief description of the project"><?= substr($project['description'] ?? '', 0, 200) ?></textarea>
            </div>

            <!-- Full Description -->
            <div class="md:col-span-2">
                <label class="block text-gray-700 font-semibold mb-2">
                    <i class="fas fa-file-alt mr-2"></i>Full Description
                </label>
                <textarea name="full_description" rows="8"
                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
                          placeholder="Detailed description, features, and implementation details"><?= $project['description'] ?? '' ?></textarea>
            </div>

            <!-- Project URL -->
            <div>
                <label class="block text-gray-700 font-semibold mb-2">
                    <i class="fas fa-link mr-2"></i>Project URL
                </label>
                <input type="url" name="project_url"
                       value="<?= $project['video_url'] ?? '' ?>"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
                       placeholder="https://example.com">
            </div>

            <!-- GitHub URL -->
            <div>
                <label class="block text-gray-700 font-semibold mb-2">
                    <i class="fab fa-github mr-2"></i>GitHub URL
                </label>
                <input type="url" name="github_url"
                       value=""
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
                       placeholder="https://github.com/username/repo">
            </div>

            <!-- Thumbnail -->
            <div class="md:col-span-2">
                <label class="block text-gray-700 font-semibold mb-2">
                    <i class="fas fa-image mr-2"></i>Thumbnail Image
                </label>
                <?php if (isset($project['thumbnail']) && $project['thumbnail']): ?>
                    <div class="mb-3">
                        <img src="<?= BASE_URL ?>/uploads/projects/<?= $project['thumbnail'] ?>" 
                             alt="Current thumbnail" 
                             class="h-32 w-auto rounded border">
                        <p class="text-sm text-gray-500 mt-1">Current image</p>
                    </div>
                <?php endif; ?>
                <input type="file" name="thumbnail" accept="image/*"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                <p class="text-sm text-gray-500 mt-1">Max size: 5MB. Formats: JPG, PNG, GIF</p>
            </div>
        </div>

        <!-- Submit Buttons -->
        <div class="flex justify-end gap-4 mt-8">
            <a href="<?= BASE_URL ?>/admin/projects" 
               class="px-6 py-3 border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                Cancel
            </a>
            <button type="submit" 
                    class="bg-primary text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition">
                <i class="fas fa-save mr-2"></i><?= isset($project) ? 'Update' : 'Create' ?> Project
            </button>
        </div>
    </form>
</div>

<?php require_once '../app/views/layouts/admin_footer.php'; ?>
