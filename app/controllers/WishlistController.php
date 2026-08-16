<?php
/**
 * Wishlist Controller
 */

class WishlistController extends Controller {
    public function index(): void {
        $this->requireAuth();
        $wishlistModel = new Wishlist();
        $items = $wishlistModel->getCustomerWishlist($_SESSION['user_id']);

        $this->view('customer/wishlist', [
            'items' => $items,
            'pageTitle' => "My Wishlist - {$this->config['app']['name']}",
        ]);
    }

    public function add(): void {
        if (!$this->isAuthenticated()) {
            $this->jsonResponse(['success' => false, 'message' => 'Please login to save items.'], 401);
        }

        $productId = (int)($_POST['product_id'] ?? 0);
        $wishlistModel = new Wishlist();
        try {
            $wishlistModel->create(['customer_id' => $_SESSION['user_id'], 'product_id' => $productId]);
            $this->jsonResponse(['success' => true, 'message' => 'Added to wishlist!']);
        } catch (Exception $e) {
            $this->jsonResponse(['success' => true, 'message' => 'Already in wishlist']);
        }
    }

    public function remove(): void {
        $this->requireAuth();
        $productId = (int)($_POST['product_id'] ?? 0);
        $wishlistModel = new Wishlist();
        $this->db->delete('wishlists', "customer_id = :cid AND product_id = :pid", ['cid' => $_SESSION['user_id'], 'pid' => $productId]);
        $this->redirect('/wishlist');
    }
}
