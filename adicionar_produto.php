<?php
// Inclui o arquivo de funções para manipular o arquivo CSV
include 'database.php';

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

    // Carrega os produtos existentes do arquivo CSV
    $produtos = carregarProdutosCSV();

    // Adiciona o novo produto ao array de produtos
    $produtos[] = $novoProduto;

    // Salva os produtos atualizados no arquivo CSV
    salvarProdutosCSV($produtos);

    // Redireciona de volta para a página de produtos
    header("Location: produtos.php");
    exit;
}
?>
