<?php
// Incluir o arquivo de funções para manipular o arquivo CSV
include 'database.php';

// Verificar se o índice do produto a ser editado foi enviado via GET
if(isset($_GET['index'])) {
    // Obter o índice do produto a ser editado
    $index = $_GET['index'];

    // Carregar os produtos do usuário logado
    $usuario_id = isset($_SESSION['usuario_id']) ? $_SESSION['usuario_id'] : null;
    $produtos = carregarProdutosUsuarioCSV($usuario_id);

    // Verificar se o índice é válido
    if(isset($produtos[$index])) {
        // Produto encontrado, carregar os detalhes do produto
        $produto = $produtos[$index];
    } else {
        // Índice inválido, redirecionar de volta à página Home
        header("Location: index.php");
        exit;
    }
} else {
    // Se o índice não foi fornecido, redirecionar de volta à página Home
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Produto</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2>Editar Produto</h2>
        <form action="editar_produto_action.php" method="post">
            <div class="form-group">
                <label for="nome">Nome do Produto:</label>
                <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $produto[0]; ?>" required>
            </div>
            <div class="form-group">
                <label for="quantidade">Quantidade:</label>
                <input type="number" class="form-control" id="quantidade" name="quantidade" value="<?php echo $produto[1]; ?>" required>
            </div>
            <div class="form-group">
                <label for="validade">Validade:</label>
                <input type="date" class="form-control" id="validade" name="validade" value="<?php echo $produto[2]; ?>" required>
            </div>
            <div class="form-group">
                <label for="lote">Lote:</label>
                <input type="text" class="form-control" id="lote" name="lote" value="<?php echo $produto[3]; ?>" required>
            </div>
            <div class="form-group">
                <label for="fornecedor">Fornecedor:</label>
                <input type="text" class="form-control" id="fornecedor" name="fornecedor" value="<?php echo $produto[4]; ?>" required>
            </div>
            <input type="hidden" name="index" value="<?php echo $index; ?>">
            <button type="submit" class="btn btn-primary">Salvar</button>
            <a href="index.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
    <!-- Bootstrap JS (opcional, necessário para alguns componentes do Bootstrap) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
