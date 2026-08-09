<?php
/**
 * Application Configuration
 * Adil's Signature Kitchen
 */

return [
    'app' => [
        'name' => "Adil's Signature Kitchen",
        'tagline' => 'Homemade With Love',
        'url' => getenv('APP_URL') ?: 'http://localhost',
        'debug' => getenv('APP_DEBUG') ?: false,
        'timezone' => 'Asia/Dhaka',
        'locale' => 'en',
    ],

    'session' => [
        'lifetime' => 120,
        'expire_on_close' => false,
        'encrypt' => false,
        'files' => '/tmp/sessions',
        'table' => 'sessions',
        'lottery' => [2, 100],
        'cookie' => 'adils_session',
        'path' => '/',
        'domain' => null,
        'secure' => false,
        'http_only' => true,
        'same_site' => 'lax',
    ],

    'security' => [
        'csrf_enabled' => true,
        'csrf_token_name' => '_csrf_token',
        'password_min_length' => 8,
        'max_login_attempts' => 5,
        'lockout_time' => 300, // 5 minutes
    ],

    'upload' => [
        'max_size' => 5 * 1024 * 1024, // 5MB
        'allowed_types' => ['jpg', 'jpeg', 'png', 'gif', 'webp'],
        'products_path' => '/uploads/products/',
        'cakes_path' => '/uploads/cakes/',
        'gallery_path' => '/uploads/gallery/',
        'blog_path' => '/uploads/blog/',
    ],

    'pagination' => [
        'per_page' => 12,
        'admin_per_page' => 25,
    ],

    'delivery' => [
        'flat_charge' => 60.00,
        'free_above' => 1500.00,
        'min_days' => 2,
        'max_days' => 5,
    ],

    'payment' => [
        'cod_enabled' => true,
        'bkash_enabled' => true,
        'nagad_enabled' => true,
        'rocket_enabled' => true,
        'bank_transfer_enabled' => true,
        'sslcommerz_enabled' => false,
    ],

    'contact' => [
        'phone' => '01303721109',
        'whatsapp' => '01303721109',
        'email' => 'info@adilskitchen.com',
        'address' => 'Dhaka, Bangladesh',
    ],

    'social' => [
        'facebook' => 'https://facebook.com/adilskitchen',
        'instagram' => 'https://instagram.com/adilskitchen',
        'youtube' => '',
    ],
];
