<?php
namespace Admin;

use Controller;

class ReportController extends Controller {
    public function __construct() {
        parent::__construct();
        $this->requireAdmin();
    }

    public function index(): void {
        $dailySales = $this->db->fetchAll("SELECT DATE(created_at) as sale_date, COUNT(*) as total_orders, SUM(total_amount) as total_revenue FROM orders WHERE deleted_at IS NULL GROUP BY DATE(created_at) ORDER BY sale_date DESC LIMIT 30");

        $this->view('admin/reports/index', [
            'dailySales' => $dailySales,
            'pageTitle' => "Sales & Analytics Reports - Admin Panel",
        ]);
    }

    public function sales(): void {
        $this->index();
    }

    public function products(): void {
        $topProducts = $this->db->fetchAll("SELECT p.name, COUNT(oi.id) as total_sold, SUM(oi.total) as total_revenue FROM order_items oi JOIN products p ON oi.product_id = p.id GROUP BY oi.product_id ORDER BY total_sold DESC LIMIT 20");

        $this->view('admin/reports/products', [
            'topProducts' => $topProducts,
            'pageTitle' => "Top Selling Products Report - Admin Panel",
        ]);
    }
}
