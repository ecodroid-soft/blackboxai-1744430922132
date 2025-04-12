-- Projects table
CREATE TABLE IF NOT EXISTS projects (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    title TEXT NOT NULL,
    description TEXT NOT NULL,
    category TEXT NOT NULL,
    image_url TEXT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Slider images table
CREATE TABLE IF NOT EXISTS slider_images (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    title TEXT NOT NULL,
    image_url TEXT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Contacts table
CREATE TABLE IF NOT EXISTS contacts (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL,
    email TEXT NOT NULL,
    phone TEXT,
    subject TEXT NOT NULL,
    message TEXT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Insert sample slider images
INSERT INTO slider_images (title, image_url) VALUES
('Infrastructure Excellence', 'https://images.pexels.com/photos/1117452/pexels-photo-1117452.jpeg'),
('Modern Architecture', 'https://images.pexels.com/photos/2760243/pexels-photo-2760243.jpeg'),
('Project Innovation', 'https://images.pexels.com/photos/1216589/pexels-photo-1216589.jpeg');

-- Insert sample projects
INSERT INTO projects (title, description, category, image_url) VALUES
('Modern Office Complex', 'State-of-the-art office complex with sustainable design features', 'Commercial', 'https://images.pexels.com/photos/323705/pexels-photo-323705.jpeg'),
('Residential Tower', 'Luxury residential tower with panoramic city views', 'Residential', 'https://images.pexels.com/photos/2404843/pexels-photo-2404843.jpeg'),
('Highway Bridge', 'Major infrastructure project connecting two cities', 'Infrastructure', 'https://images.pexels.com/photos/1838640/pexels-photo-1838640.jpeg');
