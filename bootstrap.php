<?php
define('BASE_PATH', realpath(__DIR__));
define('HANDLERS_PATH', BASE_PATH . '/handlers'); 
chdir(BASE_PATH);

require __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
?>