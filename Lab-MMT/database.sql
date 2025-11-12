-- Database: lab_mmt
-- PostgreSQL Schema for Portal Showcase Lab MMT

-- Drop tables if exists
DROP TABLE IF EXISTS articles CASCADE;
DROP TABLE IF EXISTS galleries CASCADE;
DROP TABLE IF EXISTS projects CASCADE;
DROP TABLE IF EXISTS partners CASCADE;
DROP TABLE IF EXISTS users CASCADE;

-- Create users table
CREATE TABLE users (
    id SERIAL PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(20) CHECK (role IN ('admin', 'editor')) NOT NULL DEFAULT 'editor',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create projects table
CREATE TABLE projects (
    id SERIAL PRIMARY KEY,
    title VARCHAR(150) NOT NULL,
    slug VARCHAR(150) UNIQUE NOT NULL,
    description TEXT,
    category VARCHAR(50),
    tags TEXT,
    thumbnail VARCHAR(255),
    video_url VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create articles table
CREATE TABLE articles (
    id SERIAL PRIMARY KEY,
    title VARCHAR(150) NOT NULL,
    slug VARCHAR(150) UNIQUE NOT NULL,
    content TEXT,
    author_id INTEGER REFERENCES users(id) ON DELETE SET NULL,
    thumbnail VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create galleries table
CREATE TABLE galleries (
    id SERIAL PRIMARY KEY,
    title VARCHAR(100) NOT NULL,
    media_type VARCHAR(20) CHECK (media_type IN ('image', 'video')) NOT NULL,
    file_path VARCHAR(255) NOT NULL,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create partners table
CREATE TABLE partners (
    id SERIAL PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    logo VARCHAR(255),
    description TEXT,
    website VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert default admin user (password: admin123)
INSERT INTO users (name, email, password, role) 
VALUES ('Admin', 'admin@labmmt.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin');

-- Insert sample projects
INSERT INTO projects (title, slug, description, category, tags, thumbnail) VALUES
('Mobile Learning App', 'mobile-learning-app', 'Aplikasi mobile untuk pembelajaran interaktif menggunakan Flutter dan Firebase', 'Mobile Development', 'Flutter, Firebase, Education', 'projects/mobile-learning.jpg'),
('E-Commerce Platform', 'e-commerce-platform', 'Platform e-commerce modern dengan fitur lengkap menggunakan Laravel dan Vue.js', 'Web Development', 'Laravel, Vue.js, MySQL', 'projects/ecommerce.jpg'),
('AR Tourism Guide', 'ar-tourism-guide', 'Aplikasi pemandu wisata berbasis Augmented Reality', 'AR/VR', 'Unity, ARCore, Android', 'projects/ar-tourism.jpg');

-- Insert sample articles
INSERT INTO articles (title, slug, content, author_id, thumbnail) VALUES
('Workshop Mobile Development 2024', 'workshop-mobile-development-2024', 'Lab MMT menyelenggarakan workshop mobile development dengan fokus pada Flutter dan React Native. Diikuti oleh 50+ peserta dari berbagai universitas.', 1, 'articles/workshop.jpg'),
('Kolaborasi dengan Industri IT', 'kolaborasi-dengan-industri-it', 'Lab MMT menjalin kerjasama dengan perusahaan IT terkemuka untuk program magang dan project based learning.', 1, 'articles/collaboration.jpg');

-- Insert sample galleries
INSERT INTO galleries (title, media_type, file_path, description) VALUES
('Workshop Mobile Dev 2024', 'image', 'gallery/workshop-2024-1.jpg', 'Suasana workshop mobile development'),
('Project Exhibition', 'image', 'gallery/exhibition-1.jpg', 'Pameran hasil karya mahasiswa'),
('Lab Tour Video', 'video', 'gallery/lab-tour.mp4', 'Virtual tour laboratorium');

-- Insert sample partners
INSERT INTO partners (name, logo, description, website) VALUES
('Google Developer Student Clubs', 'partners/gdsc.png', 'Komunitas developer mahasiswa yang didukung Google', 'https://gdsc.community.dev/'),
('Microsoft Learn Student Ambassadors', 'partners/mlsa.png', 'Program ambassador Microsoft untuk mahasiswa', 'https://studentambassadors.microsoft.com/'),
('Dicoding Indonesia', 'partners/dicoding.png', 'Platform pembelajaran programming Indonesia', 'https://www.dicoding.com/');
