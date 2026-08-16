<?php
namespace Admin;

use Controller;
use Inventory;

class InventoryController extends Controller {
    public function __construct() {
        parent::__construct();
        $this->requireAdmin();
    }

    public function index(): void {
        $inventoryModel = new Inventory();
        $items = $inventoryModel->findAll([], 'item_name ASC');

        $this->view('admin/inventory/index', [
            'inventoryItems' => $items,
            'pageTitle' => "Inventory & Ingredients - Admin Panel",
            'csrfToken' => $this->csrfToken(),
        ]);
    }

    public function store(): void {
        $inventoryModel = new Inventory();
        $inventoryModel->create([
            'item_name' => $this->sanitizeInput($_POST['item_name'] ?? ''),
            'unit' => $this->sanitizeInput($_POST['unit'] ?? 'Kg'),
            'current_stock' => (float)($_POST['current_stock'] ?? 0),
            'alert_stock' => (float)($_POST['alert_stock'] ?? 10),
            'is_active' => 1
        ]);

        $_SESSION['success'] = 'Inventory ingredient added!';
        $this->redirect('/admin/inventory');
    }
}
