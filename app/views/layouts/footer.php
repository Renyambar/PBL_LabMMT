    <!-- Footer -->
    <footer class="bg-gray-900 text-white mt-16">
        <div class="container mx-auto px-4 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- About -->
                <div>
                    <h3 class="text-xl font-bold mb-4">Lab MMT</h3>
                    <p class="text-gray-400">Laboratorium Multimedia & Mobile Technology</p>
                    <p class="text-gray-400 mt-2">Mengembangkan inovasi digital untuk masa depan.</p>
                </div>

                <!-- Quick Links -->
                <div>
                    <h3 class="text-xl font-bold mb-4">Quick Links</h3>
                    <ul class="space-y-2">
                        <li><a href="<?= BASE_URL ?>" class="text-gray-400 hover:text-white transition">Home</a></li>
                        <li><a href="<?= BASE_URL ?>/project" class="text-gray-400 hover:text-white transition">Projects</a></li>
                        <li><a href="<?= BASE_URL ?>/article" class="text-gray-400 hover:text-white transition">Articles</a></li>
                        <li><a href="<?= BASE_URL ?>/gallery" class="text-gray-400 hover:text-white transition">Gallery</a></li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div>
                    <h3 class="text-xl font-bold mb-4">Contact</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li><i class="fas fa-envelope mr-2"></i>info@labmmt.com</li>
                        <li><i class="fas fa-phone mr-2"></i>+62 123 4567 890</li>
                        <li><i class="fas fa-map-marker-alt mr-2"></i>Kampus IT, Indonesia</li>
                    </ul>
                </div>

                <!-- Social Media -->
                <div>
                    <h3 class="text-xl font-bold mb-4">Follow Us</h3>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white transition text-2xl"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white transition text-2xl"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white transition text-2xl"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white transition text-2xl"><i class="fab fa-linkedin"></i></a>
                    </div>
                </div>
            </div>

            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; <?= date('Y') ?> Lab MMT. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- AOS Animation Library -->
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        // Initialize AOS
        AOS.init({
            duration: 1000,
            easing: 'ease-in-out',
            once: true,
            mirror: false
        });

        // Mobile menu toggle (check if element exists first)
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        if (mobileMenuBtn) {
            mobileMenuBtn.addEventListener('click', function() {
                const menu = document.getElementById('mobile-menu');
                if (menu) {
                    menu.classList.toggle('hidden');
                }
            });
        }
    </script>
</body>
</html>
