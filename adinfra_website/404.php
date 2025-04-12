<?php include 'includes/header.php'; ?>

<div class="min-h-[600px] flex items-center justify-center bg-gray-50">
    <div class="text-center px-4">
        <div class="mb-8">
            <i class="fas fa-search text-6xl text-primary"></i>
        </div>
        <h1 class="text-4xl md:text-6xl font-bold text-gray-800 mb-4">404</h1>
        <h2 class="text-2xl md:text-3xl font-semibold text-gray-700 mb-4">Page Not Found</h2>
        <p class="text-gray-600 mb-8 max-w-md mx-auto">
            The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.
        </p>
        <div class="space-x-4">
            <a href="/" class="bg-primary text-white px-6 py-3 rounded-full hover:bg-primary/90 transition-colors inline-block">
                <i class="fas fa-home mr-2"></i>Go Home
            </a>
            <a href="/contact" class="bg-gray-200 text-gray-700 px-6 py-3 rounded-full hover:bg-gray-300 transition-colors inline-block">
                <i class="fas fa-envelope mr-2"></i>Contact Us
            </a>
        </div>
        
        <!-- Suggested Pages -->
        <div class="mt-12">
            <h3 class="text-xl font-semibold mb-4">You might be interested in:</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 max-w-3xl mx-auto">
                <a href="/about" class="bg-white p-4 rounded-lg shadow-md hover:shadow-lg transition-shadow">
                    <i class="fas fa-building text-primary text-2xl mb-2"></i>
                    <h4 class="font-semibold">About Us</h4>
                </a>
                <a href="/projects" class="bg-white p-4 rounded-lg shadow-md hover:shadow-lg transition-shadow">
                    <i class="fas fa-project-diagram text-primary text-2xl mb-2"></i>
                    <h4 class="font-semibold">Our Projects</h4>
                </a>
                <a href="/contact" class="bg-white p-4 rounded-lg shadow-md hover:shadow-lg transition-shadow">
                    <i class="fas fa-phone text-primary text-2xl mb-2"></i>
                    <h4 class="font-semibold">Contact Us</h4>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Search Section -->
<div class="bg-gray-100 py-12">
    <div class="container mx-auto px-4">
        <div class="max-w-2xl mx-auto text-center">
            <h3 class="text-2xl font-semibold mb-6">Search Our Website</h3>
            <form action="/search" method="GET" class="flex gap-2">
                <input type="text" 
                       name="q" 
                       placeholder="What are you looking for?"
                       class="flex-1 px-4 py-2 rounded-lg border focus:ring-2 focus:ring-primary focus:border-primary">
                <button type="submit" 
                        class="bg-primary text-white px-6 py-2 rounded-lg hover:bg-primary/90 transition-colors">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
