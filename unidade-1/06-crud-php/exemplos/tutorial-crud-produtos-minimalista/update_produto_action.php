<?php

require 'conexao.php';

$nome = $_POST['nome'];
$descricao = $_POST['descricao'];
$data_validade = $_POST['data_validade'];
$quantidade = $_POST['quantidade'];
$valor = $_POST['valor'];
$id = $_POST['id'];

$comando = $pdo->prepare(
    'UPDATE produtos SET nome = ?, descricao = ?, data_validade = ?, quantidade = ?, valor = ?
     WHERE id = ?'
);
$comando->execute([ $nome, $descricao, $data_validade, $quantidade, $valor, $id ]);

header('Location: /index_produto.php');
exit;
