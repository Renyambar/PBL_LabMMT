<?php

class AdminController extends Controller
{
    private $projectModel;
    private $articleModel;
    private $galleryModel;
    private $partnerModel;
    private $userModel;
    private $commentModel;
    private $publicationModel;
    private $labProfileModel;

    public function __construct()
    {
        parent::__construct();
        $this->requireLogin();
        
        $this->projectModel = $this->model('Project');
        $this->articleModel = $this->model('Article');
        $this->galleryModel = $this->model('Gallery');
        $this->partnerModel = $this->model('Partner');
        $this->userModel = $this->model('User');
        $this->commentModel = $this->model('ProjectComment');
        $this->publicationModel = $this->model('Publication');
        $this->labProfileModel = $this->model('LabProfile');
    }

    // Dashboard
    public function index()
    {
        $data = [
            'title' => 'Dashboard - ' . APP_NAME,
            'total_projects' => count($this->projectModel->getAll()),
            'total_articles' => count($this->articleModel->getAll()),
            'total_galleries' => count($this->galleryModel->getAll()),
            'total_partners' => count($this->partnerModel->getAll()),
            'recent_projects' => $this->projectModel->getFeatured(5),
            'recent_articles' => $this->articleModel->getRecent(5)
        ];

        $this->view('admin/dashboard', $data);
    }

    // Manage Projects
    public function projects()
    {
        $data = [
            'title' => 'Manage Projects - ' . APP_NAME,
            'projects' => $this->projectModel->getAll()
        ];

        $this->view('admin/projects', $data);
    }

    // Manage Articles
    public function articles()
    {
        $search = $_GET['search'] ?? '';
        $articles = !empty($search) ? $this->articleModel->search($search) : $this->articleModel->getAll();
        
        $data = [
            'title' => 'Manage Articles - ' . APP_NAME,
            'articles' => $articles
        ];

        $this->view('admin/articles', $data);
    }

    // Manage Gallery
    public function gallery()
    {
        $search = $_GET['search'] ?? '';
        $type = $_GET['type'] ?? '';
        
        // Tentukan data galeri berdasarkan filter
        if (!empty($search) && !empty($type)) {
            $galleries = $this->galleryModel->searchByTypeAndKeyword($type, $search);
        } elseif (!empty($search)) {
            $galleries = $this->galleryModel->search($search);
        } elseif (!empty($type)) {
            $galleries = $this->galleryModel->getByType($type);
        } else {
            $galleries = $this->galleryModel->getAll();
        }
        
        $data = [
            'title' => 'Manage Gallery - ' . APP_NAME,
            'galleries' => $galleries
        ];

        $this->view('admin/gallery', $data);
    }

    // Manage Partners
    public function partners()
    {
        $this->requireAdmin();
        
        $data = [
            'title' => 'Manage Partners - ' . APP_NAME,
            'partners' => $this->partnerModel->getAll()
        ];

        $this->view('admin/partners', $data);
    }

    // Manage Users 
    public function users()
    {
        $this->requireAdmin();

        $data = [
            'title' => 'Manage Users - ' . APP_NAME,
            'users' => $this->userModel->getAll()
        ];

        $this->view('admin/users', $data);
    }

    // ========== PROJECTS CRUD ==========
    
    public function projects_create()
    {
        $data = ['title' => 'Create Project - ' . APP_NAME];
        $this->view('admin/project_form', $data);
    }

