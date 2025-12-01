<?php

class AdminController extends Controller
{
    private $projectModel;
    private $articleModel;
    private $galleryModel;
    private $partnerModel;
    private $userModel;
    private $commentModel;

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
        $data = [
            'title' => 'Manage Articles - ' . APP_NAME,
            'articles' => $this->articleModel->getAll()
        ];

        $this->view('admin/articles', $data);
    }

    // Manage Gallery
    public function gallery()
    {
        $data = [
            'title' => 'Manage Gallery - ' . APP_NAME,
            'galleries' => $this->galleryModel->getAll()
        ];

        $this->view('admin/gallery', $data);
    }

    // Manage Partners
    public function partners()
    {
        $data = [
            'title' => 'Manage Partners - ' . APP_NAME,
            'partners' => $this->partnerModel->getAll()
        ];

        $this->view('admin/partners', $data);
    }

    // Manage Users (admin only)
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
                'full_description' => $_POST['full_description'] ?? null,
                'category' => $_POST['category'],
                'technologies' => $_POST['technologies'],
                'project_url' => $_POST['project_url'] ?? null,
                'github_url' => $_POST['github_url'] ?? null,
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
                'full_description' => $_POST['full_description'] ?? null,
                'category' => $_POST['category'],
                'technologies' => $_POST['technologies'],
                'project_url' => $_POST['project_url'] ?? null,
                'github_url' => $_POST['github_url'] ?? null,
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
                $_SESSION['error'] = 'Passwords do not match';
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
                $_SESSION['message'] = 'User created successfully!';
            } else {
                $_SESSION['error'] = 'Failed to create user';
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
        $data = ['title' => 'Add Partner - ' . APP_NAME];
        $this->view('admin/partner_form', $data);
    }

    public function partners_store()
    {
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
            $_SESSION['message'] = 'Comment approved successfully!';
        } else {
            $_SESSION['error'] = 'Failed to approve comment';
        }
        $this->redirect('admin/comments');
    }

    public function comments_unapprove($id)
    {
        if ($this->commentModel->unapprove($id)) {
            $_SESSION['message'] = 'Comment unapproved!';
        } else {
            $_SESSION['error'] = 'Failed to unapprove comment';
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
}
