<?php
/**
 * Cart Model
 */

class Cart extends Model {
    protected $table = 'carts';
    protected $fillable = ['customer_id', 'session_id', 'is_active'];

    public function getOrCreateCart(string $sessionId, ?int $customerId = null): array {
        $sql = "SELECT * FROM carts WHERE session_id = :session_id AND deleted_at IS NULL LIMIT 1";
        $cart = $this->db->fetchOne($sql, ['session_id' => $sessionId]);

        if (!$cart) {
            $id = $this->create([
                'session_id' => $sessionId,
                'customer_id' => $customerId,
            ]);
            $cart = $this->find($id);
        }

        return $cart;
    }

    public function getCartItems(int $cartId): array {
        $sql = "SELECT ci.*, p.name as product_name, p.slug as product_slug, p.image as product_image, p.price as product_price, p.sale_price
                FROM cart_items ci
                JOIN products p ON ci.product_id = p.id
                WHERE ci.cart_id = :cart_id AND ci.deleted_at IS NULL";
        return $this->db->fetchAll($sql, ['cart_id' => $cartId]);
    }
}
