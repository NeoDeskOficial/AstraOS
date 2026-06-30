<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../core/auth.php';

$pageTitle = $pageTitle ?? 'AstraOS';
$pageSubtitle = $pageSubtitle ?? 'Painel de gestão NeoDesk';
$pageCss = $pageCss ?? '';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($pageTitle); ?> | AstraOS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/global.css">

    <?php if (!empty($pageCss)): ?>
        <link rel="stylesheet" href="<?= htmlspecialchars($pageCss); ?>">
    <?php endif; ?>
</head>
<body>

<div class="app">

<?php require_once __DIR__ . '/sidebar.php'; ?>

<div class="app-main">

<?php require_once __DIR__ . '/header.php'; ?>

<main class="content">

    <div class="page-header">
        <div>
            <h1><?= htmlspecialchars($pageTitle); ?></h1>
            <p><?= htmlspecialchars($pageSubtitle); ?></p>
        </div>
    </div>