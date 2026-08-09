<?php
/**
 * Base Controller Class
 * Uses BASE_PATH constant defined in index.php
 */

class Controller {
    protected $db;
    protected $config;

    public function __construct() {
        $this->db     = Database::getInstance();
        $this->config = require CONFIG_PATH . '/app.php';
    }

    protected function view(string $view, array $data = []): void {
        // Make all data variables available to the view
        extract($data);

        // Resolve the full path to the view file
        $viewContent = APP_PATH . '/views/' . $view . '.php';

        // Choose which layout wraps the view
        if (strpos($view, 'admin/') === 0 && $view !== 'admin/login') {
            include APP_PATH . '/views/layouts/admin.php';
        } elseif (strpos($view, 'customer/') === 0) {
            include APP_PATH . '/views/layouts/customer.php';
        } else {
            // Standalone views (e.g. admin/login)
            if (file_exists($viewContent)) {
                include $viewContent;
            }
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

    protected function uploadFile(array $file, string $destination, array $allowedTypes = ['jpg','jpeg','png','webp','gif']): ?string {
        if ($file['error'] !== UPLOAD_ERR_OK) return null;

        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if (!in_array($ext, $allowedTypes)) return null;

        $filename = uniqid('img_', true) . '.' . $ext;
        $uploadDir = BASE_PATH . '/public_html/uploads/' . trim($destination, '/') . '/';

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        if (move_uploaded_file($file['tmp_name'], $uploadDir . $filename)) {
            return '/uploads/' . trim($destination, '/') . '/' . $filename;
        }
        return null;
    }
}
