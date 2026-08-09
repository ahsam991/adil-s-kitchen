<?php
/**
 * CSRF Middleware
 */

class CsrfMiddleware {
    public static function handle(): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $token = $_POST['_csrf_token'] ?? $_SERVER['HTTP_X_CSRF_TOKEN'] ?? null;
            if (!isset($_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $token ?? '')) {
                http_response_code(403);
                die('CSRF token validation failed.');
            }
        }
    }
}
