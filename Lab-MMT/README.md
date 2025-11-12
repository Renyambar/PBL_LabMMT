# 📘 Portal Showcase Laboratorium Multimedia & Mobile Tech

Portal web showcase berbasis **PHP Native** dengan arsitektur **MVC** yang dilengkapi dengan CMS (Content Management System) untuk mengelola konten secara mudah.

## 🎯 Fitur Utama

- ✅ **Landing Page** - Halaman utama dengan profil laboratorium
- ✅ **Modul Portofolio Proyek** - CRUD dan filter proyek digital
- ✅ **Modul Publikasi & Artikel** - Manajemen berita dan kegiatan
- ✅ **Galeri Multimedia** - Upload dan tampilkan foto/video
- ✅ **Dashboard CMS** - Panel admin dengan role-based access
- ✅ **Authentication System** - Login/logout untuk admin dan editor
- ✅ **Responsive Design** - Tampilan modern dengan TailwindCSS

## ⚙️ Teknologi yang Digunakan

- **Backend**: PHP Native (MVC Architecture)
- **Database**: PostgreSQL
- **Frontend**: HTML, TailwindCSS, JavaScript
- **Icons**: Font Awesome 6
- **Web Server**: Apache/Nginx (Laragon)

## 📂 Struktur Folder

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
```

## 🚀 Instalasi & Setup

### 1. Clone atau Download Proyek

```bash
cd c:\laragon\www\
git clone <repository-url> Lab-MMT
# atau extract zip ke folder Lab-MMT
```

### 2. Setup Database PostgreSQL

**a. Buat Database Baru:**

```sql
CREATE DATABASE lab_mmt;
```

**b. Import Schema Database:**

Gunakan pgAdmin atau command line:

```bash
psql -U postgres -d lab_mmt -f database.sql
```

Atau melalui pgAdmin:
1. Buka pgAdmin
2. Klik kanan pada database `lab_mmt` → Query Tool
3. Buka file `database.sql` dan execute

### 3. Konfigurasi Database

Edit file `config/config.php` sesuai dengan kredensial PostgreSQL Anda:

```php
define('DB_HOST', 'localhost');
define('DB_NAME', 'lab_mmt');
define('DB_USER', 'postgres');
define('DB_PASS', 'your_password');  // Sesuaikan dengan password PostgreSQL Anda
define('DB_PORT', '5432');
```

### 4. Konfigurasi Base URL

Sesuaikan BASE_URL di `config/config.php`:

```php
define('BASE_URL', 'http://localhost/Lab-MMT/public');
```

### 5. Setup Web Server

**Menggunakan Laragon:**

1. Pastikan Laragon sudah terinstall
2. Start Apache dan PostgreSQL di Laragon
3. Akses aplikasi melalui browser: `http://localhost/Lab-MMT/public`

**Menggunakan PHP Built-in Server:**

```bash
cd public
php -S localhost:8000
```

Akses: `http://localhost:8000`

## 👤 Login Default

Setelah import database, gunakan kredensial berikut untuk login:

- **Email**: admin@labmmt.com
- **Password**: admin123

## 📖 Cara Penggunaan

### Untuk Pengunjung (Public)

1. **Home** - Lihat profil lab, proyek unggulan, dan artikel terbaru
2. **Projects** - Browse dan filter proyek berdasarkan kategori
3. **Articles** - Baca berita dan publikasi lab
4. **Gallery** - Lihat foto dan video kegiatan
5. **About** - Informasi tentang laboratorium
6. **Contact** - Hubungi tim lab

### Untuk Admin/Editor

1. **Login** ke sistem melalui `/auth/login`
2. **Dashboard** - Lihat statistik dan overview konten
3. **Manage Projects** - CRUD proyek digital
   - Tambah proyek baru dengan thumbnail dan video demo
   - Edit atau hapus proyek existing
   - Filter berdasarkan kategori
