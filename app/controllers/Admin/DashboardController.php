<?php
namespace Admin;

use Controller;

class DashboardController extends Controller {
    public function __construct() {
        parent::__construct();
        $this->requireAdmin();
    }

    public function index(): void {
        $todayOrders = $this->db->fetchOne("SELECT COUNT(*) as count, COALESCE(SUM(total_amount), 0) as revenue FROM orders WHERE DATE(created_at) = CURDATE() AND deleted_at IS NULL");
        $monthlyOrders = $this->db->fetchOne("SELECT COALESCE(SUM(total_amount), 0) as revenue FROM orders WHERE MONTH(created_at) = MONTH(CURDATE()) AND YEAR(created_at) = YEAR(CURDATE()) AND deleted_at IS NULL");
        $totalCustomers = $this->db->fetchOne("SELECT COUNT(*) as count FROM customers WHERE deleted_at IS NULL");
        $totalProducts = $this->db->fetchOne("SELECT COUNT(*) as count FROM products WHERE deleted_at IS NULL");
        $pendingOrders = $this->db->fetchOne("SELECT COUNT(*) as count FROM orders WHERE order_status = 'pending' AND deleted_at IS NULL");

        $recentOrders = $this->db->fetchAll("SELECT * FROM orders WHERE deleted_at IS NULL ORDER BY created_at DESC LIMIT 6");

        $this->view('admin/dashboard', [
            'todayCount' => (int)$todayOrders['count'],
            'todayRevenue' => (float)$todayOrders['revenue'],
            'monthlyRevenue' => (float)$monthlyOrders['revenue'],
            'totalCustomers' => (int)$totalCustomers['count'],
            'totalProducts' => (int)$totalProducts['count'],
            'pendingOrders' => (int)$pendingOrders['count'],
            'recentOrders' => $recentOrders,
            'pageTitle' => "Dashboard - Admin Panel",
        ]);
    }
}
