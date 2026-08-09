<?php
/**
 * Wishlist Model
 */

class Wishlist extends Model {
    protected $table = 'wishlists';
    protected $fillable = ['customer_id', 'product_id', 'is_active'];

    public function getCustomerWishlist(int $customerId): array {
        $sql = "SELECT w.*, p.name as product_name, p.slug as product_slug, p.price, p.sale_price, p.image, p.status
                FROM wishlists w
                JOIN products p ON w.product_id = p.id
                WHERE w.customer_id = :customer_id AND w.deleted_at IS NULL AND p.deleted_at IS NULL";
        return $this->db->fetchAll($sql, ['customer_id' => $customerId]);
    }
}
