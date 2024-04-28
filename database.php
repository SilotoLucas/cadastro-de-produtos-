<?php
// Função para salvar produtos de um usuário em um arquivo CSV
function salvarProdutosUsuarioCSV($usuario_id, $produtos) {
    $file = 'produtos_' . $usuario_id . '.csv';
    $fp = fopen($file, 'w');
    foreach ($produtos as $produto) {
        fputcsv($fp, $produto);
    }
    fclose($fp);
}

// Função para carregar produtos de um usuário de um arquivo CSV
function carregarProdutosUsuarioCSV($usuario_id) {
    $produtos = array();
    $file = 'produtos_' . $usuario_id . '.csv';
    if (file_exists($file)) {
        $fp = fopen($file, 'r');
        while ($row = fgetcsv($fp)) {
            $produtos[] = $row;
        }
        fclose($fp);
    }
    return $produtos;
}

// Função para salvar produtos em um arquivo CSV
function salvarProdutosCSV($produtos) {
    // Aqui você pode salvar produtos globais se necessário
    $file = 'produtos.csv';
    $fp = fopen($file, 'w');
    foreach ($produtos as $produto) {
        fputcsv($fp, $produto);
    }
    fclose($fp);
}

// Função para carregar produtos de um arquivo CSV
function carregarProdutosCSV() {
    // Aqui você pode carregar produtos globais se necessário
    $produtos = array();
    $file = 'produtos.csv';
    if (file_exists($file)) {
        $fp = fopen($file, 'r');
        while ($row = fgetcsv($fp)) {
            $produtos[] = $row;
        }
        fclose($fp);
    }
    return $produtos;
}

// Função para salvar usuários em um arquivo CSV
function salvarUsuariosCSV($usuarios) {
    $file = 'usuarios.csv';
    $fp = fopen($file, 'w');
    foreach ($usuarios as $usuario) {
        fputcsv($fp, $usuario);
    }
    fclose($fp);
}

// Função para carregar usuários de um arquivo CSV
function carregarUsuariosCSV() {
    $usuarios = array();
    $file = 'usuarios.csv';
    if (file_exists($file)) {
        $fp = fopen($file, 'r');
        while ($row = fgetcsv($fp)) {
            $usuarios[] = $row;
        }
        fclose($fp);
    }
    return $usuarios;
}

// Função para excluir um produto de um usuário
function excluirProdutoUsuario($usuario_id, $index) {
    // Carrega os produtos do usuário
    $produtos = carregarProdutosUsuarioCSV($usuario_id);

    // Remove o produto pelo índice
    unset($produtos[$index]);

    // Reindexa o array
    $produtos = array_values($produtos);

    // Salva os produtos atualizados no arquivo CSV
    salvarProdutosUsuarioCSV($usuario_id, $produtos);
}

// Função para editar um produto de um usuário
function editarProdutoUsuario($usuario_id, $index, $novoProduto) {
    // Carrega os produtos do usuário
    $produtos = carregarProdutosUsuarioCSV($usuario_id);

    // Atualiza o produto pelo índice
    $produtos[$index] = $novoProduto;

    // Salva os produtos atualizados no arquivo CSV
    salvarProdutosUsuarioCSV($usuario_id, $produtos);
}
?>
