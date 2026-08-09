<?php
/**
 * Shop Controller
 */

class ShopController extends Controller {
    public function index(): void {
        $productModel = new Product();
        $categoryModel = new Category();

        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $categoryId = isset($_GET['category']) ? (int)$_GET['category'] : null;
        $sort = $_GET['sort'] ?? 'latest';

        $repo = new ProductRepository();
        $productsData = $repo->getActiveProducts($page, 12, $categoryId, $sort);
        $categories = $categoryModel->findAll(['is_active' => 1], 'sort_order ASC');

        $this->view('customer/shop', [
            'products' => $productsData['items'],
            'pagination' => $productsData,
            'categories' => $categories,
            'currentCategory' => $categoryId,
            'currentSort' => $sort,
            'pageTitle' => "Shop Menu - {$this->config['app']['name']}",
        ]);
    }

    public function category(string $slug): void {
        $categoryModel = new Category();
        $category = $categoryModel->findBySlug($slug);

        if (!$category) {
            $this->redirect('/shop');
        }

        $_GET['category'] = $category['id'];
        $this->index();
    }
}
