<?php

class HomeController extends Controller
{
    public function index()
    {
        $projectModel = $this->model('Project');
        $articleModel = $this->model('Article');
        $partnerModel = $this->model('Partner');

        $data = [
            'title' => 'Home - ' . APP_NAME,
            'featured_projects' => $projectModel->getFeatured(6),
            'recent_articles' => $articleModel->getRecent(3),
            'partners' => $partnerModel->getAll()
        ];

        $this->view('home/index', $data);
    }

    public function about()
    {
        $data = [
            'title' => 'About - ' . APP_NAME
        ];

        $this->view('home/about', $data);
    }

    public function contact()
    {
        $data = [
            'title' => 'Contact - ' . APP_NAME
        ];

        $this->view('home/contact', $data);
    }
}
