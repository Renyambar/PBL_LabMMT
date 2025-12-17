<?php

class ProjectController extends Controller
{
    private $projectModel;
    private $ratingModel;
    private $commentModel;

    public function __construct()
    {
        parent::__construct();
        $this->projectModel = $this->model('Project');
        $this->ratingModel = $this->model('ProjectRating');
        $this->commentModel = $this->model('ProjectComment');
    }

    // Display all projects
    public function index()
    {
        $category = $_GET['category'] ?? null;
        $search = $_GET['search'] ?? null;

        if ($search) {
            $projects = $this->projectModel->search($search);
        } elseif ($category) {
            $projects = $this->projectModel->getByCategory($category);
        } else {
            $projects = $this->projectModel->getAll();
        }

        $data = [
            'title' => 'Projects - ' . APP_NAME,
            'projects' => $projects,
            'categories' => $this->projectModel->getCategories(),
            'current_category' => $category,
            'search' => $search
        ];

        $this->view('project/index', $data);
    }

    // Display project detail
    public function detail($slug)
    {
        $project = $this->projectModel->getBySlug($slug);

        if (!$project) {
            $this->redirect('project');
            return;
        }

        // Get ratings and comments
        $ratings = $this->ratingModel->getByProject($project['id']);
        $comments = $this->commentModel->getByProject($project['id'], true);
        $rating_stats = $this->ratingModel->getStatistics($project['id']);
        
        $data = [
            'title' => $project['title'] . ' - ' . APP_NAME,
            'project' => $project,
            'ratings' => $ratings,
            'comments' => $comments,
            'rating_stats' => $rating_stats,
            'avg_rating' => $rating_stats['avg_rating'] ?? 0,
            'total_ratings' => $rating_stats['total_ratings'] ?? 0,
            'total_comments' => $this->commentModel->getCommentCount($project['id'])
        ];

        $this->view('project/detail', $data);
    }

    // Show create form (admin only)
    public function create()
    {
        $this->requireLogin();
        $this->requireAdmin();

        $data = [
            'title' => 'Create Project - ' . APP_NAME
        ];

        $this->view('project/create', $data);
    }

    // Store new project
    public function store()
    {
        $this->requireLogin();
        $this->requireAdmin();

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

            // Handle file upload
            if (isset($_FILES['thumbnail']) && $_FILES['thumbnail']['error'] == 0) {
                $upload = $this->uploadFile($_FILES['thumbnail'], 'projects/');
                if ($upload['success']) {
                    $data['thumbnail'] = $upload['filename'];
                }
            }

            if ($this->projectModel->create($data)) {
                $_SESSION['message'] = 'Project created successfully!';
                $this->redirect('admin/projects');
            } else {
                $_SESSION['error'] = 'Failed to create project';
                $this->redirect('project/create');
            }
        }
    }

    // Show edit form
    public function edit($id)
    {
        $this->requireLogin();
        $this->requireAdmin();

        $project = $this->projectModel->getById($id);

        if (!$project) {
            $this->redirect('admin/projects');
            return;
        }

        $data = [
            'title' => 'Edit Project - ' . APP_NAME,
            'project' => $project
        ];

        $this->view('project/edit', $data);
    }

    // Update project
    public function update($id)
    {
        $this->requireLogin();
        $this->requireAdmin();

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

            // Handle file upload
            if (isset($_FILES['thumbnail']) && $_FILES['thumbnail']['error'] == 0) {
                $upload = $this->uploadFile($_FILES['thumbnail'], 'projects/');
                if ($upload['success']) {
                    $data['thumbnail'] = $upload['filename'];
                }
            }

            if ($this->projectModel->update($id, $data)) {
                $_SESSION['message'] = 'Project updated successfully!';
                $this->redirect('admin/projects');
            } else {
                $_SESSION['error'] = 'Failed to update project';
                $this->redirect('project/edit/' . $id);
            }
        }
    }

    // Delete project
    public function delete($id)
    {
        $this->requireLogin();
        $this->requireAdmin();

        if ($this->projectModel->delete($id)) {
            $_SESSION['message'] = 'Project deleted successfully!';
        } else {
            $_SESSION['error'] = 'Failed to delete project';
        }

        $this->redirect('admin/projects');
    }

    // Submit rating
    public function rate($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Validate rating
            if (empty($_POST['rating']) || $_POST['rating'] < 1 || $_POST['rating'] > 5) {
                $_SESSION['error'] = 'Please select a rating between 1-5 stars';
            } else {
                $data = [
                    'project_id' => $id,
                    'user_id' => $_SESSION['user_id'] ?? null,
                    'contributor_name' => $_POST['contributor_name'] ?? '',
                    'contributor_email' => $_POST['contributor_email'] ?? '',
                    'rating' => (int)$_POST['rating']
                ];

                if ($this->ratingModel->create($data)) {
                    $_SESSION['message'] = 'Thank you for your rating!';
                } else {
                    $_SESSION['error'] = 'Failed to submit rating. Please try again.';
                }
            }
        }

        // Redirect back to project detail
        $project = $this->projectModel->getById($id);
        $this->redirect('project/detail/' . $project['slug']);
    }

    // Submit comment - Public can comment
    public function comment($id)
    {
        // Debug: Log that method was called
        error_log("Comment method called with ID: " . $id);
        error_log("POST data: " . print_r($_POST, true));
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Validate comment
            if (empty($_POST['comment']) || strlen(trim($_POST['comment'])) < 10) {
                $_SESSION['error'] = 'Komentar harus minimal 10 karakter';
                error_log("Validation failed: comment too short");
            } else {
                // Set contributor name (default to Anonim if empty)
                $contributorName = !empty(trim($_POST['contributor_name'])) ? trim($_POST['contributor_name']) : 'Anonim';
                $contributorEmail = !empty(trim($_POST['contributor_email'])) ? trim($_POST['contributor_email']) : null;
                
                $data = [
                    'project_id' => (int)$id,
                    'user_id' => $_SESSION['user_id'] ?? null,
                    'contributor_name' => $contributorName,
                    'contributor_email' => $contributorEmail,
                    'comment' => trim($_POST['comment']),
                    'is_approved' => false // Require admin approval
                ];

                error_log("Attempting to create comment: " . print_r($data, true));

                try {
                    $result = $this->commentModel->create($data);
                    error_log("Create result: " . ($result ? 'SUCCESS' : 'FAILED'));
                    
                    if ($result) {
                        $_SESSION['message'] = 'Terima kasih atas komentar Anda! Komentar akan ditampilkan setelah disetujui admin.';
                    } else {
                        $_SESSION['error'] = 'Gagal mengirim komentar. Silakan coba lagi.';
                    }
                } catch (Exception $e) {
                    $_SESSION['error'] = 'Error: ' . $e->getMessage();
                    error_log("Comment error: " . $e->getMessage());
                }
            }
        } else {
            error_log("Not POST request, method: " . $_SERVER['REQUEST_METHOD']);
        }

        // Redirect back to project detail
        $project = $this->projectModel->getById($id);
        error_log("Redirecting to: project/detail/" . $project['slug']);
        $this->redirect('project/detail/' . $project['slug']);
    }
}