    public function projects_store()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'title' => $_POST['title'],
                'description' => $_POST['description'],
                'category' => $_POST['category'],
                'tags' => $_POST['tags'] ?? null,
                'team_name' => $_POST['team_name'] ?? null,
                'team_members' => $_POST['team_members'] ?? null,
                'supervisor' => $_POST['supervisor'] ?? null,
                'client' => $_POST['client'] ?? null,
                'technologies' => $_POST['technologies'] ?? null,
                'github_url' => $_POST['github_url'] ?? null,
                'demo_url' => $_POST['demo_url'] ?? null,
                'video_url' => $_POST['video_url'] ?? null,
                'thumbnail' => null
            ];

            if (isset($_FILES['thumbnail']) && $_FILES['thumbnail']['error'] == 0) {
                $upload = $this->uploadFile($_FILES['thumbnail'], 'projects/');
                if ($upload['success']) {
                    $data['thumbnail'] = $upload['filename'];
                }
            }

            if ($this->projectModel->create($data)) {
                $_SESSION['message'] = 'Project created successfully!';
            } else {
                $_SESSION['error'] = 'Failed to create project';
            }
        }
        $this->redirect('admin/projects');
    }

    public function projects_edit($id)
    {
        $project = $this->projectModel->getById($id);
        if (!$project) {
            $this->redirect('admin/projects');
            return;
        }

        $data = [
            'title' => 'Edit Project - ' . APP_NAME,
            'project' => $project
        ];
        $this->view('admin/project_form', $data);
    }

    public function projects_update($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $project = $this->projectModel->getById($id);
            
            $data = [
                'title' => $_POST['title'],
                'description' => $_POST['description'],
                'category' => $_POST['category'],
                'tags' => $_POST['tags'] ?? null,
                'team_name' => $_POST['team_name'] ?? null,
                'team_members' => $_POST['team_members'] ?? null,
                'supervisor' => $_POST['supervisor'] ?? null,
                'client' => $_POST['client'] ?? null,
                'technologies' => $_POST['technologies'] ?? null,
                'github_url' => $_POST['github_url'] ?? null,
                'demo_url' => $_POST['demo_url'] ?? null,
                'video_url' => $_POST['video_url'] ?? null,
                'thumbnail' => $project['thumbnail']
            ];

            if (isset($_FILES['thumbnail']) && $_FILES['thumbnail']['error'] == 0) {
                $upload = $this->uploadFile($_FILES['thumbnail'], 'projects/');
                if ($upload['success']) {
                    $data['thumbnail'] = $upload['filename'];
                }
            }

            if ($this->projectModel->update($id, $data)) {
                $_SESSION['message'] = 'Project updated successfully!';
            } else {
                $_SESSION['error'] = 'Failed to update project';
            }
        }
        $this->redirect('admin/projects');
    }

    public function projects_delete($id)
    {
        if ($this->projectModel->delete($id)) {
            $_SESSION['message'] = 'Project deleted successfully!';
        } else {
            $_SESSION['error'] = 'Failed to delete project';
        }
        $this->redirect('admin/projects');
    }

    // ========== ARTICLES CRUD ==========
    
    public function articles_create()
    {
        $data = ['title' => 'Create Article - ' . APP_NAME];
        $this->view('admin/article_form', $data);
    }

    public function articles_store()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'title' => $_POST['title'],
                'content' => $_POST['content'],
                'author_id' => $_SESSION['user_id'],
                'thumbnail' => null
            ];

            if (isset($_FILES['thumbnail']) && $_FILES['thumbnail']['error'] == 0) {
                $upload = $this->uploadFile($_FILES['thumbnail'], 'articles/');
                if ($upload['success']) {
                    $data['thumbnail'] = $upload['filename'];
                }
            }

            if ($this->articleModel->create($data)) {
                $_SESSION['message'] = 'Article created successfully!';
            } else {
                $_SESSION['error'] = 'Failed to create article';
            }
        }
        $this->redirect('admin/articles');
    }

    public function articles_edit($id)
    {
        $article = $this->articleModel->getById($id);
        if (!$article) {
            $this->redirect('admin/articles');
            return;
        }

        $data = [
            'title' => 'Edit Article - ' . APP_NAME,
            'article' => $article
        ];
        $this->view('admin/article_form', $data);
    }

    public function articles_update($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $article = $this->articleModel->getById($id);
            
            $data = [
                'title' => $_POST['title'],
                'content' => $_POST['content'],
                'thumbnail' => $article['thumbnail']
            ];

            if (isset($_FILES['thumbnail']) && $_FILES['thumbnail']['error'] == 0) {
                $upload = $this->uploadFile($_FILES['thumbnail'], 'articles/');
                if ($upload['success']) {
                    $data['thumbnail'] = $upload['filename'];
                }
            }

            if ($this->articleModel->update($id, $data)) {
                $_SESSION['message'] = 'Article updated successfully!';
            } else {
                $_SESSION['error'] = 'Failed to update article';
            }
        }
        $this->redirect('admin/articles');
    }

    public function articles_delete($id)
    {
        if ($this->articleModel->delete($id)) {
            $_SESSION['message'] = 'Article deleted successfully!';
        } else {
            $_SESSION['error'] = 'Failed to delete article';
        }
        $this->redirect('admin/articles');
    }

    // ========== GALLERY CRUD ==========
    
    public function gallery_create()
    {
        $data = ['title' => 'Upload Media - ' . APP_NAME];
        $this->view('admin/gallery_form', $data);
    }

    public function gallery_store()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'title' => $_POST['title'],
                'media_type' => $_POST['media_type'],
                'description' => $_POST['description'] ?? null,
                'file_path' => null
            ];

            if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
                $upload = $this->uploadFile($_FILES['file'], 'gallery/');
                if ($upload['success']) {
                    $data['file_path'] = $upload['filename'];
                } else {
                    $_SESSION['error'] = $upload['message'];
                    $this->redirect('admin/gallery/create');
                    return;
                }
            } else {
                $_SESSION['error'] = 'Please upload a file';
                $this->redirect('admin/gallery/create');
                return;
            }

            if ($this->galleryModel->create($data)) {
                $_SESSION['message'] = 'Media uploaded successfully!';
            } else {
                $_SESSION['error'] = 'Failed to upload media';
            }
        }
        $this->redirect('admin/gallery');
    }

    public function gallery_edit($id)
    {
        $gallery = $this->galleryModel->getById($id);
        if (!$gallery) {
            $this->redirect('admin/gallery');
            return;
        }

        $data = [
            'title' => 'Edit Media - ' . APP_NAME,
            'gallery' => $gallery
        ];
        $this->view('admin/gallery_form', $data);
    }

    public function gallery_update($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $gallery = $this->galleryModel->getById($id);
            
            $data = [
                'title' => $_POST['title'],
                'media_type' => $_POST['media_type'],
                'description' => $_POST['description'] ?? null,
                'file_path' => $gallery['file_path']
            ];

            if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
                $upload = $this->uploadFile($_FILES['file'], 'gallery/');
                if ($upload['success']) {
                    $data['file_path'] = $upload['filename'];
                }
            }

            if ($this->galleryModel->update($id, $data)) {
                $_SESSION['message'] = 'Media updated successfully!';
            } else {
                $_SESSION['error'] = 'Failed to update media';
            }
        }
        $this->redirect('admin/gallery');
    }

    public function gallery_delete($id)
    {
        if ($this->galleryModel->delete($id)) {
            $_SESSION['message'] = 'Media deleted successfully!';
        } else {
            $_SESSION['error'] = 'Failed to delete media';
        }
        $this->redirect('admin/gallery');
    }

    // ========== USERS CRUD ==========
    
    public function users_create()
    {
        $this->requireAdmin();
        $data = ['title' => 'Create User - ' . APP_NAME];
        $this->view('admin/user_form', $data);
    }

    public function users_store()
    {
        $this->requireAdmin();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($_POST['password'] !== $_POST['password_confirmation']) {
                $_SESSION['error'] = 'Password tidak cocok';
                $this->redirect('admin/users/create');
                return;
            }

            $data = [
                'name' => $_POST['name'],
                'email' => $_POST['email'],
                'password' => $_POST['password'],
                'role' => $_POST['role']
            ];

            if ($this->userModel->create($data)) {
                $_SESSION['message'] = 'Pengguna berhasil ditambahkan!';
            } else {
                $_SESSION['error'] = 'Gagal menambahkan pengguna';
            }
        }
        $this->redirect('admin/users');
    }

    public function users_edit($id)
    {
        $this->requireAdmin();
        
        $user = $this->userModel->getById($id);
        if (!$user) {
            $this->redirect('admin/users');
            return;
        }

        $data = [
            'title' => 'Edit User - ' . APP_NAME,
            'user' => $user
        ];
        $this->view('admin/user_form', $data);
    }

    public function users_update($id)
    {
        $this->requireAdmin();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'name' => $_POST['name'],
                'email' => $_POST['email'],
                'role' => $_POST['role']
            ];

            if (!empty($_POST['password'])) {
                $data['password'] = $_POST['password'];
            }

            if ($this->userModel->update($id, $data)) {
                $_SESSION['message'] = 'User updated successfully!';
            } else {
                $_SESSION['error'] = 'Failed to update user';
            }
        }
        $this->redirect('admin/users');
    }

    public function users_delete($id)
    {
        $this->requireAdmin();

        if ($id == $_SESSION['user_id']) {
            $_SESSION['error'] = 'You cannot delete your own account';
            $this->redirect('admin/users');
            return;
        }

        if ($this->userModel->delete($id)) {
            $_SESSION['message'] = 'User deleted successfully!';
        } else {
            $_SESSION['error'] = 'Failed to delete user';
        }
        $this->redirect('admin/users');
    }

    // ========== PARTNERS CRUD ==========
    
    public function partners_create()
    {
        $this->requireAdmin();
        $data = ['title' => 'Add Partner - ' . APP_NAME];
        $this->view('admin/partner_form', $data);
    }

    public function partners_store()
    {
        $this->requireAdmin();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'name' => $_POST['name'],
                'website' => $_POST['website'] ?? null,
                'logo' => null
            ];

            if (isset($_FILES['logo']) && $_FILES['logo']['error'] == 0) {
                $upload = $this->uploadFile($_FILES['logo'], 'partners/');
                if ($upload['success']) {
                    $data['logo'] = $upload['filename'];
                }
            }

            if ($this->partnerModel->create($data)) {
                $_SESSION['message'] = 'Partner added successfully!';
            } else {
                $_SESSION['error'] = 'Failed to add partner';
            }
        }
        $this->redirect('admin/partners');
    }

    public function partners_edit($id)
    {
        $this->requireAdmin();
        $partner = $this->partnerModel->getById($id);
        if (!$partner) {
            $this->redirect('admin/partners');
            return;
        }

        $data = [
            'title' => 'Edit Partner - ' . APP_NAME,
            'partner' => $partner
        ];
        $this->view('admin/partner_form', $data);
    }

    public function partners_update($id)
    {
        $this->requireAdmin();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $partner = $this->partnerModel->getById($id);
            
            $data = [
                'name' => $_POST['name'],
                'website' => $_POST['website'] ?? null,
                'logo' => $partner['logo']
            ];

            if (isset($_FILES['logo']) && $_FILES['logo']['error'] == 0) {
                $upload = $this->uploadFile($_FILES['logo'], 'partners/');
                if ($upload['success']) {
                    $data['logo'] = $upload['filename'];
                }
            }

            if ($this->partnerModel->update($id, $data)) {
                $_SESSION['message'] = 'Partner updated successfully!';
            } else {
                $_SESSION['error'] = 'Failed to update partner';
            }
        }
        $this->redirect('admin/partners');
    }

    public function partners_delete($id)
    {
        $this->requireAdmin();
        if ($this->partnerModel->delete($id)) {
            $_SESSION['message'] = 'Partner deleted successfully!';
        } else {
            $_SESSION['error'] = 'Failed to delete partner';
        }
        $this->redirect('admin/partners');
    }

    // ========== COMMENTS MANAGEMENT ==========
    
    public function comments()
    {
        $data = [
            'title' => 'Manage Comments - ' . APP_NAME,
            'comments' => $this->commentModel->getAll(),
            'pending' => $this->commentModel->getPending()
        ];

        $this->view('admin/comments', $data);
    }

    public function comments_approve($id)
    {
        if ($this->commentModel->approve($id)) {
            $_SESSION['message'] = 'Komentar disetujui!';
        } else {
            $_SESSION['error'] = 'Gagal menyetujui komentar';
        }
        $this->redirect('admin/comments');
    }

    public function comments_unapprove($id)
    {
        if ($this->commentModel->unapprove($id)) {
            $_SESSION['message'] = 'Komentar tidak disetujui!';
        } else {
            $_SESSION['error'] = 'Gagal tidak menyetujui komentar';
        }
        $this->redirect('admin/comments');
    }

    public function comments_delete($id)
    {
        if ($this->commentModel->delete($id)) {
            $_SESSION['message'] = 'Comment deleted successfully!';
        } else {
            $_SESSION['error'] = 'Failed to delete comment';
        }
        $this->redirect('admin/comments');
    }

    // Publications Management
    public function publications()
    {
        $data = [
            'title' => 'Kelola Publikasi - ' . APP_NAME,
            'publications' => $this->publicationModel->getAll()
        ];

        $this->view('admin/publications', $data);
    }

    public function createPublication()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Generate slug
            $slug = $this->publicationModel->generateSlug($_POST['title']);
            $counter = 1;
            while ($this->publicationModel->slugExists($slug)) {
                $slug = $this->publicationModel->generateSlug($_POST['title']) . '-' . $counter;
                $counter++;
            }

            // Handle PDF file upload
            $pdfFile = null;
            if (isset($_FILES['pdf_file']) && $_FILES['pdf_file']['error'] == 0) {
                $allowed = ['pdf'];
                $filename = $_FILES['pdf_file']['name'];
                $fileTmp = $_FILES['pdf_file']['tmp_name'];
                $fileExt = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

                if (in_array($fileExt, $allowed)) {
                    $newFilename = 'publication_' . uniqid() . '.pdf';
                    $uploadPath = '../public/assets/pdf/publications/';
                    
                    if (!is_dir($uploadPath)) {
                        mkdir($uploadPath, 0755, true);
                    }

                    if (move_uploaded_file($fileTmp, $uploadPath . $newFilename)) {
                        $pdfFile = $newFilename;
                    }
                }
            }

            $publicationData = [
                'title' => $_POST['title'],
                'slug' => $slug,
                'authors' => $_POST['authors'],
                'abstract' => $_POST['abstract'],
                'publication_type' => $_POST['publication_type'],
                'journal_name' => $_POST['journal_name'] ?? null,
                'conference_name' => $_POST['conference_name'] ?? null,
                'publisher' => $_POST['publisher'] ?? null,
                'publication_date' => $_POST['publication_date'] ?? null,
                'volume' => $_POST['volume'] ?? null,
                'issue' => $_POST['issue'] ?? null,
                'pages' => $_POST['pages'] ?? null,
                'doi' => $_POST['doi'] ?? null,
                'isbn' => $_POST['isbn'] ?? null,
                'issn' => $_POST['issn'] ?? null,
                'url' => $_POST['url'] ?? null,
                'pdf_file' => $pdfFile,
                'keywords' => $_POST['keywords'] ?? null,
                'citation_count' => $_POST['citation_count'] ?? 0,
                'created_by' => $_SESSION['user_id']
            ];

            if ($this->publicationModel->create($publicationData)) {
                $_SESSION['message'] = 'Publikasi berhasil ditambahkan!';
                $this->redirect('admin/publications');
            } else {
                $_SESSION['error'] = 'Gagal menambahkan publikasi';
            }
        }

        $data = [
            'title' => 'Tambah Publikasi - ' . APP_NAME,
            'types' => $this->publicationModel->getTypes()
        ];

        $this->view('admin/publication_form', $data);
    }

    public function editPublication($id)
    {
        $publication = $this->publicationModel->getById($id);

        if (!$publication) {
            $_SESSION['error'] = 'Publikasi tidak ditemukan';
            $this->redirect('admin/publications');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Generate slug
            $slug = $this->publicationModel->generateSlug($_POST['title']);
            $counter = 1;
            while ($this->publicationModel->slugExists($slug, $id)) {
                $slug = $this->publicationModel->generateSlug($_POST['title']) . '-' . $counter;
                $counter++;
            }

            // Handle PDF file upload
            $pdfFile = $publication->pdf_file;
            if (isset($_FILES['pdf_file']) && $_FILES['pdf_file']['error'] == 0) {
                $allowed = ['pdf'];
                $filename = $_FILES['pdf_file']['name'];
                $fileTmp = $_FILES['pdf_file']['tmp_name'];
                $fileExt = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

                if (in_array($fileExt, $allowed)) {
                    // Delete old PDF
                    if ($pdfFile && file_exists('../public/assets/pdf/publications/' . $pdfFile)) {
                        unlink('../public/assets/pdf/publications/' . $pdfFile);
                    }

                    $newFilename = 'publication_' . uniqid() . '.pdf';
                    $uploadPath = '../public/assets/pdf/publications/';
                    
                    if (!is_dir($uploadPath)) {
                        mkdir($uploadPath, 0755, true);
                    }

                    if (move_uploaded_file($fileTmp, $uploadPath . $newFilename)) {
                        $pdfFile = $newFilename;
                    }
                }
            }

            $publicationData = [
                'title' => $_POST['title'],
                'slug' => $slug,
                'authors' => $_POST['authors'],
                'abstract' => $_POST['abstract'],
                'publication_type' => $_POST['publication_type'],
                'journal_name' => $_POST['journal_name'] ?? null,
                'conference_name' => $_POST['conference_name'] ?? null,
                'publisher' => $_POST['publisher'] ?? null,
                'publication_date' => $_POST['publication_date'] ?? null,
                'volume' => $_POST['volume'] ?? null,
                'issue' => $_POST['issue'] ?? null,
                'pages' => $_POST['pages'] ?? null,
                'doi' => $_POST['doi'] ?? null,
                'isbn' => $_POST['isbn'] ?? null,
                'issn' => $_POST['issn'] ?? null,
                'url' => $_POST['url'] ?? null,
                'pdf_file' => $pdfFile,
                'keywords' => $_POST['keywords'] ?? null,
                'citation_count' => $_POST['citation_count'] ?? 0
            ];

            if ($this->publicationModel->update($id, $publicationData)) {
                $_SESSION['message'] = 'Publikasi berhasil diperbarui!';
                $this->redirect('admin/publications');
            } else {
                $_SESSION['error'] = 'Gagal memperbarui publikasi';
            }
        }

        $data = [
            'title' => 'Edit Publikasi - ' . APP_NAME,
            'publication' => $publication,
            'types' => $this->publicationModel->getTypes()
        ];

        $this->view('admin/publication_form', $data);
    }

    public function deletePublication($id)
    {
        $publication = $this->publicationModel->getById($id);

        if ($publication) {
            // Delete PDF file if exists
            if ($publication->pdf_file && file_exists('../public/assets/pdf/publications/' . $publication->pdf_file)) {
                unlink('../public/assets/pdf/publications/' . $publication->pdf_file);
            }

            if ($this->publicationModel->delete($id)) {
                $_SESSION['message'] = 'Publikasi berhasil dihapus!';
            } else {
                $_SESSION['error'] = 'Gagal menghapus publikasi';
            }
        } else {
            $_SESSION['error'] = 'Publikasi tidak ditemukan';
        }

        $this->redirect('admin/publications');
    }

    // ============ LAB PROFILE MANAGEMENT ============
    
    // Edit Lab Profile
    public function lab_profile()
    {
        $this->requireAdmin();
        $data = [
            'title' => 'Edit Profil Lab - ' . APP_NAME,
            'profile' => $this->labProfileModel->getProfile(),
            'team_members' => $this->labProfileModel->getTeamMembers()
        ];

        $this->view('admin/lab_profile', $data);
    }

    // Update Lab Profile
    public function lab_profile_update()
    {
        $this->requireAdmin();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Get current profile to get ID
            $profile = $this->labProfileModel->getProfile();
            
            if (!$profile) {
                $_SESSION['error'] = 'Profil lab tidak ditemukan';
                $this->redirect('admin/lab_profile');
                return;
            }
            
            // Convert mission array to JSON
            $missions = $_POST['mission'] ?? [];
            $missions = array_filter($missions); // Remove empty items
            
            $data = [
                'id' => $profile['id'],
                'description' => trim($_POST['description']),
                'vision' => trim($_POST['vision']),
                'mission' => json_encode(array_values($missions))
            ];

            // Handle thumbnail upload
            if (isset($_FILES['thumbnail']) && $_FILES['thumbnail']['error'] == 0) {
                $upload = $this->uploadFile($_FILES['thumbnail'], 'lab/');
                if ($upload['success']) {
                    // Delete old thumbnail if exists
                    if (!empty($profile['thumbnail']) && file_exists('../public/assets/img/lab/' . $profile['thumbnail'])) {
                        unlink('../public/assets/img/lab/' . $profile['thumbnail']);
                    }
                    // Extract just the filename without the 'lab/' prefix
                    $data['thumbnail'] = basename($upload['filename']);
                }
            }

            if ($this->labProfileModel->update($data)) {
                $_SESSION['success'] = 'Profil lab berhasil diupdate!';
            } else {
                $_SESSION['error'] = 'Gagal mengupdate profil lab';
            }
        }

        $this->redirect('admin/lab_profile');
    }

    // Add Team Member
    public function team_member_create()
    {
        $this->requireAdmin();
        $data = [
            'title' => 'Tambah Anggota Tim - ' . APP_NAME
        ];

        $this->view('admin/team_member_form', $data);
    }

    // Store Team Member
    public function team_member_store()
    {
        $this->requireAdmin();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Handle photo upload
            $photoPath = null;
            if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
                $upload = $this->uploadFile($_FILES['photo'], 'team/');
                if ($upload['success']) {
                    // Extract just the filename without the 'team/' prefix
                    $photoPath = basename($upload['filename']);
                }
            }

            $data = [
                'name' => trim($_POST['name']),
                'position' => trim($_POST['position']),
                'photo' => $photoPath,
                'is_head' => isset($_POST['is_head']),
                'display_order' => (int)$_POST['display_order']
            ];

            if ($this->labProfileModel->addTeamMember($data)) {
                $_SESSION['success'] = 'Anggota tim berhasil ditambahkan!';
                $this->redirect('admin/lab_profile');
            } else {
                $_SESSION['error'] = 'Gagal menambahkan anggota tim';
                $this->redirect('admin/team_member_create');
            }
        }
    }

    // Edit Team Member
    public function team_member_edit($id)
    {
        $this->requireAdmin();
        $data = [
            'title' => 'Edit Anggota Tim - ' . APP_NAME,
            'member' => $this->labProfileModel->getTeamMemberById($id)
        ];

        $this->view('admin/team_member_form', $data);
    }

    // Update Team Member
    public function team_member_update($id)
    {
        $this->requireAdmin();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $member = $this->labProfileModel->getTeamMemberById($id);
            
            // Handle photo upload
            $photoPath = $member['photo'];
            if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
                // Delete old photo
                if ($member['photo'] && file_exists('../public/assets/img/team/' . $member['photo'])) {
                    unlink('../public/assets/img/team/' . $member['photo']);
                }
                $upload = $this->uploadFile($_FILES['photo'], 'team/');
                if ($upload['success']) {
                    // Extract just the filename without the 'team/' prefix
                    $photoPath = basename($upload['filename']);
                }
            }

            $data = [
                'name' => trim($_POST['name']),
                'position' => trim($_POST['position']),
                'photo' => $photoPath,
                'is_head' => isset($_POST['is_head']),
                'display_order' => (int)$_POST['display_order']
            ];

            if ($this->labProfileModel->updateTeamMember($id, $data)) {
                $_SESSION['success'] = 'Anggota tim berhasil diupdate!';
            } else {
                $_SESSION['error'] = 'Gagal mengupdate anggota tim';
            }
        }

        $this->redirect('admin/lab_profile');
    }

    // Delete Team Member
    public function team_member_delete($id)
    {
        $this->requireAdmin();
        $member = $this->labProfileModel->getTeamMemberById($id);
        
        if ($member) {
            // Delete photo
            if ($member['photo'] && file_exists('../public/assets/img/' . $member['photo'])) {
                unlink('../public/assets/img/' . $member['photo']);
            }

            if ($this->labProfileModel->deleteTeamMember($id)) {
                $_SESSION['success'] = 'Anggota tim berhasil dihapus!';
            } else {
                $_SESSION['error'] = 'Gagal menghapus anggota tim';
            }
        }

        $this->redirect('admin/lab_profile');
    }
}
