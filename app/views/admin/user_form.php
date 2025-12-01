<?php $page_title = isset($user) ? 'Edit User' : 'Create User'; require_once '../app/views/layouts/admin_header.php'; ?>

<div class="mb-6">
    <a href="<?= BASE_URL ?>/admin/users" class="text-primary hover:text-blue-700">
        <i class="fas fa-arrow-left mr-2"></i>Back to Users
    </a>
</div>

<div class="bg-white rounded-lg shadow-lg p-8">
    <h2 class="text-2xl font-bold mb-6"><?= isset($user) ? 'Edit' : 'Create New' ?> User</h2>

    <form action="<?= isset($user) ? BASE_URL . '/admin/users/update/' . $user['id'] : BASE_URL . '/admin/users/store' ?>" 
          method="POST">
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Name -->
            <div>
                <label class="block text-gray-700 font-semibold mb-2">
                    <i class="fas fa-user mr-2"></i>Full Name *
                </label>
                <input type="text" name="name" required
                       value="<?= $user['name'] ?? '' ?>"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
                       placeholder="Enter full name">
            </div>

            <!-- Email -->
            <div>
                <label class="block text-gray-700 font-semibold mb-2">
                    <i class="fas fa-envelope mr-2"></i>Email Address *
                </label>
                <input type="email" name="email" required
                       value="<?= $user['email'] ?? '' ?>"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
                       placeholder="Enter email address">
            </div>

            <!-- Role -->
            <div>
                <label class="block text-gray-700 font-semibold mb-2">
                    <i class="fas fa-shield-alt mr-2"></i>Role *
                </label>
                <select name="role" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                    <option value="">Select Role</option>
                    <option value="admin" <?= (($user['role'] ?? '') == 'admin') ? 'selected' : '' ?>>Administrator</option>
                    <option value="editor" <?= (($user['role'] ?? '') == 'editor') ? 'selected' : '' ?>>Editor</option>
                </select>
            </div>

            <!-- Password -->
            <div>
                <label class="block text-gray-700 font-semibold mb-2">
                    <i class="fas fa-lock mr-2"></i>Password <?= isset($user) ? '(Leave empty to keep current)' : '*' ?>
                </label>
                <input type="password" name="password" <?= !isset($user) ? 'required' : '' ?>
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
                       placeholder="Enter password">
            </div>

            <?php if (!isset($user)): ?>
            <!-- Password Confirmation -->
            <div class="md:col-span-2">
                <label class="block text-gray-700 font-semibold mb-2">
                    <i class="fas fa-lock mr-2"></i>Confirm Password *
                </label>
                <input type="password" name="password_confirmation" required
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
                       placeholder="Confirm password">
            </div>
            <?php endif; ?>
        </div>

        <!-- Submit Buttons -->
        <div class="flex justify-end gap-4 mt-8">
            <a href="<?= BASE_URL ?>/admin/users" 
               class="px-6 py-3 border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                Cancel
            </a>
            <button type="submit" 
                    class="bg-primary text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition">
                <i class="fas fa-save mr-2"></i><?= isset($user) ? 'Update' : 'Create' ?> User
            </button>
        </div>
    </form>
</div>

<?php require_once '../app/views/layouts/admin_footer.php'; ?>
