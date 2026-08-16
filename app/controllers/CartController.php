<?php
/**
 * Cart Controller
 */

class CartController extends Controller {
    public function index(): void {
        $cartModel = new Cart();
        $sessionId = session_id();
        $cart = $cartModel->getOrCreateCart($sessionId, $_SESSION['user_id'] ?? null);
        $items = $cartModel->getCartItems($cart['id']);

        $cartService = new CartService();
        $subtotal = $cartService->getCartTotal($items);

        $coupon = $_SESSION['coupon'] ?? null;
        $discount = 0.00;
        if ($coupon) {
            $discount = $coupon['type'] === 'percentage' ? ($subtotal * ($coupon['value'] / 100)) : $coupon['value'];
        }

        $deliveryCharge = $subtotal >= 1500 ? 0.00 : 60.00;
        $total = max(0, $subtotal - $discount + $deliveryCharge);

        $this->view('customer/cart', [
            'cart' => $cart,
            'items' => $items,
            'subtotal' => $subtotal,
            'discount' => $discount,
            'deliveryCharge' => $deliveryCharge,
            'total' => $total,
            'coupon' => $coupon,
            'pageTitle' => "Shopping Cart - {$this->config['app']['name']}",
        ]);
    }

    public function add(): void {
        $productId = (int)($_POST['product_id'] ?? 0);
        $quantity = max(1, (int)($_POST['quantity'] ?? 1));
        $weight = $_POST['weight'] ?? null;
        $flavor = $_POST['flavor'] ?? null;

        $productModel = new Product();
        $product = $productModel->find($productId);
        if (!$product) {
            $this->jsonResponse(['success' => false, 'message' => 'Product not found.'], 404);
        }

        $cartModel = new Cart();
        $sessionId = session_id();
        $cart = $cartModel->getOrCreateCart($sessionId, $_SESSION['user_id'] ?? null);

        $options = json_encode(['weight' => $weight, 'flavor' => $flavor]);
        $effectivePrice = !empty($product['sale_price']) && $product['sale_price'] > 0 ? $product['sale_price'] : $product['price'];

        $existing = $this->db->fetchOne("SELECT * FROM cart_items WHERE cart_id = :cart_id AND product_id = :product_id AND deleted_at IS NULL LIMIT 1", [
            'cart_id' => $cart['id'],
            'product_id' => $productId
        ]);

        if ($existing) {
            $newQty = $existing['quantity'] + $quantity;
            $this->db->update('cart_items', ['quantity' => $newQty], "id = :id", ['id' => $existing['id']]);
        } else {
            $this->db->insert('cart_items', [
                'cart_id' => $cart['id'],
                'product_id' => $productId,
                'quantity' => $quantity,
                'price' => $effectivePrice,
                'options' => $options
            ]);
        }

        $count = (int)$this->db->fetchOne("SELECT SUM(quantity) as cnt FROM cart_items WHERE cart_id = :cart_id AND deleted_at IS NULL", ['cart_id' => $cart['id']])['cnt'];

        $this->jsonResponse(['success' => true, 'message' => 'Product added to cart!', 'cart_count' => $count]);
    }

    public function update(): void {
        $cartItemId = (int)($_POST['cart_item_id'] ?? 0);
        $quantity = max(1, (int)($_POST['quantity'] ?? 1));
        $this->db->update('cart_items', ['quantity' => $quantity], "id = :id", ['id' => $cartItemId]);
        $this->jsonResponse(['success' => true]);
    }

    public function remove(): void {
        $cartItemId = (int)($_POST['cart_item_id'] ?? 0);
        $this->db->softDelete('cart_items', (string)$cartItemId);
        $this->redirect('/cart');
    }

    public function count(): void {
        $cartModel = new Cart();
        $sessionId = session_id();
        $cart = $cartModel->getOrCreateCart($sessionId, $_SESSION['user_id'] ?? null);
        $count = (int)$this->db->fetchOne("SELECT SUM(quantity) as cnt FROM cart_items WHERE cart_id = :cart_id AND deleted_at IS NULL", ['cart_id' => $cart['id']])['cnt'];
        $this->jsonResponse(['success' => true, 'cart_count' => $count]);
    }
}
