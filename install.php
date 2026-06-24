<?php

$configDir = __DIR__ . '/config';
$configFile = $configDir . '/database.php';

if (file_exists($configFile) && !isset($_GET['erro'])) {
    header('Location: login.php');
    exit;
}

if (isset($_GET['erro']) && file_exists($configFile)) {
    unlink($configFile);
}

$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $host = trim($_POST['host'] ?? '');
    $dbname = trim($_POST['dbname'] ?? '');
    $user = trim($_POST['user'] ?? '');
    $password = trim($_POST['password'] ?? '');

    try {
        $pdo = new PDO(
            "mysql:host={$host};dbname={$dbname};charset=utf8mb4",
            $user,
            $password,
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]
        );

        if (!is_dir($configDir)) {
            mkdir($configDir, 0755, true);
        }

        $conteudo = "<?php\n\n";
        $conteudo .= "return [\n";
        $conteudo .= "    'host' => '" . addslashes($host) . "',\n";
        $conteudo .= "    'dbname' => '" . addslashes($dbname) . "',\n";
        $conteudo .= "    'user' => '" . addslashes($user) . "',\n";
        $conteudo .= "    'password' => '" . addslashes($password) . "',\n";
        $conteudo .= "];\n";

        file_put_contents($configFile, $conteudo);

        header('Location: login.php');
        exit;

    } catch (PDOException $e) {
        $erro = 'Não foi possível conectar ao banco. Verifique host, banco, usuário e senha.';
    }
}

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NeoDesk OS - Instalação</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/install.css">
</head>

<body>

<div class="page">

    <div class="main-card">

        <div class="left-panel">

            <div class="logo">
                <div class="logo-box">
                    <span>N</span>
                </div>

                <div class="brand">
                    NEODESK <span>OS</span>
                </div>

                <div class="sub-brand">
                    CRM • ERP • HELPDESK
                </div>
            </div>

            <div class="title-left">
                Configuração do<br>
                <span class="green">Banco de Dados</span>
            </div>

            <div class="description">
                Informe os dados do seu banco de dados
                para conectar o sistema NeoDesk OS.
            </div>

            <div class="database">
                <div class="circle"></div>
                <div class="circle"></div>
                <div class="circle"></div>
            </div>

            <div class="feature">
                <i class="bi bi-shield-check"></i>
                <div>
                    <strong>Conexão Segura</strong>
                    <small>Proteção avançada dos dados</small>
                </div>
            </div>

            <div class="feature">
                <i class="bi bi-lightning-charge"></i>
                <div>
                    <strong>Instalação Rápida</strong>
                    <small>Configure em poucos segundos</small>
                </div>
            </div>

            <div class="feature">
                <i class="bi bi-cloud-check"></i>
                <div>
                    <strong>100% Online</strong>
                    <small>Acesse de qualquer lugar</small>
                </div>
            </div>

        </div>

        <div class="right-panel">

            <div class="version">
                <i class="bi bi-cpu"></i>
                <div>
                    <strong>ASTRAOS</strong><br>
                    <small>Versão 1.0.0</small>
                </div>
            </div>

            <div class="form-title">
                <i class="bi bi-database"></i>
                <div>
                    <h2>Configurar Conexão</h2>
                    <p>Preencha os dados do banco de dados</p>
                </div>
            </div>

            <div class="line"></div>

            <?php if (!empty($erro)): ?>
                <div class="alert">
                    <?= $erro ?>
                </div>
            <?php endif; ?>

            <?php if (isset($_GET['erro'])): ?>
                <div class="alert">
                    Erro ao conectar ao banco de dados.
                </div>
            <?php endif; ?>

            <form method="POST">

                <div class="form-group">
                    <label>Servidor / Host</label>
                    <div class="input-group">
                        <div class="input-icon">
                            <i class="bi bi-server"></i>
                        </div>
                        <input type="text" name="host" value="localhost" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Nome do Banco</label>
                    <div class="input-group">
                        <div class="input-icon">
                            <i class="bi bi-database"></i>
                        </div>
                        <input type="text" name="dbname" placeholder="Digite o nome do banco" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Usuário</label>
                    <div class="input-group">
                        <div class="input-icon">
                            <i class="bi bi-person"></i>
                        </div>
                        <input type="text" name="user" placeholder="Usuário do banco" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Senha</label>
                    <div class="input-group">
                        <div class="input-icon">
                            <i class="bi bi-lock"></i>
                        </div>

                        <div class="password-area">
                            <input type="password" name="password" id="password" placeholder="Senha do banco">
                            <i class="bi bi-eye eye" onclick="mostrarSenha()"></i>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn-connect">
                    <i class="bi bi-plug-fill"></i>
                    CONECTAR E CONTINUAR
                </button>

            </form>

            <div class="system-info">
                <i class="bi bi-shield-check"></i>
                Seus dados estão seguros e protegidos
            </div>

        </div>

    </div>

</div>

<div class="footer-info">
    AstraOS v1.0 <span>•</span> NeoDesk Informática <span>•</span> CRM + ERP + Help Desk
</div>

<script>
function mostrarSenha(){
    const campo = document.getElementById('password');
    campo.type = campo.type === 'password' ? 'text' : 'password';
}
</script>

</body>
</html>