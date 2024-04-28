<?php
// Inicia a sessão
session_start();

// Verifica se o usuário já está logado, redireciona para a página inicial se estiver
if (isset($_SESSION['usuario_logado']) && $_SESSION['usuario_logado'] === true) {
    header("Location: index.php");
    exit;
}

// Verifica se o formulário de login foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os dados do formulário
    $acao = $_POST["acao"];
    $login = $_POST["login"];
    $senha = $_POST["senha"];

    // Inclui o arquivo de funções para manipular o arquivo CSV
    include 'database.php';

    // Se a ação for "login"
    if ($acao == "login") {
        // Processa o login
        $login_result = processarLogin($login, $senha);
        if ($login_result === true) {
            // Redireciona para a página inicial se o login for bem-sucedido
            header("Location: index.php");
            exit;
        } else {
            // Exibe mensagem de erro se o login falhar
            $_SESSION['erro_login'] = true;
            header("Location: login.php");
            exit;
        }
    }

    // Se a ação for "cadastro"
    if ($acao == "cadastro") {
        // Processa o cadastro
        $cadastro_result = processarCadastro($login, $senha);
        if ($cadastro_result === true) {
            // Redireciona para a página de login após o cadastro bem-sucedido
            header("Location: login.php");
            exit;
        } else {
            // Exibe mensagem de erro se o cadastro falhar
            $_SESSION['erro_cadastro'] = true;
            header("Location: login.php");
            exit;
        }
    }
}
?>
