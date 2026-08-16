<?php
namespace Admin;

use Controller;
use Review;

class ReviewController extends Controller {
    public function __construct() {
        parent::__construct();
        $this->requireAdmin();
    }

    public function index(): void {
        $reviews = $this->db->fetchAll("SELECT r.*, p.name as product_name FROM reviews r LEFT JOIN products p ON r.product_id = p.id WHERE r.deleted_at IS NULL ORDER BY r.created_at DESC");

        $this->view('admin/reviews/index', [
            'reviews' => $reviews,
            'pageTitle' => "Review Moderation - Admin Panel",
        ]);
    }

    public function approve(string $id): void {
        $reviewModel = new Review();
        $reviewModel->update((int)$id, ['status' => 'approved']);
        $_SESSION['success'] = 'Review approved!';
        $this->redirect('/admin/reviews');
    }

    public function reject(string $id): void {
        $reviewModel = new Review();
        $reviewModel->update((int)$id, ['status' => 'rejected']);
        $_SESSION['success'] = 'Review rejected.';
        $this->redirect('/admin/reviews');
    }
}
