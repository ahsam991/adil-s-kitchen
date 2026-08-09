<?php
/**
 * Order Service
 */

class OrderService {
    private Order $orderModel;

    public function __construct() {
        $this->orderModel = new Order();
    }
}
