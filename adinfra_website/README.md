# AD Infra Website

A modern, responsive website for AD Infra, built with PHP, MySQL, Tailwind CSS, and modern web technologies.

## Features

- Responsive design using Tailwind CSS
- Dynamic project showcase
- Admin panel for content management
- Contact form with database storage
- Progressive Web App (PWA) support
- SEO optimized
- Modern UI with animations
- Secure authentication system

## Project Structure

```
adinfra_website/
├── admin/                  # Admin panel files
│   ├── includes/          # Admin-specific includes
│   ├── dashboard.php      # Admin dashboard
│   ├── manage_projects.php # Project management
│   ├── add_project.php    # Add new project
│   ├── edit_project.php   # Edit existing project
│   ├── login.php         # Admin login
│   └── logout.php        # Admin logout
├── assets/               # Static assets
│   ├── css/             # CSS files
│   ├── js/              # JavaScript files
│   └── images/          # Image files
├── includes/            # PHP includes
│   ├── config.php       # Database configuration
│   ├── header.php       # Common header
│   └── footer.php       # Common footer
├── database/            # Database files
│   └── adinfra.sql     # Database schema
└── public pages         # Main website pages
    ├── index.php        # Homepage
    ├── about.php        # About page
    ├── projects.php     # Projects listing
    ├── contact.php      # Contact form
    ├── 404.php         # 404 error page
    └── 500.php         # 500 error page
```

## Requirements

- PHP 7.4 or higher
- MySQL 5.7 or higher
- Apache web server with mod_rewrite enabled
- SSL certificate (recommended for production)

## Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/yourusername/adinfra-website.git
   ```

2. Create a MySQL database and import the schema:
   ```bash
   mysql -u root -p
   CREATE DATABASE adinfra_db;
   exit;
   mysql -u root -p adinfra_db < database/adinfra.sql
   ```

3. Configure the database connection:
   - Copy `includes/config.sample.php` to `includes/config.php`
   - Update the database credentials in `config.php`

4. Set up the web server:
   - Point your web server to the project directory
   - Ensure mod_rewrite is enabled
   - Make sure the .htaccess files are properly configured

5. Set up admin access:
   - Default admin credentials:
     - Username: admin
     - Password: admin123
   - Change these credentials immediately after first login

## Security Features

- Password hashing for admin authentication
- CSRF protection
- XSS prevention
- SQL injection prevention
- Secure session handling
- Rate limiting
- Input validation
- Error logging

## Development

To run the development server:

```bash
php -S localhost:8000
```

## Production Deployment

1. Update configuration:
   - Set environment to production in config.php
   - Enable HTTPS redirection in .htaccess
   - Update database credentials
   - Configure error reporting

2. Optimize assets:
   - Minify CSS and JavaScript
   - Optimize images
   - Enable GZIP compression
   - Configure browser caching

3. Security measures:
   - Install SSL certificate
   - Update admin credentials
   - Configure firewall rules
   - Set up backup system

## Contributing

1. Fork the repository
2. Create a feature branch
3. Commit your changes
4. Push to the branch
5. Create a Pull Request

## License

This project is licensed under the MIT License - see the LICENSE file for details.

## Support

For support, email support@adinfra.com or create an issue in the repository.

## Authors

- Your Name <your.email@example.com>

## Acknowledgments

- Tailwind CSS
- Font Awesome
- Google Fonts
- Swiper.js
