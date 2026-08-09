<?php
namespace Admin;

use Controller;
use User;

class UserController extends Controller {
    public function __construct() {
        parent::__construct();
        $this->requireAdmin();
    }

    public function index(): void {
        $users = $this->db->fetchAll("SELECT u.*, r.name as role_name FROM users u LEFT JOIN user_roles ur ON u.id = ur.user_id LEFT JOIN roles r ON ur.role_id = r.id WHERE u.deleted_at IS NULL");

        $this->view('admin/users/index', [
            'users' => $users,
            'pageTitle' => "Admin User Management - Admin Panel",
            'csrfToken' => $this->csrfToken(),
        ]);
    }

    public function store(): void {
        $userModel = new User();
        $userId = $userModel->create([
            'email' => filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL),
            'password' => password_hash($_POST['password'] ?? '12345678', PASSWORD_BCRYPT),
            'first_name' => $this->sanitizeInput($_POST['first_name'] ?? ''),
            'last_name' => $this->sanitizeInput($_POST['last_name'] ?? ''),
            'phone' => $this->sanitizeInput($_POST['phone'] ?? ''),
            'is_active' => 1
        ]);

        $roleId = $_POST['role_id'] ?? 2;
        $this->db->insert('user_roles', ['user_id' => $userId, 'role_id' => $roleId]);

        $_SESSION['success'] = 'Admin user created!';
        $this->redirect('/admin/users');
    }

    public function update(string $id): void {
        $userModel = new User();
        $userModel->update((int)$id, [
            'first_name' => $this->sanitizeInput($_POST['first_name'] ?? ''),
            'last_name' => $this->sanitizeInput($_POST['last_name'] ?? ''),
            'phone' => $this->sanitizeInput($_POST['phone'] ?? ''),
        ]);
        $_SESSION['success'] = 'User updated!';
        $this->redirect('/admin/users');
    }

    public function delete(string $id): void {
        $userModel = new User();
        $userModel->delete((int)$id);
        $_SESSION['success'] = 'User deleted!';
        $this->redirect('/admin/users');
    }
}
