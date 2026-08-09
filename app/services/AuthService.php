<?php
/**
 * Auth Service
 */

class AuthService {
    private User $userModel;

    public function __construct() {
        $this->userModel = new User();
    }

    public function login(string $email, string $password): ?array {
        $user = $this->userModel->findByEmail($email);
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['user_name'] = $user['first_name'] . ' ' . $user['last_name'];
            $_SESSION['user_role'] = $this->userModel->getUserRole($user['id']) ?? 'customer';
            return $user;
        }
        return null;
    }

    public function logout(): void {
        unset($_SESSION['user_id'], $_SESSION['user_email'], $_SESSION['user_name'], $_SESSION['user_role']);
        session_destroy();
    }
}
