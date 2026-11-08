# Data Flow Diagram (DFD) - Lab MMT

## Level 0 - Context Diagram

```plantuml
@startuml
!define RECTANGLE class

skinparam rectangle {
    BackgroundColor LightBlue
    BorderColor Blue
}

skinparam actor {
    BackgroundColor LightGreen
    BorderColor Green
}

skinparam database {
    BackgroundColor LightYellow
    BorderColor Orange
}

left to right direction

actor "Pengunjung" as Visitor
actor "Editor" as Editor  
actor "Admin" as Admin

rectangle "Sistem Lab MMT\n(Web Application)" as System {
}

Visitor --> System : Lihat proyek/artikel/galeri\nBeri rating & komentar
Editor --> System : Kelola konten\n(CRUD proyek, artikel, galeri, mitra)
Admin --> System : Kelola pengguna\n& semua konten

System --> Visitor : Tampilkan informasi\nKonfirmasi rating/komentar
System --> Editor : Konfirmasi operasi\nTampilkan dashboard
System --> Admin : Konfirmasi operasi\nTampilkan statistik

@enduml
```

---

## Level 1 - DFD Overview

```plantuml
@startuml
!define PROCESS rectangle
!define DATASTORE database

skinparam rectangle {
    BackgroundColor LightBlue
    BorderColor Blue
}

skinparam database {
    BackgroundColor LightYellow
    BorderColor Orange
}

actor Pengunjung
actor Editor
actor Admin

PROCESS "1.0\nManajemen\nAuthentication" as P1
PROCESS "2.0\nManajemen\nProyek" as P2
PROCESS "3.0\nManajemen\nArtikel" as P3
PROCESS "4.0\nManajemen\nGaleri" as P4
PROCESS "5.0\nManajemen\nMitra" as P5
PROCESS "6.0\nManajemen\nRating &\nKomentar" as P6
PROCESS "7.0\nManajemen\nPengguna" as P7

DATASTORE "D1: users" as D1
DATASTORE "D2: projects" as D2
DATASTORE "D3: articles" as D3
DATASTORE "D4: gallery" as D4
DATASTORE "D5: partners" as D5
DATASTORE "D6: project_ratings" as D6
DATASTORE "D7: project_comments" as D7

' Authentication Flow
Editor --> P1 : Login credentials
Admin --> P1 : Login credentials
P1 --> D1 : Verify user
D1 --> P1 : User data
P1 --> Editor : Session token
P1 --> Admin : Session token

' Projects Flow
Pengunjung --> P2 : Request project list/detail
Editor --> P2 : CRUD project data
P2 --> D2 : Query/Insert/Update/Delete
D2 --> P2 : Project data
P2 --> Pengunjung : Display projects
P2 --> Editor : Confirmation

' Articles Flow
Pengunjung --> P3 : Request article list/detail
Editor --> P3 : CRUD article data
P3 --> D3 : Query/Insert/Update/Delete
D3 --> P3 : Article data
P3 --> D1 : Get author info
D1 --> P3 : Author data
P3 --> Pengunjung : Display articles
P3 --> Editor : Confirmation

' Gallery Flow
Pengunjung --> P4 : Request gallery
Editor --> P4 : Upload/Edit/Delete media
P4 --> D4 : Query/Insert/Update/Delete
D4 --> P4 : Media data
P4 --> Pengunjung : Display gallery
P4 --> Editor : Confirmation

' Partners Flow
Pengunjung --> P5 : Request partners
Editor --> P5 : CRUD partner data
P5 --> D5 : Query/Insert/Update/Delete
D5 --> P5 : Partner data
P5 --> Pengunjung : Display partners
P5 --> Editor : Confirmation

' Rating & Comment Flow
Pengunjung --> P6 : Submit rating/comment
Editor --> P6 : Moderate comments
P6 --> D6 : Insert rating
P6 --> D7 : Insert/Delete comment
D6 --> P6 : Rating data
D7 --> P6 : Comment data
D2 --> P6 : Project info
P6 --> Pengunjung : Display ratings/comments
P6 --> Editor : Confirmation

' User Management Flow
Admin --> P7 : CRUD user data
P7 --> D1 : Query/Insert/Update/Delete
D1 --> P7 : User data
P7 --> Admin : Confirmation

@enduml
```

---

## Level 2 - DFD Detail (Manajemen Proyek)

