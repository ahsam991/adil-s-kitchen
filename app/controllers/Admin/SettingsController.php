<?php
namespace Admin;

use Controller;
use Setting;

class SettingsController extends Controller {
    public function __construct() {
        parent::__construct();
        $this->requireAdmin();
    }

    public function index(): void {
        $settings = [
            'store_name' => Setting::get('store_name', "Adil's Signature Kitchen"),
            'store_phone' => Setting::get('store_phone', '01303721109'),
            'store_whatsapp' => Setting::get('store_whatsapp', '01303721109'),
            'store_email' => Setting::get('store_email', 'info@adilskitchen.com'),
            'store_address' => Setting::get('store_address', 'Dhaka, Bangladesh'),
            'delivery_fee' => Setting::get('delivery_fee', '60'),
            'free_delivery_threshold' => Setting::get('free_delivery_threshold', '1500'),
        ];

        $this->view('admin/settings/index', [
            'settings' => $settings,
            'pageTitle' => "Store Settings - Admin Panel",
            'csrfToken' => $this->csrfToken(),
        ]);
    }

    public function update(): void {
        foreach ($_POST as $key => $val) {
            if ($key !== '_csrf_token') {
                Setting::set($key, $this->sanitizeInput($val));
            }
        }
        $_SESSION['success'] = 'Settings saved!';
        $this->redirect('/admin/settings');
    }
}
