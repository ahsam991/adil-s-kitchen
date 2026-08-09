<?php
namespace Admin;

use Controller;
use Blog;

class BlogController extends Controller {
    public function __construct() {
        parent::__construct();
        $this->requireAdmin();
    }

    public function index(): void {
        $blogModel = new Blog();
        $blogs = $blogModel->findAll([], 'published_at DESC');

        $this->view('admin/blogs/index', [
            'blogs' => $blogs,
            'pageTitle' => "Blogs - Admin Panel",
        ]);
    }

    public function create(): void {
        $this->view('admin/blogs/create', [
            'pageTitle' => "New Article - Admin Panel",
            'csrfToken' => $this->csrfToken(),
        ]);
    }

    public function store(): void {
        $blogModel = new Blog();
        $title = $this->sanitizeInput($_POST['title'] ?? '');
        $slug = $this->generateSlug($title);
        $imagePath = null;

        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            $filename = 'blog_' . time() . '_' . rand(1000, 9999) . '.' . strtolower($ext);
            $uploadDir = __DIR__ . '/../../../uploads/blog/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            move_uploaded_file($_FILES['image']['tmp_name'], $uploadDir . $filename);
            $imagePath = '/uploads/blog/' . $filename;
        }

        $blogModel->create([
            'title' => $title,
            'slug' => $slug,
            'content' => $this->sanitizeInput($_POST['content'] ?? ''),
            'image' => $imagePath,
            'status' => $_POST['status'] ?? 'published',
            'published_at' => date('Y-m-d H:i:s')
        ]);

        $_SESSION['success'] = 'Blog article published!';
        $this->redirect('/admin/blogs');
    }

    public function edit(string $id): void {
        $blogModel = new Blog();
        $blog = $blogModel->find((int)$id);

        $this->view('admin/blogs/edit', [
            'blog' => $blog,
            'pageTitle' => "Edit Article - Admin Panel",
            'csrfToken' => $this->csrfToken(),
        ]);
    }

    public function update(string $id): void {
        $blogModel = new Blog();
        $blogModel->update((int)$id, [
            'title' => $this->sanitizeInput($_POST['title'] ?? ''),
            'content' => $this->sanitizeInput($_POST['content'] ?? ''),
            'status' => $_POST['status'] ?? 'published'
        ]);

        $_SESSION['success'] = 'Article updated!';
        $this->redirect('/admin/blogs');
    }

    public function delete(string $id): void {
        $blogModel = new Blog();
        $blogModel->delete((int)$id);
        $_SESSION['success'] = 'Article deleted!';
        $this->redirect('/admin/blogs');
    }
}
