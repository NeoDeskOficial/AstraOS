<?php

$configFile = __DIR__ . '/config/database.php';

if (!file_exists($configFile)) {
    header('Location: install.php');
    exit;
}

$config = require $configFile;

try {
    $pdo = new PDO(
        "mysql:host={$config['host']};dbname={$config['dbname']};charset=utf8mb4",
        $config['user'],
        $config['password']
    );

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    header('Location: install.php?erro=conexao');
    exit;
}