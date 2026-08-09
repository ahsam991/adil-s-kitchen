<?php
/**
 * Test Bootstrap
 * Initializes autoloader and test environment
 */

// Define necessary constants for the application
define('APP_PATH', dirname(__DIR__) . '/app');
define('CONFIG_PATH', dirname(__DIR__) . '/config');

// Load Composer autoloader
require_once __DIR__ . '/../vendor/autoload.php';

// Create a mock configuration file for tests if it doesn't exist
if (!file_exists(CONFIG_PATH . '/database.php')) {
    // Create a test database config
    $testConfig = "<?php\nreturn [\n    'host' => getenv('DB_HOST') ?: 'localhost',\n    'database' => getenv('DB_DATABASE') ?: 'test_cake_shop',\n    'username' => getenv('DB_USERNAME') ?: 'root',\n    'password' => getenv('DB_PASSWORD') ?: '',\n    'charset' => 'utf8mb4',\n    'options' => [\n        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,\n        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,\n        PDO::ATTR_EMULATE_PREPARES => false,\n    ],\n];\n";
    if (!is_dir(CONFIG_PATH)) {
        mkdir(CONFIG_PATH, 0755, true);
    }
    file_put_contents(CONFIG_PATH . '/database.php', $testConfig);
}
