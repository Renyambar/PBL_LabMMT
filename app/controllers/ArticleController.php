<?php

class ArticleController extends Controller
{
    private $articleModel;
    private $publicationModel;

    public function __construct()
    {
        parent::__construct();
        $this->articleModel = $this->model('Article');
        $this->publicationModel = $this->model('Publication');
    }

    // Display all articles
    public function index()
    {
        $search = $_GET['search'] ?? null;

        if ($search) {
            $articles = $this->articleModel->search($search);
        } else {
            $articles = $this->articleModel->getAll();
        }

        // Get all publications
        $publications = $this->publicationModel->getAll();

        $data = [
            'title' => 'Artikel & Publikasi Ilmiah - ' . APP_NAME,
            'articles' => $articles,
            'publications' => $publications,
            'search' => $search
        ];

        $this->view('article/index', $data);
    }

    // Display article detail
    public function detail($slug)
    {
        $article = $this->articleModel->getBySlug($slug);

        if (!$article) {
            $this->redirect('article');
            return;
        }

        $data = [
            'title' => $article['title'] . ' - ' . APP_NAME,
            'article' => $article,
            'recent_articles' => $this->articleModel->getRecent(5)
        ];

        $this->view('article/detail', $data);
    }
}
