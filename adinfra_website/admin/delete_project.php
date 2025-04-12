<?php
include 'includes/admin_header.php';

// Get project ID from URL
$project_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($project_id > 0) {
    try {
        // First, get the project details to confirm it exists
        $stmt = $conn->prepare("SELECT title FROM projects WHERE id = ?");
        $stmt->execute([$project_id]);
        $project = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($project) {
            // Delete the project
            $stmt = $conn->prepare("DELETE FROM projects WHERE id = ?");
            $stmt->execute([$project_id]);

            $_SESSION['success_message'] = "Project '" . htmlspecialchars($project['title']) . "' has been deleted successfully.";
        } else {
            $_SESSION['error_message'] = "Project not found.";
        }
    } catch(PDOException $e) {
        $_SESSION['error_message'] = "Error deleting project: " . $e->getMessage();
    }
}

// Redirect back to manage projects page
header('Location: manage_projects.php');
exit;
