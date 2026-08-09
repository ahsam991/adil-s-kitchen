<?php
/**
 * Base Controller Class
 * All controllers extend this class
 */

class Controller {
    protected $db;
    protected $config;

    public function __construct() {
        $this->db = Database::getInstance();
        $this->config = require __DIR__ . '/../../config/app.php';
    }

    protected function view(string $view, array $data = []): void {
        extract($data);
        $data['view'] = $view;
        $viewContent = __DIR__ . '/../views/' . $view . '.php';

        if (strpos($view, 'admin/') === 0 && $view !== 'admin/login') {
            include __DIR__ . '/../views/layouts/admin.php';
        } elseif (strpos($view, 'customer/') === 0) {
            include __DIR__ . '/../views/layouts/customer.php';
        } else {
            include $viewContent;
        }
    }

    protected function redirect(string $url): void {
        header("Location: {$url}");
        exit;
    }

    protected function jsonResponse(array $data, int $statusCode = 200): void {
        http_response_code($statusCode);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }

    protected function isAuthenticated(): bool {
        return isset($_SESSION['user_id']);
    }

    protected function isAdmin(): bool {
        return isset($_SESSION['user_role']) && in_array($_SESSION['user_role'], ['super_admin', 'admin']);
    }

    protected function requireAuth(): void {
        if (!$this->isAuthenticated()) {
            $this->redirect('/login');
        }
    }

    protected function requireAdmin(): void {
        if (!$this->isAdmin()) {
            $this->redirect('/admin/login');
        }
    }

    protected function csrfToken(): string {
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }

    protected function validateCsrfToken(?string $token): bool {
        return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token ?? '');
    }

    protected function sanitizeInput(string $input): string {
        return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
    }

    protected function generateSlug(string $string): string {
        $string = strtolower(trim($string));
        $string = preg_replace('/[^a-z0-9-]/', '-', $string);
        $string = preg_replace('/-+/', '-', $string);
        return trim($string, '-');
    }
}
