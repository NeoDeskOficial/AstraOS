<?php
$pageTitle = "Dashboard";
$pageSubtitle = "Visão geral da operação da NeoDesk";
$pageCss = "../assets/css/dashboard.css";

require_once __DIR__ . "/../layout/layout.php";

$nome = $_SESSION['funcionario_nome'] ?? 'Usuário';
?>

<section class="dashboard-welcome">
    <div>
        <h2><span id="dashboardGreeting">Olá</span>, <?= htmlspecialchars($nome); ?> 👋</h2>
        <p>Bem-vindo ao AstraOS. Aqui você acompanha toda a operação da NeoDesk.</p>
    </div>

    <button class="btn btn-primary">
        <i class="bi bi-plus-circle"></i>
        Novo Chamado
    </button>
</section>

<section class="dashboard-cards">

    <div class="dashboard-card">
        <div class="card-icon"><i class="bi bi-people-fill"></i></div>
        <h4>Clientes</h4>
        <h2>0</h2>
        <small>Clientes cadastrados</small>
    </div>

    <div class="dashboard-card">
        <div class="card-icon"><i class="bi bi-ticket-detailed-fill"></i></div>
        <h4>Chamados</h4>
        <h2>0</h2>
        <small>Chamados abertos</small>
    </div>

    <div class="dashboard-card">
        <div class="card-icon"><i class="bi bi-cash-stack"></i></div>
        <h4>Financeiro</h4>
        <h2>R$ 0,00</h2>
        <small>Receita do mês</small>
    </div>

    <div class="dashboard-card">
        <div class="card-icon"><i class="bi bi-person-badge-fill"></i></div>
        <h4>Funcionários</h4>
        <h2>1</h2>
        <small>Usuários ativos</small>
    </div>

</section>

<section class="dashboard-grid">

    <div class="dashboard-panel">
        <h3>Resumo Financeiro</h3>

        <div class="chart-area">
            <i class="bi bi-graph-up-arrow"></i>
            <p>Gráfico financeiro será exibido aqui.</p>
        </div>
    </div>

    <div class="dashboard-panel">
        <h3>Atividades Recentes</h3>

        <div class="activity-item">
            <div class="activity-icon"><i class="bi bi-box-arrow-in-right"></i></div>
            <div class="activity-content">
                <strong>Login realizado</strong>
                <small><?= htmlspecialchars($nome); ?> acessou o sistema.</small>
            </div>
        </div>

        <div class="activity-item">
            <div class="activity-icon"><i class="bi bi-database-check"></i></div>
            <div class="activity-content">
                <strong>Banco conectado</strong>
                <small>Conexão estabelecida com sucesso.</small>
            </div>
        </div>

        <div class="activity-item">
            <div class="activity-icon"><i class="bi bi-shield-check"></i></div>
            <div class="activity-content">
                <strong>Sessão protegida</strong>
                <small>Autenticação ativa.</small>
            </div>
        </div>
    </div>

</section>

<section class="dashboard-grid">

    <div class="dashboard-panel">
        <h3>Últimos Chamados</h3>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td>#0001</td>
                    <td>NeoDesk</td>
                    <td><span class="badge badge-warning">Em breve</span></td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="dashboard-panel">
        <h3>Resumo</h3>

        <div class="resume-list">
            <div class="resume-item">
                <span>Versão</span>
                <strong>1.0.0 Alpha</strong>
            </div>

            <div class="resume-item">
                <span>Usuário</span>
                <strong><?= htmlspecialchars($nome); ?></strong>
            </div>

            <div class="resume-item">
                <span>Permissão</span>
                <strong><?= htmlspecialchars($_SESSION['permissao'] ?? 'Administrador'); ?></strong>
            </div>
        </div>
    </div>

</section>

<script src="../assets/js/dashboard.js"></script>

<?php require_once __DIR__ . "/../layout/footer.php"; ?>