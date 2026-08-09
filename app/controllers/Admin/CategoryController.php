<?php
namespace Admin;

use Controller;
use Category;

class CategoryController extends Controller {
    public function __construct() {
        parent::__construct();
        $this->requireAdmin();
    }

    public function index(): void {
        $categoryModel = new Category();
        $categories = $categoryModel->findAll([], 'sort_order ASC');

        $this->view('admin/categories/index', [
            'categories' => $categories,
            'pageTitle' => "Categories - Admin Panel",
            'csrfToken' => $this->csrfToken(),
        ]);
    }

    public function store(): void {
        $categoryModel = new Category();
        $name = $this->sanitizeInput($_POST['name'] ?? '');
        $slug = $this->generateSlug($name);

        $categoryModel->create([
            'name' => $name,
            'slug' => $slug,
            'description' => $this->sanitizeInput($_POST['description'] ?? ''),
            'sort_order' => (int)($_POST['sort_order'] ?? 0),
            'is_active' => 1
        ]);

        $_SESSION['success'] = 'Category added successfully!';
        $this->redirect('/admin/categories');
    }

    public function update(string $id): void {
        $categoryModel = new Category();
        $categoryModel->update((int)$id, [
            'name' => $this->sanitizeInput($_POST['name'] ?? ''),
            'description' => $this->sanitizeInput($_POST['description'] ?? ''),
            'sort_order' => (int)($_POST['sort_order'] ?? 0)
        ]);

        $_SESSION['success'] = 'Category updated!';
        $this->redirect('/admin/categories');
    }

    public function delete(string $id): void {
        $categoryModel = new Category();
        $categoryModel->delete((int)$id);
        $_SESSION['success'] = 'Category deleted!';
        $this->redirect('/admin/categories');
    }
}
