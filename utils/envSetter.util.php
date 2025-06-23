<?php

// Path to Composer's autoloader relative to the project root
require __DIR__ . '/vendor/autoload.php';

// Initialize Dotenv to load environment variables
// Use __DIR__ to ensure it looks for .env in the same directory as bootstrap.php (project root)
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// You can add other global configurations, error reporting settings, etc., here later.

?>