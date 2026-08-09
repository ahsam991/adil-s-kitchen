<?php
/**
 * Database Configuration
 * Adil's Signature Kitchen
 */

return [
    'host' => getenv('DB_HOST') ?: 'localhost',
    'database' => getenv('DB_NAME') ?: 'adils_kitchen',
    'username' => getenv('DB_USER') ?: 'root',
    'password' => getenv('DB_PASS') ?: '',
    'charset' => 'utf8mb4',
    'collation' => 'utf8mb4_unicode_ci',
    'prefix' => '',
    'options' => [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]
];
