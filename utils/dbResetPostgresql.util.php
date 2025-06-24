<?php
    //Set up requirements
    declare(strict_types=1);
    require 'vendor/autoload.php';
    require 'bootstrap.php';
    require_once UTILS_PATH . '/envSetter.util.php';

    // ——— Connect to PostgreSQL ———
    $dsn = "pgsql:host={$pgConfig['host']};port={$pgConfig['port']};dbname={$pgConfig['db']}";
    $pdo = new PDO($dsn, $pgConfig['user'], $pgConfig['pass'], [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]);
?>