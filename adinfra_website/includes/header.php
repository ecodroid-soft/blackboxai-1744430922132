<?php 
include_once 'config.php';
$current_page = basename($_SERVER['PHP_SELF'], '.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="AD Infra - Leading infrastructure development company providing innovative solutions for sustainable growth">
    <meta name="keywords" content="infrastructure, construction, development, engineering, projects">
    <meta name="author" content="AD Infra">
    
    <title><?php echo SITE_NAME; ?> - <?php echo ucfirst($current_page); ?></title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="/assets/images/logo.svg">
    <link rel="alternate icon" href="/assets/images/favicon.png">
    
    <!-- PWA -->
    <link rel="manifest" href="/manifest.json">
    <meta name="theme-color" content="<?php echo $colors['primary']; ?>">
    
    <!-- Open Graph -->
    <meta property="og:title" content="<?php echo SITE_NAME; ?> - Infrastructure Solutions">
    <meta property="og:description" content="Leading infrastructure development company providing innovative solutions for sustainable growth">
    <meta property="og:image" content="<?php echo SITE_URL; ?>/assets/images/og-image.jpg">
    <meta property="og:url" content="<?php echo SITE_URL; ?>">
    
    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo SITE_NAME; ?> - Infrastructure Solutions">
    <meta name="twitter:description" content="Leading infrastructure development company providing innovative solutions for sustainable growth">
    <meta name="twitter:image" content="<?php echo SITE_URL; ?>/assets/images/twitter-card.jpg">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Swiper.js -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="/assets/css/custom.css">
    
    <!-- Tailwind Config -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '<?php echo $colors["primary"]; ?>',
                        secondary: '<?php echo $colors["secondary"]; ?>',
                        accent: '<?php echo $colors["accent"]; ?>',
                        dark: '<?php echo $colors["dark"]; ?>',
                        light: '<?php echo $colors["light"]; ?>'
                    },
                    fontFamily: {
                        'poppins': ['Poppins', 'sans-serif']
                    }
                }
            }
        }
    </script>
</head>
<body class="font-poppins">
    <!-- Navigation -->
    <nav class="bg-white shadow-md fixed w-full top-0 z-50">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <a href="/" class="flex items-center">
                    <img src="/assets/images/logo.svg" alt="<?php echo SITE_NAME; ?>" class="h-12">
                </a>
                
                <!-- Desktop Menu -->
                <div class="hidden md:flex space-x-8">
                    <a href="/" class="<?php echo $current_page === 'index' ? 'text-primary' : 'text-dark'; ?> hover:text-primary transition-colors">
                        Home
                    </a>
                    <a href="/about" class="<?php echo $current_page === 'about' ? 'text-primary' : 'text-dark'; ?> hover:text-primary transition-colors">
                        About Us
                    </a>
                    <a href="/projects" class="<?php echo $current_page === 'projects' ? 'text-primary' : 'text-dark'; ?> hover:text-primary transition-colors">
                        Projects
                    </a>
                    <a href="/contact" class="<?php echo $current_page === 'contact' ? 'text-primary' : 'text-dark'; ?> hover:text-primary transition-colors">
                        Contact
                    </a>
                </div>
                
                <!-- Mobile Menu Button -->
                <button class="md:hidden text-dark" onclick="toggleMobileMenu()">
                    <i class="fas fa-bars text-2xl"></i>
                </button>
            </div>
            
            <!-- Mobile Menu -->
            <div id="mobileMenu" class="hidden md:hidden pb-4">
                <a href="/" class="block py-2 text-dark hover:text-primary transition-colors">Home</a>
                <a href="/about" class="block py-2 text-dark hover:text-primary transition-colors">About Us</a>
                <a href="/projects" class="block py-2 text-dark hover:text-primary transition-colors">Projects</a>
                <a href="/contact" class="block py-2 text-dark hover:text-primary transition-colors">Contact</a>
            </div>
        </div>
    </nav>
    
    <!-- Content Wrapper (adds padding for fixed header) -->
    <div class="pt-20">
