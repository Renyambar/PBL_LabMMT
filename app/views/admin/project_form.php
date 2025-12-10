<?php $page_title = isset($project) ? 'Ubah Proyek' : 'Buat Proyek'; require_once '../app/views/layouts/admin_header.php'; ?>

<div class="mb-6">
    <a href="<?= BASE_URL ?>/admin/projects" class="text-primary hover:text-blue-700">
        <i class="fas fa-arrow-left mr-2"></i>Kembali ke Proyek
    </a>
</div>

<div class="bg-white rounded-lg shadow-lg p-8">
    <h2 class="text-2xl font-bold mb-6"><?= isset($project) ? 'Ubah' : 'Buat' ?> Proyek</h2>

    <form action="<?= isset($project) ? BASE_URL . '/admin/projects/update/' . $project['id'] : BASE_URL . '/admin/projects/store' ?>" 
          method="POST" enctype="multipart/form-data">
        
        <!-- Section 1: Basic Information -->
        <div class="mb-8">
            <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-info-circle text-blue-600 mr-2"></i>
                Informasi Dasar
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Title -->
                <div class="md:col-span-2">
                    <label class="block text-gray-700 font-semibold mb-2">
                        <i class="fas fa-heading mr-2"></i>Judul Proyek *
                    </label>
                    <input type="text" name="title" required
                           value="<?= $project['title'] ?? '' ?>"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
                           placeholder="Masukkan judul proyek">
                </div>

                <!-- Category -->
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">
                        <i class="fas fa-folder mr-2"></i>Kategori *
                    </label>
                    <select name="category" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                        <option value="">Pilih Kategori</option>
                        <option value="Mobile Development" <?= (($project['category'] ?? '') == 'Mobile Development') ? 'selected' : '' ?>>Mobile Development</option>
                        <option value="Web Development" <?= (($project['category'] ?? '') == 'Web Development') ? 'selected' : '' ?>>Web Development</option>
                        <option value="IoT" <?= (($project['category'] ?? '') == 'IoT') ? 'selected' : '' ?>>IoT</option>
                        <option value="AI/ML" <?= (($project['category'] ?? '') == 'AI/ML') ? 'selected' : '' ?>>AI/ML</option>
                        <option value="Game Development" <?= (($project['category'] ?? '') == 'Game Development') ? 'selected' : '' ?>>Game Development</option>
                    </select>
                </div>

                <!-- Tags -->
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">
                        <i class="fas fa-tags mr-2"></i>Tags
                    </label>
                    <input type="text" name="tags"
                           value="<?= $project['tags'] ?? '' ?>"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
                           placeholder="Web, Mobile, Backend, Frontend">
                    <p class="text-sm text-gray-500 mt-1">Pisahkan dengan koma</p>
                </div>

                <!-- Description -->
                <div class="md:col-span-2">
                    <label class="block text-gray-700 font-semibold mb-2">
                        <i class="fas fa-align-left mr-2"></i>Deskripsi Singkat *
                    </label>
                    <textarea name="description" required rows="3"
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
                              placeholder="Deskripsi singkat proyek (200-300 karakter)"><?= $project['description'] ?? '' ?></textarea>
                </div>
            </div>
        </div>

        <!-- Section 2: Team Information -->
        <div class="mb-8">
            <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-users text-blue-600 mr-2"></i>
                Informasi Tim
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- Team Name -->
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">
                        <i class="fas fa-users mr-2"></i>Nama Tim
                    </label>
                    <input type="text" name="team_name"
                           value="<?= $project['team_name'] ?? '' ?>"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
                           placeholder="contoh: Tim Inovasi Digital">
                </div>

                <!-- Supervisor -->
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">
                        <i class="fas fa-chalkboard-teacher mr-2"></i>Dosen Pembimbing
                    </label>
                    <input type="text" name="supervisor"
                           value="<?= $project['supervisor'] ?? '' ?>"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
                           placeholder="contoh: Dr. Budi Santoso, M.Kom">
                </div>

                <!-- Client -->
                <div class="md:col-span-2">
                    <label class="block text-gray-700 font-semibold mb-2">
                        <i class="fas fa-building mr-2"></i>Klien / Mitra
                    </label>
                    <input type="text" name="client"
                           value="<?= $project['client'] ?? '' ?>"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
                           placeholder="contoh: PT. Teknologi Indonesia">
                </div>

                <!-- Team Members -->
                <div class="md:col-span-2">
                    <label class="block text-gray-700 font-semibold mb-2">
                        <i class="fas fa-user-friends mr-2"></i>Anggota Tim
                    </label>
                    <textarea name="team_members" rows="3"
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
                              placeholder="Masukkan nama anggota tim, pisahkan dengan koma atau enter&#10;contoh:&#10;Ahmad Rifai&#10;Siti Nurhaliza&#10;Budi Santoso"><?= $project['team_members'] ?? '' ?></textarea>
                    <p class="text-sm text-gray-500 mt-1">Pisahkan setiap anggota dengan enter (baris baru) atau koma</p>
                </div>
            </div>
        </div>

        <!-- Section 3: Technical Information -->
        <div class="mb-8">
            <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-laptop-code text-orange-600 mr-2"></i>
                Informasi Teknis
            </h3>
            <div class="grid grid-cols-1 gap-6">
                <!-- Technologies -->
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">
                        <i class="fas fa-code mr-2"></i>Teknologi yang Digunakan *
                    </label>
                    <textarea name="technologies" required rows="3"
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
                              placeholder="Masukkan teknologi yang digunakan, pisahkan dengan koma atau enter&#10;contoh:&#10;React.js&#10;Node.js&#10;PostgreSQL&#10;Tailwind CSS"><?= $project['technologies'] ?? '' ?></textarea>
                    <p class="text-sm text-gray-500 mt-1">Pisahkan dengan enter (baris baru) atau koma. Contoh: React, Node.js, PostgreSQL</p>
                </div>
            </div>
        </div>

        <!-- Section 4: Links & URLs -->
        <div class="mb-8">
            <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-link text-purple-600 mr-2"></i>
                Link & URL
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- GitHub URL -->
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">
                        <i class="fab fa-github mr-2"></i>URL GitHub Repository
                    </label>
                    <input type="url" name="github_url"
                           value="<?= $project['github_url'] ?? '' ?>"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
                           placeholder="https://github.com/username/repo">
                </div>

                <!-- Demo URL -->
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">
                        <i class="fas fa-external-link-alt mr-2"></i>URL Demo / Live Website
                    </label>
                    <input type="url" name="demo_url"
                           value="<?= $project['demo_url'] ?? '' ?>"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
                           placeholder="https://demo.example.com">
                </div>
            </div>
        </div>

        <!-- Section 5: Media -->
        <div class="mb-8">
            <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-image text-green-600 mr-2"></i>
                Media & Gambar
            </h3>
            <div class="grid grid-cols-1 gap-6">

                <!-- Thumbnail -->
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">
                        <i class="fas fa-image mr-2"></i>Gambar Thumbnail *
                    </label>
                    <?php if (isset($project['thumbnail']) && $project['thumbnail']): ?>
                        <div class="mb-3 p-4 bg-gray-50 rounded-lg">
                            <img src="<?= BASE_URL ?>/assets/img/<?= $project['thumbnail'] ?>" 
                                 alt="Thumbnail saat ini" 
                                 class="h-40 w-auto rounded-lg shadow-md mx-auto">
                            <p class="text-sm text-gray-600 mt-2 text-center">Gambar saat ini</p>
                        </div>
                    <?php endif; ?>
                    <div class="mt-2">
                        <input type="file" name="thumbnail" accept="image/*" <?= !isset($project) ? 'required' : '' ?>
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        <p class="text-sm text-gray-500 mt-2">
                            <i class="fas fa-info-circle mr-1"></i>Ukuran maks: 5MB. Format: JPG, PNG, GIF
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Submit Buttons -->
        <div class="flex justify-end gap-4 mt-8">
            <a href="<?= BASE_URL ?>/admin/projects" 
               class="px-6 py-3 border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                Batal
            </a>
            <button type="submit" 
                    class="bg-primary text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition">
                <i class="fas fa-save mr-2"></i><?= isset($project) ? 'Update' : 'Buat' ?> Proyek
            </button>
        </div>
    </form>
</div>

<?php require_once '../app/views/layouts/admin_footer.php'; ?>
