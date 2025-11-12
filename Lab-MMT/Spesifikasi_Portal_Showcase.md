# 📘 Spesifikasi Aplikasi  
## Portal Showcase Laboratorium Multimedia & Mobile Tech  
### Dengan Integrasi CMS (Content Management System)

---

## 🎯 Deskripsi Singkat
Aplikasi web berbasis **PHP Native** dengan arsitektur **MVC**, berfungsi sebagai portal showcase untuk menampilkan karya, kegiatan, dan publikasi Laboratorium Multimedia & Mobile Tech.  
Dilengkapi CMS agar admin dapat mengelola konten tanpa coding.

---

## ⚙️ Spesifikasi Teknis

### 🧩 Arsitektur Sistem
- **Client Side (Frontend)**: HTML, CSS (TailwindCSS), JS
- **Server Side (Backend)**: PHP Native (MVC)
- **Database**: PostgreSQL
- **Version Control**: GitHub
- **Web Server**: Apache / Nginx

### 🧱 Struktur Folder MVC
```
/app
  /controllers
    - HomeController.php
    - ProjectController.php
    - GalleryController.php
    - AuthController.php
    - AdminController.php
  /models
    - Project.php
    - User.php
    - Gallery.php
    - Article.php
    - Partner.php
  /views
    /home
    /project
    /gallery
    /auth
    /admin
  /core
    - Controller.php
    - Database.php
    - App.php
/public
  /assets
    /css
    /js
    /img
  index.php
/config
  config.php
```

---

## 🧠 Desain Database (PostgreSQL)
Relasi antar tabel disusun untuk CMS dan portal publik:

### Tabel `users`
| Kolom | Tipe | Keterangan |
|--------|------|------------|
| id | SERIAL PK | ID pengguna |
| name | VARCHAR(100) | Nama pengguna |
| email | VARCHAR(100) | Email login |
| password | VARCHAR(255) | Password terenkripsi |
| role | ENUM('admin','editor') | Hak akses |

### Tabel `projects`
| Kolom | Tipe | Keterangan |
|--------|------|------------|
| id | SERIAL PK | ID proyek |
| title | VARCHAR(150) | Judul proyek |
| slug | VARCHAR(150) | URL-friendly slug |
| description | TEXT | Deskripsi proyek |
| category | VARCHAR(50) | Kategori proyek |
| tags | TEXT | Tag teknologi |
| thumbnail | VARCHAR(255) | Gambar utama |
| video_url | VARCHAR(255) | Link video demo |
| created_at | TIMESTAMP | Tanggal input |

### Tabel `articles`
| Kolom | Tipe | Keterangan |
|--------|------|------------|
| id | SERIAL PK | ID artikel |
| title | VARCHAR(150) | Judul artikel |
| content | TEXT | Isi artikel |
| author_id | INT FK (users.id) | Penulis |
| created_at | TIMESTAMP | Tanggal publikasi |

### Tabel `galleries`
| Kolom | Tipe | Keterangan |
|--------|------|------------|
| id | SERIAL PK | ID galeri |
| title | VARCHAR(100) | Nama album |
| media_type | ENUM('image','video') | Jenis media |
| file_path | VARCHAR(255) | Lokasi file |
| created_at | TIMESTAMP | Waktu upload |

### Tabel `partners`
| Kolom | Tipe | Keterangan |
|--------|------|------------|
| id | SERIAL PK | ID mitra |
| name | VARCHAR(100) | Nama mitra |
| logo | VARCHAR(255) | Logo mitra |
| description | TEXT | Deskripsi singkat |

---

## 🧩 Fitur Utama

1. **Halaman Utama (Landing Page)**  
   - Menampilkan profil laboratorium, visi, misi, dan proyek unggulan.

2. **Modul Portofolio Proyek Digital**  
   - CRUD proyek (Create, Read, Update, Delete).  
   - Filter berdasarkan kategori/tag.

3. **Modul Publikasi & Kegiatan**  
   - CRUD artikel & berita.  
   - Kalender kegiatan dinamis.

4. **Modul Galeri Multimedia**  
   - Upload dan tampilkan foto/video kegiatan.  
   - Filter berdasarkan tahun atau jenis kegiatan.

5. **Dashboard CMS (Admin Panel)**  
   - Login admin/editor.  
   - Role-based access.  
   - Manajemen pengguna, proyek, berita, galeri.

---

## 🚀 Tahapan Pengembangan (Agile Scrum)

| Sprint | Fokus | Deskripsi Kegiatan | Hasil |
|--------|--------|--------------------|-------|
| 1 | Setup & Analisis | Setup proyek, arsitektur MVC, desain ERD | Struktur awal siap |
| 2 | Modul Profil | Buat halaman profil & struktur organisasi | Profil dinamis |
| 3 | Modul Proyek | CRUD proyek, filter, detail proyek | Portofolio lengkap |
| 4 | Publikasi & Kegiatan | CRUD berita & kalender kegiatan | Berita & event tampil |
| 5 | Galeri & CMS | Upload media, sistem login & role | CMS lengkap |
| 6 | Testing & Deployment | Testing end-to-end, optimasi & deploy | Siap implementasi |

---

## 🎨 Desain Tampilan
- Desain modern & clean dengan TailwindCSS.  
- Tema warna: biru tua (#1D4ED8) dan putih minimalis.  
- Layout responsif, kompatibel di mobile & desktop.  

---

## 🧭 Panduan Pengembangan

1. Clone repository dari GitHub.  
2. Jalankan `composer install` (jika ada autoloader tambahan).  
3. Setup file `/config/config.php` untuk koneksi database.  
4. Import file `database.sql` ke PostgreSQL.  
5. Jalankan server lokal (`php -S localhost:8000 -t public`).  
6. Login sebagai admin untuk mulai kelola konten.

---

## 📦 Hasil Akhir
Portal Showcase siap digunakan untuk:  
- Publikasi karya mahasiswa  
- Dokumentasi kegiatan lab  
- Promosi hasil riset & kolaborasi industri  
