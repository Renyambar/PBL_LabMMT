# Flowchart - Lab MMT Workflow

## 1. User Authentication Flow

```plantuml
@startuml
start
:User mengakses /admin;

if (Session exists?) then (yes)
  :Redirect to Dashboard;
  stop
else (no)
  :Tampilkan halaman Login;
  :User input email & password;
  :Submit form;
  
  if (Email & Password valid?) then (yes)
    if (User active?) then (yes)
      :Create session;
      :Set user_id, role, name;
      :Redirect to Dashboard;
      stop
    else (no)
      :Show error:\n"Akun tidak aktif";
      stop
    endif
  else (no)
    :Show error:\n"Email atau password salah";
    stop
  endif
endif
@enduml
```

---

## 2. View Projects (Public) Flow

```plantuml
@startuml
start
:Pengunjung akses /project;
:ProjectController::index();

:Query database:\nSELECT * FROM projects;

if (Projects found?) then (yes)
  :Load project data;
  :Render view dengan\nproject cards;
  :Display to user;
else (no)
  :Display "Belum ada proyek";
endif

stop
@enduml
```

---

## 3. View Project Detail Flow

```plantuml
@startuml
start
:Pengunjung klik project card;
:Request /project/{slug};
:ProjectController::detail($slug);

:Query: SELECT * FROM projects\nWHERE slug = $slug;

if (Project found?) then (yes)
  :Get project data;
  
  :Query average rating:\nSELECT AVG(rating)\nFROM project_ratings;
  
  :Query comments:\nSELECT * FROM project_comments\nWHERE project_id = $id;
  
  :Compile all data;
  :Render detail view dengan:
  - Project info
  - Team info  
  - Rating form
  - Comment form
  - Comments list;
  
  :Display to user;
else (no)
  :Show 404 error;
endif

stop
@enduml
```

---

## 4. Create Project (Admin/Editor) Flow

```plantuml
@startuml
start
:Editor login & akses admin;

if (Authenticated?) then (yes)
  :Click "Tambah Proyek";
  :AdminController::createProject();
  
  if (Method = GET?) then (yes)
    :Show empty form;
    stop
  else (POST)
    :Receive form data;
    
    :Validate input:
    - Title required
    - Category required
    - Description required;
    
    if (Validation passed?) then (yes)
      if (File uploaded?) then (yes)
        :Validate file:
        - Type: jpg/png/gif
        - Size: < 5MB;
        
        if (File valid?) then (yes)
          :Generate unique filename;
          :Upload to /uploads/projects/;
          :Get uploaded filename;
        else (no)
          :Show error:\n"File tidak valid";
          stop
        endif
      else (no)
        :Set default thumbnail;
      endif
      
      :Generate slug from title;
      
      :INSERT INTO projects:
      - title
      - slug
      - description
      - category
      - tags
      - thumbnail
      - video_url
      - team_name
      - team_members;
      
      if (Insert success?) then (yes)
        :Show success message;
        :Redirect to project list;
      else (no)
        :Show error:\n"Gagal menyimpan";
      endif
    else (no)
      :Show validation errors;
    endif
  endif
else (no)
  :Redirect to login;
endif

stop
@enduml
```

---

## 5. Edit Project Flow

```plantuml
@startuml
start
:Editor click "Edit" button;
:AdminController::editProject($id);

if (Method = GET?) then (yes)
  :Query: SELECT * FROM projects\nWHERE id = $id;
  
  if (Project found?) then (yes)
    :Load project data;
    :Show form with\npre-filled data;
    stop
  else (no)
    :Show 404 error;
    stop
  endif
else (POST)
  :Receive updated form data;
  
  :Validate input;
  
  if (Validation passed?) then (yes)
    if (New file uploaded?) then (yes)
      :Validate file;
      
      if (File valid?) then (yes)
        :Get old filename;
        :Delete old file from disk;
        :Upload new file;
        :Get new filename;
      else (no)
        :Show error:\n"File tidak valid";
        stop
      endif
    else (no)
      :Keep existing thumbnail;
    endif
    
    :UPDATE projects SET
    title, description, category, etc.
    WHERE id = $id;
    
    if (Update success?) then (yes)
      :Show success message;
      :Redirect to project list;
    else (no)
      :Show error:\n"Gagal update";
    endif
  else (no)
    :Show validation errors;
  endif
endif

stop
@enduml
```

