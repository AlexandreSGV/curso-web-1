<?php

require 'conexao.php';

$nome = $_POST['nome'];
$descricao = $_POST['descricao'];
$data_validade = $_POST['data_validade'];
$quantidade = $_POST['quantidade'];
$valor = $_POST['valor'];

$comando = $pdo->prepare(
    'INSERT INTO produtos (nome, descricao, data_validade,quantidade, valor)
    VALUES (?, ?, ?, ?, ?)'
);
$comando->execute([$nome, $descricao, $data_validade, $quantidade, $valor]);

header('Location: /index_produto.php');
exit;
