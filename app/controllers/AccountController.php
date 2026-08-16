<?php
/**
 * Account Controller
 */

class AccountController extends Controller {
    public function __construct() {
        parent::__construct();
        $this->requireAuth();
    }

    public function index(): void {
        $userModel = new User();
        $user = $userModel->find($_SESSION['user_id']);

        $orderModel = new Order();
        $orders = $orderModel->findAll(['customer_id' => $_SESSION['user_id']], 'created_at DESC', 5);

        $this->view('customer/my-account', [
            'user' => $user,
            'recentOrders' => $orders,
            'pageTitle' => "My Account - {$this->config['app']['name']}",
        ]);
    }

    public function orders(): void {
        $orderModel = new Order();
        $orders = $orderModel->findAll(['customer_id' => $_SESSION['user_id']], 'created_at DESC');

        $this->view('customer/my-account', [
            'viewSection' => 'orders',
            'orders' => $orders,
            'pageTitle' => "My Orders - {$this->config['app']['name']}",
        ]);
    }

    public function orderDetails(string $id): void {
        $orderModel = new Order();
        $order = $orderModel->find((int)$id);
        if (!$order || $order['customer_id'] != $_SESSION['user_id']) {
            $this->redirect('/my-account/orders');
        }

        $items = $orderModel->getItems($order['id']);
        $this->view('customer/my-account', [
            'viewSection' => 'order_details',
            'order' => $order,
            'items' => $items,
            'pageTitle' => "Order #{$order['order_number']} - {$this->config['app']['name']}",
        ]);
    }

    public function profile(): void {
        $userModel = new User();
        $user = $userModel->find($_SESSION['user_id']);

        $this->view('customer/my-account', [
            'viewSection' => 'profile',
            'user' => $user,
            'pageTitle' => "Profile - {$this->config['app']['name']}",
            'csrfToken' => $this->csrfToken(),
        ]);
    }

    public function updateProfile(): void {
        $userModel = new User();
        $userModel->update($_SESSION['user_id'], [
            'first_name' => $this->sanitizeInput($_POST['first_name'] ?? ''),
            'last_name' => $this->sanitizeInput($_POST['last_name'] ?? ''),
            'phone' => $this->sanitizeInput($_POST['phone'] ?? ''),
        ]);

        $_SESSION['success'] = 'Profile updated successfully!';
        $this->redirect('/my-account/profile');
    }

    public function password(): void {
        $this->view('customer/my-account', [
            'viewSection' => 'password',
            'pageTitle' => "Change Password - {$this->config['app']['name']}",
            'csrfToken' => $this->csrfToken(),
        ]);
    }

    public function updatePassword(): void {
        $userModel = new User();
        $user = $userModel->find($_SESSION['user_id']);

        if (!password_verify($_POST['current_password'] ?? '', $user['password'])) {
            $_SESSION['error'] = 'Current password is incorrect.';
            $this->redirect('/my-account/password');
        }

        $userModel->update($_SESSION['user_id'], [
            'password' => password_hash($_POST['new_password'], PASSWORD_BCRYPT)
        ]);

        $_SESSION['success'] = 'Password changed successfully!';
        $this->redirect('/my-account/password');
    }

    public function addresses(): void {
        $customerModel = new Customer();
        $customer = $customerModel->firstWhere('user_id', $_SESSION['user_id']);
        $addresses = $customer ? $customerModel->getAddresses($customer['id']) : [];

        $this->view('customer/my-account', [
            'viewSection' => 'addresses',
            'addresses' => $addresses,
            'pageTitle' => "My Addresses - {$this->config['app']['name']}",
            'csrfToken' => $this->csrfToken(),
        ]);
    }

    public function addAddress(): void {
        $customerModel = new Customer();
        $customer = $customerModel->firstWhere('user_id', $_SESSION['user_id']);

        if ($customer) {
            $this->db->insert('addresses', [
                'customer_id' => $customer['id'],
                'address_line1' => $this->sanitizeInput($_POST['address_line1'] ?? ''),
                'city' => $this->sanitizeInput($_POST['city'] ?? 'Dhaka'),
                'state' => $this->sanitizeInput($_POST['state'] ?? 'Dhaka'),
                'postal_code' => $this->sanitizeInput($_POST['postal_code'] ?? ''),
                'country' => 'Bangladesh',
                'is_default' => isset($_POST['is_default']) ? 1 : 0
            ]);
        }

        $_SESSION['success'] = 'Address added!';
        $this->redirect('/my-account/addresses');
    }

    public function deleteAddress(): void {
        $addressId = (int)($_POST['address_id'] ?? 0);
        $this->db->softDelete('addresses', (string)$addressId);
        $this->redirect('/my-account/addresses');
    }
}
