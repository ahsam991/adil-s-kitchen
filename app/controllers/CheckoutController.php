<?php
/**
 * Checkout Controller
 */

class CheckoutController extends Controller {
    public function index(): void {
        $cartModel = new Cart();
        $sessionId = session_id();
        $cart = $cartModel->getOrCreateCart($sessionId, $_SESSION['user_id'] ?? null);
        $items = $cartModel->getCartItems($cart['id']);

        if (empty($items)) {
            $this->redirect('/cart');
        }

        $cartService = new CartService();
        $subtotal = $cartService->getCartTotal($items);
        $deliveryCharge = $subtotal >= 1500 ? 0.00 : 60.00;
        $total = $subtotal + $deliveryCharge;

        $this->view('customer/checkout', [
            'cart' => $cart,
            'items' => $items,
            'subtotal' => $subtotal,
            'deliveryCharge' => $deliveryCharge,
            'total' => $total,
            'pageTitle' => "Checkout - {$this->config['app']['name']}",
            'csrfToken' => $this->csrfToken(),
        ]);
    }

    public function process(): void {
        if (!$this->validateCsrfToken($_POST['_csrf_token'] ?? null)) {
            $_SESSION['error'] = 'Invalid request. Please try again.';
            $this->redirect('/checkout');
        }

        $cartModel = new Cart();
        $sessionId = session_id();
        $cart = $cartModel->getOrCreateCart($sessionId, $_SESSION['user_id'] ?? null);
        $items = $cartModel->getCartItems($cart['id']);

        if (empty($items)) {
            $this->redirect('/shop');
        }

        $cartService = new CartService();
        $subtotal = $cartService->getCartTotal($items);
        $deliveryCharge = $subtotal >= 1500 ? 0.00 : 60.00;
        $total = $subtotal + $deliveryCharge;

        $orderRepo = new OrderRepository();
        $orderNumber = $orderRepo->generateOrderNumber();

        $orderModel = new Order();
        $orderId = $orderModel->create([
            'order_number' => $orderNumber,
            'customer_id' => $_SESSION['user_id'] ?? null,
            'customer_name' => $this->sanitizeInput(($_POST['first_name'] ?? '') . ' ' . ($_POST['last_name'] ?? '')),
            'customer_email' => filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL),
            'customer_phone' => $this->sanitizeInput($_POST['phone'] ?? ''),
            'shipping_address' => $this->sanitizeInput($_POST['address'] ?? '') . ', ' . $this->sanitizeInput($_POST['city'] ?? ''),
            'subtotal' => $subtotal,
            'delivery_charge' => $deliveryCharge,
            'discount_amount' => 0.00,
            'total_amount' => $total,
            'payment_method' => $_POST['payment_method'] ?? 'cod',
            'payment_status' => 'pending',
            'order_status' => 'pending',
            'notes' => $this->sanitizeInput($_POST['order_notes'] ?? '')
        ]);

        foreach ($items as $item) {
            $effectivePrice = !empty($item['sale_price']) && $item['sale_price'] > 0 ? $item['sale_price'] : $item['price'];
            $this->db->insert('order_items', [
                'order_id' => $orderId,
                'product_id' => $item['product_id'],
                'product_name' => $item['product_name'],
                'quantity' => $item['quantity'],
                'price' => $effectivePrice,
                'total' => $effectivePrice * $item['quantity'],
                'options' => $item['options']
            ]);
        }

        // Clear cart
        $this->db->delete('cart_items', "cart_id = :cid", ['cid' => $cart['id']]);

        $_SESSION['last_order'] = $orderNumber;
        $this->redirect("/order-tracking?order={$orderNumber}");
    }
}