```plantuml
@startuml
skinparam rectangle {
    BackgroundColor LightBlue
    BorderColor Blue
}

skinparam database {
    BackgroundColor LightYellow
    BorderColor Orange
}

actor Pengunjung
actor Editor

rectangle "2.1\nTampilkan\nDaftar Proyek" as P21
rectangle "2.2\nTampilkan\nDetail Proyek" as P22
rectangle "2.3\nTambah\nProyek" as P23
rectangle "2.4\nEdit\nProyek" as P24
rectangle "2.5\nHapus\nProyek" as P25
rectangle "2.6\nFilter &\nSearch" as P26

database "D2: projects" as D2
database "D6: project_ratings" as D6
database "D7: project_comments" as D7

' View List
Pengunjung --> P21 : Request list
P21 --> D2 : SELECT * FROM projects
D2 --> P21 : Projects data
P21 --> Pengunjung : Display grid

' View Detail
Pengunjung --> P22 : Request detail
P22 --> D2 : SELECT * WHERE slug
D2 --> P22 : Project data
P22 --> D6 : Get ratings
D6 --> P22 : Ratings data
P22 --> D7 : Get comments
D7 --> P22 : Comments data
P22 --> Pengunjung : Display detail

' Create
Editor --> P23 : Submit project data\n(title, category, team, etc)
P23 --> P23 : Validate & Upload file
P23 --> D2 : INSERT INTO projects
D2 --> P23 : Success/Error
P23 --> Editor : Confirmation

' Update
Editor --> P24 : Submit updated data
P24 --> D2 : SELECT * WHERE id
D2 --> P24 : Current data
P24 --> P24 : Validate & Upload file
P24 --> D2 : UPDATE projects WHERE id
D2 --> P24 : Success/Error
P24 --> Editor : Confirmation

' Delete
Editor --> P25 : Delete request
P25 --> D2 : SELECT * WHERE id
D2 --> P25 : Project data
P25 --> P25 : Delete file
P25 --> D2 : DELETE FROM projects WHERE id
D2 --> P25 : Success/Error
P25 --> Editor : Confirmation

' Filter & Search
Pengunjung --> P26 : Search/filter criteria
P26 --> D2 : SELECT * WHERE category/keyword
D2 --> P26 : Filtered data
P26 --> Pengunjung : Display results

@enduml
```

---

## Database Flow Summary

### 1. Authentication Flow
```
User (Login) → AuthController → User Model → Database (users)
                     ↓
            Create Session → Store in $_SESSION
                     ↓
            Redirect to Dashboard
```

### 2. Public View Flow
```
Visitor → Controller → Model → Database → Model → Controller → View → Visitor
```

**Example - View Projects:**
```
Visitor → ProjectController::index()
       → Project::getAll()
       → SELECT * FROM projects
       → Return array
       → Render view
       → Display HTML
```

### 3. CRUD Flow (Admin/Editor)
```
Editor → AdminController → Model → Database
              ↓                      ↓
        Upload File             INSERT/UPDATE/DELETE
              ↓                      ↓
        Save to disk            Return status
              ↓                      ↓
        Return success ←────────────┘
```

### 4. Rating & Comment Flow
```
Visitor → Submit Rating/Comment
       → ProjectController::rate() / comment()
       → ProjectRating/ProjectComment Model
       → INSERT INTO project_ratings/comments
       → Return success
       → Reload page with updated data
```

---

## Data Flow Narrative

### A. User Authentication
1. User mengakses halaman login
2. User memasukkan email dan password
3. AuthController menerima input
4. User model memverifikasi credentials dari database
5. Jika valid, create session dan redirect ke dashboard
6. Jika invalid, tampilkan error message

### B. View Projects (Public)
1. Pengunjung mengakses /project
2. ProjectController::index() dipanggil
3. Project model query database: `SELECT * FROM projects ORDER BY created_at DESC`
4. Database return array of projects
5. Controller pass data ke view
6. View render HTML dengan project cards
7. Browser menampilkan ke pengunjung

### C. Create Project (Admin/Editor)
1. Editor login dan akses admin panel
2. Klik "Tambah Proyek Baru"
3. AdminController::createProject() tampilkan form
4. Editor isi form (title, category, team_name, team_members, thumbnail, dll)
5. Submit form ke AdminController::createProject()
6. Controller validasi input
7. Upload thumbnail ke /uploads/projects/
8. Project model insert ke database:
   ```sql
   INSERT INTO projects (title, slug, description, category, tags, 
                         thumbnail, team_name, team_members) 
   VALUES (...)
   ```
