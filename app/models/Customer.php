<?php
/**
 * Customer Model
 */

class Customer extends Model {
    protected $table = 'customers';
    protected $fillable = ['user_id', 'first_name', 'last_name', 'email', 'phone', 'total_orders', 'total_spent', 'notes', 'is_active'];

    public function getAddresses(int $customerId): array {
        $sql = "SELECT * FROM addresses WHERE customer_id = :customer_id AND deleted_at IS NULL ORDER BY is_default DESC";
        return $this->db->fetchAll($sql, ['customer_id' => $customerId]);
    }
}
