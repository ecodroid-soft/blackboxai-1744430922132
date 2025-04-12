<?php include 'includes/header.php'; ?>

<!-- Hero Slider Section -->
<div class="swiper-container h-[600px] relative">
    <div class="swiper-wrapper">
        <!-- Slide 1 -->
        <div class="swiper-slide relative">
            <img src="https://images.pexels.com/photos/1117452/pexels-photo-1117452.jpeg" 
                 class="w-full h-full object-cover" alt="Construction Site">
            <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center">
                <div class="container mx-auto px-4">
                    <h1 class="text-white text-4xl md:text-6xl font-bold mb-4">
                        Building Tomorrow's <span class="text-accent">Infrastructure</span>
                    </h1>
                    <p class="text-white text-xl mb-8">Leading the way in infrastructure development and innovation</p>
                    <a href="contact.php" 
                       class="bg-accent hover:bg-accent/90 text-white px-8 py-3 rounded-full transition-colors inline-block">
                        Get Started
                    </a>
                </div>
            </div>
        </div>

        <!-- Slide 2 -->
        <div class="swiper-slide relative">
            <img src="https://images.pexels.com/photos/2760243/pexels-photo-2760243.jpeg" 
                 class="w-full h-full object-cover" alt="Modern Architecture">
            <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center">
                <div class="container mx-auto px-4">
                    <h1 class="text-white text-4xl md:text-6xl font-bold mb-4">
                        Excellence in <span class="text-accent">Construction</span>
                    </h1>
                    <p class="text-white text-xl mb-8">Creating sustainable solutions for a better future</p>
                    <a href="projects.php" 
                       class="bg-accent hover:bg-accent/90 text-white px-8 py-3 rounded-full transition-colors inline-block">
                        View Projects
                    </a>
                </div>
            </div>
        </div>

        <!-- Slide 3 -->
        <div class="swiper-slide relative">
            <img src="https://images.pexels.com/photos/1216589/pexels-photo-1216589.jpeg" 
                 class="w-full h-full object-cover" alt="Infrastructure Project">
            <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center">
                <div class="container mx-auto px-4">
                    <h1 class="text-white text-4xl md:text-6xl font-bold mb-4">
                        Innovative <span class="text-accent">Solutions</span>
                    </h1>
                    <p class="text-white text-xl mb-8">Transforming ideas into remarkable achievements</p>
                    <a href="about.php" 
                       class="bg-accent hover:bg-accent/90 text-white px-8 py-3 rounded-full transition-colors inline-block">
                        Learn More
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Add Navigation -->
    <div class="swiper-button-next text-white"></div>
    <div class="swiper-button-prev text-white"></div>
    <!-- Add Pagination -->
    <div class="swiper-pagination"></div>
</div>

<!-- Services Section -->
<section class="py-20 bg-light">
    <div class="container mx-auto px-4">
        <h2 class="text-4xl font-bold text-center mb-12 text-gradient">Our Services</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Service 1 -->
            <div class="bg-white p-8 rounded-lg shadow-lg hover:shadow-xl transition-shadow">
                <div class="text-primary text-4xl mb-4">
                    <i class="fas fa-building"></i>
                </div>
                <h3 class="text-xl font-semibold mb-4">Infrastructure Development</h3>
                <p class="text-gray-600">Comprehensive infrastructure solutions for modern development needs.</p>
            </div>

            <!-- Service 2 -->
            <div class="bg-white p-8 rounded-lg shadow-lg hover:shadow-xl transition-shadow">
                <div class="text-primary text-4xl mb-4">
                    <i class="fas fa-hard-hat"></i>
                </div>
                <h3 class="text-xl font-semibold mb-4">Construction Management</h3>
                <p class="text-gray-600">Expert management of construction projects from inception to completion.</p>
            </div>

            <!-- Service 3 -->
            <div class="bg-white p-8 rounded-lg shadow-lg hover:shadow-xl transition-shadow">
                <div class="text-primary text-4xl mb-4">
                    <i class="fas fa-drafting-compass"></i>
                </div>
                <h3 class="text-xl font-semibold mb-4">Project Planning</h3>
                <p class="text-gray-600">Strategic planning and execution of complex infrastructure projects.</p>
            </div>
        </div>
    </div>
</section>

<!-- Featured Projects Section -->
<section class="py-20">
    <div class="container mx-auto px-4">
        <h2 class="text-4xl font-bold text-center mb-12 text-gradient">Featured Projects</h2>
        
        <?php
        try {
            $stmt = $conn->query("SELECT * FROM projects ORDER BY id DESC LIMIT 3");
            $projects = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            $projects = [];
        }
        ?>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <?php if (!empty($projects)): ?>
                <?php foreach ($projects as $project): ?>
                    <div class="bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-shadow">
                        <img src="<?php echo htmlspecialchars($project['image_url']); ?>" 
                             alt="<?php echo htmlspecialchars($project['title']); ?>"
                             class="w-full h-48 object-cover">
                        <div class="p-6">
                            <h3 class="text-xl font-semibold mb-2"><?php echo htmlspecialchars($project['title']); ?></h3>
                            <p class="text-gray-600"><?php echo htmlspecialchars($project['description']); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <!-- Fallback content if no projects are found -->
                <div class="col-span-3 text-center">
                    <p class="text-gray-600">Featured projects coming soon!</p>
                </div>
            <?php endif; ?>
        </div>

        <div class="text-center mt-12">
            <a href="projects.php" 
               class="bg-primary hover:bg-primary/90 text-white px-8 py-3 rounded-full transition-colors inline-block">
                View All Projects
            </a>
        </div>
    </div>
</section>

<!-- Call to Action Section -->
<section class="bg-primary-gradient py-20 text-white">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-4xl font-bold mb-4">Ready to Start Your Project?</h2>
        <p class="text-xl mb-8">Let's work together to bring your vision to life</p>
        <a href="contact.php" 
           class="bg-white text-primary hover:bg-gray-100 px-8 py-3 rounded-full transition-colors inline-block">
            Contact Us Today
        </a>
    </div>
</section>

<!-- Initialize Swiper -->
<script>
    var swiper = new Swiper('.swiper-container', {
        loop: true,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });
</script>

<?php include 'includes/footer.php'; ?>
