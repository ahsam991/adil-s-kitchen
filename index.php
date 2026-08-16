<?php
/**
 * ╔══════════════════════════════════════════════════════╗
 * ║   Adil's Signature Kitchen — Front Controller       ║
 * ║   For Hostinger / Shared Hosting                    ║
 * ║   public_html/index.php                             ║
 * ╚══════════════════════════════════════════════════════╝
 *
 * DIRECTORY STRUCTURE ON SERVER:
 *   /home/username/
 *   ├── app/
 *   ├── config/
 *   ├── database/
 *   ├── storage/
 *   └── public_html/    ← this file lives here
 *       ├── index.php
 *       ├── .htaccess
 *       └── assets/
 */

// ── Base path detection (works locally AND on Hostinger) ─────────────────────
// On Hostinger: __DIR__ = /home/u123/public_html   → dirname = /home/u123/
// Locally:      __DIR__ = /path/project/public     → dirname = /path/project/
define('BASE_PATH', __DIR__);
define('APP_PATH', BASE_PATH . '/app');
define('CONFIG_PATH', BASE_PATH . '/config');
define('STORAGE_PATH', BASE_PATH . '/storage');

// ── Session ──────────────────────────────────────────────────────────────────
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// ── Error reporting (set display_errors = 0 in production) ───────────────────
error_reporting(E_ALL);
ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', STORAGE_PATH . '/logs/error.log');

// ── Timezone ──────────────────────────────────────────────────────────────────
date_default_timezone_set('Asia/Dhaka');

// ── PSR-4-style Autoloader ────────────────────────────────────────────────────
spl_autoload_register(function (string $class): void {
    $paths = [
        APP_PATH . '/core/',
        APP_PATH . '/models/',
        APP_PATH . '/controllers/',
        APP_PATH . '/services/',
        APP_PATH . '/repositories/',
        APP_PATH . '/middleware/',
    ];

    if (strpos($class, 'Admin\\') === 0) {
        $classFile = APP_PATH . '/controllers/Admin/' . str_replace('Admin\\', '', $class) . '.php';
        if (file_exists($classFile)) {
            require_once $classFile;
            return;
        }
    } else {
        $classFile = $class . '.php';
        foreach ($paths as $dir) {
            if (file_exists($dir . $classFile)) {
                require_once $dir . $classFile;
                return;
            }
        }
    }
});

// ── Load configuration ────────────────────────────────────────────────────────
$config = require CONFIG_PATH . '/app.php';

// ── Request parsing ───────────────────────────────────────────────────────────
$requestUri    = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
$requestMethod = $_SERVER['REQUEST_METHOD'] ?? 'GET';

// Strip sub-directory base path (in case site runs in a sub-folder)
$basePath = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
if ($basePath !== '' && strpos($requestUri, $basePath) === 0) {
    $requestUri = substr($requestUri, strlen($basePath));
}
if (empty($requestUri)) {
    $requestUri = '/';
}

// ── Router ────────────────────────────────────────────────────────────────────
$router = new Router();

// ─── Customer Routes ──────────────────────────────────────────────────────────
$router->get('/',                           ['HomeController', 'index']);
$router->get('/home',                       ['HomeController', 'index']);
$router->get('/about',                      ['HomeController', 'about']);
$router->get('/shop',                       ['ShopController', 'index']);
$router->get('/category/[:slug]',           ['ShopController', 'category']);
$router->get('/product/[:slug]',            ['ProductController', 'show']);
$router->get('/gallery',                    ['GalleryController', 'index']);
$router->get('/custom-cake',               ['CustomCakeController', 'create']);
$router->post('/custom-cake',              ['CustomCakeController', 'store']);
$router->get('/testimonials',              ['HomeController', 'testimonials']);
$router->get('/blog',                      ['BlogController', 'index']);
$router->get('/blog/[:slug]',              ['BlogController', 'show']);
$router->get('/faq',                       ['HomeController', 'faq']);
$router->get('/contact',                   ['ContactController', 'create']);
$router->post('/contact',                  ['ContactController', 'store']);
$router->get('/login',                     ['AuthController', 'showLogin']);
$router->post('/login',                    ['AuthController', 'login']);
$router->get('/register',                  ['AuthController', 'showRegister']);
$router->post('/register',                 ['AuthController', 'register']);
$router->get('/logout',                    ['AuthController', 'logout']);
$router->get('/forgot-password',           ['AuthController', 'showForgotPassword']);
$router->post('/forgot-password',          ['AuthController', 'forgotPassword']);
$router->get('/wishlist',                  ['WishlistController', 'index']);
$router->post('/wishlist/add',             ['WishlistController', 'add']);
$router->post('/wishlist/remove',          ['WishlistController', 'remove']);
$router->get('/cart',                      ['CartController', 'index']);
$router->post('/cart/add',                 ['CartController', 'add']);
$router->post('/cart/update',              ['CartController', 'update']);
$router->post('/cart/remove',              ['CartController', 'remove']);
$router->get('/cart/count',                 ['CartController', 'count']);
$router->get('/checkout',                  ['CheckoutController', 'index']);
$router->post('/checkout',                 ['CheckoutController', 'process']);
$router->get('/order-tracking',            ['OrderController', 'tracking']);
$router->get('/my-account',                ['AccountController', 'index']);
$router->get('/my-account/orders',         ['AccountController', 'orders']);
$router->get('/my-account/order/[:id]',    ['AccountController', 'orderDetails']);
$router->get('/my-account/profile',        ['AccountController', 'profile']);
$router->post('/my-account/profile',       ['AccountController', 'updateProfile']);
$router->get('/my-account/password',       ['AccountController', 'password']);
$router->post('/my-account/password',      ['AccountController', 'updatePassword']);
$router->get('/my-account/addresses',      ['AccountController', 'addresses']);
$router->post('/my-account/addresses',     ['AccountController', 'addAddress']);
$router->post('/my-account/addresses/delete', ['AccountController', 'deleteAddress']);

