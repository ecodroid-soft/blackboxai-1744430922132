<?php include 'includes/header.php'; ?>

<div class="min-h-[600px] flex items-center justify-center bg-gray-50">
    <div class="text-center px-4">
        <div class="mb-8">
            <i class="fas fa-exclamation-triangle text-6xl text-yellow-500"></i>
        </div>
        <h1 class="text-4xl md:text-6xl font-bold text-gray-800 mb-4">500</h1>
        <h2 class="text-2xl md:text-3xl font-semibold text-gray-700 mb-4">Internal Server Error</h2>
        <p class="text-gray-600 mb-8 max-w-md mx-auto">
            Sorry, something went wrong on our servers. We are working to fix the problem. Please try again later.
        </p>
        <div class="space-x-4">
            <a href="javascript:history.back()" 
               class="bg-gray-200 text-gray-700 px-6 py-3 rounded-full hover:bg-gray-300 transition-colors inline-block">
                <i class="fas fa-arrow-left mr-2"></i>Go Back
            </a>
            <a href="/" 
               class="bg-primary text-white px-6 py-3 rounded-full hover:bg-primary/90 transition-colors inline-block">
                <i class="fas fa-home mr-2"></i>Go Home
            </a>
        </div>

        <!-- Support Section -->
        <div class="mt-12 bg-white p-8 rounded-lg shadow-md max-w-2xl mx-auto">
            <h3 class="text-xl font-semibold mb-4">Need Help?</h3>
            <p class="text-gray-600 mb-6">
                If this problem persists, please contact our support team:
            </p>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="p-4 bg-gray-50 rounded-lg">
                    <i class="fas fa-envelope text-primary text-2xl mb-2"></i>
                    <h4 class="font-semibold mb-2">Email Support</h4>
                    <a href="mailto:support@adinfra.com" class="text-blue-600 hover:text-blue-800">
                        support@adinfra.com
                    </a>
                </div>
                <div class="p-4 bg-gray-50 rounded-lg">
                    <i class="fas fa-phone text-primary text-2xl mb-2"></i>
                    <h4 class="font-semibold mb-2">Phone Support</h4>
                    <a href="tel:+1234567890" class="text-blue-600 hover:text-blue-800">
                        +1 (234) 567-890
                    </a>
                </div>
            </div>
        </div>

        <!-- Error Details (only shown in development) -->
        <?php if (isset($_ENV['ENVIRONMENT']) && $_ENV['ENVIRONMENT'] === 'development'): ?>
            <div class="mt-8 text-left bg-red-50 p-6 rounded-lg max-w-2xl mx-auto">
                <h4 class="font-semibold mb-2">Error Details:</h4>
                <pre class="text-sm text-red-700 overflow-x-auto">
                    <?php 
                    if (isset($error_message)) {
                        echo htmlspecialchars($error_message);
                    }
                    if (isset($error_trace)) {
                        echo "\n\nStack Trace:\n";
                        echo htmlspecialchars($error_trace);
                    }
                    ?>
                </pre>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Quick Links -->
<div class="bg-gray-100 py-12">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            <h3 class="text-2xl font-semibold text-center mb-8">Quick Links</h3>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <a href="/about" 
                   class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow text-center">
                    <i class="fas fa-building text-primary text-2xl mb-3"></i>
                    <h4 class="font-semibold">About Us</h4>
                </a>
                <a href="/projects" 
                   class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow text-center">
                    <i class="fas fa-project-diagram text-primary text-2xl mb-3"></i>
                    <h4 class="font-semibold">Our Projects</h4>
                </a>
                <a href="/contact" 
                   class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow text-center">
                    <i class="fas fa-envelope text-primary text-2xl mb-3"></i>
                    <h4 class="font-semibold">Contact</h4>
                </a>
                <a href="/services" 
                   class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow text-center">
                    <i class="fas fa-cogs text-primary text-2xl mb-3"></i>
                    <h4 class="font-semibold">Services</h4>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Error Logging -->
<?php
// Log the error (in a production environment)
if (isset($error_message)) {
    error_log("500 Error: " . $error_message);
}
?>

<?php include 'includes/footer.php'; ?>
