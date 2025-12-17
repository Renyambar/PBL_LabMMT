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
        $labProfileModel = $this->model('LabProfile');
        $profile = $labProfileModel->getProfile();
        
        $data = [
            'title' => 'About - ' . APP_NAME,
            'profile' => $profile,
            'missions' => $profile ? json_decode($profile['mission'], true) : [],
            'team_members' => $labProfileModel->getTeamMembers()
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
