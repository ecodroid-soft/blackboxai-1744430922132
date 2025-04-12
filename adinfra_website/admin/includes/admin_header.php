<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit;
}

// Include database connection
include_once '../includes/config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - AD Infra</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Admin Navigation -->
    <nav class="bg-white shadow-md">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center">
                    <a href="dashboard.php" class="text-xl font-bold text-gray-800">AD Infra Admin</a>
                </div>
                
                <div class="flex items-center space-x-6">
                    <a href="dashboard.php" class="text-gray-600 hover:text-gray-800 transition-colors">
                        <i class="fas fa-tachometer-alt mr-2"></i>Dashboard
                    </a>
                    <a href="manage_projects.php" class="text-gray-600 hover:text-gray-800 transition-colors">
                        <i class="fas fa-project-diagram mr-2"></i>Projects
                    </a>
                    <a href="manage_contacts.php" class="text-gray-600 hover:text-gray-800 transition-colors">
                        <i class="fas fa-envelope mr-2"></i>Contacts
                    </a>
                    <a href="../index.php" target="_blank" class="text-gray-600 hover:text-gray-800 transition-colors">
                        <i class="fas fa-external-link-alt mr-2"></i>View Site
                    </a>
                    <form method="POST" action="logout.php" class="inline">
                        <button type="submit" class="text-red-600 hover:text-red-800 transition-colors">
                            <i class="fas fa-sign-out-alt mr-2"></i>Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>
