# Dokumentasi Diagram UML & ERD - Lab MMT

## 📋 Daftar Isi

1. [Use Case Diagram](#use-case-diagram)
2. [Class Diagram](#class-diagram)
3. [Entity Relationship Diagram (ERD)](#entity-relationship-diagram-erd)
4. [Sequence Diagram](#sequence-diagram)
5. [Database Schema](#database-schema)

---

## 📊 Use Case Diagram

Diagram use case menggambarkan interaksi antara aktor (Pengunjung, Editor, Admin) dengan sistem Lab MMT.

**File**: `USE_CASE_DIAGRAM.md`

### Aktor:
- **Pengunjung**: User publik yang mengakses website
- **Editor**: User dengan akses admin untuk mengelola konten
- **Admin**: User dengan akses penuh termasuk manajemen user

### Use Cases Utama:
- Lihat dan kelola Proyek (dengan fitur rating & komentar)
- Lihat dan kelola Artikel
- Kelola Galeri (foto/video)
- Kelola Mitra/Partner
- Kelola Pengguna (khusus Admin)

---

## 🏗️ Class Diagram

Diagram class menunjukkan struktur kelas dan relasi antar kelas dalam sistem.

**File**: `CLASS_DIAGRAM.md`

### Komponen Utama:
- **Core**: App, Controller (abstract), Database
- **Controllers**: HomeController, ProjectController, ArticleController, GalleryController, AdminController, AuthController
- **Models**: Project, Article, Gallery, Partner, ProjectComment, ProjectRating, User

### Pattern:
- MVC (Model-View-Controller)
- Repository Pattern untuk database access
- Single Responsibility Principle

---

## 🗄️ Entity Relationship Diagram (ERD)

Diagram ERD menggambarkan struktur database dan relasi antar tabel.

**File**: `ERD.md`

### Tabel Database:

#### 1. **users**
- Menyimpan data admin dan editor
- Relasi: One-to-Many dengan articles

#### 2. **projects** ⭐ NEW FEATURES
- Menyimpan data proyek
- **team_name**: Nama tim yang mengerjakan
- **team_members**: Daftar anggota tim (TEXT, multi-line)
- Relasi: One-to-Many dengan project_comments dan project_ratings

#### 3. **articles**
- Menyimpan artikel dan berita
- Relasi: Many-to-One dengan users (author)

#### 4. **gallery**
- Menyimpan media galeri (gambar/video)
- media_type: 'image' atau 'video'

#### 5. **partners**
- Menyimpan data mitra/kolaborasi
- Standalone table

#### 6. **project_comments**
- Komentar pada proyek
- Relasi: Many-to-One dengan projects

#### 7. **project_ratings**
- Rating proyek (1-5 bintang)
- IP tracking untuk prevent duplicate
- Relasi: Many-to-One dengan projects

---

## 🔄 Sequence Diagram

Diagram sequence menggambarkan alur interaksi untuk use case penting.

**File**: `SEQUENCE_DIAGRAM.md`

### Sequence yang didokumentasikan:

1. **User Login**
   - Flow: Login form → Authentication → Session creation → Dashboard

2. **Create Project**
   - Flow: Form submission → Validation → File upload → Database insert → Success

3. **View Project Detail with Rating & Comment**
   - Flow: Load project → Load ratings → Load comments → Display
   - Flow: User rate → Validate → Save rating → Refresh
   - Flow: User comment → Validate → Save comment → Refresh

4. **Manage Gallery (CRUD)**
   - Create: Upload file → Save to database
   - Read: Fetch from database → Display
   - Update: Upload new file → Update database
   - Delete: Remove file → Delete from database

---

## 💾 Database Schema

Complete SQL scripts untuk membuat database.

**File**: `DATABASE_SCHEMA.md`

### Support untuk:
- ✅ PostgreSQL
- ✅ MySQL/MariaDB

### Features:
- Primary Keys (AUTO_INCREMENT)
- Foreign Keys dengan ON DELETE CASCADE
- Unique Constraints (email, slug)
- Indexes untuk performance
- Default timestamps
- Check constraints untuk data validation

### Default Data:
- Admin user dengan email: `admin@labmmt.com`
- Password: `admin123` (hashed dengan bcrypt)

---

## 🎨 Cara Melihat Diagram PlantUML

### Online:
1. Buka [PlantUML Online Editor](http://www.plantuml.com/plantuml/uml/)
2. Copy code dari file `.md`
3. Paste dan lihat hasilnya

### VS Code:
1. Install extension "PlantUML"
2. Buka file `.md`
3. Klik kanan → "Preview PlantUML"

### Generate Image:
```bash
# Install PlantUML
npm install -g node-plantuml

# Generate PNG
puml generate USE_CASE_DIAGRAM.md -o images/
```

---

## 📝 Fitur Terbaru

### Team Information di Projects
- ✅ `team_name`: Nama tim yang mengerjakan proyek
- ✅ `team_members`: Daftar anggota tim (support multi-line)
- ✅ Tampilan modern dengan badge/pill untuk setiap member
- ✅ Responsive design dengan gradient background

### Display Format:
```
┌────────────────────────────────────┐
│ 👥 Tim Inovasi Digital            │
│                                    │
│ Anggota Tim:                       │
│ [👤 Ahmad Rifai] [👤 Siti]        │
│ [👤 Budi Santoso]                  │
└────────────────────────────────────┘
```

---

## 🔍 Catatan Implementasi

1. **Security**:
   - Password hashing dengan bcrypt
   - SQL injection prevention dengan prepared statements
   - XSS prevention dengan htmlspecialchars()

2. **Performance**:
   - Database indexes pada kolom yang sering di-query
   - Lazy loading untuk images
   - Caching untuk static assets

3. **User Experience**:
   - Responsive design (mobile-first)
   - Loading states
   - Error handling dengan user-friendly messages
   - Success notifications

4. **Code Quality**:
   - MVC architecture
   - Separation of concerns
   - Reusable components
   - Indonesian language for admin panel

---

## 📚 Referensi

- [PlantUML Documentation](https://plantuml.com/)
- [MVC Pattern](https://en.wikipedia.org/wiki/Model%E2%80%93view%E2%80%93controller)
- [Database Normalization](https://en.wikipedia.org/wiki/Database_normalization)
- [RESTful API Design](https://restfulapi.net/)

---

**Dibuat untuk**: Lab Multimedia & Mobile Technology  
**Terakhir diupdate**: 3 Desember 2025  
**Versi**: 1.0.0

