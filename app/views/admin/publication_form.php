<?php require_once '../app/views/layouts/admin_header.php'; ?>

<div class="flex-1 p-8">
    <div class="max-w-4xl mx-auto">
        <div class="mb-6">
            <a href="<?= BASE_URL ?>/admin/publications" class="text-blue-600 hover:text-blue-800">
                <i class="fas fa-arrow-left mr-2"></i>Kembali ke Daftar
            </a>
            <h1 class="text-3xl font-bold mt-2">
                <?= isset($data['publication']) ? 'Edit Publikasi' : 'Tambah Publikasi' ?>
            </h1>
        </div>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <?= $_SESSION['error']; unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <form action="<?= isset($data['publication']) ? BASE_URL . '/admin/publication/edit/' . $data['publication']['id'] : BASE_URL . '/admin/publication/create' ?>" 
              method="POST" 
              enctype="multipart/form-data" 
              class="bg-white rounded-lg shadow p-6">
            
            <!-- Title -->
            <div class="mb-6">
                <label class="block text-gray-700 font-semibold mb-2">
                    Judul Publikasi <span class="text-red-500">*</span>
                </label>
                <input type="text" name="title" required
                       value="<?= isset($data['publication']) ? htmlspecialchars($data['publication']['title']) : '' ?>"
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                       placeholder="Masukkan judul publikasi">
            </div>

            <!-- Authors -->
            <div class="mb-6">
                <label class="block text-gray-700 font-semibold mb-2">
                    Penulis <span class="text-red-500">*</span>
                </label>
                <input type="text" name="authors" required
                       value="<?= isset($data['publication']) ? htmlspecialchars($data['publication']['authors']) : '' ?>"
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                       placeholder="Nama penulis (pisahkan dengan koma)">
                <p class="text-sm text-gray-500 mt-1">Contoh: John Doe, Jane Smith, Ahmad Rizki</p>
            </div>

            <!-- Publication Type -->
            <div class="mb-6">
                <label class="block text-gray-700 font-semibold mb-2">
                    Tipe Publikasi <span class="text-red-500">*</span>
                </label>
                <select name="publication_type" id="publication_type" required
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Pilih Tipe</option>
                    <?php foreach ($data['types'] as $type): ?>
                        <option value="<?= $type ?>" 
                                <?= (isset($data['publication']) && $data['publication']['publication_type'] == $type) ? 'selected' : '' ?>>
                            <?= $type ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Journal Name (conditional) -->
            <div class="mb-6 journal-field">
                <label class="block text-gray-700 font-semibold mb-2">Nama Jurnal</label>
                <input type="text" name="journal_name"
                       value="<?= isset($data['publication']) ? htmlspecialchars($data['publication']['journal_name'] ?? '') : '' ?>"
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                       placeholder="Nama jurnal">
            </div>

            <!-- Conference Name (conditional) -->
            <div class="mb-6 conference-field">
                <label class="block text-gray-700 font-semibold mb-2">Nama Konferensi</label>
                <input type="text" name="conference_name"
                       value="<?= isset($data['publication']) ? htmlspecialchars($data['publication']['conference_name'] ?? '') : '' ?>"
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                       placeholder="Nama konferensi">
            </div>

            <!-- Publisher -->
            <div class="mb-6">
                <label class="block text-gray-700 font-semibold mb-2">Penerbit</label>
                <input type="text" name="publisher"
                       value="<?= isset($data['publication']) ? htmlspecialchars($data['publication']['publisher'] ?? '') : '' ?>"
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                       placeholder="Nama penerbit">
            </div>

            <!-- Publication Date -->
            <div class="mb-6">
                <label class="block text-gray-700 font-semibold mb-2">Tanggal Publikasi</label>
                <input type="date" name="publication_date"
                       value="<?= isset($data['publication']) ? ($data['publication']['publication_date'] ?? '') : '' ?>"
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Volume, Issue, Pages (in a row) -->
            <div class="grid md:grid-cols-3 gap-4 mb-6">
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Volume</label>
                    <input type="text" name="volume"
                           value="<?= isset($data['publication']) ? htmlspecialchars($data['publication']['volume'] ?? '') : '' ?>"
                           class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                           placeholder="Vol.">
                </div>
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Issue</label>
                    <input type="text" name="issue"
                           value="<?= isset($data['publication']) ? htmlspecialchars($data['publication']['issue'] ?? '') : '' ?>"
                           class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                           placeholder="No.">
                </div>
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Halaman</label>
                    <input type="text" name="pages"
                           value="<?= isset($data['publication']) ? htmlspecialchars($data['publication']['pages'] ?? '') : '' ?>"
                           class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                           placeholder="1-10">
                </div>
            </div>

            <!-- DOI, ISBN, ISSN (in a row) -->
            <div class="grid md:grid-cols-3 gap-4 mb-6">
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">DOI</label>
                    <input type="text" name="doi"
                           value="<?= isset($data['publication']) ? htmlspecialchars($data['publication']['doi'] ?? '') : '' ?>"
                           class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                           placeholder="10.xxxx/xxxxx">
                </div>
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">ISBN</label>
                    <input type="text" name="isbn"
                           value="<?= isset($data['publication']) ? htmlspecialchars($data['publication']['isbn'] ?? '') : '' ?>"
                           class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                           placeholder="978-x-xxxx-xxxx-x">
                </div>
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">ISSN</label>
                    <input type="text" name="issn"
                           value="<?= isset($data['publication']) ? htmlspecialchars($data['publication']['issn'] ?? '') : '' ?>"
                           class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                           placeholder="xxxx-xxxx">
                </div>
            </div>

            <!-- URL -->
            <div class="mb-6">
                <label class="block text-gray-700 font-semibold mb-2">URL Publikasi</label>
                <input type="url" name="url"
                       value="<?= isset($data['publication']) ? htmlspecialchars($data['publication']['url'] ?? '') : '' ?>"
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                       placeholder="https://">
            </div>

            <!-- Citation Count -->
            <div class="mb-6">
                <label class="block text-gray-700 font-semibold mb-2">Jumlah Sitasi</label>
                <input type="number" name="citation_count" min="0"
                       value="<?= isset($data['publication']) ? ($data['publication']['citation_count'] ?? 0) : 0 ?>"
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Abstract -->
            <div class="mb-6">
                <label class="block text-gray-700 font-semibold mb-2">Abstrak</label>
                <textarea name="abstract" rows="6"
                          class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                          placeholder="Tulis abstrak publikasi..."><?= isset($data['publication']) ? htmlspecialchars($data['publication']['abstract'] ?? '') : '' ?></textarea>
            </div>

            <!-- Keywords -->
            <div class="mb-6">
                <label class="block text-gray-700 font-semibold mb-2">Kata Kunci</label>
                <input type="text" name="keywords"
                       value="<?= isset($data['publication']) ? htmlspecialchars($data['publication']['keywords'] ?? '') : '' ?>"
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                       placeholder="Kata kunci (pisahkan dengan |)">
                <p class="text-sm text-gray-500 mt-1">Contoh: Machine Learning|Deep Learning|AI</p>
            </div>

            <!-- PDF Upload -->
            <div class="mb-6">
                <label class="block text-gray-700 font-semibold mb-2">Upload PDF</label>
                <?php if (isset($data['publication']) && !empty($data['publication']['pdf_file'])): ?>
                    <div class="mb-2 text-sm text-gray-600">
                        <i class="fas fa-file-pdf text-red-500 mr-1"></i>
                        File saat ini: <a href="<?= BASE_URL ?>/assets/pdf/publications/<?= $data['publication']['pdf_file'] ?>" 
                                          target="_blank" 
                                          class="text-blue-600 hover:text-blue-800">
                            <?= $data['publication']['pdf_file'] ?>
                        </a>
                    </div>
                <?php endif; ?>
                <input type="file" name="pdf_file" accept=".pdf"
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <p class="text-sm text-gray-500 mt-1">Format: PDF (Max 10MB)</p>
            </div>

            <!-- Submit Buttons -->
            <div class="flex gap-4">
                <button type="submit" 
                        class="bg-[#0F3A75] text-white px-6 py-3 rounded-lg hover:bg-[#0C2F61] transition">
                    <i class="fas fa-save mr-2"></i>Simpan
                </button>
                <a href="<?= BASE_URL ?>/admin/publications" 
                   class="bg-gray-500 text-white px-6 py-3 rounded-lg hover:bg-gray-600 transition inline-block">
                    <i class="fas fa-times mr-2"></i>Batal
                </a>
            </div>
        </form>
    </div>
</div>

<script>
// Show/hide conditional fields based on publication type
document.getElementById('publication_type').addEventListener('change', function() {
    const type = this.value;
    const journalFields = document.querySelectorAll('.journal-field');
    const conferenceFields = document.querySelectorAll('.conference-field');
    
    // Hide all conditional fields first
    journalFields.forEach(field => field.style.display = 'none');
    conferenceFields.forEach(field => field.style.display = 'none');
    
    // Show relevant fields
    if (type === 'Jurnal') {
        journalFields.forEach(field => field.style.display = 'block');
    } else if (type === 'Konferensi' || type === 'Prosiding') {
        conferenceFields.forEach(field => field.style.display = 'block');
    }
});

// Trigger on page load to show correct fields
document.getElementById('publication_type').dispatchEvent(new Event('change'));
</script>

<?php require_once '../app/views/layouts/admin_footer.php'; ?>
