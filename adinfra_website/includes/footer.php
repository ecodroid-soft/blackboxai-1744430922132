</div><!-- End Content Wrapper -->

    <!-- Footer -->
    <footer class="bg-dark text-white mt-20">
        <div class="container mx-auto px-4 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Company Info -->
                <div class="col-span-1">
                    <img src="/assets/images/logo.svg" alt="<?php echo SITE_NAME; ?> Logo" class="h-12 mb-4 invert">
                    <p class="text-gray-300 mt-4">
                        Leading infrastructure development company providing innovative solutions for sustainable growth.
                    </p>
                </div>

                <!-- Quick Links -->
                <div class="col-span-1">
                    <h3 class="text-xl font-semibold mb-4">Quick Links</h3>
                    <ul class="space-y-2">
                        <li><a href="/" class="text-gray-300 hover:text-white transition-colors">Home</a></li>
                        <li><a href="/about" class="text-gray-300 hover:text-white transition-colors">About Us</a></li>
                        <li><a href="/projects" class="text-gray-300 hover:text-white transition-colors">Projects</a></li>
                        <li><a href="/contact" class="text-gray-300 hover:text-white transition-colors">Contact</a></li>
                    </ul>
                </div>

                <!-- Services -->
                <div class="col-span-1">
                    <h3 class="text-xl font-semibold mb-4">Our Services</h3>
                    <ul class="space-y-2">
                        <li class="text-gray-300">Infrastructure Development</li>
                        <li class="text-gray-300">Construction Management</li>
                        <li class="text-gray-300">Project Planning</li>
                        <li class="text-gray-300">Technical Consulting</li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div class="col-span-1">
                    <h3 class="text-xl font-semibold mb-4">Contact Us</h3>
                    <ul class="space-y-2">
                        <li class="flex items-center text-gray-300">
                            <i class="fas fa-map-marker-alt w-6"></i>
                            123 Business Avenue, City, Country
                        </li>
                        <li class="flex items-center text-gray-300">
                            <i class="fas fa-phone w-6"></i>
                            +1 234 567 890
                        </li>
                        <li class="flex items-center text-gray-300">
                            <i class="fas fa-envelope w-6"></i>
                            info@adinfra.com
                        </li>
                    </ul>

                    <!-- Social Media Links -->
                    <div class="mt-6 flex space-x-4">
                        <a href="#" class="text-gray-300 hover:text-white transition-colors">
                            <i class="fab fa-facebook-f text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-300 hover:text-white transition-colors">
                            <i class="fab fa-twitter text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-300 hover:text-white transition-colors">
                            <i class="fab fa-linkedin-in text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-300 hover:text-white transition-colors">
                            <i class="fab fa-instagram text-xl"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Bottom Bar -->
            <div class="border-t border-gray-700 mt-12 pt-8 text-center text-gray-300">
                <p>&copy; <?php echo date('Y'); ?> <?php echo SITE_NAME; ?>. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Swiper JS -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    
    <!-- Custom JS -->
    <script src="/assets/js/main.js"></script>
    
    <!-- Mobile Menu Script -->
    <script>
        function toggleMobileMenu() {
            const mobileMenu = document.getElementById('mobileMenu');
            mobileMenu.classList.toggle('hidden');
        }
    </script>

    <!-- Service Worker Registration -->
    <script>
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', () => {
                navigator.serviceWorker.register('/service-worker.js')
                    .then(registration => {
                        console.log('ServiceWorker registration successful');
                    })
                    .catch(err => {
                        console.log('ServiceWorker registration failed: ', err);
                    });
            });
        }
    </script>

    <?php if (isset($_SESSION['success_message'])): ?>
        <div id="successMessage" 
             class="fixed bottom-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg">
            <?php 
            echo $_SESSION['success_message'];
            unset($_SESSION['success_message']);
            ?>
        </div>
        <script>
            setTimeout(() => {
                document.getElementById('successMessage').style.display = 'none';
            }, 5000);
        </script>
    <?php endif; ?>

    <?php if (isset($_SESSION['error_message'])): ?>
        <div id="errorMessage" 
             class="fixed bottom-4 right-4 bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg">
            <?php 
            echo $_SESSION['error_message'];
            unset($_SESSION['error_message']);
            ?>
        </div>
        <script>
            setTimeout(() => {
                document.getElementById('errorMessage').style.display = 'none';
            }, 5000);
        </script>
    <?php endif; ?>
</body>
</html>
