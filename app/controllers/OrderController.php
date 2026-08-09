<?php
/**
 * Order Controller
 */

class OrderController extends Controller {
    public function tracking(): void {
        $orderNumber = $_GET['order'] ?? null;
        $order = null;
        $items = [];

        if ($orderNumber) {
            $orderModel = new Order();
            $order = $orderModel->findByOrderNumber($orderNumber);
            if ($order) {
                $items = $orderModel->getItems($order['id']);
            }
        }

        $this->view('customer/order-tracking', [
            'order' => $order,
            'items' => $items,
            'searchOrder' => $orderNumber,
            'pageTitle' => "Order Tracking - {$this->config['app']['name']}",
        ]);
    }
}
