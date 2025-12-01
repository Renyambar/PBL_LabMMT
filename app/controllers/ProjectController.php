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
                'tags' => $_POST['tags'],
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
                'tags' => $_POST['tags'],
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

    // Submit comment
    public function comment($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Validate comment
            if (empty($_POST['comment']) || strlen(trim($_POST['comment'])) < 10) {
                $_SESSION['error'] = 'Comment must be at least 10 characters';
            } else {
                $data = [
                    'project_id' => $id,
                    'user_id' => $_SESSION['user_id'] ?? null,
                    'contributor_name' => $_POST['contributor_name'] ?? '',
                    'contributor_email' => $_POST['contributor_email'] ?? '',
                    'comment' => trim($_POST['comment']),
                    'is_approved' => false // Require admin approval
                ];

                if ($this->commentModel->create($data)) {
                    $_SESSION['message'] = 'Thank you for your comment! It will be published after approval.';
                } else {
                    $_SESSION['error'] = 'Failed to submit comment. Please try again.';
                }
            }
        }

        // Redirect back to project detail
        $project = $this->projectModel->getById($id);
        $this->redirect('project/detail/' . $project['slug']);
    }
}
