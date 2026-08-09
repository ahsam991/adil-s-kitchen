<?php
/**
 * Order Service
 */

class OrderService {
    private $orderModel;

    public function __construct() {
        $this->orderModel = new Order();
    }
}
