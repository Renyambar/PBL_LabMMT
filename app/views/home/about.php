<?php require_once '../app/views/layouts/header.php'; ?>

<!-- Page Header -->
<section class="bg-gradient-to-r from-black/100 via-blue-800 to-blue-600 text-white py-16">
    <div class="container mx-auto px-4" data-aos="fade-down">
        <h1 class="text-4xl font-bold mb-4">PROFIL LABORATORIUM</h1>
        <p class="text-xl">Laboratorium Multimedia & Mobile Technology</p>
    </div>
</section>

<!-- About Content -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <!-- Lab Introduction Card -->
        <div class="max-w-6xl mx-auto mb-12" data-aos="fade-right">
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="md:flex">
                    <div class="md:w-1/2 p-10">
                        <h2 class="text-3xl font-bold mb-4 text-[#0F3A75]">Laboratorium Multimedia & Mobile Technology</h2>
                        <p class="text-gray-700 leading-relaxed mb-4">
                            <?= htmlspecialchars($data['profile']['description'] ?? 'Laboratorium Multimedia dan Mobile Technology merupakan salah satu laboratorium unggulan di Jurusan Teknologi Informasi Politeknik Negeri Malang.') ?>
                        </p>
                    </div>
                    <div class="md:w-1/2">
                        <img src="/PBL_LabMMT/public/assets/img/partners/lab-team.jpg" alt="Lab Team" class="w-full h-full object-cover">
                    </div>
                </div>
            </div>
        </div>

        <!-- Vision & Mission -->
        <div class="max-w-6xl mx-auto mb-12" data-aos="fade-left">
            <div class="bg-white rounded-xl shadow-md p-10">
                <h2 class="text-3xl font-bold mb-8 text-[#0F3A75]">Visi & Misi</h2>
                
                <div class="mb-8">
                    <div class="flex items-start mb-4">
                        <div class="bg-blue-100 rounded-full p-3 mr-4">
                            <i class="fas fa-eye text-[#0F3A75] text-2xl"></i>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold mb-3 text-gray-800">Visi</h3>
                            <p class="text-gray-700 leading-relaxed">
                                <?= htmlspecialchars($data['profile']['vision'] ?? 'Menjadi laboratorium unggulan dalam pengembangan teknologi multimedia dan mobile yang inovatif.') ?>
                            </p>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="flex items-start">
                        <div class="bg-blue-100 rounded-full p-3 mr-4">
                            <i class="fas fa-bullseye text-[#0F3A75] text-2xl"></i>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold mb-4 text-gray-800">Misi</h3>
                            <ul class="space-y-3">
                                <?php foreach ($data['missions'] as $mission): ?>
                                <li class="flex items-start">
                                    <i class="fas fa-check-circle text-blue-600 mr-3 mt-1"></i>
                                    <span class="text-gray-700"><?= htmlspecialchars($mission) ?></span>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Facilities -->
        <div class="max-w-6xl mx-auto mb-12">
            <div class="bg-white rounded-xl shadow-md p-10">
                <h2 class="text-3xl font-bold mb-8 text-[#0F3A75]">Fasilitas</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="flex items-start space-x-4">
                        <div class="bg-blue-50 p-4 rounded-lg flex-shrink-0">
                            <i class="fas fa-desktop text-[#0F3A75] text-3xl"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-lg mb-2 text-gray-800">Komputer High-End</h4>
                            <p class="text-gray-600">Workstation dengan spesifikasi tinggi untuk development dan rendering</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-4">
                        <div class="bg-blue-50 p-4 rounded-lg flex-shrink-0">
                            <i class="fas fa-mobile-alt text-[#0F3A75] text-3xl"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-lg mb-2 text-gray-800">Device Testing Lab</h4>
                            <p class="text-gray-600">Berbagai perangkat mobile untuk testing aplikasi</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-4">
                        <div class="bg-blue-50 p-4 rounded-lg flex-shrink-0">
                            <i class="fas fa-vr-cardboard text-[#0F3A75] text-3xl"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-lg mb-2 text-gray-800">AR/VR Equipment</h4>
                            <p class="text-gray-600">Perangkat AR/VR untuk pengembangan aplikasi immersive</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-4">
                        <div class="bg-blue-50 p-4 rounded-lg flex-shrink-0">
                            <i class="fas fa-server text-[#0F3A75] text-3xl"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-lg mb-2 text-gray-800">Server Infrastructure</h4>
                            <p class="text-gray-600">Server untuk hosting dan deployment aplikasi</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Focus Areas -->
        <div class="max-w-6xl mx-auto mb-12">
            <div class="bg-white rounded-xl shadow-md p-10">
                <h2 class="text-3xl font-bold mb-8 text-[#0F3A75]">Bidang Fokus</h2>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
                    <div class="text-center p-4">
                        <div class="bg-[#0F3A75] text-white w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-laptop-code text-3xl"></i>
                        </div>
                        <h4 class="font-bold mb-2 text-gray-800">Web Development</h4>
                        <p class="text-gray-600 text-sm">Full-stack web development dengan teknologi modern</p>
                    </div>

                    <div class="text-center p-4">
                        <div class="bg-[#0F3A75] text-white w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-mobile-alt text-3xl"></i>
                        </div>
                        <h4 class="font-bold mb-2 text-gray-800">Mobile Apps</h4>
                        <p class="text-gray-600 text-sm">Native & cross-platform mobile application</p>
                    </div>

                    <div class="text-center p-4">
                        <div class="bg-[#0F3A75] text-white w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-paint-brush text-3xl"></i>
                        </div>
                        <h4 class="font-bold mb-2 text-gray-800">UI/UX Design</h4>
                        <p class="text-gray-600 text-sm">User interface & experience design</p>
                    </div>

                    <div class="text-center p-4">
                        <div class="bg-[#0F3A75] text-white w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-gamepad text-3xl"></i>
                        </div>
                        <h4 class="font-bold mb-2 text-gray-800">Game Development</h4>
                        <p class="text-gray-600 text-sm">2D & 3D game development</p>
                    </div>

                    <div class="text-center p-4">
                        <div class="bg-[#0F3A75] text-white w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-vr-cardboard text-3xl"></i>
                        </div>
                        <h4 class="font-bold mb-2 text-gray-800">AR/VR</h4>
                        <p class="text-gray-600 text-sm">Augmented & virtual reality applications</p>
                    </div>

                    <div class="text-center p-4">
                        <div class="bg-[#0F3A75] text-white w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-video text-3xl"></i>
                        </div>
                        <h4 class="font-bold mb-2 text-gray-800">Multimedia</h4>
                        <p class="text-gray-600 text-sm">Video editing & motion graphics</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Team Members -->
        <div class="max-w-6xl mx-auto">
            <h2 class="text-3xl font-bold mb-8 text-[#0F3A75] text-center">Anggota Tim</h2>
            
            <?php 
            // Separate head and members
            $heads = array_filter($data['team_members'], function($member) {
                return $member['is_head'];
            });
            $members = array_filter($data['team_members'], function($member) {
                return !$member['is_head'];
            });
            ?>

            <!-- Head of Lab -->
            <?php if (!empty($heads)): ?>
            <div class="flex justify-center mb-8">
                <?php foreach ($heads as $head): ?>
                <div class="bg-white rounded-lg shadow-md p-6 text-center w-64 team-member-card mx-2">
                    <div class="w-32 h-32 mx-auto mb-4 rounded-full overflow-hidden bg-gray-200">
                        <?php if ($head['photo']): ?>
                        <img src="<?= BASE_URL ?>/assets/img/team/<?= htmlspecialchars($head['photo']) ?>" 
                             alt="<?= htmlspecialchars($head['name']) ?>" 
                             class="w-full h-full object-cover" style="object-position: center top;">
                        <?php else: ?>
                        <div class="w-full h-full flex items-center justify-center bg-gray-300">
                            <i class="fas fa-user fa-3x text-gray-500"></i>
                        </div>
                        <?php endif; ?>
                    </div>
                    <h4 class="font-bold text-gray-800 mb-1"><?= htmlspecialchars($head['name']) ?></h4>
                    <p class="text-blue-600 text-sm font-semibold"><?= htmlspecialchars($head['position']) ?></p>
                </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>

            <!-- Team Members Grid -->
            <?php if (!empty($members)): ?>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <?php foreach ($members as $member): ?>
                <div class="bg-white rounded-lg shadow-md p-6 text-center team-member-card">
                    <div class="w-32 h-32 mx-auto mb-4 rounded-full overflow-hidden bg-gray-200">
                        <?php if ($member['photo']): ?>
                        <img src="<?= BASE_URL ?>/assets/img/team/<?= htmlspecialchars($member['photo']) ?>" 
                             alt="<?= htmlspecialchars($member['name']) ?>" 
                             class="w-full h-full object-cover" style="object-position: center top;">
                        <?php else: ?>
                        <div class="w-full h-full flex items-center justify-center bg-gray-300">
                            <i class="fas fa-user fa-3x text-gray-500"></i>
                        </div>
                        <?php endif; ?>
                    </div>
                    <h4 class="font-bold text-gray-800 mb-1"><?= htmlspecialchars($member['name']) ?></h4>
                    <p class="text-blue-600 text-sm"><?= htmlspecialchars($member['position']) ?></p>
                </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php require_once '../app/views/layouts/footer.php'; ?>
