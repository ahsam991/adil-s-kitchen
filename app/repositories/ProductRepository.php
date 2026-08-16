<?php
/**
 * Product Repository
 */

class ProductRepository {
    private $productModel;

    public function __construct() {
        $this->productModel = new Product();
    }

    public function getActiveProducts(int $page = 1, int $perPage = 12, ?int $categoryId = null, ?string $sort = 'latest'): array {
        $conditions = ['status' => 'active'];
        if ($categoryId) {
            $conditions['category_id'] = $categoryId;
        }

        $orderBy = 'created_at DESC';
        if ($sort === 'price_low') {
            $orderBy = 'price ASC';
        } elseif ($sort === 'price_high') {
            $orderBy = 'price DESC';
        } elseif ($sort === 'popular') {
            $orderBy = 'best_seller DESC, created_at DESC';
        }

        return $this->productModel->paginate($page, $perPage, $conditions, $orderBy);
    }
}
