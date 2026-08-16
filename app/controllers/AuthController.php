<?php
/**
 * Auth Controller
 */

class AuthController extends Controller {
    public function showLogin(): void {
        if ($this->isAuthenticated()) {
            $this->redirect('/my-account');
        }
        $this->view('customer/login', [
            'pageTitle' => "Login - {$this->config['app']['name']}",
            'csrfToken' => $this->csrfToken(),
        ]);
    }

    public function login(): void {
        $email = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
        $password = $_POST['password'] ?? '';

        $authService = new AuthService();
        $user = $authService->login($email, $password);

        if ($user) {
            $this->redirect($_SESSION['user_role'] === 'admin' ? '/admin/dashboard' : '/my-account');
        } else {
            $_SESSION['error'] = 'Invalid email or password.';
            $this->redirect('/login');
        }
    }

    public function showRegister(): void {
        $this->view('customer/register', [
            'pageTitle' => "Register - {$this->config['app']['name']}",
            'csrfToken' => $this->csrfToken(),
        ]);
    }

    public function register(): void {
        $email = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
        $password = $_POST['password'] ?? '';
        $firstName = $this->sanitizeInput($_POST['first_name'] ?? '');
        $lastName = $this->sanitizeInput($_POST['last_name'] ?? '');
        $phone = $this->sanitizeInput($_POST['phone'] ?? '');

        $userModel = new User();
        if ($userModel->findByEmail($email)) {
            $_SESSION['error'] = 'Email already registered.';
            $this->redirect('/register');
        }

        $userId = $userModel->create([
            'email' => $email,
            'password' => password_hash($password, PASSWORD_BCRYPT),
            'first_name' => $firstName,
            'last_name' => $lastName,
            'phone' => $phone,
            'is_active' => 1
        ]);

        $this->db->insert('user_roles', ['user_id' => $userId, 'role_id' => 3]);

        $customerModel = new Customer();
        $customerModel->create([
            'user_id' => $userId,
            'first_name' => $firstName,
            'last_name' => $lastName,
            'email' => $email,
            'phone' => $phone,
        ]);

        $_SESSION['success'] = 'Account created successfully! Please login.';
        $this->redirect('/login');
    }

    public function logout(): void {
        $authService = new AuthService();
        $authService->logout();
        $this->redirect('/login');
    }

    public function showForgotPassword(): void {
        $this->view('customer/forgot-password', [
            'pageTitle' => "Forgot Password - {$this->config['app']['name']}",
            'csrfToken' => $this->csrfToken(),
        ]);
    }

    public function forgotPassword(): void {
        $_SESSION['success'] = 'Password reset instructions have been sent to your email.';
        $this->redirect('/login');
    }
}
