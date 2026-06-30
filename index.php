<?php
session_start();

$configFile = __DIR__ . '/config/database.php';

if (!file_exists($configFile)) {
    header('Location: install.php');
    exit;
}

if (isset($_SESSION['funcionario_id'])) {
    header('Location: painel/dashboard.php');
    exit;
}

if (isset($_SESSION['cliente_id'])) {
    header('Location: cliente/dashboard.php');
    exit;
}

header('Location: auth/acesso.php');
exit;