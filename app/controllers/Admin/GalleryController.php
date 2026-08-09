<?php
namespace Admin;

use Controller;
use Gallery;

class GalleryController extends Controller {
    public function __construct() {
        parent::__construct();
        $this->requireAdmin();
    }

    public function index(): void {
        $galleryModel = new Gallery();
        $items = $galleryModel->findAll([], 'sort_order ASC');

        $this->view('admin/gallery/index', [
            'items' => $items,
            'pageTitle' => "Gallery - Admin Panel",
            'csrfToken' => $this->csrfToken(),
        ]);
    }

    public function store(): void {
        $galleryModel = new Gallery();
        $imagePath = null;

        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            $filename = 'gal_' . time() . '_' . rand(1000, 9999) . '.' . strtolower($ext);
            $uploadDir = __DIR__ . '/../../../public/uploads/gallery/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            move_uploaded_file($_FILES['image']['tmp_name'], $uploadDir . $filename);
            $imagePath = '/uploads/gallery/' . $filename;
        }

        if ($imagePath) {
            $galleryModel->create([
                'title' => $this->sanitizeInput($_POST['title'] ?? ''),
                'image' => $imagePath,
                'category' => $this->sanitizeInput($_POST['category'] ?? 'cakes'),
                'sort_order' => (int)($_POST['sort_order'] ?? 0),
                'is_active' => 1
            ]);
            $_SESSION['success'] = 'Gallery photo uploaded!';
        }

        $this->redirect('/admin/gallery');
    }

    public function delete(string $id): void {
        $galleryModel = new Gallery();
        $galleryModel->delete((int)$id);
        $_SESSION['success'] = 'Image deleted!';
        $this->redirect('/admin/gallery');
    }
}
