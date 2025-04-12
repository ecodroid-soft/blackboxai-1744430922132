-- Create database if not exists
CREATE DATABASE IF NOT EXISTS adinfra_db;
USE adinfra_db;

-- Create projects table
CREATE TABLE IF NOT EXISTS projects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    image_url VARCHAR(500) NOT NULL,
    category VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create slider_images table
CREATE TABLE IF NOT EXISTS slider_images (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    image_url VARCHAR(500) NOT NULL,
    active BOOLEAN DEFAULT true,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert sample projects
INSERT INTO projects (title, description, image_url, category) VALUES
('Modern Office Complex', 'State-of-the-art office complex with sustainable design features', 'https://images.pexels.com/photos/1838640/pexels-photo-1838640.jpeg', 'Commercial'),
('Residential Township', 'Luxury residential township with modern amenities', 'https://images.pexels.com/photos/323780/pexels-photo-323780.jpeg', 'Residential'),
('Highway Infrastructure', 'Major highway development project with advanced engineering', 'https://images.pexels.com/photos/681335/pexels-photo-681335.jpeg', 'Infrastructure');

-- Insert sample slider images
INSERT INTO slider_images (title, image_url) VALUES
('Infrastructure Excellence', 'https://images.pexels.com/photos/1117452/pexels-photo-1117452.jpeg'),
('Modern Architecture', 'https://images.pexels.com/photos/2760243/pexels-photo-2760243.jpeg'),
('Project Innovation', 'https://images.pexels.com/photos/1216589/pexels-photo-1216589.jpeg');

-- Create contacts table
CREATE TABLE IF NOT EXISTS contacts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(20),
    subject VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
