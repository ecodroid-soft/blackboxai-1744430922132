<?php include 'includes/header.php'; ?>

<!-- Projects Hero Section -->
<div class="bg-primary-gradient py-20">
    <div class="container mx-auto px-4 text-center">
        <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">Our Projects</h1>
        <p class="text-xl text-white/90">Discover our portfolio of successful infrastructure projects</p>
    </div>
</div>

<!-- Projects Filter Section -->
<div class="container mx-auto px-4 py-8">
    <div class="flex flex-wrap justify-center gap-4 mb-12">
        <button class="filter-btn active bg-primary text-white px-6 py-2 rounded-full hover:bg-primary/90 transition-colors"
                data-category="all">
            All Projects
        </button>
        <button class="filter-btn bg-gray-200 text-dark px-6 py-2 rounded-full hover:bg-gray-300 transition-colors"
                data-category="Commercial">
            Commercial
        </button>
        <button class="filter-btn bg-gray-200 text-dark px-6 py-2 rounded-full hover:bg-gray-300 transition-colors"
                data-category="Residential">
            Residential
        </button>
        <button class="filter-btn bg-gray-200 text-dark px-6 py-2 rounded-full hover:bg-gray-300 transition-colors"
                data-category="Infrastructure">
            Infrastructure
        </button>
    </div>
</div>

<!-- Projects Grid -->
<div class="container mx-auto px-4 pb-20">
    <?php
    try {
        $stmt = $conn->query("SELECT * FROM projects ORDER BY created_at DESC");
        $projects = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        $projects = [];
    }
    ?>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <?php if (!empty($projects)): ?>
            <?php foreach ($projects as $project): ?>
                <div class="project-card" data-category="<?php echo htmlspecialchars($project['category']); ?>">
                    <div class="bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                        <div class="relative">
                            <img src="<?php echo htmlspecialchars($project['image_url']); ?>" 
                                 alt="<?php echo htmlspecialchars($project['title']); ?>"
                                 class="w-full h-64 object-cover">
                            <div class="absolute top-4 right-4">
                                <span class="bg-primary text-white px-4 py-1 rounded-full text-sm">
                                    <?php echo htmlspecialchars($project['category']); ?>
                                </span>
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-semibold mb-2"><?php echo htmlspecialchars($project['title']); ?></h3>
                            <p class="text-gray-600"><?php echo htmlspecialchars($project['description']); ?></p>
                            <button class="mt-4 text-primary hover:text-primary/80 font-semibold transition-colors"
                                    onclick="showProjectDetails(<?php echo $project['id']; ?>)">
                                Learn More <i class="fas fa-arrow-right ml-2"></i>
                            </button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-span-full text-center py-12">
                <p class="text-gray-600 text-xl">No projects found.</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Project Details Modal -->
<div id="projectModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg max-w-3xl w-full mx-4 overflow-hidden">
        <div class="relative">
            <button onclick="closeProjectModal()" 
                    class="absolute top-4 right-4 text-white bg-black bg-opacity-50 rounded-full w-8 h-8 flex items-center justify-center hover:bg-opacity-70 transition-colors">
                <i class="fas fa-times"></i>
            </button>
            <img id="modalImage" src="" alt="" class="w-full h-72 object-cover">
        </div>
        <div class="p-6">
            <h3 id="modalTitle" class="text-2xl font-semibold mb-4"></h3>
            <p id="modalDescription" class="text-gray-600 mb-4"></p>
            <div class="flex justify-end">
                <button onclick="closeProjectModal()" 
                        class="bg-gray-200 text-dark px-6 py-2 rounded-full hover:bg-gray-300 transition-colors">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Projects Filter and Modal Script -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Filter functionality
    const filterButtons = document.querySelectorAll('.filter-btn');
    const projectCards = document.querySelectorAll('.project-card');

    filterButtons.forEach(button => {
        button.addEventListener('click', () => {
            // Remove active class from all buttons
            filterButtons.forEach(btn => btn.classList.remove('active', 'bg-primary', 'text-white'));
            filterButtons.forEach(btn => btn.classList.add('bg-gray-200', 'text-dark'));
            
            // Add active class to clicked button
            button.classList.remove('bg-gray-200', 'text-dark');
            button.classList.add('active', 'bg-primary', 'text-white');
            
            const category = button.getAttribute('data-category');
            
            projectCards.forEach(card => {
                if (category === 'all' || card.getAttribute('data-category') === category) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });
});

// Modal functionality
function showProjectDetails(projectId) {
    // In a real application, you would fetch project details from the server
    // For now, we'll just use the data already present in the card
    const projectCard = document.querySelector(`[data-project-id="${projectId}"]`);
    const modal = document.getElementById('projectModal');
    const modalImage = document.getElementById('modalImage');
    const modalTitle = document.getElementById('modalTitle');
    const modalDescription = document.getElementById('modalDescription');

    // Update modal content
    modalImage.src = projectCard.querySelector('img').src;
    modalTitle.textContent = projectCard.querySelector('h3').textContent;
    modalDescription.textContent = projectCard.querySelector('p').textContent;

    // Show modal
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    document.body.style.overflow = 'hidden';
}

function closeProjectModal() {
    const modal = document.getElementById('projectModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
    document.body.style.overflow = 'auto';
}

// Close modal when clicking outside
document.getElementById('projectModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeProjectModal();
    }
});
</script>

<?php include 'includes/footer.php'; ?>
