<?php
namespace Admin;

use Controller;
use Coupon;

class CouponController extends Controller {
    public function __construct() {
        parent::__construct();
        $this->requireAdmin();
    }

    public function index(): void {
        $couponModel = new Coupon();
        $coupons = $couponModel->findAll([], 'expiry_date DESC');

        $this->view('admin/coupons/index', [
            'coupons' => $coupons,
            'pageTitle' => "Coupons - Admin Panel",
            'csrfToken' => $this->csrfToken(),
        ]);
    }

    public function store(): void {
        $couponModel = new Coupon();
        $couponModel->create([
            'code' => strtoupper($this->sanitizeInput($_POST['code'] ?? '')),
            'type' => $_POST['type'] ?? 'percentage',
            'value' => (float)($_POST['value'] ?? 0),
            'min_purchase' => (float)($_POST['min_purchase'] ?? 0),
            'expiry_date' => $_POST['expiry_date'] ?? date('Y-12-31'),
            'usage_limit' => (int)($_POST['usage_limit'] ?? 100),
            'is_active' => 1
        ]);

        $_SESSION['success'] = 'Coupon created!';
        $this->redirect('/admin/coupons');
    }

    public function update(string $id): void {
        $couponModel = new Coupon();
        $couponModel->update((int)$id, [
            'value' => (float)($_POST['value'] ?? 0),
            'min_purchase' => (float)($_POST['min_purchase'] ?? 0),
            'expiry_date' => $_POST['expiry_date'] ?? date('Y-12-31')
        ]);
        $_SESSION['success'] = 'Coupon updated!';
        $this->redirect('/admin/coupons');
    }

    public function delete(string $id): void {
        $couponModel = new Coupon();
        $couponModel->delete((int)$id);
        $_SESSION['success'] = 'Coupon deleted!';
        $this->redirect('/admin/coupons');
    }
}
