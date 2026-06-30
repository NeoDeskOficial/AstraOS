<?php
$current = basename($_SERVER['PHP_SELF']);
?>
<aside class="sidebar" id="sidebar">

    <div class="sidebar-brand">
        <div class="brand-icon">A</div>
        <div>
            <strong>AstraOS</strong>
            <small>NeoDesk Platform</small>
        </div>
    </div>

    <nav class="sidebar-menu">

        <a href="../painel/dashboard.php" class="<?= $current === 'dashboard.php' ? 'active' : ''; ?>">
            <i class="bi bi-grid-1x2-fill"></i>
            <span>Dashboard</span>
        </a>

        <p>CRM</p>

        <a href="#">
            <i class="bi bi-people-fill"></i>
            <span>Clientes</span>
        </a>

        <a href="#">
            <i class="bi bi-funnel-fill"></i>
            <span>Leads</span>
        </a>

        <p>Help Desk</p>

        <a href="#">
            <i class="bi bi-ticket-detailed-fill"></i>
            <span>Chamados</span>
        </a>

        <a href="#">
            <i class="bi bi-tools"></i>
            <span>Ordens de Serviço</span>
        </a>

        <p>ERP</p>

        <a href="#">
            <i class="bi bi-cash-coin"></i>
            <span>Financeiro</span>
        </a>

        <a href="#">
            <i class="bi bi-file-earmark-text-fill"></i>
            <span>Contratos</span>
        </a>

        <a href="#">
            <i class="bi bi-box-seam-fill"></i>
            <span>Estoque</span>
        </a>

        <p>Administração</p>

        <a href="#">
            <i class="bi bi-person-badge-fill"></i>
            <span>Funcionários</span>
        </a>

        <a href="#">
            <i class="bi bi-diagram-3-fill"></i>
            <span>Cargos</span>
        </a>

        <a href="#">
            <i class="bi bi-shield-lock-fill"></i>
            <span>Permissões</span>
        </a>

    </nav>

</aside>