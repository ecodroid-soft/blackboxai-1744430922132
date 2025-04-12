<?php 
include 'includes/header.php';

$success_message = '';
$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $subject = trim($_POST['subject'] ?? '');
    $message = trim($_POST['message'] ?? '');

    // Basic validation
    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        $error_message = 'Please fill in all required fields.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = 'Please enter a valid email address.';
    } else {
        try {
            $stmt = $conn->prepare("INSERT INTO contacts (name, email, phone, subject, message) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$name, $email, $phone, $subject, $message]);
            $success_message = 'Thank you for your message. We will get back to you soon!';
            
            // Clear form data after successful submission
            $_POST = array();
        } catch(PDOException $e) {
            $error_message = 'Sorry, there was an error sending your message. Please try again later.';
        }
    }
}
?>

<!-- Contact Hero Section -->
<div class="bg-primary-gradient py-20">
    <div class="container mx-auto px-4 text-center">
        <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">Contact Us</h1>
        <p class="text-xl text-white/90">Get in touch with our team for any inquiries</p>
    </div>
</div>

<!-- Contact Section -->
<div class="container mx-auto px-4 py-16">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
        <!-- Contact Information -->
        <div>
            <h2 class="text-3xl font-bold mb-8 text-gradient">Get In Touch</h2>
            
            <!-- Contact Cards -->
            <div class="space-y-6">
                <!-- Address -->
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <div class="flex items-start">
                        <div class="bg-primary/10 p-3 rounded-full">
                            <i class="fas fa-map-marker-alt text-primary text-2xl"></i>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-xl font-semibold mb-2">Our Location</h3>
                            <p class="text-gray-600">123 Business Avenue<br>City, Country</p>
                        </div>
                    </div>
                </div>
                
                <!-- Phone -->
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <div class="flex items-start">
                        <div class="bg-primary/10 p-3 rounded-full">
                            <i class="fas fa-phone text-primary text-2xl"></i>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-xl font-semibold mb-2">Phone Number</h3>
                            <p class="text-gray-600">+1 234 567 890</p>
                        </div>
                    </div>
                </div>
                
                <!-- Email -->
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <div class="flex items-start">
                        <div class="bg-primary/10 p-3 rounded-full">
                            <i class="fas fa-envelope text-primary text-2xl"></i>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-xl font-semibold mb-2">Email Address</h3>
                            <p class="text-gray-600">info@adinfra.com</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Social Media Links -->
            <div class="mt-12">
                <h3 class="text-xl font-semibold mb-4">Follow Us</h3>
                <div class="flex space-x-4">
                    <a href="#" class="bg-primary text-white p-3 rounded-full hover:bg-primary/90 transition-colors">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="bg-primary text-white p-3 rounded-full hover:bg-primary/90 transition-colors">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="bg-primary text-white p-3 rounded-full hover:bg-primary/90 transition-colors">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a href="#" class="bg-primary text-white p-3 rounded-full hover:bg-primary/90 transition-colors">
                        <i class="fab fa-instagram"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Contact Form -->
        <div class="bg-white p-8 rounded-lg shadow-lg">
            <h2 class="text-3xl font-bold mb-8">Send Us a Message</h2>
            
            <?php if ($success_message): ?>
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                    <?php echo htmlspecialchars($success_message); ?>
                </div>
            <?php endif; ?>
            
            <?php if ($error_message): ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                    <?php echo htmlspecialchars($error_message); ?>
                </div>
            <?php endif; ?>

            <form method="POST" class="space-y-6">
                <div>
                    <label for="name" class="block text-gray-700 font-medium mb-2">Name *</label>
                    <input type="text" id="name" name="name" required
                           value="<?php echo htmlspecialchars($_POST['name'] ?? ''); ?>"
                           class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">
                </div>

                <div>
                    <label for="email" class="block text-gray-700 font-medium mb-2">Email *</label>
                    <input type="email" id="email" name="email" required
                           value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>"
                           class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">
                </div>

                <div>
                    <label for="phone" class="block text-gray-700 font-medium mb-2">Phone</label>
                    <input type="tel" id="phone" name="phone"
                           value="<?php echo htmlspecialchars($_POST['phone'] ?? ''); ?>"
                           class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">
                </div>

                <div>
                    <label for="subject" class="block text-gray-700 font-medium mb-2">Subject *</label>
                    <input type="text" id="subject" name="subject" required
                           value="<?php echo htmlspecialchars($_POST['subject'] ?? ''); ?>"
                           class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">
                </div>

                <div>
                    <label for="message" class="block text-gray-700 font-medium mb-2">Message *</label>
                    <textarea id="message" name="message" rows="5" required
                              class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-primary focus:border-primary"><?php echo htmlspecialchars($_POST['message'] ?? ''); ?></textarea>
                </div>

                <button type="submit" 
                        class="w-full bg-primary text-white py-3 rounded-lg hover:bg-primary/90 transition-colors">
                    Send Message
                </button>
            </form>
        </div>
    </div>
</div>

<!-- Google Map Section -->
<div class="w-full h-[400px] mt-16">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d387193.30596073366!2d-74.25987368715491!3d40.69714941932609!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew%20York%2C%20NY%2C%20USA!5e0!3m2!1sen!2s!4v1644286590170!5m2!1sen!2s"
            class="w-full h-full"
            style="border:0;"
            allowfullscreen=""
            loading="lazy">
    </iframe>
</div>

<?php include 'includes/footer.php'; ?>
