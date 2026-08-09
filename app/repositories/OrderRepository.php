<?php
/**
 * Order Repository
 */

class OrderRepository {
    private Order $orderModel;

    public function __construct() {
        $this->orderModel = new Order();
    }

    public function generateOrderNumber(): string {
        return 'ASK-' . date('Ymd') . '-' . rand(1000, 9999);
    }
}
