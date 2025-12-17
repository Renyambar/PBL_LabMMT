<?php $page_title = 'Kelola Profil Lab'; require_once '../app/views/layouts/admin_header.php'; ?>

<div class="flex justify-between items-center mb-6">
    <h3 class="text-2xl font-bold">Profil Laboratorium</h3>
</div>

<?php if (isset($_SESSION['success'])): ?>
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg">
        <div class="flex items-center">
            <i class="fas fa-check-circle mr-3"></i>
            <span><?= $_SESSION['success']; unset($_SESSION['success']); ?></span>
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

<!-- Lab Information Card -->
<div class="bg-white rounded-lg shadow-lg p-6 mb-6">
    <h4 class="text-xl font-bold mb-4 text-gray-800">Informasi Laboratorium</h4>
    <form action="<?= BASE_URL ?>/admin/lab_profile_update" method="POST">
        <div class="mb-4">
            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
            <textarea class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent" 
                      id="description" name="description" rows="5" required><?= htmlspecialchars($data['profile']['description'] ?? '') ?></textarea>
        </div>

        <div class="mb-4">
            <label for="vision" class="block text-sm font-medium text-gray-700 mb-2">Visi</label>
            <textarea class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent" 
                      id="vision" name="vision" rows="3" required><?= htmlspecialchars($data['profile']['vision'] ?? '') ?></textarea>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Misi</label>
            <div id="mission-container" class="space-y-2">
                <?php 
                $missions = isset($data['profile']['mission']) ? json_decode($data['profile']['mission'], true) : [''];
                foreach ($missions as $index => $mission): 
                ?>
                <div class="flex gap-2 mission-item">
                    <input type="text" class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent" 
                           name="mission[]" value="<?= htmlspecialchars($mission) ?>" placeholder="Item misi" required>
                    <button type="button" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition" onclick="removeMission(this)">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <?php endforeach; ?>
            </div>
            <button type="button" class="mt-2 px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition text-sm" onclick="addMission()">
                <i class="fas fa-plus"></i> Tambah Item Misi
            </button>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="px-6 py-3 bg-primary text-white rounded-lg hover:bg-blue-700 transition">
                <i class="fas fa-save mr-2"></i>Simpan Perubahan
            </button>
        </div>
    </form>
</div>

<!-- Team Members Card -->
<div class="bg-white rounded-lg shadow-lg overflow-hidden">
    <div class="p-6 border-b border-gray-200 flex justify-between items-center">
        <h4 class="text-xl font-bold text-gray-800">Anggota Tim</h4>
        <a href="<?= BASE_URL ?>/admin/team_member_create" class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-blue-700 transition">
            <i class="fas fa-plus mr-2"></i>Tambah Anggota
        </a>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Foto</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jabatan</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Urutan</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <?php if (empty($data['team_members'])): ?>
                <tr>
                    <td colspan="6" class="px-6 py-4 text-center text-gray-500">Belum ada anggota tim</td>
                </tr>
                <?php else: ?>
                <?php foreach ($data['team_members'] as $member): ?>
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4">
                        <?php if ($member['photo']): ?>
                        <img src="<?= BASE_URL ?>/assets/img/team/<?= htmlspecialchars($member['photo']) ?>" 
                             alt="<?= htmlspecialchars($member['name']) ?>" 
                             class="w-12 h-12 rounded-full object-cover">
                        <?php else: ?>
                        <div class="w-12 h-12 rounded-full bg-gray-200 flex items-center justify-center">
                            <i class="fas fa-user text-gray-500"></i>
                        </div>
                        <?php endif; ?>
                    </td>
                    <td class="px-6 py-4 text-sm font-medium text-gray-900"><?= htmlspecialchars($member['name']) ?></td>
                    <td class="px-6 py-4 text-sm text-gray-500"><?= htmlspecialchars($member['position']) ?></td>
                    <td class="px-6 py-4">
                        <?php if ($member['is_head']): ?>
                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Kepala Lab</span>
                        <?php else: ?>
                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">Anggota</span>
                        <?php endif; ?>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-500"><?= $member['display_order'] ?></td>
                    <td class="px-6 py-4 text-sm">
                        <div class="flex gap-2">
                            <a href="<?= BASE_URL ?>/admin/team_member_edit/<?= $member['id'] ?>" 
                               class="px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="<?= BASE_URL ?>/admin/team_member_delete/<?= $member['id'] ?>" 
                                  method="POST" style="display: inline-block;" 
                                  onsubmit="return confirm('Yakin ingin menghapus anggota tim ini?');">
                                <button type="submit" class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700 transition">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
function addMission() {
    const container = document.getElementById('mission-container');
    const div = document.createElement('div');
    div.className = 'flex gap-2 mission-item';
    div.innerHTML = `
        <input type="text" class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent" 
               name="mission[]" placeholder="Item misi" required>
        <button type="button" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition" onclick="removeMission(this)">
            <i class="fas fa-times"></i>
        </button>
    `;
    container.appendChild(div);
}

function removeMission(button) {
    const missionItems = document.querySelectorAll('.mission-item');
    if (missionItems.length > 1) {
        button.closest('.mission-item').remove();
    } else {
        alert('Minimal satu item misi diperlukan');
    }
}
</script>

<?php require_once '../app/views/layouts/admin_footer.php'; ?>
