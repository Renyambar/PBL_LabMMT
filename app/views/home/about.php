<?php require_once '../app/views/layouts/header.php'; ?>

<!-- Page Header -->
<section class="text-white py-20 bg-[linear-gradient(90deg,#0A2A78,#1E4DB8,#2D72F0)]">
    <div class="container mx-auto px-4">
        <h1 class="text-5xl font-bold mb-3">PROFIL LABORATORIUM</h1>
        <p class="text-xl opacity-90">Laboratorium Multimedia & Mobile Technology</p>
    </div>
</section>

<!-- About Content -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <!-- Lab Introduction Card -->
        <div class="max-w-6xl mx-auto mb-12">
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="md:flex">
                    <div class="md:w-1/2 p-10">
                        <h2 class="text-3xl font-bold mb-4 text-blue-800">Laboratorium Multimedia & Mobile Technology</h2>
                        <p class="text-gray-700 leading-relaxed mb-4">
                            Laboratorium Multimedia dan Mobile Technology merupakan salah satu laboratorium unggulan di Jurusan Teknologi Informasi Politeknik Negeri Malang. Laboratorium ini didirikan pada tahun 2015 dengan tujuan untuk memfasilitasi mahasiswa dalam mengembangkan keterampilan di bidang multimedia dan pengembangan aplikasi mobile.
                        </p>
                    </div>
                    <div class="md:w-1/2">
                        <img src="/Lab-MMT/public/assets/img/partners/lab-team.jpg" alt="Lab Team" class="w-full h-full object-cover">
                    </div>
                </div>
            </div>
        </div>

        <!-- Vision & Mission -->
        <div class="max-w-6xl mx-auto mb-12">
            <div class="bg-white rounded-xl shadow-md p-10">
                <h2 class="text-3xl font-bold mb-8 text-blue-800">Visi & Misi</h2>
                
                <div class="mb-8">
                    <div class="flex items-start mb-4">
                        <div class="bg-blue-100 rounded-full p-3 mr-4">
                            <i class="fas fa-eye text-blue-700 text-2xl"></i>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold mb-3 text-gray-800">Visi</h3>
                            <p class="text-gray-700 leading-relaxed">
                                Menjadi laboratorium unggulan dalam pengembangan teknologi multimedia dan mobile yang inovatif, serta menghasilkan lulusan yang kompeten dan siap menghadapi tantangan industri digital.
                            </p>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="flex items-start">
                        <div class="bg-blue-100 rounded-full p-3 mr-4">
                            <i class="fas fa-bullseye text-blue-700 text-2xl"></i>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold mb-4 text-gray-800">Misi</h3>
                            <ul class="space-y-3">
                                <li class="flex items-start">
                                    <i class="fas fa-check-circle text-blue-600 mr-3 mt-1"></i>
                                    <span class="text-gray-700">Menyelenggarakan pendidikan dan pelatihan berbasis teknologi multimedia dan mobile yang berkualitas</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check-circle text-blue-600 mr-3 mt-1"></i>
                                    <span class="text-gray-700">Melakukan penelitian dan pengembangan inovasi di bidang teknologi digital</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check-circle text-blue-600 mr-3 mt-1"></i>
                                    <span class="text-gray-700">Membangun kemitraan dengan industri untuk meningkatkan kompetensi mahasiswa</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check-circle text-blue-600 mr-3 mt-1"></i>
                                    <span class="text-gray-700">Menghasilkan karya dan publikasi ilmiah yang bermanfaat bagi masyarakat</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Facilities -->
        <div class="max-w-6xl mx-auto mb-12">
            <div class="bg-white rounded-xl shadow-md p-10">
                <h2 class="text-3xl font-bold mb-8 text-blue-800">Fasilitas</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="flex items-start space-x-4">
                        <div class="bg-blue-50 p-4 rounded-lg flex-shrink-0">
                            <i class="fas fa-desktop text-blue-700 text-3xl"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-lg mb-2 text-gray-800">Komputer High-End</h4>
                            <p class="text-gray-600">Workstation dengan spesifikasi tinggi untuk development dan rendering</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-4">
                        <div class="bg-blue-50 p-4 rounded-lg flex-shrink-0">
                            <i class="fas fa-mobile-alt text-blue-700 text-3xl"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-lg mb-2 text-gray-800">Device Testing Lab</h4>
                            <p class="text-gray-600">Berbagai perangkat mobile untuk testing aplikasi</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-4">
                        <div class="bg-blue-50 p-4 rounded-lg flex-shrink-0">
                            <i class="fas fa-vr-cardboard text-blue-700 text-3xl"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-lg mb-2 text-gray-800">AR/VR Equipment</h4>
                            <p class="text-gray-600">Perangkat AR/VR untuk pengembangan aplikasi immersive</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-4">
                        <div class="bg-blue-50 p-4 rounded-lg flex-shrink-0">
                            <i class="fas fa-server text-blue-700 text-3xl"></i>
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
                <h2 class="text-3xl font-bold mb-8 text-blue-800">Bidang Fokus</h2>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
                    <div class="text-center p-4">
                        <div class="bg-blue-600 text-white w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-laptop-code text-3xl"></i>
                        </div>
                        <h4 class="font-bold mb-2 text-gray-800">Web Development</h4>
                        <p class="text-gray-600 text-sm">Full-stack web development dengan teknologi modern</p>
                    </div>

                    <div class="text-center p-4">
                        <div class="bg-blue-600 text-white w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-mobile-alt text-3xl"></i>
                        </div>
                        <h4 class="font-bold mb-2 text-gray-800">Mobile Apps</h4>
                        <p class="text-gray-600 text-sm">Native & cross-platform mobile application</p>
                    </div>

                    <div class="text-center p-4">
                        <div class="bg-blue-600 text-white w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-paint-brush text-3xl"></i>
                        </div>
                        <h4 class="font-bold mb-2 text-gray-800">UI/UX Design</h4>
                        <p class="text-gray-600 text-sm">User interface & experience design</p>
                    </div>

                    <div class="text-center p-4">
                        <div class="bg-blue-600 text-white w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-gamepad text-3xl"></i>
                        </div>
                        <h4 class="font-bold mb-2 text-gray-800">Game Development</h4>
                        <p class="text-gray-600 text-sm">2D & 3D game development</p>
                    </div>

                    <div class="text-center p-4">
                        <div class="bg-blue-600 text-white w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-vr-cardboard text-3xl"></i>
                        </div>
                        <h4 class="font-bold mb-2 text-gray-800">AR/VR</h4>
                        <p class="text-gray-600 text-sm">Augmented & virtual reality applications</p>
                    </div>

                    <div class="text-center p-4">
                        <div class="bg-blue-600 text-white w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-video text-3xl"></i>
                        </div>
                        <h4 class="font-bold mb-2 text-gray-800">Multimedia</h4>
                        <p class="text-gray-600 text-sm">Video editing & motion graphics</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistics -->
        <div class="max-w-6xl mx-auto mb-12">
            <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
                <div class="bg-white rounded-lg shadow-md p-6 text-center">
                    <div class="text-4xl font-bold text-blue-700 mb-2">120+</div>
                    <div class="text-gray-600 text-sm font-semibold">MAHASISWA</div>
                </div>
                <div class="bg-white rounded-lg shadow-md p-6 text-center">
                    <div class="text-4xl font-bold text-blue-700 mb-2">48+</div>
                    <div class="text-gray-600 text-sm font-semibold">PROJECT</div>
                </div>
                <div class="bg-white rounded-lg shadow-md p-6 text-center">
                    <div class="text-4xl font-bold text-blue-700 mb-2">24+</div>
                    <div class="text-gray-600 text-sm font-semibold">MITRA KERJA</div>
                </div>
                <div class="bg-white rounded-lg shadow-md p-6 text-center">
                    <div class="text-4xl font-bold text-blue-700 mb-2">10+</div>
                    <div class="text-gray-600 text-sm font-semibold">AWARD</div>
                </div>
                <div class="bg-white rounded-lg shadow-md p-6 text-center">
                    <div class="text-4xl font-bold text-blue-700 mb-2">15+</div>
                    <div class="text-gray-600 text-sm font-semibold">PENGHARGAAN</div>
                </div>
            </div>
        </div>

        <!-- Team Members -->
        <div class="max-w-6xl mx-auto">
            <h2 class="text-3xl font-bold mb-8 text-blue-800 text-center">Anggota Tim</h2>
            
            <!-- Head of Lab -->
            <div class="flex justify-center mb-8">
                <div class="bg-white rounded-lg shadow-md p-6 text-center w-64 team-member-card">
                    <div class="w-32 h-32 mx-auto mb-4 rounded-full overflow-hidden bg-gray-200">
                        <img src="/Lab-MMT/public/assets/img/partners/dimas-wahyu.jpg" alt="Dimas Wahyu Wibowo" class="w-full h-full object-cover" style="object-position: center 20%;">
                    </div>
                    <h4 class="font-bold text-gray-800 mb-1">Dimas Wahyu Wibowo, ST., MT.</h4>
                    <p class="text-blue-600 text-sm font-semibold">Kepala Lab</p>
                </div>
            </div>

            <!-- Team Members Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white rounded-lg shadow-md p-6 text-center team-member-card">
                    <div class="w-32 h-32 mx-auto mb-4 rounded-full overflow-hidden bg-gray-200">
                        <img src="/Lab-MMT/public/assets/img/partners/eka-larasati.jpg" alt="Eka Larasati Amalia" class="w-full h-full object-cover"style="object-position: center 10%;">
                    </div>
                    <h4 class="font-bold text-gray-800 mb-1">Eka Larasati Amalia, S.ST., MT.</h4>
                    <p class="text-blue-600 text-sm">Peneliti</p>
                </div>

                <div class="bg-white rounded-lg shadow-md p-6 text-center team-member-card">
                    <div class="w-32 h-32 mx-auto mb-4 rounded-full overflow-hidden bg-gray-200">
                        <img src="/Lab-MMT/public/assets/img/partners/cahya-rahmad.jpg" alt="Prof. Dr. Eng. Cahya Rahmad" class="w-full h-full object-cover"style="object-position: center 10%;">
                    </div>
                    <h4 class="font-bold text-gray-800 mb-1">Prof. Dr. Eng. Cahya Rahmad, ST., M.Kom.</h4>
                    <p class="text-blue-600 text-sm">Peneliti</p>
                </div>

                <div class="bg-white rounded-lg shadow-md p-6 text-center team-member-card">
                    <div class="w-32 h-32 mx-auto mb-4 rounded-full overflow-hidden bg-gray-200">
                        <img src="/Lab-MMT/public/assets/img/partners/adevian-fairuz.jpg" alt="Adevian Fairuz Pratama" class="w-full h-full object-cover"style="object-position: center 10%;">
                    </div>
                    <h4 class="font-bold text-gray-800 mb-1">Adevian Fairuz Pratama, S.S T., M.Eng.</h4>
                    <p class="text-blue-600 text-sm">Peneliti</p>
                </div>
            </div>

            <!-- Additional Team Members -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white rounded-lg shadow-md p-6 text-center team-member-card">
                    <div class="w-32 h-32 mx-auto mb-4 rounded-full overflow-hidden bg-gray-200">
                        <img src="/Lab-MMT/public/assets/img/partners/bagus-satya.jpg" alt="Bagus Satya Dian Nugraha" class="w-full h-full object-cover"style="object-position: center 10%;">
                    </div>
                    <h4 class="font-bold text-gray-800 mb-1">Bagus Satya Dian Nugraha, ST., MT.</h4>
                    <p class="text-blue-600 text-sm">Peneliti</p>
                </div>

                <div class="bg-white rounded-lg shadow-md p-6 text-center team-member-card">
                    <div class="w-32 h-32 mx-auto mb-4 rounded-full overflow-hidden bg-gray-200">
                        <img src="/Lab-MMT/public/assets/img/partners/anugrah-nur.jpg" alt="Anugrah Nur Rahmanto" class="w-full h-full object-cover"style="object-position: center 10%;">
                    </div>
                    <h4 class="font-bold text-gray-800 mb-1">Anugrah Nur Rahmanto, S.Sn., M.Ds.</h4>
                    <p class="text-blue-600 text-sm">Peneliti</p>
                </div>

                <div class="bg-white rounded-lg shadow-md p-6 text-center team-member-card">
                    <div class="w-32 h-32 mx-auto mb-4 rounded-full overflow-hidden bg-gray-200">
                        <img src="/Lab-MMT/public/assets/img/partners/muhammad-unggul.jpg" alt="Muhammad Unggul Pamenang" class="w-full h-full object-cover"style="object-position: center 10%;">
                    </div>
                    <h4 class="font-bold text-gray-800 mb-1">Muhammad Unggul Pamenang, S.ST., M.T.</h4>
                    <p class="text-blue-600 text-sm">Peneliti</p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once '../app/views/layouts/footer.php'; ?>
