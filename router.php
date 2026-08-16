<?php
/**
 * DEV ROUTER for `php -S 127.0.0.1:8000 router.php`
 * Mirrors .htaccess so the built-in server behaves like Apache:
 *  - serves real static files as-is
 *  - blocks direct access to private dirs (app/config/database/storage)
 *  - routes everything else to index.php (front controller)
 */

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// ── Block direct access to private backend folders (mirrors .htaccess) ──────
if (preg_match('#^/(app|config|database|storage)(/|$)#', $path)) {
    http_response_code(403);
    echo 'Forbidden';
    return true;
}

// ── Serve sitemap.xml via sitemap.php (mirrors .htaccess) ────────────────────
if ($path === '/sitemap.xml') {
    require __DIR__ . '/sitemap.php';
    return true;
}

// ── Static files: let the built-in server serve them directly ────────────────
$file = __DIR__ . rawurldecode($path);
if ($path !== '/' && is_file($file)) {
    return false;
}

// ── Everything else → front controller ───────────────────────────────────────
require __DIR__ . '/index.php';
return true;
