<?php include 'includes/admin_header.php'; ?>

<!-- Dashboard Content -->
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8">Dashboard Overview</h1>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <?php
        // Get total projects count
        try {
            $stmt = $conn->query("SELECT COUNT(*) as total FROM projects");
            $projects_count = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
        } catch(PDOException $e) {
            $projects_count = 0;
        }

        // Get total contacts count
        try {
            $stmt = $conn->query("SELECT COUNT(*) as total FROM contacts");
            $contacts_count = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
        } catch(PDOException $e) {
            $contacts_count = 0;
        }

        // Get unread contacts count (assuming we add a 'read' column later)
        try {
            $stmt = $conn->query("SELECT COUNT(*) as total FROM contacts WHERE created_at >= DATE_SUB(NOW(), INTERVAL 7 DAY)");
            $new_contacts_count = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
        } catch(PDOException $e) {
            $new_contacts_count = 0;
        }
        ?>

        <!-- Total Projects Card -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center">
                <div class="bg-blue-100 rounded-full p-3">
                    <i class="fas fa-project-diagram text-blue-600 text-2xl"></i>
                </div>
                <div class="ml-4">
                    <h2 class="text-gray-600">Total Projects</h2>
                    <p class="text-2xl font-bold"><?php echo $projects_count; ?></p>
                </div>
            </div>
            <a href="manage_projects.php" class="text-blue-600 hover:text-blue-800 text-sm mt-4 inline-block">
                View All Projects <i class="fas fa-arrow-right ml-1"></i>
            </a>
        </div>

        <!-- Total Contacts Card -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center">
                <div class="bg-green-100 rounded-full p-3">
                    <i class="fas fa-envelope text-green-600 text-2xl"></i>
                </div>
                <div class="ml-4">
                    <h2 class="text-gray-600">Total Contacts</h2>
                    <p class="text-2xl font-bold"><?php echo $contacts_count; ?></p>
                </div>
            </div>
            <a href="manage_contacts.php" class="text-green-600 hover:text-green-800 text-sm mt-4 inline-block">
                View All Contacts <i class="fas fa-arrow-right ml-1"></i>
            </a>
        </div>

        <!-- New Messages Card -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center">
                <div class="bg-yellow-100 rounded-full p-3">
                    <i class="fas fa-envelope-open-text text-yellow-600 text-2xl"></i>
                </div>
                <div class="ml-4">
                    <h2 class="text-gray-600">New Messages (7 days)</h2>
                    <p class="text-2xl font-bold"><?php echo $new_contacts_count; ?></p>
                </div>
            </div>
            <a href="manage_contacts.php" class="text-yellow-600 hover:text-yellow-800 text-sm mt-4 inline-block">
                View New Messages <i class="fas fa-arrow-right ml-1"></i>
            </a>
        </div>
    </div>

    <!-- Recent Projects -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <h2 class="text-xl font-bold mb-4">Recent Projects</h2>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-50">
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date Added</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <?php
                    try {
                        $stmt = $conn->query("SELECT * FROM projects ORDER BY created_at DESC LIMIT 5");
                        while ($project = $stmt->fetch(PDO::FETCH_ASSOC)):
                    ?>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <?php echo htmlspecialchars($project['title']); ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <?php echo htmlspecialchars($project['category']); ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <?php echo date('M d, Y', strtotime($project['created_at'])); ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <a href="edit_project.php?id=<?php echo $project['id']; ?>" 
                                   class="text-blue-600 hover:text-blue-900 mr-3">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="delete_project.php?id=<?php echo $project['id']; ?>" 
                                   class="text-red-600 hover:text-red-900"
                                   onclick="return confirm('Are you sure you want to delete this project?')">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </td>
                        </tr>
                    <?php 
                        endwhile;
                    } catch(PDOException $e) {
                        echo '<tr><td colspan="4" class="px-6 py-4 text-center text-gray-500">No projects found</td></tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Recent Contacts -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-bold mb-4">Recent Contact Messages</h2>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-50">
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Subject</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <?php
                    try {
                        $stmt = $conn->query("SELECT * FROM contacts ORDER BY created_at DESC LIMIT 5");
                        while ($contact = $stmt->fetch(PDO::FETCH_ASSOC)):
                    ?>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <?php echo htmlspecialchars($contact['name']); ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <?php echo htmlspecialchars($contact['email']); ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <?php echo htmlspecialchars($contact['subject']); ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <?php echo date('M d, Y', strtotime($contact['created_at'])); ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <a href="view_contact.php?id=<?php echo $contact['id']; ?>" 
                                   class="text-blue-600 hover:text-blue-900 mr-3">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="delete_contact.php?id=<?php echo $contact['id']; ?>" 
                                   class="text-red-600 hover:text-red-900"
                                   onclick="return confirm('Are you sure you want to delete this message?')">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </td>
                        </tr>
                    <?php 
                        endwhile;
                    } catch(PDOException $e) {
                        echo '<tr><td colspan="5" class="px-6 py-4 text-center text-gray-500">No messages found</td></tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>
