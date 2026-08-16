<?php
namespace Admin;

use Controller;
use Customer;

class CustomerController extends Controller {
    public function __construct() {
        parent::__construct();
        $this->requireAdmin();
    }

    public function index(): void {
        $customerModel = new Customer();
        $customers = $customerModel->findAll([], 'created_at DESC');

        $this->view('admin/customers/index', [
            'customers' => $customers,
            'pageTitle' => "Customers - Admin Panel",
        ]);
    }

    public function show(string $id): void {
        $customerModel = new Customer();
        $customer = $customerModel->find((int)$id);
        if (!$customer) {
            $this->redirect('/admin/customers');
        }

        $orders = $this->db->fetchAll("SELECT * FROM orders WHERE customer_id = :id AND deleted_at IS NULL ORDER BY created_at DESC", ['id' => $id]);

        $this->view('admin/customers/show', [
            'customer' => $customer,
            'orders' => $orders,
            'pageTitle' => "Customer Profile - Admin Panel",
        ]);
    }
}
