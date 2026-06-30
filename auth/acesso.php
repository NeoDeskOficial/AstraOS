<?php
session_start();

$configFile = __DIR__ . '/../config/database.php';

if (!file_exists($configFile)) {
    header('Location: ../install.php');
    exit;
}

if (isset($_SESSION['funcionario_id'])) {
    header('Location: ../painel/dashboard.php');
    exit;
}

if (isset($_SESSION['cliente_id'])) {
    header('Location: ../cliente/dashboard.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Acesso - AstraOS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/acesso.css">
</head>
<body>

<main class="access-page">

    <section class="access-card">

        <div class="logo-box">
            <span>N</span>
        </div>

        <h1>NeoDesk OS</h1>
        <p>Escolha como deseja acessar o sistema</p>

        <div class="access-options">

            <a href="login.php?tipo=funcionario" class="access-btn employee">
                <i class="bi bi-person-badge"></i>
                <div>
                    <strong>Sou Funcionário</strong>
                    <small>Acessar painel interno</small>
                </div>
            </a>

            <a href="login.php?tipo=cliente" class="access-btn client">
                <i class="bi bi-building"></i>
                <div>
                    <strong>Sou Cliente</strong>
                    <small>Acessar portal do cliente</small>
                </div>
            </a>

        </div>

        <div class="access-footer">
            AstraOS v1.0 • NeoDesk Informática
        </div>

    </section>

</main>

</body>
</html>