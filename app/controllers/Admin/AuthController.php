<?php
namespace Admin;

use Controller;
use AuthService;

class AuthController extends Controller {
    public function showLogin(): void {
        if ($this->isAdmin()) {
            $this->redirect('/admin/dashboard');
        }
        $this->view('admin/login', [
            'pageTitle' => "Admin Login - {$this->config['app']['name']}",
            'csrfToken' => $this->csrfToken(),
        ]);
    }

    public function login(): void {
        $email = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
        $password = $_POST['password'] ?? '';

        $authService = new AuthService();
        $user = $authService->login($email, $password);

        if ($user && $this->isAdmin()) {
            $this->redirect('/admin/dashboard');
        } else {
            $_SESSION['error'] = 'Access denied or invalid credentials.';
            $this->redirect('/admin/login');
        }
    }

    public function logout(): void {
        $authService = new AuthService();
        $authService->logout();
        $this->redirect('/admin/login');
    }
}
