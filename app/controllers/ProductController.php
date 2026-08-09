<?php
/**
 * Product Controller
 */

class ProductController extends Controller {
    public function show(string $slug): void {
        $productModel = new Product();
        $reviewModel = new Review();

        $product = $productModel->findBySlug($slug);
        if (!$product) {
            $this->redirect('/shop');
        }

        $relatedProducts = $productModel->getRelated($product['category_id'], $product['id']);
        $reviews = $reviewModel->getProductReviews($product['id']);

        $this->view('customer/product-details', [
            'product' => $product,
            'relatedProducts' => $relatedProducts,
            'reviews' => $reviews,
            'pageTitle' => "{$product['name']} - {$this->config['app']['name']}",
        ]);
    }
}
