<?php require_once '../app/views/layouts/header.php'; ?>

<!-- Page Header -->
<section class="bg-gradient-to-r from-primary to-secondary text-white py-16">
    <div class="container mx-auto px-4">
        <h1 class="text-4xl font-bold mb-4">Tentang Kami</h1>
        <p class="text-xl">Laboratorium Multimedia & Mobile Technology</p>
    </div>
</section>

<!-- About Content -->
<section class="py-16">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            <!-- Vision & Mission -->
            <div class="bg-white rounded-lg shadow-lg p-8 mb-8">
                <h2 class="text-3xl font-bold mb-6 text-primary">Visi & Misi</h2>
                
                <div class="mb-8">
                    <h3 class="text-2xl font-semibold mb-4 flex items-center">
                        <i class="fas fa-eye text-primary mr-3"></i>Visi
                    </h3>
                    <p class="text-gray-700 text-lg leading-relaxed">
                        Menjadi laboratorium unggulan dalam pengembangan teknologi multimedia dan mobile yang inovatif, 
                        serta menghasilkan lulusan yang kompeten dan siap menghadapi tantangan industri digital.
                    </p>
                </div>

                <div>
                    <h3 class="text-2xl font-semibold mb-4 flex items-center">
                        <i class="fas fa-bullseye text-primary mr-3"></i>Misi
                    </h3>
                    <ul class="space-y-3">
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-primary mr-3 mt-1"></i>
                            <span class="text-gray-700">Menyelenggarakan pendidikan dan pelatihan berbasis teknologi multimedia dan mobile yang berkualitas</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-primary mr-3 mt-1"></i>
                            <span class="text-gray-700">Melakukan penelitian dan pengembangan inovasi di bidang teknologi digital</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-primary mr-3 mt-1"></i>
                            <span class="text-gray-700">Membangun kemitraan dengan industri untuk meningkatkan kompetensi mahasiswa</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-primary mr-3 mt-1"></i>
                            <span class="text-gray-700">Menghasilkan karya dan publikasi ilmiah yang bermanfaat bagi masyarakat</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Facilities -->
            <div class="bg-white rounded-lg shadow-lg p-8 mb-8">
                <h2 class="text-3xl font-bold mb-6 text-primary">Fasilitas</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="flex items-start space-x-4">
                        <div class="bg-blue-100 p-4 rounded-lg">
                            <i class="fas fa-desktop text-primary text-3xl"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-lg mb-2">Komputer High-End</h4>
                            <p class="text-gray-600">Workstation dengan spesifikasi tinggi untuk development dan rendering</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-4">
                        <div class="bg-blue-100 p-4 rounded-lg">
                            <i class="fas fa-mobile-alt text-primary text-3xl"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-lg mb-2">Device Testing Lab</h4>
                            <p class="text-gray-600">Berbagai perangkat mobile untuk testing aplikasi</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-4">
                        <div class="bg-blue-100 p-4 rounded-lg">
                            <i class="fas fa-vr-cardboard text-primary text-3xl"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-lg mb-2">AR/VR Equipment</h4>
                            <p class="text-gray-600">Perangkat AR/VR untuk pengembangan aplikasi immersive</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-4">
                        <div class="bg-blue-100 p-4 rounded-lg">
                            <i class="fas fa-server text-primary text-3xl"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-lg mb-2">Server Infrastructure</h4>
                            <p class="text-gray-600">Server untuk hosting dan deployment aplikasi</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Focus Areas -->
            <div class="bg-white rounded-lg shadow-lg p-8">
                <h2 class="text-3xl font-bold mb-6 text-primary">Bidang Fokus</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="text-center">
                        <div class="bg-primary text-white w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-laptop-code text-2xl"></i>
                        </div>
                        <h4 class="font-bold mb-2">Web Development</h4>
                        <p class="text-gray-600 text-sm">Full-stack web development dengan teknologi modern</p>
                    </div>

                    <div class="text-center">
                        <div class="bg-primary text-white w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-mobile-alt text-2xl"></i>
                        </div>
                        <h4 class="font-bold mb-2">Mobile Apps</h4>
                        <p class="text-gray-600 text-sm">Native & cross-platform mobile application</p>
                    </div>

                    <div class="text-center">
                        <div class="bg-primary text-white w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-paint-brush text-2xl"></i>
                        </div>
                        <h4 class="font-bold mb-2">UI/UX Design</h4>
                        <p class="text-gray-600 text-sm">User interface & experience design</p>
                    </div>

                    <div class="text-center">
                        <div class="bg-primary text-white w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-gamepad text-2xl"></i>
                        </div>
                        <h4 class="font-bold mb-2">Game Development</h4>
                        <p class="text-gray-600 text-sm">2D & 3D game development</p>
                    </div>

                    <div class="text-center">
                        <div class="bg-primary text-white w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-vr-cardboard text-2xl"></i>
                        </div>
                        <h4 class="font-bold mb-2">AR/VR</h4>
                        <p class="text-gray-600 text-sm">Augmented & virtual reality applications</p>
                    </div>

                    <div class="text-center">
                        <div class="bg-primary text-white w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-video text-2xl"></i>
                        </div>
                        <h4 class="font-bold mb-2">Multimedia</h4>
                        <p class="text-gray-600 text-sm">Video editing & motion graphics</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once '../app/views/layouts/footer.php'; ?>