---

## 6. Delete Project Flow

```plantuml
@startuml
start
:Editor click "Hapus" button;
:Confirm dialog shown;

if (User confirms?) then (yes)
  :AdminController::deleteProject($id);
  
  :Query: SELECT * FROM projects\nWHERE id = $id;
  
  if (Project found?) then (yes)
    :Get thumbnail filename;
    
    if (Thumbnail exists?) then (yes)
      :Delete file from\n/uploads/projects/;
    endif
    
    :DELETE FROM project_comments\nWHERE project_id = $id;
    
    :DELETE FROM project_ratings\nWHERE project_id = $id;
    
    :DELETE FROM projects\nWHERE id = $id;
    
    if (Delete success?) then (yes)
      :Show success message;
      :Reload project list;
    else (no)
      :Show error:\n"Gagal menghapus";
    endif
  else (no)
    :Show error:\n"Project tidak ditemukan";
  endif
else (no)
  :Cancel operation;
endif

stop
@enduml
```

---

## 7. Submit Rating Flow

```plantuml
@startuml
start
:Pengunjung di halaman detail project;
:Click rating (1-5 stars);
:Submit rating form;
:ProjectController::rate($id);

:Get IP address;
:Get rating value (1-5);

:Validate:
- Rating between 1-5
- Project exists;

if (Validation passed?) then (yes)
  :Check: SELECT * FROM project_ratings
  WHERE project_id = $id
  AND ip_address = $ip;
  
  if (Already rated?) then (yes)
    :UPDATE project_ratings
    SET rating = $rating
    WHERE project_id = $id
    AND ip_address = $ip;
  else (no)
    :INSERT INTO project_ratings
    (project_id, rating, ip_address);
  endif
  
  if (Save success?) then (yes)
    :Calculate new average;
    :Show success message;
    :Reload page with\nupdated rating;
  else (no)
    :Show error:\n"Gagal menyimpan rating";
  endif
else (no)
  :Show validation error;
endif

stop
@enduml
```

---

## 8. Submit Comment Flow

```plantuml
@startuml
start
:Pengunjung di halaman detail project;
:Fill comment form:
- Name
- Email
- Comment;

:Submit form;
:ProjectController::comment($id);

:Validate input:
- Name required
- Email required & valid format
- Comment required;

if (Validation passed?) then (yes)
  :Sanitize input:
  - htmlspecialchars()
  - strip_tags();
  
  :INSERT INTO project_comments:
  - project_id
  - name
  - email
  - comment
  - created_at;
  
  if (Insert success?) then (yes)
    :Show success message;
    :Redirect to detail page;
    :Display new comment\nin list;
  else (no)
    :Show error:\n"Gagal menyimpan komentar";
  endif
else (no)
  :Show validation errors;
endif

stop
@enduml
```

---

## 9. Search/Filter Projects Flow

```plantuml
@startuml
start
:User input keyword atau\nselect category filter;

:Submit search form;
:ProjectController::index();

:Get search parameters:
- keyword (optional)
- category (optional);

:Build SQL query;

if (Keyword exists?) then (yes)
  :Add WHERE clause:
  title LIKE '%keyword%'
  OR description LIKE '%keyword%';
endif

if (Category exists?) then (yes)
  :Add WHERE clause:
  category = $category;
endif

:Execute query;

if (Results found?) then (yes)
  :Display filtered projects;
else (no)
  :Display "Tidak ada hasil";
endif

stop
@enduml
```

---

## 10. Upload Gallery Media Flow