// ─── Admin Routes ─────────────────────────────────────────────────────────────
$router->get('/admin',                          ['Admin\DashboardController', 'index']);
$router->get('/admin/login',                    ['Admin\AuthController', 'showLogin']);
$router->post('/admin/login',                   ['Admin\AuthController', 'login']);
$router->get('/admin/logout',                   ['Admin\AuthController', 'logout']);
$router->get('/admin/dashboard',                ['Admin\DashboardController', 'index']);
$router->get('/admin/orders',                   ['Admin\OrderController', 'index']);
$router->get('/admin/orders/[:id]',             ['Admin\OrderController', 'show']);
$router->post('/admin/orders/[:id]/status',     ['Admin\OrderController', 'updateStatus']);
$router->get('/admin/orders/[:id]/invoice',     ['Admin\OrderController', 'invoice']);
$router->post('/admin/orders/[:id]/cancel',     ['Admin\OrderController', 'cancel']);
$router->get('/admin/products',                 ['Admin\ProductController', 'index']);
$router->get('/admin/products/create',          ['Admin\ProductController', 'create']);
$router->post('/admin/products',                ['Admin\ProductController', 'store']);
$router->get('/admin/products/[:id]/edit',      ['Admin\ProductController', 'edit']);
$router->post('/admin/products/[:id]',          ['Admin\ProductController', 'update']);
$router->post('/admin/products/[:id]/delete',   ['Admin\ProductController', 'delete']);
$router->get('/admin/categories',               ['Admin\CategoryController', 'index']);
$router->get('/admin/categories/[:id]/edit',    ['Admin\CategoryController', 'edit']);
$router->post('/admin/categories',              ['Admin\CategoryController', 'store']);
$router->post('/admin/categories/[:id]/update', ['Admin\CategoryController', 'update']);
$router->post('/admin/categories/[:id]/delete', ['Admin\CategoryController', 'delete']);
$router->get('/admin/customers',                ['Admin\CustomerController', 'index']);
$router->get('/admin/customers/[:id]',          ['Admin\CustomerController', 'show']);
$router->get('/admin/inventory',                ['Admin\InventoryController', 'index']);
$router->post('/admin/inventory',               ['Admin\InventoryController', 'store']);
$router->get('/admin/reviews',                  ['Admin\ReviewController', 'index']);
$router->post('/admin/reviews/[:id]/approve',   ['Admin\ReviewController', 'approve']);
$router->post('/admin/reviews/[:id]/reject',    ['Admin\ReviewController', 'reject']);
$router->get('/admin/coupons',                  ['Admin\CouponController', 'index']);
$router->post('/admin/coupons',                 ['Admin\CouponController', 'store']);
$router->post('/admin/coupons/[:id]/update',    ['Admin\CouponController', 'update']);
$router->post('/admin/coupons/[:id]/delete',    ['Admin\CouponController', 'delete']);
$router->get('/admin/gallery',                  ['Admin\GalleryController', 'index']);
$router->post('/admin/gallery',                 ['Admin\GalleryController', 'store']);
$router->post('/admin/gallery/[:id]/delete',    ['Admin\GalleryController', 'delete']);
$router->get('/admin/blogs',                    ['Admin\BlogController', 'index']);
$router->get('/admin/blogs/create',             ['Admin\BlogController', 'create']);
$router->post('/admin/blogs',                   ['Admin\BlogController', 'store']);
$router->get('/admin/blogs/[:id]/edit',         ['Admin\BlogController', 'edit']);
$router->post('/admin/blogs/[:id]',             ['Admin\BlogController', 'update']);
$router->post('/admin/blogs/[:id]/delete',      ['Admin\BlogController', 'delete']);
$router->get('/admin/reports',                  ['Admin\ReportController', 'index']);
$router->get('/admin/reports/sales',            ['Admin\ReportController', 'sales']);
$router->get('/admin/reports/products',         ['Admin\ReportController', 'products']);
$router->get('/admin/settings',                 ['Admin\SettingsController', 'index']);
$router->post('/admin/settings',                ['Admin\SettingsController', 'update']);
$router->get('/admin/users',                    ['Admin\UserController', 'index']);
$router->post('/admin/users',                   ['Admin\UserController', 'store']);
$router->post('/admin/users/[:id]/update',      ['Admin\UserController', 'update']);
$router->post('/admin/users/[:id]/delete',      ['Admin\UserController', 'delete']);

// ── Dispatch ──────────────────────────────────────────────────────────────────
$router->dispatch($requestUri, $requestMethod);
