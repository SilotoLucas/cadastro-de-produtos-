<?php
// Inicia a sessão
session_start();

// Verifica se o usuário não está logado, redireciona para a página de login se não estiver
if (!isset($_SESSION['usuario_logado']) || $_SESSION['usuario_logado'] !== true) {
    header("Location: login.php");
    exit;
}

// Inclui o arquivo de funções para manipular o arquivo CSV
include 'database.php';

// Obtém o ID do usuário logado
$usuario_id = isset($_SESSION['usuario_id']) ? $_SESSION['usuario_id'] : null;

// Carrega os produtos do arquivo CSV pertencentes ao usuário logado
$produtos = carregarProdutosUsuarioCSV($usuario_id);

// Verifica se os dados do formulário foram enviados
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os valores do formulário
    $produto = $_POST["produto"];
    $quantidade = $_POST["quantidade"];
    $validade = $_POST["validade"];
    $lote = $_POST["lote"];
    $fornecedor = $_POST["fornecedor"];
    
    // Cria um array com os dados do produto
    $novoProduto = array($produto, $quantidade, $validade, $lote, $fornecedor);

    // Adiciona o novo produto ao array de produtos
    $produtos[] = $novoProduto;

    // Salva os produtos atualizados no arquivo CSV
    salvarProdutosUsuarioCSV($usuario_id, $produtos);
    
    // Redireciona de volta para a página de adicionar produtos
    header("Location: produtos.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Produtos</title>
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
                    </ul>
                </div>
            </nav>
        </div>
    </header>
    <div class="container mt-4">
        <h2>Adicionar Produtos</h2>
        <form action="produtos.php" method="post">
            <div class="form-group">
                <label for="produto">Produto:</label>
                <input type="text" class="form-control" id="produto" name="produto" required>
            </div>
            <div class="form-group">
                <label for="quantidade">Quantidade:</label>
                <input type="number" class="form-control" id="quantidade" name="quantidade" required>
            </div>
            <div class="form-group">
                <label for="validade">Validade:</label>
                <input type="date" class="form-control" id="validade" name="validade" required>
            </div>
            <div class="form-group">
                <label for="lote">Lote:</label>
                <input type="text" class="form-control" id="lote" name="lote" required>
            </div>
            <div class="form-group">
                <label for="fornecedor">Fornecedor:</label>
                <input type="text" class="form-control" id="fornecedor" name="fornecedor" required>
            </div>
            <button type="submit" class="btn btn-primary">Salvar</button>
        </form>
    </div>
    <!-- Bootstrap JS (opcional, necessário para alguns componentes do Bootstrap) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
