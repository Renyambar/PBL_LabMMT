<?php require_once '../app/views/layouts/header.php'; ?>

<!-- Page Header -->
<section class="bg-gradient-to-r from-black/100 via-blue-800 to-blue-600 text-white py-16">
    <div class="container mx-auto px-4" data-aos="fade-down">
        <h1 class="text-4xl font-bold mb-4">Hubungi Kami</h1>
        <p class="text-xl">Kami siap membantu dan menjawab pertanyaan Anda</p>
    </div>
</section>

<!-- Contact Content -->
<section class="py-16">
    <div class="container mx-auto px-4">
        <div class="max-w-6xl mx-auto">
            <!-- Contact Info Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
                <div class="bg-white rounded-lg shadow-lg p-6 text-center hover:shadow-xl transition" data-aos="flip-up" data-aos-delay="0">
                    <div class="bg-gradient-to-br from-primary to-secondary text-white w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-map-marker-alt text-2xl"></i>
                    </div>
                    <h4 class="font-semibold text-lg mb-2">Alamat</h4>
                    <p class="text-gray-600 text-sm">Gedung Teknologi Informasi<br>
                    Politeknik Negeri Malang<br>
                    Jl. Soekarno Hatta No.9, Malang</p>
                </div>

                <div class="bg-white rounded-lg shadow-lg p-6 text-center hover:shadow-xl transition" data-aos="flip-up" data-aos-delay="100">
                    <div class="bg-gradient-to-br from-primary to-secondary text-white w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-phone text-2xl"></i>
                    </div>
                    <h4 class="font-semibold text-lg mb-2">Telepon</h4>
                    <p class="text-gray-600 text-sm">+62 (341) 404424<br>
                    +62 (341) 404420<br>
                    Ext. 1234</p>
                </div>

                <div class="bg-white rounded-lg shadow-lg p-6 text-center hover:shadow-xl transition" data-aos="flip-up" data-aos-delay="200">
                    <div class="bg-gradient-to-br from-primary to-secondary text-white w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-envelope text-2xl"></i>
                    </div>
                    <h4 class="font-semibold text-lg mb-2">Email</h4>
                    <p class="text-gray-600 text-sm">labmmt@polinema.ac.id<br>
                    jti@polinema.ac.id<br>
                    &nbsp;</p>
                </div>

                <div class="bg-white rounded-lg shadow-lg p-6 text-center hover:shadow-xl transition" data-aos="flip-up" data-aos-delay="300">
                    <div class="bg-gradient-to-br from-primary to-secondary text-white w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-clock text-2xl"></i>
                    </div>
                    <h4 class="font-semibold text-lg mb-4">Jam Operasional</h4>
                    <p class="text-gray-600 text-sm">Senin - Jumat<br>
                    08:00 - 17:00 WIB<br>
                    Sabtu: 08:00 - 14:00</p>
                </div>
            </div>

            <!-- Detailed Info & Social Media -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-12">
                <!-- Tentang Lab MMT -->
                <div class="lg:col-span-2 bg-white rounded-lg shadow-lg p-8" data-aos="fade-right">
                    <h2 class="text-2xl font-bold mb-4 flex items-center">
                        <i class="fas fa-info-circle text-primary mr-3"></i>
                        Tentang Lab MMT
                    </h2>
                    <p class="text-gray-600 mb-4 leading-relaxed">
                        Laboratorium Multimedia dan Game Teknologi (Lab MMT) merupakan fasilitas unggulan 
                        Jurusan Teknologi Informasi Politeknik Negeri Malang yang berfokus pada pengembangan 
                        multimedia interaktif, game development, dan teknologi digital kreatif.
                    </p>
                    <p class="text-gray-600 mb-6 leading-relaxed">
                        Kami menyediakan berbagai layanan konsultasi, pelatihan, dan kerjasama penelitian 
                        di bidang multimedia, game development, augmented reality, virtual reality, dan 
                        teknologi digital lainnya.
                    </p>
                    
                    <div class="border-t pt-6">
                        <h3 class="font-semibold text-lg mb-3">Layanan Kami:</h3>
                        <ul class="space-y-2 text-gray-600">
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-primary mt-1 mr-3"></i>
                                <span>Konsultasi Pengembangan Aplikasi Multimedia</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-primary mt-1 mr-3"></i>
                                <span>Pelatihan Game Development & AR/VR</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-primary mt-1 mr-3"></i>
                                <span>Kerjasama Penelitian & Pengembangan</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-primary mt-1 mr-3"></i>
                                <span>Pendampingan Proyek Mahasiswa</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Social Media & Quick Contact -->
                <div class="space-y-6">
                    <!-- Social Media -->
                    <div class="bg-white rounded-lg shadow-lg p-8">
                        <h3 class="text-xl font-bold mb-4 flex items-center">
                            <i class="fas fa-share-alt text-primary mr-3"></i>
                            Media Sosial
                        </h3>
                        <p class="text-gray-600 text-sm mb-6">Ikuti kami untuk update terbaru</p>
                        <div class="space-y-3">
                            <a href="#" class="flex items-center space-x-4 p-3 rounded-lg hover:bg-gray-50 transition group">
                                <div class="bg-blue-600 text-white w-10 h-10 rounded-full flex items-center justify-center group-hover:scale-110 transition">
                                    <i class="fab fa-facebook-f"></i>
                                </div>
                                <div>
                                    <div class="font-semibold text-gray-800">Facebook</div>
                                    <div class="text-xs text-gray-500">@LabMMTPolinema</div>
                                </div>
                            </a>
                            
                            <a href="#" class="flex items-center space-x-4 p-3 rounded-lg hover:bg-gray-50 transition group">
                                <div class="bg-gradient-to-r from-purple-600 to-pink-600 text-white w-10 h-10 rounded-full flex items-center justify-center group-hover:scale-110 transition">
                                    <i class="fab fa-instagram"></i>
                                </div>
                                <div>
                                    <div class="font-semibold text-gray-800">Instagram</div>
                                    <div class="text-xs text-gray-500">@labmmt.polinema</div>
                                </div>
                            </a>
                            
                            <a href="#" class="flex items-center space-x-4 p-3 rounded-lg hover:bg-gray-50 transition group">
                                <div class="bg-blue-700 text-white w-10 h-10 rounded-full flex items-center justify-center group-hover:scale-110 transition">
                                    <i class="fab fa-linkedin-in"></i>
                                </div>
                                <div>
                                    <div class="font-semibold text-gray-800">LinkedIn</div>
                                    <div class="text-xs text-gray-500">Lab MMT JTI Polinema</div>
                                </div>
                            </a>
                            
                            <a href="#" class="flex items-center space-x-4 p-3 rounded-lg hover:bg-gray-50 transition group">
                                <div class="bg-red-600 text-white w-10 h-10 rounded-full flex items-center justify-center group-hover:scale-110 transition">
                                    <i class="fab fa-youtube"></i>
                                </div>
                                <div>
                                    <div class="font-semibold text-gray-800">YouTube</div>
                                    <div class="text-xs text-gray-500">Lab MMT Channel</div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <!-- Quick Links -->
                    <div class="bg-gradient-to-br from-primary to-secondary rounded-lg shadow-lg p-8 text-white">
                        <h3 class="text-xl font-bold mb-4">
                            <i class="fas fa-link mr-2"></i>Tautan Penting
                        </h3>
                        <div class="space-y-2">
                            <a href="https://polinema.ac.id" target="_blank" class="block hover:underline">
                                <i class="fas fa-external-link-alt mr-2"></i>Politeknik Negeri Malang
                            </a>
                            <a href="https://jti.polinema.ac.id" target="_blank" class="block hover:underline">
                                <i class="fas fa-external-link-alt mr-2"></i>Jurusan Teknologi Informasi
                            </a>
                            <a href="<?= BASE_URL ?>/project" class="block hover:underline">
                                <i class="fas fa-folder mr-2"></i>Lihat Proyek Kami
                            </a>
                            <a href="<?= BASE_URL ?>/article" class="block hover:underline">
                                <i class="fas fa-newspaper mr-2"></i>Artikel & Publikasi
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Map -->
            <div class="mt-8 bg-white rounded-lg shadow-lg overflow-hidden">
                <h3 class="text-2xl font-bold p-6 border-b">Lokasi Kami</h3>
                <div class="h-96">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3951.562361178489!2d112.61401407499654!3d-7.946867992071854!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e78827687d272e7%3A0x789ce9a636cd3aa2!2sPoliteknik%20Negeri%20Malang!5e0!3m2!1sid!2sid!4v1733199600000!5m2!1sid!2sid"
                        width="100%" 
                        height="100%" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade"
                        class="w-full h-full">
                    </iframe>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once '../app/views/layouts/footer.php'; ?>