```plantuml
@startuml
start
:Editor akses Admin > Gallery;
:Click "Upload Media";
:AdminController::createGallery();

if (Method = GET?) then (yes)
  :Show upload form;
  stop
else (POST)
  :Receive form data:
  - Title
  - Description
  - Media type
  - File;
  
  :Validate input:
  - Title required
  - Media type required
  - File required;
  
  if (Validation passed?) then (yes)
    if (Media type = image?) then (yes)
      :Validate: jpg/png/gif;
    else (video)
      :Validate: mp4/avi/mov;
    endif
    
    if (File valid?) then (yes)
      :Generate unique filename;
      :Upload to /uploads/gallery/;
      
      if (Upload success?) then (yes)
        :INSERT INTO gallery:
        - title
        - description
        - media_type
        - file_path;
        
        if (Insert success?) then (yes)
          :Show success message;
          :Redirect to gallery list;
        else (no)
          :Delete uploaded file;
          :Show error:\n"Gagal menyimpan";
        endif
      else (no)
        :Show error:\n"Gagal upload";
      endif
    else (no)
      :Show error:\n"File tidak valid";
    endif
  else (no)
    :Show validation errors;
  endif
endif

stop
@enduml
```

---

## 11. Admin Dashboard Load Flow

```plantuml
@startuml
start
:Admin login;
:Redirect to /admin/dashboard;
:AdminController::index();

if (Authenticated?) then (yes)
  :Query statistics:
  
  SELECT COUNT(*) FROM projects;
  :Get total_projects;
  
  SELECT COUNT(*) FROM articles;
  :Get total_articles;
  
  SELECT COUNT(*) FROM gallery;
  :Get total_gallery;
  
  SELECT COUNT(*) FROM partners;
  :Get total_partners;
  
  :Query recent projects:
  SELECT * FROM projects
  ORDER BY created_at DESC
  LIMIT 5;
  
  :Query recent articles:
  SELECT * FROM articles
  ORDER BY created_at DESC
  LIMIT 5;
  
  :Compile dashboard data;
  :Render dashboard view:
  - 4 statistic cards
  - Recent projects table
  - Recent articles table
  - Quick action buttons;
  
  :Display to admin;
else (no)
  :Redirect to login;
endif

stop
@enduml
```

---

## 12. User Management (CRUD) Flow

```plantuml
@startuml
start
:Admin akses User Management;

partition "View Users" {
  :AdminController::users();
  :Query: SELECT * FROM users;
  :Display user table;
}

:Admin action?;

if (Create User) then
  :Click "Tambah User";
  :Show user form;
  :Input: name, email, password, role;
  :Submit form;
  
  :Validate:
  - All fields required
  - Email unique
  - Password min 6 chars;
  
  if (Valid?) then (yes)
    :Hash password:
    password_hash();
    
    :INSERT INTO users;
    
    if (Success?) then (yes)
      :Show success;
      :Reload user list;
    else (no)
      :Show error;
    endif
  else (no)
    :Show validation errors;
  endif
  
elseif (Edit User) then
  :Click "Edit";
  :Load user data;
  :Show pre-filled form;
  :Update fields;
  :Submit form;
  
  :Validate input;
  
  if (Valid?) then (yes)
    if (Password changed?) then (yes)
      :Hash new password;
    endif
    
    :UPDATE users WHERE id;
    
    if (Success?) then (yes)
      :Show success;
      :Reload user list;
    else (no)
      :Show error;
    endif
  else (no)
    :Show validation errors;
  endif
  
elseif (Delete User) then
  :Click "Hapus";
  :Confirm dialog;
  
  if (Confirmed?) then (yes)
    :DELETE FROM users WHERE id;
    
    if (Success?) then (yes)
      :Show success;
      :Reload user list;
    else (no)
      :Show error;
    endif
  else (no)
    :Cancel;
  endif
  
else (Toggle Status)
  :Click status toggle;
  :UPDATE users
  SET is_active = !is_active
  WHERE id;
  
  if (Success?) then (yes)
    :Show success;
    :Update status display;
  else (no)
    :Show error;
  endif
endif

stop
@enduml
```

