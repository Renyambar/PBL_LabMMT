<?php

class PublicationController extends Controller
{
    private $publicationModel;

    public function __construct()
    {
        parent::__construct();
        $this->publicationModel = $this->model('Publication');
    }

    // Public: List all publications
    public function index()
    {
        $keyword = $_GET['search'] ?? '';
        $type = $_GET['type'] ?? '';

        if ($keyword) {
            $publications = $this->publicationModel->search($keyword);
        } elseif ($type) {
            $publications = $this->publicationModel->getByType($type);
        } else {
            $publications = $this->publicationModel->getAll();
        }

        $data = [
            'title' => 'Publikasi Ilmiah - ' . APP_NAME,
            'publications' => $publications,
            'keyword' => $keyword,
            'selected_type' => $type,
            'types' => $this->publicationModel->getTypes()
        ];

        $this->view('publication/index', $data);
    }

    // Public: Show publication detail
    public function detail($slug)
    {
        $publication = $this->publicationModel->getBySlug($slug);

        if (!$publication) {
            header('Location: ' . BASE_URL . '/article');
            exit;
        }

        $data = [
            'title' => $publication['title'] . ' - ' . APP_NAME,
            'publication' => $publication
        ];

        $this->view('publication/detail', $data);
    }
}
