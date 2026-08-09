<?php
/**
 * Review Model
 */

class Review extends Model {
    protected $table = 'reviews';
    protected $fillable = ['product_id', 'customer_name', 'customer_email', 'rating', 'comment', 'admin_reply', 'status', 'is_active'];

    public function getProductReviews(int $productId): array {
        $sql = "SELECT * FROM reviews WHERE product_id = :product_id AND status = 'approved' AND deleted_at IS NULL ORDER BY created_at DESC";
        return $this->db->fetchAll($sql, ['product_id' => $productId]);
    }
}
