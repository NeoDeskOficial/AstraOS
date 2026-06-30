<?php

// Inicia a sessão
session_start();

// Limpa todas as variáveis da sessão
$_SESSION = [];

// Remove o cookie da sessão, se existir
if (ini_get('session.use_cookies')) {

    $params = session_get_cookie_params();

    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params['path'],
        $params['domain'],
        $params['secure'],
        $params['httponly']
    );
}

// Destrói a sessão
session_destroy();

// Evita cache do navegador
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Expires: Sat, 01 Jan 2000 00:00:00 GMT");

// Redireciona para a tela de escolha de acesso
header("Location: ../auth/acesso.php");
exit;