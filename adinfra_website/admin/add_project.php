<?php 
include 'includes/admin_header.php';

$success_message = '';
$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $category = trim($_POST['category'] ?? '');
    $image_url = trim($_POST['image_url'] ?? '');

    // Validation
    if (empty($title) || empty($description) || empty($category) || empty($image_url)) {
        $error_message = 'All fields are required.';
    } elseif (!filter_var($image_url, FILTER_VALIDATE_URL)) {
        $error_message = 'Please enter a valid image URL.';
    } else {
        try {
            $stmt = $conn->prepare("INSERT INTO projects (title, description, category, image_url) VALUES (?, ?, ?, ?)");
            $stmt->execute([$title, $description, $category, $image_url]);
            $success_message = 'Project added successfully!';
            
            // Clear form data after successful submission
            $_POST = array();
        } catch(PDOException $e) {
            $error_message = 'Error adding project: ' . $e->getMessage();
        }
    }
}
?>

<!-- Add Project Form -->
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold">Add New Project</h1>
            <a href="manage_projects.php" 
               class="text-blue-600 hover:text-blue-800">
                <i class="fas fa-arrow-left mr-2"></i>Back to Projects
            </a>
        </div>

        <?php if ($success_message): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                <?php echo htmlspecialchars($success_message); ?>
            </div>
        <?php endif; ?>

        <?php if ($error_message): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <?php echo htmlspecialchars($error_message); ?>
            </div>
        <?php endif; ?>

        <div class="bg-white rounded-lg shadow-md p-6">
            <form method="POST" class="space-y-6">
                <div>
                    <label for="title" class="block text-gray-700 font-medium mb-2">Project Title *</label>
                    <input type="text" 
                           id="title" 
                           name="title" 
                           required
                           value="<?php echo htmlspecialchars($_POST['title'] ?? ''); ?>"
                           class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           placeholder="Enter project title">
                </div>

                <div>
                    <label for="category" class="block text-gray-700 font-medium mb-2">Category *</label>
                    <select id="category" 
                            name="category" 
                            required
                            class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Select a category</option>
                        <option value="Commercial" <?php echo (isset($_POST['category']) && $_POST['category'] === 'Commercial') ? 'selected' : ''; ?>>
                            Commercial
                        </option>
                        <option value="Residential" <?php echo (isset($_POST['category']) && $_POST['category'] === 'Residential') ? 'selected' : ''; ?>>
                            Residential
                        </option>
                        <option value="Infrastructure" <?php echo (isset($_POST['category']) && $_POST['category'] === 'Infrastructure') ? 'selected' : ''; ?>>
                            Infrastructure
                        </option>
                    </select>
                </div>

                <div>
                    <label for="image_url" class="block text-gray-700 font-medium mb-2">Image URL *</label>
                    <input type="url" 
                           id="image_url" 
                           name="image_url" 
                           required
                           value="<?php echo htmlspecialchars($_POST['image_url'] ?? ''); ?>"
                           class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           placeholder="Enter image URL (e.g., https://example.com/image.jpg)">
                    <p class="text-sm text-gray-500 mt-1">
                        Please provide a direct link to the image. You can use services like Pexels or other image hosting platforms.
                    </p>
                </div>

                <div>
                    <label for="description" class="block text-gray-700 font-medium mb-2">Description *</label>
                    <textarea id="description" 
                              name="description" 
                              required
                              rows="5"
                              class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                              placeholder="Enter project description"><?php echo htmlspecialchars($_POST['description'] ?? ''); ?></textarea>
                </div>

                <div class="flex justify-end space-x-4">
                    <button type="button" 
                            onclick="window.location.href='manage_projects.php'"
                            class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                        Cancel
                    </button>
                    <button type="submit" 
                            class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                        Add Project
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Preview Image Modal -->
<div id="imagePreview" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white p-4 rounded-lg max-w-2xl w-full mx-4">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold">Image Preview</h3>
            <button onclick="closeImagePreview()" class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <img id="previewImage" src="" alt="Preview" class="w-full h-auto">
    </div>
</div>

<script>
// Image URL preview functionality
document.getElementById('image_url').addEventListener('change', function() {
    const imageUrl = this.value;
    if (imageUrl) {
        const img = new Image();
        img.onload = function() {
            document.getElementById('previewImage').src = imageUrl;
            document.getElementById('imagePreview').classList.remove('hidden');
            document.getElementById('imagePreview').classList.add('flex');
        };
        img.onerror = function() {
            alert('Error loading image. Please check the URL.');
        };
        img.src = imageUrl;
    }
});

function closeImagePreview() {
    document.getElementById('imagePreview').classList.add('hidden');
    document.getElementById('imagePreview').classList.remove('flex');
}

// Close modal when clicking outside
document.getElementById('imagePreview').addEventListener('click', function(e) {
    if (e.target === this) {
        closeImagePreview();
    }
});
</script>

</body>
</html>
