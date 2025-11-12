# 🚀 Quick Start Guide - Portal Showcase Lab MMT

## ⚡ Instalasi Cepat (5 Menit)

### Prasyarat
- ✅ Laragon/XAMPP/WAMP dengan PHP 7.4+
- ✅ PostgreSQL 12+
- ✅ Browser modern (Chrome, Firefox, Safari, Edge)

---

## 📋 Langkah-Langkah Setup

### 1️⃣ Setup Database (2 menit)

**Buka pgAdmin atau terminal PostgreSQL:**

```sql
-- Buat database baru
CREATE DATABASE lab_mmt;

-- Connect ke database
\c lab_mmt

-- Import schema (atau execute via pgAdmin Query Tool)
```

**Kemudian import file `database.sql`:**

```bash
# Via terminal
psql -U postgres -d lab_mmt -f database.sql

# Atau via pgAdmin:
# 1. Buka pgAdmin
# 2. Klik kanan pada database 'lab_mmt' → Query Tool
# 3. File → Open → Pilih database.sql
# 4. Klik Execute (F5)
```

✅ **Database siap dengan:**
- 5 tabel (users, projects, articles, galleries, partners)
- Sample data
- Default admin: admin@labmmt.com / admin123

---

### 2️⃣ Konfigurasi Aplikasi (1 menit)

**Edit file `config/config.php`:**

```php
// Sesuaikan dengan PostgreSQL Anda
define('DB_HOST', 'localhost');
define('DB_NAME', 'lab_mmt');
define('DB_USER', 'postgres');
define('DB_PASS', '87654321');  // ⚠️ PENTING!
define('DB_PORT', '5432');

// Sesuaikan dengan lokasi folder Anda
define('BASE_URL', 'http://localhost/Lab-MMT/public');
```

✅ **Simpan perubahan**

---

### 3️⃣ Jalankan Aplikasi (1 menit)

**Opsi A: Via Laragon (Recommended)**

1. Start Laragon
2. Start Apache & PostgreSQL
3. Buka browser: `http://localhost/Lab-MMT/public`

**Opsi B: Via PHP Built-in Server**

```bash
cd public
php -S localhost:8000
```

Buka browser: `http://localhost:8000`

✅ **Aplikasi berjalan!**

---

### 4️⃣ Login ke Admin Panel (1 menit)

1. Klik tombol **Login** di navigation bar
2. Atau langsung ke: `http://localhost/Lab-MMT/public/auth/login`

**Kredensial Default:**
```
Email: admin@labmmt.com
Password: admin123
```

3. Klik **Login**
4. Anda akan diarahkan ke Dashboard Admin

✅ **Login berhasil!**

---

## 🎯 Checklist Setelah Instalasi

### Verifikasi Instalasi
- [ ] Homepage tampil dengan baik
- [ ] Menu navigation berfungsi
- [ ] Login berhasil
- [ ] Dashboard admin muncul
- [ ] Sample projects terlihat
- [ ] Sample articles terlihat

### Test Fungsionalitas
- [ ] Browse projects
- [ ] View project detail
- [ ] Read articles
- [ ] View gallery
- [ ] Login/logout berfungsi
- [ ] Dashboard menampilkan statistik

---

## 🔧 Troubleshooting Cepat

### ❌ Error: Connection refused
**Solusi:**
```bash
# Pastikan PostgreSQL berjalan
# Via Laragon: Start PostgreSQL
# Via Services: Start postgresql-x64-XX
```

### ❌ Error: Access denied for user
**Solusi:**
- Cek password di `config/config.php`
- Pastikan user postgres memiliki akses ke database

### ❌ Error: 404 Not Found
**Solusi:**
```apache
# Pastikan mod_rewrite aktif di Apache
# Edit httpd.conf, uncomment:
LoadModule rewrite_module modules/mod_rewrite.so

# Restart Apache
```

### ❌ Upload file gagal
**Solusi:**
```bash
# Beri permission write pada folder upload
chmod 755 public/assets/img/
```

---

## 📱 Akses Cepat

| Halaman | URL |
|---------|-----|
| **Homepage** | http://localhost/Lab-MMT/public |
| **Projects** | http://localhost/Lab-MMT/public/project |
| **Articles** | http://localhost/Lab-MMT/public/article |
| **Gallery** | http://localhost/Lab-MMT/public/gallery |
| **About** | http://localhost/Lab-MMT/public/home/about |
| **Contact** | http://localhost/Lab-MMT/public/home/contact |
| **Login** | http://localhost/Lab-MMT/public/auth/login |
| **Dashboard** | http://localhost/Lab-MMT/public/admin |

---

## 🎨 Kustomisasi Cepat

### Ubah Warna Tema

Edit file view (misal: `app/views/layouts/header.php`):

```javascript
tailwind.config = {
    theme: {
        extend: {
            colors: {
                primary: '#1D4ED8',    // Ganti warna di sini
                secondary: '#3B82F6',  // Dan di sini
            }
        }
    }
}
```

### Ubah Logo & Nama

Edit file `app/views/layouts/header.php`:

```html
<div class="flex items-center space-x-2">
    <i class="fas fa-flask text-primary text-2xl"></i>  <!-- Ganti icon -->
    <span class="text-xl font-bold text-gray-800">Lab MMT</span>  <!-- Ganti nama -->
</div>
```

### Tambah Admin Baru

Via SQL:

```sql
INSERT INTO users (name, email, password, role) 
VALUES ('Your Name', 'your@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin');
-- Password di atas adalah hash untuk: admin123
```

Atau via Dashboard Admin (sudah login):
1. Admin → Users → Add New User

---

## 📚 Next Steps

### Untuk Development:
1. ✅ Setup database - **DONE**
2. ✅ Konfigurasi app - **DONE**
3. ✅ Login admin - **DONE**
4. 📝 Mulai tambah konten:
   - Tambah projects
   - Tambah articles
   - Upload gallery
   - Tambah partners

### Untuk Production:
1. 🔐 Ganti password admin default
2. 🔒 Update database credentials
3. 🌐 Setup domain & hosting
4. 📧 Setup email notifications (optional)
5. 📊 Setup analytics (optional)

---

## 💡 Tips & Tricks

### Keyboard Shortcuts (Admin Panel)
- `Alt + H` - Go to home
- `Alt + D` - Go to dashboard
- `Alt + P` - Go to projects
- `Alt + A` - Go to articles

### Quick Actions
- Double-click gambar untuk preview
- Drag & drop untuk upload file
- Ctrl + S untuk save form

### Best Practices
- ✅ Backup database secara berkala
- ✅ Gunakan gambar optimized (max 2MB)
- ✅ Isi meta description untuk SEO
- ✅ Tag projects dengan proper keywords

---

## 🆘 Butuh Bantuan?

### Dokumentasi
- 📖 [README.md](README.md) - Full documentation
- 📝 [SUMMARY.md](SUMMARY.md) - Development summary
- 📋 [CHANGELOG.md](CHANGELOG.md) - Version history

### Kontak
- 📧 Email: info@labmmt.com
- 🐛 Report Bug: [GitHub Issues]
- 💬 Discussion: [GitHub Discussions]

---

## ✅ Installation Complete!

**Selamat! Portal Showcase Lab MMT sudah siap digunakan. 🎉**

Mulai kelola konten Anda sekarang dan jadikan lab lebih showcase!

---

*Last Updated: November 11, 2025*
