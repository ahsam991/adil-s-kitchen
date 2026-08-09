<?php
/**
 * Admin Middleware
 */

class AdminMiddleware {
    public static function handle(): void {
        if (!isset($_SESSION['user_role']) || !in_array($_SESSION['user_role'], ['super_admin', 'admin'])) {
            header('Location: /admin/login');
            exit;
        }
    }
}
