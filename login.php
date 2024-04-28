<?php
// Função para simular o processamento do login (apenas para teste)
function processarLogin($login, $senha) {
    // Aqui você pode implementar a lógica de verificação do login e senha
    // Por enquanto, vamos apenas retornar true para simular um login bem-sucedido
    return true;
}

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

    // Se a ação for "login"
    if ($acao == "login") {
        // Processa o login
        $login_result = processarLogin($login, $senha);
        if ($login_result === true) {
            // Login bem-sucedido, redireciona para a página inicial
            $_SESSION['usuario_logado'] = true;
            header("Location: index.php");
            exit;
        } else {
            // Exibe mensagem de erro se o login falhar
            $_SESSION['erro_login'] = true;
            header("Location: login.php");
            exit;
        }
    }

    // Se a ação for "cadastro", você precisa implementar a lógica de cadastro aqui
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Login</div>
                    <div class="card-body">
                        <?php if (isset($_SESSION['erro_login']) && $_SESSION['erro_login'] === true): ?>
                            <div class="alert alert-danger" role="alert">
                                Usuário ou senha incorretos. Por favor, tente novamente.
                            </div>
                        <?php endif; ?>

                        <form action="login.php" method="post">
                            <div class="form-group">
                                <label for="login">Usuário:</label>
                                <input type="text" class="form-control" id="login" name="login" required>
                            </div>
                            <div class="form-group">
                                <label for="senha">Senha:</label>
                                <input type="password" class="form-control" id="senha" name="senha" required>
                            </div>
                            <input type="hidden" name="acao" value="login">
                            <button type="submit" class="btn btn-primary">Entrar</button>
                        </form>

                        <hr>

                        <form action="login.php" method="post">
                            <div class="form-group">
                                <label for="login_cadastro">Novo Usuário:</label>
                                <input type="text" class="form-control" id="login_cadastro" name="login" required>
                            </div>
                            <div class="form-group">
                                <label for="senha_cadastro">Nova Senha:</label>
                                <input type="password" class="form-control" id="senha_cadastro" name="senha" required>
                            </div>
                            <input type="hidden" name="acao" value="cadastro">
                            <button type="submit" class="btn btn-success">Cadastrar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS (opcional, necessário para alguns componentes do Bootstrap) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
