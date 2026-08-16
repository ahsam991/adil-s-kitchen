<?php
namespace Admin;

use Controller;
use Order;

class OrderController extends Controller {
    public function __construct() {
        parent::__construct();
        $this->requireAdmin();
    }

    public function index(): void {
        $orderModel = new Order();
        $orders = $orderModel->findAll([], 'created_at DESC');

        $this->view('admin/orders/index', [
            'orders' => $orders,
            'pageTitle' => "Orders Management - Admin Panel",
        ]);
    }

    public function show(string $id): void {
        $orderModel = new Order();
        $order = $orderModel->find((int)$id);
        if (!$order) {
            $this->redirect('/admin/orders');
        }

        $items = $orderModel->getItems($order['id']);

        $this->view('admin/orders/show', [
            'order' => $order,
            'items' => $items,
            'pageTitle' => "Order #{$order['order_number']} - Admin Panel",
            'csrfToken' => $this->csrfToken(),
        ]);
    }

    public function updateStatus(string $id): void {
        $status = $_POST['order_status'] ?? 'pending';
        $paymentStatus = $_POST['payment_status'] ?? 'pending';

        $orderModel = new Order();
        $orderModel->update((int)$id, [
            'order_status' => $status,
            'payment_status' => $paymentStatus,
        ]);

        $_SESSION['success'] = 'Order status updated successfully!';
        $this->redirect("/admin/orders/{$id}");
    }

    public function invoice(string $id): void {
        $orderModel = new Order();
        $order = $orderModel->find((int)$id);
        if (!$order) {
            $this->redirect('/admin/orders');
        }
        $items = $orderModel->getItems($order['id']);

        $this->view('admin/orders/invoice', [
            'order' => $order,
            'items' => $items,
            'pageTitle' => "Invoice #{$order['order_number']}",
        ]);
    }

    public function cancel(string $id): void {
        $orderModel = new Order();
        $orderModel->update((int)$id, ['order_status' => 'cancelled']);
        $_SESSION['success'] = 'Order cancelled.';
        $this->redirect('/admin/orders');
    }
}