---

## 13. Article Management Flow

```plantuml
@startuml
start
:Editor akses Articles;
:AdminController::articles();

:Query: SELECT articles.*, users.name
FROM articles
LEFT JOIN users ON articles.author_id = users.id;

:Display articles table;

:Editor action?;

if (Create Article) then
  :Click "Tambah Artikel";
  :Show article form;
  :Input:
  - Title
  - Content (Rich text)
  - Featured image
  - Published status;
  
  :Submit form;
  
  :Validate input;
  
  if (Valid?) then (yes)
    if (Image uploaded?) then (yes)
      :Upload to /uploads/articles/;
    endif
    
    :Generate slug;
    :Set author_id from session;
    
    :INSERT INTO articles;
    
    if (Success?) then (yes)
      :Show success;
      :Redirect to article list;
    else (no)
      :Show error;
    endif
  else (no)
    :Show validation errors;
  endif

elseif (Edit Article) then
  :Click "Edit";
  :Load article data;
  :Show pre-filled form;
  :Update content;
  :Submit form;
  
  :Validate input;
  
  if (Valid?) then (yes)
    if (New image uploaded?) then (yes)
      :Delete old image;
      :Upload new image;
    endif
    
    :UPDATE articles WHERE id;
    
    if (Success?) then (yes)
      :Show success;
      :Redirect to article list;
    else (no)
      :Show error;
    endif
  else (no)
    :Show validation errors;
  endif

else (Delete Article)
  :Click "Hapus";
  :Confirm deletion;
  
  if (Confirmed?) then (yes)
    :Get featured_image;
    :Delete image file;
    :DELETE FROM articles WHERE id;
    
    if (Success?) then (yes)
      :Show success;
      :Reload article list;
    else (no)
      :Show error;
    endif
  else (no)
    :Cancel;
  endif
endif

stop
@enduml
```

---

## 14. File Upload Process Flow

```plantuml
@startuml
start
:User selects file from form;
:Submit form with file;
:Controller receives $_FILES;

:Validate file:
- Check file exists
- Check size <= max (5MB)
- Check allowed extensions;

if (Validation passed?) then (yes)
  :Get file info:
  - Original name
  - Extension
  - Tmp path;
  
  :Generate unique filename:
  timestamp_randomstring.ext;
  
  :Set destination path:
  /uploads/{module}/;
  
  :Check directory exists;
  
  if (Directory exists?) then (yes)
    :Continue;
  else (no)
    :Create directory:
    mkdir() recursive;
  endif
  
  :Move uploaded file:
  move_uploaded_file(tmp, destination);
  
  if (Move success?) then (yes)
    :Set file permissions:
    chmod(0644);
    
    :Return filename;
    :Save to database;
    
    :Upload complete;
    stop
  else (no)
    :Log error;
    :Show error:\n"Gagal upload file";
    stop
  endif
else (no)
  :Show validation error;
  stop
endif
@enduml
```

---

## 15. Logout Flow

```plantuml
@startuml
start
:User click "Logout" button;
:AuthController::logout();

:Destroy session:
session_destroy();

:Unset all session variables:
$_SESSION = [];

:Delete session cookie:
setcookie(session_name(), '', time()-3600);

:Show logout message;
:Redirect to homepage atau login;

stop
@enduml
```

---

## 16. Homepage Load Flow

```plantuml
@startuml
start
:Pengunjung akses homepage /;
:HomeController::index();

:Query featured projects:
SELECT * FROM projects
ORDER BY created_at DESC
LIMIT 6;

:Query recent articles:
SELECT * FROM articles
WHERE is_published = 1
ORDER BY created_at DESC
LIMIT 3;

:Query partners:
SELECT * FROM partners
WHERE is_active = 1
ORDER BY display_order;

:Query gallery highlights:
SELECT * FROM gallery
ORDER BY created_at DESC
LIMIT 8;

:Compile all data;

:Render homepage view:
- Hero section
- Featured projects
- Recent articles
- Partners logo carousel
- Gallery preview
- Contact info with maps;

:Display to visitor;

stop
@enduml
```

