<?php
// Inicia a sessão
session_start();

// Verifica se o usuário não está logado, redireciona para a página de login se não estiver
if (!isset($_SESSION['usuario_logado']) || $_SESSION['usuario_logado'] !== true) {
    header("Location: login.php");
    exit;
}

// Obtém o nome do usuário ativo
$nome_usuario = isset($_SESSION['nome_usuario']) ? $_SESSION['nome_usuario'] : 'Usuário';

// Inclui o arquivo de funções para manipular o arquivo CSV
include 'database.php';

// Obtém o ID do usuário logado
$usuario_id = isset($_SESSION['usuario_id']) ? $_SESSION['usuario_id'] : null;

// Carrega os produtos do arquivo CSV pertencentes ao usuário logado
$produtos = carregarProdutosUsuarioCSV($usuario_id);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Home</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <header class="bg-dark text-white">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <a class="navbar-brand" href="#">Meu Site</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="produtos.php">Adicionar Produtos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">Logout</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </header>
    <div class="container mt-4">
        <section>
            <h4>Visualizar Produtos</h4>
            <div class="row">
                <?php
                if (!empty($produtos)) {
                    foreach ($produtos as $index => $produto) {
                        echo "<div class='col-md-4 mb-3'>";
                        echo "<div class='card'>";
                        echo "<div class='card-body'>";
                        echo "<h5 class='card-title'>{$produto[0]}</h5>";
                        echo "<p class='card-text'>Quantidade: {$produto[1]}</p>";
                        echo "<p class='card-text'>Validade: {$produto[2]}</p>";
                        echo "<p class='card-text'>Lote: {$produto[3]}</p>";
                        echo "<p class='card-text'>Fornecedor: {$produto[4]}</p>";
                        // Adiciona botões de edição e exclusão
                        echo "<a href='editar_produto.php?index={$index}' class='btn btn-primary mr-2'>Editar</a>";
                        echo "<a href='excluir_produto.php?index={$index}' class='btn btn-danger'>Excluir</a>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                    }
                } else {
                    echo "<p class='text-muted'>Nenhum produto cadastrado.</p>";
                }
                ?>
            </div>
        </section>
    </div>
    <!-- Bootstrap JS (opcional, necessário para alguns componentes do Bootstrap) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
