<?php
// Incluir o arquivo de funções para manipular o arquivo CSV
include 'database.php';

// Verificar se o formulário foi enviado via método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar se os dados necessários foram enviados
    if (isset($_POST['nome']) && isset($_POST['quantidade']) && isset($_POST['validade']) && isset($_POST['lote']) && isset($_POST['fornecedor']) && isset($_POST['index'])) {
        // Obter os dados do formulário
        $nome = $_POST['nome'];
        $quantidade = $_POST['quantidade'];
        $validade = $_POST['validade'];
        $lote = $_POST['lote'];
        $fornecedor = $_POST['fornecedor'];
        $index = $_POST['index'];

        // Carregar os produtos do usuário logado
        $usuario_id = isset($_SESSION['usuario_id']) ? $_SESSION['usuario_id'] : null;
        $produtos = carregarProdutosUsuarioCSV($usuario_id);

        // Verificar se o índice é válido
        if (isset($produtos[$index])) {
            // Atualizar os detalhes do produto com os novos valores
            $produtos[$index] = array($nome, $quantidade, $validade, $lote, $fornecedor);

            // Salvar os produtos atualizados no arquivo CSV
            salvarProdutosUsuarioCSV($usuario_id, $produtos);

            // Redirecionar de volta à página Home após a edição do produto
            header("Location: index.php");
            exit;
        } else {
            // Índice inválido, redirecionar de volta à página Home
            header("Location: index.php");
            exit;
        }
    } else {
        // Dados incompletos, redirecionar de volta à página Home
        header("Location: index.php");
        exit;
    }
} else {
    // Se o formulário não foi enviado via método POST, redirecionar de volta à página Home
    header("Location: index.php");
    exit;
}
?>