9. Database return success
10. Controller redirect ke project list dengan success message

### D. View Project Detail with Rating & Comments
1. Pengunjung klik project card
2. Request ke ProjectController::detail($slug)
3. Controller call beberapa models:
   - Project::getBySlug($slug) → Get project data
   - ProjectRating::getAverage($id) → Get average rating
   - ProjectComment::getByProject($id) → Get all comments
4. Database return semua data
5. Controller pass ke view
6. View render detail page dengan:
   - Project info (title, description, team)
   - Average rating (bintang)
   - Comment list
   - Rating form
   - Comment form
7. Display ke pengunjung

### E. Submit Rating
1. Pengunjung klik rating (1-5 bintang)
2. AJAX/Form submit ke ProjectController::rate($id)
3. Controller validate:
   - Rating antara 1-5
   - Cek IP address (prevent duplicate)
4. ProjectRating model insert:
   ```sql
   INSERT INTO project_ratings (project_id, rating, ip_address)
   VALUES ($id, $rating, $ip)
   ```
5. Database return success
6. Controller reload page atau return JSON
7. Updated rating ditampilkan

### F. Submit Comment
1. Pengunjung isi form comment (name, email, comment)
2. Submit ke ProjectController::comment($id)
3. Controller validate:
   - Required fields tidak kosong
   - Email format valid
4. ProjectComment model insert:
   ```sql
   INSERT INTO project_comments (project_id, name, email, comment)
   VALUES ($id, $name, $email, $comment)
   ```
5. Database return success
6. Controller redirect dengan success message
7. New comment ditampilkan di list

### G. Dashboard Statistics
1. Admin login dan akses dashboard
2. AdminController::index() dipanggil
3. Controller query multiple tables:
   ```sql
   SELECT COUNT(*) FROM projects
   SELECT COUNT(*) FROM articles
   SELECT COUNT(*) FROM gallery
   SELECT COUNT(*) FROM partners
   ```
4. Database return counts
5. Controller pass stats ke dashboard view
6. View render 4 statistic cards
7. Display ke admin

---

## Data Store Details

### D1: users
**Input:**
- Admin create user → INSERT
- Admin update user → UPDATE
- Admin delete user → DELETE
- Login → SELECT by email

**Output:**
- User list untuk admin
- User data untuk authentication
- Author info untuk articles

### D2: projects
**Input:**
- Editor create project → INSERT
- Editor update project → UPDATE
- Editor delete project → DELETE

**Output:**
- Project list untuk public
- Project detail
- Featured projects untuk homepage
- Search/filter results

### D3: articles
**Input:**
- Editor create article → INSERT
- Editor update article → UPDATE
- Editor delete article → DELETE

**Output:**
- Article list untuk public
- Article detail
- Recent articles untuk homepage

### D4: gallery
**Input:**
- Editor upload media → INSERT
- Editor update media → UPDATE
- Editor delete media → DELETE

**Output:**
- Gallery items untuk public
- Filter by media type

### D5: partners
**Input:**
- Editor create partner → INSERT
- Editor update partner → UPDATE
- Editor delete partner → DELETE

**Output:**
- Partner list untuk public
- Partner logos untuk homepage

### D6: project_ratings
**Input:**
- Pengunjung submit rating → INSERT

**Output:**
- Average rating per project
- Rating count

### D7: project_comments
**Input:**
- Pengunjung submit comment → INSERT
- Editor delete comment → DELETE

**Output:**
- Comments list per project
- All comments untuk admin moderation

---

## External Entities

### 1. Pengunjung (External User)
**Input ke sistem:**
- Request halaman (GET)
- Submit rating
- Submit comment
- Search/filter criteria

**Output dari sistem:**
- HTML pages
- Project/Article data
- Gallery media
- Success/Error messages

### 2. Editor (Internal User)
**Input ke sistem:**
- Login credentials
- CRUD operations (projects, articles, gallery, partners)
- File uploads
- Content data

**Output dari sistem:**
- Dashboard
- Content management interfaces
- Success/Error confirmations
- Statistics

