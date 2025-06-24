<?php
require BASE_PATH . 'vendor/autoload.php';

// Debug information first
echo "Current working directory: " . getcwd() . "\n";
echo "BASE_PATH constant: " . (defined('BASE_PATH') ? BASE_PATH : 'NOT DEFINED') . "\n";
echo "_DIR_ constant: " . __DIR__ . "\n";
echo "Looking for .env at: " . __DIR__ . "/.env\n";
echo "File exists: " . (file_exists(__DIR__ . "/.env") ? "YES" : "NO") . "\n";

// Also check BASE_PATH location if defined
if (defined('BASE_PATH')) {
    echo "Also checking BASE_PATH/.env: " . BASE_PATH . ".env\n";
    echo "BASE_PATH .env exists: " . (file_exists(BASE_PATH . ".env") ? "YES" : "NO") . "\n";
}

// Try to create dotenv instance with current directory first
try {
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    echo "Attempting to load .env from _DIR_...\n";
    $dotenv->load();
    echo "SUCCESS: .env loaded from __DIR__\n";
} catch (Exception $e) {
    echo "FAILED to load from _DIR_: " . $e->getMessage() . "\n";
    
    // Try BASE_PATH if it's defined and different from _DIR_
    if (defined('BASE_PATH') && BASE_PATH !== __DIR__ . '/') {
        try {
            $dotenv = Dotenv\Dotenv::createImmutable(BASE_PATH);
            echo "Attempting to load .env from BASE_PATH...\n";
            $dotenv->load();
            echo "SUCCESS: .env loaded from BASE_PATH\n";
        } catch (Exception $e2) {
            echo "FAILED to load from BASE_PATH: " . $e2->getMessage() . "\n";
        }
    }
}

// If we got here and have environment variables, show the config
if (isset($_ENV['PG_HOST']) || isset($_ENV['MONGO_URI'])) {
    echo "\nEnvironment variables loaded successfully!\n";
    
    $pgConfig = [
        'host' => $_ENV['PG_HOST'] ?? 'NOT SET',
        'port' => $_ENV['PG_PORT'] ?? 'NOT SET',
        'db' => $_ENV['PG_DB'] ?? 'NOT SET',
        'user' => $_ENV['PG_USER'] ?? 'NOT SET',
        'pass' => isset($_ENV['PG_PASS']) ? '[HIDDEN]' : 'NOT SET'
    ];
    
    $mongoConfig = [
        'uri' => $_ENV['MONGO_URI'] ?? 'NOT SET',
        'db' => $_ENV['MONGO_DB'] ?? 'NOT SET'
    ];
    
    echo "PostgreSQL Config: " . print_r($pgConfig, true) . "\n";
    echo "MongoDB Config: " . print_r($mongoConfig, true) . "\n";
} else {
    echo "\nNo environment variables found. You need to create a .env file.\n";
}

die();