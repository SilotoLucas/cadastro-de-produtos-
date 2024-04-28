<?php
// Incluir o arquivo de funções para manipular o arquivo CSV
include 'database.php';

// Verificar se o índice do produto a ser excluído foi enviado via GET
if(isset($_GET['index'])) {
    // Obter o índice do produto a ser excluído
    $index = $_GET['index'];

    // Carregar os produtos do usuário logado
    $usuario_id = isset($_SESSION['usuario_id']) ? $_SESSION['usuario_id'] : null;
    $produtos = carregarProdutosUsuarioCSV($usuario_id);

    // Verificar se o índice é válido
    if(isset($produtos[$index])) {
        // Remover o produto do array
        unset($produtos[$index]);

        // Reindexar o array
        $produtos = array_values($produtos);
        
        // Salvar os produtos atualizados no arquivo CSV
        salvarProdutosUsuarioCSV($usuario_id, $produtos);

        // Redirecionar de volta à página Home após a exclusão
        header("Location: index.php");
        exit;
    }
}
// Se o índice não foi fornecido ou não é válido, redirecionar de volta à página Home
header("Location: index.php");
exit;
?>
