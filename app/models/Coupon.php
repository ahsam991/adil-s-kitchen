<?php
/**
 * Coupon Model
 */

class Coupon extends Model {
    protected $table = 'coupons';
    protected $fillable = ['code', 'type', 'value', 'min_purchase', 'expiry_date', 'usage_limit', 'used_count', 'is_active'];

    public function findValidCoupon(string $code): ?array {
        $sql = "SELECT * FROM coupons
                WHERE code = :code AND is_active = 1 AND deleted_at IS NULL
                AND expiry_date >= CURDATE() AND used_count < usage_limit LIMIT 1";
        return $this->db->fetchOne($sql, ['code' => strtoupper($code)]);
    }
}
