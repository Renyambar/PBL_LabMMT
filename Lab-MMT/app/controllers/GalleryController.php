<?php

class GalleryController extends Controller
{
    private $galleryModel;

    public function __construct()
    {
        parent::__construct();
        $this->galleryModel = $this->model('Gallery');
    }

    // Display all galleries
    public function index()
    {
        $type = $_GET['type'] ?? null;

        if ($type) {
            $galleries = $this->galleryModel->getByType($type);
        } else {
            $galleries = $this->galleryModel->getAll();
        }

        $data = [
            'title' => 'Gallery - ' . APP_NAME,
            'galleries' => $galleries,
            'current_type' => $type
        ];

        $this->view('gallery/index', $data);
    }
}