### 3. Admin (Internal User)
**Input ke sistem:**
- Login credentials
- User management operations
- All editor operations

**Output dari sistem:**
- Full dashboard with stats
- User management interface
- All editor outputs
- System reports

---

## File System Interaction

### Upload Flow
```
User submit file
    ↓
Controller receive $_FILES
    ↓
Validate (type, size)
    ↓
Generate unique filename
    ↓
move_uploaded_file() to /uploads/{module}/
    ↓
Save filename to database
    ↓
Return success
```

### Delete Flow
```
User request delete
    ↓
Controller get filename from database
    ↓
unlink() file from disk
    ↓
DELETE record from database
    ↓
Return success
```

---

## Session Management Flow

```
Login Success
    ↓
$_SESSION['user_id'] = $id
$_SESSION['user_name'] = $name
$_SESSION['role'] = $role
$_SESSION['logged_in'] = true
    ↓
Redirect to Dashboard
    ↓
Every admin request check:
if (!isset($_SESSION['logged_in'])) {
    redirect to login
}
    ↓
Logout: session_destroy()
```

---

## Database Transaction Examples

### Example 1: Create Project
```sql
START TRANSACTION;

INSERT INTO projects (
    title, slug, description, category, tags, 
    thumbnail, video_url, team_name, team_members
) VALUES (
    'Aplikasi Mobile Learning',
    'aplikasi-mobile-learning',
    'Aplikasi pembelajaran berbasis mobile...',
    'Mobile Development',
    'Flutter, Firebase',
    'project_123456.jpg',
    'https://youtube.com/watch?v=...',
    'Tim Inovasi Digital',
    'Ahmad Rifai\nSiti Nurhaliza\nBudi Santoso'
);

COMMIT;
```

### Example 2: Delete Project with Relations
```sql
START TRANSACTION;

-- Delete comments
DELETE FROM project_comments WHERE project_id = 1;

-- Delete ratings
DELETE FROM project_ratings WHERE project_id = 1;

-- Delete project
DELETE FROM projects WHERE id = 1;

COMMIT;
```
*(Atau gunakan ON DELETE CASCADE)*

### Example 3: Get Project Detail with Stats
```sql
-- Get project
SELECT * FROM projects WHERE slug = 'aplikasi-mobile-learning';

-- Get average rating
SELECT AVG(rating) as avg_rating, COUNT(*) as total_ratings
FROM project_ratings 
WHERE project_id = 1;

-- Get comments
SELECT * FROM project_comments 
WHERE project_id = 1 
ORDER BY created_at DESC;
```

---

## Performance Optimization

### Indexing Strategy
```sql
-- Projects
CREATE INDEX idx_projects_category ON projects(category);
CREATE INDEX idx_projects_slug ON projects(slug);
CREATE INDEX idx_projects_created ON projects(created_at);

-- Articles
CREATE INDEX idx_articles_slug ON articles(slug);
CREATE INDEX idx_articles_author ON articles(author_id);
CREATE INDEX idx_articles_created ON articles(created_at);

-- Ratings & Comments
CREATE INDEX idx_ratings_project ON project_ratings(project_id);
CREATE INDEX idx_comments_project ON project_comments(project_id);
```

### Caching Strategy (Optional)
- Cache homepage featured content (15 minutes)
- Cache statistics (5 minutes)
- Cache partner logos (1 hour)

---

## Security Measures in Data Flow

### 1. Input Validation
```php
// Validate before database
$title = htmlspecialchars($_POST['title'], ENT_QUOTES);
$email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
```

### 2. Prepared Statements
```php
// Prevent SQL Injection
$query = "SELECT * FROM users WHERE email = :email";
$stmt->execute(['email' => $email]);
```

### 3. File Upload Security
```php
// Validate file type
$allowed = ['jpg', 'jpeg', 'png', 'gif'];
$ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
if (!in_array(strtolower($ext), $allowed)) {
    throw new Exception('Invalid file type');
}
```

### 4. Session Security
```php
// Regenerate session ID on login
session_regenerate_id(true);

// Set secure session parameters
ini_set('session.cookie_httponly', 1);
ini_set('session.use_only_cookies', 1);
```

---

**Document**: Data Flow Diagram (DFD)  
**Project**: Lab MMT Website  
**Version**: 1.0  
**Date**: 4 Desember 2025  
**Author**: Tim Pengembang Lab MMT