---

## 17. Error Handling Flow

```plantuml
@startuml
start
:User action / Request;

:Try execute operation;

if (Operation success?) then (yes)
  :Return success response;
  :Update UI;
  :Show success message;
  stop
else (no)
  :Catch exception;
  
  if (Database error?) then (yes)
    :Log error to file:
    error_log();
    
    :Show generic error:
    "Terjadi kesalahan sistem";
  elseif (Validation error?) then
    :Show validation message:
    "Data tidak valid";
  elseif (File error?) then
    :Show file error:
    "Gagal upload file";
  elseif (Auth error?) then
    :Redirect to login;
  else (Other error)
    :Log error;
    :Show generic error;
  endif
  
  :Keep user on page;
  :Allow retry;
  stop
endif
@enduml
```

---

## 18. Middleware/Authorization Check Flow

```plantuml
@startuml
start
:User request admin page;

:Check session exists?;

if (Session exists?) then (yes)
  :Get user_id from session;
  
  :Query: SELECT * FROM users
  WHERE id = $user_id
  AND is_active = 1;
  
  if (User found & active?) then (yes)
    :Check required role;
    
    if (Admin only page?) then (yes)
      if (User role = admin?) then (yes)
        :Allow access;
        stop
      else (no)
        :Show error:
        "Akses ditolak";
        :Redirect to dashboard;
        stop
      endif
    else (Admin or Editor)
      if (User role = admin OR editor?) then (yes)
        :Allow access;
        stop
      else (no)
        :Show error:
        "Akses ditolak";
        :Redirect to homepage;
        stop
      endif
    endif
  else (no)
    :Destroy session;
    :Redirect to login;
    stop
  endif
else (no)
  :Redirect to login page;
  stop
endif
@enduml
```

---

## 19. Comment Moderation Flow

```plantuml
@startuml
start
:Admin/Editor akses Comments;
:AdminController::comments();

:Query: SELECT c.*, p.title
FROM project_comments c
JOIN projects p ON c.project_id = p.id
ORDER BY c.created_at DESC;

:Display comments table with:
- Project title
- Commenter name
- Comment text
- Date
- Action buttons;

:Admin action?;

if (Approve Comment) then
  :Click "Approve";
  :UPDATE project_comments
  SET is_approved = 1
  WHERE id;
  
  :Show on public page;
  :Show success;

elseif (Delete Comment) then
  :Click "Delete";
  :Confirm deletion;
  
  if (Confirmed?) then (yes)
    :DELETE FROM project_comments
    WHERE id;
    
    :Show success;
    :Reload comment list;
  else (no)
    :Cancel;
  endif

else (View Project)
  :Click project title;
  :Redirect to project detail;
endif

stop
@enduml
```

---

## 20. Application Initialization Flow

```plantuml
@startuml
start
:User request URL;
:Apache receives request;
:.htaccess rewrite rule;
:Forward to /public/index.php;

:Load config.php:
- Database credentials
- Base URL
- Environment settings;

:Initialize autoloader:
spl_autoload_register();

:Start session:
session_start();

:Parse URL:
- Get controller
- Get method
- Get parameters;

:Create App instance;

if (Controller exists?) then (yes)
  :Instantiate controller;
  
  if (Method exists?) then (yes)
    :Call method with parameters;
    :Execute business logic;
    :Return response;
  else (no)
    :Call default index() method;
  endif
else (no)
  :Show 404 page;
endif

:Render view;
:Send response to client;

stop
@enduml
```

---

**Document**: Workflow Flowcharts  
**Project**: Lab MMT Website  
**Version**: 1.0  
**Date**: 4 Desember 2025  
**Author**: Tim Pengembang Lab MMT

