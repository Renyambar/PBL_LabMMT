<?php

class AdminController extends Controller
{
    private $projectModel;
    private $articleModel;
    private $galleryModel;
    private $partnerModel;
    private $userModel;

    public function __construct()
    {
        parent::__construct();
        $this->requireLogin();
        
        $this->projectModel = $this->model('Project');
        $this->articleModel = $this->model('Article');
        $this->galleryModel = $this->model('Gallery');
        $this->partnerModel = $this->model('Partner');
        $this->userModel = $this->model('User');
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
}
