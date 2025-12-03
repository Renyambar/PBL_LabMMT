<?php require_once '../app/views/layouts/header.php'; ?>

<!-- Page Header -->
<section class="bg-gradient-to-r from-black/100 via-blue-800 to-blue-600 text-white py-16">
    <div class="container mx-auto px-4">
        <h1 class="text-4xl font-bold mb-4">Hubungi Kami</h1>
        <p class="text-xl">Kami siap membantu dan menjawab pertanyaan Anda</p>
    </div>
</section>

<!-- Contact Content -->
<section class="py-16">
    <div class="container mx-auto px-4">
        <div class="max-w-6xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Contact Form -->
                <div class="bg-white rounded-lg shadow-lg p-8">
                    <h2 class="text-2xl font-bold mb-6">Kirim Pesan</h2>
                    <form action="#" method="POST" class="space-y-6">
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2" for="name">
                                Nama Lengkap
                            </label>
                            <input type="text" id="name" name="name" required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
                                   placeholder="John Doe">
                        </div>

                        <div>
                            <label class="block text-gray-700 font-semibold mb-2" for="email">
                                Email
                            </label>
                            <input type="email" id="email" name="email" required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
                                   placeholder="john@example.com">
                        </div>

                        <div>
                            <label class="block text-gray-700 font-semibold mb-2" for="subject">
                                Subjek
                            </label>
                            <input type="text" id="subject" name="subject" required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
                                   placeholder="Perihal pesan">
                        </div>

                        <div>
                            <label class="block text-gray-700 font-semibold mb-2" for="message">
                                Pesan
                            </label>
                            <textarea id="message" name="message" rows="5" required
                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
                                      placeholder="Tulis pesan Anda di sini..."></textarea>
                        </div>

                        <button type="submit" 
                                class="w-full bg-[#0F3A75] text-white py-3 rounded-lg font-semibold hover:bg-[#0C2F61] transition">
                            <i class="fas fa-paper-plane mr-2"></i>Kirim Pesan
                        </button>
                    </form>
                </div>

                <!-- Contact Info -->
                <div>
                    <!-- Info Cards -->
                    <div class="bg-white rounded-lg shadow-lg p-8 mb-6">
                        <h2 class="text-2xl font-bold mb-6">Informasi Kontak</h2>
                        
                        <div class="space-y-6">
                            <div class="flex items-start space-x-4">
                                <div class="bg-[#0F3A75] text-white w-12 h-12 rounded-full flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold mb-1">Alamat</h4>
                                    <p class="text-gray-600">Gedung Teknologi Informasi<br>
                                    Kampus Universitas, Jl. Pendidikan No. 123<br>
                                    Kota, Provinsi 12345</p>
                                </div>
                            </div>

                            <div class="flex items-start space-x-4">
                                <div class="bg-[#0F3A75] text-white w-12 h-12 rounded-full flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-phone"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold mb-1">Telepon</h4>
                                    <p class="text-gray-600">+62 123 4567 890<br>
                                    +62 987 6543 210</p>
                                </div>
                            </div>

                            <div class="flex items-start space-x-4">
                                <div class="bg-[#0F3A75] text-white w-12 h-12 rounded-full flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold mb-1">Email</h4>
                                    <p class="text-gray-600">info@labmmt.com<br>
                                    contact@labmmt.com</p>
                                </div>
                            </div>

                            <div class="flex items-start space-x-4">
                                <div class="bg-primary text-white w-12 h-12 rounded-full flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-clock"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold mb-1">Jam Operasional</h4>
                                    <p class="text-gray-600">Senin - Jumat: 08:00 - 17:00<br>
                                    Sabtu: 08:00 - 14:00<br>
                                    Minggu: Tutup</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Social Media -->
                    <div class="bg-white rounded-lg shadow-lg p-8">
                        <h3 class="text-xl font-bold mb-4">Ikuti Kami</h3>
                        <div class="flex space-x-4">
                            <a href="#" class="bg-blue-600 text-white w-12 h-12 rounded-full flex items-center justify-center hover:bg-blue-700 transition">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#" class="bg-gradient-to-r from-purple-600 to-pink-600 text-white w-12 h-12 rounded-full flex items-center justify-center hover:opacity-90 transition">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a href="#" class="bg-sky-500 text-white w-12 h-12 rounded-full flex items-center justify-center hover:bg-sky-600 transition">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="#" class="bg-blue-700 text-white w-12 h-12 rounded-full flex items-center justify-center hover:bg-blue-800 transition">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a href="#" class="bg-red-600 text-white w-12 h-12 rounded-full flex items-center justify-center hover:bg-red-700 transition">
                                <i class="fab fa-youtube"></i>
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