4. **Manage Articles** - CRUD artikel dan berita
   - Buat artikel dengan rich content
   - Upload thumbnail artikel
   - Publish berita kegiatan lab
5. **Manage Gallery** - Upload media
   - Upload foto kegiatan
   - Upload video dokumentasi
   - Kelola album galeri
6. **Manage Partners** - Kelola mitra kerjasama
7. **Manage Users** *(admin only)* - Kelola user dan role

## 🔐 Role & Permission

### Admin
- Akses penuh ke semua fitur CMS
- Dapat mengelola users
- Dapat CRUD semua konten

### Editor
- Dapat mengelola projects, articles, gallery, partners
- Tidak dapat mengelola users
- Tidak dapat mengubah role user lain

## 🎨 Kustomisasi

### Mengubah Warna Tema

Edit konfigurasi Tailwind di file view (`layouts/header.php`):

```javascript
tailwind.config = {
    theme: {
        extend: {
            colors: {
                primary: '#1D4ED8',    // Ubah warna primary
                secondary: '#3B82F6',  // Ubah warna secondary
            }
        }
    }
}
```

### Menambah Kategori Proyek

Kategori proyek bersifat dinamis. Cukup masukkan kategori baru saat membuat proyek, dan akan otomatis muncul di filter.

## 🛠️ Development Roadmap

### Sprint 1 ✅ - Setup & Analisis
- [x] Setup struktur MVC
- [x] Desain database schema
- [x] Konfigurasi core system

### Sprint 2 ✅ - Modul Profil
- [x] Home controller & views
- [x] Landing page responsif
- [x] Layout templates

### Sprint 3 ✅ - Modul Proyek
- [x] Project CRUD
- [x] Filter & search
- [x] Detail proyek

### Sprint 4 ✅ - Publikasi & Kegiatan
- [x] Article management
- [x] Gallery management

### Sprint 5 ✅ - CMS & Authentication
- [x] Login system
- [x] Role-based access
- [x] Admin dashboard

### Sprint 6 ✅ - Testing & Deployment
- [x] UI/UX polish
- [x] Documentation
- [x] Ready for production

## 📝 Catatan Penting

1. **Upload Directory**: Pastikan folder `public/assets/img/` memiliki permission write (755)
2. **PostgreSQL**: Pastikan PostgreSQL service berjalan
3. **PHP Version**: Minimal PHP 7.4 atau lebih tinggi
4. **PDO Extension**: Pastikan PHP PDO PostgreSQL extension aktif
5. **mod_rewrite**: Aktifkan Apache mod_rewrite untuk clean URL

## 🐛 Troubleshooting

### Error: Connection refused
- Pastikan PostgreSQL service berjalan
- Cek kredensial database di `config/config.php`

### Error: 404 Not Found
- Pastikan `.htaccess` ada di folder `public/`
- Aktifkan mod_rewrite di Apache

### Upload File Gagal
- Cek permission folder `public/assets/img/`
- Pastikan ukuran file < 5MB

### Session Error
- Pastikan `session_start()` dipanggil di `config.php`
- Cek permission folder session PHP

## 👥 Kontributor

- **Developer**: Lab MMT Team
- **Designer**: Lab MMT Team

## 📄 Lisensi

Project ini dibuat untuk keperluan akademik Laboratorium Multimedia & Mobile Technology.

## 🤝 Kontribusi

Untuk berkontribusi pada project ini:

1. Fork repository
2. Buat branch fitur baru (`git checkout -b feature/AmazingFeature`)
3. Commit perubahan (`git commit -m 'Add some AmazingFeature'`)
4. Push ke branch (`git push origin feature/AmazingFeature`)
5. Buat Pull Request

## 📞 Support

Jika mengalami kendala, hubungi:
- **Email**: info@labmmt.com
- **GitHub Issues**: [Create Issue](repository-url/issues)

---

**Dibuat dengan ❤️ oleh Lab MMT**
