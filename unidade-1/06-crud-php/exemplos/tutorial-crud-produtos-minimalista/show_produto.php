<?php

require 'conexao.php';

$id = $_GET['id'];

$consulta = $pdo->prepare('SELECT * FROM produtos WHERE id = ?');
$consulta->execute([$id]);

$produto = $consulta->fetch(PDO::FETCH_ASSOC);

?>

Nome: <?= $produto['nome'] ?><br>
Descrição: <?= $produto['descricao'] ?><br>
Data de Validade: <?= $produto['data_validade'] ?><br>
Quantidade: <?= $produto['quantidade'] ?><br>
Valor: <?= $produto['valor'] ?><br>
