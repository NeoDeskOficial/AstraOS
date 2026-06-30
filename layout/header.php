<?php
$nomeUsuario = $_SESSION['funcionario_nome'] ?? 'Usuário';
$cargoUsuario = $_SESSION['cargo'] ?? 'Funcionário';
?>
<header class="topbar">

    <button class="sidebar-toggle" id="sidebarToggle">
        <i class="bi bi-list"></i>
    </button>

    <div class="search">
        <i class="bi bi-search"></i>
        <input type="text" placeholder="Pesquisar no AstraOS...">
    </div>

    <div class="topbar-actions">

        <button class="icon-btn">
            <i class="bi bi-bell"></i>
            <span></span>
        </button>

        <div class="user-box">
            <div class="avatar">
                <?= strtoupper(substr($nomeUsuario, 0, 1)); ?>
            </div>

            <div class="user-text">
                <strong><?= htmlspecialchars($nomeUsuario); ?></strong>
                <small><?= htmlspecialchars($cargoUsuario); ?></small>
            </div>

            <div class="dropdown">
                <a href="#"><i class="bi bi-person"></i> Meu perfil</a>
                <a href="#"><i class="bi bi-gear"></i> Configurações</a>
                <a href="../auth/logout.php" class="logout"><i class="bi bi-box-arrow-right"></i> Sair</a>
            </div>
        </div>

    </div>

</header>