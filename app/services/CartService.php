<?php
/**
 * Cart Service
 */

class CartService {
    private $cartModel;

    public function __construct() {
        $this->cartModel = new Cart();
    }

    public function getCartTotal(array $items): float {
        $total = 0.00;
        foreach ($items as $item) {
            $effectivePrice = !empty($item['sale_price']) && $item['sale_price'] > 0 ? $item['sale_price'] : $item['price'];
            $total += $effectivePrice * $item['quantity'];
        }
        return $total;
    }
}
