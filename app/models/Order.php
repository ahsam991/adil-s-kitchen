<?php
/**
 * Order Model
 */

class Order extends Model {
    protected $table = 'orders';
    protected $fillable = [
        'order_number', 'customer_id', 'customer_name', 'customer_email', 'customer_phone',
        'shipping_address', 'subtotal', 'delivery_charge', 'discount_amount', 'total_amount',
        'payment_method', 'payment_status', 'transaction_id', 'order_status', 'notes', 'is_active'
    ];

    public function findByOrderNumber(string $orderNumber): ?array {
        return $this->firstWhere('order_number', $orderNumber);
    }

    public function getItems(int $orderId): array {
        $sql = "SELECT * FROM order_items WHERE order_id = :order_id AND deleted_at IS NULL";
        return $this->db->fetchAll($sql, ['order_id' => $orderId]);
    }
}
