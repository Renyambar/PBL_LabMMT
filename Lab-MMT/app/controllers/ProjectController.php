<?php

class ProjectController extends Controller
{
    private $projectModel;

    public function __construct()
    {
        parent::__construct();
        $this->projectModel = $this->model('Project');
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

        $data = [
            'title' => $project['title'] . ' - ' . APP_NAME,
            'project' => $project
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
}
