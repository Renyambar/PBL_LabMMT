Portal Showcase Laboratorium Multimedia & Mobile Tech

Portal web showcase berbasis PHP Native dengan arsitektur MVC yang dilengkapi dengan CMS (Content Management System) untuk mengelola konten secara mudah.

🎯 Fitur Utama

- ✅ Landing Page - Halaman utama dengan profil laboratorium
- ✅ Modul Portofolio Proyek - CRUD dan filter proyek digital
- ✅ Modul Publikasi & Artikel - Manajemen berita dan kegiatan
- ✅ Galeri Multimedia - Upload dan tampilkan foto/video
- ✅ Dashboard CMS - Panel admin dengan role-based access
- ✅ Authentication System - Login/logout untuk admin dan editor
- ✅ Responsive Design - Tampilan modern dengan TailwindCSS

⚙️ Teknologi yang Digunakan

- **Backend**: PHP Native (MVC Architecture)
- **Database**: PostgreSQL
- **Frontend**: HTML, TailwindCSS, JavaScript
- **Icons**: Font Awesome 6
- **Web Server**: Apache/Nginx (Laragon)

 📂 Struktur Folder

```
Lab-MMT/
├── app/
│   ├── controllers/       # Controller files
│   │   ├── HomeController.php
│   │   ├── ProjectController.php
│   │   ├── ArticleController.php
│   │   ├── GalleryController.php
│   │   ├── AuthController.php
│   │   └── AdminController.php
│   ├── models/           # Model files
│   │   ├── User.php
│   │   ├── Project.php
│   │   ├── Article.php
│   │   ├── Gallery.php
│   │   └── Partner.php
│   ├── views/            # View files
│   │   ├── layouts/
│   │   ├── home/
│   │   ├── project/
│   │   ├── article/
│   │   ├── gallery/
│   │   ├── auth/
│   │   └── admin/
│   └── core/             # Core MVC files
│       ├── Database.php
│       ├── Controller.php
│       └── App.php
├── public/               # Public files
│   ├── assets/
│   │   ├── css/
│   │   ├── js/
│   │   └── img/
│   ├── index.php        # Entry point
│   └── .htaccess        # URL rewriting
├── config/
│   └── config.php       # Configuration file
├── database.sql         # Database schema
└── README.md
