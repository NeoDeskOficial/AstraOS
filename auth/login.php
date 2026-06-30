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

require_once __DIR__ . '/../conexao.php';

$erro = '';
$tipo = $_GET['tipo'] ?? 'funcionario';

if ($tipo !== 'funcionario') {
    header('Location: acesso.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = trim($_POST['email'] ?? '');
    $senha = trim($_POST['senha'] ?? '');

    if (empty($email) || empty($senha)) {
        $erro = 'Informe seu e-mail e senha.';
    } else {

        $sql = "SELECT 
                    f.id,
                    f.nome,
                    f.email,
                    f.senha,
                    f.situacao,
                    f.acesso_sistema,
                    f.expira_em,
                    f.permissao_id,
                    p.nome AS permissao,
                    c.nome_cargo
                FROM funcionarios f
                INNER JOIN permissoes p ON p.id = f.permissao_id
                INNER JOIN cargos c ON c.id = f.cargo_id
                WHERE f.email = :email
                LIMIT 1";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $funcionario = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$funcionario || !password_verify($senha, $funcionario['senha'])) {
            $erro = 'E-mail ou senha inválidos.';
        } elseif ($funcionario['situacao'] !== 'ativo') {
            $erro = 'Usuário inativo, bloqueado ou desligado.';
        } elseif ($funcionario['acesso_sistema'] !== 'sim') {
            $erro = 'Este usuário não possui acesso ao sistema.';
        } elseif (!empty($funcionario['expira_em']) && strtotime($funcionario['expira_em']) < strtotime(date('Y-m-d'))) {
            $erro = 'Seu acesso expirou. Fale com o administrador.';
        } else {

            $_SESSION['funcionario_id'] = $funcionario['id'];
            $_SESSION['funcionario_nome'] = $funcionario['nome'];
            $_SESSION['funcionario_email'] = $funcionario['email'];
            $_SESSION['permissao_id'] = $funcionario['permissao_id'];
            $_SESSION['permissao'] = $funcionario['permissao'];
            $_SESSION['cargo'] = $funcionario['nome_cargo'];

            $update = $pdo->prepare("UPDATE funcionarios SET ultimo_login = NOW() WHERE id = :id");
            $update->bindParam(':id', $funcionario['id']);
            $update->execute();

            header('Location: ../painel/dashboard.php');
            exit;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Login Funcionário - AstraOS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/login.css">
</head>

<body>

<main class="login-page">

    <section class="login-left">

        <div class="brand-box">
            <div class="logo-diamond">
                <span>N</span>
            </div>

            <h1>NeoDesk <span>OS</span></h1>
            <p>CRM • ERP • HELP DESK</p>
        </div>

        <div class="hero-content">
            <span class="badge">
                <i class="bi bi-shield-check"></i>
                Portal Interno
            </span>

            <h2>Gestão inteligente para sua operação.</h2>

            <p>
                Acesse o painel interno da NeoDesk para gerenciar chamados,
                clientes, contratos, financeiro e operações em tempo real.
            </p>

            <div class="hero-cards">
                <div>
                    <i class="bi bi-ticket-detailed"></i>
                    <strong>Chamados</strong>
                    <small>Suporte e atendimento</small>
                </div>

                <div>
                    <i class="bi bi-people"></i>
                    <strong>CRM</strong>
                    <small>Clientes e contatos</small>
                </div>

                <div>
                    <i class="bi bi-cash-coin"></i>
                    <strong>ERP</strong>
                    <small>Gestão financeira</small>
                </div>
            </div>
        </div>

    </section>

    <section class="login-right">

        <div class="login-card">

            <a href="acesso.php" class="back-link">
                <i class="bi bi-arrow-left"></i>
                Voltar
            </a>

            <div class="login-icon">
                <i class="bi bi-person-badge"></i>
            </div>

            <h2>Login Funcionário</h2>
            <p class="subtitle">Entre com suas credenciais internas</p>

            <?php if (!empty($erro)): ?>
                <div class="alert">
                    <i class="bi bi-exclamation-triangle"></i>
                    <?= htmlspecialchars($erro) ?>
                </div>
            <?php endif; ?>

            <form method="POST">

                <div class="form-group">
                    <label>E-mail</label>
                    <div class="input-box">
                        <i class="bi bi-envelope"></i>
                        <input type="email" name="email" placeholder="seuemail@neodeskinformatica.com.br" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Senha</label>
                    <div class="input-box">
                        <i class="bi bi-lock"></i>
                        <input type="password" name="senha" id="senha" placeholder="Digite sua senha" required>
                        <button type="button" onclick="mostrarSenha()">
                            <i class="bi bi-eye" id="iconeSenha"></i>
                        </button>
                    </div>
                </div>

                <div class="login-options">
                    <label>
                        <input type="checkbox" name="lembrar">
                        Lembrar acesso
                    </label>

                    <a href="recuperar.php">Esqueci minha senha</a>
                </div>

                <button type="submit" class="btn-login">
                    Entrar no AstraOS
                    <i class="bi bi-arrow-right"></i>
                </button>

            </form>

            <div class="login-footer">
                <span>AstraOS v1.0</span>
                <span>NeoDesk Informática</span>
            </div>

        </div>

    </section>

</main>

<script>
function mostrarSenha(){
    const campo = document.getElementById('senha');
    const icone = document.getElementById('iconeSenha');

    if(campo.type === 'password'){
        campo.type = 'text';
        icone.classList.remove('bi-eye');
        icone.classList.add('bi-eye-slash');
    }else{
        campo.type = 'password';
        icone.classList.remove('bi-eye-slash');
        icone.classList.add('bi-eye');
    }
}
</script>

</body>
</html>