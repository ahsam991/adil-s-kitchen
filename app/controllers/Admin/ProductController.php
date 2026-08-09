<?php
namespace Admin;

use Controller;
use Product;
use Category;

class ProductController extends Controller {
    public function __construct() {
        parent::__construct();
        $this->requireAdmin();
    }

    public function index(): void {
        $productModel = new Product();
        $products = $this->db->fetchAll("SELECT p.*, c.name as category_name FROM products p LEFT JOIN categories c ON p.category_id = c.id WHERE p.deleted_at IS NULL ORDER BY p.created_at DESC");

        $this->view('admin/products/index', [
            'products' => $products,
            'pageTitle' => "Products - Admin Panel",
        ]);
    }

    public function create(): void {
        $categoryModel = new Category();
        $categories = $categoryModel->findAll(['is_active' => 1], 'sort_order ASC');

        $this->view('admin/products/create', [
            'categories' => $categories,
            'pageTitle' => "Add New Product - Admin Panel",
            'csrfToken' => $this->csrfToken(),
        ]);
    }

    public function store(): void {
        $productModel = new Product();
        $imagePath = null;

        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            $filename = 'prod_' . time() . '_' . rand(1000, 9999) . '.' . strtolower($ext);
            $uploadDir = __DIR__ . '/../../../uploads/products/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            move_uploaded_file($_FILES['image']['tmp_name'], $uploadDir . $filename);
            $imagePath = '/uploads/products/' . $filename;
        }

        $name = $this->sanitizeInput($_POST['name'] ?? '');
        $slug = $this->generateSlug($name);

        $productModel->create([
            'category_id' => (int)($_POST['category_id'] ?? 1),
            'name' => $name,
            'slug' => $slug,
            'sku' => $this->sanitizeInput($_POST['sku'] ?? 'SKU-' . rand(1000, 9999)),
            'short_description' => $this->sanitizeInput($_POST['short_description'] ?? ''),
            'description' => $this->sanitizeInput($_POST['description'] ?? ''),
            'price' => (float)($_POST['price'] ?? 0),
            'sale_price' => !empty($_POST['sale_price']) ? (float)$_POST['sale_price'] : null,
            'stock' => (int)($_POST['stock'] ?? 10),
            'weight' => $this->sanitizeInput($_POST['weight'] ?? '1 Kg'),
            'image' => $imagePath,
            'featured' => isset($_POST['featured']) ? 1 : 0,
            'best_seller' => isset($_POST['best_seller']) ? 1 : 0,
            'status' => $_POST['status'] ?? 'active'
        ]);

        $_SESSION['success'] = 'Product created successfully!';
        $this->redirect('/admin/products');
    }

    public function edit(string $id): void {
        $productModel = new Product();
        $product = $productModel->find((int)$id);
        if (!$product) {
            $this->redirect('/admin/products');
        }

        $categoryModel = new Category();
        $categories = $categoryModel->findAll(['is_active' => 1]);

        $this->view('admin/products/edit', [
            'product' => $product,
            'categories' => $categories,
            'pageTitle' => "Edit Product - Admin Panel",
            'csrfToken' => $this->csrfToken(),
        ]);
    }

    public function update(string $id): void {
        $productModel = new Product();
        $name = $this->sanitizeInput($_POST['name'] ?? '');

        $data = [
            'category_id' => (int)($_POST['category_id'] ?? 1),
            'name' => $name,
            'sku' => $this->sanitizeInput($_POST['sku'] ?? ''),
            'short_description' => $this->sanitizeInput($_POST['short_description'] ?? ''),
            'description' => $this->sanitizeInput($_POST['description'] ?? ''),
            'price' => (float)($_POST['price'] ?? 0),
            'sale_price' => !empty($_POST['sale_price']) ? (float)$_POST['sale_price'] : null,
            'stock' => (int)($_POST['stock'] ?? 0),
            'weight' => $this->sanitizeInput($_POST['weight'] ?? '1 Kg'),
            'featured' => isset($_POST['featured']) ? 1 : 0,
            'best_seller' => isset($_POST['best_seller']) ? 1 : 0,
            'status' => $_POST['status'] ?? 'active'
        ];

        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            $filename = 'prod_' . time() . '_' . rand(1000, 9999) . '.' . strtolower($ext);
            $uploadDir = __DIR__ . '/../../../uploads/products/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            move_uploaded_file($_FILES['image']['tmp_name'], $uploadDir . $filename);
            $data['image'] = '/uploads/products/' . $filename;
        }

        $productModel->update((int)$id, $data);
        $_SESSION['success'] = 'Product updated successfully!';
        $this->redirect('/admin/products');
    }

    public function delete(string $id): void {
        $productModel = new Product();
        $productModel->delete((int)$id);
        $_SESSION['success'] = 'Product deleted!';
        $this->redirect('/admin/products');
    }
}
