<?php
/**
 * Database Configuration — Adil's Signature Kitchen
 * Hostinger Production Server
 */

$env = file_exists(__DIR__ . '/env.php') ? require __DIR__ . '/env.php' : [];

return [
    'host'      => $env['DB_HOST'] ?? '127.0.0.1',
    'port'      => 3306,
    'database'  => $env['DB_NAME'] ?? 'adils_kitchen',
    'username'  => $env['DB_USER'] ?? 'root',
    'password'  => $env['DB_PASS'] ?? '',
    'charset'   => 'utf8mb4',
    'collation' => 'utf8mb4_unicode_ci',
    'prefix'    => '',
    'options'   => [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci",
    ],
];
